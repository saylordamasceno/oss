<?php require_once('../includes/config.php'); ?>
<?php
mysql_select_db($database_data, $data);
$query_config = "SELECT * FROM config";
$config = mysql_query($query_config, $data) or die(mysql_error());
$row_config = mysql_fetch_assoc($config);
$totalRows_config = mysql_num_rows($config);

if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../restrito.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$currentPage = $_SERVER["PHP_SELF"];

if ((isset($_GET['id'])) && ($_GET['id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM usuarios WHERE id=%s",
                       GetSQLValueString($_GET['id'], "int"));

  mysql_select_db($database_data, $data);
  $Result1 = mysql_query($deleteSQL, $data) or die(mysql_error());

  $deleteGoTo = "../fechar.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$maxRows_Recordset1 = 1;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_data, $data);
$query_Recordset1 = "SELECT * FROM usuarios";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $data) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title><?php echo $row_config['nome']; ?> - Excluir Funcion&aacute;rio: <?php echo $row_Recordset1['nome']; ?></title>
<link rel="shortcut icon" href="../favicon.ico" >
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script type='text/javascript'>
<!--
function FecharJanela()
{
ww = window.open(window.location, "_self");
ww.close();
}
-->
</script>
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>
</head>

<body>
<form action="exx_f.php" method="get" name="form1" id="form1">
  <table border="0" cellspacing="2" cellpadding="2" >
  <tr>
    <td width="263" class="verdana"><b>Nome:</b><br />        
        <strong><?php echo $row_Recordset1['nome']; ?></strong><br />      </td>
      <td width="30">&nbsp;</td>
      <td width="220" class="verdana"><b>Nome 
        pelo qual gosta de ser chamado:<br />
        </b><?php echo $row_Recordset1['apelido']; ?><b><br />
      </b></td>
  </tr>
  <tr>
    <td width="263" class="verdana"><b>Cargo:<br />
      </b><?php echo $row_Recordset1['cargo']; ?><b><br />
        </b></td>
      <td width="30">&nbsp;</td>
      <td width="220" class="verdana"><b>Setor:<br />
        </b><?php echo $row_Recordset1['setor']; ?><b><br />
        </b></td>
  </tr>
  <tr>
    <td width="263"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="47%" class="verdana"><b>CPF:</b><br />            
            <?php echo $row_Recordset1['cpf']; ?><br />          </td>
            <td width="53%" class="verdana"><b>RG:</b><br />            
              <?php echo $row_Recordset1['rg']; ?><br />            </td>
        </tr>
      </table></td>
      <td width="30">&nbsp;</td>
      <td width="220" class="verdana"><b>CTPS:</b><br />        
        <?php echo $row_Recordset1['ctps']; ?><br />      </td>
  </tr>
  <tr>
    <td width="263"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="verdana"><b>Data 
          de Nascimento:</b><br />          
          <?php echo $row_Recordset1['data_nasc']; ?><br />          </td>
            <td class="verdana"><b>Tipo 
              Sangu&iacute;neo:</b><br />          
              <?php echo $row_Recordset1['tipo_sanguineo']; ?><br />            </td>
        </tr>
      </table></td>
      <td width="30">&nbsp;</td>
      <td width="220"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="verdana"><b>Estado 
            Civil:</b><br />          
            <?php echo $row_Recordset1['estado_civil']; ?><br />            </td>
            <td class="verdana"><b>N&uacute;mero 
              de filhos:</b><br />          
              <?php echo $row_Recordset1['numero_filhos']; ?><br />            </td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td width="263" class="verdana"><b>Endere&ccedil;o:</b><br />        
        <?php echo $row_Recordset1['endereco']; ?><br />      </td>
      <td width="30">&nbsp;</td>
      <td width="220" class="verdana"><b>Bairro:</b><br />        
        <?php echo $row_Recordset1['bairro']; ?><br />      </td>
  </tr>
  <tr>
    <td width="263" class="verdana"><b>Cidade:<br />
      </b><?php echo $row_Recordset1['cidade']; ?><br />      </td>
      <td width="30">&nbsp;</td>
      <td width="220"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="verdana"><b>Estado:</b><br />            
              <?php echo $row_Recordset1['estado']; ?><br />            </td>
            <td class="verdana"><b>Cep.:</b><br />            
              <?php echo $row_Recordset1['cep']; ?><br />            </td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td width="263"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="verdana"><b>Fone 
          Comercial:</b><br />          
          <?php echo $row_Recordset1['fone_com']; ?><br />          </td>
            <td class="verdana"><b>Fone 
              Residencial:</b><br />          
              <?php echo $row_Recordset1['fone_empresa']; ?><br />            </td>
        </tr>
      </table></td>
      <td width="30">&nbsp;</td>
      <td width="220" class="verdana"><b>Celular:</b><br />        
        <?php echo $row_Recordset1['celular']; ?><br />      </td>
  </tr>
  <tr>
    <td colspan="3"><span class="verdana"><b>Escolaridade:</b><br />        
        <?php echo $row_Recordset1['escolaridade']; ?><br />
      </span>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
      </table></td>
  </tr>
  <tr>
    <td width="263"><span class="verdana"><b>Situa&ccedil;&atilde;o:<br />
      </b><?php echo $row_Recordset1['situacao']; ?><b><br />
        </b>      </span>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
      </table></td>
      <td width="30">&nbsp;</td>
      <td width="220" class="verdana"><b>Qual 
        Ano:<br />
        </b><?php echo $row_Recordset1['ano']; ?><b><br />
      </b></td>
  </tr>
  <tr>
    <td width="263" valign="top" class="verdana"><b>E-Mail:</b><br />        
        <?php echo $row_Recordset1['email']; ?><br />      </td>
      <td width="30">&nbsp;</td>
      <td width="220"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="verdana"><b>Login:</b><br />            
              <?php echo $row_Recordset1['login']; ?><br />            </td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="3" height="35" align="center"><div align="right">
      <span class="verdana">
        <input type="submit" name="button2" id="button2" value="Excluir Cadastro" />
        </span></div></td>
  </tr>
  </table>
  <table border="0">
    <tr>
      <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>"><img src="../Imagens/First.gif" border="0" /></a>
      <?php } // Show if not first page ?>      </td>
      <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>"><img src="../Imagens/Previous.gif" border="0" /></a>
      <?php } // Show if not first page ?>      </td>
      <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>"><img src="../Imagens/Next.gif" border="0" /></a>
      <?php } // Show if not last page ?>      </td>
      <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>"><img src="../Imagens/Last.gif" border="0" /></a>
      <?php } // Show if not last page ?>      </td>
    </tr>
    <tr>
      <td colspan="4"><a href='#fechar' onClick='FecharJanela()'>Fechar</a></td>
    </tr>
  </table>
  <input name="id" type="hidden" id="id" value="<?php echo $row_Recordset1['id']; ?>" />
</form>
</div></body>
</html>
<?php
mysql_free_result($config);

mysql_free_result($Recordset1);
?>
