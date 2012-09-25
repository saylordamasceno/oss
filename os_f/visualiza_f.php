<?php require_once('../includes/functions.php');

$pagina = 'Impressão OS Fechada';

if (isset($_GET['recordID'])) {
  $Cod_OS = $_GET['recordID'];
} else header(sprintf("Location: %s", getUrl()));

$Monit = false;
$query_verif = sprintf('SELECT COUNT(id) as Count FROM cliente WHERE id = (SELECT cod_cliente FROM ordemservico WHERE id_equipamento=%s)',GetSQLValueString($Cod_OS, "text"));
$q_verif = mysql_query($query_verif,$data);
$Count = mysql_result($q_verif, 0);
if ( $Count != '0') $Monit = true;

if ($Monit)
    $query_DetailRS1 = sprintf("SELECT id_equipamento,DATE_FORMAT(Entrada,'%s') as D_Entrada,DATE_FORMAT(Entrada,'%s') as H_Entrada, DATE_FORMAT(Dataentrega,'%s') as Fechamento, usuarios,F_Pgto,Cliente, Equipamento, Problemacliente,  DiagnosticoTecnico, Solucao, material, mao_de_obra, valor_material, valor, valor_pago, Garantia, Tecnico, celular, cliente.endereco, cliente.fone_empresa, bairro, cidade, estado, cep  FROM ordemservico INNER JOIN  cliente ON ordemservico.Cliente = nome WHERE Cid_equipamento= %s", '%d/%m/%Y', '%H:%i', '%d/%m/%Y', GetSQLValueString($Cod_OS, "int"));
else
    $query_DetailRS1 = sprintf("SELECT id_equipamento,DATE_FORMAT(Entrada,'%s') as D_Entrada,DATE_FORMAT(Entrada,'%s') as H_Entrada, DATE_FORMAT(Dataentrega,'%s') as Fechamento, usuarios,F_Pgto,Cliente, Equipamento, Problemacliente,  DiagnosticoTecnico, Solucao,Material, mao_de_obra, valor_material, valor, valor_pago, Garantia, Tecnico, endereco, fone_empresa FROM ordemservico WHERE Cid_equipamento= %s", '%d/%m/%Y', '%H:%i', '%d/%m/%Y', GetSQLValueString($Cod_OS, "int")); 
       
$DetailRS1 = mysql_query($query_DetailRS1, $data) or die(mysql_error());
$row_DetailRS1 = mysql_fetch_assoc($DetailRS1);

?>
<?php include('../includes/header.php');?>
<body>
<div class="form_tab_visualiza_fchos">
        <div class="title">
	        <div class="form_cell_title" style="width:610px;">
            	<strong>RECIBO DE ENTREGA - No. <?php echo $row_DetailRS1['id_equipamento']; ?></strong><br />
            </div>
        </div>
        <div>
	        <div class="form_cell" style="width:150px;"><strong>Técnico</strong><?php echo $row_DetailRS1['Tecnico']; ?></div>
            <div class="form_cell" style="width:165px;"><strong>Data Entrada:</strong><?php echo $row_DetailRS1['D_Entrada']; ?></div>
            <div class="form_cell" style="width:135px;"><strong>Hora Entrada:</strong><?php echo $row_DetailRS1['H_Entrada']; ?></div>
            <div class="form_cell" style="width:160px;"><strong>Fechamento:</strong><?php echo $row_DetailRS1['Fechamento']; ?></div>            
		</div>  
        <div class="row_title">
        	<div class="form_cell_title" style="width:610px;"><strong>Dados do Cliente</strong></div>
        </div>  
        <div> 
        	<div class="form_cell" style="width:425px;"><strong>Cliente:</strong><?php echo $row_DetailRS1['Cliente']; ?></div>
            <div class="form_cell" style="width:185px;"><strong>Contatos:</strong><?php echo $row_DetailRS1['celular']."/ ".$row_DetailRS1['fone_empresa']; ?></div>
        </div> 
        <div> 
        	<div class="form_cell" style="width:610px;"><strong>Endereço:</strong><?php echo $row_DetailRS1['endereco']; ?></div>
        </div> 
        <div> 
        	<div class="form_cell" style="width:255px;"><strong>Bairro:</strong><?php echo $row_DetailRS1['bairro']; ?></div>
            <div class="form_cell" style="width:170px;"><strong>Cidade:</strong><?php echo  $row_DetailRS1['cidade']; ?></div>
            <div class="form_cell" style="width:100px;"><strong>Estado:</strong><?php echo $row_DetailRS1['estado']; ?></div>
            <div class="form_cell" style="width:85px;"><strong>CEP:</strong><?php echo $row_DetailRS1['cep']; ?></div>
        </div> 
        <div class="row_title"> 
        	<div class="form_cell_title" style="width:610px;"><strong>Dados do Serviço</strong></div>
        </div> 
        <div> 
        	<div class="form_cell" style="width:250px;"><strong>Equipamento:</strong><?php echo $row_DetailRS1['Equipamento']; ?></div>
            <div class="form_cell" style="width:150px;"><strong>Garantia:</strong><?php echo $row_DetailRS1['Garantia']; ?></div>         	
            <div class="form_cell" style="width:210px;"><strong>F. Pgto:</strong><?php echo $row_DetailRS1['F_Pgto']; ?></div>        	
        </div>  
        <div> 
        	<div class="form_cell" style="width:610px;"><strong>Diagnostico do Cliente:</strong><?php echo $row_DetailRS1['Problemacliente']; ?></div>
        </div> 
        <div> 
        	<div class="form_cell" style="width:610px;"><strong>Diagnostico do Técnico:</strong><?php echo $row_DetailRS1['DiagnosticoTecnico']; ?></div>
        </div>
        <div> 
        	<div class="form_cell" style="width:610px;"><strong>Solução:</strong><?php echo $row_DetailRS1['Solucao']; ?></div>
        </div>  
        <div> 
        	<div class="form_cell" style="width:610px;"><strong>Material:</strong><?php echo $row_DetailRS1['material']; ?></div>
        </div> 
        <div> 
        	<div class="form_cell" style="width:185px;"><strong>Total Mão de Obra:</strong>R$<?php echo $row_DetailRS1['mao_de_obra']; ?></div>
            <div class="form_cell" style="width:140px;"><strong>Total Material:</strong>R$<?php echo $row_DetailRS1['valor_material']; ?></div>
            <div class="form_cell" style="width:140px;"><strong>Total da OS:</strong>R$<?php echo $row_DetailRS1['valor']; ?></div>
            <div class="form_cell" style="width:145px;"><strong>Total Pago:</strong>R$<?php echo $row_DetailRS1['valor_pago']; ?></div>            
        </div>                                                  
        <div> 
        	<div class="form_cell_assina" style="width:305px;">_____________________<br /><strong>Assinatura do Técnico</strong></div>
            <div class="form_cell_assina" style="width:305px;">_____________________<br /><strong>Assinatura do Cliente</strong></div>
        </div>  
        <div> 
        	<div class="form_cell_centro" style="width:610px;"><strong>Obs</strong>:
          A garantia será válida mediante a apresentação desta ordem de serviço
          e será aplicada somente ao serviço prestado anteriormente, outros defeitos
          que o aparelho venha apresentar não será de responsabilidade da empresa
          contratada.</div>
        </div>        
        <div class="row_title"> 
        	<div class="form_cell_title" style="width:610px;">
            	<strong><?php echo $row_config['nome_fantasia']; ?></strong> - 
 				Fone: <?php echo $row_config['fone_loja']; ?><br />
        		<?php echo $row_config['endereco']; ?> - 
				<?php echo $row_config['bairro']; ?> - 
				<?php echo $row_config['cidade']; ?>/<?php echo $row_config['estado']; ?> - 
				Cep:<?php echo $row_config['cep']; ?><br /> 
				<?php echo $row_config['email']; ?> - <?php echo $row_config['site']; ?>
			</div>
        </div>   
</div>        
        	<div style="text-align:center;"><a href="<?php echo getUrl(); ?>">Voltar</a></div>
</div></body>
</html>
<?php
mysql_free_result($DetailRS1);
mysql_free_result($config);
?>
