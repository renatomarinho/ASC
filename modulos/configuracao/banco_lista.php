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

$db = new db ();
$db->connect ();
?>

<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<?
	$sql = "SELECT id, nome, numero, status FROM cad_bancos ORDER BY nome ASC";
	$query = $db->query($sql);
	while ($row = $db->fetch_assoc($query)){
	?>
		<tr bgcolor="#f0f0f0">
			<td width="20" height="25"></td>
			<td><a href="javascript:;" style="color:<?=($row['status']==0)?'red':''?>" onclick="javascript:Configuration.ShowBank(<?=$row['id'];?>);"><?=ucwords(strtolower($row['nome']));?> [ <?=$row['numero'];?> ]</a></td>
			<td width="20"></td>
		</tr>
		<tr><td colspan="3" style="border-top: 1px solid black"></td></tr>
	<?	
	}
	?>
</table>