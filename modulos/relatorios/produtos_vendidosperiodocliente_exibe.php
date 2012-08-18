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

$data_dia1 = $validations->validNumeric ( $_GET ['dia1'] );
$data_mes1 = $validations->validNumeric ( $_GET ['mes1'] );
$data_ano1 = $validations->validNumeric ( $_GET ['ano1'] );
$data1 = date ( 'Y-m-d', mktime ( 0, 0, 0, $data_mes1, $data_dia1, $data_ano1 ) );

$data_dia2 = $validations->validNumeric ( $_GET ['dia2'] );
$data_mes2 = $validations->validNumeric ( $_GET ['mes2'] );
$data_ano2 = $validations->validNumeric ( $_GET ['ano2'] );
$data2 = date ( 'Y-m-d', mktime ( 0, 0, 0, $data_mes2, $data_dia2, $data_ano2 ) );

if ($data1 == '1999-11-30') {
	$data1 = date ( 'Y-m-d', mktime ( 0, 0, 0, date ( 'm' ) - 1, date ( 'd' ), date ( 'Y' ) ) );
	$data2 = date ( 'Y-m-d', mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) ) );
}

if ($data1 > $data2) {
	$data1 = date ( 'Y-m-d', mktime ( 0, 0, 0, date ( 'm' ) - 1, date ( 'd' ), date ( 'Y' ) ) );
	$data2 = date ( 'Y-m-d', mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) ) );
}

$sql = "SELECT DISTINCT(id_cliente) FROM mv_vendas_movimento WHERE estornado=0 AND data_venda BETWEEN '" . $data1 . "' AND '" . $data2 . "' ORDER BY data_venda ASC";
$querymv = $db->query ( $sql );

if ($db->num_rows ( $querymv )) {
	$cliente_compraram = array ();
	while ( $rowmv = $db->fetch_assoc ( $querymv ) ) {
		$cliente_compraram [] = $rowmv ['id_cliente'];
	}
}

if (isset ( $cliente_compraram )) {
	
	foreach ( $cliente_compraram as $value ) {
		
		$sql = "SELECT idcliente, txtnome FROM cliente WHERE idcliente=" . $value . "";
		$querycliente = $db->query ( $sql );
		
		while ( $rowcliente = $db->fetch_assoc ( $querycliente ) ) {
			
			$sql = "SELECT DISTINCT controle, id_produto FROM mv_vendas_movimento WHERE estornado=0 AND data_venda BETWEEN '" . $data1 . "' AND '" . $data2 . "' AND id_cliente=" . $rowcliente ['idcliente'] . " ORDER BY data_venda ASC";
			$querymv = $db->query ( $sql );
			?>

<table width="100%">
	<tr>
		<td>
		<table width="100%">
			<tr>
				<td><b>Cliente :</b> <a href="javascript:;" onclick="javascript:document.getElementById('produtocliente_<?=$rowcliente ['idcliente'];?>').style.display = ((document.getElementById('produtocliente_<?=$rowcliente ['idcliente'];?>').style.display=='none')?'block':'none');"><b><?=ucwords ( strtolower ( $rowcliente ['txtnome'] ) );?></b></a></td>
				<td align="right"><a href="javascript:;" onclick="javascript:carrega_cliente_mostradadoshistorico('<?=$rowcliente ['idcliente'];?>');">[ hist�rico cliente ]</a></td>
			</tr>
		</table>
		</td>
	</tr>
<?
			if ($db->num_rows ( $querymv )) {
				?>
	<tr>
		<td>
		<div id="produtocliente_<?=$rowcliente ['idcliente'];?>" style="display: none;">
		<table width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td colspan="6" style="border-top: 2px solid black"></td>
			</tr>
			<tr>
				<td width="110"></td>
				<td width="90" height="25" align="center"><b>Data</b></td>
				<td width="110" height="25" align="center"><b>Cód barras</b></td>
				<td height="25"><b>Produto</b></td>
				<td width="140" height="25" align="center"><b>Qtd</b></td>
				<td width="140" height="25" align="center"><b>Valor</b></td>
			</tr>
				<?
				$vendidos = 0;
				$total = 0;
				
				while ( $rowmv = $db->fetch_assoc ( $querymv ) ) {
					
					$sql = "SELECT p.cod_interno, p.txtproduto AS nome, p.idproduto, p.cod_barra FROM produto AS p WHERE p.idproduto=" . $rowmv ['id_produto'] . "";
					$query = $db->query ( $sql );
					
					while ( $rows = $db->fetch_assoc ( $query ) ) {
						$sql2 = "SELECT SUM(vr_total) as total, SUM(quant) as vendidos FROM mv_vendas_movimento WHERE estornado=0 AND controle='" . $rowmv ['controle'] . "' AND id_cliente=" . $rowcliente ['idcliente'] . " AND id_produto = " . $rows ['idproduto'];
						$query2 = $db->query ( $sql2 );
						$result = $db->fetch_assoc ( $query2 );
						if ($result ['vendidos'] > 0) {
							$sql3 = "SELECT data_venda FROM mv_vendas_movimento WHERE estornado = 0 AND controle='" . $rowmv ['controle'] . "' AND id_cliente=" . $rowcliente ['idcliente'] . " AND id_produto = " . $rows ['idproduto'];
							$querymv3 = $db->query ( $sql3 );
							$row_mvdata = $db->fetch_assoc ( $querymv3 );
							$data = $row_mvdata ['data_venda'];
							$explo = explode ( "-", $row_mvdata ['data_venda'] );
							$row_mvdata ['data_venda'] = $explo [2] . '/' . $explo [1] . '/' . $explo [0];
							$rand = mt_rand ( 1, 999999 );
							?>
					<tr>
				<td colspan="6" style="border-bottom: 1px solid #c0c0c0;"></td>
			</tr>
			<tr onmouseover="rowOver(this);document.getElementById('produto_<?=$rows ['idproduto'] . $rand;?>').style.backgroundColor='<?=$_CONF ['bg_row_over'];?>';" onmouseout="rowOut(this);document.getElementById('produto_<?=$rows ['idproduto'] . $rand;?>').style.backgroundColor='<?=$_CONF ['bg_row_out'];?>';" style="cursor: pointer; cursor: hand;" onclick="javascript:document.getElementById('produto_<?=$rows ['idproduto'] . $rand;?>').style.display = ((document.getElementById('produto_<?=$rows ['idproduto'] . $rand;?>').style.display=='none')?'block':'none');">
				<td width="110"><a href="javascript:;" onclick="javascript:carrega_dadosproduto('?refer=listagem&id=<?=$rows ['idproduto'];?>');">[ hist�rico produto ]</a></td>
				<td width="90" height="25" align="center"><?=$row_mvdata ['data_venda'];?></td>
				<td width="110" height="25" align="center"><?=$rows ['cod_barra'];?></td>
				<td height="25"><?=(($rows['cod_interno'])?$rows['cod_interno'].' - ':'').ucwords(strtolower($rows['nome']));?></td>
				<td width="140" height="25" align="center"><?=( int ) $result ['vendidos'];?></td>
				<td width="140" height="25" align="center"><?=number_format ( $result ['total'], 2, ',', '.' );?></td>
			</tr>
					<?
							$sql3 = "SELECT grade.descricao as nome,SUM(mv.quant) as quantidade FROM mv_vendas_movimento AS mv LEFT JOIN `cad_produtos_grade` AS grade ON grade.id = mv.id_grade WHERE mv.id_grade > 0 AND mv.controle='" . $rowmv ['controle'] . "' AND  mv.id_produto = " . $rows ['idproduto'] . " AND mv.id_cliente=" . $rowcliente ['idcliente'] . " AND mv.estornado=0 GROUP BY grade.descricao";
							$query3 = $db->query ( $sql3 );
							?>
					<tr>
				<td colspan="6">
				<div id="produto_<?=$rows ['idproduto'] . $rand;?>"
					style="display: none;">
							<?
							while ( $rows3 = $db->fetch_assoc ( $query3 ) ) {
								?>
								<table>
					<tr>
						<td width="310" colspan="3"></td>
						<td height="25" width="345"><?=ucwords ( strtolower ( $rows3 ['nome'] ) );?></td>
						<td width="80" height="20" align="center"><?=( int ) $rows3 ['quantidade'];?></td>
						<td width="140" height="20"></td>
					</tr>
				</table>
							<?
							}
							?>
							</div>
				</td>
			</tr>
					<?
						}
						
						$vendidos += $result ['vendidos'];
						$total += $result ['total'];
					
					}
				}
				?>	
				</table>
		</div>
		</td>
	</tr>
	<tr>
		<td style="border-top: 2px solid black">
		<table width="100%">
			<tr>
				<td width="30"></td>
				<td><b><?=$vendidos;?> ite<?=($vendidos > 1) ? 'ns' : 'm';?></b></td>
				<td align="right"><b>Total R$ <?=number_format ( $total, 2, ',', '.' );?></b></td>
				<td width="30"></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td colspan="6" height="15"></td>
	</tr>
	<table>	
<?
			}
		
		}
	
	}

} else {
	echo exibe_errohtml ( 'Nenhuma venda encontrada neste período' );
}
?>