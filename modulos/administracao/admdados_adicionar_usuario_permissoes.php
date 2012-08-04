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
<table width="100%">
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td align="center">
		<table cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td width="78"><input type="button" id="btncadastro" value="cadastro" class="botao" style="cursor:pointer;cursor:hand;width:78px;background-color:<?=$_CONF ['btn_clicado'];?>;" onclick="javascript:visualiza_usuariosadm_permissoes(0);" /></td>
				<td width="78"><input type="button" id="btnvenda" value="venda" class="botao" style="cursor: pointer; cursor: hand; width: 78px;" onclick="javascript:visualiza_usuariosadm_permissoes(1);" /></td>
				<td width="78"><input type="button" id="btnfinanceiro" value="financeiro" class="botao" style="cursor: pointer; cursor: hand; width: 78px;" onclick="javascript:visualiza_usuariosadm_permissoes(2);" /></td>
				<td width="78"><input type="button" id="btnrelatorio" value="relatorio" class="botao" style="cursor: pointer; cursor: hand; width: 78px;" onclick="javascript:visualiza_usuariosadm_permissoes(3);" /></td>
				<td width="78"><input type="button" id="btnutilitario" value="utilitario" class="botao" style="cursor: pointer; cursor: hand; width: 78px;" onclick="javascript:visualiza_usuariosadm_permissoes(4);" /></td>
				<td width="80"><input type="button" id="btnconfiguracao" value="configuracao" class="botao" style="cursor: pointer; cursor: hand; width: 100px;" onclick="javascript:visualiza_usuariosadm_permissoes(5);" /></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;<b>Permissões ::</b> <span id="titpermissao"><b>Cadastro</b><span></td>
	</tr>
	<tr>
		<td style="border-top: 2px solid black"></td>
	</tr>
	<tr>
		<td height="85px" valign="top">
		<div id="seleciona_permissoes">

		<div id="permisao_cadastro" style="display: block;">
		<table width="100%">
			<tr>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><label id="labper_0" class="label_checkbox"><input type="checkbox" style="width: 15px;" id="per_0" /></label></td>
						<td>clientes</td>
					</tr>
				</table>
				</td>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><label id="labper_1" class="label_checkbox"><input type="checkbox" style="width: 15px" id="per_1" /></label></td>
						<td>produtos</td>
					</tr>
				</table>
				</td>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><label id="labper_4" class="label_checkbox"><input type="checkbox" style="width: 15px" id="per_4" /></label></td>
						<td>estoque</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td height="25">
				<table>
					<tr>
						<td><label id="labper_2" class="label_checkbox"><input type="checkbox" style="width: 15px" id="per_2" /></label></td>
						<td>coleções</td>
					</tr>
				</table>
				</td>
				<td height="25">
				<table>
					<tr>
						<td><label id="labper_3" class="label_checkbox"><input type="checkbox" style="width: 15px" id="per_3" /></label></td>
						<td>fornecedores</td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</div>

		<div id="permisao_venda" style="display: none;">
		<table width="100%">
			<tr>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><label id="labper_5" class="label_checkbox"><input type="checkbox" style="width: 15px" id="per_5" /></label></td>
						<td>venda normal</td>
					</tr>
				</table>
				</td>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><label id="labper_6" class="label_checkbox"><input type="checkbox" style="width: 15px" id="per_6" /></label></td>
						<td>venda vip</td>
					</tr>
				</table>
				</td>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><label id="labper_8" class="label_checkbox"><input type="checkbox" style="width: 15px" id="per_8" /></label></td>
						<td>estornar produto</td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</div>

		<div id="permisao_financeiro" style="display: none;">
		<table width="100%">
			<tr>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><label id="labper_9" class="label_checkbox"><input type="checkbox" style="width: 15px" id="per_9" /></label></td>
						<td>consulta pagamento</td>
					</tr>
				</table>
				</td>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><label id="labper_10" class="label_checkbox"><input type="checkbox" style="width: 15px" id="per_10" /></label></td>
						<td>todos lançamentos</td>
					</tr>
				</table>
				</td>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><label id="labper_7" class="label_checkbox"><input type="checkbox" style="width: 15px" id="per_7" /></label></td>
						<td>lançamentos caixa</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><label id="labper_11" class="label_checkbox"><input type="checkbox" style="width: 15px" id="per_11" /></label></td>
						<td>lançamento turno</td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</div>

		<div id="permisao_relatorio" style="display: none;">
		<table width="100%">
			<tr>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><label id="labper_12" class="label_checkbox"><input type="checkbox" style="width: 15px" id="per_12" /></label></td>
						<td>produtos</td>
					</tr>
				</table>
				</td>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><label id="labper_13" class="label_checkbox"><input type="checkbox" style="width: 15px" id="per_13" /></label></td>
						<td>vendas</td>
					</tr>
				</table>
				</td>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><label id="labper_14" class="label_checkbox"><input type="checkbox" style="width: 15px" id="per_14" /></label></td>
						<td>estoque</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><label id="labper_15" class="label_checkbox"><input type="checkbox" style="width: 15px" id="per_15" /></label></td>
						<td>fornecedores</td>
					</tr>
				</table>
				</td>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><label id="labper_16" class="label_checkbox"><input type="checkbox" style="width: 15px" id="per_16" /></label></td>
						<td>clientes</td>
					</tr>
				</table>
				</td>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><label id="labper_17" class="label_checkbox"><input type="checkbox" style="width: 15px" id="per_17" /></label></td>
						<td>financeiros</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><label id="labper_18" class="label_checkbox"><input type="checkbox" style="width: 15px" id="per_18" /></label></td>
						<td>auxiliares</td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</div>

		<div id="permisao_utilitario" style="display: none;">
		<table width="100%">
			<tr>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><label id="labper_19" style="margin-bottom: 1px; padding-bottom: 1px;"><input type="checkbox" style="width: 15px" id="per_19" /></label></td>
						<td>agenda de eventos</td>
					</tr>
				</table>
				</td>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><label id="labper_20" style="margin-bottom: 1px; padding-bottom: 1px;"><input type="checkbox" style="width: 15px" id="per_20" /></label></td>
						<td>emissão de etiquetas</td>
					</tr>
				</table>
				</td>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><label id="labper_21" style="margin-bottom: 1px; padding-bottom: 1px;"><input type="checkbox" style="width: 15px" id="per_21" /></label></td>
						<td>verificar atualizações</td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</div>

		<div id="permisao_configuracao" style="display: none;">
		<table width="100%">
			<tr>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><label id="labper_22" style="margin-bottom: 1px; padding-bottom: 1px;"><input type="checkbox" style="width: 15px" id="per_22" /></label></td>
						<td>recuperar dados</td>
					</tr>
				</table>
				</td>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><label id="labper_23" style="margin-bottom: 1px; padding-bottom: 1px;"><input type="checkbox" style="width: 15px" id="per_23" /></label></td>
						<td>administradores</td>
					</tr>
				</table>
				</td>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><label id="labper_24" style="margin-bottom: 1px; padding-bottom: 1px;"><input type="checkbox" style="width: 15px" id="per_24" /></label></td>
						<td>configuração geral</td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</div>

		</div>
		</td>
	</tr>
	<tr>
		<td style="border-top: 2px solid black"></td>
	</tr>
	<tr>
		<td height="20" align="right"><input type="button" value="adicionar usuario" class="botao" id="btnadicionaradm" style="cursor: pointer; cursor: hand; width: 160px; background-color: green;" onclick="javascript:carregar_usuarioadm_adicionar_salvar();" /></td>
	</tr>
</table>