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


<fieldset id="m"><legend>Cadastro de Contas</legend>

<div class="linha_separador ls_conf_M">
<table>
	<tr>
		<td><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/contas.png"
			class="t32"></td>
		<td width="10"></td>
		<td><b>Cadastro de contas para gerir o fluxo de caixa</b> <br />
		Para adicionar as contas da sua empresa clique em <i>"adicionar conta"</i>
		</td>
	</tr>
</table>
</div>

<div>

<table width="100%">
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td align="center">
		<table width="100%">
			<tr>
				<td height="25"><b>Tipo</b></td>
				<td><b>Nome Conta</b></td>
				<td><b>Banco</b></td>
				<td><b>Agência</b></td>
				<td><b>Conta</b></td>
				<td><b>Conta</b></td>
			</tr>
			<tr>
				<td colspan="6" style="border-bottom: 1px solid #c0c0c0"></td>
			</tr>
			<tr>
				<td height="25"></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td class="l1"></td>
	</tr>
	<tr>
		<td class="l2-r"><input type="button" value="adicionar conta"
			class="botao" style="cursor: pointer; cursor: hand; width: 140px;"
			onclick="javascript:configuracao_paginainicial_salvar();"></td>
	</tr>
</table>

</div>

</fieldset>
