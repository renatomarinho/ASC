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

$controle = $validations->validNumeric ( $_GET ['c'] );

$date_controle = date ( 'd-m-Y', $controle );

$confere_diferenca = dateDiff ( $date_controle, date ( 'd-m-Y' ) );

if ($_CONF ['PERIODO_MAX_ESTORNO'] < $confere_diferenca) {
	$select = 'disabled';
} else {
	$select = '';
}

$sql = "SELECT
		cpg.descricao, mvv.controle, mvm.grade_id,
		mvm.vip_movimento_id as id, mvm.produto_idproduto,
		-- mvm.vr_total AS vr_total,
		mvm.produto_quantidade AS quantidade,
		p.txtproduto, mvm.estornado
		FROM mv_vendas_vip AS mvv
		JOIN mv_vendas_vip_movimento AS mvm ON (mvm.venda_vip_id = mvv.vip_id)
		LEFT JOIN produto AS p ON mvm.produto_idproduto=p.idproduto
		LEFT JOIN cad_produtos_grade AS cpg ON mvm.grade_id=cpg.id
		WHERE mvv.controle='" . $controle . "'
		ORDER BY mvm.produto_idproduto, mvm.estornado ASC";

$query = $db->query ( $sql );
$estornostatus = 0;

while ( $estorno = $db->fetch_assoc ( $query ) ) {
	if ($estorno ['estornado'] == 0) {
		++ $estornostatus;
	}
}
$query = $db->query ( $sql );
$total1 = 0;
$total2 = 0;

$produto_exibido = Array ();

?>

<div class="linha_separador" style="width: 480px; height: 15px;">
<center>
		<?
		if ($_CONF ['PERIODO_MAX_ESTORNO'] < $confere_diferenca) {
			?>
			<b style="color: red;">A venda foi realizada � <?=$confere_diferenca;?> dia<?=($confere_diferenca > 1) ? 's' : '';?>, o per�odo m�ximo para estornar � de <?=$_CONF ['PERIODO_MAX_ESTORNO'];?> dia<?=($confere_diferenca > 1) ? 's' : '';?></b>
		<?
		} else {
			?>
			<b style="color: blue;">A venda foi realizada � <?=$confere_diferenca;?> dia<?=($confere_diferenca > 1) ? 's' : '';?>, est� dentro do per�odo de <?=$_CONF ['PERIODO_MAX_ESTORNO'];?> dia<?=($confere_diferenca > 1) ? 's' : '';?> para estornar</b>
		<?
		}
		?>
		</center>
</div>
<BR>
<div id="produtoestornar">

<table cellpadding="0" cellspacing="0" width="495">
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td height="25">
				<?
				if ($_CONF ['PERIODO_MAX_ESTORNO'] < $confere_diferenca) {
					?>
					<table>
			<tr>
				<td><b>O estorno desta venda � opcional, deseja efetuar ?</b></td>
				<td width="10"></td>
				<td><select id="opcestorno"
					onchange="javascript:carregar_alteraropcaoestorno(this.value);"
					style="width: 60px;">
					<option value="0">N�o</option>
					<option value="1">Sim</option>
				</select></td>
			</tr>
		</table>
				<?
				} else {
					if ($estornostatus == 0) {
						?>
					<b style="color: red"><u>N�o existe nenhum item para estornar</u></b>
				<?
					} else {
						?>
					<b>Selecione a quantidade de itens que ser�o estornados e marque o
		produto</b>
				<?
					}
				}
				?>
				</td>
	</tr>
	<tr>
		<td style="border-top: 2px solid black"></td>
	</tr>
	<tr>
		<td colspan="5">
		<div id="produtosestornar"
			style="height: 260px; width: 500px; overflow: auto;">
		<table cellpadding="0" cellspacing="0" width="100%">
						<?
						$cor = '#f0f0f0';
						while ( $result = $db->fetch_assoc ( $query ) ) {
							$idproduto = $result ['id_produto'];
							if (! array_key_exists ( $idproduto, $produto_exibido )) {
								$cor = ($cor == '#add4fb') ? '#f0f0f0' : '#add4fb';
							}
							?>
							<tr bgcolor="<?=$cor;?>">
				<td colspan="5" height="8"></td>
			</tr>
			<tr bgcolor="<?=$cor;?>">
				<td width="20"></td>
				<td>
				<table>
					<tr>
						<td colspan="2" width="250">
												<?
							if (! array_key_exists ( $idproduto, $produto_exibido )) {
								?>
												<b
							<?=($result ['estornado'] == 1) ? 'style="color:red;"' : '';?>><?=ucwords ( strtolower ( $result ['txtproduto'] ) );?></b>
												<?
							}
							?>
											</td>
										<?
							if ($result ['grade_id'] > 0) {
								$sql = "SELECT descricao FROM cad_produtos_grade WHERE id=" . $result ['grade_id'] . "";
								$querygrade = $db->query ( $sql );
								$rowgrade = $db->fetch_assoc ( $querygrade );
								?>
										</tr>
					<tr>
						<td width="25"></td>
						<td width="200"
							<?=($result ['estornado'] == 1) ? 'style="color:red;"' : '';?>><?=ucwords ( strtolower ( $rowgrade ['descricao'] ) );?></td>

						<td width="50" align="right" valign="top"><select
							<?=($result ['estornado'] == 0) ? 'id="quantitens_' . $result ['id'] . '"' : '';?>
							style="width: 80px;"
							<?=($result ['estornado'] == 1 || $_CONF ['PERIODO_MAX_ESTORNO'] < $confere_diferenca) ? 'disabled' : '';?>>
													<?
								$itens_comprados = ( int ) $result ['quantidade'];
								for($i = 1; $i <= $itens_comprados; $i ++) {
									?>
													<option value="<?=$i;?>"
								<?=($result ['estornado'] == 1 && $itens_comprados == $i) ? 'selected' : '';?>><?=$i . ' ite' . (($i > 1) ? 'ns' : 'm');?></option>
													<?
								}
								?>
												</select></td>
						<td width="30" align="center"><?
								if ($result ['estornado'] == 0) {
									?><input
							type="checkbox"
							<?=($result ['estornado'] == 0) ? 'id="marcado_' . $result ['id'] . '"' : '';?>
							value="<?=$result ['id'];?>" style="width: 15px" <?=$select;?>><?
								}
								?></td>
						<td width="90" align="right" valign="top">R$ <?=number_format ( $result ['vr_total'], 2, ',', '.' );?></td>
					</tr>
										<?
							} else {
								?>
											<td width="50" align="right" valign="top"><select
						<?=($result ['estornado'] == 0) ? 'id="quantitens_' . $result ['id'] . '"' : '';?>
						style="width: 80px;"
						<?=($result ['estornado'] == 1 || $_CONF ['PERIODO_MAX_ESTORNO'] < $confere_diferenca) ? 'disabled' : '';?>>
													<?
								$itens_comprados = ( int ) $result ['quantidade'];
								for($i = 1; $i <= $itens_comprados; $i ++) {
									?>
													<option value="<?=$i;?>"
							<?=($result ['estornado'] == 1 && $itens_comprados == $i) ? 'selected' : '';?>><?=$i . ' ite' . (($i > 1) ? 'ns' : 'm');?></option>
													<?
								}
								?>
												</select></td>
					<td width="30" align="center"><?
								if ($result ['estornado'] == 0) {
									?><input
						type="checkbox"
						<?=($result ['estornado'] == 0) ? 'id="marcado_' . $result ['id'] . '"' : '';?>
						value="<?=$result ['id'];?>" style="width: 15px" <?=$select;?>><?
								}
								?></td>
					<td width="90" align="right" valign="top">
												<?
								if (! array_key_exists ( $idproduto, $produto_exibido )) {
									?>
													R$ <?=number_format ( $result ['vr_total'], 2, ',', '.' );?>
												<?
								}
								?>
											</td>
					</tr>
										<?
							}
							?>
									</table>
				</td>

				<td width="20"></td>
			</tr>
			<tr>
				<td bgcolor="<?=$cor;?>" colspan="5" height="2"></td>
			</tr>
						<?
							$produto_exibido [$result ['id_produto']] = $result ['id_produto'];
						}
						?>
						</table>
		</div>
		</td>
	</tr>
	<tr>
		<td colspan="5" height="10"></td>
	</tr>
	<tr>
		<td colspan="5" style="border-top: 2px solid black"></td>
	</tr>
	<tr>
		<td colspan="5" height="10"></td>
	</tr>
	<tr>
		<td colspan="5">
		<table width="100%">
			<tr>
				<td><span id="msnerroestorno"></span></td>
				<td align="right" width="140"><input type="button" value="efetuar estorno" id="btnefetuar_estorno" class="botao" style="display:<?=($_CONF ['PERIODO_MAX_ESTORNO'] < $confere_diferenca) ? 'none' : 'block';?>;cursor:pointer;cursor:hand;background-color:green;width:140px;" onclick="javascript:carregar_efetuarestornovenda('vip');"></td>
			</tr>
		</table>
		</td>
	</tr>
</table>

</div>

</div>

