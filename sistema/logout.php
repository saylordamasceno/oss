<?php 
include('../includes/config.php');
include('../includes/functions.php');
unset($_SESSION['MM_Username'],$_SESSION['UserGroup']);
header('Location:'.urlDir('index'));

?>