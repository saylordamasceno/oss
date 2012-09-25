<?php require_once('../includes/functions.php');

$pagina = 'Fechar OS';

$editFormAction = $_SERVER['PHP_SELF'];

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	if (!empty($_POST['valor'])) $valor = $_POST['valor']; else $valor = '0,00';
     
        $Fechamento = explode('/', $_POST['Data_Agenda']); 
        $Fechamento = array_reverse($Fechamento); 
        $Fechamento = implode('-', $Fechamento);

    $updateSQL = sprintf("UPDATE ordemservico SET usuarios=%s, Tecnico=%s, Dataentrega=%s, DiagnosticoTecnico=%s, Solucao=%s, material=%s, mao_de_obra=%s, valor_material=%s, F_Pgto=%s, valor=%s, valor_pago=%s, Garantia=%s, Arquivo ='s', Agenda ='0' WHERE id_equipamento=%s",
        GetSQLValueString($_POST['usuarios'], "text"),
        GetSQLValueString($_POST['Tecnico'], "text"),
        GetSQLValueString($Fechamento, "text"),					   
        GetSQLValueString($_POST['DiagnosticoTecnico'], "text"),
        GetSQLValueString($_POST['Solucao'], "text"),
        GetSQLValueString($_POST['material'], "text"),
        GetSQLValueString($_POST['mao_de_obra'], "text"),
        GetSQLValueString($_POST['valor_material'], "text"),
        GetSQLValueString($_POST['F_Pgto'], "text"),
        GetSQLValueString($valor, "text"),
        GetSQLValueString($_POST['valor_pago'], "text"),
        GetSQLValueString($_POST['Garantia'], "text"),
        GetSQLValueString($_POST['id_equipamento'], "int"));

    $Result1 = mysql_query($updateSQL, $data) or die(mysql_error());
    header(sprintf("Location: %s", getUrl()));
}

if (isset($_GET['recordID'])) {
  $Cod_OS = $_GET['recordID'];
} else header(sprintf("Location: %s", getUrl()));

$Monit = false;
$query_verif = sprintf('SELECT COUNT(id) as Count FROM cliente WHERE id = (SELECT cod_cliente FROM ordemservico WHERE id_equipamento=%s)',GetSQLValueString($Cod_OS, "text"));
$q_verif = mysql_query($query_verif,$data);
$Count = mysql_result($q_verif, 0);
if ( $Count != '0') $Monit = true;

if ($Monit)
    $query_DetailRS1 = sprintf("SELECT id_equipamento,DATE_FORMAT(Entrada,'%s') as D_Entrada,DATE_FORMAT(Entrada,'%s') as H_Entrada, DATE_FORMAT(Dataentrega,'%s') as Fechamento, usuarios,F_Pgto,Cliente, Equipamento, Problemacliente,  DiagnosticoTecnico, Solucao,Material, mao_de_obra, valor_material, valor, valor_pago, Garantia, Tecnico, celular, cliente.endereco, cliente.fone_empresa, bairro, cidade, estado, cep  FROM ordemservico INNER JOIN  cliente ON ordemservico.Cliente = nome WHERE Cid_equipamento= %s", '%d/%m/%Y', '%H:%i', '%d/%m/%Y', GetSQLValueString($Cod_OS, "int"));
else 
    $query_DetailRS1 = sprintf("SELECT id_equipamento,DATE_FORMAT(Entrada,'%s') as D_Entrada,DATE_FORMAT(Entrada,'%s') as H_Entrada, DATE_FORMAT(Dataentrega,'%s') as Fechamento, usuarios,F_Pgto,Cliente, Equipamento, Problemacliente,  DiagnosticoTecnico, Solucao,Material, mao_de_obra, valor_material, valor, valor_pago, Garantia, Tecnico, endereco, fone_empresa  FROM ordemservico WHERE Cid_equipamento= %s", '%d/%m/%Y', '%H:%i', '%d/%m/%Y', GetSQLValueString($Cod_OS, "int"));
    
$DetailRS1 = mysql_query($query_DetailRS1, $data) or die(mysql_error());
$row_DetailRS1 = mysql_fetch_assoc($DetailRS1);

include('../includes/header.php');
include('../includes/menudrop.php');?>

<form action="<?php echo $editFormAction;?>" method="post" name="form1" id="form1">
<div class="form_tab_fechaos">
    <div>
        <div class="form_cell" style="width:465px;"><strong>Cliente:</strong><?php echo $row_DetailRS1['Cliente']; ?></div>
        <div class="form_cell_right" style="width:145px;"><strong>Técnico:</strong><input name="Tecnico" type="text" id="Tecnico" value="<?php echo $row_DetailRS1['Tecnico']; ?>" class="required" /></div> 
	</div> 
    <div>
		<div class="form_cell" style="width:275px;"><strong>Equipamento:</strong><?php echo $row_DetailRS1['Equipamento']; ?></div>    
        <div class="form_cell_right" style="width:205px;"><strong>Forma Pgto:</strong>
        	<select name="F_Pgto" size="1" onChange="Forma_Pgto=1">
            <option value="MONITORAMENTO" <?php if (!(strcmp("MONITORAMENTO", $row_DetailRS1['F_Pgto']))) {echo "selected=\"selected\"";} ?>>Monitoramento</option>              
            <option value="BOLETO S/ NOTA" <?php if (!(strcmp("BOLETO S/ NOTA", $row_DetailRS1['F_Pgto']))) {echo "selected=\"selected\"";} ?>>Boleto S/ Nota</option>
            <option value="DIRETA S/ NOTA" <?php if (!(strcmp("DIRETA S/ NOTA", $row_DetailRS1['F_Pgto']))) {echo "selected=\"selected\"";} ?>>Direta S/ Nota</option>
            <option value="BOLETO C/ NOTA" <?php if (!(strcmp("BOLETO C/ NOTA", $row_DetailRS1['F_Pgto']))) {echo "selected=\"selected\"";} ?>>Boleto C/ Nota</option>
            <option value="DIRETA C/ NOTA" <?php if (!(strcmp("DIRETA C/ NOTA", $row_DetailRS1['F_Pgto']))) {echo "selected=\"selected\"";} ?>>Direta C/ Nota</option>
            <option value="OUTROS" <?php if (!(strcmp("OUTROS", $row_DetailRS1['F_Pgto']))) {echo "selected=\"selected\"";} ?>>Outros</option>
            </select>
        </div>
 		<div class="form_cell_right" style="width:130px;"><strong>Garantia:</strong>
            <select name="Garantia" id="Garantia">
            <option value="NÃO"  <?php if (!(strcmp("NÃO", $row_DetailRS1['Garantia']))) {echo "selected=\"selected\"";} ?>>Não</option>
            <option value="SIM" <?php if (!(strcmp("SIM", $row_DetailRS1['Garantia']))) {echo "selected=\"selected\"";} ?>>Sim</option>
            </select>
		</div>
	</div>     
    <div>
        <div class="form_cell" style="width:203px;"><strong>Data Entrada:</strong><?php echo $row_DetailRS1['D_Entrada']; ?></div>
        <div class="form_cell_centro" style="width:204px;"><strong>Hora Entrada:</strong><?php echo $row_DetailRS1['H_Entrada']; ?></div>
		<div class="form_cell_right" style="width:203px;"><strong>Data Fechamento:</strong><input name="Data_Agenda" type="text" class="select" id="Data_Agenda" value="<?php echo isset($_GET['mode'])?$row_DetailRS1['Fechamento']:date("d/m/Y") ; ?>" readonly /></div>
	</div> 
    <div>
        <div class="form_cell" style="width:610px;"><strong>Diagnóstico do Cliente:</strong><?php echo $row_DetailRS1['Problemacliente']; ?></div>
	</div> 
    <div>
        <div class="form_cell" style="width:610px;"><strong>Diagnóstico do Técnico:</strong><br /><textarea name="DiagnosticoTecnico" rows="2" id="DiagnosticoTecnico" class="required" ><?php echo $row_DetailRS1['DiagnosticoTecnico']; ?></textarea></div>
	</div>
    <div>
        <div class="form_cell" style="width:610px;"><strong>Solução:</strong><br /><textarea name="Solucao" rows="2" id="Solucao" class="required" ><?php echo $row_DetailRS1['Solucao']; ?></textarea></div>
	</div> 
    <div>
        <div class="form_cell" style="width:610px;"><strong>Material:</strong><br /><textarea name="material" rows="2" id="material"><?php echo $row_DetailRS1['Material']; ?></textarea></div>
	</div>  
    <div>
        <div class="form_cell" style="width:185px;"><strong>Mão de Obra:R$</strong>
			<input class="valores" name="mao_de_obra" id="mao_de_obra" onkeypress=formataMoeda(this,'','.',event) value="<?php echo $row_DetailRS1['mao_de_obra']; ?>" /></div>
        <div class="form_cell" style="width:155px;"><strong>Material:R$</strong>
			<input class="valores" name="valor_material" id="valor_material" onkeypress=formataMoeda(this,'','.',event) value="<?php echo $row_DetailRS1['valor_material']; ?>" /></div>
        <div class="form_cell" style="width:135px;"><strong>Total:R$</strong>
			<input class="valores" name="valor" id="valor" readonly value="<?php echo $row_DetailRS1['valor']; ?>" /></div>
        <div class="form_cell_right" style="width:135px;"><strong>Pago:R$</strong>
			<input class="valores" name="valor_pago" id="valor_pago" onkeypress=formataMoeda(this,'','.',event) value="<?php echo $row_DetailRS1['valor_pago']; ?>" /></div>                                    
	</div>  
    <div>
        <div class="form_cell_bot" style="width:610px;">
              <input name="Arquivo" type="hidden" id="Arquivo" value="s" />
              <input name="id_equipamento" type="hidden" id="id_equipamento" value="<?php echo $Cod_OS; ?>" />
              <input type="submit" class="botao" name="b_fecha" id="b_fecha" value=" Fechar OS" onClick="Val_Fpgto(event)"/>
              <input type="reset" class="botao" name="b_limpa" id="b_limpa" value="Limpar Cadastro" />
              <br />
              <?php if (isset($_GET['mode']) || isset($_GET['frommenu'] )){?>
              	<a href="<?php echo getUrl();?>" >Voltar</a>
             <?php } else { ?>
			  	<a href="visualiza_a?recordID=<?php echo $Cod_OS; ?>" >Voltar</a>
			 
			 <?php }?>
        </div>     
</div>
<input type="hidden" name="MM_update" value="form1" />
</form>
</div></body>
</html>
<?php
mysql_free_result($config);
mysql_free_result($DetailRS1);
?>
