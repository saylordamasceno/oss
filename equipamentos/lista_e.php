<?php
require_once("../includes/functions.php");
require_once('../includes/header.php');
require_once('../includes/menudrop.php');
$Get_Mode = $_GET['mode'];
setUrl($_SERVER["PHP_SELF"], $_SERVER['QUERY_STRING']);
$db = new db();
$db->query("
    SELECT equipamento.*,categoria.nome
    FROM equipamento
    LEFT JOIN categoria ON (equipamento.id_categoria = categoria.id)
    ORDER BY id DESC");
$equipamento = $db->resultado();
$count_row = $db->linhas();
?>
<html>
    <body>
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/os/inicio">Home</a> <span class="divider">/</span></li>
                <li class="active">Equipamentos</li>
            </ul>                        
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Modelo</th>
                    </tr>
                </thead>
                <tbody>
                <form id="form1" name="form1" method="get" action="<?= $action_form ?>">
                    <?php if ($count_row > 0) do { ?>    
                        <tr>
                            <td><?= $equipamento['nome']; ?></td>
                            <td><?= $equipamento['modelo']; ?></td>
                            <td><a href="visualiza_e?recordID=<?= $equipamento['id']; ?>"><i class="icon-search"></i></a></td>
                            <td><a href="#Apaga Usuário" onclick="delUSU(<?= $equipamento['id']; ?>,'<?= $equipamento['login']; ?>')" ><i class="icon-remove"></i></a></td>        
                        </tr>
                    <?php } while ($equipamento = $db->resultado()) ?>    
                </form>
                </tbody>
            </table>    
        </div>
    </body>
</html>