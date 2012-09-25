<?php 
require_once('../includes/functions.php');

$Cod = $_GET['recordID'];

$updateSQL = sprintf("UPDATE  `ordemservico` SET  problemacliente=
if (Repeat_os = 0,concat('Entrada:',date_format(entrada,%s),' => ',problemacliente),
problemacliente), `Repeat_os` = Repeat_os+1, Entrada=now() WHERE  `id_equipamento` =%s",
    GetSQLValueString('%d/%m/%Y', "text"),
    GetSQLValueString($Cod, "int"));  
$Result1 = mysql_query($updateSQL, $data) or die(mysql_error());
//header(sprintf("Location: %s", getUrl()));
?>
