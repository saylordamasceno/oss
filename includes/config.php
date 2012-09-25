<?php
include_once 'db.php';
include_once 'db_cliente.php';
//include_once 'db_usuario.php';
 

$Pasta_Install = 'os/';  // MUDE ESTA PASTA DE ACORDO COM A PASTA DE INSTALAÇÃO DO SISTEMA NO SEU SERVIDOR, 
                                 //OU DEIXE VAZIO, CASO O SISTEMA ESTEJA INSTALADO NA RAIZ DO SERVIDOR
                                 
define(INSTALL_FOLDER,sprintf('http://%s/%s',$_SERVER['SERVER_NAME'],$Pasta_Install));
//error_reporting('E_ALL ^ E_NOTICE ^ E_DEPRECATED');

$EstadoPadrao = 'SP';               //  Sigla do estado padrão para o formulário de Adição de Clientes
$CidadePadão = 'Campinas';    //  Cidade padrão para o formulário de Adição de Clientes
$CepPadrão = '13070-000';           //  Cep padrão para o formulário de Adição de Clientes

$maxRowsList = 30;   //  Limite de Itens nas listas de OS, Clientes, e usuarios

?>