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

?>


<fieldset id="m"><legend><?=$_CONF['lang']['cartao'][4];?></legend>

<div class="linha_separador ls_conf_M">
<table>
	<tr>
		<td><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/dadosempresa.png" class="t32" /></td>
		<td width="10"></td>
		<td><b><?=$_CONF['lang']['cartao'][0];?></b><br /><?=$_CONF['lang']['cartao'][1];?><i><?=$_CONF['lang']['cartao'][2];?></i></td>
	</tr>
</table>
</div>

<div>
<div id="form_cartoes">
<table width="100%" border="1">
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td align="center"><div id="cartao_lista" style="overflow: auto; height: 180px; width: 480px;"></div></td>
	</tr>
	<tr>
		<td height="100"><div id="features"></div></td>
	</tr>
	<tr>
		<td class="l1"></td>
	</tr>
	<tr>
		<td class="l2-r">
			<table width="100%">
				<tr>
					<td align="left"><div id="message_card"></div></td>
					<td align="right"><input type="button" value="<?=$_CONF['lang']['cartao'][3];?>" class="botao btn_salvar" style="width:145px;" id="btnoption" onclick="javascript:Configuration.NewCard();" /></td>
				</tr>
			</table>			
		</td>
	</tr>
</table>
</div>
</div>

</fieldset>
