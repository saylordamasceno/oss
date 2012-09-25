<?php
include_once('../includes/functions.php');
include_once('../includes/nav2.php');
include_once('../includes/header.php');
if ($Get_Mode != 'add_os')
    include_once('../includes/menudrop.php');

$nav = new Navegacao($maxRowsList, 5);

$nav->setPagina($_GET['pagina']);

$pagina = 'Editar usuário';
$Get_Mode = $_GET['mode'];

if ($_GET['mode'] != 'add_os' || $_GET['mode'] != 'add_ec')
    setUrl($_SERVER["PHP_SELF"], $_SERVER['QUERY_STRING']);

$db = new db_cliente();

if ((isset($_GET['b_busca'])) && ( $_GET['b_conta'] != ""))
    $db->comId($_GET['b_conta']);
else if ((isset($_GET['b_busca'])) && ( $_GET['b_cliente'] != ""))
    $db->comNome($_GET['b_cliente']);

$db->buscar();
$cliente = $db->resultado();

$nav->setTotalRows($db->linhas());
?>
<html>
    <body>
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/os/inicio">Home</a> <span class="divider">/</span></li>
                <li class="active">Clientes</li>
            </ul>            
            <?= $nav->getPaginacao() ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>Nome</td>
                        <td>Endereço</td>
                        <td>Contatos</td>
                        <td></td>        
                    </tr>
                </thead>
                <tbody>
                <form id="form1" name="form1" method="get" action="<?= 'lista_c' . $add_os ?>">
                    <?php
                    if ($db->linhas() > 0)
                        do {
                            $add_os = '';
                            $fecha = '\'';
                            $click_visualiza = sprintf("visualiza_c?recordID=", $pageNum_Recordset1);
                            $click_event = "window.location = '../os_a/add_a?recordID=";
                            if (!empty($Get_Mode)) {
                                $add_os = '?mode=add_os';
                                $fecha = '\';window.close();';
                                $click_event = "window.opener.location = '../os_a/add_a?recordID=";
                            }
                            $click_event.= $cliente['id'] . $fecha;
                            $nome = $cliente['nome'];
                            ?>    
                    <td><?= $nome ?></td>
                                                <td><?= $cliente['endereco']; ?></td>
                            <td><?= $cliente['fone_empresa'] . " - " . $cliente['celular']; ?></td>
                            <td class="li_row" id="li_row_<?= $cliente['id'] ?>" ondblclick="<?= $click_event; ?>" title="Clique 2 vezes para adicionar uma OS para <?= $nome ?>">
                        <!--    	<td class="li_cell_1" style="min-width:40px"><?= $cliente['id']; ?></td>-->
                            

                            <td><?php if (empty($Get_Mode)) { ?>
                                    <a href="visualiza_c?recordID=<?= $cliente['id']; ?>"><img src="../Imagens/ico_visualiza.gif" title="Visualiza Cliente" /> </a> <?php } ?>
                            </td>        
                            </td>
                        <?php } while ($cliente = $db->resultado()) ?> 
                    <input name="mode" type="hidden" value="<?= $Get_Mode; ?>" />
                </form>
                </tbody>
            </table>   
            <?php if (isAdm() && $Get_Mode != 'add_os') { ?>
            <div class="form-actions">
                <ul id="contextmenu" >
                    <li><a href="#adiciona" class="copy">Abrir Ordem para o Cliente</a></li>
                    <li><a href="#edita" class="edit">Editar Cliente</a></li>
                    <li class="separator"><a href="#apagar" class="cut">Apagar Cliente</a></li>
                </ul>
                </div>
                <script type="text/javascript">
                    var context = new ContextMenu({
                        targets: 'td',
                        menu: 'contextmenu',
                        actions: {
                            adiciona: function(element,ref) {
                                if(element.getParent('td'))
                                    this.os_id = element.getParent('td').id.replace(/[\D]*/,'')
                                window.location.href = '../os_a/add_a?frommenu=1&recordID='+this.os_id;
                            },
                            edita: function(element,ref) {
                                if(element.getParent('td'))
                                    this.os_id = element.getParent('div').id.replace(/[\D]*/,'')
                                window.location.href = 'edd_c?mode=edd&frommenu=1&recordID='+this.os_id;
                            }, 
                            apagar: function(element,ref) {
                                if(element.getParent('div'))
                                    this.os_id = element.getParent('div').id.replace(/[\D]*/,'')
                                del(this.os_id,'');
                            }
                        }
                    });
                    context.enable();    
                </script>
            <?php } else { ?>
                <script type="text/javascript">
                    window.addEvent('domready', function() {
                        document.body.addEvent('contextmenu',function(e) {
                            e.stop();
                        });
                    });
                </script>
            <?php } ?>  
        </div>
    </body>
</html>