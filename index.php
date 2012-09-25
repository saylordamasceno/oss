<?php
session_start();
if (isset($_SESSION['MM_Username']))
    header('Location: os_a/lista_a');
else 
    include('sistema/login.php');
?>