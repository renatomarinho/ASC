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


<fieldset id="m"><legend><?=$_CONF['lang']['autenticacao'][0];?></legend>

<div class="linha_separador ls_conf_M">
<table>
	<tr>
		<td><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/autenticacao.png" class="t32"></td>
		<td width="10"></td>
		<td><b><?=$_CONF['lang']['autenticacao'][1];?></b><br /><?=$_CONF['lang']['autenticacao'][2];?> <i><?=$_CONF['lang']['autenticacao'][3];?></i></td>
	</tr>
</table>
</div>

<div>

<table width="100%">
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td align="center"><div id="autenticacao_lista"></div></td>
	</tr>
	<tr>
		<td class="l1"></td>
	</tr>
	<tr>
		<td class="l2-r">
			<table width="100%">
				<tr>
					<td align="left"><div id="message"></td>
					<td align="right"><input type="button" value="<?=$_CONF['lang']['autenticacao'][3];?>" class="botao btn_salvar" style="width: 145px;" onclick="javascript:Configuration.AuthSave();"></td>
				</tr>
			</table>
		</td>
	</tr>
</table>

</div>

</fieldset>

