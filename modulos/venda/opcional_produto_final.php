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

?>

<table>
	<tr>
		<td height="25" align="right">
			<select id="opcional_forma" style="width: 90px;" onchange="javascript:atualiza_desconto_final();">
				<option value="desconto">desconto</option>
				<option value="acrescimo">acr�scimo</option>
			</select>
		</td>
		<td width="10"></td>
		<td align="right">
			<select id="opcional_forma_valor" style="width: 100px;" onchange="javascript:atualiza_desconto_final();">
				<option onclick="javascript:document.getElementById('porcentagem').innerHTML=' % ';document.getElementById('fixo').innerHTML=''" value="porcentagem">porcentagem</option>
				<option onclick="javascript:document.getElementById('porcentagem').innerHTML='';document.getElementById('fixo').innerHTML='R$ '" value="fixo">valor fixo</option>
			</select>
		</td>
		<td width="10"></td>
		<td align="right">
			<span id="fixo"></span>
			<input type="text" id="vlnumero" style="width: 60px; text-align: right;" maxlength="6" onkeyup="javascript:atualiza_desconto_final();"><span id="porcentagem"> % </span>
		</td>
	</tr>
	<tr>
		<td colspan="7" align="right">
		<div id="msgerroopc"></div>
		</td>
	</tr>
</table>