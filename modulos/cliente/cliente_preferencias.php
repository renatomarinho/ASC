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

$validations = new validations ( );
$db = new db ( );
$db->connect ();

$idcliente = $validations->validNumeric ( $_GET ['id'] );

$preferencia = '';

$sql = "SELECT pt.txtnome, mvv.data_venda FROM mv_vendas_movimento AS mvv INNER JOIN produto AS p ON mvv.id_produto=p.idproduto LEFT JOIN produtotipo AS pt ON p.produtotipo_idprodutotipo=pt.idprodutotipo WHERE estornado=0 AND id_cliente=" . $idcliente . " GROUP BY pt.idprodutotipo ORDER BY SUM(mvv.quant) DESC LIMIT 5";
$querytipo = $db->query ( $sql );

if ($db->num_rows ( $querytipo )) {
	while ( $rowtipo = $db->fetch_assoc ( $querytipo ) ) {
		$preferencia .= ucwords ( strtolower ( $rowtipo ['txtnome'] ) ) . ' - ';
		$ultima_compra [] = $rowtipo ['data_venda'];
	}
	
	asort ( $ultima_compra );
	$ultima_compra = explode ( "-", $ultima_compra [0] );
	$dia = $ultima_compra [2];
	$mes = $ultima_compra [1];
	$ano = $ultima_compra [0];
	?>
<b>Última Compra: </b><?=$dia . "/" . $mes . "/" . $ano?></b>
<br>
<b>Preferência<?=($db->num_rows ( $querytipo ) > 1) ? 's' : '';?> :</b>

<?
	echo substr ( $preferencia, 0, - 2 );
} else {
	echo '<b>Primeira compra</b>';
}
?>