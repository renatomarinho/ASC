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


<fieldset id="p"><legend>Adicionar Categoria [ modo r�pido ]</legend>

<div id="etapa1" style="width: 377px;">

<div class="linha_separador" id="mensagem" style="width: 352px; height: 27px;">
<table width="100%" height="100%">
	<tr>
		<td align="center"><span id="mensagem_texto"></span></td>
	</tr>
</table>
</div>

<div>

<table width="370">
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td height="20"><b>Dados da categoria</b></td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td height="25">
		<table>
			<tr>
				<td>Nome</td>
				<td width="5"></td>
				<td><input class="input" type="text" id="nomenovacategoria1" style="width: 180px" maxlength="30"></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td height="2"></td>
	</tr>
	<tr>
		<td align="right"><input type="button" class="botao" style="cursor: pointer; cursor: hand; width: 140px; background-color: green;" value="adicionar categoria" onClick="javascript:adicionar_novacategoria();"></td>
	</tr>
</table>

</div>

</div>

<div id="etapa2" style="display: none; width: 377px;">

<div class="linha_separador" style="width: 352px;">
<table width="100%">
	<tr>
		<td align="center"><span id="msgcorrecaocat"><b style="color: blue;">O
		nome da categoria est� escrito corretamente?</b><BR>
		Clique em "<b>Confirmar</b>" para adicionar ou em "<b>Voltar</b>" para
		modificar</span></td>
	</tr>
	<tr>
		<td align="center"></td>
	</tr>
</table>
</div>

<div id="etapa2_texto">
<table width="100%">
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td height="40" align="center">
		<p id="nomenovacategoria2" style="font-size: 16px;"></p>
		</td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td>
		<table width="100%">
			<tr>
				<td align="left"><input type="button" id="catbtnvoltar" class="botao" style="cursor: pointer; cursor: hand; width: 120px; background-color: red;" value="Voltar" onClick="javascript:adicionar_novacategoriavoltaretapa();"></td>
				<td align="right"><input type="button" id="catbtnsalvar" class="botao" style="cursor: pointer; cursor: hand; width: 120px; background-color: green;" value="Confirmar" onClick="javascript:adicionar_novacategoriasalvar();"></td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</div>

</div>

</fieldset>