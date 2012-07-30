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

$where = "";
if ($_REQUEST ['cliente_estado'] == 'true' && $_REQUEST ['sel_estado'] != '0') {
	$where [] = " lower(txtuf) LIKE lower('%" . $_REQUEST ['sel_estado'] . "%')";
}

if ($_REQUEST ['cliente_mes'] == 'true' && $_REQUEST ['mes_niver'] != '0') {
	$where [] = " MONTH(dtaniversario) = '" . $_REQUEST ['mes_niver'] . "')";
}

if ($_REQUEST ['bairro'] == 'true') {
	$where [] = " (txtbairro IS NOT NULL AND txtbairro != '')";
}

if ($_REQUEST ['estado'] == "true") {
	$where [] = " (txtuf IS NOT NULL OR txtuf != '')";
}

if ($_REQUEST ['endereco'] == "true") {
	$where [] = " (txtendereco IS NOT NULL AND txtendereco != '')";
}

if ($_REQUEST ['cidade'] == "true") {
	$where [] = " (txtcidade IS NOT NULL AND txtcidade != '')";
}

if ($_REQUEST ['cep'] == "true") {
	$where [] = " (txtcep IS NOT NULL AND txtcep != '')";
}

if ($where) {
	$where = " WHERE " . implode ( " AND ", $where ) . " ";
} else {
	$where = " ";
}

//$sql = "select txtnome, txtbairro, txtuf, 'Brasil' as txtpais, txtendereco, txtcidade, txtcep, dtaniversario, dtcadastro  from cliente where lower(txtuf) = lower('rj') and txtcep != '';";
$sql = "SELECT
				lower(txtnome) as txtnome,
				upper(txtbairro) as txtbairro,
				upper(txtuf) as txtuf, 'Brasil' as txtpais,
				txtendereco, upper(txtcidade) as txtcidade,
				txtcep,
				dtaniversario,
				dtcadastro
		FROM
			cliente
		{$where}
			;";

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

while ( $rowprodutos = $db->fetch_assoc ( $query ) ) {
	$arr_prod [] = ucfirst ( $rowprodutos ['txtnome'] ) . $separador_dados_prod . $rowprodutos ['txtendereco'] . $separador_dados_prod . ucfirst ( $rowprodutos ['txtbairro'] ) . $separador_dados_prod . ucfirst ( $rowprodutos ['txtcidade'] ) . $separador_dados_prod . $rowprodutos ['txtuf'] . $separador_dados_prod . $rowprodutos ['txtcep'] . $separador_dados_prod;
	$n_etiqueta ++;
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
