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

$idproduto = $validations->validNumeric ( $_POST ['idproduto'] );
$nome = $validations->validStringForm ( $_POST ['nome'] );
$codigo = $validations->validStringForm ( $_POST ['codigo'] );
$vlcusto = $validations->validStringForm ( $_POST ['vlcusto'] );
$vlpentrega = $validations->validStringForm ( $_POST ['vlpentrega'] );
$vlatacado = $validations->validStringForm ( $_POST ['vlatacado'] );
$vlvarejo = $validations->validStringForm ( $_POST ['vlvarejo'] );
$qtdestoque = $validations->validStringForm ( $_POST ['qtdestoque'] );
$categoria = $validations->validNumeric ( $_POST ['categoria'] );
$fornecedor = $validations->validNumeric ( $_POST ['fornecedor'] );
$colecao = $validations->validNumeric ( $_POST ['colecao'] );

$sql = "UPDATE produto SET cod_interno='".strtoupper($codigo)."', txtproduto='" . strtoupper ( $nome ) . "', vlcusto='" . $vlcusto . "', vlprontaentrega='" . $vlpentrega . "', vlatacado='" . $vlatacado . "', vlvarejo='" . $vlvarejo . "', qtdestoque=" . $qtdestoque . ", produtotipo_idprodutotipo=" . $categoria . ", fornecedor_idfornecedor=" . $fornecedor . ", colecao_idcolecao=" . $colecao . " WHERE idproduto=" . $idproduto . "";
$db->query ( $sql );

$sql = "UPDATE estoque SET nquantidade=" . $qtdestoque . " WHERE produto_idproduto=" . $idproduto . "";
$db->query ( $sql );
?>