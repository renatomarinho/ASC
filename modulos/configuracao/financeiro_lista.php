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

<table width="100%" cellpadding="5" cellspacing="5" border="0">
	<?
	$sql = "SELECT parcela_min_cartao, parcela_min_debito, parcela_min_cheque, tolerancia_atraso, bloquear_credito, receber_avista_baixar, receber_avista_lancar, receber_manual_lancar, pagar_manual_lancar FROM configuracao WHERE id=1";
	$query = $db->query($sql);
	$row = $db->fetch_assoc($query);
	?>
	<tr>
		<td colspan="2"><b><?=$_CONF['lang']['financeiro_lista'][0];?></b></td>
	</tr>
	<tr>
		<td width="20"><input type="checkbox" id="r_avista_baixar" <?=($row['receber_avista_baixar']==1)?'checked':'';?> /></td>
		<td><?=$_CONF['lang']['financeiro_lista'][1];?></td>
	</tr>
	<tr>
		<td width="20"><input type="checkbox" id="r_avista_lancar" <?=($row['receber_avista_lancar']==1)?'checked':'';?> /></td>
		<td><?=$_CONF['lang']['financeiro_lista'][2];?></td>
	</tr>
	<tr>
		<td width="20"><input type="checkbox" id="r_manual_lancar" <?=($row['receber_manual_lancar']==1)?'checked':'';?> /></td>
		<td><?=$_CONF['lang']['financeiro_lista'][3];?></td>
	</tr>
	<tr><td><br /></td></tr>
	<tr>
		<td colspan="2"><b><?=$_CONF['lang']['financeiro_lista'][4];?></b></td>
	</tr>
	<tr>
		<td width="20"><input type="checkbox" id="p_manual_lancar" <?=($row['pagar_manual_lancar']==1)?'checked':'';?> /></td>
		<td><?=$_CONF['lang']['financeiro_lista'][5];?></td>
	</tr>
	<tr><td><br /></td></tr>
	<tr>
		<td colspan="2"><b><?=$_CONF['lang']['financeiro_lista'][6];?></b></td>
	</tr>
	<tr>
		<td colspan="2">
			<table cellpadding="5" cellspacing="5">
				<tr>
					<td><?=$_CONF['lang']['financeiro_lista'][7];?></td>
					<td width="10"></td>
					<td width="20"><input type="text" id="t_atraso" style="width:50px;text-align:right;" value="<?=$row['tolerancia_atraso'];?>" maxlength="3" /></td>
					<td><?=$_CONF['lang']['financeiro_lista'][8];?></td>
				</tr>
				<tr>
					<td><?=$_CONF['lang']['financeiro_lista'][9];?></td>
					<td width="10"></td>
					<td width="20"><input type="text" id="b_credito" style="width:50px;text-align:right;" value="<?=$row['bloquear_credito'];?>" maxlength="3" /></td>
					<td><?=$_CONF['lang']['financeiro_lista'][8];?></td>
				</tr>
				<tr>
					<td><?=$_CONF['lang']['financeiro_lista'][10];?></td>
					<td width="10"><?=$_CONF['lang']['financeiro_lista'][13];?></td>
					<td width="20"><input type="text" id="min_cartao" style="width:50px;text-align:right;" value="<?=$row['parcela_min_cartao'];?>" maxlength="6" /></td>
				</tr>
				<tr>
					<td><?=$_CONF['lang']['financeiro_lista'][11];?></td>
					<td width="10"><?=$_CONF['lang']['financeiro_lista'][13];?></td>
					<td width="20"><input type="text" id="min_debito" style="width:50px;text-align:right;" value="<?=$row['parcela_min_debito'];?>" maxlength="6" /></td>
				</tr>
				<tr>
					<td><?=$_CONF['lang']['financeiro_lista'][12];?></td>
					<td width="10"><?=$_CONF['lang']['financeiro_lista'][13];?></td>
					<td width="20"><input type="text" id="min_cheque" style="width:50px;text-align:right;" value="<?=$row['parcela_min_cheque'];?>" maxlength="6" /></td>
				</tr>
			</table>
		</td>
	</tr>
	
</table>