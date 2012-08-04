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

$idcolecao = $validations->validNumeric ( $_GET ['c'] );

$sql = "SELECT txtnome, txtperiodo, txtdescricao FROM colecao WHERE idcolecao=" . $idcolecao . "";
$querycolecao = $db->query ( $sql );
$rowcolecao = $db->fetch_assoc ( $querycolecao );

if (strlen ( $rowcolecao ['txtperiodo'] ) > 8) {
	$periodo_explode = explode ( ' até ', $rowcolecao ['txtperiodo'] );
	$periodo_1 = explode ( '/', $periodo_explode [0] );
	$periodo_2 = explode ( '/', $periodo_explode [1] );
	if ($periodo_1 [0] < 10)
		$periodo_1 [0] = str_replace ( '0', '', $periodo_1 [0] );
	if ($periodo_2 [0] < 10)
		$periodo_2 [0] = str_replace ( '0', '', $periodo_2 [0] );
	$periodocolecao = $meses [$periodo_1 [0]] . ' de ' . $periodo_1 [1] . ' até ' . $meses [$periodo_2 [0]] . ' de ' . $periodo_2 [1];
} else {
	$periodocolecao = 'indeterminado';
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

<fieldset id="p"><legend>Histórico da Coleção</legend>

<div class="linha_separador" style="width: 350px; height: 55px;">
<table width="100%" height="100%">
	<tr>
		<td height="25"><b>Coleção : <?=$rowcolecao ['txtnome'];?></b></td>
	</tr>
	<tr>
		<td height="25"><?=$periodocolecao;?></td>
	</tr>
</table>
</div>

<div>

<table width="370">
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td height="25">
		<table width="100%">
			<tr>
				<td><b>Dados da coleção</b></td>
				<td align="right"><b><?=$totalprodutos;?></b> produto<?=($totalprodutos > 1) ? 's' : ''?> vinculado<?=($totalprodutos > 1) ? 's' : ''?></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td height="25">
		<table width="100%">
			<tr>
				<td><b>Estatísticas da coleção</b></td>
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
		<table>
			<tr>
				<td width="170" valign="top">
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
				<td width="170" valign="top">
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
									$nomeclatura_lucro = 'Prejuízo';
								}
								
								?>
									<tr>
						<td height="25"><b>Valor custo</b></td>
						<td align="right">R$ <?=number_format ( $vlcusto_colecao_vendas, 2, ',', '.' );?></td>
					</tr>
					<tr>
						<td height="25"><b>Valor total</b></td>
						<td align="right">R$ <?=number_format ( $total_vlvarejo_vendas, 2, ',', '.' );?></td>
					</tr>
					<tr>
						<td height="25"><b>Lucro</b></td>
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
</table>


</div>

</fieldset>