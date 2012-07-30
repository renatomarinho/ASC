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

$validations = new validations ( );
$db = new db ( );
$db->connect ();

?>

<div class="linha_separador" style="width: 480px; height: 50px;">
<table height="100%" cellpadding="0" cellspacing="2">
	<tr>
		<td><input type="text" id="pesquisacliente"
			style="width: 382px; font-size: 16px;" maxlength="50"></td>
		<td><input type="button" value="buscar cliente"
			class="botao btn_buscar"
			onclick="javascript:pesquisar_clienteselecionevenda();"></td>
		<td width="2"></td>
	</tr>
	<tr>
		<td colspan="2">
		<table width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td><input type="radio" id="rdopesquisanome" name="pesquisa" checked
					onclick="javascript:pesquisar_clienteselecionevenda();"></td>
				<td>Nome</td>
				<td width="10"></td>
				<td><input type="radio" id="rdopesquisacodigo" name="pesquisa"
					value="2" onclick="javascript:pesquisar_clienteselecionevenda();"></td>
				<td>C�digo</td>
				<td width="10"></td>
				<td><input type="radio" id="rdopesquisacpf" name="pesquisa"
					value="3" onclick="javascript:pesquisar_clienteselecionevenda();"></td>
				<td>CFP/CNPJ</td>
				<td width="10"></td>
				<td><input type="radio" id="rdopesquisaemail" name="pesquisa"
					value="4" onclick="javascript:pesquisar_clienteselecionevenda();"></td>
				<td>E-mail</td>
				<td width="10"></td>
				<td><input type="radio" id="rdopesquisatelefone" name="pesquisa"
					value="5" onclick="javascript:pesquisar_clienteselecionevenda();"></td>
				<td>Telefone</td>
				<td width="10"></td>
				<td><input type="radio" id="rdopesquisacelular" name="pesquisa"
					value="6" onclick="javascript:pesquisar_clienteselecionevenda();"></td>
				<td>Celular</td>
			</tr>
		</table>
		</td>
		<td width="1"></td>
	</tr>
</table>
</div>


<div>
<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td>
		<div id="listacliente"
			style="overflow: auto; height: 240px; width: 502px">
		
		</td>
	</tr>
	<tr>
		<td height="10" style="border-bottom: 2px solid black;"></td>
	</tr>
	<tr>
		<td height="25"></td>
	</tr>
	<tr>
		<td align="right" height="25"><input type="button"
			value="fechar sele��o de cliente" class="botao"
			style="cursor: pointer; cursor: hand; width: 180px;"
			onclick="javascript:carrega_selecionaclientevenda_fechar();"></td>
	</tr>
</table>
</div>
