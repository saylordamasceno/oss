<?php
require_once('../includes/functions.php');
require_once('../includes/header.php');
require_once('../includes/menudrop.php');
$modo = 0;
$id_categoria = 2;
$modo_ed = '';
$mod_bot = 'Adicionar Usuário';
$login_p = $_POST['nome'];
$insertGoTo = "lista_f";
$modo = !empty($_POST['mode']) ? 1 : 0;
$db = new db();
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
    if ($_POST['senha'] != $_POST['senha2']) {
        $user = $login_p;
        $erro = 'Ops! Confirmação de senha não conferem';
    } else {
        if ($modo == 1) {
            $db->query(sprintf("UPDATE usuarios SET senha=%s, id_categoria=%s WHERE id=%s", GetSQLValueString($_POST['senha'], "text", true), GetSQLValueString($_POST['id_categoria'], "text", true), GetSQLValueString($_POST['Id'], "text")));
            header(sprintf("Location: %s", $insertGoTo));
        } else {
            $db->query(sprintf('SELECT count(email) FROM usuarios WHERE UPPER(email)=%s', GetSQLValueString($_POST['email'], "text")));
            $C_Verif = $db->result(0, 'count(email)');
            if ($C_Verif < 1) {
                $db->query(sprintf("INSERT INTO usuarios (nome, email,senha, id_categoria) VALUES (%s, %s, %s, %s)", GetSQLValueString($login_p, "text", true), GetSQLValueString($_POST['email'], "text", true), GetSQLValueString($_POST['senha'], "text", true), GetSQLValueString($_POST['id_categoria'], "text")));
                header(sprintf("Location: %s", $insertGoTo));
            } else {
                $user = '';
                $erro = 'Ops! Este nome de usuário ja esta cadastrado no sistema.';
            }
        }
    }
} else {
    if (isset($_GET['mode'])) {
        $db->query(sprintf("SELECT login, email,senha, id_categoria FROM usuarios WHERE id=%s", GetSQLValueString($_GET['Id'], "text")));
        $user = $db->result(0, 'login');
        $email = $db->result(0, 'email');
        $pass = $db->result(0, 'senha');
        $id_categoria = $db->result(0, 'id_categoria');
        $modo_ed = 'readonly';
        $mod_bot = 'Editar Usuário';
    }
}
?>

<html>
    <body>
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/os/inicio">Home</a> <span class="divider">/</span></li>
                <li><a href="/os/usuarios/lista_f">Funcionarios</a> <span class="divider">/</span></li>
                <li class="active">Novo funcionario</li>
            </ul>                        
            <form class="form-horizontal" action="add_f" method="post" name="form1" id="form1">
                <legend>
                    Novo usuário
                </legend>
                <div class="control-group">
                    <div class="controls">
                        <? if ($erro) { ?>
                            <div class="alert alert-error"><strong></strong><?= $erro ?></div>
                        <? } ?>
                    </div>                    
                </div>            

                <div class="control-group">
                    <label class="control-label" for="id_categoria">Tipo</label>
                    <div class="controls">                            
                        <select name="id_categoria" id="id_categoria">
                            <option value="1" <?php if ($id_categoria == 1) echo "selected=\"selected\""; ?>>Administrador</option>
                            <option value="2" <?php if ($id_categoria == 2) echo "selected=\"selected\""; ?>>Operador</option>
                            <option value="3" <?php if ($id_categoria == 3) echo "selected=\"selected\""; ?>>Cliente</option>
                        </select>                
                    </div>            
                </div>

                <div class="control-group">
                    <label class="control-label" for="nome">Nome</label>
                    <div class="controls">            
                        <div class="form_cell" style="width: 140px;">
                            <input name="nome" type="text" class="required" id="login" maxlength="30" <?= $modo_ed; ?> value="<?= $user ?>" title="Campo Requerido." />
                        </div>            
                    </div>
                </div>                
                <div class="control-group">
                    <label class="control-label" for="email">E-mail</label>
                    <div class="controls">            
                        <div class="input-append">
                            <input name="email" type="text" class="required" id="login" maxlength="30" <?= $modo_ed; ?> value="<?= $email ?>" title="Campo Requerido." />
                        </div>            
                    </div>
                </div>            
                <div class="control-group">
                    <label class="control-label" for="senha">Senha</label>
                    <div class="controls">            
                        <div class="input-append">
                            <input name="senha" type="text" id="senha" maxlength="15" value="<?= $pass ?>" class="required" />
                        </div>            
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="senha2">Confirma Senha</label>
                    <div class="controls">            
                        <div class="input-append">
                            <input name="senha2" type="text" id="senha2" maxlength="15" class="required" value="<?= $pass ?>" />
                        </div>            
                    </div>
                </div>        
                <div class="form-actions">
                    <input type="submit" class="btn btn-primary" name="submit" value="<?= $mod_bot; ?>" />
                    Ou <a href='visualiza_e?recordID=<?= $equipamento['id'] ?>'>Voltar</a>      
                    <input type="hidden" name="Id" value="<?= $_GET['Id']; ?>" />
                    <input type="hidden" name="mode" value="<?= $_GET['mode']; ?>" />
                    <input type="hidden" name="MM_insert" value="form1" />
                </div>
            </form>
        </div>                          
        <div id="myResult"></div>
    </body>
</html>