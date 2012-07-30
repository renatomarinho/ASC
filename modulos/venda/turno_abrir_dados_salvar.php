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

$db = new db ( );
$db->connect ();

$validations = new validations ( );

$abertura = $validations->validNumeric ( $_POST ['ab'] );
$turno = $validations->validNumeric ( $_POST ['tu'] );
$terminal = $validations->validNumeric ( $_POST ['te'] );
$idusuario = $validations->validNumeric ( $_POST ['i'] );
$valor_caixa = $validations->validStringForm ( $_POST ['v'] );

$_SESSION ['turno'] = $turno;

$sql = "INSERT INTO mv_caixa ( abertura, vr_abertura, cad_login_id, turno, terminal, sync_timestamp ) VALUES ( " . $abertura . ", '" . $valor_caixa . "', " . $idusuario . ", '" . $turno . "', '" . $terminal . "', " . strtotime ( 'now' ) . " )";
$db->query ( $sql );

?>
