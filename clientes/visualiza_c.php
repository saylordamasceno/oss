<?php require_once('../includes/config.php'); 
require_once('../includes/functions.php');
$pagina = 'Visualiza Cliente';

$CLI_id = $_GET['recordID'];

if (isset($_GET['pageNum_DetailRS1'])) {
  $pageNum_DetailRS1 = $_GET['pageNum_DetailRS1'];
}

$colname_DetailRS1 = "-1";
if (isset($_GET['recordID'])) {
  $colname_DetailRS1 = $_GET['recordID'];
}
mysql_select_db($database_data, $data);
$query_DetailRS1 = sprintf("SELECT id, nome, DATE_FORMAT(report,%s) as report, email, fone_empresa, celular, endereco, bairro, cidade, estado, cep, grupo, id,intervalo FROM cliente WHERE id = %s LIMIT 0, 1",'\'%H:%i\'', GetSQLValueString($colname_DetailRS1, "int"));
$DetailRS1 = mysql_query($query_DetailRS1, $data) or die(mysql_error());
$row_DetailRS1 = mysql_fetch_assoc($DetailRS1);
switch ($row_DetailRS1['intervalo']){
	case '0':$intervalo = 'Nunca'; break;
	case '1':$intervalo = '1 Dia'; break;
	case '3':$intervalo = '3 Dias'; break;		
}

?>
<?php include('../includes/header.php');?>
<body>
<?php include('../includes/menudrop.php');?>

<div class="form_tab_clienteadd">
	<div>
        <div class="form_cell" style="width:310px;">
        	<input type="hidden" name="id" />
			<strong>Nome:</strong><?php echo $row_DetailRS1['nome']; ?></div>
        <div class="form_cell" style="width:105px;">
        	<strong>id Nº</strong><?php echo $row_DetailRS1['id']; ?></div>
		<div class="form_cell_right" style="width:90px;">
        	<strong>Reporte:</strong><?php echo $row_DetailRS1['report']; ?></div>
		<div class="form_cell_right" style="width:100px;">
        	<strong>Intervalo:</strong><?php echo $intervalo; ?></div>
    </div>
    <div>
    	<div class="form_cell" style="width:425px;">
        	<strong>Endereço:</strong><?php echo $row_DetailRS1['endereco']; ?></div>
		<div class="form_cell" style="width:185px;">
        	<strong>Bairro:</strong><?php echo $row_DetailRS1['bairro']; ?></div>
    </div>
    <div>
    	<div class="form_cell" style="width:220px;">
        	<strong>Cidade:</strong><?php echo $row_DetailRS1['cidade']; ?></div>
		<div class="form_cell" style="width:210px;">
        	<strong>Estado:</strong>
				<?php if (!(strcmp("AC", $row_DetailRS1['estado']))) echo "Acre";
                elseif (!(strcmp("AL", $row_DetailRS1['estado']))) echo "Alagoas";
                elseif (!(strcmp("AP", $row_DetailRS1['estado']))) echo "Amapá"; 
                elseif (!(strcmp("AM", $row_DetailRS1['estado']))) {echo "Amazonas";} 
                elseif (!(strcmp("BA", $row_DetailRS1['estado']))) {echo "Bahia";} 
                elseif (!(strcmp("CE", $row_DetailRS1['estado']))) {echo "Ceará";} 
                elseif (!(strcmp("DF", $row_DetailRS1['estado']))) {echo "Distrito Federal";} 
                elseif (!(strcmp("ES", $row_DetailRS1['estado']))) {echo "Espírito Santo";} 
                elseif (!(strcmp("GO", $row_DetailRS1['estado']))) {echo "Goiás";} 
                elseif (!(strcmp("MA", $row_DetailRS1['estado']))) {echo "Maranhão";} 
                elseif (!(strcmp("MT", $row_DetailRS1['estado']))) {echo "Mato Grosso";} 
                elseif (!(strcmp("MS", $row_DetailRS1['estado']))) {echo "Mato Grosso do Sul";} 
                elseif (!(strcmp("MG", $row_DetailRS1['estado']))) {echo "Minas Gerais";} 
                elseif (!(strcmp("PA", $row_DetailRS1['estado']))) {echo "Pará";} 
                elseif (!(strcmp("PB", $row_DetailRS1['estado']))) {echo "Paraíba";} 
                elseif (!(strcmp("PR", $row_DetailRS1['estado']))) {echo "Paraná";} 
                elseif (!(strcmp("PE", $row_DetailRS1['estado']))) {echo "Pernambuco";} 
                elseif (!(strcmp("PI", $row_DetailRS1['estado']))) {echo "Piauí";} 
                elseif (!(strcmp("RJ", $row_DetailRS1['estado']))) {echo "Rio de Janeiro";} 
                elseif (!(strcmp("RN", $row_DetailRS1['estado']))) {echo "Rio Grande do Norte";} 
                elseif (!(strcmp("RS", $row_DetailRS1['estado']))) {echo "Rio Grande do Sul";} 
                elseif (!(strcmp("RO", $row_DetailRS1['estado']))) {echo "Rondônia";} 
                elseif (!(strcmp("RR", $row_DetailRS1['estado']))) {echo "Roraima";} 
                elseif (!(strcmp("SC", $row_DetailRS1['estado']))) {echo "Santa Catarina";}
                elseif (!(strcmp("SP", $row_DetailRS1['estado']))) {echo "São Paulo";} 
                elseif (!(strcmp("SE", $row_DetailRS1['estado']))) {echo "Sergipe";} 
                elseif (!(strcmp("TO", $row_DetailRS1['estado']))) {echo "Tocantins";} ?>
 		</div> 
		<div class="form_cell_right" style="width:180px;">
        	<strong>CEP:</strong><?php echo $row_DetailRS1['cep']; ?></div>                   
	</div>  
    <div>
    	<div class="form_cell" style="width:132px;">
        	<strong>Telefone:</strong><?php echo $row_DetailRS1['fone_empresa']; ?></div>
        <div class="form_cell" style="width:122px;">
        	<strong>Celular:</strong><?php echo $row_DetailRS1['celular']; ?></div>
        <div class="form_cell" style="width:161px;">
        	<strong>Email:</strong><?php echo $row_DetailRS1['email']; ?></div>
        <div class="form_cell_right" style="width:195px;">
        	<strong>Pagamento:</strong>
				<?php if (!(strcmp("MONITORAMENTO", $row_DetailRS1['grupo']))) {echo "Monitoramento";}
                elseif (!(strcmp("BOLETO S/ NOTA", $row_DetailRS1['grupo']))) {echo "Boleto S/ Nota";} 
                elseif (!(strcmp("DIRETA S/ NOTA", $row_DetailRS1['grupo']))) {echo "Direta S/ Nota";} 
                elseif (!(strcmp("BOLETO C/ NOTA", $row_DetailRS1['grupo']))) {echo "Boleto C/ Nota";} 
                elseif (!(strcmp("DIRETA C/ NOTA", $row_DetailRS1['grupo']))) {echo "Direta C/ Nota";} 
                elseif (!(strcmp("OUTROS", $row_DetailRS1['grupo']))) {echo "Outros";} ?>
        </div>
    </div>
    <div>
    	<div class="form_cell_bot" style="width:610px;">
		<?php if ($_SESSION['MM_UserGroup'] != 2){?><a href="#Apagar" onClick="del('<?php echo $row_DetailRS1['id']; ?>','<?php echo $row_DetailRS1['nome']; ?>')">Excluir Cliente</a> - <a href="add_c.php?mode=edd&RecordID=<?php echo $row_DetailRS1['id']; ?>">Editar Cliente</a> - <a href="#" onClick="window.print(); return false;">Imprimir</a> - <?php }?><a href="<?php echo getUrl() ?>">Voltar</a>    
        </div>
    </div>
         
</div>
</div></body>
</html>
<?php
mysql_free_result($config);
mysql_free_result($DetailRS1);
?>
