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

$_GET ['id'] = $validations->validNumeric ( $_GET ['id'] );

$sql = "SELECT * FROM produto WHERE idproduto = " . $_GET ['id'];
$query = $db->query ( $sql );
$row = $db->fetch_assoc ( $query );
$sql = "SELECT nquantidade FROM estoque WHERE produto_idproduto = " . $_GET ['id'];
$query = $db->query ( $sql );
$rowestoque = $db->fetch_assoc ( $query );
$quantidade = $rowestoque ['nquantidade'];

?>

<fieldset id="m"><legend>Dados do Produto</legend>

<div class="linha_separador ls_conf_M">
<table width="100%">
	<tr>
		<td width="25%" align="center"><input type="button" class="botao btn_stats" value="histórico vendas" onClick="javascript:listasimples_historicoproduto('?id=<?=$_GET ['id'];?>','-');" /></td>
		<td width="25%" align="center"><input type="button" class="botao btn_stats" value="histórico clientes" onClick="javascript:listasimples_historicocliente('?id=<?=$_GET ['id'];?>');" /></td>
		<td width="25%" align="center"><input type="button" class="botao btn_irpara" value="Ir para Listagem" onClick="javascript:carrega_listagemprodutos(path+'modulos/produto/lista.php','conteudo_total');" /></td>
	</tr>
</table>
</div>

<div>
		<?
		$sql = "SELECT * FROM cad_produtos_grade WHERE id_produto = " . $_GET ['id'];
		$querygrade = $db->query ( $sql );
		?>
		<input type="hidden" name="prod_id"
	value="<?=(isset ( $_GET ['id'] )) ? $_GET ['id'] : '';?>">
<table width="100%">
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td>
		<table cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td width="40"><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/produto_32.png" class="t32" /></td>
				<td><b style="font-size: 16px;">&nbsp;&nbsp;<?=$row['cod_interno'].' - '.ucwords(strtolower($row['txtproduto']));?></b></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td class="l1"></td>
	</tr>
	<tr>
		<td>
		<div id="produto_dadosgerais">
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td>
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td width="50%">
						<table>
							<tr>
								<td width="70" height="25" align="left"><b>Categoria</b></td>
								<td align="left">
									<?
									$sql = "SELECT idprodutotipo, txtnome FROM produtotipo WHERE idprodutotipo=" . $row ['produtotipo_idprodutotipo'] . "";
									$query = $db->query ( $sql );
									$row2 = $db->fetch_assoc ( $query );
									?>
									<?=($row ['produtotipo_idprodutotipo'] == 0) ? 'Não informada' : ucwords ( strtolower ( $row2 ['txtnome'] ) );?>
								</td>
							</tr>
							<tr>
								<td width="70" height="25" align="left"><b>Fornecedor</b></td>
								<td align="left">
									<?
									$sql = "SELECT nome FROM fornecedor WHERE idfornecedor=" . $row ['fornecedor_idfornecedor'] . "";
									$query = $db->query ( $sql );
									$row2 = $db->fetch_assoc ( $query );
									?>
									<?=($row ['fornecedor_idfornecedor'] == 0) ? 'Não informado' : ucwords ( strtolower ( $row2 ['nome'] ) );?>
								</td>
							</tr>
						</table>
						</td>
						<td width="50%">
						<table>
							<tr>
								<td width="70" height="25" align="left"><b>Coleção</b></td>
								<td align="left">
									<?
									$sql = "SELECT idcolecao, txtnome, txtperiodo FROM colecao WHERE idcolecao=" . $row ['colecao_idcolecao'] . "";
									$query = $db->query ( $sql );
									$row2 = $db->fetch_assoc ( $query );
									?>
									<?=($row ['colecao_idcolecao'] == 0) ? 'Não informada' : ucwords ( strtolower ( $row2 ['txtnome'] ) );?>
								</td>
							</tr>
							<tr>
								<td width="70" height="25" align="left"><b>Cód. Barras</b></td>
								<td align="left"><?=$row ['cod_barra'];?></td>
							</tr>
						</table>
						</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td class="l3"></td>
			</tr>
			<tr>
				<td height="25">&nbsp&nbsp<b>Preços</b></td>
			</tr>
			<tr>
				<td class="l3"></td>
			</tr>
			<tr>
				<td>
				<table width="100%">
					<tr>
						<td width="50%">
						<table>
							<tr>
								<td height="25"><b>Custo</b></td>
								<td width="10"></td>
								<td>R$ <?=number_format ( $row ['vlcusto'], 2, '.', ',' );?></td>
							</tr>
							<tr>
								<td height="25"><b>Pronta entrega</b></td>
								<td width="10"></td>
								<td>R$ <?=number_format ( $row ['vlprontaentrega'], 2, '.', ',' );?></td>
							</tr>
						</table>
						</td>
						<td width="50%">
						<table>
							<tr>
								<td height="25"><b>Atacado</b></td>
								<td width="10"></td>
								<td>R$ <?=number_format ( $row ['vlatacado'], 2, '.', ',' );?></td>
							</tr>
							<tr>
								<td height="25"><b>Varejo</b></td>
								<td width="10"></td>
								<td>R$ <?=number_format ( $row ['vlvarejo'], 2, '.', ',' );?></td>
							</tr>
						</table>
						</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td class="l3"></td>
			</tr>
			<tr>
				<td height="28"></td>
			</tr>
		</table>
		</div>
		</td>
	</tr>
	<tr>
		<td height="25">&nbsp&nbsp<b>Estoque</b></td>
	</tr>
	<tr>
		<td class="l3"></td>
	</tr>
	<tr>
		<td>
		<table width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td height="30" style="font-size: 16px;"><b style="color:<?=($quantidade > 0) ? 'green' : 'red';?>;"><?=$quantidade;?></b> ite<?=($quantidade > 0) ? 'ns' : 'm';?> em estoque</td>
				<td align="right">
					<?
					if ($db->fetch_assoc ( $querygrade )) {
						?>
						<input type="button" class="botao btn_grade" value="abrir grade" id="abrir_grade" style="width: 130px;" onclick="javascript:var pd=document.getElementById('produto_dadosgerais'),pg=document.getElementById('produto_grade');pd.style.display='none';pg.style.display='block';modificar_tamanho('produto_dadosgerais', 0, 'produto_grade', 172, 'fechar_grade', 'abrir_grade');" />
						<input type="button" class="botao btn_grade" value="fechar grade" id="fechar_grade" style="display: none; width: 130px;" onclick="javascript:var pd=document.getElementById('produto_dadosgerais'),pg=document.getElementById('produto_grade');pd.style.display='block';pg.style.display='none';modificar_tamanho('produto_grade', 0, 'produto_dadosgerais', 172, 'abrir_grade', 'fechar_grade');" />
					<?
					}
					?>
				</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>
		<div id="produto_grade" style="display: none;">
		<table width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td class="l3"></td>
			</tr>
			<tr>
				<td height="30">&nbsp&nbsp<b>Grade do produto</b></td>
			</tr>
			<tr>
				<td class="l3"></td>
			</tr>
			<tr>
				<td align="center">
				<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td>
						<div style="overflow: auto; height: 128px; width: 497px">
						<table width="100%" cellpadding="0" cellspacing="0">
							<?
							$sql = "SELECT * FROM cad_produtos_grade WHERE id_produto = " . $_GET ['id'] . " ORDER BY descricao ASC";
							$query = $db->query ( $sql );
							if ($db->num_rows ( $query ))
								while ( $result_grade = $db->fetch_assoc ( $query ) ) {
							?>
							<tr onmouseover="rowOver(this)" onmouseout="rowOut(this)">
								<td width="5" height="25"></td>
								<td width="275"><?=ucwords ( strtolower ( $result_grade ['descricao'] ) );?></td>
								<td width="100" align="center"><?=($result_grade ['vlprodgrade']) ? $result_grade ['vlprodgrade'] : '';?></td>
								<td width="80" align="center"><?=( int ) $result_grade ['quantidade']?></td>
							</tr>
							<tr>
								<td colspan="4" style="border-bottom: 1px solid #c0c0c0;"></td>
							</tr>
							<? } ?>
						</table>
						</div>
						</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td class="l3"></td>
			</tr>
		</table>
		</div>
		</td>
	</tr>
	<tr>
		<td align="right"><input type="button" class="botao green btn_editargreen" value="editar produto" style="width: 130px;" onclick="javascript:carrega_editarproduto('?refer=listagem&id=<?=$_GET ['id'];?>');" /></td>
	</tr>
</table>

</div>

</fieldset>