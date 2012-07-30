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

srand ( ( double ) microtime () * 1000000 );

$total = $_GET ['total'];

$_nomes = array ();
$_quantidade = array ();

for($i = 0; $i < $total; $i ++) {
	
	if (( int ) $_GET ['quantidade' . $i] > 0) {
		$_nomes [$i] = $_GET ['nome' . $i];
		$_quantidade [$i] = ( int ) $_GET ['quantidade' . $i];
	}

}

require 'library/open-flash-chart.php';
$g = new graph ( );

//
// PIE chart, 60% alpha
//
$g->pie ( 60, '#FFFFFF' );
$g->bg_colour = '#FFFFFF';
//
// pass in two arrays, one of data, the other data labels
//
$g->pie_values ( $_quantidade, $_nomes );
//
// Colours for each slice, in this case some of the colours
// will be re-used (3 colurs for 5 slices means the last two
// slices will have colours colour[0] and colour[1]):
//
$g->pie_slice_colours ( $_CONF['COLORS'] );

$g->set_tool_tip ( '#x_label#<br>#val# itens' );

$g->title ( '', '' );
echo $g->render ();
?>