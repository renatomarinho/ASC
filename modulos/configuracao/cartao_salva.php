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
$namecard 	= strtoupper($_GET['namecard']);
$credit		= ($_GET['credit']=='true')?1:0;
$debit 		= ($_GET['debit']=='true')?1:0;
$tx_credit1	= str_replace(',','.',$_GET['tx_credit1']);
$tx_credit2 = str_replace(',','.',$_GET['tx_credit2']);
$tx_debit1	= str_replace(',','.',$_GET['tx_debit1']);
$status		= ($_GET['status']=='true')?1:0;

$datenow	= date('Y-m-d h:i:s');

if ($mode=='insert'){
	$sql = "INSERT INTO cad_cartoes ( nome, credito, debito, tx_credito1, tx_credito2, tx_debito1, status, updated_at, created_at ) VALUES ( '".$namecard."', ".$credit.", ".$debit.", '".$tx_credit1."', '".$tx_credit2."', '".$tx_debit1."', ".$status.", '".$datenow."', '".$datenow."' ) ";
} else if ($mode=='update'){
	$sql = "UPDATE cad_cartoes SET nome='".$namecard."', credito=".$credit.", debito=".$debit.", tx_credito1='".$tx_credit1."', tx_credito2='".$tx_credit2."', tx_debito1='".$tx_debit1."', status=".$status.", updated_at='".$datenow."' WHERE id=".$_GET['id']." ";
}

$db->query($sql);

?>