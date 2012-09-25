<?php
require_once('../includes/functions.php');
require_once('../includes/header.php');
require_once('../includes/menudrop.php');
$pagina = 'Troca de Senha';
$error_msg = '';

$editFormAction = $_SERVER['PHP_SELF'];

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
    $db = new db();
    $db->query(sprintf("SELECT * FROM usuarios WHERE email='%s'", $_SESSION['MM_Username']));
    $pass = $db->result(0, 'senha');
    $usu = $db->result(0, 'email');
    $cod = $db->result(0, 'id');
    if($pass != $_POST['Senha_Ant']){
        $error_msg = 'Ops! Senha antiga não confere, tente novamente.';
    }elseif($_POST['Senha_Nova'] != $_POST['Senha_Conf']) {
        $error_msg = 'Ops! A confirmação de senha não confere, tente novamente.';
    }else{
        $db->query(sprintf("UPDATE usuarios SET senha=%s WHERE id=%s", GetSQLValueString($_POST['Senha_Nova'], "text"), GetSQLValueString($cod, "int")));
        $updateGoTo = "visualiza_os.php";
        header(sprintf("Location: %s", $updateGoTo));
    }
}
?>

<html>
    <body>
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/os/inicio">Home</a> <span class="divider">/</span></li>
                <li><a href="/os/usuarios/lista_f">Funcionarios</a> <span class="divider">/</span></li>
                <li class="active">Nova senha</li>
            </ul>            
            <form class="form-horizontal" action="<?=$editFormAction; ?>" method="POST" name="form1" id="form1" >
                <legend>
                    Alteraçao de senha de <?=$_SESSION['MM_Username'];?>
                </legend>
                <div class="control-group">
                    <div class="controls">
                        <? if ($error_msg) { ?>
                            <div class="alert alert-error"><strong></strong><?= $error_msg ?></div>
                        <? } ?>
                    </div>                    
                </div>            
                <div class="control-group">
                    <label class="control-label" for="id_cliente">Senha Antiga</label>
                    <div class="controls">            
                        <div class="input-append">
                            <input placeholder="Senha Antiga" name="Senha_Ant" type="password" class="required" id="Senha_Ant" maxlength="10" title="Campo Requerido." />
                        </div>            
                    </div>
                </div>            
                <div class="control-group">
                    <label class="control-label" for="id_cliente">Senha Nova</label>
                    <div class="controls">            
                        <div class="input-append">
                            <input placeholder="Senha Nova" name="Senha_Nova" type="password" class="required" id="Senha_Nova" maxlength="10" title="Campo Requerido." />
                        </div>            
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="id_cliente">Confirma Senha</label>
                    <div class="controls">            
                        <div class="input-append">
                            <input placeholder="Confirma Senha" name="Senha_Conf" type="password" class="required" id="Senha_Conf" maxlength="10" title="Campo Requerido." />
                        </div>            
                    </div>
                </div>        
                <div class="form-actions">
                    <button type="submit" name="button" class="btn btn-primary">Salvar</button>
                    Ou <a href='visualiza_e?recordID=<?= $equipamento['id'] ?>'>Voltar</a>
                    <input type="hidden" name="MM_update" value="form1" />
                    <input type="hidden" name="id" value="<?php echo $row_Recordset1['id']; ?>" />
                </div>
            </form>
        </div>
    </body>
</html>
