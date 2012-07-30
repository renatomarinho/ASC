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

if (! isset ( $_CONF ['PATH'] )) {
	require "../../config/default.php";
}

$validations = new validations ();
$db = new db ();
$db->connect ();

$receber		= $_GET['receber'];
$receber_dias	= $_GET['receber_dias'];
$pagar			= $_GET['pagar'];
$pagar_dias		= $_GET['pagar_dias'];
$estoque		= $_GET['estoque'];
$pedidos		= $_GET['pedidos'];
$cobrancas		= $_GET['cobrancas'];
$compras		= $_GET['compras'];

$datenow		= strtotime('now');

$sql = "UPDATE configuracao SET alerta_pedidocompras=".$compras.", alerta_contasreceber=".$receber.", alerta_contasreceber_tempo=".$receber_dias.", alerta_contaspagar=".$pagar.", alerta_contaspagar_tempo=".$pagar_dias.", alerta_estoque=".$estoque.", alerta_pedidos=".$pedidos.", alerta_cobrancas=".$cobrancas.", updated_at=".$datenow." WHERE id=1";
$db->query($sql);

?>