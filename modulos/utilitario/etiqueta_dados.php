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

$where_cod = "";
if ($_REQUEST ['cod'] != '') {
	$where_cod .= " AND p.cod_barra = '" . $_REQUEST ['cod'] . "' ";
}

if ($_REQUEST ['produtotipo_id'] != '') {
	$where_cod .= " AND pt.idprodutotipo = '" . $_REQUEST ['produtotipo_id'] . "' ";
}

if ($_REQUEST ['fornecedor_id'] != '') {
	$where_cod .= " AND f.idfornecedor = '" . $_REQUEST ['fornecedor_id'] . "' ";
}

if ($_REQUEST ['colecao_id'] != '') {
	$where_cod .= " AND c.idcolecao = '" . $_REQUEST ['colecao_id'] . "' ";
}

$sql = "SELECT
			p.cod_barra, p.idproduto, p.txtproduto, p.vlcusto, p.vlvarejo, p.vlatacado, p.vlprontaentrega, e.nquantidade
		FROM
			produto AS p
 		INNER JOIN
 			estoque AS e ON e.produto_idproduto=p.idproduto
 		LEFT JOIN
 			fornecedor AS f ON f.idfornecedor=p.fornecedor_idfornecedor
		LEFT JOIN
			produtotipo AS pt ON pt.idprodutotipo=p.produtotipo_idprodutotipo
		LEFT JOIN
			colecao AS c ON c.idcolecao=p.colecao_idcolecao
  		WHERE
  			e.nquantidade>0 {$where_cod}
  		ORDER BY txtproduto ASC";

$query = $db->query ( $sql );

// separadores
$separador_quant_prod = "+||+";
$separador_prod = "+|+";
$separador_dados_prod = "|";

$prod_sem_valor = "";

$n_etiqueta = 0;
$cod_barra_prod = "";
$nome_prod = "";
$preco_prod = "";
$arr_prod = array ();

// qual preco devemostrar


// varejo;


$field_valor_produto = false;

if ($_REQUEST ['vla'] == 'true') {
	$field_valor_produto = "vlcusto";
}

if ($_REQUEST ['vle'] == 'true') {
	$field_valor_produto = "vlatacado";
}

if ($_REQUEST ['vlv'] === 'true') {
	$field_valor_produto = "vlvarejo";
}

while ( $rowprodutos = $db->fetch_assoc ( $query ) ) {
	$sql = "SELECT descricao, quantidade, vlprodgrade FROM cad_produtos_grade WHERE id_produto=" . $rowprodutos ['idproduto'] . " AND quantidade > 0";
	$querygrade = $db->query ( $sql );
	
	if ($n_grade = $db->num_rows ( $querygrade )) {
		while ( $rowgrade = $db->fetch_assoc ( $querygrade ) ) {
			$arr_prod [] = $rowprodutos ['cod_barra'] . $separador_dados_prod . $rowprodutos ['txtproduto'] . "-" . $rowgrade ['descricao'] . $separador_dados_prod . ($rowgrade ['vlprodgrade'] > 0 && $field_valor_produto ? $rowgrade ['vlprodgrade'] : ($field_valor_produto ? $rowprodutos [$field_valor_produto] : $prod_sem_valor));
			
			$n_etiqueta ++;
		}
	} else {
		$arr_prod [] = $rowprodutos ['cod_barra'] . $separador_dados_prod . $rowprodutos ['txtproduto'] . $separador_dados_prod . ($field_valor_produto ? $rowprodutos [$field_valor_produto] : $prod_sem_valor);
		$n_etiqueta ++;
	}

}

echo $n_etiqueta . $separador_quant_prod . implode ( $separador_prod, $arr_prod );

//echo "\n\n\n\n\n";


//echo count($arr_prod);


/*
2+||+
4922020803262|Blusa Branca P|12.90
+|+4922020803262|Blusa Branca defeito|3.25
*/
?>
