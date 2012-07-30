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


require 'library/open-flash-chart.php';

srand((double)microtime()*1000000);

$validations = new validations ( );
$db = new db ( );
$db->connect ();

$cliente_id = $_GET['cliente_id'];

$dia1 = (isset ( $_GET ['dia1'] )) ? $validations->validNumeric ( $_GET ['dia1'] ) : date ( 'd' );
$mes1 = (isset ( $_GET ['mes1'] )) ? $validations->validNumeric ( $_GET ['mes1'] ) : date ( 'm' );
$ano1 = (isset ( $_GET ['ano1'] )) ? $validations->validNumeric ( $_GET ['ano1'] ) : date ( 'Y' );

$data_dia1 = $dia1;
$data_mes1 = $mes1;
$data_ano1 = $ano1;
$data1 = date ( 'Y-m-d', mktime ( 0, 0, 0, $data_mes1, $data_dia1, $data_ano1 ) );

$dia2 = (isset ( $_GET ['dia2'] )) ? $validations->validNumeric ( $_GET ['dia2'] ) : date ( 'd' );
$mes2 = (isset ( $_GET ['mes2'] )) ? $validations->validNumeric ( $_GET ['mes2'] ) : date ( 'm' );
$ano2 = (isset ( $_GET ['ano2'] )) ? $validations->validNumeric ( $_GET ['ano2'] ) : date ( 'Y' );

$data_dia2 = $dia2;
$data_mes2 = $mes2;
$data_ano2 = $ano2;
$data2 = date ( 'Y-m-d', mktime ( 0, 0, 0, $data_mes2, $data_dia2, $data_ano2 ) );


if ($data1==$data2) {
	$data1 = date ( 'Y-m-d', mktime ( 0, 0, 0, date ( 'm' )-30, date ( 'd' ), date ( 'Y' ) ) );
	$data2 = date ( 'Y-m-d', mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) ) );
}

$sql = "SELECT v.data_venda, SUM(v.vr_totalvenda) AS vr_totalvenda, v.vr_opcionalvenda, SUM(mv.vr_custo*mv.quant) AS vr_custo  FROM mv_vendas AS v INNER JOIN mv_vendas_movimento AS mv ON v.controle=mv.controle INNER JOIN cliente c ON c.idcliente=v.id_cliente WHERE c.idcliente=".$cliente_id." AND v.data_venda BETWEEN '".$data1."' AND '".$data2."' GROUP BY v.data_venda";
$query = $db->query($sql);

$data_1 = array();
$data_2 = array();
$data_3 = array();

$labels = array();

$max_value = 0;

while( $row = $db->fetch_assoc($query) ){
	
	$data_1[] = $row['vr_totalvenda'];
  	$data_2[] = $row['vr_custo'];
  	$data_3[] = $row['vr_totalvenda']-$row['vr_custo'];
  	
  	$labels[] = date('d/m/Y',strtotime($row['data_venda']));

  	$max_value = ($max_value<$row['vr_totalvenda'])?$row['vr_totalvenda']:$max_value;
  	
}


$g = new graph();

$g->set_data( $data_1 );
$g->set_data( $data_2 );
$g->set_data( $data_3 );

$g->line_hollow( 3, 5, '0x9933CC', 'Venda', 10 );
$g->line_hollow( 3, 5, '0xCC3399', 'Custo', 10); 
$g->line_hollow( 3, 5, '0x80a033', 'Lucro', 10 );

$g->set_x_labels( $labels );
$g->set_x_label_style( 10, '0x000000', 0, 2 );

$g->set_y_max( $max_value );
$g->y_label_steps( 4 );
$g->set_y_legend( 'Valores em Real - R$', 12, '#000000' );
$g->bg_colour = '#FFFFFF';

echo $g->render();

?>