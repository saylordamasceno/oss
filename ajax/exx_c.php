<?php require_once('../includes/config.php');
require_once('../includes/functions.php');
$pagina = 'Excluir Cliente';

$currentPage = $_SERVER["PHP_SELF"];

if ((isset($_GET['id'])) && ($_GET['id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM cliente, tab_report USING cliente INNER JOIN tab_report USING(id)WHERE cliente.id=%s",
                       GetSQLValueString($_GET['id'], "int"));

  mysql_select_db($database_data, $data);
  $Result1 = mysql_query($deleteSQL, $data) or die(mysql_error());
  header(sprintf("Location: %s", getUrl()));
}
?>
