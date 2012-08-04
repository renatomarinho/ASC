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

$dt_h_i = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) );
$dt_d_f = mktime ( 23, 59, 59, date ( 'm' ), date ( 'd' ) + 2, date ( 'Y' ) );

$sql = "SELECT idagendaeventos, inicio FROM rvs_agendaeventos WHERE inicio>" . $dt_h_i . " AND final<" . $dt_d_f . "";
$query = $db->query ( $sql );
$total = $db->num_rows ( $query );

$dt_h_f = mktime ( 23, 59, 59, date ( 'm' ), date ( 'd' ), date ( 'Y' ) );
$dt_a_i = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) + 1, date ( 'Y' ) );
$dt_a_f = mktime ( 23, 59, 59, date ( 'm' ), date ( 'd' ) + 1, date ( 'Y' ) );
$dt_d_i = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) + 2, date ( 'Y' ) );

$hoje = 0;
$amanha = 0;
$depoisdeamanha = 0;

while ( $row = $db->fetch_assoc ( $query ) ) {
	
	$timestamp = $row ['inicio'];
	
	if ($timestamp > $dt_h_i && $timestamp < $dt_h_f)
		$hoje ++;
	else if ($timestamp > $dt_a_i && $timestamp < $dt_a_f)
		$amanha ++;
	else if ($timestamp > $dt_d_i && $timestamp < $dt_d_f)
		$depoisdeamanha ++;

}

$clientesaniver = '';

if (! isset ( $_SESSION ['cliente'] ['timestamp'] )) {
	
	$sqlaniver = "SELECT idcliente, txtnome, dtaniversario FROM cliente WHERE MONTH(dtaniversario)=" . date ( 'm', $dt_h_i ) . " ORDER BY DAY(dtaniversario); ";
	$queryaniver = $db->query ( $sqlaniver );
	$totalaniver = $db->num_rows ( $queryaniver );
	
	$_SESSION ['cliente'] ['timestamp'] = strtotime ( 'now' );
	$_SESSION ['cliente'] ['totalaniver'] = $totalaniver;
	
	$y = 0;
	while ( $rowaniver = $db->fetch_assoc ( $queryaniver ) ) {
		$_SESSION ['cliente'] ['idcliente'] [$y] = $rowaniver ['idcliente'];
		$_SESSION ['cliente'] ['txtnome'] [$y] = $rowaniver ['txtnome'];
		$_SESSION ['cliente'] ['dtaniversario'] [$y] = $rowaniver ['dtaniversario'];
		$data = explode ( '-', $rowaniver ['dtaniversario'] );
		$y ++;
		if ($y < 7)
			$clientesaniver .= '<a href="javascript:;" onclick="javascript:carrega_edicaocliente(\'' . $rowaniver ['idcliente'] . '\')">' . ucwords ( strtolower ( $rowaniver ['txtnome'] ) ) . ' [ dia ' . $data [2] . ' ]</a>  -  ';
	}

} else {
	$totalaniver = $_SESSION['cliente']['totalaniver'];
	if ($totalaniver>1){
		$q = $_SESSION['cliente']['totalaniver'];
		$a = Array ();
		for($y = 0; $y < $q; $y ++) {
			$rand = mt_rand ( 0, ($q - 1) );
			if (! in_array ( $rand, $a )) {
				if (count ( $a ) > 6)
					break;
				$dataaniver = explode ( '-', $_SESSION ['cliente'] ['dtaniversario'] [$rand] );
				$clientesaniver .= '<a href="javascript:;" onclick="javascript:carrega_edicaocliente(\'' . $_SESSION ['cliente'] ['idcliente'] [$rand] . '\')">' . ucwords ( strtolower ( $_SESSION ['cliente'] ['txtnome'] [$rand] ) ) . ' [ dia' . $dataaniver [2] . ' ]</a>  -  ';
				$a [$y] = $rand;
			}
		}
	}
}

?>

<fieldset id="m" style="height: 110px"><legend>Aniversáriantes do Mês</legend>

<div class="ls_conf_M" style="height: 80px">

<table width="100%">
	<tr>
		<td>
		<table width="100%">
			<tr>
				<td><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/aniver_72.png" class="t72"></td>
				<td width="10"></td>
				<td>
				<?
				if ( $totalaniver > 1 ){
				?>
				<table>
					<tr>
						<td><b><?=strtoupper ( $meses [date ( 'n' )] );?> : <?=$totalaniver;?> cliente<?=($totalaniver > 1) ? 's' : '';?></b></td>
					</tr>
					<tr>
						<td><?=substr ( $clientesaniver, 0, - 4 );?></td>
					</tr>
				</table>
				<?
				} else {
				?>
				<b>Nenhum aniversáriante</b>
				<?
				}
				?>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>

</div>

</fieldset>

<fieldset id="m" style="height: 110px"><legend>Agenda de Eventos</legend>

<div class="ls_conf_M" style="height: 80px">

<table width="495">
	<tr>
		<td>
		<table>
			<tr>
				<td><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/calendario_72.png" class="t72"></td>
				<td width="10"></td>
				<td>
								<?
								if ($total > 0) {
									?>
								<table>
					<tr>
						<td><b><?=$dias [date ( 'w', $dt_h_i )];?> (<?=date ( "d/m", $dt_h_i );?>) : <?=$hoje;?> compromisso<?=($hoje > 1) ? 's' : '';?></b></td>
					</tr>
					<tr>
						<td><?=$dias [date ( 'w', $dt_a_i )];?> (<?=date ( 'd/m', $dt_a_i );?>) : <?=$amanha;?> compromisso<?=($amanha > 1) ? 's' : '';?></td>
					</tr>
					<tr>
						<td><?=$dias [date ( 'w', $dt_d_i )];?> (<?=date ( 'd/m', $dt_d_i );?>) : <?=$depoisdeamanha;?> compromisso<?=($depoisdeamanha > 1) ? 's' : '';?></td>
					</tr>
				</table>	
								<?
								} else {
									?>
								<b>Nenhum compromisso agendado</b>
								<?
								}
								?>
							</td>
			</tr>
		</table>
		</td>
		<td align="right" valign="bottom"><input type="button" value="ir para agenda" class="botao" onclick="javascript:Calendar.Starting(<?=date ( 'd' )?>,<?=date ( 'm' )?>,<?=date ( 'Y' )?>);"></td>
	</tr>
</table>

</div>

</fieldset>

<fieldset id="m" style="height: 110px"><legend>Vendas do Dia</legend>

<div class="ls_conf_M" style="height: 80px">

<table width="495">
	<tr>
		<td width="80"><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/vendadia_72.png" class="t72"></td>
		<td width="10"></td>
		<td>
		<table>
			<?
			$sql = "SELECT DISTINCT(txtnome) AS nome, COUNT(*) AS total FROM produto AS p INNER JOIN mv_vendas_movimento AS mvm ON p.idproduto=mvm.id_produto INNER JOIN produtotipo AS pt ON p.produtotipo_idprodutotipo=pt.idprodutotipo GROUP BY pt.idprodutotipo ORDER BY total DESC LIMIT 1";
			$query = $db->query ( $sql );
			$row = $db->fetch_assoc ( $query );
			?>
			<tr>
				<td><b>Categoria mais vendida : <?=$row ['nome'];?> [ <?=$row ['total'];?> vendas ]</b></td>
			</tr>
			<?
			$sql = "SELECT COUNT(mvv.id) AS total, clo.nome FROM mv_vendas AS mvv INNER JOIN cad_login AS clo ON mvv.id_login = clo.id WHERE mvv.data_venda = '" . date ( 'Y-m-d' ) . "' GROUP BY clo.id ORDER BY total DESC LIMIT 1";
			$query = $db->query ( $sql );
			$row = $db->fetch_assoc ( $query );
			if ($row ['total'] > 0) {
				?>
			<tr>
				<td><b><?=numero_extenso ( $row ['total'] );?> venda<?=($row ['total'] > 1) ? 's' : '';?> realizada<?=($row ['total'] > 1) ? 's' : '';?> hoje</b></td>
			</tr>
			<tr>
				<td><b>Vendedor do dia : <?=$row ['nome'];?></b></td>
			</tr>
			<?
			} else {
			?>
			<tr>
				<td><b>Nenhuma venda realizada hoje</b></td>
			</tr>
			<?
			}
			?>
			</table>
		</td>
	</tr>
</table>

</div>

</fieldset>