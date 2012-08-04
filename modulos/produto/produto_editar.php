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

if (isset ( $_SESSION ['gradeproduto'] ) && ! isset ( $_POST ['prod_id'] ) && ! isset ( $_SESSION ['cad_item'] ['descricao'] )) {
	unset ( $_SESSION ['gradeproduto'] );
}

$sql = "SELECT * FROM produto WHERE idproduto = " . $_GET ['id'];
$query = $db->query ( $sql );
$row = $db->fetch_assoc ( $query );
$sql = "SELECT nquantidade FROM estoque WHERE produto_idproduto = " . $_GET ['id'];
$query = $db->query ( $sql );
$row ['estoque'] = $db->fetch_assoc ( $query );
$sql = "SELECT * FROM cad_produtos_grade WHERE id_produto = " . $_GET ['id'];
$query = $db->query ( $sql );
$i = 1;
if ($db->num_rows ( $query ))
	$row ['estoque'] ['nquantidade'] = 0;
while ( $result_grade = $db->fetch_assoc ( $query ) ) {
	$row ['estoque'] ['nquantidade'] += $result_grade ['quantidade'];
	$_SESSION ['gradeproduto'] ['nome'] [$i] = $result_grade ['descricao'];
	$_SESSION ['gradeproduto'] ['qtd'] [$i] = $result_grade ['quantidade'];
	$_SESSION ['gradeproduto'] ['grade'] [$i] = $result_grade ['id'];
	$i ++;
}

?>



<fieldset id="m"><legend>Editar Produto</legend>

<div class="linha_separador" id="linha_separadoreditarproduto" style="width: 480px;">
<table width="100%">
	<tr>
		<td align="left"><input type="button" class="botao" id="btnvoltagrade" style="cursor: pointer; cursor: hand; width: 200px; display: none;" value="Voltar para grade do produto" onclick="javascript:lista_editargrade();document.getElementById('btnvoltagrade').style.display='none';"></td>
		<td align="right"><input type="button" class="botao btn_irpara" value="Ir para Listagem" id="listagemprodutos" style="cursor: pointer; cursor: hand; width: 140px;" onclick="javascript:carrega_listagemprodutos(path+'modulos/produto/lista.php','conteudo_total');"></td>
	</tr>
</table>
</div>

<input type="hidden" id="idproduto" value="<?=(isset ( $_GET ['id'] )) ? $_GET ['id'] : '';?>"> 
<input type="hidden" id="gradestatus" value="<?=(isset ( $_SESSION ['gradeproduto'] )) ? 'sim' : 'nao';?>"> 
<input type="hidden" id="qtdsemgrade" value="<?=isset ( $row ['estoque'] ['nquantidade'] ) ? $row ['estoque'] ['nquantidade'] : '0';?>">

<div id="diveditarproduto">
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
					<td height="20"><input type="text" id="produto" style="width: 160px;" maxlength="60" value="<?=ucwords(strtolower($row['txtproduto']));?>"></td>
					<td width="12"></td>
					<td>Código</td>
					<td width="35"></td>
					<td height="20"><input type="text" id="codigo" style="width: 160px;" maxlength="60" value="<?=$row['cod_interno'];?>"></td>
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
								<option value="0">Sem categoria</option>
								<?
								$sql = "SELECT idprodutotipo, txtnome FROM produtotipo ORDER BY txtnome ASC";
								$query = $db->query ( $sql );
								while ( $row2 = $db->fetch_assoc ( $query ) ) {
									?>
									<option value="<?=$row2 ['idprodutotipo']?>"
				<?=(isset ( $row ['produtotipo_idprodutotipo'] ) && ($row ['produtotipo_idprodutotipo'] == $row2 ['idprodutotipo'])) ? 'selected' : '';?>><?=ucwords ( strtolower ( $row2 ['txtnome'] ) );?></option>
								<?
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td width="70" height="20">Fornecedor</td>
						<td height="20">
							<select id="fornecedor" style="width: 160px;">
								<option value="0">Sem fornecedor</option>
								<?
								$sql = "SELECT idfornecedor, nome FROM fornecedor ORDER BY nome ASC";
								$query = $db->query ( $sql );
								while ( $row2 = $db->fetch_assoc ( $query ) ) {
									?>
									<option value="<?=$row2 ['idfornecedor']?>"
								<?=(isset ( $row ['fornecedor_idfornecedor'] ) && ($row ['fornecedor_idfornecedor'] == $row2 ['idfornecedor'])) ? 'selected' : '';?>><?=ucwords ( strtolower ( $row2 ['nome'] ) );?></option>
								<? } ?>
							</select>
						</td>
					</tr>
				</table>
				</td>
				<td width="50%">
				<table>
					<tr>
						<td width="70" height="20">Coleção</td>
						<td height="20">
							<select id="colecao" style="width: 160px;">
								<option value="0">Sem coleção</option>
								<?
								$sql = "SELECT idcolecao, txtnome FROM colecao ORDER BY txtnome ASC";
								$query = $db->query ( $sql );
								while ( $row2 = $db->fetch_assoc ( $query ) ) {
								?>
									<option value="<?=$row2 ['idcolecao']?>"
								<?=(isset ( $row ['colecao_idcolecao'] ) && ($row ['colecao_idcolecao'] == $row2 ['idcolecao'])) ? 'selected' : '';?>><?=ucwords ( strtolower ( $row2 ['txtnome'] ) );?></option>
								<? } ?>
							</select>
						</td>
					</tr>
					<tr>
						<td width="70" height="20">Cód. Barras</td>
						<td height="20"><input type="text" id="codbarra" style="width: 158px;" readonly value="<?=$row ['cod_barra'];?>"></td>
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
		<td height="20"><b>Preços</b></td>
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
						<td>R$ <input type="text" id="vlcusto" onkeydown="javascript:formata_valor('vlcusto', 13, event)" style="width: 60px; text-align: right;" maxlength="12" value="<?=isset ( $row ['vlcusto'] ) ? $row ['vlcusto'] : '';?>"></td>
					</tr>
					<tr>
						<td height="20">Pronta entrega</td>
						<td width="10"></td>
						<td>R$ <input type="text" id="vlpentrega" onkeydown="javascript:formata_valor('vlpentrega', 13, event)" style="width: 60px; text-align: right;" maxlength="12" value="<?=isset ( $row ['vlprontaentrega'] ) ? $row ['vlprontaentrega'] : '';?>"></td>
					</tr>
				</table>
				</td>
				<td width="50%">
				<table>
					<tr>
						<td height="20">Atacado</td>
						<td width="10"></td>
						<td>R$ <input type="text" id="vlatacado" onkeydown="javascript:formata_valor('vlatacado', 13, event)" style="width: 60px; text-align: right;" maxlength="12" value="<?=isset ( $row ['vlatacado'] ) ? $row ['vlatacado'] : '';?>"></td>
					</tr>
					<tr>
						<td height="20">Varejo</td>
						<td width="10"></td>
						<td>R$ <input type="text" id="vlvarejo" onkeydown="javascript:formata_valor('vlvarejo', 13, event)" style="width: 60px; text-align: right;" maxlength="12" value="<?=isset ( $row ['vlvarejo'] ) ? $row ['vlvarejo'] : '';?>"></td>
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
						<td height="20">Qtd. em estoque<td>
						<td width="14"></td>
						<td height="20" style="font-size: 16px;"><input type="text" id="qtdestoque" style="width: 60px; text-align: right;" maxlength="6" value="<?=$row ['estoque'] ['nquantidade'];?>" <?=(isset ( $_SESSION ['gradeproduto'] ) && (count ( $_SESSION ['gradeproduto'], COUNT_RECURSIVE ) / 3) > 0) ? 'readonly' : '';?>></td>
					</tr>
				</table>
				</td>
				<td width="50%" align="right"><input type="button" class="botao green btn_editargreen" id="editarproduto" value="editar produto" style="width: 135px;" onclick="javascript:carrega_editarproduto_salvar();"></td>
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
				<td align="left"><input type="button" class="botao" id="addcategoria" style="cursor: pointer; cursor: hand; width: 150px;" value="adicionar categoria" onClick="javascript:adicionar_categoria();document.getElementById('btnvoltagrade').style.display='block';"></td>
				<td align="center"><input type="button" class="botao" id="addfornecedor" style="cursor: pointer; cursor: hand; width: 150px;" value="adicionar fornecedor" onClick="javascript:adicionar_fornecedor();document.getElementById('btnvoltagrade').style.display='block';"></td>
				<td align="right"><input type="button" class="botao" id="addcolecao" style="cursor: pointer; cursor: hand; width: 150px;" value="adicionar coleção" onClick="javascript:adicionar_colecao(path+'modulos/colecao/colecao_adicionar.php');document.getElementById('btnvoltagrade').style.display='block';"></td>
			</tr>
		</table>
		</td>
	</tr>
</table>

</div>

</fieldset>