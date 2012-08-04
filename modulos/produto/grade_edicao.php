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

unset ( $_SESSION ['gradeproduto'] );

?>


<fieldset id="p"><legend>Editar Grade do Produto</legend>

<div class="linha_separador ls_conf_P" id="linha_separador_gradeedicao" style="display: none;"></div>
<div class="linha_separador ls_conf_P" id="linha_separador_gradeedicao2">

<table>
	<tr>
		<td><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/produtograde32.png" class="t32" /></td>
		<td width="10"></td>
		<td><b>Itens que compõem a grade do produto</b> <br />
		Inclua um novo item clicando em <i>"adicionar item"</i></td>
	</tr>
</table>
</div>


<div id="divadicionaritem">
<table width="370">
	<tr>
		<td height="15"><span id="addgradeerro"></span></td>
	</tr>
	<tr>
		<td align="center">
		<table width="100%">
			<tr>
				<td height="20"><b>Nome</b></td>
				<td width="5"></td>
				<td height="20"><input type="text" id="add_nomegrade" maxlength="30"></td>
				<td width="10"></td>
				<td height="20"><b>Quantidade</b></td>
				<td width="5"></td>
				<td height="20"><input type="text" id="add_qtdgrade" style="width: 50px; text-align: right;" maxlength="4" /></td>
			</tr>
			<tr>
				<td height="20"><b>Preço único</b></td>
				<td width="5"></td>
				<td height="20"><input type="text" id="add_precounico" style="width: 50px; text-align: right;" value="0.00" onkeydown="javascript:formata_valor('add_precounico', 13, event)" onfocus="javascript:document.getElementById('add_precounico').value='';" maxlength="6" /></td>
				<td width="10"></td>
				<td height="20" colspan="3" align="right"><input type="button" class="botao green btn_adicionargreen" id="add_gradedados" value="adicionar item" style="width: 126px;" onclick="javascript:adicionar_itemgrade();"></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td class="l1"></td>
	</tr>
	<tr>
		<td height="25">
		<table width="100%">
			<tr>
				<td><b>Lista da grade</b></td>
				<td align="right"><span id="msggrade"></span></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td class="l3"></td>
	</tr>
	<tr>
		<td>
		<div id="listagrade" style="overflow: auto; height: 215px; width: 375px;"></div>
		</td>
	</tr>
</table>

</div>

</fieldset>
