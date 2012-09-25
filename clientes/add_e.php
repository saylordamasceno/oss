<?php
$editFormAction = $_SERVER['PHP_SELF'];

if (isset($_SERVER['QUERY_STRING']))
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
    $db = new db();
    if (isset($_POST['id_equipamento'])) {
        $db->query(sprintf('SELECT id FROM equipamento WHERE modelo = %s', GetSQLValueString($_POST['id_equipamento'], "text")));
        $C_Verif = $db->linhas();
        $C_Cod = $db->result(0, 'id');
    }
    if (($C_Verif == 0) || ($_POST['id'] == $C_Cod)) {
        $db->query(sprintf("INSERT INTO equipamento_cliente (id_cliente,id_equipamento,identificacao) VALUES ( %s, %s)", GetSQLValueString($_POST['id_cliente']), GetSQLValueString($_POST['id_equipamento'], "int"), GetSQLValueString($_POST['identificacao'], "int")));
    }
}

if (!empty($_GET['mode'])) {
    $db = new db();
    $db->query('SELECT id, modelo, id_categoria FROM equipamento WHERE id=\'' . $_GET['RecordID'] . '\'', $data) or die(mysql_error());
    $equipamento = $db->resultado();
}

$db = new db();
$db->query("SELECT * FROM equipamento");
while ($dados = $db->resultado()) {
    $equipamentos[] = $dados;
}

$db = new db_cliente();
$db->buscar();
while ($dados = $db->resultado()) {
    $clientes[] = $dados;
}
?>

<html>
    <body>
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/os/inicio">Home</a> <span class="divider">/</span></li>
                <li><a href="/os/clientes/lista_c">Clientes</a> <span class="divider">/</span></li>
                <li class="active">Novo equipamento</li>
            </ul>
            <form class="form-horizontal" action="<?= $editFormAction; ?>" method="post" name="form1">
                <legend>Novo equipamento</legend>
                <div class="control-group">
                    <label class="control-label" for="id_cliente">Cliente</label>
                    <div class="controls">            
                        <div class="input-append">
                            <select name="id_cliente" id="comboboxCliente">
                                <option value="" selected=\"selected\"></option>
                                <? foreach ($clientes as $cliente) { ?>
                                    <option value="<?= $cliente['id_cliente'] ?>"><?= $cliente['nome'] ?></option>
                                <? } ?>
                            </select>                    
                        </div>            
                    </div>
                </div>    
                <div class="control-group">
                    <label class="control-label" for="id_equipamento">Equipamento</label>
                    <div class="controls">
                        <select name="id_equipamento" id="comboboxEquipamento">
                            <option value="" selected=\"selected\"></option>
                            <? foreach ($equipamentos as $equipamento) { ?>
                                <option value="<?= $equipamento['id_equipamento'] ?>"><?= $equipamento['modelo'] ?></option>
                            <? } ?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="identificacao">Identificaçao</label>
                    <div class="controls">
                        <input name="identificacao" type="text" class="select" id="modelo" placeholder="Identificaçao do equipamento" />
                    </div>
                </div>            
                <div class="form-actions">
                    <button class="btn btn-primary" type="submit" name="submit">Efetuar Cadastro</button>
                    Ou <a href='visualiza_e?recordID=<?= $equipamento['id'] ?>'>Voltar</a>      
                    <input type="hidden" name="MM_insert" value="form1" />
                </div>
            </form>
        </div>
    </body>
</html>