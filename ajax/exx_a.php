<?php require_once('../includes/config.php'); 
require_once('../includes/functions.php'); ?>
<?php
if ((isset($_GET['recordID'])) && ($_GET['recordID'] != "")) {
  $deleteSQL = sprintf("DELETE FROM ordemservico WHERE id_equipamento=%s",
                       GetSQLValueString($_GET['recordID'], "int"));

  mysql_select_db($database_data, $data);
  $Result1 = mysql_query($deleteSQL, $data) or die(mysql_error());

  header(sprintf("Location: %s", getUrl()));
}
?>

