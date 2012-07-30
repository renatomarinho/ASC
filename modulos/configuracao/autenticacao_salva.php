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

/*
 * FIXME Change cad_empresa_id to dinamic id
 */
$sql = "SELECT id FROM configuracao WHERE id=1";
$query = $db->query($sql);
if ($db->num_rows($query)==1){
	$sql = "UPDATE configuracao SET cad_empresa_id=1, vendanormal=".$validations->validNumeric($_GET['opc1']).", vendavip=".$validations->validNumeric($_GET['opc2']).", reducao_estoque=".$validations->validNumeric($_GET['opc3']).", estorno_estoque=".$validations->validNumeric($_GET['opc4']).", etiquetas=".$validations->validNumeric($_GET['opc5']).", mailling=".$validations->validNumeric($_GET['opc6']).", administradores=".$validations->validNumeric($_GET['opc7']).", configuracoes=".$validations->validNumeric($_GET['opc8'])." WHERE id=1";
}else{
	$sql = "TRUNCATE TABLE `configuracao`";
	$db->query($sql);
	$sql = "INSERT INTO configuracao (vendanormal,vendavip,reducao_estoque,estorno_estoque,etiquetas,mailling,administradores,configuracoes) VALUES (".$validations->validNumeric($_GET['opc1']).",".$validations->validNumeric($_GET['opc2']).",".$validations->validNumeric($_GET['opc3']).",".$validations->validNumeric($_GET['opc4']).",".$validations->validNumeric($_GET['opc5']).",".$validations->validNumeric($_GET['opc6']).",".$validations->validNumeric($_GET['opc7']).",".$validations->validNumeric($_GET['opc8']).")";
}
$db->query($sql);
?>