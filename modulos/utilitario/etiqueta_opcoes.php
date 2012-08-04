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


<fieldset id="p"><legend>Emissão de Etiquetas</legend>

<div class="linha_separador" style="height: 28px;">
<table width="100%" height="100%">
	<tr>
		<td align="center"><span id="msggrade"><b style="color: blue;">Escolha
		as opções para a impressão das etiquetas</b><span></td>
	</tr>
</table>
</div>

<div>

<table width="375">
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td height="25"><b>Valor</b></td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td height="25">
		<table>
			<tr>
				<td><input type="radio" name="valor" id="nenhum" checked></td>
				<td>Nenhum</td>
				<td width="30"></td>
				<td><input type="radio" name="valor" id="vlatacado"></td>
				<td>Pronta Entrega</td>
				<td width="30"></td>
				<td><input type="radio" name="valor" id="vlpentrega"></td>
				<td>Atacado</td>
				<td width="30"></td>
				<td><input type="radio" name="valor" id="vlvarejo"></td>
				<td>Varejo</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td height="25"><b>Produto</b></td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td>
		<table width="375" height="130" border="1">
			<tr>
				<td height="25" width="15"><input type="radio" name="produto"
					id="prod_todos" onchange="javascript:etiqueta_produto();" checked></td>
				<td>
				<table width="100%" height="100">
					<tr>
						<td>Busca refinada:</td>
						<td align="right">
						<div id="div_categoria" style="display: block;">
						<table width="100%">
							<tr>
								<td width="15"></td>
								<td align="left" height="25"><b>Categoria</b></td>
								<td align="right"><select name="produtotipo_id"
									id="produtotipo_id"
									onclick="javascript:document.getElementById('codbarra').value='';"
									style="width: 150px; font-size: 11px;">
									<option value="">Todas</option>
															<?
															$sql = "SELECT idprodutotipo, txtnome FROM produtotipo ORDER BY txtnome ASC";
															$query = $db->query ( $sql );
															while ( $rows = $db->fetch_assoc ( $query ) ) {
																echo "<option value='" . $rows ['idprodutotipo'] . "'>" . ucwords ( strtolower ( $rows ['txtnome'] ) ) . "</option>";
															}
															?>
														</select></td>
								<td width="8"></td>
							</tr>
							<tr>
								<td width="15"></td>
								<td align="left" height="25"><b>Fornecedor</b></td>
								<td align="right"><select name="fornecedor_id"
									id="fornecedor_id"
									onclick="javascript:document.getElementById('codbarra').value='';"
									style="width: 150px; font-size: 11px;">
									<option value="">Todos</option>
															<?
															$sql = "SELECT idfornecedor, nome FROM fornecedor ORDER BY nome ASC";
															$query = $db->query ( $sql );
															while ( $rows = $db->fetch_assoc ( $query ) ) {
																echo "<option value='" . $rows ['idfornecedor'] . "'>" . ucwords ( strtolower ( $rows ['nome'] ) ) . "</option>";
															}
															?>
														</select></td>
								<td width="8"></td>
							</tr>
							<tr>
								<td width="15"></td>
								<td align="left" height="25"><b>Coleção</b></td>
								<td align="right"><select name="colecao_id" id="colecao_id"
									onclick="javascript:document.getElementById('codbarra').value='';"
									style="width: 150px; font-size: 11px;">
									<option value="">Todas</option>
															<?
															$sql = "SELECT idcolecao, txtnome FROM colecao ORDER BY txtnome ASC";
															$query = $db->query ( $sql );
															while ( $rows = $db->fetch_assoc ( $query ) ) {
																echo "<option value='" . $rows ['idcolecao'] . "'>" . ucwords ( strtolower ( $rows ['txtnome'] ) ) . "</option>";
															}
															?>
														</select></td>
								<td width="8"></td>
							</tr>
						</table>
						</div>
						</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td height="25" width="15"><input type="radio" name="produto"
					id="prod_especifico" onchange="javascript:etiqueta_produto();"></td>
				<td>
				<table width="100%">
					<tr>
						<td>Produto específico</td>
						<td align="right">
						<div id="ecodbarra" style="display: none;">
						<table>
							<tr>
								<td><b>Cód. Barra</b></td>
								<td width="5"></td>
								<td><input type="text" id="codbarra"
									style="width: 115px; text-align: right;" maxlength="18"></td>
							</tr>
						</table>
						</div>
						</td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td height="25"><b>Modelo</b></td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td>
		<table>
			<tr>
				<td height="25">Selecione o modelo</td>
				<td width="10"></td>
				<td><select id="etiqueta_modelo">
					<option value="etiqueta_6087">&nbsp;&nbsp;6087 - branca&nbsp;&nbsp;</option>
					<option value="etiqueta_6089">&nbsp;&nbsp;6089 - branca&nbsp;&nbsp;</option>
				</select></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td>
		<table width="100%">
			<tr>
				<td align="left"><span id="msgerro"></span></td>
				<td align="right" width="150"><input type="button" class="botao"
					id="geraetiquetas" value="Gerar Etiquetas"
					style="cursor: pointer; cursor: hand; width: 150px;"
					onClick="javascript:geraretiqueta_impressao_produto();"></td>
			</tr>
		</table>
		</td>
	</tr>
</table>

</div>

</fieldset>