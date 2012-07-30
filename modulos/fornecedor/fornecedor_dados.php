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
$cnpj = ($rowfornecedor ['cnpj']) ? $rowfornecedor ['cnpj'] : 'N�o informado';
$uf = ($rowfornecedor ['uf']) ? $rowfornecedor ['uf'] : 'N�o informado';
if ($uf == 'OU') {
	$uf = 'Exterior';
}

$cidade = ($rowfornecedor ['cidade']) ? $rowfornecedor ['cidade'] : 'N�o informado';
$endereco = ($rowfornecedor ['endereco']) ? $rowfornecedor ['endereco'] : 'N�o informado';
$contato = ($rowfornecedor ['contato']) ? $rowfornecedor ['contato'] : 'N�o informado';
$email = ($rowfornecedor ['email']) ? strtolower ( $rowfornecedor ['email'] ) : 'N�o informado';
$telefone = $rowfornecedor ['telefone'];
if (strlen ( $telefone ) > 6) {
	$telefone = (strlen ( $telefone )) ? str_pad ( str_replace ( '-', '', $telefone ), 10, '0', STR_PAD_LEFT ) : '';
	$dddtel = substr ( $telefone, 0, 2 );
	$tel1 = substr ( $telefone, 2, 4 );
	$tel2 = substr ( $telefone, 6, 4 );
} else {
	$telefone = 'N�o informado';
	$dddtel = '';
	$tel1 = '';
	$tel2 = '';
}

$telefone2 = $rowfornecedor ['fax'];
if (strlen ( $telefone2 ) > 6) {
	$telefone2 = (strlen ( $telefone2 )) ? str_pad ( str_replace ( '-', '', $telefone2 ), 10, '0', STR_PAD_LEFT ) : '';
	$dddtel_2 = substr ( $telefone2, 0, 2 );
	$tel1_2 = substr ( $telefone2, 2, 4 );
	$tel2_2 = substr ( $telefone2, 6, 4 );
} else {
	$telefone2 = 'N�o informado';
	$dddtel_2 = '';
	$tel1_2 = '';
	$tel2_2 = '';
}

//$fax = ($rowfornecedor['fax'])?$rowfornecedor['fax']:'N�o informado';
$ie = ($rowfornecedor ['ie']) ? $rowfornecedor ['ie'] : 'N�o informado';
$cep = $rowfornecedor ['cep'];
if (strlen ( $cep ) > 4) {
	$txtcep = (strlen ( $cep )) ? str_pad ( str_replace ( '-', '', $cep ), 8, '0', STR_PAD_LEFT ) : '';
	$cep1 = substr ( $txtcep, 0, 5 );
	$cep2 = substr ( $txtcep, 5, 3 );
} else {
	$cep = 'N�o informado';
	$cep1 = '';
	$cep2 = '';
}

$bairro = ($rowfornecedor ['bairro']) ? $rowfornecedor ['bairro'] : 'N�o informado';
$idpais = ($rowfornecedor ['idpais']) ? $rowfornecedor ['idpais'] : 'N�o informado';
$nomepais = ($rowfornecedor ['nomepais']) ? $rowfornecedor ['nomepais'] : 'N�o informado';

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

$vlcusto_fornecedor_total = 0;
$totalprodutos = 0;
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

<fieldset id="m"><legend>Dados do Fornecedor</legend>

<div class="linha_separador" style="width: 480px; height: 25px;">

<table width="100%">
	<tr>
		<td width="140" align="left"><input type="button"
			value="Ir para listagem" class="botao" id="irlistagem_resultado"
			style="cursor: pointer; cursor: hand; width: 140px;"
			onclick="javascript:carrega_listagemfornecedores(path+'modulos/fornecedor/fornecedor_lista.php','conteudo_direito', '-');"></td>
		<td align="right"><span id="mensagem"></span></td>
	</tr>
</table>

</div>

<div>

<table width="100%">
	<tr>
		<td>
		<div id="fornecedordados_main"
			style="overflow: auto; height: 282px; width: 496px">

		<table width="100%" cellpadding="0" cellspacing="0">
								<?
								if ($lucro_vendas < 0) {
									$cor = ' style="color:red;font-weight:bold;" ';
									?>
								<tr>
				<td height="30" style="background-color: red; color: white"
					align="center"><b>ATEN��O : O FORNECEDOR EST� OPERANDO COM PREJU�ZO</b>
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
				<td><input type="hidden" id="idfornecedor"
					value="<?=$idfornecedor;?>"> <input type="hidden" id="idpais"
					value="<?=$idpais;?>">

				<table width="100%">
					<tr>
						<td height="5"></td>
					</tr>
					<tr>
						<td height="20">
						<table width="100%">
							<tr>
								<td><b>Dados do fornecedor</b></td>
								<td align="right"><input type="button"
									value="salvar dados do fornecedor" class="botao"
									id="btnsalvarfor"
									style="cursor: pointer; cursor: hand; width: 180px; background-color: green; display: none;"
									onclick="javascript:cadastro_fornecedor_editar();"> <input
									type="button" value="editar dados do fornecedor" class="botao"
									id="btneditarfor"
									style="cursor: pointer; cursor: hand; width: 180px;"
									onclick="javascript:this.style.display='none';document.getElementById('btnsalvarfor').style.display='block';document.getElementById('fornecedor_exibicao').style.display='none';document.getElementById('fornecedor_edicao').style.display='block'">
								</td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td style="border-bottom: 2px solid black"></td>
					</tr>
					<tr>
						<td><input type="hidden" id="idfornecedor"
							value="<?=$idfornecedor;?>"> <input type="hidden" id="idpais"
							value="<?=$idpais;?>">

						<div id="fornecedor_exibicao">
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
										<table width="100%" cellpadding="0" cellspacing="0" border="0">
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
														<td align="left">(<span id="dddtel1_2"><?=($telefone2 == 'N�o informado') ? '00' : $dddtel_2;?></span>)
														<span id="tel1_2"><?=($telefone2 == 'N�o informado') ? '0000' : $tel1_2;?></span>
														- <span id="tel2_2"><?=($telefone2 == 'N�o informado') ? '0000' : $tel2_2;?></span></td>
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
												<td height="20" width="66">Endere�o</td>
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
												<td width="160"><span id="cep"><?=$cep1;?> - <?=$cep2;?></span></td>
												<td width="10"></td>
												<td height="20" width="50">Pa�s</td>
												<td align="left"><span id="pais"><?=$nomepais;?></span></td>
											</tr>
										</table>
										</td>
									</tr>
								</table>
								</td>
							</tr>
						</table>
						</div>

						<div id="fornecedor_edicao" style="display: none;">
						<table width="100%">
							<tr>
								<td>
								<table width="100%">
									<tr>
										<td width="65" height="20">Nome</td>
										<td><input type="text" id="edita_nomefornec"
											style="width: 390px" maxlength="60"
											value="<?=ucwords ( strtolower ( $nome ) );?>"></td>
									</tr>
									<tr>
										<td height="20">Contato</td>
										<td><input type="text" id="edita_contato" style="width: 390px"
											maxlength="30" value="<?=ucwords ( strtolower ( $contato ) );?>"
											<?=($contato == 'N�o informado') ? 'onclick="this.value=\'\';"' : '';?>></td>
									</tr>
									<tr>
										<td height="20">E-mail</td>
										<td><input type="text" id="edita_email" style="width: 390px"
											maxlength="100"
											value="<?=($email == 'N�o informado') ? '' : $email;?>"></td>
									</tr>
									<tr>
										<td colspan="2">
										<table width="385">
											<tr>
												<td height="20" width="60">Telefone</td>
												<td>(<input type="text" id="edita_telefone" maxlength="2"
													style="width: 20px; text-align: center;"
													value="<?=$dddtel;?>">) <input type="text"
													id="edita_telefone2" maxlength="4" style="width: 30px;"
													value="<?=$tel1;?>"> - <input type="text"
													id="edita_telefone3" maxlength="4" style="width: 30px;"
													value="<?=$tel2;?>"></td>
												<td width="10"></td>
												<td align="right">
												<table cellpadding="0" cellspacing="0" border="0">
													<tr>
														<td height="20" width="28">Fax</td>
														<td>(<input type="text" id="edita_fax" maxlength="2"
															style="width: 20px; text-align: center;"
															value="<?=$dddtel_2;?>">) <input type="text"
															id="edita_fax2" maxlength="4" style="width: 30px;"
															value="<?=$tel1_2;?>"> - <input type="text"
															id="edita_fax3" maxlength="4" style="width: 30px;"
															value="<?=$tel2_2;?>"></td>
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
										<td width="90"><input type="text" id="edita_cpf"
											style="width: 90px" maxlength="18"
											value="<?=($cnpj == 'N�o informado') ? '' : $cnpj;?>"></td>
										<td width="38"></td>
										<td height="20" width="75">Insc. Estadual</td>
										<td><input type="text" id="edita_idenest" style="width: 90px"
											maxlength="16" value="<?=($ie == 'N�o informado') ? '' : $ie;?>"></td>
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
												<td height="20" width="66">Endere�o</td>
												<td><input type="text" id="edita_endereco"
													style="width: 120px" maxlength="50"
													value="<?=ucwords ( strtolower ( $endereco ) );?>"
													<?=($endereco == 'N�o informado') ? 'onclick="this.value=\'\';"' : '';?>></td>
												<td width="50"></td>
												<td height="20" width="40">Bairro</td>
												<td align="right"><input type="text" id="edita_bairro"
													style="width: 120px" maxlength="60"
													value="<?=ucwords ( strtolower ( $bairro ) );?>"
													<?=($bairro == 'N�o informado') ? 'onclick="this.value=\'\';"' : '';?>></td>
											</tr>
										</table>
										</td>
									</tr>
									<tr>
										<td>
										<table width="100%" cellpadding="0" cellspacing="0" border="0">
											<tr>
												<td width="220">
												<table cellpadding="0" cellspacing="0" border="0">
													<tr>
														<td height="20" width="66">Cidade</td>
														<td width="120"><input type="text" id="edita_cidade"
															style="width: 120px"
															value="<?=ucwords ( strtolower ( $cidade ) );?>" maxlength="20"
															<?=($cidade == 'N�o informado') ? 'onclick="this.value=\'\';"' : '';?>></td>
													</tr>
													<tr>
														<td height="25">Estado</td>
														<td align="right"><select id="edita_estado"
															style="width: 100px"
															onchange="javascript:document.getElementById('edita_cidade').value='';">
															<option value="AC" <?=($uf == 'AC') ? 'selected' : '';?>>AC</option>
															<option value="AL" <?=($uf == 'AL') ? 'selected' : '';?>>AL</option>
															<option value="AP" <?=($uf == 'AP') ? 'selected' : '';?>>AP</option>
															<option value="AM" <?=($uf == 'AM') ? 'selected' : '';?>>AM</option>
															<option value="BA" <?=($uf == 'BA') ? 'selected' : '';?>>BA</option>
															<option value="CE" <?=($uf == 'CE') ? 'selected' : '';?>>CE</option>
															<option value="DF" <?=($uf == 'DF') ? 'selected' : '';?>>DF</option>
															<option value="GO" <?=($uf == 'GO') ? 'selected' : '';?>>GO</option>
															<option value="ES" <?=($uf == 'ES') ? 'selected' : '';?>>ES</option>
															<option value="MA" <?=($uf == 'MA') ? 'selected' : '';?>>MA</option>
															<option value="MT" <?=($uf == 'MT') ? 'selected' : '';?>>MT</option>
															<option value="MS" <?=($uf == 'MS') ? 'selected' : '';?>>MS</option>
															<option value="MG" <?=($uf == 'MG') ? 'selected' : '';?>>MG</option>
															<option value="PA" <?=($uf == 'PA') ? 'selected' : '';?>>PA</option>
															<option value="PB" <?=($uf == 'PB') ? 'selected' : '';?>>PB</option>
															<option value="PR" <?=($uf == 'PR') ? 'selected' : '';?>>PR</option>
															<option value="PE" <?=($uf == 'PE') ? 'selected' : '';?>>PE</option>
															<option value="PI" <?=($uf == 'PI') ? 'selected' : '';?>>PI</option>
															<option value="RJ" <?=($uf == 'RJ') ? 'selected' : '';?>>RJ</option>
															<option value="RN" <?=($uf == 'RN') ? 'selected' : '';?>>RN</option>
															<option value="RS" <?=($uf == 'RS') ? 'selected' : '';?>>RS</option>
															<option value="RO" <?=($uf == 'RO') ? 'selected' : '';?>>RO</option>
															<option value="RR" <?=($uf == 'RR') ? 'selected' : '';?>>RR</option>
															<option value="SP" <?=($uf == 'SP') ? 'selected' : '';?>>SP</option>
															<option value="SC" <?=($uf == 'SC') ? 'selected' : '';?>>SC</option>
															<option value="SE" <?=($uf == 'SE') ? 'selected' : '';?>>SE</option>
															<option value="TO" <?=($uf == 'TO') ? 'selected' : '';?>>TO</option>
															<option value="OU" <?=($uf == 'OU') ? 'selected' : '';?>>Outro</option>
														</select></td>
													</tr>
												</table>
												</td>
												<td width="23"></td>
												<td>
												<table cellpadding="0" cellspacing="0" border="0">
													<tr>
														<td height="20" width="35">CEP</td>
														<td><input type="text" id="edita_cep1" maxlength="5"
															style="width: 40px" value="<?=$cep1;?>"> - <input
															type="text" id="edita_cep2" maxlength="3"
															style="width: 25px" value="<?=$cep2;?>"></td>
													</tr>
													<tr>
														<td height="25">Pa�s</td>
														<td><select id="edita_pais" style="width: 125px"
															onchange="javascript:document.getElementById('edita_cidade').value='';document.getElementById('edita_estado').selectedIndex=27;">
																											<?
																											$sql = "SELECT iso, numcode, nome FROM paises ORDER BY nome ASC";
																											$querypais = $db->query ( $sql );
																											while ( $rowpais = $db->fetch_assoc ( $querypais ) ) {
																												?>
																											<option value="<?=$rowpais ['numcode'];?>"
																<?=($idpais == $rowpais ['numcode']) ? 'selected' : '';?>><?=$rowpais ['nome'];?></option>
																											<?
																											}
																											?>
																										</select></td>
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
						</div>
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
						<td align="right"><b>Custo</b> : R$ <?=number_format ( $vlcusto_fornecedor_total, 2, ',', '.' );?></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td style="border-bottom: 2px solid black"></td>
			</tr>
			<tr>
				<td>
				<div id="fornecedor_dadosgerais">
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
										<td align="right">R$ <?=number_format ( $vlcusto_fornecedor_atual, 2, ',', '.' );?></td>
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
								<td width="240" valign="top">
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
																		$lucro_vendas_porcento = number_format ( ($lucro_vendas_real / $vlcusto_fornecedor_vendas) * 100, 2, ',', '.' );
																		$nomeclatura_lucro = 'Lucro';
																	} else {
																		$lucro_vendas_porcento = number_format ( - 1 * ((($valor_total_custo / $valor_vendas) * 100)) + 100, 2, ',', '.' );
																		$lucro_vendas = $valor_total_custo - $valor_vendas;
																		$nomeclatura_lucro = 'Preju�zo';
																	}
																	
																	?>
																		<tr>
										<td height="25"><b>Valor custo</b></td>
										<td align="right">R$ <?=number_format ( $vlcusto_fornecedor_vendas, 2, ',', '.' );?></td>
									</tr>
									<tr>
										<td width="120" height="25"><b>Valor total</b></td>
										<td align="right">R$ <?=number_format ( $total_vlvarejo_vendas, 2, ',', '.' );?></td>
									</tr>
									<tr>
										<td width="120" height="25"><b><?=$nomeclatura_lucro;?></b></td>
										<td align="right">R$ <?=number_format ( $lucro_vendas_real, 2, ',', '.' );?></td>
									</tr>
									<tr>
										<td height="25"><b><?=$nomeclatura_lucro;?></b></td>
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
						<div id="fornecedor_pontoprodutos"></div>
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
									<span id="fornecedor_listadeprodutos">
										<?
										$sql = "SELECT e.nquantidade, p.idproduto, p.txtproduto, p.vlcusto, p.vlvarejo, p.vlatacado, p.vlprontaentrega FROM produto AS p INNER JOIN estoque AS e ON e.produto_idproduto=p.idproduto WHERE p.fornecedor_idfornecedor=" . $idfornecedor . "";
										$query = $db->query ( $sql );
										$quant = 0;
										while ( $produtos_fornecedor = $db->fetch_assoc ( $query ) ) {
										?>
										<table width="100%" cellpadding="0" cellspacing="0">
											<tr onmouseover="rowOver(this)" onmouseout="rowOut(this)" style="cursor: pointer; cursor: hand;" onClick="javascript:listasimples_historicoproduto('?exibe=btnfornecedor&id=<?=$produtos_fornecedor ['idproduto'];?>','fornecedor');">
												<td width="10" height="25"></td>
												<td width="145"><?=qtdCaracteres(ucwords(strtolower($produtos_fornecedor['txtproduto'])),25);?></td>
												<td width="30" align="center"><?=( int ) $produtos_fornecedor ['nquantidade'];?></td>
												<td width="70" align="right"><?=number_format ( $produtos_fornecedor ['vlcusto'], 2, ',', '.' );?></td>
												<td width="70" align="right"><?=number_format ( $produtos_fornecedor ['vlprontaentrega'], 2, ',', '.' );?></td>
												<td width="70" align="right"><?=number_format ( $produtos_fornecedor ['vlatacado'], 2, ',', '.' );?></td>
												<td width="70" align="right"><?=number_format ( $produtos_fornecedor ['vlvarejo'], 2, ',', '.' );?></td>
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
						<td height="25"><b>Cole��es</b></td>
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
								<td align="right"><b>Per�odo</b></td>
								<td width="10"></td>
							</tr>
							<tr>
								<td colspan="4" style="border-bottom: 1px solid #c0c0c0;"></td>
							</tr>
							<tr>
								<td colspan="4"><span id="fornecedor_listadecolecoes">
																	<?
																	$sql = "SELECT distinct(c.idcolecao) AS idcolecao, c.txtnome, c.txtperiodo FROM produto AS p INNER JOIN colecao AS c ON c.idcolecao=p.colecao_idcolecao WHERE p.fornecedor_idfornecedor=" . $idfornecedor . "";
																	$query = $db->query ( $sql );
																	$quant = 0;
																	
																	while ( $produtos_colecao = $db->fetch_assoc ( $query ) ) {
																		if (strlen ( $produtos_colecao ['txtperiodo'] ) > 8) {
																			$periodo_explode = explode ( ' at� ', $produtos_colecao ['txtperiodo'] );
																			$periodo_1 = explode ( '/', $periodo_explode [0] );
																			$periodo_2 = explode ( '/', $periodo_explode [1] );
																			if ($periodo_1 [0] < 10)
																				$periodo_1 [0] = str_replace ( '0', '', $periodo_1 [0] );
																			if ($periodo_2 [0] < 10)
																				$periodo_2 [0] = str_replace ( '0', '', $periodo_2 [0] );
																			$periodocolecao = $meses [$periodo_1 [0]] . ' de ' . $periodo_1 [1] . ' at� ' . $meses [$periodo_2 [0]] . ' de ' . $periodo_2 [1];
																		} else {
																			$periodocolecao = 'indeterminado';
																		}
																		?>
																	<table width="100%" cellpadding="0" cellspacing="0">
									<tr onmouseover="rowOver(this)" onmouseout="rowOut(this)"
										style="cursor: pointer; cursor: hand;"
										onClick="javascript:listasimples_historicocolecao('<?=$produtos_colecao ['idcolecao'];?>');">
										<td width="10" height="25"><input type="hidden"
											id="colecao_<?=$produtos_colecao ['idcolecao'];?>"></td>
										<td><?=ucwords ( strtolower ( $produtos_colecao ['txtnome'] ) );?></td>
										<td align="right"><?=$periodocolecao;?></td>
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
					onclick="javascript:cadastro_fornecedor_vincularproduto();"></td>
				<td align="right"><input type="button"
					value="adicionar um novo produto" class="botao"
					style="cursor: pointer; cursor: hand; width: 200px; background-color: green;"
					onclick="javascript:carrega_adicionarproduto('modulos/produto/produto_cadastrar.php?for=<?=$idfornecedor;?>', '<?=date ( 'simyhd' );?>');"></td>
			</tr>
		</table>
		</td>
	</tr>
</table>

</div>

</fieldset>
