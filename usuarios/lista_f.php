<?php
require_once("../includes/functions.php");
require_once('../includes/header.php');
require_once('../includes/menudrop.php');
$Get_Mode = $_GET['mode'];
setUrl($_SERVER["PHP_SELF"], $_SERVER['QUERY_STRING']);
$db = new db();
$db->query("SELECT UPPER(nome) as login,UPPER(email) as email, senha,id, CASE id_categoria WHEN 1 THEN 'Administrador' WHEN 2 THEN 'Operador' WHEN 3 THEN 'Cliente'END as C_id_categoria FROM usuarios ORDER BY id DESC");
$usuario = $db->resultado();
?>
<html>
    <body>
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/os/inicio">Home</a> <span class="divider">/</span></li>
                <li class="active">Funcionarios</li>
            </ul>                        
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Usuário</th>
                        <th>E-mail</th>
                        <th>Nível</th>
                    </tr>
                </thead>
                <tbody>
                <form id="form1" name="form1" method="get" action="<?php echo $action_form ?>">
                    <?php if ($db->linhas() > 0) do { ?>     
                        <tr>
                            <td><?php echo $usuario['login']; ?></td>
                            <td><?php echo $usuario['email']; ?></td>
                            <td><?php echo $usuario['C_id_categoria']; ?></td>
                            <td><a href="add_f?mode=edd&Id=<?php echo $usuario['id']; ?>"><i class="icon-search"></i></a></td>
                            <td><a href="#Apaga Usuário" onclick="delUSU(<?php echo $usuario['id']; ?>,'<?php echo $usuario['login']; ?>')" ><i class="icon-remove"></i></a></td>        
                        </tr>
                    <?php } while ($usuario = $db->resultado()) ?>    
                </form>
                </tbody>
            </table>    
        </div>
    </body>
</html>