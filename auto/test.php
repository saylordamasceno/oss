<?php
include ('../includes/config.php');
    header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
    header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
    header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header ("Pragma: no-cache"); // HTTP/1.0
    
    $input = strtoupper($_GET['input']);
    $conta = str_pad($input, 4, "0", STR_PAD_LEFT);
    $len = strlen($input);

mysql_select_db($database_data);
$q_busca = mysql_query("select Nome,cod_conta,codigo from cliente where Nome like '%".$input."%' or cod_conta like '%".$conta."%'",$data) or die(mysql_error());
$q_lista = mysql_fetch_array($q_busca);
$Lista_Cli = array();
do $Lista_Cli[$q_lista['Nome']]=array('Nome'=>$q_lista['Nome'],
                                      'Codigo'=>$q_lista['codigo'],
                                      'Conta'=>$q_lista['cod_conta']);
while ($q_lista = mysql_fetch_array($q_busca));
	
	$aResults = array();

        foreach ($Lista_Cli as $key) {
            $aResults[] = array( "id"=>$key['Codigo'] ,"value"=>htmlspecialchars($key['Nome']), "info"=>htmlspecialchars($key['Conta']) );}

	
	if (isset($_REQUEST['json']))
	{
		header("Content-Type: application/json");
	
		echo "{\"results\": [";
		$arr = array();
		for ($i=0;$i<count($aResults);$i++)
		{
			$arr[] = "{\"id\": \"".$aResults[$i]['id']."\", \"value\": \"".$aResults[$i]['value']."\", \"info\": \"".$aResults[$i]['info']."\"}";
		}
		echo implode(", ", $arr);
		echo "]}";
	}
	else
	{
		header("Content-Type: text/xml");

		echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\" ?><results>";
		for ($i=0;$i<count($aResults);$i++)
		{
			echo "<rs id=\"".$aResults[$i]['id']."\" info=\"".$aResults[$i]['info']."\">".$aResults[$i]['value']."</rs>";
		}
		echo "</results>";
	}
?>