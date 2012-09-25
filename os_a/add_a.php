<?php
require_once('../includes/config.php');
require_once('../includes/functions.php');
require_once('../includes/header.php');
require_once('../includes/menudrop.php');
$pagina = 'Adicionar OS';
$editFormAction = $_SERVER['PHP_SELF'];

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
    $id_cliente = $_POST['id_cliente'];
    $nome_cliente = $_POST['cliente'];
    $entrada = isset($_POST['dt_entrada']) ? $_POST['dt_entrada'] : date('Y/m/d H:i:s');
    $db = new db();
    $db->query(sprintf("INSERT INTO ordemservico(id_funcionario, dt_entrada, id_cliente, id_equipamento, st_defeito) VALUES (%s, %s, %s, %s, %s)", GetSQLValueString($_POST['id_funcionario'], "text"), GetSQLValueString($entrada, "text"), GetSQLValueString($_POST['id_cliente'], "text"), GetSQLValueString($_POST['id_equipamento'], "text"), GetSQLValueString($_POST['st_defeito'], "text")));

    $url = urlDir() . 'os_a/lista_a.php';
//    header(sprintf("Location: %s", $url));
    echo "<script>window.location = '" . $url . "';</script>";
}

if (isset($_GET['recordID'])) {
    $db = new db();
    $db->query(sprintf("SELECT id, nome FROM cliente WHERE id = %s", GetSQLValueString($_GET['recordID'], "int")));
    $cliente = $db->resultado();
    $id_cliente = $cliente['id'];
    $nome_cliente = $cliente['nome'];
    $db = new db();
    $db->query("
            SELECT equipamento.*,equipamento_cliente.identificacao,categoria.nome
            FROM equipamento
            INNER JOIN categoria ON (equipamento.id_categoria = categoria.id)
            INNER JOIN equipamento_cliente ON (equipamento.id = equipamento_cliente.id_equipamento)
            WHERE equipamento_cliente.id_cliente = $id_cliente
            ORDER BY equipamento.id DESC");
    while ($dados = $db->resultado()) {
        $equipamentos[] = $dados;
    }
}

$id_funcionario = $_SESSION['MM_UserId'];
?>
<html>
    <body>
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/os/inicio">Home</a> <span class="divider">/</span></li>
                <li><a href="/os/os_a/lista_a">Ordens de Serviços</a> <span class="divider">/</span></li>
                <li class="active">Nova ordem de serviço</li>
            </ul>

            <legend>Nova ordem de serviço</legend>
            <form class="form-horizontal" action="<?= $editFormAction; ?>" method="post" name="form1" id="form1">    
                <div class="control-group">
                    <label class="control-label" for="dt_entrada">Data Entrada</label>
                    <div class="controls">
                        <input id="datepicker" name="dt_entrada" type="text" class="select" value="<?= date('Y/m/d H:i:s') ?>" readonly />
                    </div>
                </div>         
                <div class="control-group">
                    <label class="control-label" for="cliente">Cliente</label>
                    <div class="controls">            
                        <div class="input-append">
                            <input name="id_funcionario" type="hidden" value="<?= $id_funcionario ?>" />
                            <input name="id_cliente" type="hidden" id=id_cliente" value="<?= $id_cliente; ?>" />
                            <input name="cliente" type="text" id="Cliente" class="required" title="Campo Requerido." value="<?= $nome_cliente; ?>" <?= $nome_cliente == '' ? '' : 'Readonly'; ?> />
                            <!--                    <button class="btn" type="button" name="b_pesquisa" id="b_pesquisa" onClick="MM_openBrWindow('../clientes/lista_c?mode=add_os&b_busca=1&b_cliente='+$('Cliente').value,'Sistema',910,610)">Buscar</button>-->
                        </div>            
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="id_equipamento">Equipamento</label>
                    <div class="controls">
                        <select name="id_equipamento" id="comboboxEquipamento">
                            <option value="" selected=\"selected\"></option>
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
                <div class="form-actions">
                    <button class="btn btn-primary" type="submit" name="envia_os">Salvar</button>
                    Ou <a href='visualiza_e?recordID=<?= $C_Result['id'] ?>'>Voltar</a>      
                    <input type="hidden" name="MM_insert" value="form1" />
                </div>    
            </form>
            <?php
            if (!empty($cliente['id'])) {

                $db = new db();
                $db->query(sprintf("SELECT id_equipamento, DATE_FORMAT(dt_entrada,'%s') as D_Entrada, st_defeito, id_funcionario FROM ordemservico WHERE id_cliente = '%s'", '%d/%m/%Y', $id_cliente));
                $os = $db->resultado();
                $num_Rows_Recordset2 = $db->linhas();

                if ($num_Rows_Recordset2 > 0) {
                    ?>
                    <div align="center"> Outras OS Abertas para este Cliente: </div>
                    <div class="li_tab_rep" id="li_tab_rep" align="center">
                        <div cass="li_row" id="li_row_title">
                            <div class="li_cell_1" style="min-width:70px">Entrada</div>
                            <div class="li_cell_2">Problema</div>
                            <div class="li_cell_1" style="min-width:50px">Técnico</div>
                            <div class="li_cell_1" style="min-width:60px"></div>
                        </div>
                        <?php
                        do {
                            $Cont_Repeat = '';
                            $Cont_R = '';
                            if ($os['Repeat_os'] > 0) {
                                $Cont_Repeat = sprintf('&Repeat=%s', $os['Repeat_os']);
                                $Cont_R = sprintf('( %sX ) ', $os['Repeat_os']);
                            }
                            ?>    
                            <div cass="li_row" id="li_row">
                                <div class="li_cell_1" style="min-width:70px"><?= $os['D_Entrada']; ?></div>
                                <div class="li_cell_2"><?= $Cont_R . $os['problemacliente']; ?></div>
                                <div class="li_cell_1" style="min-width:50px"><?= $os['Tecnico']; ?></div>
                                <div class="li_cell_1" style="min-width:60px"><a href="../ajax/repete_os.php?recordID=<?= $os['id_equipamento'] . $Cont_Repeat; ?>">Repetir OS</a></div>
                            </div>
                            <?php
                        } while ($os = $db->resultado());
                    }
                    ?>    
                </div>
            <?php } ?>
        </div>
    </body>
</html>