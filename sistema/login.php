<?php
include_once('includes/config.php');

$db = new db();
$db->query("SELECT nome FROM config");
$titulo = $db->result(0, 'nome');

if(!isset($_SESSION))
    session_start();

$loginFormAction = $_SERVER['PHP_SELF'];

if (isset($_POST['login'])) {
    $loginUsername = $_POST['login'];
    $password = $_POST['senha'];
    $MM_fldUserAuthorization = "id_categoria";
    $MM_redirectLoginSuccess = "os_a/lista_a";
    $MM_redirectLoginFailed = "index?erro=1";
    $MM_redirecttoReferrer = false;

    $db->query(sprintf("SELECT id, nome ,email, senha, id_categoria FROM usuarios WHERE email='%s' AND senha='%s'", $loginUsername, $password));
    $loginFoundUser = $db->resultado();
    if($db->linhas()>0){
        $_SESSION['MM_USER'] = $loginFoundUser['nome'];
        $_SESSION['MM_Username'] = $loginUsername;
        $_SESSION['MM_UserGroup'] = $loginFoundUser['id_categoria'];
        $_SESSION['MM_UserId'] = $loginFoundUser['id'];
        header("Location: " . $MM_redirectLoginSuccess);
    }else{
        header("Location: " . $MM_redirectLoginFailed);
    }
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
        <title><?php echo $titulo; ?> - Login</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="favicon.ico" />
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="screen" charset="utf-8" />    

        <script language="javascript" type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
        <script language="javascript" type="text/javascript" src="js/jquery-ui-1.8.23.custom.min.js"></script>     
        <script language="javascript" type="text/javascript" src="js/jquery.uniform.js"></script>    
        <script language="javascript" type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>            
    </head>
    <body>
        <div class="container">
            <legend>Acessar We Care OS</legend>
            <form class="form-horizontal" action="<?=$loginFormAction; ?>" method="post" name="form1" id="form1">
                <div class="control-group">
                    <div class="controls">
                        <?if(isset($_GET['erro'])){?>
                        <div class="alert alert-error"><strong>Ops!</strong> Senha ou Usuário Incorretos, verifique os dados digitados.</div>
                        <?}?>
                        <span class="help-block">Você deve fazer Login para acessar o sistema.</span>                    
                    </div>                    
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputEmail">E-mail</label>
                    <div class="controls">
                    <input type="text" id="inputEmail" placeholder="E-mail" name="login" type="text">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputPassword">Senha</label>
                    <div class="controls">
                    <input type="password" id="inputPassword" placeholder="Password" name="senha" type="password">
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <button class="btn" type="submit" name="submit">Enviar Login</button>
                    </div>
                </div>
            </form>
        </div>
        
    </body>
</html>