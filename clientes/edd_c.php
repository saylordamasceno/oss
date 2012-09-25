<?php
require_once('../includes/config.php');
require_once('../includes/functions.php');
$pagina = 'Editar Cliente';

$editFormAction = $_SERVER['PHP_SELF'];
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
    $updateSQL = sprintf("UPDATE cliente SET nome=%s, cpf=%s, id=%s, email=%s, grupo=%s, fone_empresa=%s, celular=%s, endereco=%s, bairro=%s, cidade=%s, estado=%s, cep=%s WHERE id=%s", GetSQLValueString($_POST['nome'], "text"), GetSQLValueString($_POST['cpf'], "text"), GetSQLValueString($_POST['id'], "text"), GetSQLValueString($_POST['email'], "text"), GetSQLValueString($_POST['grupo'], "text"), GetSQLValueString($_POST['fone_empresa'], "text"), GetSQLValueString($_POST['celular'], "text"), GetSQLValueString($_POST['endereco'], "text"), GetSQLValueString($_POST['bairro'], "text"), GetSQLValueString($_POST['cidade'], "text"), GetSQLValueString($_POST['estado'], "text"), GetSQLValueString($_POST['cep'], "text"), GetSQLValueString($_POST['id'], "int"));

    mysql_select_db($database_data, $data);
    $Result1 = mysql_query($updateSQL, $data) or die(mysql_error());

    $updateSQL = sprintf("UPDATE ordemservico SET Cliente=%s, Cod_Cliente=%s WHERE Cod_Cliente=%s", GetSQLValueString($_POST['nome'], "text"), GetSQLValueString($_POST['id'], "text"), GetSQLValueString($_POST['conta_a'], "text"));

    mysql_select_db($database_data, $data);
    $Result2 = mysql_query($updateSQL, $data) or die(mysql_error());

    header(sprintf("Location: %s", getUrl()));
}

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Recordset1 = 1;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
    $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_data, $data);
$query_Recordset1 = sprintf("SELECT * FROM cliente WHERE id=%s", GetSQLValueString($_GET['recordID'], "text"));
$Recordset1 = mysql_query($query_Recordset1, $data) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
?>

<body>
<?php include('../includes/menudrop.php'); ?>

    <form action="<?php echo $editFormAction; ?>" method="POST" name="form1" id="form1" onSubmit="MM_validateForm('nome','','R','','NisEmail');return document.MM_returnVaalue">

        <div class="form_tab_clienteadd">
            <div>
                <div class="form_cell" style="width:325px;">
                    <input type="hidden" name="id" />
                    <strong>Nome:</strong><input name="nome" type="text" class="required" id="nome" value="<?php echo ucwords(strtolower($row_Recordset1['nome'])); ?>"/></div>
                <div class="form_cell" style="width:115px;">
                    <strong>id Nº</strong><input type="text" class="required" name="id" id="id" maxlength="4" onChange="javascript:this.value = leadZero(this.value,4);" value="<?php echo ucwords(strtolower($row_Recordset1['id'])); ?>"/></div>
                <div class="form_cell_right" style="width:170px;">
                    <strong>CPF/CNPJ:</strong><input type="text" class="select" name="cpf" id="cpf" maxlength="12" onKeyPress="formatar(this, '#########-##')" value="<?php echo ucwords(strtolower($row_Recordset1['cpf'])); ?>"/></div>
            </div>
            <div>
                <div class="form_cell" style="width:425px;">
                    <strong>Endereço:</strong><input name="endereco" type="text" class="select" id="endereco" value="<?php echo ucwords(strtolower($row_Recordset1['endereco'])); ?>"/></div>
                <div class="form_cell_right" style="width:185px;">
                    <strong>Bairro:</strong><input name="bairro" type="text" class="select" id="bairro" value="<?php echo ucwords(strtolower($row_Recordset1['bairro'])); ?>"/></div>
            </div>
            <div>
                <div class="form_cell" style="width:190px;">
                    <strong>Cidade:</strong><input name="cidade" type="text" class="select" id="cidade" value="<?php echo ucwords(strtolower($row_Recordset1['cidade'])); ?>"/></div>
                <div class="form_cell" style="width:240px;">
                    <strong>Estado:</strong>
                    <select name="estado" size="1" >
                        <option value="AC" <?php if (!(strcmp("AC", $row_Recordset1['estado']))) {
        echo "selected=\"selected\"";
    } ?>>Acre</option>
                        <option value="AL" <?php if (!(strcmp("AL", $row_Recordset1['estado']))) {
        echo "selected=\"selected\"";
    } ?>>Alagoas</option>
                        <option value="AP" <?php if (!(strcmp("AP", $row_Recordset1['estado']))) {
        echo "selected=\"selected\"";
    } ?>>Amapá</option>
                        <option value="AM" <?php if (!(strcmp("AM", $row_Recordset1['estado']))) {
        echo "selected=\"selected\"";
    } ?>>Amazonas</option>
                        <option value="BA" <?php if (!(strcmp("BA", $row_Recordset1['estado']))) {
        echo "selected=\"selected\"";
    } ?>>Bahia</option>
                        <option value="CE" <?php if (!(strcmp("CE", $row_Recordset1['estado']))) {
        echo "selected=\"selected\"";
    } ?>>Ceará</option>
                        <option value="DF" <?php if (!(strcmp("DF", $row_Recordset1['estado']))) {
        echo "selected=\"selected\"";
    } ?>>Distrito Federal</option>
                        <option value="ES" <?php if (!(strcmp("ES", $row_Recordset1['estado']))) {
        echo "selected=\"selected\"";
    } ?>>Espírito Santo</option>
                        <option value="GO" <?php if (!(strcmp("GO", $row_Recordset1['estado']))) {
        echo "selected=\"selected\"";
    } ?>>Goiás</option>
                        <option value="MA" <?php if (!(strcmp("MA", $row_Recordset1['estado']))) {
        echo "selected=\"selected\"";
    } ?>>Maranhão</option>
                        <option value="MT" <?php if (!(strcmp("MT", $row_Recordset1['estado']))) {
        echo "selected=\"selected\"";
    } ?>>Mato Grosso</option>
                        <option value="MS" <?php if (!(strcmp("MS", $row_Recordset1['estado']))) {
        echo "selected=\"selected\"";
    } ?>>Mato Grosso do Sul</option>
                        <option value="MG" <?php if (!(strcmp("MG", $row_Recordset1['estado']))) {
        echo "selected=\"selected\"";
    } ?>>Minas Gerais</option>
                        <option value="PA" <?php if (!(strcmp("PA", $row_Recordset1['estado']))) {
        echo "selected=\"selected\"";
    } ?>>Pará</option>
                        <option value="PB" <?php if (!(strcmp("PB", $row_Recordset1['estado']))) {
        echo "selected=\"selected\"";
    } ?>>Paraíba</option>
                        <option value="PR" <?php if (!(strcmp("PR", $row_Recordset1['estado']))) {
        echo "selected=\"selected\"";
    } ?>>Paraná</option>
                        <option value="PE" <?php if (!(strcmp("PE", $row_Recordset1['estado']))) {
        echo "selected=\"selected\"";
    } ?>>Pernambuco</option>
                        <option value="PI" <?php if (!(strcmp("PI", $row_Recordset1['estado']))) {
        echo "selected=\"selected\"";
    } ?>>Piauí</option>
                        <option value="RJ" <?php if (!(strcmp("RJ", $row_Recordset1['estado']))) {
        echo "selected=\"selected\"";
    } ?>>Rio de Janeiro</option>
                        <option value="RN" <?php if (!(strcmp("RN", $row_Recordset1['estado']))) {
        echo "selected=\"selected\"";
    } ?>>Rio Grande do Norte</option>
                        <option value="RS" <?php if (!(strcmp("RS", $row_Recordset1['estado']))) {
        echo "selected=\"selected\"";
    } ?>>Rio Grande do Sul</option>
                        <option value="RO" <?php if (!(strcmp("RO", $row_Recordset1['estado']))) {
        echo "selected=\"selected\"";
    } ?>>Rondônia</option>
                        <option value="RR" <?php if (!(strcmp("RR", $row_Recordset1['estado']))) {
        echo "selected=\"selected\"";
    } ?>>Roraima</option>
                        <option value="SC" <?php if (!(strcmp("SC", $row_Recordset1['estado']))) {
        echo "selected=\"selected\"";
    } ?>>Santa Catarina</option>
                        <option value="SP" <?php if (!(strcmp("SP", $row_Recordset1['estado']))) {
        echo "selected=\"selected\"";
    } ?>>São Paulo</option>
                        <option value="SE" <?php if (!(strcmp("SE", $row_Recordset1['estado']))) {
        echo "selected=\"selected\"";
    } ?>>Sergipe</option>
                        <option value="TO" <?php if (!(strcmp("TO", $row_Recordset1['estado']))) {
        echo "selected=\"selected\"";
    } ?>>Tocantins</option>
                    </select>          
                </div> 
                <div class="form_cell_right" style="width:180px;">
                    <strong>CEP:</strong><input name="cep" type="text" class="select" id="cep" onKeyPress="formatar(this, '#####-###')" value="<?php echo ucwords(strtolower($row_Recordset1['cep'])); ?>" maxlength="9"/></div>                   
            </div>  
            <div>
                <div class="form_cell" style="width:132px;">
                    <strong>Telefone:</strong><input type="text" class="select" name="fone_empresa" fone_empresa" maxlength="20" value="<?php echo ucwords(strtolower($row_Recordset1['fone_empresa'])); ?>"/></div>
                <div class="form_cell" style="width:122px;">
                    <strong>Celular:</strong><input type="text" class="select" name="celular" id="celular" maxlength="20" value="<?php echo ucwords(strtolower($row_Recordset1['celular'])); ?>" /></div>
                <div class="form_cell" style="width:161px;">
                    <strong>Email:</strong><input name="email" type="text" class="select"  id="email" value="<?php echo ucwords(strtolower($row_Recordset1['email'])); ?>"/></div>
                <div class="form_cell" style="width:195px;">
                    <strong>Pagamento:</strong>
                    <select name="grupo" size="1">
                        <option value="MONITORAMENTO" <?php if (!(strcmp("MONITORAMENTO", $row_Recordset1['grupo']))) {
    echo "selected=\"selected\"";
} ?>>Monitoramento</option>
                        <option value="BOLETO S/ NOTA" <?php if (!(strcmp("BOLETO S/ NOTA", $row_Recordset1['grupo']))) {
    echo "selected=\"selected\"";
} ?>>Boleto S/ Nota</option>
                        <option value="DIRETA S/ NOTA" <?php if (!(strcmp("DIRETA S/ NOTA", $row_Recordset1['grupo']))) {
    echo "selected=\"selected\"";
} ?>>Direta S/ Nota</option>
                        <option value="BOLETO C/ NOTA" <?php if (!(strcmp("BOLETO C/ NOTA", $row_Recordset1['grupo']))) {
    echo "selected=\"selected\"";
} ?>>Boleto C/ Nota</option>
                        <option value="DIRETA C/ NOTA" <?php if (!(strcmp("DIRETA C/ NOTA", $row_Recordset1['grupo']))) {
    echo "selected=\"selected\"";
} ?>>Direta C/ Nota</option>
                        <option value="OUTROS" <?php if (!(strcmp("OUTROS", $row_Recordset1['grupo']))) {
    echo "selected=\"selected\"";
} ?>>Outros</option>
                    </select>   
                </div>
            </div>
            <div>
                <div class="form_cell_bot" style="width:610px;">
                    <input type="submit" name="Submit" id="button" value="Edita Cliente" />
                </div>
            </div>
            <div>
                <div class="form_cell" style="width:180px;"></div>
            </div>
            <div>
                <div class="form_cell" style="width:180px;"></div>
            </div>            
        </div>
        <input type="hidden" name="MM_update" value="form1" />
        <input type="hidden" name="id" value="<?php echo $row_Recordset1['id']; ?>" />
    </form>
</body>
</html>
<?php
mysql_free_result($config);
mysql_free_result($Recordset1);
?>
