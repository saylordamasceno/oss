<?php require_once('../includes/config.php'); 
require_once('../includes/functions.php');
$pagina = 'Confirma Cliente';
if ($_GET['mode'] == 'add'){
	$modo = "Adicionado";
	mysql_select_db($database_data, $data);
$query_DetailRS1 = sprintf("SELECT id FROM cliente ORDER BY id DESC LIMIT 1");
$DetailRS1 = mysql_query($query_DetailRS1, $data) or die(mysql_error());
$row_DetailRS1 = mysql_fetch_assoc($DetailRS1);
$cod_Cliente = $row_DetailRS1['id'];
} else header('Location: '.getUrl());
//	if ($_GET['mode'] == 'edd')	$modo = "Editado";
//	elseif ($_GET['mode'] == 'exx')	$modo = "Excluido";

$OP_ok = sprintf('Cliente %s com Sucesso.', $modo);



?>
<?php include('../includes/header.php');?>
<body>
<?php include('../includes/menudrop.php');?>
<table width="537" height="202" border="0" align="center">
  <tr>
    <td height="121" align="center" valign="middle"><p align="center"> <?php echo $OP_ok; ?></p>      </td>
  </tr>
  <tr>
    <td align="center" valign="middle" class="style10">
        <div align="center"><a href="../cliente_add.php">Continuar Cadastrando Clientes</a>&nbsp;
        <?php if (isset($cod_Cliente)) {?>
		-&nbsp;<a href="../os_a/add_a.php?recordID=<?php echo $cod_Cliente;?>">Adicionar OS para este Cliente</a>&nbsp;<?php } ?>
        -&nbsp;<a href="<?php echo getUrl();?>">Voltar para Lista de Clientes</a></div> <br />
    </td>
  </tr>
</table>
</div></body>
</html>
<?php
mysql_free_result($config);
?>
