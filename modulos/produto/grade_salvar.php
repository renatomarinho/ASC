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

$idgrade = $validations->validNumeric ( $_POST ['idgrade'] );
$descricao = strtoupper ( $validations->validStringForm ( $_POST ['descricao'] ) );
$quantidade = $validations->validNumeric ( $_POST ['quantidade'] );
$totalestoque = $validations->validNumeric ( $_POST ['totalestoque'] );
$vlprodgrade = $_POST ['vlprodgrade'];

$sql = "UPDATE cad_produtos_grade SET descricao='" . $descricao . "', quantidade='" . $quantidade . "', vlprodgrade='" . $vlprodgrade . "' WHERE id=" . $idgrade . "";
$db->query ( $sql );

$sql = "SELECT id_produto FROM cad_produtos_grade WHERE id=" . $idgrade . "";
$query = $db->query ( $sql );
$rowproduto = $db->fetch_assoc ( $query );

$sql = "UPDATE estoque SET nquantidade=" . $totalestoque . " WHERE produto_idproduto=" . $rowproduto ['id_produto'] . "";
$db->query ( $sql );

?>

