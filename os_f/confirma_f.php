<?php require_once('../includes/config.php'); 
require_once('../includes/functions.php');
$pagina = 'Confirma Impressão';


$colname_Recordset1 = "-1";
if (isset($_GET['recordID'])) {
  $colname_Recordset1 = $_GET['recordID'];
}
mysql_select_db($database_data, $data);
$query_Recordset1 = sprintf("SELECT Cod_equipamento,Cliente FROM ordemservico WHERE Cod_Equipamento = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $data) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$Cliente = mysql_result($Recordset1,0,'Cliente');
$Cod_Os = mysql_result($Recordset1,0,'Cod_equipamento');


?>
<?php include('../includes/header.php');?>
<body>
<?php include('../includes/menudrop.php');?>

<table width="496" height="202" border="0" align="center">
  <tr>
    <td height="121" align="center" valign="middle"><p align="center" class="style3 style4 style8">Ordem de Servi&ccedil;o Nº <?php echo $Cod_Os; ?> para cliente <?php echo $Cliente; ?> foi Fechada com Sucesso.</p> Deseja Imprimir o Comprovante da OS?</p>
    </td>
  </tr>
  <tr>
    <td align="center" valign="middle" class="style10"><p align="center"><a href="visualiza_f.php?recordID=<?php echo $Cod_Os; ?>">Imprimir Comprovante da Ordem de Serviço</a><br>
        <a href="<?php echo getUrl(); ?>">Voltar para Listagem de Ordems</a>
    </td>
  </tr>
</table>
</div></body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($config);
?>
