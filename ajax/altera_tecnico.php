<?php require_once('../includes/functions.php');

$tecnico = strtoupper($_SESSION['MM_Username']);
$id = $_GET['recordID'];

$updateSQL = sprintf("UPDATE ordemservico SET Tecnico = IF(Tecnico = '', %s, IF(Tecnico != '', '', Tecnico)) WHERE id_equipamento= %s",
                       GetSQLValueString($tecnico, "text"),
                       GetSQLValueString($id, "int"));  
$Result1 = mysql_query($updateSQL, $data) or die('ERRO');
$updateSQL = sprintf('SELECT Tecnico FROM ordemservico WHERE id_equipamento=%s',GetSQLValueString($id, "int")); 
$Result1 = mysql_query($updateSQL, $data) or die(mysql_error());                      

echo mysql_result($Result1, 0);
