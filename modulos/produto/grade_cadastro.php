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


<fieldset id="p"><legend>Adicionar Grade ao Produto</legend>

<div class="linha_separador" id="linha_separador_gradeedicao"
	style="height: 28px;">
<table width="100%" height="100%">
	<tr>
		<td align="center"><span id="msggrade"><b style="color: blue;">Preencha
		os campos abaixo para adicionar itens a grade</b><span></td>
	</tr>
</table>
</div>

<div id="divadicionaritem">
<table width="370">
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td height="20">
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td align="left"><b>Adicionar novo item a grade</b></td>
				<td align="right"><span id="addgradeerro"></span></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td align="right">
		<table>
			<tr>
				<td height="20">Nome</td>
				<td width="5"></td>
				<td height="20"><input type="text" id="add_nomegrade" maxlength="30"></td>
				<td width="10"></td>
				<td height="20">Quantidade</td>
				<td width="5"></td>
				<td height="20"><input type="text" id="add_qtdgrade" style="width: 50px; text-align: right;" maxlength="4"></td>
			</tr>
			<tr>
				<td height="20">Preço único</td>
				<td width="5"></td>
				<td height="20"><input type="text" id="add_precounico" style="width: 50px; text-align: right;" value="0.00" onkeydown="javascript:formata_valor('add_precounico', 13, event)" onfocus="javascript:document.getElementById('add_precounico').value='';" maxlength="6" /></td>
				<td width="10"></td>
				<td height="20" colspan="3" align="right"><input type="button" class="botao" id="add_gradedados" onclick="javascript:adicionar_itemgradenova();" style="cursor: pointer; cursor: hand; background-color: green;" value="adicionar item" /></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td height="20"><b>Itens atuais da grade</b></td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td>
		<table width="100%" cellpadding="0" cellspacing="0">
			<tr bgcolor="#f0f0f0">
				<td height="20">&nbsp;&nbsp;<b>Nome</b></td>
				<td width="100" align="center"><b>Preço único</b></td>
				<td width="85" align="center"><b>Quantidade</b></td>
				<td width="60"></td>
			</tr>
			<tr>
				<td colspan="4">
				<div id="listagrade" style="overflow: auto; height: 190px; width: 370px;"></div>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>

</div>

</fieldset>

