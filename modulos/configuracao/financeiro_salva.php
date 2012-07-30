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

$r_avista_baixar= $_GET['r_avista_baixar'];
$r_avista_lancar= $_GET['r_avista_lancar'];
$r_manual_lancar= $_GET['r_manual_lancar'];
$p_manual_lancar= $_GET['p_manual_lancar'];
$t_atraso		= $_GET['t_atraso'];
$b_credito		= $_GET['b_credito'];
$min_cartao		= $_GET['min_cartao'];
$min_debito		= $_GET['min_debito'];
$min_cheque		= $_GET['min_cheque'];

$datenow		= strtotime('now');

$sql = "UPDATE configuracao SET receber_avista_baixar=".$r_avista_baixar.", receber_avista_lancar=".$r_avista_lancar.", receber_manual_lancar=".$r_manual_lancar.", pagar_manual_lancar=".$p_manual_lancar.", tolerancia_atraso=".$t_atraso.", bloquear_credito=".$b_credito.", parcela_min_cartao=".$min_cartao.", parcela_min_debito=".$min_debito.", parcela_min_cheque=".$min_cheque.", updated_at=".$datenow." WHERE id=1";
$db->query($sql);

?>