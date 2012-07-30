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
<table width="100%">
<?

$sql = "SELECT DISTINCT f.idfornecedor, f.nome FROM fornecedor AS f INNER JOIN produto AS p ON p.fornecedor_idfornecedor=f.idfornecedor INNER JOIN estoque AS e ON e.produto_idproduto=p.idproduto WHERE e.nquantidade>0 ORDER BY f.nome ASC";
$queryfornecedor = $db->query ( $sql );

if ($db->num_rows ( $queryfornecedor )) {
	
	while ( $rowfornecedor = $db->fetch_assoc ( $queryfornecedor ) ) {
		
		$total_custo = 0;
		$total_prontaentrega = 0;
		$total_atacado = 0;
		$total_vlvarejo = 0;
		$total_itens = 0;
		
		$sql = "SELECT p.cod_interno, p.cod_barra, p.idproduto, p.txtproduto, p.vlcusto, p.vlvarejo, p.vlatacado, p.vlprontaentrega, e.nquantidade FROM produto AS p INNER JOIN estoque AS e ON e.produto_idproduto=p.idproduto WHERE e.nquantidade>0 AND fornecedor_idfornecedor=" . $rowfornecedor ['idfornecedor'] . " ORDER BY txtproduto ASC";
		$query = $db->query ( $sql );
		
		?>
	<tr>
		<td>
			<?
		if ($db->num_rows ( $query )) {
			?>
			<a href="javascript:;" onclick="javascript:document.getElementById('fornecedor_<?=$rowfornecedor ['idfornecedor'];?>').style.display = ((document.getElementById('fornecedor_<?=$rowfornecedor ['idfornecedor'];?>').style.display=='none')?'block':'none');"><b><?=ucwords ( strtolower ( $rowfornecedor ['nome'] ) );?></b></a>
			<?
		} else {
			?>
			<b><?=ucwords ( strtolower ( $rowfornecedor ['nome'] ) );?></b>
			<?
		}
		?>
		</td>
	</tr>
<?
		
		if ($db->num_rows ( $query )) {
			?>
	<tr>
		<td>
		<div id="fornecedor_<?=$rowfornecedor ['idfornecedor'];?>" style="display: none;">
		<table width="100%">
			<tr>
				<td colspan="9" style="border-top: 2px solid black"></td>
			</tr>
			<tr>
			
			
			<tr>
				<td colspan="9" bgcolor="#f0f0f0">
				<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td width="120" height="25" align="center"><b>C�d. Barras</b></td>
						<td height="25"><b>Produto</b></td>
						<td width="90" height="25" align="center"><b>Qtd</b></td>
						<td width="90" height="25" align="right"><b>Custo</b></td>
						<td width="90" height="25" align="right"><b>P. Entrega</b></td>
						<td width="90" height="25" align="right"><b>Atacado</b></td>
						<td width="90" height="25" align="right"><b>Varejo</b></td>
						<td width="15"></td>
					</tr>
				</table>
				</td>
			</tr>
					<?
			while ( $rowprodutos = $db->fetch_assoc ( $query ) ) {
				$total_itens += ( int ) $rowprodutos ['nquantidade'];
				?>
					<tr>
				<td colspan="8" style="border-bottom: 1px solid #c0c0c0;"></td>
			</tr>
			<tr>
				<td width="120" height="25" align="center"><?=$rowprodutos ['cod_barra'];?></td>
				<td height="25"><?=(($rows['cod_interno'])?$rows['cod_interno'].' - ':'').ucwords(strtolower($rowprodutos['txtproduto']));?></td>
				<td width="60" height="25" align="center"><?=( int ) $rowprodutos ['nquantidade'];?></td>
				<td width="90" height="25" align="right"><?=number_format ( $rowprodutos ['vlcusto'], 2, ',', '.' );?></td>
				<td width="90" height="25" align="right"><?=number_format ( $rowprodutos ['vlprontaentrega'], 2, ',', '.' );?></td>
				<td width="90" height="25" align="right"><?=number_format ( $rowprodutos ['vlatacado'], 2, ',', '.' );?></td>
				<td width="90" height="25" align="right"><?=number_format ( $rowprodutos ['vlvarejo'], 2, ',', '.' );?></td>
				<td width="15"></td>
			</tr>
					<?
				$sql = "SELECT descricao, quantidade, vlprodgrade FROM cad_produtos_grade WHERE id_produto=" . $rowprodutos ['idproduto'] . " AND quantidade > 0";
				$querygrade = $db->query ( $sql );
				if ($db->num_rows ( $querygrade )) {
					while ( $rowgrade = $db->fetch_assoc ( $querygrade ) ) {
						?>
					<tr>
				<td colspan="7">
				<table>
					<tr>
						<td width="120"></td>
						<td width="235"><?=ucwords ( strtolower ( $rowgrade ['descricao'] ) );?></td>
									<?
						if ($rowgrade ['vlprodgrade'] > 0) {
							$total_custo += $rowgrade ['vlprodgrade'] * $rowgrade ['quantidade'];
							$total_prontaentrega += $rowgrade ['vlprodgrade'] * $rowgrade ['quantidade'];
							$total_atacado += $rowgrade ['vlprodgrade'] * $rowgrade ['quantidade'];
							$total_vlvarejo += $rowgrade ['vlprodgrade'] * $rowgrade ['quantidade'];
							?>
									<td width="100" align="center">
						<table>
							<tr>
								<td>Vl �nico dif.</td>
								<td><?=number_format ( $rowgrade ['vlprodgrade'], 2, ',', '.' );?></td>
							</tr>
						</table>
						</td>
									<?
						} else {
							$total_custo += $rowprodutos ['vlcusto'] * $rowgrade ['quantidade'];
							$total_prontaentrega += $rowprodutos ['vlprontaentrega'] * $rowgrade ['quantidade'];
							$total_atacado += $rowprodutos ['vlatacado'] * $rowgrade ['quantidade'];
							$total_vlvarejo += $rowprodutos ['vlvarejo'] * $rowgrade ['quantidade'];
							?>
									<td width="100"></td>
									<?
						}
						?>
									<td width="60" height="25" align="center"><?=( int ) $rowgrade ['quantidade'];?></td>
					</tr>
				</table>
				</td>
			</tr>
	<?
					}
				} else {
					$total_custo += $rowprodutos ['vlcusto'] * $rowprodutos ['nquantidade'];
					$total_prontaentrega += $rowprodutos ['vlprontaentrega'] * $rowprodutos ['nquantidade'];
					$total_atacado += $rowprodutos ['vlatacado'] * $rowprodutos ['nquantidade'];
					$total_vlvarejo += $rowprodutos ['vlvarejo'] * $rowprodutos ['nquantidade'];
				}
				?>
<?
			}
			
			?>
				</table>
		</div>
		</td>
	</tr>
	<tr>
		<td colspan="8" style="border-top: 2px solid black">
		<table width="100%">
			<tr>
				<td height="40" width="20"></td>
				<td width="320"><b>Total de todos os produtos em estoque :</b> <?=$total_itens;?> itens</td>
				<td width="120"><b>Custo :</b> R$ <?=number_format ( $total_custo, 2, ',', '.' );?></td>
				<td width="150"><b>P. Entrega :</b> R$ <?=number_format ( $total_prontaentrega, 2, ',', '.' );?></td>
				<td width="140"><b>Atacado :</b> R$ <?=number_format ( $total_atacado, 2, ',', '.' );?></td>
				<td width="130"><b>Varejo :</b> R$ <?=number_format ( $total_vlvarejo, 2, ',', '.' );?></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td colspan="9" style="border-top: 2px solid black"></td>
	</tr>
	<tr>
		<td colspan="9" height="15"></td>
	</tr>
	<?
		} else {
			?>
	<tr>
		<td colspan="9" style="border-top: 2px solid black"></td>
	</tr>
	<tr>
		<td align=center><b style="color: red"> [ Este fornecedor n�o possui
		nenhum produto ] </b></td>
	</tr>
	<tr>
		<td colspan="9" style="border-top: 2px solid black"></td>
	</tr>
	<tr>
		<td colspan="9" height="15"></td>
	</tr>

<?
		}
		?>
<?
	}
	?>
</table>
<?
} else {
	
	echo exibe_errohtml ( 'Nenhum fornecedor com produto em estoque' );

}
?>
