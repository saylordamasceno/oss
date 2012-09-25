<?php
include_once('config.php');
if (!isset($_SESSION)) {
  session_start();
}

function msg($txt){
    echo '<script type="text/javascript"> alert("'.$txt.'");</script>';
}

function Redirect($txt){
    echo '<script type="text/javascript"> window.location = "'.$txt.'";</script>';
}

function urlDir($url = ''){ return INSTALL_FOLDER.$url; }

//
//		INICIA FUNÇÕES RESPONSAVEIS PELA VERIFICAÇÃO DE AUTENTICAÇÃO E LOGIN
//
$db = new db();
$db->query("SELECT * FROM config");
$row_config = $db->resultado();


$MM_authorizedUsers = "";
$MM_donotCheckaccess = "false";

function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
    $isValid = false; 
    if (!empty($UserName)) { 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
        if (in_array($UserName, $arrUsers)) { 
          $isValid = true; 
        } 
        if (in_array($UserGroup, $arrGroups)) { 
          $isValid = true; 
        } 
        if (($strUsers == "") && true) { 
              $isValid = true; 
            } 
          } 
          return $isValid; 

} 

$MM_restrictGoTo = urlDir();
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
    header("Location: ". $MM_restrictGoTo); 
}

//
//		TERMINA FUNÇÕES RESPONSAVEIS PELA VERIFICAÇÃO DE AUTENTICAÇÃO E LOGIN
//


if (!function_exists("GetSQLValueString")) {
    function GetSQLValueString($theValue, $theType, $CaseSens = false) 
    {
      $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
      $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
      $theValue = $sql = preg_replace("/(from|select|insert|delete|where|drop table|show tables|\\\\)/i", '', strip_tags($theValue));
      $theValue = preg_replace("@(--|\#|\*|;|=)@s", "", $theValue);
    
      switch ($theType) {
        case "text":
          $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
          break;    
        case "int":
          $theValue = ($theValue != "") ? intval($theValue) : "NULL";
          break;
        case "like":
          $theValue = ($theValue != "") ? "'%" . $theValue . "%'" : "NULL";
          break;
        case "moeda":
          $theValue = ($theValue != "") ? "'" . number_format($theValue,'.') . "'" : "NULL";
          break; 
      }
    
      if (!$CaseSens) $theValue = strtoupper($theValue);
      return $theValue;
    }
}

function getUrl(){
	return $_SESSION['Purl'];
}

function setUrl($url,$param){
	$urlt = sprintf('%s?%s',$url,$param);
	$_SESSION['Purl'] = $urlt;
}

function isAdm(){
	if ($_SESSION['MM_UserGroup'] == 1) return true;
	else return false;
}
?>