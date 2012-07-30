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

$idusuario = $validations->validNumeric ( $_POST ['i'] );
$nome = strtoupper ( $validations->validStringForm ( $_POST ['nome'] ) );
$login = strtoupper ( $validations->validStringForm ( $_POST ['login'] ) );

$sql = "SELECT id FROM cad_login WHERE login='" . $login . "' AND id!=" . $idusuario . "";
$query = $db->query ( $sql );

if (! $db->num_rows ( $query )) {
	
	$senha = md5 ($_POST['senha']);
	
	if (strlen($_POST['senha'])>3) {
		$sql_senha = ", senha='" . $senha . "' ";
	} else {
		$sql_senha = '';
	}
	
	$sql = "UPDATE cad_login SET nome='".$nome."', login='".$login."' ".$sql_senha." WHERE id=".$idusuario."";
	if ($db->query ( $sql )) {
		echo '1';
	} else {
		echo '3';
	}
} else {
	echo '2';
}

?>