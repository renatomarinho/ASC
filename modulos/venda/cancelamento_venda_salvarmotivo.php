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

$cliente = $validations->validNumeric ( $_POST ['cliente'] );
$usuario = $validations->validNumeric ( $_POST ['usuario'] );
$controle = $validations->validNumeric ( $_POST ['controle'] );
$valortotal = $validations->validStringForm ( $_POST ['valortotal'] );
$statusmotivo = $validations->validNumeric ( $_POST ['statusmotivo'] );
$textomotivo = $validations->validStringForm ( $_POST ['textomotivo'] );

$produtos_carrinho = print_r ( $_SESSION ['carrinho_venda'], true );

$sql = "INSERT INTO motivocancelamentovenda ( id_login, controle, vr_total, txtmotivo, idcliente, stmotivo, produtoscarrinho ) VALUES ( " . $usuario . ", '" . $controle . "', '" . $valortotal . "', '" . $textomotivo . "', " . $cliente . ", " . $statusmotivo . ", '" . $produtos_carrinho . "' )";
$db->query ( $sql );

?>