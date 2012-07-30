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

$idproduto = $validations->validNumeric ( $_GET ['p'] );

$sql = 'SELECT p.idproduto, p.txtproduto, p.vlvarejo, p.vlatacado, p.vlprontaentrega, c.txtnome AS colecao, pt.txtnome AS tipo, f.nome AS fornecedor FROM produto AS p LEFT JOIN fornecedor AS f ON f.idfornecedor=p.fornecedor_idfornecedor LEFT JOIN produtotipo AS pt ON pt.idprodutotipo=p.produtotipo_idprodutotipo LEFT JOIN colecao AS c ON c.idcolecao=p.colecao_idcolecao WHERE idproduto=' . $idproduto;
$query = $db->query ( $sql );
$row = $db->fetch_assoc ( $query );

if ($row ['colecao']) {
	$colecao = $row ['colecao'];
} else {
	$colecao = 'N�o atribu�da';
}

if ($row ['fornecedor']) {
	$fornecedor = $row ['fornecedor'];
} else {
	$fornecedor = 'N�o atribu�do';
}

if ($row ['tipo']) {
	$categoria = $row ['tipo'];
} else {
	$categoria = 'N�o atribu�da';
}

$opc = $_GET ['opc'];

if ($opc == 'varejo') {
	$valor = $row ['vlvarejo'];
} else if ($opc == 'atacado') {
	$valor = $row ['vlatacado'];
} else if ($opc == 'pentrega') {
	$valor = $row ['vlprontaentrega'];
}

?>


<table width="100%">
	<tr>
		<td colspan="2" height="30">
		<div id="acaoprodutoselecionado" style="display: none;">
		<table>
			<tr>
				<td><input type="button" value="adicionar" class="botao green btn_adicionargreen" id="adicionarproduto" style="width: 100px;" onclick="javascript:produto_adicionarcarrinho('<?=$row ['idproduto'];?>');carrega_carrinhoatualizatotal();"></td>
				<td width="5"></td>
				<td>
					<? if($_SESSION['tipovenda']=='normal'){?>
					<input type="button" value="opcional" class="botao btn_diminuir" style="width: 100px;" onclick="javascript:produto_abriropcional();">
					<? } ?>
				</td>
			</tr>
		</table>
		</div>
		</td>
	</tr>
	<tr>
		<td valign="top">
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td colspan="3" class="l3"></td>
			</tr>
			<tr>
				<td colspan="3" valign="top">
				<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td width="40"><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/produto_32.png" class="t32"></td>
						<td height="40">
						<h1><?=ucwords ( strtolower ( $row ['txtproduto'] ) );?></h1>
						</td>
						<td width="10"></td>
						<td width="140" align="right">
						<table width="140">
							<tr>
								<td align="right" style="font-size: 14px; font-weight: bold; color: blue;"><?=($_SESSION['tipovenda']=='normal')?'R$':'';?></td>
								<td width="85" align="right"><input type="text" id="precoprodutoselecionadototal" readonly style="display:<?=($_SESSION['tipovenda']=='normal')?'block':'none';?>;width: 80px; font-size: 16px; font-weight: bold; color: blue; text-align: right; border: none; background-color: #FFFFFF;" value="0.00"></td>
							</tr>
						</table>
						</td>
						<td width="10"></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td colspan="3" class="l3"></td>
			</tr>
			<tr>
				<td valign="top">
				<table width="100%" cellpadding="0" cellspacing="0">
							<?
							$sql = "SELECT id, descricao, quantidade, vlprodgrade FROM `cad_produtos_grade` WHERE id_produto = " . $idproduto;
							$query = $db->query ( $sql );
							if ($db->num_rows ( $query )) {
								?>
							<tr>
						<td>
						<div id="gradeproduto" style="overflow: auto; width: 500px; height: 160px;">
						<table width="100%">
											<?
								$i = 0;
								while ( $res = mysql_fetch_assoc ( $query ) ) {
									?>
											<tr>
								<td width="5" height="25"></td>
								<td><B><?=ucwords ( strtolower ( $res ['descricao'] ) );?></B></td>
								<td width="10"></td>
												<?
									$valorgrade = $res ['vlprodgrade'];
									if ($valorgrade == '0.00') {
										$valorprodgrade = number_format ( $valor, 2 );
									} else {
										$valorprodgrade = number_format ( $valorgrade, 2 );
									}
									
									if ($_SESSION['tipovenda']=='normal'){
									?>
								<td>R$ <?=$valorprodgrade;?></td>
									<?
									}
									$quantidade = ( int ) $res ['quantidade'];
									
									if ($quantidade > 100) {
										$quantidade = 100;
										$qtdmaior = true;
									} else
										$qtdmaior = false;
									
									if (isset ( $_SESSION ['carrinho_venda'] )) {
										$lista_carrinho = array ();
										$lista_carrinho = $_SESSION ['carrinho_venda'];
										if (isset ( $lista_carrinho ['grade_qtd'] [$idproduto] [$res ['id']] ) && $lista_carrinho ['grade_qtd'] [$idproduto] [$res ['id']] > 0) {
											$quantidade -= $lista_carrinho ['grade_qtd'] [$idproduto] [$res ['id']];
										}
									}
									
									if ($quantidade > 0) {
										?>
												<td width="1">
								<table>
									<tr>
										<td><select
											onchange="javascript:atualiza_quantidadeprodutos();">
											<option value="0">&nbsp;quantidade&nbsp;&nbsp;</option>
																	<?
										for($i = 1; $i <= $quantidade; $i ++) {
											?>
																	<option
												value="<?=$i;?>|<?=$valorprodgrade;?>|<?=$res ['id'];?>">&nbsp;&nbsp;<?=$i;?>&nbsp;&nbsp;<?=($i < 10) ? '&nbsp;&nbsp;' : '';?>ite<?=($i == 1) ? 'm' : 'ns';?></option>
																	<?
										}
										?>
																</select></td>
															<? // if ($qtdmaior) {										?>
															<!-- <td> ou </td> -->
															<? // } 										?>
														</tr>
								</table>
								</td>
												<?
									} else {
										?>
												<td align="right"><b style="color: red;">Sem estoque</b></td>
												<?
									}
									?>
												<td width="5" height="25"></td>
							</tr>
							<?
								}
								?>
										</table>
						</div>
						</td>
					</tr>
							<?
							
							} else {
								
								$sql = "SELECT nquantidade FROM estoque WHERE produto_idproduto=" . $idproduto . "";
								$queryquantidade = $db->query ( $sql );
								$rowquantidade = $db->fetch_assoc ( $queryquantidade );
								$quantidade = $rowquantidade ['nquantidade'];
								if (isset ( $_SESSION ['carrinho_venda'] )) {
									$lista_carrinho = array ();
									$lista_carrinho = $_SESSION ['carrinho_venda'];
									if (isset ( $lista_carrinho ['produto_quantidadetotal'] [$idproduto] ) && $lista_carrinho ['produto_quantidadetotal'] [$idproduto] > 0) {
										$quantidade -= $lista_carrinho ['produto_quantidadetotal'] [$idproduto];
									}
								}
								?>
							<tr>
						<td height="60" align="center">
						<table width="100%">
							<tr>
								<td width="15"></td>
								<? if ($_SESSION['tipovenda'] == 'normal') { ?>
								<td>
								<h1>R$ <?=$valor;?></h1>
								</td>
								<? } ?>
								<td width="15"></td>
											<?
								if ($quantidade > 0) {
									?>
								<td align="right"><select id="qtdprodutounico" onchange="javascript:atualiza_quantidadeprodutos();">
									<option value="0">&nbsp;quantidade&nbsp;&nbsp;</option>
													<?
									for($i = 1; $i <= $quantidade; $i ++) {
										?>
													<option value="<?=$i;?>|<?=$valor;?>|0">&nbsp;&nbsp;<?=$i;?>&nbsp;&nbsp;<?=($i < 10) ? '&nbsp;&nbsp;' : '';?>ite<?=($i == 1) ? 'm' : 'ns';?></option>
													<?
									}
									?>
												</select></td>
												<?
								} else {
									?>
											<td align="right"><b style="color: red;">Sem estoque</b></td>
												<?
								}
								?>
											<td width="15"></td>
							</tr>
						</table>
						</td>
					</tr>
							<?
							}
							?>
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
		<td>
		<table width="100%">
			<tr>
				<td width="5"></td>
				<td height="35"><span id="totalitens"></span></td>
				<td align="right">
				<div id="produtoopcional"></div>
				</td>
				<td width="5"></td>
			</tr>
		</table>
		</td>
	</tr>
</table>