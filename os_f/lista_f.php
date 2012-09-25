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

$query_Recordset1 = sprintf("SELECT id_equipamento, DATE_FORMAT(dt_entrada,'%s') as D_Entrada, id_cliente, st_defeito, id_funcionario FROM ordemservico WHERE 1=1 ORDER BY dt_entrada DESC", '%d/%m/%Y', $query_where);

$db->query('select count(id_equipamento) as Total from ordemservico' . $query_where);
$rows = $db->resultado();
$nav->setTotalRows($db->linhas());

$query_limit_Recordset1 = $query_Recordset1 . $nav->getLimit();
$db->query($query_limit_Recordset1);
$row_Recordset1 = $db->resultado();

setUrl($_SERVER["PHP_SELF"], $_SERVER['QUERY_STRING']);
?>

<?php echo $nav->getPaginacao(); ?>
<div class="container">
    <div class="li_tab" id="li_tab">
        <div class="li_row" id="li_row_title">
            <div class="li_cell_1" style="min-width:135px">Cliente</div>
            <!--        <div class="li_cell_1" style="min-width:40px">id</div>-->
            <div class="li_cell_2">Problema</div>
            <div class="li_cell_1" style="min-width:70px">Abertura</div>
            <div class="li_cell_1" style="min-width:70px">Fechamento</div>
            <div class="li_cell_1" style="min-width:50px">Valor</div>        
            <div class="li_cell_1" style="min-width:50px">Pago</div>
            <div class="li_cell_1" style="min-width:30px"></div>
        </div> 
        <?php if ($nav->getTotalRows() > 0) do { ?>    
                <div class="li_row" id="li_row" onDblClick="window.location = 'visualiza_f?recordID=<?php echo $row_Recordset1['id_equipamento']; ?>&page=<?php echo $pageNum_Recordset1; ?>'">
                    <div class="li_cell_1" style="min-width:135px"><?php echo $row_Recordset1['Cliente']; ?></div>
            <!--        <div class="li_cell_1" style="min-width:40px"><?php echo $row_Recordset1['Cod_Cliente']; ?></div>-->
                    <div class="li_cell_2"><?php echo $row_Recordset1['Problemacliente']; ?></div>
                    <div class="li_cell_1" style="min-width:70px"><?php echo $row_Recordset1['D_Entrada']; ?></div>        
                    <div class="li_cell_1" style="min-width:70px"><?php echo $row_Recordset1['Fechamento']; ?></div>
                    <div class="li_cell_1" style="min-width:50px"><?php echo $row_Recordset1['valor']; ?></div>        
                    <div class="li_cell_1" style="min-width:50px"><?php echo $row_Recordset1['valor_pago']; ?></div>
                    <div class="li_cell_1" style="min-width:30px"><a href="../os_a/fecha_a?mode=edd&recordID=<?php echo $row_Recordset1['id_equipamento']; ?>" title="Adicionar Pagamento"><img src="../Imagens/add_pagamento.png" width="30" height="14"/></a></div>
                </div> 
            <?php } while ($row_Recordset1 = $db->resultado()) ?>    
    </div>
</div>
</body>
</html>