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

require "_language.php";

if (! isset ( $_CONF ['PATH'] )) {
	require "../../config/default.php";
}

$db = new db ();
$db->connect ();
?>

<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<?
	$sql = "SELECT id, nome, credito, debito, tx_credito1, tx_credito2, tx_debito1, tx_debito2, status FROM cad_cartoes ORDER BY nome ASC";
	$query = $db->query($sql);
	while ($row = $db->fetch_assoc($query)){
	?>
		<tr bgcolor="#f0f0f0">
			<td width="20" height="25"></td>
			<td><a href="javascript:;" style="color:<?=($row['status']==0)?'red':''?>" onclick="javascript:Configuration.ShowCard(<?=$row['id'];?>);"><?=ucwords(strtolower($row['nome']));?></a></td>
			<td width="20"></td>
		</tr>
		<tr><td colspan="3" style="border-top: 1px solid black"></td></tr>
		<tr>
			<td></td>
			<td>
				<div style="display:<?=($row['credito']==1)?'block':'none';?>">
					<table cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td height="25" width="50"></td>
							<td width="40"><?=$_CONF['lang']['cartao_lista'][0];?></td>
							<td width="60"></td>
							<td width="150"><?=$_CONF['lang']['cartao_lista'][1];?> : <?=$row['tx_credito1'];?> %</td>
							<td width="150"><?=$_CONF['lang']['cartao_lista'][2];?> : <?=$row['tx_credito2'];?> %</td>
						</tr>
					</table>
				</div>
				<div style="display:<?=($row['debito']==1)?'block':'none';?>">
					<table cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td height="25" width="50"></td>
							<td width="40"><?=$_CONF['lang']['cartao_lista'][3];?></td>
							<td width="60"></td>
							<td width="150"><?=$_CONF['lang']['cartao_lista'][4];?> : <?=$row['tx_debito1'];?> %</td>
							<td width="150"></td>
						</tr>
					</table>
				</div>
			</td>
			<td width="20"></td>
		</tr>
		<tr><td colspan="3" style="border-top: 1px solid black"></td></tr>
	<?	
	}
	?>
	</table>