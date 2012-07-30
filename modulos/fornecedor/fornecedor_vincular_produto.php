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


<fieldset id="p"><legend>Vincular Produto ao Fornecedor</legend>

<div class="linha_separador" id="linha_separador_gradeedicao"
	style="height: 28px;">
<table width="100%" height="100%">
	<tr>
		<td align="right"><input type="button" value="Ir para listagem"
			class="botao" id="irlistagem_vincular"
			style="cursor: pointer; cursor: hand; width: 140px;"
			onclick="javascript:carrega_listagemcolecoes(path+'modulos/colecao/colecao_lista.php','conteudo_direito', 'historico');"></td>
	</tr>
</table>
</div>

<div id="divadicionaritem"><input type="hidden" id="idfor">

<table width="370">
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td height="20"><b>Marque os produtos que deseja vincular ao
		fornecedor</b></td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td>
		<table width="100%" cellpadding="0" cellspacing="0">
			<tr bgcolor="#f0f0f0">
				<td height="20" width="10"></td>
				<td width="20"></td>
				<td width="5"></td>
				<td width="150"><b>Produto</b></td>
				<td width="100"><b>Categoria</b></td>
				<td width="85" align="center"><b>Qtd</b></td>
				<td width="25"></td>
			</tr>
			<tr>
				<td colspan="7">
				<div id="listaprodutosem"
					style="overflow: auto; height: 235px; width: 370px;">
				<table width="100%" cellpadding="0" cellspacing="0">
								<?
								$sql = "SELECT p.idproduto, p.grade, p.txtproduto, p.qtdestoque, p.vlcusto, p.vlatacado, p.vlprontaentrega, p.vlvarejo, pt.txtnome, f.idfornecedor, f.nome, f.telefone FROM produto AS p LEFT JOIN produtotipo AS pt ON p.produtotipo_idprodutotipo=pt.idprodutotipo LEFT JOIN fornecedor AS f ON p.fornecedor_idfornecedor=f.idfornecedor WHERE p.fornecedor_idfornecedor=0";
								$query = $db->query ( $sql );
								while ( $rowproduto = $db->fetch_assoc ( $query ) ) {
									$rowproduto ['txttelefone'] = (strlen ( $rowproduto ['telefone'] )) ? str_pad ( str_replace ( '-', '', $rowproduto ['telefone'] ), 10, '0', STR_PAD_LEFT ) : '';
									$dddtel = substr ( $rowproduto ['telefone'], 0, 2 );
									$tel1 = substr ( $rowproduto ['telefone'], 2, 4 );
									$tel2 = substr ( $rowproduto ['telefone'], 6, 4 );
									?>
									<tr>
						<td>
						<div id="conteudo_<?=$rowproduto ['idproduto'];?>">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tr>
								<td height="25" width="10"></td>
								<td width="20"><input type="checkbox"
									id="produto_<?=$rowproduto ['idproduto'];?>"
									value="<?=$rowproduto ['idproduto'] . ':|:' . ucwords ( strtolower ( $rowproduto ['txtproduto'] ) ) . ':|:' . $rowproduto ['qtdestoque'] . ':|:' . number_format ( $rowproduto ['vlcusto'], 2, ',', '.' ) . ':|:' . number_format ( $rowproduto ['vlatacado'], 2, ',', '.' ) . ':|:' . number_format ( $rowproduto ['vlprontaentrega'], 2, ',', '.' ) . ':|:' . number_format ( $rowproduto ['vlvarejo'], 2, ',', '.' ) . ':|:' . $rowproduto ['idfornecedor'] . ':|:' . ucwords ( strtolower ( $rowproduto ['nome'] ) ) . ':|:( ' . $dddtel . ' ) ' . $tel1 . '-' . $tel2;?>"
									onclick="javascript:habilita_botaovincular();"></td>
								<td width="5"></td>
								<td width="150"
									<?=($rowproduto ['grade'] == 1) ? 'style="cursor:pointer; cursor:hand;" onclick="javascript:document.getElementById(\'grade_' . $rowproduto ['idproduto'] . '\').style.display=((document.getElementById(\'grade_' . $rowproduto ['idproduto'] . '\').style.display==\'none\')?\'block\':\'none\');"' : '';?>><?=ucwords ( strtolower ( $rowproduto ['txtproduto'] ) );?></td>
								<td width="100"
									<?=($rowproduto ['grade'] == 1) ? 'style="cursor:pointer; cursor:hand;" onclick="javascript:document.getElementById(\'grade_' . $rowproduto ['idproduto'] . '\').style.display=((document.getElementById(\'grade_' . $rowproduto ['idproduto'] . '\').style.display==\'none\')?\'block\':\'none\');"' : '';?>><?=ucwords ( strtolower ( $rowproduto ['txtnome'] ) );?></td>
								<td width="85" align="center"
									<?=($rowproduto ['grade'] == 1) ? 'style="cursor:pointer; cursor:hand;" onclick="javascript:document.getElementById(\'grade_' . $rowproduto ['idproduto'] . '\').style.display=((document.getElementById(\'grade_' . $rowproduto ['idproduto'] . '\').style.display==\'none\')?\'block\':\'none\');"' : '';?>><?=$rowproduto ['qtdestoque'];?></td>
								<td width="10"></td>
							</tr>
							<tr>
								<td colspan="7" style="border-bottom: 1px solid #c0c0c0;"></td>
							</tr>
													<?
									if ($rowproduto ['grade'] == 1) {
										?>
													<tr bgcolor="<?=$cor;?>">
								<td colspan="3"></td>
								<td colspan="4">
								<div id="grade_<?=$rowproduto ['idproduto'];?>"
									style="display: none;">
								<table>
																	<?
										$sql = "SELECT descricao, quantidade, vlprodgrade FROM cad_produtos_grade WHERE id_produto=" . $rowproduto ['idproduto'] . "";
										$querygrade = $db->query ( $sql );
										while ( $rowgrade = $db->fetch_assoc ( $querygrade ) ) {
											?>
																	<tr>
										<td height="25" width="10"></td>
										<td><?=ucwords ( strtolower ( $rowgrade ['descricao'] ) );?></td>
										<td width="10"></td>
										<td>( <?=$rowgrade ['quantidade'];?> ite<?=($rowgrade ['quantidade'] > 1) ? 'ns' : 'm';?> <?=($rowgrade ['vlprodgrade'] > 0) ? ' R$ ' . number_format ( $rowgrade ['vlprodgrade'], 2, ',', '.' ) : ''?> )</td>
									</tr>
																	<?
										}
										?>
																</table>
								</div>
								</td>
							</tr>
													<?
									}
									?>
													<tr>
								<td colspan="7" style="border-bottom: 1px solid #c0c0c0;"></td>
							</tr>
						</table>
						</div>
						</td>
					</tr>
								<?
								}
								?>
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
		<td height="6"></td>
	</tr>
	<tr>
		<td align="right"><input type="button" id="btnvincularprodutos_sel"
			value="vincular produtos marcados" class="botao"
			style="cursor: pointer; cursor: hand; width: 200px; display: none; background-color: green;"
			onclick="javascript:cadastro_fornecedor_vincularproduto_sel();"></td>
	</tr>
</table>

</div>

</fieldset>