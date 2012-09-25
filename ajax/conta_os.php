<?php
    require_once("../includes/functions.php");
    $db = new db();
    $db->query("SELECT COUNT(id) FROM ordemservico WHERE 1=1");
?>
<div class="dark">
    <a href="<?=urlDir('os_a/lista_a'); ?>" title="Clique para listar as Ordens Abertas">
        Ordens Abertas:<strong><?=$db->linhas()?></strong>
    </a>
</div>
