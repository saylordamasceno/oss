-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 04, 2012 at 08:00 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ordem2`
--

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE latin1_bin DEFAULT NULL,
  `report` time NOT NULL DEFAULT '00:00:00',
  `intervalo` char(1) COLLATE latin1_bin NOT NULL DEFAULT '1',
  `email` varchar(75) COLLATE latin1_bin DEFAULT NULL,
  `fone_empresa` varchar(13) COLLATE latin1_bin DEFAULT NULL,
  `celular` varchar(13) COLLATE latin1_bin DEFAULT NULL,
  `endereco` varchar(100) COLLATE latin1_bin DEFAULT NULL,
  `bairro` varchar(30) COLLATE latin1_bin DEFAULT NULL,
  `cidade` varchar(30) COLLATE latin1_bin DEFAULT NULL,
  `estado` char(2) COLLATE latin1_bin DEFAULT NULL,
  `cep` varchar(10) COLLATE latin1_bin DEFAULT NULL,
  `grupo` varchar(15) COLLATE latin1_bin DEFAULT NULL,
  `id` varchar(4) COLLATE latin1_bin DEFAULT '0000',
  `comercial` char(1) COLLATE latin1_bin NOT NULL DEFAULT '0',
  `ligado` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=305 ;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `report`, `intervalo`, `email`, `fone_empresa`, `celular`, `endereco`, `bairro`, `cidade`, `estado`, `cep`, `grupo`, `id`, `comercial`, `ligado`) VALUES
(304, 'CLIENTE 1', '00:00:00', '1', 'MEIEMAIL@EMAIL.COM', '51999999', '519999999', 'ENDERECO DO CLIENTE', 'BAIRRO', 'VENâNCIO AIRES', 'RS', '95800-000', NULL, '0001', '0', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `data_criacao` date NOT NULL DEFAULT '0000-00-00',
  `titulo_pg` varchar(60) COLLATE latin1_bin DEFAULT NULL,
  `nome_fantasia` varchar(70) COLLATE latin1_bin DEFAULT NULL,
  `fone_loja` varchar(15) COLLATE latin1_bin DEFAULT NULL,
  `endereco` varchar(70) COLLATE latin1_bin DEFAULT NULL,
  `bairro` varchar(30) COLLATE latin1_bin DEFAULT NULL,
  `cidade` varchar(40) COLLATE latin1_bin DEFAULT NULL,
  `estado` char(2) COLLATE latin1_bin DEFAULT NULL,
  `cep` varchar(10) COLLATE latin1_bin DEFAULT NULL,
  `email` varchar(50) COLLATE latin1_bin DEFAULT NULL,
  `site` varchar(50) COLLATE latin1_bin DEFAULT NULL,
  PRIMARY KEY (`data_criacao`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`data_criacao`, `titulo_pg`, `nome_fantasia`, `fone_loja`, `endereco`, `bairro`, `cidade`, `estado`, `cep`, `email`, `site`) VALUES
('2010-04-25', 'Sistema Ordem de Serviço', 'Sistel Alarmes e Monitoramento', '51 3741-1597', '15 de Novembro 1581', 'Centro', 'Venâncio Aires', 'RS', '95800-000', 'contato@sistel24horas.com.br', 'www.sistel24horas.com.br');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) COLLATE latin1_bin DEFAULT NULL,
  `senha` varchar(20) COLLATE latin1_bin DEFAULT NULL,
  `id_categoria` char(1) COLLATE latin1_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=27 ;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `login`, `senha`, `id_categoria`) VALUES
(26, 'admin', 'admin', '1');

-- --------------------------------------------------------


--
-- Table structure for table `equipamentos`
--

CREATE TABLE IF NOT EXISTS `equipamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(20) COLLATE latin1_bin DEFAULT NULL,
  `modelo` varchar(20) COLLATE latin1_bin DEFAULT NULL,
  `descricao` varchar(140) COLLATE latin1_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=27 ;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `equipamento` (`id`, `tipo`, `modelo`, `descricao`) VALUES
(26, 'celular', 'iphone 3gs 16gb', 'tela quebrada');

-- --------------------------------------------------------

--
-- Table structure for table `ordemservico`
--

CREATE TABLE IF NOT EXISTS `ordemservico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuarios` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Data_Entrada` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `Entrada` datetime NOT NULL,
  `Hora_Entrada` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `Agenda` char(1) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `Cliente` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Cod_Cliente` varchar(4) CHARACTER SET utf8 DEFAULT '0000',
  `Equipamento` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `Marca` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `F_Pgto` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Tecnico` varchar(50) CHARACTER SET utf8 DEFAULT '',
  `Tecnico_add` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Garantia` varchar(5) CHARACTER SET utf8 DEFAULT NULL,
  `Problemacliente` text CHARACTER SET utf8,
  `DiagnosticoTecnico` text CHARACTER SET utf8,
  `Solucao` text CHARACTER SET utf8,
  `Dataentrega` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `Dataentrega2` date NOT NULL,
  `Arquivo` char(1) CHARACTER SET utf8 DEFAULT 'n',
  `valor` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `valor_pago` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `valor_material` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `mao_de_obra` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `material` varchar(300) CHARACTER SET utf8 NOT NULL,
  `Repeat_os` int(2) DEFAULT '0',
  `fone_empresa` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `endereco` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=965 ;

--
-- Dumping data for table `ordemservico`
--

INSERT INTO `ordemservico` (`Cod_id`, `usuarios`, `Data_Entrada`, `Entrada`, `Hora_Entrada`, `Agenda`, `Cliente`, `Cod_Cliente`, `Equipamento`, `Marca`, `F_Pgto`, `Tecnico`, `Tecnico_add`, `Garantia`, `Problemacliente`, `DiagnosticoTecnico`, `Solucao`, `Dataentrega`, `Dataentrega2`, `Arquivo`, `valor`, `valor_pago`, `valor_material`, `mao_de_obra`, `material`, `Repeat_os`, `fone_empresa`, `endereco`) VALUES
(964, 'ADMIN', NULL, '2012-06-04 19:59:44', NULL, '0', 'CLIENTE 1', '0001', 'ALARME', NULL, 'MONITORAMENTO', '', NULL, NULL, 'PROBLEMA NO CLIENTE', NULL, NULL, NULL, '0000-00-00', 'n', NULL, '0', '0', '0', '', 0, NULL, 'ENDERECO DO CLIENTE');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
