-- phpMyAdmin SQL Dump
-- version 2.11.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2012 at 11:47 PM
-- Server version: 5.0.83
-- PHP Version: 5.3.8-ZS5.5.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `asc_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `atualizacao`
--

CREATE TABLE IF NOT EXISTS `atualizacao` (
  `codigo` int(11) NOT NULL auto_increment,
  `timestamp` int(11) default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `atualizacao`
--

INSERT INTO `atualizacao` (`codigo`, `timestamp`) VALUES
(1, 1204687040),
(2, 1204815653),
(3, 1204815862),
(4, 1204826836),
(5, 1207579075),
(6, 1207581476),
(7, 1207581553),
(8, 1207581760),
(9, 1207581854),
(10, 1207581891),
(11, 1207582079),
(12, 1207582239),
(13, 1207586791),
(14, 1207587968),
(15, 1207588044),
(16, 1209495220),
(17, 1210603011),
(18, 1210606600),
(19, 1210789541),
(20, 1210790543);

-- --------------------------------------------------------

--
-- Table structure for table `cad_bancos`
--

CREATE TABLE IF NOT EXISTS `cad_bancos` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `nome` varchar(35) NOT NULL,
  `numero` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL default '1',
  `sync_timestamp` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `cad_bancos`
--

INSERT INTO `cad_bancos` (`id`, `nome`, `numero`, `status`, `sync_timestamp`) VALUES
(1, 'Itau', 0, 1, NULL),
(2, 'Bradesco', 0, 1, NULL),
(3, 'Unibanco', 0, 1, NULL),
(4, 'Caixa Economica', 0, 1, NULL),
(5, 'Banco do Brasil', 0, 1, NULL),
(6, 'Real', 0, 1, NULL),
(7, 'HSBC', 0, 1, NULL),
(8, 'SAFRA', 0, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cad_cartoes`
--

CREATE TABLE IF NOT EXISTS `cad_cartoes` (
  `id` tinyint(3) unsigned NOT NULL auto_increment,
  `nome` varchar(30) NOT NULL,
  `credito` tinyint(1) NOT NULL,
  `debito` tinyint(1) NOT NULL,
  `tx_credito1` decimal(10,2) NOT NULL default '0.00',
  `tx_credito2` decimal(10,2) NOT NULL default '0.00',
  `tx_debito1` decimal(10,2) NOT NULL default '0.00',
  `tx_debito2` decimal(10,2) NOT NULL default '0.00',
  `status` tinyint(4) NOT NULL default '1',
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `cart` (`nome`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cad_cartoes`
--


-- --------------------------------------------------------

--
-- Table structure for table `cad_clientes_obs`
--

CREATE TABLE IF NOT EXISTS `cad_clientes_obs` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_cliente` int(10) unsigned NOT NULL default '0',
  `observacoes` text,
  `foto` blob,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cad_clientes_obs`
--


-- --------------------------------------------------------

--
-- Table structure for table `cad_empresa`
--

CREATE TABLE IF NOT EXISTS `cad_empresa` (
  `id` int(8) unsigned NOT NULL auto_increment,
  `nome_empresa` varchar(100) default NULL,
  `endereco` varchar(100) default NULL,
  `cidade` varchar(30) default NULL,
  `uf` char(2) default NULL,
  `cnpj` varchar(18) default NULL,
  `ie` varchar(16) default NULL,
  `telefone` varchar(15) default NULL,
  `fax` varchar(15) default NULL,
  `mensagem` varchar(200) default NULL,
  `qtd_terminal` int(3) unsigned zerofill default '001',
  `serial_key` varchar(255) default NULL,
  `im` varchar(20) default NULL,
  `qtd_turnos` char(1) NOT NULL default '1',
  `email` varchar(200) default NULL,
  `site` varchar(200) default NULL,
  `bairro` varchar(200) default NULL,
  `cep` varchar(15) default NULL,
  `filiais` tinyint(4) NOT NULL,
  `sync_timestamp` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cad_empresa`
--

INSERT INTO `cad_empresa` (`id`, `nome_empresa`, `endereco`, `cidade`, `uf`, `cnpj`, `ie`, `telefone`, `fax`, `mensagem`, `qtd_terminal`, `serial_key`, `im`, `qtd_turnos`, `email`, `site`, `bairro`, `cep`, `filiais`, `sync_timestamp`) VALUES
(1, 'Greyland', 'Av. de teste 2.500', 'Rio de Janeiro', 'RJ', '', '', '--', '--', NULL, 001, '86E4-0C16-6F60-7632', NULL, '3', '', '', '', '-', 1, 1204369024);

-- --------------------------------------------------------

--
-- Table structure for table `cad_login`
--

CREATE TABLE IF NOT EXISTS `cad_login` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `login` varchar(15) default NULL,
  `senha` varchar(60) default NULL,
  `autoriza` varchar(25) default NULL,
  `ativo` enum('ativo','desativo') NOT NULL default 'ativo',
  `nome` varchar(20) NOT NULL,
  `sync_timestamp` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `cad_login`
--

INSERT INTO `cad_login` (`id`, `login`, `senha`, `autoriza`, `ativo`, `nome`, `sync_timestamp`) VALUES
(1, 'ROOT', 'e10adc3949ba59abbe56e057f20f883e', '1111111111111111111111111', 'ativo', 'MASTER ROOT', NULL),
(12, 'RENATO', 'e10adc3949ba59abbe56e057f20f883e', '1111010000000000000111000', 'ativo', 'RENATO', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cad_login_perfil`
--

CREATE TABLE IF NOT EXISTS `cad_login_perfil` (
  `id_perfil` int(8) unsigned NOT NULL auto_increment,
  `nome_perfil` varchar(30) default NULL,
  `menu_options` varchar(250) default NULL,
  PRIMARY KEY  (`id_perfil`),
  UNIQUE KEY `NewIndex` (`nome_perfil`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cad_login_perfil`
--


-- --------------------------------------------------------

--
-- Table structure for table `cad_plano_de_contas`
--

CREATE TABLE IF NOT EXISTS `cad_plano_de_contas` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `nome_plano` varchar(30) NOT NULL default '',
  `tipo_lancamento` char(1) NOT NULL default 'E',
  `sync_timestamp` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cad_plano_de_contas`
--


-- --------------------------------------------------------

--
-- Table structure for table `cad_produtos_grade`
--

CREATE TABLE IF NOT EXISTS `cad_produtos_grade` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `id_produto` int(11) unsigned NOT NULL default '0',
  `descricao` varchar(20) NOT NULL default '0',
  `quantidade` int(11) unsigned NOT NULL default '0',
  `vlprodgrade` decimal(10,2) NOT NULL default '0.00',
  `sync_timestamp` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cad_produtos_grade`
--


-- --------------------------------------------------------

--
-- Table structure for table `cad_produtos_obs`
--

CREATE TABLE IF NOT EXISTS `cad_produtos_obs` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_produto` int(10) unsigned NOT NULL default '0',
  `observacoes` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cad_produtos_obs`
--


-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `idcliente` int(11) default NULL,
  `txtnome` text collate utf8_unicode_ci,
  `txtendereco` text collate utf8_unicode_ci,
  `txtbairro` text collate utf8_unicode_ci,
  `txtcidade` text collate utf8_unicode_ci,
  `txtuf` text collate utf8_unicode_ci,
  `txttelefone` text collate utf8_unicode_ci,
  `txtcelular` text collate utf8_unicode_ci,
  `txtemail` text collate utf8_unicode_ci,
  `txtcpf` text collate utf8_unicode_ci,
  `txtcep` text collate utf8_unicode_ci,
  `txtcod_barra` text collate utf8_unicode_ci,
  `dtaniversario` text collate utf8_unicode_ci,
  `txtrg` text collate utf8_unicode_ci,
  `txtinf_adicional` text collate utf8_unicode_ci,
  `dtcadastro` date default NULL,
  `sync_timestamp` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cliente`
--


-- --------------------------------------------------------

--
-- Table structure for table `colecao`
--

CREATE TABLE IF NOT EXISTS `colecao` (
  `idcolecao` int(11) unsigned NOT NULL auto_increment,
  `txtnome` varchar(30) NOT NULL default '',
  `txtperiodo` varchar(45) NOT NULL default '',
  `txtdescricao` text NOT NULL,
  `sync_timestamp` int(11) unsigned default NULL,
  PRIMARY KEY  (`idcolecao`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `colecao`
--

INSERT INTO `colecao` (`idcolecao`, `txtnome`, `txtperiodo`, `txtdescricao`, `sync_timestamp`) VALUES
(7, 'Outono - Inverno 2012', '03/2012 até 08/2012', '', NULL),
(8, 'Colecoes Antigas', '01/2011 até 03/2012', '', NULL),
(9, 'Primavera - Verão 2013', '08/2012 até 02/2013', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `configuracao`
--

CREATE TABLE IF NOT EXISTS `configuracao` (
  `id` int(11) NOT NULL auto_increment,
  `cad_empresa_id` int(11) NOT NULL,
  `vendanormal` tinyint(4) NOT NULL default '1',
  `vendavip` tinyint(4) NOT NULL default '1',
  `reducao_estoque` tinyint(4) NOT NULL default '1',
  `estorno_estoque` tinyint(4) NOT NULL default '1',
  `etiquetas` tinyint(4) NOT NULL default '1',
  `mailling` tinyint(4) NOT NULL default '1',
  `administradores` tinyint(4) NOT NULL default '1',
  `configuracoes` tinyint(4) NOT NULL default '1',
  `alerta_pedidocompras` tinyint(4) NOT NULL default '0',
  `alerta_contasreceber` tinyint(4) NOT NULL default '0',
  `alerta_contasreceber_tempo` tinyint(4) NOT NULL default '0',
  `alerta_contaspagar` tinyint(4) NOT NULL default '0',
  `alerta_contaspagar_tempo` tinyint(4) NOT NULL default '0',
  `alerta_estoque` tinyint(4) NOT NULL default '0',
  `alerta_pedidos` tinyint(4) NOT NULL default '0',
  `alerta_cobrancas` tinyint(4) NOT NULL default '0',
  `receber_avista_baixar` tinyint(1) NOT NULL default '1',
  `receber_avista_lancar` tinyint(1) NOT NULL default '1',
  `receber_manual_lancar` tinyint(1) NOT NULL default '1',
  `pagar_manual_lancar` tinyint(1) NOT NULL default '1',
  `tolerancia_atraso` tinyint(4) NOT NULL default '10',
  `bloquear_credito` tinyint(4) NOT NULL default '10',
  `parcela_min_cartao` decimal(10,2) NOT NULL default '0.00',
  `parcela_min_debito` decimal(10,2) NOT NULL default '0.00',
  `parcela_min_cheque` decimal(10,2) NOT NULL default '0.00',
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `cad_empresa_id` (`cad_empresa_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `configuracao`
--


-- --------------------------------------------------------

--
-- Table structure for table `estoque`
--

CREATE TABLE IF NOT EXISTS `estoque` (
  `idestoque` int(11) unsigned NOT NULL auto_increment,
  `produto_idproduto` int(11) unsigned default NULL,
  `nquantidade` int(11) unsigned default NULL,
  `sync_timestamp` int(11) unsigned default NULL,
  PRIMARY KEY  (`idestoque`),
  UNIQUE KEY `idproduto` (`produto_idproduto`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `estoque`
--


-- --------------------------------------------------------

--
-- Table structure for table `eti_config`
--

CREATE TABLE IF NOT EXISTS `eti_config` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `nome_etiqueta` varchar(60) default NULL,
  `pag_comprimento` decimal(10,2) default NULL,
  `pag_largura` decimal(10,2) default NULL,
  `qtd_colunas` tinyint(3) unsigned default '0',
  `espaco_colunas` decimal(10,2) default NULL,
  `etq_comprimento` decimal(10,2) default NULL,
  `marg_top` decimal(10,2) default NULL,
  `marg_bottom` decimal(10,2) default NULL,
  `marg_left` decimal(10,2) default NULL,
  `marg_right` decimal(10,2) default NULL,
  `AJUSTE_EM` int(11) default NULL,
  `sync_timestamp` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `eti_config`
--


-- --------------------------------------------------------

--
-- Table structure for table `eti_config_campo`
--

CREATE TABLE IF NOT EXISTS `eti_config_campo` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `nome_demonstrativo` varchar(30) default NULL,
  `id_etiqueta` int(11) unsigned default NULL,
  `id_class` int(11) unsigned default NULL,
  `usar` int(11) unsigned default NULL,
  `nome_campo` varchar(30) default NULL,
  `top_e` decimal(10,2) default NULL,
  `left_e` decimal(10,2) default NULL,
  `width_e` decimal(10,2) default NULL,
  `height_e` decimal(10,2) default NULL,
  `font_size_e` tinyint(3) unsigned default '0',
  `sync_timestamp` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `eti_config_campo`
--


-- --------------------------------------------------------

--
-- Table structure for table `fornecedor`
--

CREATE TABLE IF NOT EXISTS `fornecedor` (
  `idfornecedor` int(11) unsigned NOT NULL auto_increment,
  `nome` varchar(60) default NULL,
  `cnpj` varchar(18) default NULL,
  `uf` char(2) default NULL,
  `cidade` varchar(20) default NULL,
  `endereco` varchar(50) default NULL,
  `contato` varchar(30) default NULL,
  `contatoarea` varchar(60) default NULL,
  `email` varchar(100) default NULL,
  `telefone` varchar(15) default NULL,
  `telefoneramal` varchar(6) default NULL,
  `telefone2` varchar(15) default NULL,
  `telefone2ramal` varchar(6) default NULL,
  `fax` varchar(15) default NULL,
  `ie` varchar(16) default NULL,
  `cep` varchar(15) default NULL,
  `bairro` varchar(60) default NULL,
  `idpais` int(11) unsigned default NULL,
  `sync_timestamp` int(11) unsigned default NULL,
  `tipo_lancamento` char(1) default NULL,
  PRIMARY KEY  (`idfornecedor`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `fornecedor`
--


-- --------------------------------------------------------

--
-- Table structure for table `log_estoque_acao`
--

CREATE TABLE IF NOT EXISTS `log_estoque_acao` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `acao` text NOT NULL,
  `controle` int(11) NOT NULL default '0',
  `id_produto` int(11) NOT NULL default '0',
  `grade_id` int(11) NOT NULL default '0',
  `cad_login_id` int(11) NOT NULL default '0',
  `quantidade` int(11) NOT NULL default '0',
  `quantidade_nova` int(11) NOT NULL default '0',
  `datalog` int(11) unsigned default NULL,
  `sync_timestamp` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `log_estoque_acao`
--


-- --------------------------------------------------------

--
-- Table structure for table `log_login`
--

CREATE TABLE IF NOT EXISTS `log_login` (
  `id` int(11) NOT NULL auto_increment,
  `cad_login_id` int(11) NOT NULL default '0',
  `datalog` int(11) unsigned default NULL,
  `sync_timestamp` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `log_login`
--


-- --------------------------------------------------------

--
-- Table structure for table `motivocancelamentovenda`
--

CREATE TABLE IF NOT EXISTS `motivocancelamentovenda` (
  `idmotivo` int(11) unsigned NOT NULL auto_increment,
  `id_login` int(11) NOT NULL,
  `controle` int(11) unsigned default NULL,
  `vr_total` decimal(10,2) NOT NULL,
  `txtmotivo` text NOT NULL,
  `idcliente` int(11) NOT NULL,
  `stmotivo` tinyint(4) NOT NULL,
  `produtoscarrinho` text NOT NULL,
  `sync_timestamp` int(11) unsigned default NULL,
  PRIMARY KEY  (`idmotivo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `motivocancelamentovenda`
--


-- --------------------------------------------------------

--
-- Table structure for table `mv_caixa`
--

CREATE TABLE IF NOT EXISTS `mv_caixa` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `abertura` int(11) unsigned default NULL,
  `fechamento` int(11) unsigned default NULL,
  `vr_abertura` decimal(10,2) default NULL,
  `vr_fechamento` decimal(10,2) default NULL,
  `cad_login_id` int(11) unsigned default NULL,
  `turno` char(1) default NULL,
  `terminal` char(2) default NULL,
  `sync_timestamp` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mv_caixa`
--


-- --------------------------------------------------------

--
-- Table structure for table `mv_cartao`
--

CREATE TABLE IF NOT EXISTS `mv_cartao` (
  `idmv_cartao` int(10) unsigned NOT NULL auto_increment,
  `controle` int(10) unsigned default NULL,
  `id_cartao` int(10) unsigned default NULL,
  `parcela` int(10) unsigned default NULL,
  `vrparcela` decimal(10,2) default NULL,
  `syc_timestamp` int(10) unsigned default NULL,
  PRIMARY KEY  (`idmv_cartao`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mv_cartao`
--


-- --------------------------------------------------------

--
-- Table structure for table `mv_estoque_historico`
--

CREATE TABLE IF NOT EXISTS `mv_estoque_historico` (
  `id` int(8) unsigned NOT NULL auto_increment,
  `controle` varchar(14) default NULL,
  `data_lanca` date default NULL,
  `id_produto` int(8) unsigned default NULL,
  `quantidade` float(10,3) default NULL,
  `numerodanota` varchar(15) default NULL,
  `terminal` char(2) default NULL,
  `vr_compra` float(10,2) default NULL,
  `controle_venda` varchar(14) default NULL,
  `estornado` int(1) unsigned default '0',
  `id_fornecedor` int(8) unsigned default NULL,
  `turno` char(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mv_estoque_historico`
--


-- --------------------------------------------------------

--
-- Table structure for table `mv_financeiro`
--

CREATE TABLE IF NOT EXISTS `mv_financeiro` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `controle` int(11) unsigned default NULL,
  `data_lancamento` date default NULL,
  `data_vencimento` date default NULL,
  `data_pagamento` date default NULL,
  `origem_lancamento` tinyint(1) NOT NULL,
  `tipo_lancamento` char(1) NOT NULL default 'E',
  `parcelas` int(11) unsigned NOT NULL default '1',
  `estornado` tinyint(1) NOT NULL,
  `terminal` char(2) default NULL,
  `turno` char(1) default NULL,
  `vr_desconto` float(10,2) default NULL,
  `vr_juros` float(10,2) default NULL,
  `vr_pago` decimal(10,2) default NULL,
  `vr_despesa_cobranca` decimal(10,2) default NULL,
  `vr_recebido` decimal(10,2) default NULL,
  `historico` varchar(200) default NULL,
  `sync_timestamp` int(11) unsigned default NULL,
  `numero_documento` int(11) default NULL,
  `fornecedor_id` int(11) default NULL,
  `periodicidade` varchar(255) default NULL,
  `pagamento_efetuado` char(1) default NULL,
  `descricao` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mv_financeiro`
--


-- --------------------------------------------------------

--
-- Table structure for table `mv_login`
--

CREATE TABLE IF NOT EXISTS `mv_login` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `entrada_timestamp` int(11) unsigned default NULL,
  `saida_timestamp` int(11) unsigned default NULL,
  `id_login` int(11) unsigned default NULL,
  `ip_maquina` varchar(15) NOT NULL default '',
  `nome_maquina` varchar(50) NOT NULL default '',
  `status_login` tinyint(1) unsigned NOT NULL default '0',
  `terminal` char(2) NOT NULL default '01',
  `sync_timestamp` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mv_login`
--


-- --------------------------------------------------------

--
-- Table structure for table `mv_vendas`
--

CREATE TABLE IF NOT EXISTS `mv_vendas` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `controle` int(11) unsigned default NULL,
  `data_venda` date default NULL,
  `id_cliente` int(11) unsigned default NULL,
  `id_login` int(11) unsigned default NULL,
  `vr_totalvenda` decimal(10,2) default NULL,
  `vr_opcionalvenda` decimal(10,2) default NULL,
  `parcelas` tinyint(3) unsigned NOT NULL default '0',
  `parcelas_cartao` tinyint(3) default NULL,
  `vr_dinheiro` decimal(10,2) default NULL,
  `vr_cheque` decimal(10,2) default NULL,
  `vr_cartao` decimal(10,2) default NULL,
  `vr_debito` decimal(10,2) default NULL,
  `vr_outro` decimal(10,2) default NULL,
  `terminal` char(2) default NULL,
  `turno` char(1) default NULL,
  `credit_id` int(11) default NULL,
  `debit_id` int(11) default NULL,
  `sync_timestamp` int(11) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `controle` (`controle`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mv_vendas`
--


-- --------------------------------------------------------

--
-- Table structure for table `mv_vendas_movimento`
--

CREATE TABLE IF NOT EXISTS `mv_vendas_movimento` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `controle` int(11) unsigned default NULL,
  `data_venda` date default NULL,
  `id_cliente` int(11) unsigned default NULL,
  `id_login` int(11) unsigned default NULL,
  `id_produto` int(11) unsigned default NULL,
  `id_grade` int(11) unsigned default NULL,
  `quant` int(11) unsigned default NULL,
  `vr_custo` decimal(10,2) default NULL,
  `vr_opcional` decimal(10,2) default NULL,
  `vr_total` decimal(10,2) default NULL,
  `estornado` tinyint(1) unsigned NOT NULL default '0',
  `estornado_data` date default NULL,
  `terminal` char(2) default NULL,
  `turno` char(1) default NULL,
  `sync_timestamp` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`),
  KEY `controle` (`controle`),
  KEY `controle_2` (`controle`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mv_vendas_movimento`
--


-- --------------------------------------------------------

--
-- Table structure for table `mv_vendas_vip`
--

CREATE TABLE IF NOT EXISTS `mv_vendas_vip` (
  `vip_id` int(11) unsigned NOT NULL auto_increment,
  `controle` int(11) unsigned default NULL,
  `data_venda` date default NULL,
  `id_cliente` int(11) unsigned default NULL,
  `cad_login_id` int(11) unsigned default NULL,
  `sync_timestamp` int(11) unsigned default NULL,
  PRIMARY KEY  (`vip_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `mv_vendas_vip`
--

INSERT INTO `mv_vendas_vip` (`vip_id`, `controle`, `data_venda`, `id_cliente`, `cad_login_id`, `sync_timestamp`) VALUES
(2, 1218128195, '2008-08-07', 138, 9, 1218128265);

-- --------------------------------------------------------

--
-- Table structure for table `mv_vendas_vip_movimento`
--

CREATE TABLE IF NOT EXISTS `mv_vendas_vip_movimento` (
  `vip_movimento_id` int(11) NOT NULL auto_increment,
  `venda_vip_id` int(11) unsigned default NULL,
  `produto_idproduto` int(11) unsigned default NULL,
  `produto_quantidade` int(11) unsigned default NULL,
  `grade_id` int(11) unsigned default NULL,
  `estornado` tinyint(1) unsigned NOT NULL default '0',
  `sync_timestamp` int(11) unsigned default NULL,
  PRIMARY KEY  (`vip_movimento_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `mv_vendas_vip_movimento`
--

INSERT INTO `mv_vendas_vip_movimento` (`vip_movimento_id`, `venda_vip_id`, `produto_idproduto`, `produto_quantidade`, `grade_id`, `estornado`, `sync_timestamp`) VALUES
(3, 2, 248, 1, 600, 0, 1218128265),
(4, 2, 323, 1, 785, 0, 1218128265),
(5, 2, 326, 1, 793, 0, 1218128265);

-- --------------------------------------------------------

--
-- Table structure for table `paises`
--

CREATE TABLE IF NOT EXISTS `paises` (
  `iso` char(2) collate utf8_unicode_ci NOT NULL,
  `iso3` char(3) collate utf8_unicode_ci NOT NULL,
  `numcode` smallint(6) default NULL,
  `nome` varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`iso`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `paises`
--

INSERT INTO `paises` (`iso`, `iso3`, `numcode`, `nome`) VALUES
('AF', 'AFG', 4, 'Afeganistão'),
('ZA', 'ZAF', 710, 'África do Sul'),
('AX', 'ALA', 248, 'Åland, Ilhas'),
('AL', 'ALB', 8, 'Albânia'),
('DE', 'DEU', 276, 'Alemanha'),
('AD', 'AND', 20, 'Andorra'),
('AO', 'AGO', 24, 'Angola'),
('AI', 'AIA', 660, 'Anguilla'),
('AQ', 'ATA', 10, 'Antárctida'),
('AG', 'ATG', 28, 'Antigua e Barbuda'),
('AN', 'ANT', 530, 'Antilhas Holandesas'),
('SA', 'SAU', 682, 'Arábia Saudita'),
('DZ', 'DZA', 12, 'Argélia'),
('AR', 'ARG', 32, 'Argentina'),
('AM', 'ARM', 51, 'Arménia'),
('AW', 'ABW', 533, 'Aruba'),
('AU', 'AUS', 36, 'Austrália'),
('AT', 'AUT', 40, 'Áustria'),
('AZ', 'AZE', 31, 'Azerbeijão'),
('BS', 'BHS', 44, 'Bahamas'),
('BH', 'BHR', 48, 'Bahrain'),
('BD', 'BGD', 50, 'Bangladesh'),
('BB', 'BRB', 52, 'Barbados'),
('BE', 'BEL', 56, 'Bélgica'),
('BZ', 'BLZ', 84, 'Belize'),
('BJ', 'BEN', 204, 'Benin'),
('BM', 'BMU', 60, 'Bermuda'),
('BY', 'BLR', 112, 'Bielo-Rússia'),
('BO', 'BOL', 68, 'Bolívia'),
('BA', 'BIH', 70, 'Bósnia-Herzegovina'),
('BW', 'BWA', 72, 'Botswana'),
('BV', 'BVT', 74, 'Bouvet, Ilha'),
('BR', 'BRA', 76, 'Brasil'),
('BN', 'BRN', 96, 'Brunei'),
('BG', 'BGR', 100, 'Bulgária'),
('BF', 'BFA', 854, 'Burkina Faso'),
('BI', 'BDI', 108, 'Burundi'),
('BT', 'BTN', 64, 'Butão'),
('CV', 'CPV', 132, 'Cabo Verde'),
('KH', 'KHM', 116, 'Cambodja'),
('CM', 'CMR', 120, 'Camarões'),
('CA', 'CAN', 124, 'Canadá'),
('KY', 'CYM', 136, 'Cayman, Ilhas'),
('KZ', 'KAZ', 398, 'Cazaquistão'),
('CF', 'CAF', 140, 'Centro-africana, República'),
('TD', 'TCD', 148, 'Chade'),
('CZ', 'CZE', 203, 'Checa, República'),
('CL', 'CHL', 152, 'Chile'),
('CN', 'CHN', 156, 'China'),
('CY', 'CYP', 196, 'Chipre'),
('CX', 'CXR', 162, 'Christmas, Ilha'),
('CC', 'CCK', 166, 'Cocos, Ilhas'),
('CO', 'COL', 170, 'Colômbia'),
('KM', 'COM', 174, 'Comores'),
('CG', 'COG', 178, 'Congo, República do'),
('CD', 'COD', 180, 'Congo, República Democrática do (antigo Zaire)'),
('CK', 'COK', 184, 'Cook, Ilhas'),
('KR', 'KOR', 410, 'Coreia do Sul'),
('KP', 'PRK', 408, 'Coreia, República Democrática da (Coreia do Norte)'),
('CI', 'CIV', 384, 'Costa do Marfim'),
('CR', 'CRI', 188, 'Costa Rica'),
('HR', 'HRV', 191, 'Croácia'),
('CU', 'CUB', 192, 'Cuba'),
('DK', 'DNK', 208, 'Dinamarca'),
('DJ', 'DJI', 262, 'Djibouti'),
('DM', 'DMA', 212, 'Dominica'),
('DO', 'DOM', 214, 'Dominicana, República'),
('EG', 'EGY', 818, 'Egipto'),
('SV', 'SLV', 222, 'El Salvador'),
('AE', 'ARE', 784, 'Emiratos Árabes Unidos'),
('EC', 'ECU', 218, 'Equador'),
('ER', 'ERI', 232, 'Eritreia'),
('SK', 'SVK', 703, 'Eslováquia'),
('SI', 'SVN', 705, 'Eslovénia'),
('ES', 'ESP', 724, 'Espanha'),
('US', 'USA', 840, 'Estados Unidos da América'),
('EE', 'EST', 233, 'Estónia'),
('ET', 'ETH', 231, 'Etiópia'),
('FO', 'FRO', 234, 'Faroe, Ilhas'),
('FJ', 'FJI', 242, 'Fiji'),
('PH', 'PHL', 608, 'Filipinas'),
('FI', 'FIN', 246, 'Finlândia'),
('FR', 'FRA', 250, 'França'),
('GA', 'GAB', 266, 'Gabão'),
('GM', 'GMB', 270, 'Gâmbia'),
('GH', 'GHA', 288, 'Gana'),
('GE', 'GEO', 268, 'Geórgia'),
('GS', 'SGS', 239, 'Geórgia do Sul e Sandwich do Sul, Ilhas'),
('GI', 'GIB', 292, 'Gibraltar'),
('GR', 'GRC', 300, 'Grécia'),
('GD', 'GRD', 308, 'Grenada'),
('GL', 'GRL', 304, 'Gronelândia'),
('GP', 'GLP', 312, 'Guadeloupe'),
('GU', 'GUM', 316, 'Guam'),
('GT', 'GTM', 320, 'Guatemala'),
('GG', 'GGY', 831, 'Guernsey'),
('GY', 'GUY', 328, 'Guiana'),
('GF', 'GUF', 254, 'Guiana Francesa'),
('GW', 'GNB', 624, 'Guiné-Bissau'),
('GN', 'GIN', 324, 'Guiné-Conacri'),
('GQ', 'GNQ', 226, 'Guiné Equatorial'),
('HT', 'HTI', 332, 'Haiti'),
('HM', 'HMD', 334, 'Heard e Ilhas McDonald, Ilha'),
('HN', 'HND', 340, 'Honduras'),
('HK', 'HKG', 344, 'Hong Kong'),
('HU', 'HUN', 348, 'Hungria'),
('YE', 'YEM', 887, 'Iémen'),
('IN', 'IND', 356, 'Índia'),
('ID', 'IDN', 360, 'Indonésia'),
('IQ', 'IRQ', 368, 'Iraque'),
('IR', 'IRN', 364, 'Irão'),
('IE', 'IRL', 372, 'Irlanda'),
('IS', 'ISL', 352, 'Islândia'),
('IL', 'ISR', 376, 'Israel'),
('IT', 'ITA', 380, 'Itália'),
('JM', 'JAM', 388, 'Jamaica'),
('JP', 'JPN', 392, 'Japão'),
('JE', 'JEY', 832, 'Jersey'),
('JO', 'JOR', 400, 'Jordânia'),
('KI', 'KIR', 296, 'Kiribati'),
('KW', 'KWT', 414, 'Kuwait'),
('LA', 'LAO', 418, 'Laos'),
('LS', 'LSO', 426, 'Lesoto'),
('LV', 'LVA', 428, 'Letónia'),
('LB', 'LBN', 422, 'Líbano'),
('LR', 'LBR', 430, 'Libéria'),
('LY', 'LBY', 434, 'Líbia'),
('LI', 'LIE', 438, 'Liechtenstein'),
('LT', 'LTU', 440, 'Lituânia'),
('LU', 'LUX', 442, 'Luxemburgo'),
('MO', 'MAC', 446, 'Macau'),
('MK', 'MKD', 807, 'Macedónia, República da'),
('MG', 'MDG', 450, 'Madagáscar'),
('MY', 'MYS', 458, 'Malásia'),
('MW', 'MWI', 454, 'Malawi'),
('MV', 'MDV', 462, 'Maldivas'),
('ML', 'MLI', 466, 'Mali'),
('MT', 'MLT', 470, 'Malta'),
('FK', 'FLK', 238, 'Malvinas, Ilhas (Falkland)'),
('IM', 'IMN', 833, 'Man, Ilha de'),
('MP', 'MNP', 580, 'Marianas Setentrionais'),
('MA', 'MAR', 504, 'Marrocos'),
('MH', 'MHL', 584, 'Marshall, Ilhas'),
('MQ', 'MTQ', 474, 'Martinica'),
('MU', 'MUS', 480, 'Maurícia'),
('MR', 'MRT', 478, 'Mauritânia'),
('YT', 'MYT', 175, 'Mayotte'),
('UM', 'UMI', 581, 'Menores Distantes dos Estados Unidos, Ilhas'),
('MX', 'MEX', 484, 'México'),
('MM', 'MMR', 104, 'Myanmar (antiga Birmânia)'),
('FM', 'FSM', 583, 'Micronésia, Estados Federados da'),
('MZ', 'MOZ', 508, 'Moçambique'),
('MD', 'MDA', 498, 'Moldávia'),
('MC', 'MCO', 492, 'Mónaco'),
('MN', 'MNG', 496, 'Mongólia'),
('ME', 'MNE', 499, 'Montenegro'),
('MS', 'MSR', 500, 'Montserrat'),
('NA', 'NAM', 516, 'Namíbia'),
('NR', 'NRU', 520, 'Nauru'),
('NP', 'NPL', 524, 'Nepal'),
('NI', 'NIC', 558, 'Nicarágua'),
('NE', 'NER', 562, 'Níger'),
('NG', 'NGA', 566, 'Nigéria'),
('NU', 'NIU', 570, 'Niue'),
('NF', 'NFK', 574, 'Norfolk, Ilha'),
('NO', 'NOR', 578, 'Noruega'),
('NC', 'NCL', 540, 'Nova Caledónia'),
('NZ', 'NZL', 554, 'Nova Zelândia (Aotearoa)'),
('OM', 'OMN', 512, 'Oman'),
('NL', 'NLD', 528, 'Países Baixos (Holanda)'),
('PW', 'PLW', 585, 'Palau'),
('PS', 'PSE', 275, 'Palestina'),
('PA', 'PAN', 591, 'Panamá'),
('PG', 'PNG', 598, 'Papua-Nova Guiné'),
('PK', 'PAK', 586, 'Paquistão'),
('PY', 'PRY', 600, 'Paraguai'),
('PE', 'PER', 604, 'Peru'),
('PN', 'PCN', 612, 'Pitcairn'),
('PF', 'PYF', 258, 'Polinésia Francesa'),
('PL', 'POL', 616, 'Polónia'),
('PR', 'PRI', 630, 'Porto Rico'),
('PT', 'PRT', 620, 'Portugal'),
('QA', 'QAT', 634, 'Qatar'),
('KE', 'KEN', 404, 'Quénia'),
('KG', 'KGZ', 417, 'Quirguistão'),
('GB', 'GBR', 826, 'Reino Unido da Grã-Bretanha e Irlanda do Norte'),
('RE', 'REU', 638, 'Reunião'),
('RO', 'ROU', 642, 'Roménia'),
('RW', 'RWA', 646, 'Ruanda'),
('RU', 'RUS', 643, 'Rússia'),
('EH', 'ESH', 732, 'Saara Ocidental'),
('AS', 'ASM', 16, 'Samoa Americana'),
('WS', 'WSM', 882, 'Samoa (Samoa Ocidental)'),
('PM', 'SPM', 666, 'Saint Pierre et Miquelon'),
('SB', 'SLB', 90, 'Salomão, Ilhas'),
('KN', 'KNA', 659, 'São Cristóvão e Névis (Saint Kitts e Nevis)'),
('SM', 'SMR', 674, 'San Marino'),
('ST', 'STP', 678, 'São Tomé e Príncipe'),
('VC', 'VCT', 670, 'São Vicente e Granadinas'),
('SH', 'SHN', 654, 'Santa Helena'),
('LC', 'LCA', 662, 'Santa Lúcia'),
('SN', 'SEN', 686, 'Senegal'),
('SL', 'SLE', 694, 'Serra Leoa'),
('RS', 'SRB', 688, 'Sérvia'),
('SC', 'SYC', 690, 'Seychelles'),
('SG', 'SGP', 702, 'Singapura'),
('SY', 'SYR', 760, 'Síria'),
('SO', 'SOM', 706, 'Somália'),
('LK', 'LKA', 144, 'Sri Lanka'),
('SZ', 'SWZ', 748, 'Suazilândia'),
('SD', 'SDN', 736, 'Sudão'),
('SE', 'SWE', 752, 'Suécia'),
('CH', 'CHE', 756, 'Suíça'),
('SR', 'SUR', 740, 'Suriname'),
('SJ', 'SJM', 744, 'Svalbard e Jan Mayen'),
('TH', 'THA', 764, 'Tailândia'),
('TW', 'TWN', 158, 'Taiwan'),
('TJ', 'TJK', 762, 'Tajiquistão'),
('TZ', 'TZA', 834, 'Tanzânia'),
('TF', 'ATF', 260, 'Terras Austrais e Antárticas Francesas (TAAF)'),
('IO', 'IOT', 86, 'Território Britânico do Oceano Índico'),
('TL', 'TLS', 626, 'Timor-Leste'),
('TG', 'TGO', 768, 'Togo'),
('TK', 'TKL', 772, 'Toquelau'),
('TO', 'TON', 776, 'Tonga'),
('TT', 'TTO', 780, 'Trindade e Tobago'),
('TN', 'TUN', 788, 'Tunísia'),
('TC', 'TCA', 796, 'Turks e Caicos'),
('TM', 'TKM', 795, 'Turquemenistão'),
('TR', 'TUR', 792, 'Turquia'),
('TV', 'TUV', 798, 'Tuvalu'),
('UA', 'UKR', 804, 'Ucrânia'),
('UG', 'UGA', 800, 'Uganda'),
('UY', 'URY', 858, 'Uruguai'),
('UZ', 'UZB', 860, 'Usbequistão'),
('VU', 'VUT', 548, 'Vanuatu'),
('VA', 'VAT', 336, 'Vaticano'),
('VE', 'VEN', 862, 'Venezuela'),
('VN', 'VNM', 704, 'Vietname'),
('VI', 'VIR', 850, 'Virgens Americanas, Ilhas'),
('VG', 'VGB', 92, 'Virgens Britânicas, Ilhas'),
('WF', 'WLF', 876, 'Wallis e Futuna'),
('ZM', 'ZMB', 894, 'Zâmbia'),
('ZW', 'ZWE', 716, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `produto`
--

CREATE TABLE IF NOT EXISTS `produto` (
  `idproduto` int(11) unsigned NOT NULL auto_increment,
  `cod_interno` varchar(10) NOT NULL,
  `txtproduto` varchar(60) default NULL,
  `cod_barra` varchar(20) default NULL,
  `produtotipo_idprodutotipo` int(11) unsigned default NULL,
  `fornecedor_idfornecedor` int(11) unsigned default NULL,
  `qtdestoque` int(11) unsigned default NULL,
  `vlcusto` decimal(10,2) default NULL,
  `vlatacado` decimal(10,2) default NULL,
  `vlprontaentrega` decimal(10,2) NOT NULL,
  `vlvarejo` decimal(10,2) default NULL,
  `grade` tinyint(1) unsigned NOT NULL default '0',
  `stcontroleestoque` smallint(6) NOT NULL default '0',
  `colecao_idcolecao` int(11) unsigned NOT NULL default '0',
  `dtcadastro` int(11) NOT NULL default '0',
  `txtinfoadicional` varchar(255) default NULL,
  `sync_timestamp` int(11) unsigned default NULL,
  PRIMARY KEY  (`idproduto`),
  UNIQUE KEY `txtproduto` (`txtproduto`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `produto`
--


-- --------------------------------------------------------

--
-- Table structure for table `produtotipo`
--

CREATE TABLE IF NOT EXISTS `produtotipo` (
  `idprodutotipo` int(6) unsigned NOT NULL auto_increment,
  `txtnome` varchar(30) default NULL,
  `sync_timestamp` int(11) unsigned default NULL,
  PRIMARY KEY  (`idprodutotipo`),
  UNIQUE KEY `txtnome` (`txtnome`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `produtotipo`
--

INSERT INTO `produtotipo` (`idprodutotipo`, `txtnome`, `sync_timestamp`) VALUES
(5, 'VESTIDO', NULL),
(6, 'BLUSA', NULL),
(7, 'BIQUINI', NULL),
(8, 'KAFTA', NULL),
(9, 'MAIO', NULL),
(10, 'SHORT', NULL),
(11, 'TOP', NULL),
(12, 'SAIA', NULL),
(13, 'CASACO', NULL),
(14, 'TRICOT', NULL),
(15, 'ACESSÓRIO', NULL),
(16, 'SANDALIA', NULL),
(17, 'CAMISA', NULL),
(18, 'JAQUETA', NULL),
(19, 'BOLSA', NULL),
(20, 'CINTO', NULL),
(21, 'TUNICA', NULL),
(22, 'CALÇA', NULL),
(23, 'SAPATILHA', NULL),
(24, 'BOTA', NULL),
(25, 'COLETE', NULL),
(26, 'MACAQUINHO', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `produto_notaentrada`
--

CREATE TABLE IF NOT EXISTS `produto_notaentrada` (
  `idnotaentrada` int(11) unsigned NOT NULL auto_increment,
  `nnota` int(11) unsigned default NULL,
  `icms` decimal(10,2) default NULL,
  `frete` decimal(10,2) default NULL,
  `vldesc` decimal(10,2) default NULL,
  `icmssub` decimal(10,2) default NULL,
  `ipi` decimal(10,2) default NULL,
  `vltotal` decimal(10,2) default NULL,
  `dtnota` date default NULL,
  `idproduto` int(11) unsigned default NULL,
  `arraygrade` text NOT NULL,
  `fornecedor_idfornecedor` int(11) unsigned default NULL,
  `sync_timestamp` int(11) unsigned default NULL,
  PRIMARY KEY  (`idnotaentrada`),
  KEY `idproduto` (`idproduto`),
  KEY `dtnota` (`dtnota`),
  KEY `fornecedor_idfornecedor` (`fornecedor_idfornecedor`),
  KEY `nnota` (`nnota`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `produto_notaentrada`
--


-- --------------------------------------------------------

--
-- Table structure for table `rvs_agendaeventos`
--

CREATE TABLE IF NOT EXISTS `rvs_agendaeventos` (
  `idagendaeventos` int(10) unsigned NOT NULL auto_increment,
  `inicio` int(10) unsigned NOT NULL,
  `final` int(10) unsigned NOT NULL,
  `tarefa` text collate utf8_unicode_ci,
  `status` tinyint(1) NOT NULL,
  `sync_timestamp` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`idagendaeventos`),
  KEY `inicio` (`inicio`,`final`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `rvs_agendaeventos`
--


-- --------------------------------------------------------

--
-- Table structure for table `terminal`
--

CREATE TABLE IF NOT EXISTS `terminal` (
  `idterminal` int(11) unsigned NOT NULL auto_increment,
  `nomemaquina` varchar(50) NOT NULL default '',
  `stterminal` tinyint(1) unsigned NOT NULL default '0',
  `sync_timestamp` int(11) unsigned default NULL,
  PRIMARY KEY  (`idterminal`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `terminal`
--

ALTER TABLE  `cliente` ADD PRIMARY KEY (  `idcliente` ) ;
ALTER TABLE  `cliente` CHANGE  `idcliente`  `idcliente` INT( 11 ) NOT NULL AUTO_INCREMENT;

