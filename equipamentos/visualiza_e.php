<?php
require_once('../includes/config.php');
require_once('../includes/functions.php');
require_once('../includes/header.php');
require_once('../includes/menudrop.php');
$pagina = 'Visualiza Equipamento';

if (isset($_GET['pageNum_DetailRS1'])) {
    $pageNum_DetailRS1 = $_GET['pageNum_DetailRS1'];
}

$colname_DetailRS1 = "-1";
if(isset($_GET['recordID']))
    $colname_DetailRS1 = $_GET['recordID'];
$db = new db();
$db->query("SELECT id, tipo, modelo, descricao FROM equipamento WHERE id = ".$_GET['recordID']);
$equipamento = $db->resultado();
?>
<body>

    <div class="form_tab_Equipamentoadd">
        <div>
            <div class="form_cell" style="width:200px;">
                <input type="hidden" name="id" />
                <strong>Tipo:</strong><?= $equipamento['tipo']; ?></div>
            <div class="form_cell" style="width:200px;">
                <strong>Modelo:</strong><?= $equipamento['modelo']; ?></div>
            <div class="form_cell_right" style="width:200px;">
                <strong>Descriçao:</strong><?= $equipamento['descricao']; ?></div>
            <div>
                <div class="form_cell_bot" style="width:610px;">
                    <?php if ($_SESSION['MM_UserGroup'] != 2) { ?><a href="#Apagar" onClick="del('<?= $equipamento['id']; ?>','<?= $equipamento['tipo']; ?>')">Excluir Equipamento</a> - <a href="add_e.php?mode=edd&RecordID=<?= $equipamento['id']; ?>">Editar Equipamento</a> - <a href="#" onClick="window.print(); return false;">Imprimir</a> - <?php } ?><a href="<?= getUrl() ?>">Voltar</a>    
                </div>
            </div>
        </div>
    </div>
</body>
</html>