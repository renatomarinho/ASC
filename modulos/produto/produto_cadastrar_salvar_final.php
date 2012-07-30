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

$nome = $_SESSION ['produto'] ['nome'];
$codigo = $_SESSION ['produto'] ['codigo'];
$vlcusto = $_SESSION ['produto'] ['vlcusto'];
$vlpentrega = $_SESSION ['produto'] ['vlpentrega'];
$vlatacado = $_SESSION ['produto'] ['vlatacado'];
$vlvarejo = $_SESSION ['produto'] ['vlvarejo'];
$qtdestoque = $_SESSION ['produto'] ['qtdestoque'];
$categoria = $_SESSION ['produto'] ['categoria'];
$fornecedor = $_SESSION ['produto'] ['fornecedor'];
$colecao = $_SESSION ['produto'] ['colecao'];
$codbarra = $_SESSION ['produto'] ['codbarra'];

$nnota = ($_POST ['nnota']) ? $validations->validNumeric ( $_POST ['nnota'] ) : 0;
$icms = ($_POST ['icms']) ? $validations->validStringForm ( $_POST ['icms'] ) : 0;
$frete = ($_POST ['frete']) ? $validations->validStringForm ( $_POST ['frete'] ) : 0;
$vldesc = ($_POST ['vldesc']) ? $validations->validStringForm ( $_POST ['vldesc'] ) : 0;
$icmssub = ($_POST ['icmssub']) ? $validations->validStringForm ( $_POST ['icmssub'] ) : 0;
$ipi = ($_POST ['ipi']) ? $validations->validStringForm ( $_POST ['ipi'] ) : 0;
$vltotal = ($_POST ['vltotal']) ? $validations->validStringForm ( $_POST ['vltotal'] ) : 0;
$dtnota = $validations->validNumeric ( $_POST ['anonota'] ) . '-' . $validations->validNumeric ( $_POST ['mesnota'] ) . '-' . $validations->validNumeric ( $_POST ['dianota'] );

if ($fornecedor == 0)
	$fornecedor = $validations->validNumeric ( $_POST ['fornecedor'] );

if (isset ( $_SESSION ['gradeproduto'] ))
	$grade = 1;
else
	$grade = 0;

$sql = "INSERT INTO produto ( cod_interno, txtproduto, vlcusto, vlprontaentrega, vlatacado, vlvarejo, qtdestoque, produtotipo_idprodutotipo, fornecedor_idfornecedor, colecao_idcolecao, cod_barra, dtcadastro, grade, stcontroleestoque, sync_timestamp ) VALUES ( '" . $codigo . "', '" . $nome . "', '" . $vlcusto . "', '" . $vlpentrega . "', '" . $vlatacado . "', '" . $vlvarejo . "', " . $qtdestoque . ", " . $categoria . ", " . $fornecedor . ", " . $colecao . ", " . $codbarra . ", '" . strtotime ( 'now' ) . "', " . $grade . ", 1, " . strtotime ( 'now' ) . " )";

if ($db->query ( $sql )) {
	
	$idproduto = $db->insert_id ();
	
	if ($grade == 1) {
		
		$arraygrade = '';
		$total = count ( $_SESSION ['gradeproduto'], COUNT_RECURSIVE ) / 3;
		
		for($i = 1; $i < $total; $i ++) {
			$descricao_grade = strtoupper ( $validations->validStringForm ( $_SESSION ['gradeproduto'] ['descricao'] [$i] ) );
			$quantidade_grade = $validations->validNumeric ( $_SESSION ['gradeproduto'] ['quantidade'] [$i] );
			$vlprodgrade_grade = $validations->validStringForm ( $_SESSION ['gradeproduto'] ['vlprodgrade'] [$i] );
			$sql = "INSERT INTO cad_produtos_grade ( id_produto, descricao, quantidade, vlprodgrade ) VALUES ( " . $idproduto . ", '" . $descricao_grade . "', '" . $quantidade_grade . "', '" . $vlprodgrade_grade . "' )";
			$db->query ( $sql );
			$arraygrade .= '#|#' . $descricao_grade . '+-+' . $quantidade_grade . '+-+' . $vlprodgrade_grade;
		}
	
	}
	
	$sql = "INSERT INTO estoque ( produto_idproduto, nquantidade ) VALUES ( " . $idproduto . ", " . $qtdestoque . " )";
	$db->query ( $sql );
	
	$sql = "INSERT INTO produto_notaentrada ( nnota, icms, frete, vldesc, icmssub, ipi, vltotal, dtnota, idproduto, arraygrade, timestamp, fornecedor_idfornecedor ) VALUES ( " . $nnota . ", '" . $icms . "', '" . $frete . "', '" . $vldesc . "', '" . $icmssub . "', '" . $ipi . "', '" . $vltotal . "', '" . $dtnota . "', " . $idproduto . ", '" . $arraygrade . "', " . strtotime ( 'now' ) . ", " . $fornecedor . " )";
	$db->query ( $sql );

} else {
	echo 'Ocorreu um erro ao adicionar o produto, tente novamente';
}

unset ( $_SESSION ['produto'] );
unset ( $_SESSION ['gradeproduto'] );

?>