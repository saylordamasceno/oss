<?php
require_once('../includes/functions.php');
require_once('../includes/header.php');
require_once('../includes/menudrop.php');
$pagina = 'Editar OS';

$editFormAction = $_SERVER['PHP_SELF'];
$db = new db();
if ((isset($_POST["MM_Update"])) && ($_POST["MM_Update"] == "form1")) {
    $entrada = isset($_POST['Data_Entrada']) ? $_POST['Data_Entrada'] : $_POST['Data_Entrada1'];
    $entrada = explode('/', $entrada);
    $entrada = array_reverse($entrada);
    $entrada = implode('-', $entrada);
    if (date($entrada) > date('Y-m-d')) {
        $agenda = '1';
        $hora = ' 18:00:00';
    } else {
        $agenda = '0';
        $hora = date(' H:i:s');
    }
    $entrada .= $hora;

    $updateSQL = sprintf("UPDATE ordemservico SET usuarios=%s, Equipamento=%s, Marca=%s, Garantia=%s, Problemacliente=%s, F_Pgto=%s, Entrada=%s, Agenda=%s WHERE id_equipamento=%s", GetSQLValueString($_POST['usuarios'], "text"), GetSQLValueString($_POST['Equipamento'], "text"), GetSQLValueString($_POST['Marca'], "text"), GetSQLValueString($_POST['Garantia'], "text"), GetSQLValueString($_POST['Problemacliente'], "text"), GetSQLValueString($_POST['F_Pgto'], "text"), GetSQLValueString($entrada, "text"), GetSQLValueString($agenda, "text"), GetSQLValueString($_POST['Id_Os'], "text"));

    $db->query($updateSQL);

    header(sprintf("Location: %s", getUrl()));
}

if (isset($_GET['recordID'])) {
    $Cod_OS = $_GET['recordID'];
} else
    header(sprintf("Location: %s", getUrl()));

$db->query("SELECT DATE_FORMAT(dt_entrada,'%d/%m/%Y') as D_Entrada,ordemservico.*, usuarios.*,cliente.*, equipamento.* FROM ordemservico,cliente,usuarios,equipamento WHERE ordemservico.id =$Cod_OS");
$os = $db->resultado();
print_r($os);
//$db = new db_cliente();
//$db->comId($os);
//$cliente = $db->resultado();
//print_r($cliente);
$db->query("SELECT * FROM equipamento");

while ($dados = $db->resultado()) {
    $equipamentos[] = $dados;
}

$user = strtoupper($os['usuarios']);
?>

<body onLoad="setFocus('Problemacliente')">
<html>
    <body>
        <div class="container">
            <legend>Nova ordem de serviço</legend>
            <form class="form-horizontal" action="<?= $editFormAction; ?>" method="post" name="form1" id="form1">    
                <div class="control-group">
                    <label class="control-label" for="dt_entrada">Entrada</label>
                    <div class="controls">
                        <input name="dt_entrada" type="text" class="select" value="<?= date('Y/m/d H:i:s') ?>" readonly />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="dt_saida">Saida</label>
                    <div class="controls">
                        <input id="datepicker" name="dt_saida" type="text" class="select" value="<?= date('Y/m/d H:i:s') ?>" readonly />
                    </div>
                </div>                
                <div class="control-group">
                    <label class="control-label" for="cliente">Cliente</label>
                    <div class="controls">            
                        <div class="input-append">
                            <input name="id_funcionario" type="hidden" value="<?= $id_funcionario ?>" />
                            <input name="id_cliente" type="hidden" id=id_cliente" value="<?= $id_cliente; ?>" />
                            <input name="cliente" type="text" id="Cliente" class="required" title="Campo Requerido." value="<?= $nome_cliente; ?>" <?= $nome_cliente == '' ? '' : 'Readonly'; ?> />
                        </div>            
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="id_equipamento">Equipamento</label>
                    <div class="controls">
                        <select name="id_equipamento" id="Equipamento">
                            <? foreach ($equipamentos as $equipamento) { ?>
                                <option value="<?= $equipamento['id'] ?>"><?= $equipamento['modelo'] . '-' . $equipamento['identificacao'] ?></option>
                            <? } ?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="st_defeito">Defeito</label>
                    <div class="controls">
                        <textarea name="st_defeito" rows="3" id="Problemacliente" class="required"></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="st_defeito">Soluçao</label>
                    <div class="controls">
                        <textarea name="st_defeito" rows="3" id="Problemacliente" class="required"></textarea>
                    </div>
                </div>                
                <div class="form-actions">
                    <button class="btn btn-primary" type="submit" name="envia_os">Salvar</button>
                    Ou <a href='visualiza_e?recordID=<?= $C_Result['id'] ?>'>Voltar</a>      
                    <input type="hidden" name="MM_insert" value="form1" />
                </div>    
            </form>
        </div>
    </body>
</html>