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

$idusuario = $validations->validNumeric ( $_GET ['i'] );

if ($idusuario) {
	$sql = 'SELECT id, login, senha, autoriza, ativo, nome FROM cad_login WHERE id=' . $idusuario;
	$query = $db->query ( $sql );
	$row = $db->fetch_assoc ( $query );
	for($n = 0; $n < $_CONF ['max_perm']; $n ++) {
		if (permite ( $row ['login'], $n ))
			$per [$n] = TRUE;
		else
			$per [$n] = 0;
	}

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
				<td width="78"><input type="button" id="btncadastro" value="cadastro" class="botao" style="cursor:pointer;cursor:hand;width:75px;background-color:<?=$_CONF ['btn_clicado'];?>;" onclick="javascript:visualiza_usuariosadm_permissoes(0);" /></td>
				<td width="78"><input type="button" id="btnvenda" value="venda" class="botao" style="cursor: pointer; cursor: hand; width: 75px;" onclick="javascript:visualiza_usuariosadm_permissoes(1);" /></td>
				<td width="78"><input type="button" id="btnfinanceiro" value="financeiro" class="botao" style="cursor: pointer; cursor: hand; width: 75px;" onclick="javascript:visualiza_usuariosadm_permissoes(2);" /></td>
				<td width="78"><input type="button" id="btnrelatorio" value="relat�rio" class="botao" style="cursor: pointer; cursor: hand; width: 75px;" onclick="javascript:visualiza_usuariosadm_permissoes(3);" /></td>
				<td width="78"><input type="button" id="btnutilitario" value="utilit�rio" class="botao" style="cursor: pointer; cursor: hand; width: 75px;" onclick="javascript:visualiza_usuariosadm_permissoes(4);" /></td>
				<td width="80"><input type="button" id="btnconfiguracao" value="configura��o" class="botao" style="cursor: pointer; cursor: hand; width: 100px;" onclick="javascript:visualiza_usuariosadm_permissoes(5);" /></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;<b>Permiss�es ::</b> <span id="titpermissao"><b>Cadastro</b><span></td>
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
						<td><input type="checkbox" style="width: 15px" id="per_0" <?=($per [0]) ? 'checked' : '';?> /></td>
						<td>clientes</td>
					</tr>
				</table>
				</td>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><input type="checkbox" style="width: 15px" id="per_1" <?=($per [1]) ? 'checked' : '';?> /></td>
						<td>produtos</td>
					</tr>
				</table>
				</td>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><input type="checkbox" style="width: 15px" id="per_4" <?=($per [4]) ? 'checked' : '';?> /></td>
						<td>estoque</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td height="25">
				<table>
					<tr>
						<td><input type="checkbox" style="width: 15px" id="per_2" <?=($per [2]) ? 'checked' : '';?> /></td>
						<td>cole��es</td>
					</tr>
				</table>
				</td>
				<td height="25">
				<table>
					<tr>
						<td><input type="checkbox" style="width: 15px" id="per_3" <?=($per [3]) ? 'checked' : '';?> /></td>
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
						<td><input type="checkbox" style="width: 15px" id="per_5" <?=($per [5]) ? 'checked' : '';?> /></td>
						<td>venda normal</td>
					</tr>
				</table>
				</td>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><input type="checkbox" style="width: 15px" id="per_6" <?=($per [6]) ? 'checked' : '';?> /></td>
						<td>venda vip</td>
					</tr>
				</table>
				</td>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><input type="checkbox" style="width: 15px" id="per_8" <?=($per [8]) ? 'checked' : '';?> /></td>
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
						<td><input type="checkbox" style="width: 15px" id="per_9" <?=($per [9]) ? 'checked' : '';?> /></td>
						<td>consulta pagamento</td>
					</tr>
				</table>
				</td>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><input type="checkbox" style="width: 15px" id="per_10" <?=($per [10]) ? 'checked' : '';?> /></td>
						<td>todos lan�amentos</td>
					</tr>
				</table>
				</td>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><input type="checkbox" style="width: 15px" id="per_7" <?=($per [7]) ? 'checked' : '';?> /></td>
						<td>lan�amentos caixa</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><input type="checkbox" style="width: 15px" id="per_11" <?=($per [11]) ? 'checked' : '';?> /></td>
						<td>lan�amento turno</td>
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
						<td><input type="checkbox" style="width: 15px" id="per_12" <?=($per [12]) ? 'checked' : '';?> /></td>
						<td>produtos</td>
					</tr>
				</table>
				</td>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><input type="checkbox" style="width: 15px" id="per_13" <?=($per [13]) ? 'checked' : '';?> /></td>
						<td>vendas</td>
					</tr>
				</table>
				</td>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><input type="checkbox" style="width: 15px" id="per_14" <?=($per [14]) ? 'checked' : '';?> /></td>
						<td>estoque</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><input type="checkbox" style="width: 15px" id="per_15" <?=($per [15]) ? 'checked' : '';?> /></td>
						<td>fornecedores</td>
					</tr>
				</table>
				</td>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><input type="checkbox" style="width: 15px" id="per_16" <?=($per [16]) ? 'checked' : '';?> /></td>
						<td>clientes</td>
					</tr>
				</table>
				</td>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><input type="checkbox" style="width: 15px" id="per_17" <?=($per [17]) ? 'checked' : '';?> /></td>
						<td>financeiros</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><input type="checkbox" style="width: 15px" id="per_18" <?=($per [18]) ? 'checked' : '';?> /></td>
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
						<td><input type="checkbox" style="width: 15px" id="per_19" <?=($per [19]) ? 'checked' : '';?> /></td>
						<td>agenda de eventos</td>
					</tr>
				</table>
				</td>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><input type="checkbox" style="width: 15px" id="per_20" <?=($per [20]) ? 'checked' : '';?> /></td>
						<td>emiss�o de etiquetas</td>
					</tr>
				</table>
				</td>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><input type="checkbox" style="width: 15px" id="per_21" <?=($per [21]) ? 'checked' : '';?> /></td>
						<td>verificar atualiza��es</td>
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
						<td><input type="checkbox" style="width: 15px" id="per_22" <?=($per [22]) ? 'checked' : '';?> /></td>
						<td>recuperar dados</td>
					</tr>
				</table>
				</td>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><input type="checkbox" style="width: 15px" id="per_23" <?=($per [23]) ? 'checked' : '';?> /></td>
						<td>administradores</td>
					</tr>
				</table>
				</td>
				<td width="33%" height="25">
				<table>
					<tr>
						<td><input type="checkbox" style="width: 15px" id="per_24" <?=($per [24]) ? 'checked' : '';?> /></td>
						<td>configura��o geral</td>
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
		<td height="20">
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td align="left"><span id="msgpermissoes"></span></td>
				<td align="right"><input type="button" value="modificar permiss�es" class="botao" id="btnadicionaradm" style="cursor: pointer; cursor: hand; width: 160px; background-color: green;" onclick="javascript:carregar_permissoessalvar(<?=$idusuario;?>);" /></td>
			</tr>
		</table>
		</td>
	</tr>
</table>