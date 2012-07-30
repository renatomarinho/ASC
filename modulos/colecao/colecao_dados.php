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

$idcolecao = $validations->validNumeric ( $_GET ['id'] );

$sql = "SELECT txtnome, txtperiodo, txtdescricao FROM colecao WHERE idcolecao=" . $idcolecao . "";
$query = $db->query ( $sql );
$rowcolecao = $db->fetch_assoc ( $query );
$txtnome = $rowcolecao ['txtnome'];
$txtperiodo = $rowcolecao ['txtperiodo'];
$txtdescricao = $rowcolecao ['txtdescricao'];

if (strlen ( $txtperiodo ) > 8) {
	$periodo_explode = explode ( ' at� ', $txtperiodo );
	$periodo_1 = explode ( '/', $periodo_explode [0] );
	$periodo_2 = explode ( '/', $periodo_explode [1] );
	if ($periodo_1 [0] < 10)
		$periodo_1 [0] = str_replace ( '0', '', $periodo_1 [0] );
	if ($periodo_2 [0] < 10)
		$periodo_2 [0] = str_replace ( '0', '', $periodo_2 [0] );
	$periodo = $meses [$periodo_1 [0]] . ' de ' . $periodo_1 [1] . ' at� ' . $meses [$periodo_2 [0]] . ' de ' . $periodo_2 [1];
} else {
	$periodo = 'indeterminado';
}

$sql = "SELECT idproduto, vlcusto, vlvarejo, vlatacado, vlprontaentrega FROM produto WHERE colecao_idcolecao=" . $idcolecao . "";
$query = $db->query ( $sql );
$total = $db->num_rows ( $query );

$lucro_vendas = 0;
$vlcusto_colecao_vendas = 0;
$vlcusto_colecao_atual = 0;
$vlvarejo_atual = 0;
$vlatacado_atual = 0;
$vlpentrega_atual = 0;
$quantidade_estoque_atual = 0;
$quantidade_estoque_vendas = 0;
$total_vlvarejo_vendas = 0;

$vlcusto_colecao_total = 0;
$totalprodutos = 0;

if ($total > 0) {
	
	$totalprodutos = ($db->num_rows ( $query ) > 0) ? $db->num_rows ( $query ) : ' nenhum produto';
	
	while ( $rowprodutos = $db->fetch_assoc ( $query ) ) {
		
		$quantidade_estoque_atual_multi = 0;
		
		$sql = "SELECT nquantidade FROM estoque WHERE produto_idproduto=" . $rowprodutos ['idproduto'] . "";
		$queryestoque = $db->query ( $sql );
		while ( $rowestoque = $db->fetch_assoc ( $queryestoque ) ) {
			$quantidade_estoque_atual += ( int ) $rowestoque ['nquantidade'];
			$vlcusto_colecao_atual += ($rowprodutos ['vlcusto'] * $rowestoque ['nquantidade']);
			$vlvarejo_atual += ($rowprodutos ['vlvarejo'] * $rowestoque ['nquantidade']);
			$vlatacado_atual += ($rowprodutos ['vlatacado'] * $rowestoque ['nquantidade']);
			$vlpentrega_atual += ($rowprodutos ['vlprontaentrega'] * $rowestoque ['nquantidade']);
		}
		
		$sql = "SELECT id, vr_custo AS valor, quant, vr_total FROM mv_vendas_movimento WHERE id_produto=" . $rowprodutos ['idproduto'] . " AND estornado=0";
		$queryvenda = $db->query ( $sql );
		
		while ( $rowvenda = $db->fetch_assoc ( $queryvenda ) ) {
			$quantidade_estoque_vendas += ( int ) $rowvenda ['quant'];
			$valor_custo_venda = $rowvenda ['valor'];
			$valor_varejo_venda = $rowvenda ['vr_total'];
			$total_vlvarejo_vendas += $valor_varejo_venda * $rowvenda ['quant'];
			$vlcusto_colecao_vendas += $valor_custo_venda * $rowvenda ['quant'];
		}
	
	}
	
	$vlcusto_colecao_total = $vlcusto_colecao_atual + $vlcusto_colecao_vendas;

}
?>

<fieldset id="m"><legend>Dados da Cole��o</legend>

<div class="linha_separador" style="width: 480px; height: 25px;">

<table width="100%">
	<tr>
		<td align="left"><input type="button" value="Ir para listagem"
			class="botao" id="irlistagem_resultado"
			style="cursor: pointer; cursor: hand; width: 140px;"
			onclick="javascript:carrega_listagemcolecoes(path+'modulos/colecao/colecao_lista.php','conteudo_direito', '-');"></td>
	</tr>
</table>

</div>

<div>

<table width="100%">
	<tr>
		<td>
		<div id="colecaodados_main"
			style="overflow: auto; height: 282px; width: 496px">

		<table width="100%" cellpadding="0" cellspacing="0">
								<?
								if ($lucro_vendas < 0) {
									$cor = ' style="color:red;font-weight:bold;" ';
									?>
								<tr>
				<td height="30" style="background-color: red; color: white"
					align="center"><b>ATEN��O : A COLE�AO EST� OPERANDO COM PREJU�ZO</b>
				</td>
			</tr>
			<tr>
				<td height="20" style="background-color: gray;" align="center"><a
					href="#" style="color: white;">Clique aqui para verificar o que
				causou este resultado</a></td>
			</tr>
								<?
								} else {
									$cor = '';
								}
								?>
								<tr>
				<td height="5"></td>
			</tr>
			<tr>
				<td>
				<table width="100%">
					<tr>
						<td height="5"></td>
					</tr>
					<tr>
						<td height="20">
						<table width="100%">
							<tr>
								<td><b>Dados da Cole��o</b></td>
								<td align="right"><input type="button"
									value="salvar dados da cole��o" class="botao" id="diveditar"
									style="cursor: pointer; cursor: hand; width: 160px; background-color: green; display: none;"
									onclick="javascript:editar_colecao_salvar('<?=$idcolecao;?>');">
								<input type="button" value="editar dados da cole��o"
									class="botao" id="btneditarcolecao"
									style="cursor: pointer; cursor: hand; width: 160px;"
									onclick="javascript:editar_colecao('<?=$idcolecao;?>');"></td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="border-bottom: 2px solid black"></td>
					</tr>
					<tr>
						<td align="center"><input type="hidden" id="idcol"
							value="<?=$idcolecao;?>">
						<table width="100%">
							<tr>
								<td>
								<table>
									<tr>
										<td height="25"><b>Nome</b></td>
										<td width="5"></td>
										<td><span id="txtnomecol"><?=ucwords ( strtolower ( $txtnome ) );?></span></td>
									</tr>
								</table>
								</td>
							</tr>
							<tr>
								<td style="border-bottom: 2px solid black"></td>
							</tr>
							<tr>
								<td>
								<table width="100%">
									<tr>
										<td height="25"><b>Per�odo</b></td>
										<td align="right">
										<div id="defineduracao" style="display: none;">
										<table>
											<tr>
												<td>dura��o indeterminada</td>
												<td width="2"></td>
												<td><input type="checkbox" id="duracaocolecao"
													onclick="javascript:var p1=document.getElementById('peridodeterminado');p1.style.display=((p1.style.display=='none')?'block':'none');var p2=document.getElementById('peridoindeterminado');p2.style.display=((p1.style.display=='none')?'block':'none')"></td>
											</tr>
										</table>
										</div>
										</td>
									</tr>
								</table>
								</td>
							</tr>
							<tr>
								<td style="border-bottom: 2px solid black"></td>
							</tr>
							<tr>
								<td height="30">
								<div id="peridodeterminado"><span id="txtperiodocol">
																		<?=$periodo;?>
																	</span></div>
								<div id="peridoindeterminado" style="display: none;"><b
									style="color: red;">Sem per�odo definido</b></div>
								</td>
							</tr>
							<tr>
								<td style="border-bottom: 2px solid black"></td>
							</tr>
							<tr>
								<td height="25"><b>Descri��o</b></td>
							</tr>
							<tr>
								<td style="border-bottom: 2px solid black"></td>
							</tr>
							<tr>
								<td height="2"></td>
							</tr>
							<tr>
								<td><span id="txtdescricol"><?=$txtdescricao;?></span></td>
							</tr>
						</table>
						</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td height="5"></td>
			</tr>
			<tr>
				<td style="border-bottom: 2px solid black"></td>
			</tr>
			<tr>
				<td height="25">
				<table width="100%">
					<tr>
						<td><b>Estat�sticas</b></td>
						<td align="right"><b>Custo</b> : R$ <?=number_format ( $vlcusto_colecao_total, 2, ',', '.' );?></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td style="border-bottom: 2px solid black"></td>
			</tr>
			<tr>
				<td>
				<div id="colecao_dadosgerais">
				<table width="100%">
					<tr>
						<td>
						<table>
							<tr>
								<td width="220" valign="top">
																	<?
																	if ($total > 0) {
																		?>
																	<table width="100%">
									<tr>
										<td height="25" colspan="2"><b>Valores estoque</b></td>
									</tr>
									<tr>
										<td colspan="2" style="border-bottom: 2px solid black"></td>
									</tr>
									<tr>
										<td height="25"><b>Qtd. ite<?=($quantidade_estoque_atual > 1) ? 'ns' : 'm'?></b></td>
										<td align="right"><?=$quantidade_estoque_atual;?> ite<?=($quantidade_estoque_atual > 1) ? 'ns' : 'm'?></td>
									</tr>
									<tr>
										<td height="25"><b>Custo</b></td>
										<td align="right">R$ <?=number_format ( $vlcusto_colecao_atual, 2, ',', '.' );?></td>
									</tr>
									<tr>
										<td height="25"><b>P. entrega</b></td>
										<td align="right">R$ <?=number_format ( $vlpentrega_atual, 2, ',', '.' );?></td>
									</tr>
									<tr>
										<td height="25"><b>Atacado</b></td>
										<td align="right">R$ <?=number_format ( $vlatacado_atual, 2, ',', '.' );?></td>
									</tr>
									<tr>
										<td height="25"><b>Varejo</b></td>
										<td align="right">R$ <?=number_format ( $vlvarejo_atual, 2, ',', '.' );?></td>
									</tr>
								</table>
																	<?
																	}
																	?>
																</td>
																<?
																if ($quantidade_estoque_vendas && $total > 0) {
																	?>
																<td width="20"></td>
								<td width="220" valign="top">
								<table width="100%">
									<tr>
										<td height="25" colspan="2"><b>Valores venda</b></td>
									</tr>
									<tr>
										<td colspan="2" style="border-bottom: 2px solid black"></td>
									</tr>
									<tr>
										<td height="25"><b>Qtd. ite<?=($quantidade_estoque_vendas > 1) ? 'ns' : 'm'?></b></td>
										<td align="right"><?=$quantidade_estoque_vendas?> ite<?=($quantidade_estoque_vendas > 1) ? 'ns' : 'm'?></td>
									</tr>
																		<?
																	if ($quantidade_estoque_vendas > 0) {
																		$lucro_vendas_real = $total_vlvarejo_vendas - $vlcusto_colecao_vendas;
																		$lucro_vendas_porcento = number_format ( ($lucro_vendas_real / $vlcusto_colecao_vendas) * 100, 2, ',', '.' );
																		$nomeclatura_lucro = 'Lucro';
																	} else {
																		$lucro_vendas_porcento = number_format ( - 1 * ((($valor_total_custo / $valor_vendas) * 100)) + 100, 2, ',', '.' );
																		$lucro_vendas = $valor_total_custo - $valor_vendas;
																		$nomeclatura_lucro = 'Preju�zo';
																	}
																	
																	?>
																		<tr>
										<td height="25"><b>Valor custo</b></td>
										<td align="right">R$ <?=number_format ( $vlcusto_colecao_vendas, 2, ',', '.' );?></td>
									</tr>
									<tr>
										<td width="120" height="25"><b>Valor total</b></td>
										<td align="right">R$ <?=number_format ( $total_vlvarejo_vendas, 2, ',', '.' );?></td>
									</tr>
									<tr>
										<td width="120" height="25"><b>Lucro</b></td>
										<td align="right">R$ <?=number_format ( $lucro_vendas_real, 2, ',', '.' );?></td>
									</tr>
									<tr>
										<td height="25"><b>Lucro</b></td>
										<td align="right"><?=number_format ( $lucro_vendas_porcento, 2, ',', '.' );?> %</td>
									</tr>
								</table>
								</td>
																<?
																}
																?>
															</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="border-bottom: 2px solid black">
						<div id="colecao_pontoprodutos"></div>
						</td>
					</tr>
					<tr>
						<td height="25">
						<table width="100%">
							<tr>
								<td><b>Produtos</b></td>
								<td align="right"><b><?=$totalprodutos;?></b> produto<?=($totalprodutos > 1) ? 's' : ''?> vinculado<?=($totalprodutos > 1) ? 's' : ''?></td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="border-bottom: 2px solid black"></td>
					</tr>
					<tr>
						<td colspan="2">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tr bgcolor="#f0f0f0">
								<td width="10" height="25"></td>
								<td width="140"><b>Nome</b></td>
								<td width="30" align="center"><b>Qtd</b></td>
								<td width="70" align="right"><b>Custo</b></td>
								<td width="70" align="right"><b>P. entrega</b></td>
								<td width="70" align="right"><b>Atacado</b></td>
								<td width="70" align="right"><b>Varejo</b></td>
								<td width="10"></td>
							</tr>
							<tr>
								<td colspan="8" style="border-bottom: 1px solid #c0c0c0;"></td>
							</tr>
							<tr>
								<td colspan="8">
									<span id="colecao_listadeprodutos">
										<?
										$sql = "SELECT e.nquantidade, p.idproduto, p.txtproduto, p.vlcusto, p.vlvarejo, p.vlatacado, p.vlprontaentrega FROM produto AS p INNER JOIN estoque AS e ON e.produto_idproduto=p.idproduto WHERE p.colecao_idcolecao=" . $idcolecao . "";
										$query = $db->query ( $sql );
										$quant = 0;
										while ( $produtos_colecao = $db->fetch_assoc ( $query ) ) {
										?>
										<table width="100%" cellpadding="0" cellspacing="0">
											<tr onmouseover="rowOver(this)" onmouseout="rowOut(this)" style="cursor: pointer; cursor: hand;" onClick="javascript:listasimples_historicoproduto('?exibe=btncolecao&id=<?=$produtos_colecao ['idproduto'];?>','colecao');">
												<td width="10" height="25"></td>
												<td width="145"><?=qtdCaracteres(ucwords(strtolower($produtos_colecao ['txtproduto'])),25);?></td>
												<td width="30" align="center"><?=( int ) $produtos_colecao ['nquantidade'];?></td>
												<td width="70" align="right"><?=number_format ( $produtos_colecao ['vlcusto'], 2, ',', '.' );?></td>
												<td width="70" align="right"><?=number_format ( $produtos_colecao ['vlprontaentrega'], 2, ',', '.' );?></td>
												<td width="70" align="right"><?=number_format ( $produtos_colecao ['vlatacado'], 2, ',', '.' );?></td>
												<td width="70" align="right"><?=number_format ( $produtos_colecao ['vlvarejo'], 2, ',', '.' );?></td>
												<td width="10"></td>
											</tr>
											<tr>
												<td colspan="8" style="border-bottom: 1px solid #c0c0c0;"></td>
											</tr>
										</table>
										<? } ?>
									</span>
								</td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="border-bottom: 2px solid black"></td>
					</tr>
					<tr>
						<td height="25"><b>Fornecedores</b></td>
					</tr>
					<tr>
						<td colspan="2" style="border-bottom: 2px solid black"></td>
					</tr>
					<tr>
						<td colspan="2">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tr bgcolor="#f0f0f0">
								<td width="10" height="25"></td>
								<td><b>Nome</b></td>
								<td align="right"><b>Telefone</b></td>
								<td width="10"></td>
							</tr>
							<tr>
								<td colspan="4" style="border-bottom: 1px solid #c0c0c0;"></td>
							</tr>
							<tr>
								<td colspan="4"><span id="colecao_listadefornecedores">
																	<?
																	$sql = "SELECT distinct(f.idfornecedor), f.nome, f.telefone FROM produto AS p INNER JOIN fornecedor AS f ON f.idfornecedor=p.fornecedor_idfornecedor WHERE p.colecao_idcolecao=" . $idcolecao . "";
																	$query = $db->query ( $sql );
																	$quant = 0;
																	while ( $produtos_fornecedor = $db->fetch_assoc ( $query ) ) {
																		$produtos_fornecedor ['txttelefone'] = (strlen ( $produtos_fornecedor ['telefone'] )) ? str_pad ( str_replace ( '-', '', $produtos_fornecedor ['telefone'] ), 10, '0', STR_PAD_LEFT ) : '';
																		$dddtel = substr ( $produtos_fornecedor ['telefone'], 0, 2 );
																		$tel1 = substr ( $produtos_fornecedor ['telefone'], 2, 4 );
																		$tel2 = substr ( $produtos_fornecedor ['telefone'], 6, 4 );
																		?>
																	<table width="100%" cellpadding="0" cellspacing="0">
									<tr onmouseover="rowOver(this)" onmouseout="rowOut(this)"
										style="cursor: pointer; cursor: hand;"
										onClick="javascript:listasimples_historicfornecedor('<?=$produtos_fornecedor ['idfornecedor'];?>');">
										<td width="10" height="25"><input type="hidden"
											id="fornec_<?=$produtos_fornecedor ['idfornecedor'];?>"></td>
										<td><?=ucwords ( strtolower ( $produtos_fornecedor ['nome'] ) );?></td>
										<td align="right">( <?=$dddtel;?> ) <?=$tel1;?>-<?=$tel2;?></td>
										<td width="10"></td>
									</tr>
									<tr>
										<td colspan="4" style="border-bottom: 1px solid #c0c0c0;"></td>
									</tr>
								</table>
																	<?
																	}
																	?>
																	</span></td>
							</tr>
						</table>
						</td>
					</tr>
				</table>
				</div>
				</td>
			</tr>
		</table>
		</div>
		</td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td align="center">
		<table width="100%">
			<tr>
				<td align="left"><input type="button" id="btnvincularproduto"
					value="vincular um produto existente" class="botao"
					style="cursor: pointer; cursor: hand; width: 200px; background-color: green;"
					onclick="javascript:carrega_vincularproduto('<?=$idcolecao;?>');"></td>
				<td align="right"><input type="button"
					value="adicionar um novo produto" class="botao"
					style="cursor: pointer; cursor: hand; width: 200px; background-color: green;"
					onclick="javascript:carrega_adicionarproduto('modulos/produto/produto_cadastrar.php?col=<?=$idcolecao;?>', '<?=date ( 'simyhd' );?>');"></td>
			</tr>
		</table>
		</td>
	</tr>
</table>

</div>

</fieldset>
