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


?>

<?php ini_set('display_errors', 0); ?> 

<?
header('Content-Type: text/html; charset=utf-8');
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false );
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Pragma: no-cache");

session_start ();

srand ( ( double ) microtime () * 10000000 );


/**
 * Dados de acesso ao banco de dados
 */
$_CONF['database_host'] = 'localhost';
$_CONF['database_name'] = 'asc_database';

$_CONF['database_username'] = 'root';
$_CONF['database_password'] = '123456';


/**
 * Endereco fisico
 * ex.: "/var/www/ASC";
 */
$_CONF ['PATH'] = "/mnt/hgfs/Projetos/ASC/PRODUCTION/VERSION_01/SYSTEM/client/";

/**
 * Endereco virtual
 * ex.: "http://127.0.0.1/ASC/"
 */
$_CONF ['PATH_VIRTUAL'] = "http://www.ajaxsalescloud.dev/";

/**
 * Endereco virtual do servidor
 * ex.: "http://server.ajaxsalescloud.com"
 */
$_CONF ['PATH_VIRTUAL_SERVER'] = 'http://server.ajaxsalescloud.com';
$_CONF ['PATH_VIRTUAL_SERVER_CA'] = 'http://server.ajaxsalescloud.com/controle_arquivos/';

/**
 * Periodo maximo para o estorno em dias
 * ex.: 15
 */
$_CONF ['PERIODO_MAX_ESTORNO'] = 200;

/**
 * Configuracoes gerais
 */
$_CONF ['COD_AREA_TEL'] = 21;
$_CONF ['CIDADE'] = 'Rio de Janeiro';
$_CONF ['UF'] = 'RJ';
$_CONF ['PAIS'] = 'BR';

$_CONF['COLORS'] = array ('#0000ff', '#67D0C5', '#EAB587', '#CCB5F1', '#ADC88C', '#A10000', '#006860', '#006500', '#564D00', '#569314', '#9064FF', '#00A492', '#D26500');

shuffle($_CONF['COLORS']);

require $_CONF ['PATH'] . "include/class/db.class.php";
require $_CONF ['PATH'] . "include/class/validations.class.php";
require $_CONF ['PATH'] . "include/functions.php";
require $_CONF ['PATH'] . "config/info.php";
require $_CONF ['PATH'] . "config/colors.php";
require $_CONF ['PATH'] . "config/atualizacao.php";
?>
