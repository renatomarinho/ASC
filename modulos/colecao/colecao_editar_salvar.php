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

$idcolecao = $validations->validNumeric ( $_POST ['id'] );
$colecao = $validations->validStringForm ( $_POST ['colecao'] );
if (! isset ( $_POST ['descricao'] )) {
	$_POST ['descricao'] = '';
}
$descricao = $validations->validStringForm ( $_POST ['descricao'] );
$periodo = str_pad ( $_POST ['mes1'], 2, "0", STR_PAD_LEFT ) . '/' . $_POST ['ano1'];
$periodo2 = str_pad ( $_POST ['mes2'], 2, "0", STR_PAD_LEFT ) . '/' . $_POST ['ano2'];
if ($periodo2 != $periodo)
	$periodo .= ' at� ' . $periodo2;

$sql = "UPDATE colecao SET txtnome='" . $colecao . "', txtperiodo='" . $periodo . "', txtdescricao='" . nl2br ( $descricao ) . "' WHERE idcolecao=" . $idcolecao . "";
$db->query ( $sql );

?>