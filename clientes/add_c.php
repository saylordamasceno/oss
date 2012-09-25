<?php
require_once('../includes/config.php');
require_once('../includes/functions.php');
require_once('../includes/header.php');
require_once('../includes/menudrop.php');
$pagina = 'Adicionar Cliente';

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
$T_Report = '1';

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

    $nome = "-1";
    $id = '-1';
    if (isset($_POST['nome']))
        $nome = $_POST['nome'];
    if (isset($_POST['id']))
        $id = $_POST['id'];
    $db = new db();
    $db->query(sprintf('SELECT COUNT(id),id FROM cliente WHERE nome = %s OR id = %s', GetSQLValueString($nome, "text"), GetSQLValueString($id, "text")));
    $C_Verif = $db->result(0, 'COUNT(id)');
    $C_Cod = $db->result(0, 'id');

    if (($C_Verif == 0) || ($_POST['id'] == $C_Cod)) {
        if ($_POST['mode'] == 'edd') {
            $insertSQL = sprintf("UPDATE cliente SET nome=%s, email=%s, fone_empresa=%s,celular=%s, endereco=%s, bairro=%s, cidade=%s, estado=%s, grupo=%s, cep=%s WHERE id=%s", GetSQLValueString($_POST['nome'], "text"), GetSQLValueString($_POST['email'], "text"), GetSQLValueString($_POST['fone_empresa'], "text"), GetSQLValueString($_POST['celular'], "text"), GetSQLValueString($_POST['endereco'], "text"), GetSQLValueString($_POST['bairro'], "text"), GetSQLValueString($_POST['cidade'], "text"), GetSQLValueString($_POST['estado'], "text"), GetSQLValueString($_POST['grupo'], "text"), GetSQLValueString($_POST['cep'], "text"), GetSQLValueString($_POST['id'], "int"));
            $Result1 = mysql_query($insertSQL, $data) or die(mysql_error());
            ;
            header("Location: lista_c");
        } else {
            $db = new db();
            $db->query(sprintf("INSERT INTO cliente (nome, email, fone_empresa,fone_responsavel, endereco, bairro, cidade, estado, cep) VALUES ( %s, %s, %s, %s, %s, %s, %s, %s, %s)", GetSQLValueString($_POST['nome'], "text"), GetSQLValueString($_POST['email'], "text"), GetSQLValueString($_POST['fone_empresa'], "text"), GetSQLValueString($_POST['fone_responsavel'], "text"), GetSQLValueString($_POST['endereco'], "text"), GetSQLValueString($_POST['bairro'], "text"), GetSQLValueString($_POST['cidade'], "text"), GetSQLValueString($_POST['estado'], "text"), GetSQLValueString($_POST['cep'], "text")));
            header("Location: lista_c");
        }
    }
}

$Estado = $EstadoPadrao;
$Cep = $CepPadrão;
$Cidade = $CidadePadão;
if (!empty($_GET['mode'])) {
    $Q_Verif = mysql_query('SELECT id, nome, email, fone_empresa, celular, endereco, bairro, cidade, estado, cep, grupo, id FROM cliente WHERE id=\'' . $_GET['RecordID'] . '\'', $data) or die(mysql_error());
    $C_Result = mysql_fetch_array($Q_Verif);
    if (!empty($C_Result['estado']))
        $Estado = $C_Result['estado'];
    if (!empty($C_Result['cidade']))
        $Cidade = $C_Result['cidade'];
    if (!empty($C_Result['cep']))
        $Cep = $C_Result['cep'];
}
?>
<html>
    <body>
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/os/inicio">Home</a> <span class="divider">/</span></li>
                <li><a href="/os/clientes/lista_c">Clientes</a> <span class="divider">/</span></li>
                <li class="active">Novo cliente</li>
            </ul>
            <form class="form-horizontal" action="<?= $editFormAction; ?>" method="post" name="form1" id="form1">            
                <legend>Novo cliente</legend>
                <?php if ($C_Verif > 0) { ?>
                    <div>
                        <div class="form_cell_erro">
                            Este cadastro não pôde ser realizado, pois o mesmo NOME ou id já se encontra cadastrado em nosso sistema!</div>
                    </div> 
                <?php } ?> 

                <div class="control-group">
                    <label class="control-label" for="modelo">Nome</label>
                    <div class="controls">
                        <input type="hidden" name="id" />
                        <input name="nome" type="text" class="required" id="nome" value="<?= $C_Result['nome'] ?>"/>
                    </div>    

                    <label class="control-label" for="modelo">Email</label>
                    <div class="controls">
                        <input name="email" type="text" class="select"  id="email" value="<?= $C_Result['email'] ?>"/>
                    </div>
                    <label class="control-label" for="modelo">Telefone</label>
                    <div class="controls">
                        <input type="text" class="select" name="fone_empresa" id="fone_empresa" maxlength="20" value="<?= $C_Result['fone_empresa'] ?>" />
                    </div>
                    <label class="control-label" for="modelo">Celular</label>
                    <div class="controls">
                        <input type="text" class="select" name="celular" id="celular" maxlength="20" value="<?= $C_Result['celular'] ?>"/>
                    </div>
                    <label class="control-label" for="cnpj">CNPJ/CPF</label>
                    <div class="controls">                
                        <input type="text" id="cnpj" name="cnpj" <?php if ($erro) echo 'value="' . $_COOKIE['cnpj'] . '"'; ?> size="30" />
                    </div>
                </div>                 
                <div class="control-group">
                    <label class="control-label" for="modelo">CEP</label>
                    <div class="controls">
                        <input name="cep" type="text" class="select" id="cep" value="<?= $Cep ?>"onKeyPress="MascaraCep(this,event)" onBlur="ValidaCep(this)"  maxlength="9"/>
                    </div>                    
                    <label class="control-label" for="modelo">Endereço</label>
                    <div class="controls">
                        <input name="endereco" type="text" class="select" id="endereco" value="<?= $C_Result['endereco'] ?>"/>
                    </div>                    
                    <label class="control-label" for="modelo">Bairro</label>
                    <div class="controls">
                        <input name="bairro" type="text" class="select" id="bairro" value="<?= $C_Result['bairro'] ?>"/>
                    </div>
                    <label class="control-label" for="modelo">Cidade</label>
                    <div class="controls">
                        <input name="cidade" type="text" class="select" id="cidade" value="<?= $Cidade ?>"/>
                    </div>
                    <label class="control-label" for="modelo">Estado</label>
                    <div class="controls">
                        <select name="estado">
                            <option value="AC" <?php
                if (!(strcmp("AC", $Estado))) {
                    echo "selected=\"selected\"";
                }
                ?>>Acre</option>
                            <option value="AL" <?php
                                    if (!(strcmp("AL", $Estado))) {
                                        echo "selected=\"selected\"";
                                    }
                ?>>Alagoas</option>
                            <option value="AP" <?php
                                    if (!(strcmp("AP", $Estado))) {
                                        echo "selected=\"selected\"";
                                    }
                ?>>Amapá</option>
                            <option value="AM" <?php
                                    if (!(strcmp("AM", $Estado))) {
                                        echo "selected=\"selected\"";
                                    }
                ?>>Amazonas</option>
                            <option value="BA" <?php
                                    if (!(strcmp("BA", $Estado))) {
                                        echo "selected=\"selected\"";
                                    }
                ?>>Bahia</option>
                            <option value="CE" <?php
                                    if (!(strcmp("CE", $Estado))) {
                                        echo "selected=\"selected\"";
                                    }
                ?>>Ceará</option>
                            <option value="DF" <?php
                                    if (!(strcmp("DF", $Estado))) {
                                        echo "selected=\"selected\"";
                                    }
                ?>>Distrito Federal</option>
                            <option value="ES" <?php
                                    if (!(strcmp("ES", $Estado))) {
                                        echo "selected=\"selected\"";
                                    }
                ?>>Espírito Santo</option>
                            <option value="GO" <?php
                                    if (!(strcmp("GO", $Estado))) {
                                        echo "selected=\"selected\"";
                                    }
                ?>>Goiás</option>
                            <option value="MA" <?php
                                    if (!(strcmp("MA", $Estado))) {
                                        echo "selected=\"selected\"";
                                    }
                ?>>Maranhão</option>
                            <option value="MT" <?php
                                    if (!(strcmp("MT", $Estado))) {
                                        echo "selected=\"selected\"";
                                    }
                ?>>Mato Grosso</option>
                            <option value="MS" <?php
                                    if (!(strcmp("MS", $Estado))) {
                                        echo "selected=\"selected\"";
                                    }
                ?>>Mato Grosso do Sul</option>
                            <option value="MG" <?php
                                    if (!(strcmp("MG", $Estado))) {
                                        echo "selected=\"selected\"";
                                    }
                ?>>Minas Gerais</option>
                            <option value="PA" <?php
                                    if (!(strcmp("PA", $Estado))) {
                                        echo "selected=\"selected\"";
                                    }
                ?>>Pará</option>
                            <option value="PB" <?php
                                    if (!(strcmp("PB", $Estado))) {
                                        echo "selected=\"selected\"";
                                    }
                ?>>Paraíba</option>
                            <option value="PR" <?php
                                    if (!(strcmp("PR", $Estado))) {
                                        echo "selected=\"selected\"";
                                    }
                ?>>Paraná</option>
                            <option value="PE" <?php
                                    if (!(strcmp("PE", $Estado))) {
                                        echo "selected=\"selected\"";
                                    }
                ?>>Pernambuco</option>
                            <option value="PI" <?php
                                    if (!(strcmp("PI", $Estado))) {
                                        echo "selected=\"selected\"";
                                    }
                ?>>Piauí</option>
                            <option value="RJ" <?php
                                    if (!(strcmp("RJ", $Estado))) {
                                        echo "selected=\"selected\"";
                                    }
                ?>>Rio de Janeiro</option>
                            <option value="RN" <?php
                                    if (!(strcmp("RN", $Estado))) {
                                        echo "selected=\"selected\"";
                                    }
                ?>>Rio Grande do Norte</option>
                            <option value="RS" <?php
                                    if (!(strcmp("RS", $Estado))) {
                                        echo "selected=\"selected\"";
                                    }
                ?>>Rio Grande do Sul</option>
                            <option value="RO" <?php
                                    if (!(strcmp("RO", $Estado))) {
                                        echo "selected=\"selected\"";
                                    }
                ?>>Rondônia</option>
                            <option value="RR" <?php
                                    if (!(strcmp("RR", $Estado))) {
                                        echo "selected=\"selected\"";
                                    }
                ?>>Roraima</option>
                            <option value="SC" <?php
                                    if (!(strcmp("SC", $Estado))) {
                                        echo "selected=\"selected\"";
                                    }
                ?>>Santa Catarina</option>
                            <option value="SP" <?php
                                    if (!(strcmp("SP", $Estado))) {
                                        echo "selected=\"selected\"";
                                    }
                ?>>São Paulo</option>
                            <option value="SE" <?php
                                    if (!(strcmp("SE", $Estado))) {
                                        echo "selected=\"selected\"";
                                    }
                ?>>Sergipe</option>
                            <option value="TO" <?php
                                    if (!(strcmp("TO", $Estado))) {
                                        echo "selected=\"selected\"";
                                    }
                ?>>Tocantins</option>
                        </select>          

                    </div>
                </div>
                <div class="form-actions">                        
                    <button class="btn btn-primary" type="submit" name="submit">Efetuar Cadastro</button> Ou <a href='visualiza_e?recordID=<?= $C_Result['id'] ?>'>Voltar</a>      
                    <input type="hidden" name="MM_insert" value="form1" />
                    <input type="hidden" name="mode" value="<?= $_GET['mode'] ?>" />
                    <input type="hidden" name="id" value="<?= $C_Result['id'] ?>" />
                </div>
            </form>
        </div>
    </body>
</html>

