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

//header('Content-Type: text/html; charset=ISO-8859-1');


if (! isset ( $_CONF ['PATH'] )) {
	require "../../config/default.php";
}

srand ( ( double ) microtime () * 1000000 );

require 'library/open-flash-chart.php';
$g = new graph ( );

$total = (int)$_GET['total'];

$_nomes = array ();
$_quantidade = array ();

for($i = 0; $i < $total; $i ++) {
	
	if (( int )$_GET['quantidade'.$i] > 0) {
		$_nomes[$i] = qtdCaracteres($_GET['nome'.$i],40);
		$_quantidade[$i] = (int)$_GET['quantidade'.$i];
		$links[$i] = "javascript:carrega_dadosfornecedor('".(int)$_GET['id'.$i]."')";
	}

}

$g->bg = '#484848';
$g->pie ( 60, '#484848', '#555555', true, 1 );
$g->bg_colour = '#FFFFFF';
$g->pie_values ( $_quantidade, $_nomes, $links );

$g->pie_slice_colours ( $_CONF['COLORS'] );
$g->set_tool_tip ( '#x_label#<br>#val# produtos' );

echo $g->render ();
?>