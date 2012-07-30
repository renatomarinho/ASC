<?
////////////////////////////////////////////////////////////////////////////////////////
//                                                                                    //
// NOTICE OF COPYRIGHT                                                                //
//                                                                                    //
// ASC - Ajax Sales Cloud - http://www.greyland.com.br                                                  //
//                                                                                    //
// Copyright (C) 2008 onwards Renato Marinho ( renato.marinho@greyland.com.br )         //
//                                                                                    //
// This program is free software; you can redistribute it and/or modify it under      //
// the terms of the GNU General Public License as published by the Free Software      //
// Foundation; either version 3 of the License, or (at your option) any later         //
// version.                                                                           //
//                                                                                    //
// This program is distributed in the hope that it will be useful, but WITHOUT ANY    // 
// WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A    //
// PARTICULAR PURPOSE.  See the GNU General Public License for more details:          //
//                                                                                    //
//  http://www.gnu.org/copyleft/gpl.html                                              //
//                                                                                    //
////////////////////////////////////////////////////////////////////////////////////////

ob_start ();

header ( 'Content-Type: text/html; charset=ISO-8859-1' );

require "config/default.php";

$db = new db ( );
$db->connect ();

$sql = "CREATE TABLE `atualizacao` ( `codigo` int(11) NOT NULL auto_increment, `timestamp` int(11) default NULL, PRIMARY KEY  (`codigo`) ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;";

$sql = "CREATE TABLE `banco` ( `idbanco` int(11) unsigned NOT NULL auto_increment, `nome` varchar(25) NOT NULL, `status` tinyint(4) NOT NULL default '1', `sync_timestamp` int(11) unsigned default NULL, PRIMARY KEY  (`idbanco`) )ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

$sql = "ALTER TABLE `cartoes` ADD `tipo` TINYINT NOT NULL AFTER `id` , ADD `sync_timestamp` INT NOT NULL AFTER `tipo` ;";

$sql = "DROP TABLE `cad_empresa`; CREATE TABLE `cad_empresa` ( `id` int(8) unsigned NOT NULL auto_increment, `nome_empresa` varchar(100) default NULL, `endereco` varchar(100) default NULL, `cidade` varchar(30) default NULL, `uf` char(2) default NULL, `cnpj` varchar(18) default NULL, `ie` varchar(16) default NULL, `telefone` varchar(15) default NULL, `fax` varchar(15) default NULL, `mensagem` varchar(200) default NULL, `qtd_terminal` int(3) unsigned zerofill default '001', `serial_key` varchar(255) default NULL, `im` varchar(20) default NULL, `qtd_turnos` char(1) NOT NULL default '1', `email` varchar(200) default NULL, `site` varchar(200) default NULL, `bairro` varchar(200) default NULL, `cep` varchar(15) default NULL, `sync_timestamp` int(11) unsigned default NULL, PRIMARY KEY  (`id`) ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

$sql = "DROP TABLE `cad_login`; CREATE TABLE `cad_login` ( `id` int(11) unsigned NOT NULL auto_increment, `login` varchar(15) default NULL, `senha` varchar(60) default NULL, `autoriza` varchar(25) default NULL, `ativo` enum('ativo','desativo') NOT NULL default 'ativo', `nome` varchar(20) NOT NULL, `sync_timestamp` int(11) unsigned default NULL, PRIMARY KEY  (`id`), UNIQUE KEY `login` (`login`) ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

$sql = "INSERT INTO `cad_login` (`id`, `login`, `senha`, `autoriza`, `ativo`, `nome`, `sync_timestamp`) VALUES (1, 'ROOT', 'e10adc3949ba59abbe56e057f20f883e', '1111111111111111111111111', 'ativo', 'MASTER ROOT', NULL)";

$sql = "ALTER TABLE `cad_plano_de_contas` ADD `sync_timestamp` INT NOT NULL ;";

$sql = "ALTER TABLE `cad_produtos_grade` CHANGE `id` `id` INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT , CHANGE `id_produto` `id_produto` INT( 11 ) UNSIGNED NOT NULL DEFAULT '0', CHANGE `descricao` `descricao` VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0', CHANGE `quantidade` `quantidade` INT NULL DEFAULT '0' ";

$sql = "ALTER TABLE `cad_produtos_grade` ADD `vlprodgrade` DECIMAL( 10, 2 ) NOT NULL AFTER `quantidade` , ADD `sync_timestamp` INT NOT NULL AFTER `vlprodgrade` ;";

$sql = "ALTER TABLE `cad_clientes` CHANGE `id` `idcliente` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT, CHANGE `nome_cliente` `txtnome` VARCHAR(60) default NULL, CHANGE `endereco` `txtendereco` VARCHAR(50) default NULL, CHANGE `bairro` `txtbairro` VARCHAR(30) default NULL, CHANGE `cidade` `txtcidade` VARCHAR(30) default NULL, CHANGE `uf` `txtuf` CHAR(2) default NULL, CHANGE `telefone` `txttelefone` VARCHAR(15) default NULL, CHANGE `celular` `txtcelular` VARCHAR(15) default NULL, CHANGE `email` `txtemail` VARCHAR(100) default NULL, CHANGE `cpf` `txtcpf` VARCHAR(18) default NULL, CHANGE `cep` `txtcep` VARCHAR(15) default NULL, CHANGE `cod_barra` `txtcod_barra` VARCHAR(15) default NULL, CHANGE `dtaniver` `dtaniversario` date NOT NULL default '0000-00-00', CHANGE `rg` `txtrg` varchar(16) default NULL, CHANGE `inf_adicional` `txtinf_adicional` text; ";

$sql = "ALTER TABLE `cad_clientes` DROP `faixasalarial`, DROP `ie`;";

$sql = "ALTER TABLE `cad_clientes` ADD `dtcadastro` date NOT NULL default '0000-00-00' , ADD `sync_timestamp` INT NOT NULL ;";

$sql = "RENAME TABLE `real_rvs_fake`.`cad_clientes`  TO `real_rvs_fake`.`cliente` ;";

$sql = "CREATE TABLE IF NOT EXISTS `colecao` ( `idcolecao` int(11) unsigned NOT NULL auto_increment, `txtnome` varchar(30) NOT NULL default '', `txtperiodo` varchar(45) NOT NULL default '', `txtdescricao` text NOT NULL, `sync_timestamp` int(11) unsigned default NULL, PRIMARY KEY  (`idcolecao`) ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;";

$sql = " ALTER TABLE `mv_estoque` CHANGE `id` `idestoque` INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT , CHANGE `id_produto` `produto_idproduto` INT( 11 ) NULL DEFAULT NULL , CHANGE `quantidade` `nquantidade` INT( 11 ) NULL DEFAULT NULL , CHANGE `modo_estoque` `sync_timestamp` INT( 11 ) NULL DEFAULT NULL ";

$sql = "RENAME TABLE `real_rvs_fake`.`mv_estoque`  TO `real_rvs_fake`.`estoque` ;";

$sql = " ALTER TABLE `eti_config` CHANGE `pag_comprimento` `pag_comprimento` DECIMAL( 10, 2 ) NULL DEFAULT NULL , CHANGE `pag_largura` `pag_largura` DECIMAL( 10, 2 ) NULL DEFAULT NULL , CHANGE `espaco_colunas` `espaco_colunas` DECIMAL( 10, 2 ) NULL DEFAULT NULL , CHANGE `etq_comprimento` `etq_comprimento` DECIMAL( 10, 2 ) NULL DEFAULT NULL , CHANGE `marg_top` `marg_top` DECIMAL( 10, 2 ) NULL DEFAULT NULL , CHANGE `marg_bottom` `marg_bottom` DECIMAL( 10, 2 ) NULL DEFAULT NULL , CHANGE `marg_left` `marg_left` DECIMAL( 10, 2 ) NULL DEFAULT NULL , CHANGE `marg_right` `marg_right` DECIMAL( 10, 2 ) NULL DEFAULT NULL ";

$sql = "ALTER TABLE `eti_config` ADD `sync_timestamp` INT UNSIGNED NOT NULL AFTER `AJUSTE_EM` ;";

$sql = "ALTER TABLE `eti_config_campo` CHANGE `id` `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , CHANGE `id_etiqueta` `id_etiqueta` INT UNSIGNED NULL DEFAULT NULL , CHANGE `id_class` `id_class` INT UNSIGNED NULL DEFAULT NULL , CHANGE `usar` `usar` INT UNSIGNED NULL DEFAULT NULL , CHANGE `top_e` `top_e` DECIMAL( 10, 2 ) NULL DEFAULT NULL , CHANGE `left_e` `left_e` DECIMAL( 10, 2 ) NULL DEFAULT NULL , CHANGE `width_e` `width_e` DECIMAL( 10, 2 ) NULL DEFAULT NULL , CHANGE `height_e` `height_e` DECIMAL( 10, 2 ) NULL DEFAULT NULL ";

$sql = "ALTER TABLE `eti_config_campo` ADD `sync_timestamp` INT UNSIGNED NOT NULL AFTER `font_size_e` ;";

$sql = "RENAME TABLE `real_rvs_fake`.`cad_fornecedores`  TO `real_rvs_fake`.`fornecedor` ;";

$sql = "ALTER TABLE `fornecedor` CHANGE `id` `idfornecedor` INT UNSIGNED NOT NULL AUTO_INCREMENT , CHANGE `nome_fornecedor` `nome` VARCHAR( 60 ) NULL DEFAULT NULL , CHANGE `cnpj` `cnpj` VARCHAR( 18 ) NULL DEFAULT NULL , CHANGE `uf` `uf` CHAR( 2 ) NULL DEFAULT NULL , CHANGE `cidade` `cidade` VARCHAR( 20 ) NULL DEFAULT NULL , CHANGE `rua` `endereco` VARCHAR( 50 ) NULL DEFAULT NULL , CHANGE `contato` `contato` VARCHAR( 30 ) NULL DEFAULT NULL , CHANGE `e_mail` `email` VARCHAR( 100 ) NULL DEFAULT NULL , CHANGE `telefone` `telefone` VARCHAR( 15 ) NULL DEFAULT NULL , CHANGE `fax` `fax` VARCHAR( 15 ) NULL DEFAULT NULL , CHANGE `ie` `ie` VARCHAR( 16 ) NULL DEFAULT NULL , CHANGE `cep` `cep` VARCHAR( 15 ) NULL DEFAULT NULL , CHANGE `bairro` `bairro` VARCHAR( 60 ) NULL DEFAULT NULL ";

$sql = "ALTER TABLE `fornecedor` ADD `contatoarea` VARCHAR( 60 ) NOT NULL AFTER `bairro` , ADD `telefoneramal` VARCHAR( 6 ) NOT NULL AFTER `contatoarea` , ADD `telefone2` VARCHAR( 15 ) NOT NULL AFTER `telefoneramal` , ADD `telefone2ramal` VARCHAR( 6 ) NOT NULL AFTER `telefone2` , ADD `idpais` INT NOT NULL AFTER `telefone2ramal` , ADD `sync_timestamp` INT UNSIGNED NOT NULL AFTER `idpais` ;";

$sql = "CREATE TABLE `log_estoque_acao` ( `id` int(11) unsigned NOT NULL auto_increment, `acao` text NOT NULL, `controle` int(11) NOT NULL default '0', `id_produto` int(11) NOT NULL default '0', `grade_id` int(11) NOT NULL default '0', `cad_login_id` int(11) NOT NULL default '0', `quantidade` int(11) NOT NULL default '0', `quantidade_nova` int(11) NOT NULL default '0', `datalog` int(11) unsigned default NULL, `sync_timestamp` int(11) unsigned default NULL,   PRIMARY KEY  (`id`) ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

$sql = "CREATE TABLE `log_login` ( `id` int(11) NOT NULL auto_increment, `cad_login_id` int(11) NOT NULL default '0', `datalog` int(11) unsigned default NULL, `sync_timestamp` int(11) unsigned default NULL, PRIMARY KEY  (`id`) ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

$sql = "CREATE TABLE `motivocancelamentovenda` ( `idmotivo` int(11) unsigned NOT NULL auto_increment, `id_login` int(11) NOT NULL, `controle` int(11) unsigned default NULL, `vr_total` decimal(10,2) NOT NULL, `txtmotivo` text NOT NULL, `idcliente` int(11) NOT NULL, `stmotivo` tinyint(4) NOT NULL, `produtoscarrinho` text NOT NULL, `sync_timestamp` int(11) unsigned default NULL, PRIMARY KEY  (`idmotivo`) ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

$sql = "CREATE TABLE `mv_caixa` ( `id` int(11) unsigned NOT NULL auto_increment, `abertura` int(11) unsigned default NULL, `fechamento` int(11) unsigned default NULL, `vr_abertura` decimal(10,2) default NULL, `vr_fechamento` decimal(10,2) default NULL, `cad_login_id` int(11) unsigned default NULL, `turno` char(1) default NULL, `terminal` char(2) default NULL, `sync_timestamp` int(11) unsigned default NULL, PRIMARY KEY  (`id`) ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

$sql = "DROP TABLE mv_fechamento;";

$sql = "CREATE TABLE `mv_cartao` ( `idmv_cartao` int(10) unsigned NOT NULL auto_increment, `controle` int(10) unsigned default NULL, `id_cartao` int(10) unsigned default NULL, `parcela` int(10) unsigned default NULL, `vrparcela` decimal(10,2) default NULL, `syc_timestamp` int(10) unsigned default NULL, PRIMARY KEY  (`idmv_cartao`)) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

$sql = "CREATE TABLE `terminal` (   `idterminal` int(11) unsigned NOT NULL auto_increment,  `nomemaquina` varchar(50) NOT NULL default '',  `stterminal` tinyint(1) unsigned NOT NULL default '0',  `sync_timestamp` int(11) unsigned default NULL,  PRIMARY KEY  (`idterminal`)) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

$sql = "CREATE TABLE `rvs_agendaeventos` (  `idagendaeventos` int(10) unsigned NOT NULL auto_increment,  `inicio` int(10) unsigned NOT NULL,  `final` int(10) unsigned NOT NULL,  `tarefa` text collate utf8_unicode_ci,  `status` tinyint(1) NOT NULL,  `sync_timestamp` int(10) unsigned NOT NULL,  PRIMARY KEY  (`idagendaeventos`),  KEY `inicio` (`inicio`,`final`)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;";

$sql = "CREATE TABLE `produto_notaentrada` (  `idnotaentrada` int(11) unsigned NOT NULL auto_increment,  `nnota` int(11) unsigned default NULL,  `icms` decimal(10,2) default NULL,  `frete` decimal(10,2) default NULL,  `vldesc` decimal(10,2) default NULL,  `icmssub` decimal(10,2) default NULL,  `ipi` decimal(10,2) default NULL,  `vltotal` decimal(10,2) default NULL,  `dtnota` date default NULL,  `idproduto` int(11) unsigned default NULL,  `arraygrade` text NOT NULL,  `fornecedor_idfornecedor` int(11) unsigned default NULL,  `sync_timestamp` int(11) unsigned default NULL,  PRIMARY KEY  (`idnotaentrada`),  KEY `idproduto` (`idproduto`),  KEY `dtnota` (`dtnota`),  KEY `fornecedor_idfornecedor` (`fornecedor_idfornecedor`),  KEY `nnota` (`nnota`)) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

$sql = "ALTER TABLE `cad_produtos_tipo` ADD `sync_timestamp` INT( 11 ) NOT NULL AFTER `nome_tipo` ;";

$sql = "ALTER TABLE `cad_produtos_tipo` CHANGE `id` `idprodutotipo` INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT ";

$sql = "ALTER TABLE `cad_produtos_tipo` CHANGE `nome_tipo` `txtnome` VARCHAR( 30 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ";

$sql = "RENAME TABLE `rvs_classic`.`cad_produtos_tipo`  TO `rvs_classic`.`produtotipo` ;";

$sql = "ALTER TABLE `cad_produtos` CHANGE `id` `idproduto` INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT , CHANGE `nome_produto` `txtproduto` VARCHAR( 60 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL , CHANGE `id_tipo` `produtotipo_idprodutotipo` INT( 11 ) UNSIGNED NULL DEFAULT NULL , CHANGE `id_fornecedor` `fornecedor_idfornecedor` INT( 11 ) UNSIGNED NULL DEFAULT NULL , CHANGE `cod_barra` `cod_barra` VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ";

$sql = "ALTER TABLE `cad_produtos` CHANGE `vr_compra` `vlcusto` DECIMAL( 10, 2 ) NULL DEFAULT NULL , CHANGE `vr_venda` `vlatacado` DECIMAL( 10, 2 ) NULL DEFAULT NULL , CHANGE `vr_venda_2` `vlvarejo` DECIMAL( 10, 2 ) NULL DEFAULT NULL ";

$sql = "ALTER TABLE `cad_produtos` CHANGE `vlatacado` `vlvarejo` DECIMAL( 10, 2 ) NULL DEFAULT NULL , CHANGE `vlvarejo` `vlatacado` DECIMAL( 10, 2 ) NULL DEFAULT NULL ";

$sql = "ALTER TABLE `cad_produtos` ADD `vlprontaentrega` DECIMAL( 10, 2 ) NOT NULL ;";

$sql = "ALTER TABLE `cad_produtos` CHANGE `modo_estoque` `stcontroleestoque` SMALLINT( 6 ) UNSIGNED NULL DEFAULT NULL ";

$sql = "ALTER TABLE `cad_produtos` ADD `colecao_idcolecao` INT( 11 ) NOT NULL ;";

$sql = "ALTER TABLE `cad_produtos` ADD `dtcadastro` INT( 11 ) NOT NULL ;";

$sql = "ALTER TABLE `cad_produtos` CHANGE `inf_adicional` `txtinfoadicional` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ";

$sql = "ALTER TABLE `cad_produtos` ADD `sync_timestamp` INT( 11 ) NOT NULL ;";

$sql = "ALTER TABLE `cad_produtos` ADD `qtdestoque` INT NOT NULL ;";

$sql = "RENAME TABLE `rvs_classic`.`cad_produtos`  TO `rvs_classic`.`produto` ;";

$sql = "CREATE TABLE `paises` ( `iso` char(2) collate utf8_unicode_ci NOT NULL,  `iso3` char(3) collate utf8_unicode_ci NOT NULL,  `numcode` smallint(6) default NULL,  `nome` varchar(255) collate utf8_unicode_ci NOT NULL,  PRIMARY KEY  (`iso`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";

$sql = "INSERT INTO `paises` (`iso`, `iso3`, `numcode`, `nome`) VALUES ('AF', 'AFG', 4, 'Afeganist�o'),('ZA', 'ZAF', 710, '�frica do Sul'),('AX', 'ALA', 248, '�land, Ilhas'),('AL', 'ALB', 8, 'Alb�nia'),('DE', 'DEU', 276, 'Alemanha'),('AD', 'AND', 20, 'Andorra'),('AO', 'AGO', 24, 'Angola'),('AI', 'AIA', 660, 'Anguilla'),('AQ', 'ATA', 10, 'Ant�rctida'),('AG', 'ATG', 28, 'Antigua e Barbuda'),('AN', 'ANT', 530, 'Antilhas Holandesas'),('SA', 'SAU', 682, 'Ar�bia Saudita'),('DZ', 'DZA', 12, 'Arg�lia'),('AR', 'ARG', 32, 'Argentina'),('AM', 'ARM', 51, 'Arm�nia'),('AW', 'ABW', 533, 'Aruba'),('AU', 'AUS', 36, 'Austr�lia'),('AT', 'AUT', 40, '�ustria'),('AZ', 'AZE', 31, 'Azerbeij�o'),('BS', 'BHS', 44, 'Bahamas'),('BH', 'BHR', 48, 'Bahrain'),('BD', 'BGD', 50, 'Bangladesh'),('BB', 'BRB', 52, 'Barbados'),('BE', 'BEL', 56, 'B�lgica'),('BZ', 'BLZ', 84, 'Belize'),('BJ', 'BEN', 204, 'Benin'),('BM', 'BMU', 60, 'Bermuda'),('BY', 'BLR', 112, 'Bielo-R�ssia'),('BO', 'BOL', 68, 'Bol�via'),('BA', 'BIH', 70, 'B�snia-Herzegovina'),('BW', 'BWA', 72, 'Botswana'),('BV', 'BVT', 74, 'Bouvet, Ilha'),('BR', 'BRA', 76, 'Brasil'),('BN', 'BRN', 96, 'Brunei'),('BG', 'BGR', 100, 'Bulg�ria'),('BF', 'BFA', 854, 'Burkina Faso'),('BI', 'BDI', 108, 'Burundi'),('BT', 'BTN', 64, 'But�o'),('CV', 'CPV', 132, 'Cabo Verde'),('KH', 'KHM', 116, 'Cambodja'),('CM', 'CMR', 120, 'Camar�es'),('CA', 'CAN', 124, 'Canad�'),('KY', 'CYM', 136, 'Cayman, Ilhas'),('KZ', 'KAZ', 398, 'Cazaquist�o'),('CF', 'CAF', 140, 'Centro-africana, Rep�blica'),('TD', 'TCD', 148, 'Chade'),('CZ', 'CZE', 203, 'Checa, Rep�blica'),('CL', 'CHL', 152, 'Chile'),('CN', 'CHN', 156, 'China'),('CY', 'CYP', 196, 'Chipre'),('CX', 'CXR', 162, 'Christmas, Ilha'),('CC', 'CCK', 166, 'Cocos, Ilhas'),('CO', 'COL', 170, 'Col�mbia'),('KM', 'COM', 174, 'Comores'),('CG', 'COG', 178, 'Congo, Rep�blica do'),('CD', 'COD', 180, 'Congo, Rep�blica Democr�tica do (antigo Zaire)'),('CK', 'COK', 184, 'Cook, Ilhas'),('KR', 'KOR', 410, 'Coreia do Sul'),('KP', 'PRK', 408, 'Coreia, Rep�blica Democr�tica da (Coreia do Norte)'),('CI', 'CIV', 384, 'Costa do Marfim'),('CR', 'CRI', 188, 'Costa Rica'),('HR', 'HRV', 191, 'Cro�cia'),('CU', 'CUB', 192, 'Cuba'),('DK', 'DNK', 208, 'Dinamarca'),('DJ', 'DJI', 262, 'Djibouti'),('DM', 'DMA', 212, 'Dominica'),('DO', 'DOM', 214, 'Dominicana, Rep�blica'),('EG', 'EGY', 818, 'Egipto'),('SV', 'SLV', 222, 'El Salvador'),('AE', 'ARE', 784, 'Emiratos �rabes Unidos'),('EC', 'ECU', 218, 'Equador'),('ER', 'ERI', 232, 'Eritreia'),('SK', 'SVK', 703, 'Eslov�quia'),('SI', 'SVN', 705, 'Eslov�nia'),('ES', 'ESP', 724, 'Espanha'),('US', 'USA', 840, 'Estados Unidos da Am�rica'),('EE', 'EST', 233, 'Est�nia'),('ET', 'ETH', 231, 'Eti�pia'),('FO', 'FRO', 234, 'Faroe, Ilhas'),('FJ', 'FJI', 242, 'Fiji'),('PH', 'PHL', 608, 'Filipinas'),('FI', 'FIN', 246, 'Finl�ndia'),('FR', 'FRA', 250, 'Fran�a'),('GA', 'GAB', 266, 'Gab�o'),('GM', 'GMB', 270, 'G�mbia'),('GH', 'GHA', 288, 'Gana'),('GE', 'GEO', 268, 'Ge�rgia'),('GS', 'SGS', 239, 'Ge�rgia do Sul e Sandwich do Sul, Ilhas'),('GI', 'GIB', 292, 'Gibraltar'),('GR', 'GRC', 300, 'Gr�cia'),('GD', 'GRD', 308, 'Grenada'),('GL', 'GRL', 304, 'Gronel�ndia'),('GP', 'GLP', 312, 'Guadeloupe'),('GU', 'GUM', 316, 'Guam'),('GT', 'GTM', 320, 'Guatemala'),('GG', 'GGY', 831, 'Guernsey'),('GY', 'GUY', 328, 'Guiana'),('GF', 'GUF', 254, 'Guiana Francesa'),('GW', 'GNB', 624, 'Guin�-Bissau'),('GN', 'GIN', 324, 'Guin�-Conacri'),('GQ', 'GNQ', 226, 'Guin� Equatorial'),('HT', 'HTI', 332, 'Haiti'),('HM', 'HMD', 334, 'Heard e Ilhas McDonald, Ilha'),('HN', 'HND', 340, 'Honduras'),('HK', 'HKG', 344, 'Hong Kong'),('HU', 'HUN', 348, 'Hungria'),('YE', 'YEM', 887, 'I�men'),('IN', 'IND', 356, '�ndia'),('ID', 'IDN', 360, 'Indon�sia'),('IQ', 'IRQ', 368, 'Iraque'),('IR', 'IRN', 364, 'Ir�o'),('IE', 'IRL', 372, 'Irlanda'),('IS', 'ISL', 352, 'Isl�ndia'),('IL', 'ISR', 376, 'Israel'),('IT', 'ITA', 380, 'It�lia'),('JM', 'JAM', 388, 'Jamaica'),('JP', 'JPN', 392, 'Jap�o'),('JE', 'JEY', 832, 'Jersey'),('JO', 'JOR', 400, 'Jord�nia'),('KI', 'KIR', 296, 'Kiribati'),('KW', 'KWT', 414, 'Kuwait'),('LA', 'LAO', 418, 'Laos'),('LS', 'LSO', 426, 'Lesoto'),('LV', 'LVA', 428, 'Let�nia'),('LB', 'LBN', 422, 'L�bano'),('LR', 'LBR', 430, 'Lib�ria'),('LY', 'LBY', 434, 'L�bia'),('LI', 'LIE', 438, 'Liechtenstein'),('LT', 'LTU', 440, 'Litu�nia'),('LU', 'LUX', 442, 'Luxemburgo'),('MO', 'MAC', 446, 'Macau'),('MK', 'MKD', 807, 'Maced�nia, Rep�blica da'),('MG', 'MDG', 450, 'Madag�scar'),('MY', 'MYS', 458, 'Mal�sia'),('MW', 'MWI', 454, 'Malawi'),('MV', 'MDV', 462, 'Maldivas'),('ML', 'MLI', 466, 'Mali'),('MT', 'MLT', 470, 'Malta'),('FK', 'FLK', 238, 'Malvinas, Ilhas (Falkland)'),('IM', 'IMN', 833, 'Man, Ilha de'),('MP', 'MNP', 580, 'Marianas Setentrionais'),('MA', 'MAR', 504, 'Marrocos'),('MH', 'MHL', 584, 'Marshall, Ilhas'),('MQ', 'MTQ', 474, 'Martinica'),('MU', 'MUS', 480, 'Maur�cia'),('MR', 'MRT', 478, 'Maurit�nia'),('YT', 'MYT', 175, 'Mayotte'),('UM', 'UMI', 581, 'Menores Distantes dos Estados Unidos, Ilhas'),('MX', 'MEX', 484, 'M�xico'),('MM', 'MMR', 104, 'Myanmar (antiga Birm�nia)'),('FM', 'FSM', 583, 'Micron�sia, Estados Federados da'),('MZ', 'MOZ', 508, 'Mo�ambique'),('MD', 'MDA', 498, 'Mold�via'),('MC', 'MCO', 492, 'M�naco'),('MN', 'MNG', 496, 'Mong�lia'),('ME', 'MNE', 499, 'Montenegro'),('MS', 'MSR', 500, 'Montserrat'),('NA', 'NAM', 516, 'Nam�bia'),('NR', 'NRU', 520, 'Nauru'),('NP', 'NPL', 524, 'Nepal'),('NI', 'NIC', 558, 'Nicar�gua'),('NE', 'NER', 562, 'N�ger'),('NG', 'NGA', 566, 'Nig�ria'),('NU', 'NIU', 570, 'Niue'),('NF', 'NFK', 574, 'Norfolk, Ilha'),('NO', 'NOR', 578, 'Noruega'),('NC', 'NCL', 540, 'Nova Caled�nia'),('NZ', 'NZL', 554, 'Nova Zel�ndia (Aotearoa)'),('OM', 'OMN', 512, 'Oman'),('NL', 'NLD', 528, 'Pa�ses Baixos (Holanda)'),('PW', 'PLW', 585, 'Palau'),('PS', 'PSE', 275, 'Palestina'),('PA', 'PAN', 591, 'Panam�'),('PG', 'PNG', 598, 'Papua-Nova Guin�'),('PK', 'PAK', 586, 'Paquist�o'),('PY', 'PRY', 600, 'Paraguai'),('PE', 'PER', 604, 'Peru'),('PN', 'PCN', 612, 'Pitcairn'),('PF', 'PYF', 258, 'Polin�sia Francesa'),('PL', 'POL', 616, 'Pol�nia'),('PR', 'PRI', 630, 'Porto Rico'),('PT', 'PRT', 620, 'Portugal'),('QA', 'QAT', 634, 'Qatar'),('KE', 'KEN', 404, 'Qu�nia'),('KG', 'KGZ', 417, 'Quirguist�o'),('GB', 'GBR', 826, 'Reino Unido da Gr�-Bretanha e Irlanda do Norte'),('RE', 'REU', 638, 'Reuni�o'),('RO', 'ROU', 642, 'Rom�nia'),('RW', 'RWA', 646, 'Ruanda'),('RU', 'RUS', 643, 'R�ssia'),('EH', 'ESH', 732, 'Saara Ocidental'),('AS', 'ASM', 16, 'Samoa Americana'),('WS', 'WSM', 882, 'Samoa (Samoa Ocidental)'),('PM', 'SPM', 666, 'Saint Pierre et Miquelon'),('SB', 'SLB', 90, 'Salom�o, Ilhas'),('KN', 'KNA', 659, 'S�o Crist�v�o e N�vis (Saint Kitts e Nevis)'),('SM', 'SMR', 674, 'San Marino'),('ST', 'STP', 678, 'S�o Tom� e Pr�ncipe'),('VC', 'VCT', 670, 'S�o Vicente e Granadinas'),('SH', 'SHN', 654, 'Santa Helena'),('LC', 'LCA', 662, 'Santa L�cia'),('SN', 'SEN', 686, 'Senegal'),('SL', 'SLE', 694, 'Serra Leoa'),('RS', 'SRB', 688, 'S�rvia'),('SC', 'SYC', 690, 'Seychelles'),('SG', 'SGP', 702, 'Singapura'),('SY', 'SYR', 760, 'S�ria'),('SO', 'SOM', 706, 'Som�lia'),('LK', 'LKA', 144, 'Sri Lanka'),('SZ', 'SWZ', 748, 'Suazil�ndia'),('SD', 'SDN', 736, 'Sud�o'),('SE', 'SWE', 752, 'Su�cia'),('CH', 'CHE', 756, 'Su��a'),('SR', 'SUR', 740, 'Suriname'),('SJ', 'SJM', 744, 'Svalbard e Jan Mayen'),('TH', 'THA', 764, 'Tail�ndia'),('TW', 'TWN', 158, 'Taiwan'),('TJ', 'TJK', 762, 'Tajiquist�o'),('TZ', 'TZA', 834, 'Tanz�nia'),('TF', 'ATF', 260, 'Terras Austrais e Ant�rticas Francesas (TAAF)'),('IO', 'IOT', 86, 'Territ�rio Brit�nico do Oceano �ndico'),('TL', 'TLS', 626, 'Timor-Leste'),('TG', 'TGO', 768, 'Togo'),('TK', 'TKL', 772, 'Toquelau'),('TO', 'TON', 776, 'Tonga'),('TT', 'TTO', 780, 'Trindade e Tobago'),('TN', 'TUN', 788, 'Tun�sia'),('TC', 'TCA', 796, 'Turks e Caicos'),('TM', 'TKM', 795, 'Turquemenist�o'),('TR', 'TUR', 792, 'Turquia'),('TV', 'TUV', 798, 'Tuvalu'),('UA', 'UKR', 804, 'Ucr�nia'),('UG', 'UGA', 800, 'Uganda'),('UY', 'URY', 858, 'Uruguai'),('UZ', 'UZB', 860, 'Usbequist�o'),('VU', 'VUT', 548, 'Vanuatu'),('VA', 'VAT', 336, 'Vaticano'),('VE', 'VEN', 862, 'Venezuela'),('VN', 'VNM', 704, 'Vietname'),('VI', 'VIR', 850, 'Virgens Americanas, Ilhas'),('VG', 'VGB', 92, 'Virgens Brit�nicas, Ilhas'),('WF', 'WLF', 876, 'Wallis e Futuna'),('ZM', 'ZMB', 894, 'Z�mbia'),('ZW', 'ZWE', 716, 'Zimbabwe');";

$sql = "CREATE TABLE `mv_venda_vip_produtos` (  `vip_produtos_id` int(11) NOT NULL auto_increment,  `venda_vip_id` int(11) unsigned default NULL,  `produto_idproduto` int(11) unsigned default NULL,  `produto_quantidade` int(11) unsigned default NULL,  `grade_id` int(11) unsigned default NULL,  `sync_timestamp` int(11) unsigned default NULL,  PRIMARY KEY  (`vip_produtos_id`)) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

$sql = "CREATE TABLE `mv_venda_vip` (  `vip_id` int(11) unsigned NOT NULL auto_increment,  `vip_controle` int(11) unsigned default NULL,  `id_cliente` int(11) unsigned default NULL,  `cad_login_id` int(11) unsigned default NULL,  `sync_timestamp` int(11) unsigned default NULL,  PRIMARY KEY  (`vip_id`)) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

$sql = "ALTER TABLE `mv_vendas_movimento` CHANGE `controle` `controle` INT( 11 ) NULL DEFAULT NULL ";

$sql = "ALTER TABLE `mv_vendas_movimento` CHANGE `id_cliente` `id_cliente` INT( 11 ) UNSIGNED NULL DEFAULT NULL ";

$sql = "ALTER TABLE `mv_vendas_movimento` CHANGE `id_login` `id_login` INT( 11 ) UNSIGNED NULL DEFAULT NULL ";

$sql = "ALTER TABLE `mv_vendas_movimento` CHANGE `id_produto` `id_produto` INT( 11 ) UNSIGNED NULL DEFAULT NULL ";

$sql = "ALTER TABLE `mv_vendas_movimento` CHANGE `id_grade` `id_grade` INT( 11 ) UNSIGNED NOT NULL DEFAULT '0'";

$sql = "ALTER TABLE `mv_vendas_movimento` CHANGE `quant` `quant` INT( 11 ) NULL DEFAULT NULL ";

$sql = "ALTER TABLE `mv_vendas_movimento` CHANGE `valor` `vr_custo` DECIMAL( 10, 2 ) NULL DEFAULT NULL ";

$sql = "ALTER TABLE `mv_vendas_movimento` ADD `vr_opcional` DECIMAL( 10, 2 ) NOT NULL ;";

$sql = "ALTER TABLE `mv_vendas_movimento` CHANGE `vr_total` `vr_total` DECIMAL( 10, 2 ) NULL DEFAULT NULL ";

$sql = "ALTER TABLE `mv_vendas_movimento` CHANGE `estornado` `estornado` TINYINT( 1 ) UNSIGNED NULL DEFAULT '0'";

$sql = "ALTER TABLE `mv_vendas_movimento` ADD `estornado_data` DATE NOT NULL ;";

$sql = "ALTER TABLE `mv_vendas_movimento` ADD `sync_timestamp` INT( 11 ) NOT NULL ;";

$sql = "ALTER TABLE `mv_vendas_movimento` DROP `modo_venda` ,DROP `modo_lancamento` ;";

$sql = "ALTER TABLE `mv_vendas` CHANGE `controle` `controle` INT( 11 ) NULL DEFAULT NULL ";

$sql = "ALTER TABLE `mv_vendas` CHANGE `id_cliente` `id_cliente` INT( 11 ) UNSIGNED NULL DEFAULT '0'";

$sql = "ALTER TABLE `mv_vendas` CHANGE `id_login` `id_login` INT( 11 ) UNSIGNED NULL DEFAULT NULL ";

$sql = "ALTER TABLE `mv_vendas` CHANGE `vr_total` `vr_totalvenda` DECIMAL( 10, 2 ) NULL DEFAULT NULL ";

$sql = "ALTER TABLE `mv_vendas` CHANGE `vr_adicional` `vr_opcionalvenda` DECIMAL( 10, 2 ) NULL DEFAULT NULL ";

$sql = "ALTER TABLE `mv_vendas` CHANGE `parcelas` `parcelas` TINYINT( 3 ) UNSIGNED NULL DEFAULT NULL ";

$sql = "ALTER TABLE `mv_vendas` CHANGE `vr_dinheiro` `vr_dinheiro` DECIMAL( 10, 2 ) NULL DEFAULT NULL ,CHANGE `vr_cheque` `vr_cheque` DECIMAL( 10, 2 ) NULL DEFAULT NULL , CHANGE `vr_cartao` `vr_cartao` DECIMAL( 10, 2 ) NULL DEFAULT NULL ";

$sql = "ALTER TABLE `mv_vendas` CHANGE `vr_carne` `vr_debito` DECIMAL( 10, 2 ) NULL DEFAULT NULL , CHANGE `vr_ticket` `vr_outro` DECIMAL( 10, 2 ) NULL DEFAULT NULL ";

$sql = "ALTER TABLE `mv_vendas` ADD `sync_timestamp` INT NOT NULL ;";

$sql = "CREATE TABLE `mv_login` ( `id` int(11) unsigned NOT NULL auto_increment, `entrada_timestamp` int(11) unsigned default NULL, `saida_timestamp` int(11) unsigned default NULL, `id_login` int(11) unsigned default NULL, `ip_maquina` varchar(15) NOT NULL default '', `nome_maquina` varchar(50) NOT NULL default '', `status_login` tinyint(1) unsigned NOT NULL default '0', `terminal` char(2) NOT NULL default '01',  `sync_timestamp` int(11) unsigned default NULL,  PRIMARY KEY  (`id`)) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

$sql = "ALTER TABLE `cliente` CHANGE `id` `idcliente` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT, CHANGE `nome_cliente` `txtnome` VARCHAR(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL, CHANGE `endereco` `txtendereco` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL, CHANGE `bairro` `txtbairro` VARCHAR(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL, CHANGE `cidade` `txtcidade` VARCHAR(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL, CHANGE `uf` `txtuf` CHAR(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL, CHANGE `telefone` `txttelefone` VARCHAR(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL, CHANGE `celular` `txtcelular` VARCHAR(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL, CHANGE `email` `txtemail` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL, CHANGE `cpf` `txtcpf` VARCHAR(18) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL, CHANGE `cep` `txtcep` VARCHAR(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL, CHANGE `cod_barra` `txtcod_barra` VARCHAR(13) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL, CHANGE `dataniver` `dtaniversario` DATE NULL DEFAULT NULL, CHANGE `rg` `txtrg` VARCHAR(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL, CHANGE `inf_adicional` `txtinf_adicional` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL, CHANGE `dtcadastro` `dtcadastro` DATE NULL DEFAULT NULL, CHANGE `sync_timestamp` `sync_timestamp` INT(11) NULL DEFAULT NULL";

$sql = "ALTER TABLE `fornecedor` CHANGE `idfornecedor` `idfornecedor` INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT ";

$sql = "ALTER TABLE `fornecedor` DROP `contatoarea` ;";

?>
