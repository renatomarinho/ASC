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
$db = new db ( );
$db->connect ();

unset ( $_SESSION ['produto'] );
unset ( $_SESSION ['gradeproduto'] );

?>

<fieldset id="m"><legend>Adicionar Produto</legend>

<div class="linha_separador" id="linhaadicionarproduto"
	style="width: 480px;">
<table width="100%">
	<tr>
		<td align="left"><input type="button" class="botao" id="btnvoltagrade" style="cursor: pointer; cursor: hand; width: 200px; display: none;" id="voltargrade" value="Voltar para grade do produto" onClick="javascript:lista_adicionargrade();document.getElementById('btnvoltagrade').style.display='none';"></td>
		<td align="right"><input type="button" class="botao" style="cursor: pointer; cursor: hand; width: 140px;" id="irlistagem" value="Ir para Listagem" onClick="javascript:carrega_listagemprodutos(path+'modulos/produto/lista.php','conteudo_total');"></td>
	</tr>
</table>
</div>

<div id="divadicionarproduto">
<table width="100%">
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td height="20"><b>Dados Gerais do produto</b></td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td>
			<table>
				<tr>
					<td>Nome</td>
					<td width="40"></td>
					<td height="20"><input type="text" id="produto" style="width: 160px;" maxlength="60"></td>
					<td width="12"></td>
					<td>C�digo</td>
					<td width="35"></td>
					<td height="20"><input type="text" id="codigo" style="width: 160px;" maxlength="60"></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td width="50%">
				<table>
					<tr>
						<td width="70" height="20">Categoria</td>
						<td height="20">
							<select id="categoria" style="width: 160px;">
								<option value="0">selecione</option>
								<?
								$sql = "SELECT idprodutotipo, txtnome FROM produtotipo ORDER BY txtnome ASC";
								$query = $db->query ( $sql );
								while ( $row2 = $db->fetch_assoc ( $query ) ) {
									echo '<option value="' . $row2 ['idprodutotipo'] . '">' . ucwords ( strtolower ( $row2 ['txtnome'] ) ) . '</option>';
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td width="70" height="20">Fornecedor</td>
						<td height="20">
							<select id="fornecedor" style="width: 160px;">
								<option value="0">selecione</option>
								<?
								$for = '';
								if (isset ( $_GET ['for'] )) {
									$for = $_GET ['for'];
									$_SESSION ['for'] = $for;
								}
								$sql = "SELECT idfornecedor, nome FROM fornecedor ORDER BY nome ASC";
								$query = $db->query ( $sql );
								while ( $row2 = $db->fetch_assoc ( $query ) ) {
									echo '<option value="' . $row2 ['idfornecedor'] . '" ' . (($for == $row2 ['idfornecedor']) ? 'selected' : '') . '>' . ucwords ( strtolower ( $row2 ['nome'] ) ) . '</option>';
								}
								?>
							</select>
						</td>
					</tr>
				</table>
				</td>
				<td width="50%">
				<table>
					<tr>
						<td width="70" height="20">Cole��o</td>
						<td height="20">
							<select id="colecao" style="width: 160px;">
								<option value="0">selecione</option>
								<?
								$col = '';
								if (isset ( $_GET ['col'] )) {
									$col = $_GET ['col'];
									$_SESSION ['col'] = $col;
								}
								$sql = "SELECT idcolecao, txtnome FROM colecao ORDER BY txtnome ASC";
								$query = $db->query ( $sql );
								while ( $row2 = $db->fetch_assoc ( $query ) ) {
									echo '<option value="' . $row2 ['idcolecao'] . '" ' . (($col == $row2 ['idcolecao']) ? 'selected' : '') . '>' . ucwords ( strtolower ( $row2 ['txtnome'] ) ) . '</option>';
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td width="70" height="20">C�d. Barras</td>
						<td height="20"><input type="text" id="codbarra" style="width: 158px;" readonly></td>
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
		<td height="20"><b>Pre�os</b></td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td>
		<table width="100%">
			<tr>
				<td width="50%">
				<table>
					<tr>
						<td height="20">Custo</td>
						<td width="10"></td>
						<td>R$ <input type="text" id="vlcusto" onkeydown="javascript:formata_valor('vlcusto', 13, event);" style="width: 60px; text-align: right;" maxlength="12"></td>
					</tr>
					<tr>
						<td height="20">Pronta entrega</td>
						<td width="10"></td>
						<td>R$ <input type="text" id="vlpentrega" onkeydown="javascript:formata_valor('vlpentrega', 13, event);" style="width: 60px; text-align: right;" maxlength="12"></td>
					</tr>
				</table>
				</td>
				<td width="50%">
				<table>
					<tr>
						<td height="20">Atacado</td>
						<td width="10"></td>
						<td>R$ <input type="text" id="vlatacado" onkeydown="javascript:formata_valor('vlatacado', 13, event);" style="width: 60px; text-align: right;" maxlength="12"></td>
					</tr>
					<tr>
						<td height="20">Varejo</td>
						<td width="10"></td>
						<td>R$ <input type="text" id="vlvarejo" onkeydown="javascript:formata_valor('vlvarejo', 13, event);" style="width: 60px; text-align: right;" maxlength="12"></td>
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
		<td height="20"><b>Adicionais</b></td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td>
		<table width="100%">
			<tr>
				<td width="50%">
				<table>
					<tr>
						<td height="20">Qtd. em estoque
						
						
						<td>
						
						
						<td width="14"></td>
						<td height="20" style="font-size: 16px;"><input type="text" id="qtdestoque" style="width: 60px; text-align: right;" maxlength="6"></td>
					</tr>
				</table>
				</td>
				<td width="50%" align="right"><input type="button" class="botao" id="adicionarproduto" value="adicionar produto" style="cursor: pointer; cursor: hand; width: 140px; background-color: green;" onclick="javascript:carrega_adicionarproduto_salvar();"></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td height="30" align="right"><span id="msgerro"></span></td>
	</tr>
	<tr>
		<td height="20"><b>Extras</b></td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td>
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td align="left"><input type="button" class="botao" style="cursor: pointer; cursor: hand; width: 150px;" id="adicionarcategoria" value="adicionar categoria" onClick="javascript:adicionar_categoria();document.getElementById('btnvoltagrade').style.display='block';"></td>
				<td align="center"><input type="button" class="botao" style="cursor: pointer; cursor: hand; width: 150px;" id="adicionarfornecedor" value="adicionar fornecedor" onClick="javascript:adicionar_fornecedor();document.getElementById('btnvoltagrade').style.display='block';"></td>
				<td align="right"><input type="button" class="botao" style="cursor: pointer; cursor: hand; width: 150px;" id="adicionarcolecao" value="adicionar cole��o" onClick="javascript:adicionar_colecao(path+'modulos/colecao/colecao_adicionar.php');document.getElementById('btnvoltagrade').style.display='block';"></td>
			</tr>
		</table>
		</td>
	</tr>
</table>

</div>

</fieldset>