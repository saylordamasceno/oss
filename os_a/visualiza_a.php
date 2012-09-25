<?php require_once('../includes/functions.php');

$pagina = 'Visualiza OS';

if (isset($_GET['recordID'])) {
  $Cod_OS = $_GET['recordID'];
} else header(sprintf("Location: %s", getUrl()));

$db = new db();
$db->query("SELECT * FROM ordemservico WHERE id_equipamento = $Cod_OS");
$os = $db->resultado();
print_r($os);
echo "SELECT * FROM equipamento WHERE id = ".$os['id_equipamento'];
$db->query("SELECT * FROM equipamento WHERE id = ".$os['id_equipamento']);
$equipamentos = $db->resultado();


include('../includes/header.php');

if (!isset($_GET['mode']))
    include('../includes/menudrop.php');?>
<div class="form_tab_visualiza_abos">
        <div class="row_title_up">
            <div class="form_cell_title" style="width:610px;"><strong>ORDEM DE SERVIÇO - No. <?=$Cod_OS ?></strong></div>
        </div>
        <div>
            <div class="form_cell" style="width:165px;"><strong>Usuário</strong><?=$os['usuarios']; ?></div>
            <div class="form_cell" style="width:160px;"><strong>Data Entrada:</strong><?=$os['D_Entrada']; ?></div>
            <div class="form_cell" style="width:135px;"><strong>Hora Entrada:</strong><?=$os['H_Entrada']; ?></div>
            <div class="form_cell" style="width:150px;"><strong>F. Pgto:</strong><?=$os['F_Pgto']; ?></div>            
        </div> 
        <div class="row_title">
            <div class="form_cell_title" style="width:610px;"><strong>Dados do Cliente</strong></div>
        </div>  
        <div> 
            <div class="form_cell" style="width:425px;"><strong>Cliente:</strong><?=$os['Cliente']; ?></div>
            <div class="form_cell" style="width:185px;"><strong>Contatos:</strong><?=$os['celular']."/ ".$os['fone_empresa']; ?></div>
        </div> 
        <div> 
            <div class="form_cell" style="width:610px;"><strong>Endereço:</strong><?=$os['endereco']; ?></div>
        </div> 
        <div> 
            <div class="form_cell" style="width:275px;"><strong>Bairro:</strong><?=$os['bairro']; ?></div>
            <div class="form_cell" style="width:150px;"><strong>Cidade:</strong><?= $os['cidade']; ?></div>
            <div class="form_cell" style="width:100px;"><strong>Estado:</strong><?=$os['estado']; ?></div>
            <div class="form_cell" style="width:85px;"><strong>CEP:</strong><?=$os['cep']; ?></div>
        </div>  
        <div class="row_title"> 
            <div class="form_cell_title" style="width:610px;"><strong>Dados do Equipamento</strong></div>
        </div> 
        <div> 
            <div class="form_cell" style="width:610px;"><strong>Equipamento:</strong><?=$equipamentos['modelo']; ?></div>
        </div>  
        <div> 
            <div class="form_cell" style="width:610px;"><strong>Diagnostico do Cliente:</strong><?=$os['Problemacliente'].$Cod_Os; ?></div>
        </div>                                 
</div>
        <div> 
            <div align="center">

        <?php if (!isset($_GET['mode'])){?>

                <?php if(($os['usuarios'] == strtoupper($_SESSION['MM_Username'])) || (isAdm())) { ?>
                    <a href="edd_a.php?recordID=<?=$Cod_OS ?>">Editar OS</a>&nbsp;-<?php } if (isAdm()){ ?>&nbsp;
                    <a href="fecha_a.php?recordID=<?=$Cod_OS ?>">Fechar OS</a>&nbsp;-&nbsp;<a href="#Apagar" onClick="delOS('<?=$Cod_OS; ?>')">Excluir OS</a>&nbsp;-&nbsp;
                    <a href="visualiza_a.php?recordID=<?=$Cod_OS ?>&mode=imp">Imprimir</a>&nbsp;-&nbsp;<?php }?>    
                <?php }
                    if (!isset($_GET['mode'])){ ?>
                    <a href="<?=getUrl(); ?>" >Voltar</a>
                <?php }else{ ?>
                    <a href="visualiza_a?recordID=<?=$Cod_OS; ?>" >Voltar</a> <?php }?>            

        </div>  
</div></body>
</html>
<?php
mysql_free_result($DetailRS1);
mysql_free_result($config);
?>
