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

<fieldset id="m"><legend>Lista de Fornecedores</legend>

<div class="linha_separador" style="width: 480px;">

<table width="100%">
	<tr>
		<td align="left" width="160"><input type="button"
			value="estatísticas fornecedores" class="botao"
			style="cursor: pointer; cursor: hand; width: 160px;"
			onclick="javascript:historicofornecedor();document.getElementById('adicionarfornecedor').style.display='block';"></td>
		<td align="center"><input type="button" value="comparar fornecedores"
			class="botao" style="cursor: pointer; cursor: hand; width: 160px;"
			onclick="javascript:cadastro_fornecedor_comparar();"></td>
		<td align="right" width="140"><input type="button"
			value="adicionar fornecedor" id="adicionarfornecedor" class="botao"
			style="cursor: pointer; cursor: hand; width: 140px;"
			onclick="javascript:adicionar_fornecedor();this.style.display='none';"></td>
	</tr>
</table>

</div>


<div>

<table width="502">
	<tr>
		<td bgcolor="#f0f0f0">
		<table width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="10"></td>
				<td width="230" height="25"><b>Nome</b></td>
				<td height="25" align="right"><b>Telefone</b></td>
				<td width="80" height="25" align="right"><b>País</b></td>
				<td width="80" height="25" align="right"><b>Prods.</b></td>
				<td width="35"></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>
		<div id="listafornecedor"
			style="overflow: auto; height: 310px; width: 496px"></div>
		</td>
	</tr>
</table>

</div>

</fieldset>