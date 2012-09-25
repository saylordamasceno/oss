<?php 

//include('topo.php') 

?>

<div class="navbar">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand active" href="<?= urlDir('os_a/lista_a'); ?>">We Care</a>
            <div class="nav-collapse">
                <ul class="nav">
                    <li class="dropdown">
                        <a href='<?= urlDir('os_a/lista_a'); ?>' class="dropdown-toggle" data-toggle="dropdown">Ordens <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href='<?= urlDir('os_a/add_a'); ?>'><span>Nova</span></a></li>
                            <li><a href='<?= urlDir('os_a/lista_a'); ?>'><span>Ordens</span></a></li>
<!--                            <li><a href='<?= urlDir('os_f/lista_f'); ?>'><span>Fechadas</span></a></li>-->
<!--                            <li><a href='<?= urlDir('os_a/lista_a?mes=current'); ?>'><span>Mes atual</span></a></li>                            -->
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href='<?= urlDir('clientes/lista_c'); ?>' class="dropdown-toggle" data-toggle="dropdown">Clientes <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <?php if (isAdm()) { ?>
                                <li><a href='<?= urlDir('clientes/add_c'); ?>'><span>Novo</span></a></li>
                            <?php } ?>
                            <li><a href='<?= urlDir('clientes/lista_c'); ?>'><span>Clientes</span></a></li>
<!--                            <li><a href='<?= urlDir('clientes/lista_c'); ?>'><span>Inativos</span></a></li>-->
                            <li><a href='<?= urlDir('clientes/lista_e'); ?>'><span>Equipamentos</span></a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href='<?= urlDir('equipamentos/lista_e'); ?>' class="dropdown-toggle" data-toggle="dropdown">Equipamentos <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href='<?= urlDir('equipamentos/add_e'); ?>'><span>Novo</span></a></li>
                            <li><a href='<?= urlDir('equipamentos/lista_e'); ?>'><span>Equipamentos</span></a></li>
                        </ul>
                    </li>                                   
                </ul>
                <form class="navbar-search pull-left" id="form1" name="form1" method="get" action="">
                    <input class="search-query span2" placeholder="Busca" type="text" name="str_busca" id="str_busca"  class="select" value="<?php echo $_GET['str_busca'] ?>">
<!--                    <input type="text" class="search-query span2" placeholder="Search">-->
                </form>
                <ul class="nav pull-right">
                <?php
                    require_once("../includes/functions.php");
                    $db = new db();
                    $db->query("SELECT COUNT(id) FROM ordemservico");
                ?>
                    <li><a href="<?=urlDir('os_a/lista_a'); ?>" title="Clique para listar as Ordens Abertas">Ordens Abertas:<strong><?=$db->linhas() ?></strong></a></li>
                    <li class="divider-vertical"></li>
                    <li class="dropdown">
                        <a href='<?= urlDir('sistema/dados_empresa'); ?>' class="dropdown-toggle" data-toggle="dropdown"></i><?=$_SESSION['MM_USER']?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                        <?php if (isAdm()) { ?>
                            <li><a href='<?= urlDir('sistema/dados_empresa'); ?>'><span>We Care</span></a></li>
                            <li><a href='<?= urlDir('usuarios/lista_f'); ?>'><span>Funcionários</span></a></li>
                            <li><a href='<?= urlDir('usuarios/add_f'); ?>'><span>Novo funcionário</span></a></li>
                        <?php } ?>
                        <li><a href='<?= urlDir('usuarios/edd_pass'); ?>'><span>Alterar senha</span></a></li>
                        <li><a href='<?= urlDir('sistema/logout'); ?>'><span>Sair</span></a></li>
                        </ul>
                    </li>     
                </ul>
            </div><!-- /.nav-collapse -->
        </div>
    </div><!-- /navbar-inner -->
</div>
<div id="colCentral">