<?
header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
header ( "Last-Modified: " . gmdate ( "D,d M YH:i:s" ) . " GMT" );
header ( "Pragma: no-cache" );
header ( "Content-type: application/octet-stream; name=rvs_estoque_todosprodutos" . ".xls" );
header ( "Content-Disposition: attachment; filename=rvs_estoque_todosprodutos" . ".xls" );
header ( "Content-Description: RVS Gerar excel" );

if (! isset ( $_CONF ['PATH'] )) {
	require "../../../config/default.php";
}

$validations = new validations ( );
$db = new db ( );
$db->connect ();

?>
<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td bgcolor="#666666" width="120" align="center"><b
			style="color: white">Cód. Barras</b></td>
		<td bgcolor="#444444" height="20"><b style="color: white">Produto</b></td>
		<td bgcolor="#666666" width="60" align="center"><b
			style="color: white">Qtd</b></td>
		<td bgcolor="#444444" width="90" align="right"><b style="color: white">Custo</b></td>
		<td bgcolor="#666666" width="90" align="right"><b style="color: white">P.
		Entrega</b></td>
		<td bgcolor="#444444" width="90" align="right"><b style="color: white">Atacado</b></td>
		<td bgcolor="#666666" width="90" align="right"><b style="color: white">Varejo</b></td>
	</tr>
<?

$total_custo = 0;
$total_prontaentrega = 0;
$total_atacado = 0;
$total_vlvarejo = 0;
$total_itens = 0;

$sql = "SELECT p.cod_barra, p.idproduto, p.txtproduto, p.vlcusto, p.vlvarejo, p.vlatacado, p.vlprontaentrega, e.nquantidade FROM produto AS p INNER JOIN estoque AS e ON e.produto_idproduto=p.idproduto WHERE e.nquantidade>0 ORDER BY txtproduto ASC";
$query = $db->query ( $sql );

if ($db->num_rows ( $query )) {
	
	while ( $rowprodutos = $db->fetch_assoc ( $query ) ) {
		
		$total_itens += ( int ) $rowprodutos ['nquantidade'];
		
		$sql = "SELECT descricao, quantidade, vlprodgrade FROM cad_produtos_grade WHERE id_produto=" . $rowprodutos ['idproduto'] . " AND quantidade > 0";
		$querygrade = $db->query ( $sql );
		if (! $db->num_rows ( $querygrade )) {
			?>
	<tr>
		<td width="120" height="25" align="center"><b><?=$rowprodutos ['cod_barra'];?></b></td>
		<td><b><?=ucwords ( strtolower ( $rowprodutos ['txtproduto'] ) );?></b></td>
		<td width="60" height="25" align="center"><b><?=( int ) $rowprodutos ['nquantidade'];?></b></td>
		<td width="90" height="25" align="right"><b><?=number_format ( $rowprodutos ['vlcusto'], 2, ',', '.' );?></b></td>
		<td width="90" height="25" align="right"><b><?=number_format ( $rowprodutos ['vlprontaentrega'], 2, ',', '.' );?></b></td>
		<td width="90" height="25" align="right"><b><?=number_format ( $rowprodutos ['vlatacado'], 2, ',', '.' );?></b></td>
		<td width="90" height="25" align="right"><b><?=number_format ( $rowprodutos ['vlvarejo'], 2, ',', '.' );?></b></td>
	</tr>
	<?
		} else {
			?>
	<tr>
		<td width="120" height="25" align="center"><b><?=$rowprodutos ['cod_barra'];?></b></td>
		<td><b><?=ucwords ( strtolower ( $rowprodutos ['txtproduto'] ) );?></b></td>
		<td width="60" height="25" align="center"><b><?=( int ) $rowprodutos ['nquantidade'];?></b></td>
		<td width="90" height="25" align="right"><b><?=number_format ( $rowprodutos ['vlcusto'], 2, ',', '.' );?></b></td>
		<td width="90" height="25" align="right"><b><?=number_format ( $rowprodutos ['vlprontaentrega'], 2, ',', '.' );?></b></td>
		<td width="90" height="25" align="right"><b><?=number_format ( $rowprodutos ['vlatacado'], 2, ',', '.' );?></b></td>
		<td width="90" height="25" align="right"><b><?=number_format ( $rowprodutos ['vlvarejo'], 2, ',', '.' );?></b></td>
	
	<?
		}
		
		if ($db->num_rows ( $querygrade )) {
			
			while ( $rowgrade = $db->fetch_assoc ( $querygrade ) ) {
				?>
	
	
	
	<tr>
		<td width="120"></td>
		<td width="235"><?=ucwords ( strtolower ( $rowgrade ['descricao'] ) );?></td>
		<td width="90" height="25" align="center"><?=( int ) $rowgrade ['quantidade'];?></td>		
		<?
				if ($rowgrade ['vlprodgrade'] > 0) {
					$total_custo += $rowgrade ['vlprodgrade'] * $rowgrade ['quantidade'];
					$total_prontaentrega += $rowgrade ['vlprodgrade'] * $rowgrade ['quantidade'];
					$total_atacado += $rowgrade ['vlprodgrade'] * $rowgrade ['quantidade'];
					$total_vlvarejo += $rowgrade ['vlprodgrade'] * $rowgrade ['quantidade'];
					?>
		<td align="center">
			Vl único dif. : <?=number_format ( $rowgrade ['vlprodgrade'], 2, ',', '.' );?></td>
		</td>
		<?
				} else {
					$total_custo += $rowprodutos ['vlcusto'] * $rowgrade ['quantidade'];
					$total_prontaentrega += $rowprodutos ['vlprontaentrega'] * $rowgrade ['quantidade'];
					$total_atacado += $rowprodutos ['vlatacado'] * $rowgrade ['quantidade'];
					$total_vlvarejo += $rowprodutos ['vlvarejo'] * $rowgrade ['quantidade'];
					?>
			<td></td>
		<?
				}
				?>
		
		<td></td>
		<td></td>
		<td></td>
	<?
			}
			?>
		</td>
	</tr>
	<?
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
	<tr>
		<td colspan="7" style="border-bottom: 1px solid #c0c0c0;"></td>
	</tr>
	<tr>
		<td colspan="7">
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
</table>
<?
}
?>