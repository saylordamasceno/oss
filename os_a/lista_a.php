<?php
include_once('../includes/functions.php');
include_once('../includes/nav2.php');
include_once('../includes/header.php');
include_once('../includes/menudrop.php');
$nav = new Navegacao($maxRowsList, 5);
$nav->setPagina($_GET['pagina']);

$pagina = 'Listagem OS';

if (empty($_GET['modo_busca']))
    $modo = 'Cliente';
else
    $modo = $_GET['modo_busca'];
$db = new db();
if (!empty($_GET['mes'])) {
    $mes = ($_GET['mes'] == 'current') ? date('m') : $_GET['mes'];
    $query_wher = " AND MONTH(dt_entrada) like $mes";
} elseif (!empty($_GET['agenda']))
    $query_where = " AND Agenda = '1'";

if ((isset($_GET['b_busca'])) || (isset($_GET['MM_insert'])))
    $query_where = sprintf(" AND %s LIKE %s ", $modo, GetSQLValueString($_GET['str_busca'], "like"));

$query_Recordset1 = sprintf("SELECT * FROM ordemservico WHERE 1=1 ORDER BY dt_entrada DESC", $query_where);

$db->query('select count(id_equipamento) as Total from ordemservico' . $query_where);
$rows = $db->resultado();
$nav->setTotalRows($db->linhas());

$query_limit_Recordset1 = $query_Recordset1 . $nav->getLimit();
$db->query($query_limit_Recordset1);
$os = $db->resultado();
print_r($os);

setUrl($_SERVER["PHP_SELF"], $_SERVER['QUERY_STRING']);
?>
<html>
    <body>
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/os/inicio">Home</a> <span class="divider">/</span></li>
                <li class="active">Ordens de Serviços</li>
            </ul>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>Entrada</th>
                        <th>Cliente</th>
                        <th>id</th>
                        <th>Problema</th>
                    </tr>
                </thead>
                <tbody>
                <form id="form1" name="form1" method="get" action="">    
                    <?= $nav->getPaginacao() ?>
                    <?php
                    if ($nav->getTotalRows() > 0)
                        do {
                            $id_os = $os['id_equipamento'];
                            $Tecnico = $os['Tecnico'];
                            $Cont_R = '';
                            ?>
                            <?php if (isAdm()) { ?>
                                <td>
                                    <a href="#Altera Técnico" type="0" onclick="Tecnico(<?= $id_os; ?>)"><i class="icon-user"></i><span id="OS_<?= $id_os; ?>"><?= $os['Tecnico']; ?></span></a>
                                    <a href="#" type="0" onclick="delOS(<?= $id_os; ?>)"><i class="icon-remove"></i></a>
                                    <a href="edd_a?frommenu=1&recordID=<?= $id_os; ?>"><i class="icon-edit"></i></a>
                                </td>
                            <?php } else { ?>
                                <td><?= $os['Tecnico']; ?></td>
                            <?php } ?>
                            <td><?= $os['D_Entrada']; ?></td>
                            <td><?= $os['id_cliente']; ?></td>
                            <td onDblClick="window.location = 'visualiza_a?recordID=<?= $os['id']; ?>&page=<?= $pageNum_Recordset1; ?>'" title="Clique 2 Vezes para Visualiza esta OS"><?= $os['id']; ?></td>

                            <td><?= $Cont_R . $os['st_defeito']; ?></td>
                            <td><?= $os['id_funcionario']; ?></td>
                        <?php } while ($os = $db->resultado()); ?>   
                    <input type="hidden" name="MM_insert" value="form1" />      
                </form>
                </tbody>
            </table>
        </div>
    </body>
</html>
