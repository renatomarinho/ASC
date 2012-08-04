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

$idfornecedor = $validations->validNumeric ( $_GET ['id'] );

$sql = "SELECT f.nome, f.cnpj, f.uf, f.cidade, f.endereco, f.contato, f.email, f.telefone, f.telefone2, f.fax, f.ie, f.cep, f.bairro, f.idpais, p.nome AS nomepais FROM fornecedor AS f INNER JOIN paises AS p ON f.idpais=p.numcode WHERE f.idfornecedor=" . $idfornecedor . "";
$query = $db->query ( $sql );
$rowfornecedor = $db->fetch_assoc ( $query );

$nome = $rowfornecedor ['nome'];
$cnpj = ($rowfornecedor ['cnpj']) ? $rowfornecedor ['cnpj'] : 'Não informado';
$uf = ($rowfornecedor ['uf']) ? $rowfornecedor ['uf'] : 'Não informado';
if ($uf == 'OU') {
	$uf = 'Exterior';
}

$cidade = ($rowfornecedor ['cidade']) ? $rowfornecedor ['cidade'] : 'Não informado';
$endereco = ($rowfornecedor ['endereco']) ? $rowfornecedor ['endereco'] : 'Não informado';
$contato = ($rowfornecedor ['contato']) ? $rowfornecedor ['contato'] : 'Não informado';
$email = ($rowfornecedor ['email']) ? strtolower ( $rowfornecedor ['email'] ) : 'Não informado';
$telefone = $rowfornecedor ['telefone'];
if (strlen ( $telefone ) > 6) {
	$telefone = (strlen ( $telefone )) ? str_pad ( str_replace ( '-', '', $telefone ), 10, '0', STR_PAD_LEFT ) : '';
	$dddtel = substr ( $telefone, 0, 2 );
	$tel1 = substr ( $telefone, 2, 4 );
	$tel2 = substr ( $telefone, 6, 4 );
} else {
	$telefone = 'Não informado';
}

$telefone2 = $rowfornecedor ['telefone2'];
if (strlen ( $telefone2 ) > 6) {
	$telefone2 = (strlen ( $telefone2 )) ? str_pad ( str_replace ( '-', '', $telefone2 ), 10, '0', STR_PAD_LEFT ) : '';
	$dddtel_2 = substr ( $telefone2, 0, 2 );
	$tel1_2 = substr ( $telefone2, 2, 4 );
	$tel2_2 = substr ( $telefone2, 6, 4 );
} else {
	$telefone2 = 'Não informado';
}

$fax = ($rowfornecedor ['fax']) ? $rowfornecedor ['fax'] : 'Não informado';
$ie = ($rowfornecedor ['ie']) ? $rowfornecedor ['ie'] : 'Não informado';
$cep = $rowfornecedor ['cep'];
if (strlen ( $cep ) > 4) {
	$txtcep = (strlen ( $cep )) ? str_pad ( str_replace ( '-', '', $cep ), 8, '0', STR_PAD_LEFT ) : '';
	$cep1 = substr ( $txtcep, 0, 5 );
	$cep2 = substr ( $txtcep, 5, 3 );
} else {
	$cep = 'Não informado';
}

$bairro = ($rowfornecedor ['bairro']) ? $rowfornecedor ['bairro'] : 'Não informado';
$idpais = ($rowfornecedor ['idpais']) ? $rowfornecedor ['idpais'] : 'Não informado';
$nomepais = ($rowfornecedor ['nomepais']) ? $rowfornecedor ['nomepais'] : 'Não informado';

$sql = "SELECT idproduto, vlcusto, vlvarejo, vlatacado, vlprontaentrega FROM produto WHERE fornecedor_idfornecedor=" . $idfornecedor . "";
$query = $db->query ( $sql );
$total = $db->num_rows ( $query );

$lucro_vendas = 0;
$vlcusto_fornecedor_vendas = 0;
$vlcusto_fornecedor_atual = 0;
$vlvarejo_atual = 0;
$vlatacado_atual = 0;
$vlpentrega_atual = 0;
$quantidade_estoque_atual = 0;
$quantidade_estoque_vendas = 0;
$total_vlvarejo_vendas = 0;
if ($total > 0) {
	
	$totalprodutos = ($db->num_rows ( $query ) > 0) ? $db->num_rows ( $query ) : ' nenhum produto';
	
	while ( $rowprodutos = $db->fetch_assoc ( $query ) ) {
		
		$quantidade_estoque_atual_multi = 0;
		
		$sql = "SELECT nquantidade FROM estoque WHERE produto_idproduto=" . $rowprodutos ['idproduto'] . "";
		$queryestoque = $db->query ( $sql );
		while ( $rowestoque = $db->fetch_assoc ( $queryestoque ) ) {
			$quantidade_estoque_atual += ( int ) $rowestoque ['nquantidade'];
			$vlcusto_fornecedor_atual += ($rowprodutos ['vlcusto'] * $rowestoque ['nquantidade']);
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
			$vlcusto_fornecedor_vendas += $valor_custo_venda * $rowvenda ['quant'];
		}
	
	}
	
	$vlcusto_fornecedor_total = $vlcusto_fornecedor_atual + $vlcusto_fornecedor_vendas;

}
?>

<fieldset id="p"><legend>Histórico do Fornecedor</legend>

<div class="linha_separador" style="width: 360px; height: 25px;">

<table width="100%">
	<tr>
		<td align="right"><input type="button"
			value="Ir para listagem coleções" class="botao"
			id="irlistagem_resultado"
			style="cursor: pointer; cursor: hand; width: 180px;"
			onclick="javascript:carrega_listagemcolecoes(path+'modulos/colecao/colecao_lista.php','conteudo_direito', '-');"></td>
	</tr>
</table>

</div>

<div>

<table width="100%">
	<tr>
		<td>
		<div id="colecaodados_main"
			style="overflow: auto; height: 340px; width: 380px">

		<table width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td>
				<div id="colecao_dadosgerais">
				<table width="100%">
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
								<td height="20"><b>Dados do fornecedor</b></td>
							</tr>
							<tr>
								<td style="border-bottom: 2px solid black"></td>
							</tr>
							<tr>
								<td><input type="hidden" id="idfornecedor"
									value="<?=$idfornecedor;?>"> <input type="hidden" id="idpais"
									value="<?=$idpais;?>">
								<table width="100%">
									<tr>
										<td>
										<table width="100%">
											<tr>
												<td width="65" height="20">Nome</td>
												<td><span id="txtnome"><?=ucwords ( strtolower ( $nome ) );?></span></td>
											</tr>
											<tr>
												<td height="20">Contato</td>
												<td><span id="txtcontato"><?=ucwords ( strtolower ( $contato ) );?></span></td>
											</tr>
											<tr>
												<td height="20">E-mail</td>
												<td><span id="txtemail"><?=$email;?></span></td>
											</tr>
											<tr>
												<td colspan="2">
												<table width="100%" cellpadding="0" cellspacing="0"
													border="0">
													<tr>
														<td height="20" width="60">Telefone</td>
														<td>(<span id="dddtel1"><?=$dddtel;?></span>) <span
															id="tel1"><?=$tel1;?></span> - <span id="tel2"><?=$tel2;?></span></td>
														<td width="25"></td>
														<td align="right">
														<table width="100%" cellpadding="0" cellspacing="0"
															border="0">
															<tr>
																<td height="20" width="40">Fax</td>
																<td align="left">
																												<?
																												if (is_string ( $telefone2 )) {
																													?>
																												<?=$telefone2;?>
																												<?
																												} else {
																													?>
																												(<span id="dddtel1_2"><?=$dddtel_2;?></span>)
																<span id="tel1_2"><?=$tel1_2;?></span> - <span
																	id="tel2_2"><?=$tel2_2;?></span>
																												<?
																												}
																												?>
																												</td>
															</tr>
														</table>
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
										<td height="20"><b>Dados da Empresa</b></td>
									</tr>
									<tr>
										<td style="border-bottom: 2px solid black"></td>
									</tr>
									<tr>
										<td>
										<table width="100%">
											<tr>
												<td height="20" width="66">CNPJ/CFP</td>
												<td width="120"><span id="cpf"><?=$cnpj;?></span></td>
												<td width="10"></td>
												<td height="20" width="85">Insc. Estadual</td>
												<td align="left"><span id="idenest"><?=$ie;?></span></td>
											</tr>
										</table>
										</td>
									</tr>
									<tr>
										<td style="border-bottom: 2px solid black"></td>
									</tr>
									<tr>
										<td height="20"><b>Dados Gerais</b></td>
									</tr>
									<tr>
										<td style="border-bottom: 2px solid black"></td>
									</tr>
									<tr>
										<td height="5"></td>
									</tr>
									<tr>
										<td>
										<table width="100%">
											<tr>
												<td width="70" height="20">
												<table cellpadding="0" cellspacing="0" border="0">
													<tr>
														<td height="20" width="66">Endereço</td>
														<td width="160"><span id="endereco"><?=ucwords ( strtolower ( $endereco ) );?></span></td>
														<td width="10"></td>
														<td height="20" width="50">Bairro</td>
														<td align="left"><span id="bairro"><?=ucwords ( strtolower ( $bairro ) );?></span></td>
													</tr>
													<tr>
														<td height="20" width="66">Cidade</td>
														<td width="160"><span id="cidade"><?=ucwords ( strtolower ( $cidade ) );?></span></td>
														<td width="10"></td>
														<td height="20" width="50">Estado</td>
														<td align="left"><span id="estado"><?=$uf;?></span></td>
													</tr>
													<tr>
														<td height="20" width="66">CEP</td>
														<td width="160">
																										<?
																										if (isset ( $cep1 ) && is_numeric ( $cep1 )) {
																											?>
																											<span id="cep"><?=$cep1;?> - <?=$cep2;?></span>
																										<?
																										} else {
																											?>
																											<span id="cep">Não informado</span>
																										<?
																										}
																										?>
																									</td>
														<td width="10"></td>
														<td height="20" width="50">País</td>
														<td align="left"><span id="pais"><?=$nomepais;?></span></td>
													</tr>
												</table>
												</td>
											</tr>
										</table>
										</td>
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
								<td><b>Estatísticas</b></td>
								<td align="right"><b>Custo</b> : R$ <?=number_format ( $vlcusto_fornecedor_total, 2 );?></td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td style="border-bottom: 2px solid black"></td>
					</tr>
					<tr>
						<td>
						<table>
							<tr>
								<td colspan="3" height="25" align="center">O fornecedor possui <b><?=$totalprodutos;?></b> produto<?=($totalprodutos > 1) ? 's' : ''?> vinculado<?=($totalprodutos > 1) ? 's' : ''?>
								
								
								<td>
							
							</tr>
							<tr>
								<td width="220" valign="top" valign="top">
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
										<td align="right">R$ <?=number_format ( $vlcusto_fornecedor_atual, 2 );?></td>
									</tr>
									<tr>
										<td height="25"><b>P. entrega</b></td>
										<td align="right">R$ <?=number_format ( $vlpentrega_atual, 2 );?></td>
									</tr>
									<tr>
										<td height="25"><b>Atacado</b></td>
										<td align="right">R$ <?=number_format ( $vlatacado_atual, 2 );?></td>
									</tr>
									<tr>
										<td height="25"><b>Varejo</b></td>
										<td align="right">R$ <?=number_format ( $vlvarejo_atual, 2 );?></td>
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
								<td width="50%" valign="top">
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
																		$lucro_vendas_real = $total_vlvarejo_vendas - $vlcusto_fornecedor_vendas;
																		$lucro_vendas_porcento = number_format ( ($lucro_vendas_real / $vlcusto_fornecedor_vendas) * 100, 2 );
																		$nomeclatura_lucro = 'Lucro';
																	} else {
																		$lucro_vendas_porcento = number_format ( - 1 * ((($valor_total_custo / $valor_vendas) * 100)) + 100, 2 );
																		$lucro_vendas = $valor_total_custo - $valor_vendas;
																		$nomeclatura_lucro = 'Prejuízo';
																	}
																	
																	?>
																		<tr>
										<td height="25"><b>Valor custo</b></td>
										<td align="right">R$ <?=number_format ( $vlcusto_fornecedor_vendas, 2 );?></td>
									</tr>
									<tr>
										<td height="25"><b>Valor venda<?=($quantidade_estoque_vendas > 1) ? 's' : ''?></b></td>
										<td align="right">R$ <?=number_format ( $total_vlvarejo_vendas, 2 );?></td>
									</tr>
									<tr>
										<td height="25"><b>Lucro</b></td>
										<td align="right">R$ <?=number_format ( $lucro_vendas_real, 2 );?></td>
									</tr>
									<tr>
										<td height="25"><b>Lucro</b></td>
										<td align="right"><?=$lucro_vendas_porcento;?> %</td>
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
				</table>
				</div>
				</td>
			</tr>
		</table>
		</div>
		</td>
	</tr>
</table>

</div>

</fieldset>
