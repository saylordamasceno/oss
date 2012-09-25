<?php
require_once('../includes/config.php');
require_once("../includes/functions.php");
require_once('../includes/header.php');
require_once('../includes/menudrop.php');
$Get_Mode = $_GET['mode'];
setUrl($_SERVER["PHP_SELF"], $_SERVER['QUERY_STRING']);
$db = new db();
$db->query("
    SELECT equipamento.*,equipamento_cliente.identificacao,categoria.nome
    FROM equipamento
    INNER JOIN categoria ON (equipamento.id_categoria = categoria.id)
    INNER JOIN equipamento_cliente ON (equipamento.id = equipamento_cliente.id_equipamento)
    ORDER BY equipamento.id DESC");
$equipamento = $db->resultado();
$count_row = $db->linhas();
?>
<html>
    <body>
        <div class="container">
        <? include('add_e.php') ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>Tipo</td>
                    <td>Modelo</td>
                </tr>
            </thead>
            <tbody>
            <form id="form1" name="form1" method="get" action="<?= $action_form ?>">
                <?php if ($count_row > 0) do { ?>    
                    <td><?= $equipamento['nome']; ?></td>
                    <td><?= $equipamento['modelo']; ?></td>
                    <td><a href="visualiza_e?recordID=<?= $equipamento['id']; ?>"><i class="icon-search"></i></a></td>
                    <td class="li_cell_1" style="min-width:25px"><a href="#Apaga Usuário" onclick="delUSU(<?= $equipamento['id']; ?>,'<?= $equipamento['login']; ?>')" ><i class="icon-remove"></i></a></td>        
                    </td>   
                <?php } while ($equipamento = $db->resultado()) ?>  
            </form>
            </tbody>
        </table>    
    </body>
</html>