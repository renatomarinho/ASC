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


<fieldset id="p"><legend><?=$_CONF['lang']['index'][0];?></legend>

<div class="linha_separador ls_conf_P">
<table>
	<tr>
		<td><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/configuracao.png" class="t32" /></td>
		<td width="10"></td>
		<td><b><?=$_CONF['lang']['index'][1];?></b><br /><?=$_CONF['lang']['index'][2];?></td>
	</tr>
</table>
</div>
<div>
		
<table width="370">
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td>
		
		<table width="370">
			<tr>
				<td colspan="2" height="5"></td>
				<td height="5"></td>
			</tr>
			<tr>
				<td>
					<table width="100%">
						<tr>
							<td align="center"><input type="button" value="<?=$_CONF['lang']['index'][3];?>" class="botao btn_irpara" style="cursor:pointer;cursor:hand;width:170px;" onclick="javascript:Configuration.LoadPage('empresa');"></td>
							<td align="center"><input type="button" value="<?=$_CONF['lang']['index'][4];?>" class="botao btn_irpara" style="cursor:pointer;cursor:hand;width:170px;" onclick="javascript:Configuration.LoadPage('autenticacao');" /></td>
						</tr>
						<tr>
							<td colspan="2" height="5"></td>
						</tr>
						<tr>
							<td align="center"><input type="button" value="<?=$_CONF['lang']['index'][5];?>" class="botao btn_irpara" style="width:170px;" onclick="javascript:Configuration.LoadPage('banco');"></td>
							<td align="center"><input type="button" value="<?=$_CONF['lang']['index'][6];?>" class="botao btn_irpara" style="cursor:pointer;cursor:hand;width:170px;" onclick="javascript:Configuration.LoadPage('cartao');"></td>
						</tr>
						<tr>
							<td colspan="2" height="5"></td>
						</tr>
						<tr>
							<td align="center"><input type="button" value="<?=$_CONF['lang']['index'][7];?>" class="botao btn_irpara" style="width:170px;" onclick="javascript:Configuration.LoadPage('alerta');"></td>
							<td align="center"><input type="button" value="<?=$_CONF['lang']['index'][8];?>" class="botao btn_irpara" style="cursor:pointer;cursor:hand;width:170px;" onclick="javascript:Configuration.LoadPage('financeiro');"></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</div>

</fieldset>