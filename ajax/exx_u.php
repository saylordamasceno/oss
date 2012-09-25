<?php require_once('../includes/functions.php');

if ((isset($_GET['recordID'])) && ($_GET['recordID'] != "")) {
  $deleteSQL = sprintf("DELETE FROM usuarios WHERE id=%s",
                       GetSQLValueString($_GET['recordID'], "int"));

  $Result1 = mysql_query($deleteSQL, $data) or die(mysql_error());
  header("Location:../usuarios/lista_f.php");
}
?>
