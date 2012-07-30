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

$validations = new validations ();
$db = new db ();
$db->connect ();

$mode 		= $_GET['mode'];
$namebank 	= strtoupper($_GET['namebank']);
$numberbank	= $_GET['numberbank'];
$statusbank	= ($_GET['statusbank']=='true')?1:0;

$datenow	= date('Y-m-d h:i:s');

if ($mode=='insert'){
	$sql = "INSERT INTO cad_bancos ( nome, numero, status, updated_at, created_at ) VALUES ( '".$namebank."', ".$numberbank.", ".$statusbank.",'".$datenow."', '".$datenow."' ) ";
} else if ($mode=='update'){
	$sql = "UPDATE cad_bancos SET nome='".$namebank."', numero=".$numberbank.", status=".$statusbank.", updated_at='".$datenow."' WHERE id=".$_GET['id']." ";
}

$db->query($sql);

?>