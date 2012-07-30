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


<fieldset id="m"><legend>Centro de Custos</legend>

<div class="linha_separador" style="width: 480px; height: 27px;">
<table width="100%">
	<tr>
		<td></td>
	</tr>
</table>
</div>

<div>

<table width="100%">
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td height="25"><b>Cadastre as contas utilizadas no Real Virtual Store</b></td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td align="center">
		<table width="100%">
			<tr>
				<td height="25"><b>Descri��o do centro de custo</b></td>
			</tr>
			<tr>
				<td style="border-bottom: 1px solid #c0c0c0"></td>
			</tr>
			<tr>
				<td height="25"></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td align="right"><input type="button" value="adicionar novo grupo"
			class="botao" style="cursor: pointer; cursor: hand; width: 140px;"
			onclick="javascript:configuracao_paginainicial_salvar();"></td>
	</tr>
</table>

</div>

</fieldset>
