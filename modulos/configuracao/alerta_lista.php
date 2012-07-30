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

<table width="100%" cellpadding="3" cellspacing="3" border="0">
	<?
	$sql = "SELECT alerta_pedidocompras, alerta_contasreceber, alerta_contasreceber_tempo, alerta_contaspagar, alerta_contaspagar_tempo, alerta_estoque, alerta_pedidos, alerta_cobrancas FROM configuracao WHERE id=1";
	$query = $db->query($sql);
	$row = $db->fetch_assoc($query);
	?>
	<tr>
		<td><b><?=$_CONF['lang']['alerta_lista'][0];?></b></td>
		<td width="20"><input type="radio" name="receber" id="receber_s" <?=($row['alerta_contasreceber']==1)?'checked':'';?> /></td>
		<td><?=$_CONF['lang']['alerta_lista'][1];?></td>
		<td width="20"><input type="radio" name="receber" id="receber_n" <?=($row['alerta_contasreceber']==0)?'checked':'';?> /></td>
		<td><?=$_CONF['lang']['alerta_lista'][2];?></td>
	</tr>
	<tr>
		<td colspan="5"><?=$_CONF['lang']['alerta_lista'][3];?> <input type="text" id="receber_dias" value="<?=$row['alerta_contasreceber_tempo'];?>" style="width:30px" /> <?=$_CONF['lang']['alerta_lista'][4];?></td>
	</tr>
	<tr><td><br /></td></tr>
	<tr>
		<td><b><?=$_CONF['lang']['alerta_lista'][5];?></b></td>
		<td width="20"><input type="radio" name="pagar" id="pagar_s" <?=($row['alerta_contaspagar']==1)?'checked':'';?> /></td>
		<td><?=$_CONF['lang']['alerta_lista'][1];?></td>
		<td width="20"><input type="radio" name="pagar" id="pagar_n" <?=($row['alerta_contaspagar']==0)?'checked':'';?> /></td>
		<td><?=$_CONF['lang']['alerta_lista'][2];?></td>
	</tr>
	<tr>
		<td colspan="5"><?=$_CONF['lang']['alerta_lista'][3];?> <input type="text" id="pagar_dias" value="<?=$row['alerta_contaspagar_tempo'];?>" style="width:30px" /> <?=$_CONF['lang']['alerta_lista'][4];?></td>
	</tr>
	<tr><td><br /></td></tr>
	<tr>
		<td><b><?=$_CONF['lang']['alerta_lista'][6];?></b></td>
		<td width="20"><input type="radio" name="estoque" id="estoque_s" <?=($row['alerta_estoque']==1)?'checked':'';?> /></td>
		<td><?=$_CONF['lang']['alerta_lista'][1];?></td>
		<td width="20"><input type="radio" name="estoque" id="estoque_n" <?=($row['alerta_estoque']==0)?'checked':'';?> /></td>
		<td><?=$_CONF['lang']['alerta_lista'][2];?></td>
	</tr>
	<tr><td><br /></td></tr>
	<tr>
		<td><b><?=$_CONF['lang']['alerta_lista'][7];?></b></td>
		<td width="20"><input type="radio" name="pedidos" id="pedidos_s" <?=($row['alerta_pedidos']==1)?'checked':'';?> /></td>
		<td><?=$_CONF['lang']['alerta_lista'][1];?></td>
		<td width="20"><input type="radio" name="pedidos" id="pedidos_n" <?=($row['alerta_pedidos']==0)?'checked':'';?> /></td>
		<td><?=$_CONF['lang']['alerta_lista'][2];?></td>
	</tr>
	<tr><td><br /></td></tr>
	<tr>
		<td><b><?=$_CONF['lang']['alerta_lista'][8];?></b></td>
		<td width="20"><input type="radio" name="cobrancas" id="cobrancas_s" <?=($row['alerta_cobrancas']==1)?'checked':'';?> /></td>
		<td><?=$_CONF['lang']['alerta_lista'][1];?></td>
		<td width="20"><input type="radio" name="cobrancas" id="cobrancas_n" <?=($row['alerta_cobrancas']==0)?'checked':'';?> /></td>
		<td><?=$_CONF['lang']['alerta_lista'][2];?></td>
	</tr>
	<tr><td><br /></td></tr>
	<tr>
		<td><b><?=$_CONF['lang']['alerta_lista'][9];?></b></td>
		<td width="20"><input type="radio" name="compras" id="compras_s" <?=($row['alerta_pedidocompras']==1)?'checked':'';?> /></td>
		<td><?=$_CONF['lang']['alerta_lista'][1];?></td>
		<td width="20"><input type="radio" name="compras" id="compras_n" <?=($row['alerta_pedidocompras']==0)?'checked':'';?> /></td>
		<td><?=$_CONF['lang']['alerta_lista'][2];?></td>
	</tr>
</table>