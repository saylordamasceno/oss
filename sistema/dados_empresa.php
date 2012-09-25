<?php
require_once('../includes/config.php');
require_once('../includes/functions.php');
require_once('../includes/header.php');
require_once('../includes/menudrop.php');
$pagina = 'Dados da Empresa';

if ((isset($_GET["MM_update"])) && ($_GET["MM_update"] == "form1")) {
    $db = new db();

    $db->query(sprintf("UPDATE config SET nome=%s, nome_fantasia=%s, fone_loja=%s, endereco=%s, bairro=%s, cidade=%s, estado=%s, cep=%s, email=%s, site=%s, messenger=%s", GetSQLValueString($_GET['nome'], "text"), GetSQLValueString($_GET['nome_fantasia'], "text"), GetSQLValueString($_GET['fone_loja'], "text"), GetSQLValueString($_GET['endereco'], "text"), GetSQLValueString($_GET['bairro'], "text"), GetSQLValueString($_GET['cidade'], "text"), GetSQLValueString($_GET['estado'], "text"), GetSQLValueString($_GET['cep'], "text"), GetSQLValueString($_GET['email'], "text"), GetSQLValueString($_GET['site'], "text")));

    $updateGoTo = "../os_a/lista_a";
    header(sprintf("Location: %s", $updateGoTo));
}
$db->query('SELECT * FROM config');
$row_alterar = $db->resultado();
?>
<html>
    <body>
        <div class="container">  
            <ul class="breadcrumb">
                <li><a href="/os/inicio">Home</a> <span class="divider">/</span></li>
                <li class="active">Dados da empresa</li>
            </ul>                        
            <form class="form-horizontal" action="" name="form1" id="form1" method="get">
                <legend>
                    Dados da empresa
                </legend>
                <div class="control-group">
                    <label class="control-label" for="nome">Nome do Site</label>
                    <div class="controls">
                        <input name="nome" type="text" class="select" id="nome" value="<?php echo $row_alterar['nome']; ?>" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="nome_fantasia">Nome da Empresa</label>
                    <div class="controls">
                        <input name="nome_fantasia" type="text" class="select" id="nome_fantasia" value="<?php echo $row_alterar['nome_fantasia']; ?>" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="fone_loja">Telefone Comercial</label>
                    <div class="controls">
                        <input name="fone_loja" type="text" class="select" id="fone_loja" value="<?php echo $row_alterar['fone_loja']; ?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="email">Email Comercial</label>
                    <div class="controls">
                        <input name="email" type="text" class="select" id="email" value="<?php echo $row_alterar['email']; ?>" />
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="endereco">Endereço</label>
                    <div class="controls">
                        <input name="endereco" type="text" class="select" id="endereco" value="<?php echo $row_alterar['endereco']; ?>" />
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="bairro">Bairro</label>
                        <div class="controls">
                            <input name="bairro" type="text" class="select" id="bairro" value="<?php echo $row_alterar['bairro']; ?>" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="cidade">Cidade</label>
                    <div class="controls">
                        <input name="cidade" type="text" class="select" id="cidade"
                               value="<?php echo $row_alterar['cidade']; ?>"  />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="cep">Cep</label>
                    <div class="controls">
                        <input name="cep" type="text" class="select" id="cep" value="<?php echo $row_alterar['cep']; ?>" onKeyPress="MascaraCep(this,event)" onBlur="ValidaCep(this)" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="estado">Estado</label>
                    <div class="controls">
                        <select name="estado" size="1">
                            <option value="AC"
                            <?php
                            if (!(strcmp("AC", htmlentities($row_alterar['estado'])))) {
                                echo "selected=\"selected\"";
                            }
                            ?>>Acre</option>
                            <option value="AL"
                            <?php
                            if (!(strcmp("AL", htmlentities($row_alterar['estado'])))) {
                                echo "selected=\"selected\"";
                            }
                            ?>>Alagoas</option>
                            <option value="AP"
                            <?php
                            if (!(strcmp("AP", htmlentities($row_alterar['estado'])))) {
                                echo "selected=\"selected\"";
                            }
                            ?>>Amapá</option>
                            <option value="AM"
                            <?php
                            if (!(strcmp("AM", htmlentities($row_alterar['estado'])))) {
                                echo "selected=\"selected\"";
                            }
                            ?>>Amazonas</option>
                            <option value="BA"
                            <?php
                            if (!(strcmp("BA", htmlentities($row_alterar['estado'])))) {
                                echo "selected=\"selected\"";
                            }
                            ?>>Bahia</option>
                            <option value="CE"
                            <?php
                            if (!(strcmp("CE", htmlentities($row_alterar['estado'])))) {
                                echo "selected=\"selected\"";
                            }
                            ?>>Ceará</option>
                            <option value="DF"
                            <?php
                            if (!(strcmp("DF", htmlentities($row_alterar['estado'])))) {
                                echo "selected=\"selected\"";
                            }
                            ?>>Distrito Federal</option>
                            <option value="ES"
                            <?php
                            if (!(strcmp("ES", htmlentities($row_alterar['estado'])))) {
                                echo "selected=\"selected\"";
                            }
                            ?>>Espírito Santo</option>
                            <option value="GO"
                            <?php
                            if (!(strcmp("GO", htmlentities($row_alterar['estado'])))) {
                                echo "selected=\"selected\"";
                            }
                            ?>>Goiás</option>
                            <option value="MA"
                            <?php
                            if (!(strcmp("MA", htmlentities($row_alterar['estado'])))) {
                                echo "selected=\"selected\"";
                            }
                            ?>>Maranhão</option>
                            <option value="MT"
                            <?php
                            if (!(strcmp("MT", htmlentities($row_alterar['estado'])))) {
                                echo "selected=\"selected\"";
                            }
                            ?>>Mato Grosso</option>
                            <option value="MS"
                            <?php
                            if (!(strcmp("MS", htmlentities($row_alterar['estado'])))) {
                                echo "selected=\"selected\"";
                            }
                            ?>>Mato Grosso do Sul</option>
                            <option value="MG"
                            <?php
                            if (!(strcmp("MG", htmlentities($row_alterar['estado'])))) {
                                echo "selected=\"selected\"";
                            }
                            ?>>Minas Gerais</option>
                            <option value="PA"
                            <?php
                            if (!(strcmp("PA", htmlentities($row_alterar['estado'])))) {
                                echo "selected=\"selected\"";
                            }
                            ?>>Pará</option>
                            <option value="PB"
                            <?php
                            if (!(strcmp("PB", htmlentities($row_alterar['estado'])))) {
                                echo "selected=\"selected\"";
                            }
                            ?>>Paraíba</option>
                            <option value="PR"
                            <?php
                            if (!(strcmp("PR", htmlentities($row_alterar['estado'])))) {
                                echo "selected=\"selected\"";
                            }
                            ?>>Paraná</option>
                            <option value="PE"
                            <?php
                            if (!(strcmp("PE", htmlentities($row_alterar['estado'])))) {
                                echo "selected=\"selected\"";
                            }
                            ?>>Pernambuco</option>
                            <option value="PI"
                            <?php
                            if (!(strcmp("PI", htmlentities($row_alterar['estado'])))) {
                                echo "selected=\"selected\"";
                            }
                            ?>>Piauí</option>
                            <option value="RJ"
                            <?php
                            if (!(strcmp("RJ", htmlentities($row_alterar['estado'])))) {
                                echo "selected=\"selected\"";
                            }
                            ?>>Rio de Janeiro</option>
                            <option value="RN"
                            <?php
                            if (!(strcmp("RN", htmlentities($row_alterar['estado'])))) {
                                echo "selected=\"selected\"";
                            }
                            ?>>Rio Grande do Norte</option>
                            <option value="RS"
                            <?php
                            if (!(strcmp("RS", htmlentities($row_alterar['estado'])))) {
                                echo "selected=\"selected\"";
                            }
                            ?>>Rio Grande do Sul</option>
                            <option value="RO"
                            <?php
                            if (!(strcmp("RO", htmlentities($row_alterar['estado'])))) {
                                echo "selected=\"selected\"";
                            }
                            ?>>Rondônia</option>
                            <option value="RR"
                            <?php
                            if (!(strcmp("RR", htmlentities($row_alterar['estado'])))) {
                                echo "selected=\"selected\"";
                            }
                            ?>>Roraima</option>
                            <option value="SC"
                            <?php
                            if (!(strcmp("SC", htmlentities($row_alterar['estado'])))) {
                                echo "selected=\"selected\"";
                            }
                            ?>>Santa Catarina</option>
                            <option value="SP"
                            <?php
                            if (!(strcmp("SP", htmlentities($row_alterar['estado'])))) {
                                echo "selected=\"selected\"";
                            }
                            ?>>São Paulo</option>
                            <option value="SE"
                            <?php
                            if (!(strcmp("SE", htmlentities($row_alterar['estado'])))) {
                                echo "selected=\"selected\"";
                            }
                            ?>>Sergipe</option>
                            <option value="TO"
                            <?php
                            if (!(strcmp("TO", htmlentities($row_alterar['estado'])))) {
                                echo "selected=\"selected\"";
                            }
                            ?>>Tocantins</option>
                        </select>
                    </div>                                
                </div>
                <div class="control-group">
                    <label class="control-label" for="site">Site da Empresa</label>
                    <div class="controls">
                        <input name="site" type="text" class="select" id="site" value="<?php echo $row_alterar['site']; ?>" />
                    </div>
                </div>
                <div class="form-actions">
                    <input type="submit" class="btn btn-primary" name="Submit" value="Salvar" />
                    Ou <a href='visualiza_e?recordID=<?= $equipamento['id'] ?>'>Voltar</a>      
                    <input type="hidden" name="MM_update" value="form1">
                </div>                
            </form>
        </div>
    </body>
</html>