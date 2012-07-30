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

$idusuario = $validations->validNumeric ( $_GET ['i'] );

$sql = "SELECT datalog FROM log_login WHERE cad_login_id=" . $idusuario . " ORDER BY datalog DESC LIMIT 100";
$query = $db->query ( $sql );

?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<?
while ( $row = $db->fetch_assoc ( $query ) ) {
	?>
<tr>
		<td height="25" align="right"><?=timestamp_converte ( $row ['datalog'] );?></td>
		<td width="10"></td>
	</tr>
	<tr>
		<td colspan="2" style="border-bottom: 1px solid #c0c0c0;"></td>
	</tr>
<?
}
?>
</table>