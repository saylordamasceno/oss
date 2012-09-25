<?php
require_once('../includes/config.php');
require_once('../includes/functions.php');
require_once('../includes/header.php');
require_once('../includes/menudrop.php');
$pagina = 'Adicionar Equipamento';

$editFormAction = $_SERVER['PHP_SELF'];

if(isset($_SERVER['QUERY_STRING']))
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);

if((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")){
    $id_categoria = $_POST['id_categoria'];
    $db = new db();
    if (!trim($_POST['id_categoria']) && ($_POST['categoria'])){
        $db->query(sprintf("INSERT INTO categoria (fl_tipo, nome) VALUES (1, %s)", GetSQLValueString($_POST['categoria'], "text")));    
        $id_categoria = $db->result(0, 'id');
    }
    if (isset($_POST['modelo'])){   
        $db->query(sprintf('SELECT id FROM equipamento WHERE modelo = %s', GetSQLValueString($_POST['modelo'], "text")));
        $C_Verif = $db->linhas();
        $C_Cod = $db->result(0, 'id');
    }
    if (($C_Verif == 0) || ($_POST['id'] == $C_Cod)) {
        die($C_Verif.'--'.$C_Cod);
        if ($_POST['mode'] == 'edd') {
            $db->query(sprintf("UPDATE equipamento SET modelo=%s, id_categoria=%s WHERE id=%s", GetSQLValueString($_POST['modelo'], "text"), GetSQLValueString($id_categoria, "int"), GetSQLValueString($_POST['id'], "text")));
            ;
            header("Location: lista_e");
        } else {
            $db->query(sprintf("INSERT INTO equipamento (modelo, id_categoria) VALUES ( %s, %s)", GetSQLValueString($_POST['modelo'], "text"), GetSQLValueString($id_categoria, "int")));
            header("Location: lista_e");
        }
    }
}

if (!empty($_GET['mode'])) {
    $db = new db();
    $db->query('SELECT id, modelo, id_categoria FROM equipamento WHERE id=\'' . $_GET['RecordID'] . '\'', $data) or die(mysql_error());
    $equipamento = $db->resultado();
}
?>

<html>
    <body>
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/os/inicio">Home</a> <span class="divider">/</span></li>
                <li><a href="/os/equipamentos/lista_e">Equipamentos</a> <span class="divider">/</span></li>
                <li class="active">Novo equipamento</li>
            </ul>            
            <form class="form-horizontal" action="<?=$editFormAction; ?>" method="post" name="form1">
                <legend>Novo equipamento</legend>
                <div class="control-group">
                    <label class="control-label" for="modelo">Categoria</label>
                    <div class="controls">
                        <input type="hidden" name="id_categoria" value="<?= $equipamento['id_categoria'] ?>" />
                        <input name="categoria" type="text" class="required" id="categoria" placeholder="Categoria do equipamento" value="<?= $equipamento['id_categoria'] ?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="modelo">Modelo</label>
                    <div class="controls">
                        <input name="modelo" type="text" class="select" id="modelo" placeholder="Modelo do equipamento" value="<?= $equipamento['modelo'] ?>"/>        
                    </div>
                </div>            
                <div class="form-actions">
                    <button class="btn btn-primary" type="submit" name="submit">Efetuar Cadastro</button> Ou <a href='visualiza_e?recordID=<?= $equipamento['id'] ?>'>Voltar</a>      
                    <input type="hidden" name="MM_insert" value="form1" />
                </div>
            </form>
        </div>
    </body>
</html>