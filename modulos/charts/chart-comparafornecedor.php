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


// generate some random data
if (! isset ( $_CONF ['PATH'] )) {
	require "../../config/default.php";
}

require 'library/open-flash-chart.php';

$db = new db ( );
$db->connect ();

$bar = new bar_outline ( 50, '#6aa9e9', '#666666' );
$bar->key ( utf8_encode ( 'Gr�fico de comparac�o dos fornecedores ' ), 10 );

$nome_fornecedor = array ();

$total = $_GET ['total'];
$param = $_GET ['param'];

$vetor_url = array ();

for($i = 0; $i < $total; $i ++) {
	$vetor_url [$i] = $_GET ['idfor' . $i];
}

foreach ( $vetor_url as $key => $value ) {
	
	$sql = "SELECT idfornecedor, nome FROM fornecedor WHERE idfornecedor=" . $value;
	$query = $db->query ( $sql );
	$rowfornecedor = $db->fetch_assoc ( $query );
	
	$nome_fornecedor [$key] = utf8_encode ( qtdCaracteres ( ucwords ( strtolower ( $rowfornecedor ['nome'] ) ), 30 ) );
	$idfornecedor [$key] = $rowfornecedor ['idfornecedor'];

}

$data = array ();

$maiorvalor = 0;
$menorvalor = 0;

for($i = 0; $i < $total; $i ++) {
	$resultado = resultadorelatorio_fornecedor ( $idfornecedor [$i], $param );
	$bar->data [] = $resultado;
	if ($resultado > $maiorvalor) {
		$maiorvalor = $resultado;
	}
	if ($resultado < $menorvalor) {
		$menorvalor = $resultado;
	}
}

srand ( ( double ) microtime () * 1000000 );

$bar_1 = new bar_glass ( 55, '#5E83BF', '#424581' );
$bar_1->key ( titulo_selecionado_fornecedor ( $param ), 10 );

for($i = 0; $i < $total; $i ++)
	$bar_1->data [] = ( double ) resultadorelatorio_fornecedor ( $vetor_url [$i], $param );

$g = new graph ( );

//$g->data_sets[] = $bar;
$g->data_sets [] = $bar_1;

$g->set_x_labels ( $nome_fornecedor );

$g->x_axis_colour ( '#FFFFFF', '#D2D2FB' );
$g->y_axis_colour ( '#FFFFFF', '#D2D2FB' );

$g->bg_colour = '#FFFFFF';

$g->set_x_label_style ( 0, '#FFFFFF', 0, 0 );

$g->set_y_min ( ( double ) $menorvalor );
$g->set_y_max ( ( double ) $maiorvalor );
$g->y_label_steps ( 5 );

echo $g->render ();

?>