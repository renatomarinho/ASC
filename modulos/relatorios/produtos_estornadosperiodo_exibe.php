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

$dia1 = (isset ( $_GET ['dia1'] )) ? $validations->validNumeric ( $_GET ['dia1'] ) : date ( 'd' );
$mes1 = (isset ( $_GET ['mes1'] )) ? $validations->validNumeric ( $_GET ['mes1'] ) : date ( 'm' );
$ano1 = (isset ( $_GET ['ano1'] )) ? $validations->validNumeric ( $_GET ['ano1'] ) : date ( 'Y' );

$data_dia1 = $dia1;
$data_mes1 = $mes1;
$data_ano1 = $ano1;
$data1 = date ( 'Y-m-d', mktime ( 0, 0, 0, $data_mes1, $data_dia1, $data_ano1 ) );

$dia2 = (isset ( $_GET ['dia2'] )) ? $validations->validNumeric ( $_GET ['dia2'] ) : date ( 'd' );
$mes2 = (isset ( $_GET ['mes2'] )) ? $validations->validNumeric ( $_GET ['mes2'] ) : date ( 'm' );
$ano2 = (isset ( $_GET ['ano2'] )) ? $validations->validNumeric ( $_GET ['ano2'] ) : date ( 'Y' );

$data_dia2 = $dia2;
$data_mes2 = $mes2;
$data_ano2 = $ano2;
$data2 = date ( 'Y-m-d', mktime ( 0, 0, 0, $data_mes2, $data_dia2, $data_ano2 ) );

if (! isset ( $_GET ['dia1'] )) {
	$data1 = date ( 'Y-m-d', mktime ( 0, 0, 0, date ( 'm' ) - 1, date ( 'd' ), date ( 'Y' ) ) );
	$data2 = date ( 'Y-m-d', mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) ) );
}

$sql = "SELECT DISTINCT(id_produto) FROM mv_vendas_movimento WHERE estornado=1 AND data_venda BETWEEN '" . $data1 . "' AND '" . $data2 . "' ORDER BY data_venda ASC";
$querymv = $db->query ( $sql );

if ($db->num_rows ( $querymv )) {
	?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">	
<?
	$vendidos = 0;
	$total = 0;
	
	while ( $rowmv = $db->fetch_assoc ( $querymv ) ) {
		
		$sql = "SELECT p.txtproduto AS nome, p.idproduto, p.cod_barra FROM produto AS p WHERE p.idproduto=" . $rowmv ['id_produto'] . "";
		$query = $db->query ( $sql );
		
		while ( $rows = $db->fetch_assoc ( $query ) ) {
			
			$sql2 = 'SELECT SUM(vr_total) as total, SUM(quant) as vendidos FROM mv_vendas_movimento WHERE estornado=1 AND id_produto=' . $rows ['idproduto'];
			$query2 = $db->query ( $sql2 );
			$result = $db->fetch_assoc ( $query2 );
			if ($result ['vendidos'] > 0) {
				?>
		<tr>
		<td colspan="5" style="border-bottom: 1px solid #c0c0c0;"></td>
	</tr>
	<tr
		onmouseover="rowOver(this);document.getElementById('produto_<?=$rows ['idproduto'];?>').style.backgroundColor='<?=$_CONF ['bg_row_over'];?>';"
		onmouseout="rowOut(this);document.getElementById('produto_<?=$rows ['idproduto'];?>').style.backgroundColor='<?=$_CONF ['bg_row_out'];?>';"
		style="cursor: pointer; cursor: hand;"
		onclick="javascript:document.getElementById('produto_<?=$rows ['idproduto'];?>').style.display = ((document.getElementById('produto_<?=$rows ['idproduto'];?>').style.display=='none')?'block':'none');">
		<td width="120" align="center"><a href="javascript:;"
			onclick="javascript:carrega_dadosproduto('?refer=listagem&id=<?=$rows ['idproduto'];?>');">[
		hist�rico ]</a></td>
		<td width="100" height="25" align="center"><?=$rows ['cod_barra'];?></td>
		<td height="25"><?=ucwords ( strtolower ( ($rows ['nome']) ) );?></td>
		<td width="140" height="25" align="center"><?=( int ) $result ['vendidos'];?></td>
		<td width="140" height="25" align="center"><?=number_format ( $result ['total'], 2, ',', '.' );?></td>
	</tr>
	<tr>
		<td colspan="5">
		<div id="produto_<?=$rows ['idproduto'];?>" style="display: none;">
		<?
				$sql3 = 'SELECT grade.descricao as nome,SUM(mv.quant) as quantidade FROM mv_vendas_movimento AS mv LEFT JOIN `cad_produtos_grade` AS grade ON grade.id = mv.id_grade WHERE mv.id_grade > 0 AND mv.id_produto = ' . $rows ['idproduto'] . ' AND mv.estornado=1 GROUP BY grade.descricao';
				$query3 = $db->query ( $sql3 );
				while ( $rows3 = $db->fetch_assoc ( $query3 ) ) {
					?>
					<table width="100%">
			<tr>
				<td width="220" height="20"></td>
				<td><?=ucwords ( strtolower ( ($rows3 ['nome']) ) );?></td>
				<td width="140" align="center"><?=( int ) $rows3 ['quantidade'];?></td>
				<td width="135"></td>
				</td>
		
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
	<tr>
		<td colspan="5" style="border-top: 2px solid black">
		<table cellspacing="8" width="100%">
			<tr>
				<td><b>Produtos vendidos : <?=$vendidos;?> itens</b></td>
				<td align="right"><b>Valor das vendas : R$ <?=number_format ( $total, 2, ',', '.' );?></b></td>
			</tr>
		</table>
		</td>
	</tr>
	<table>
<?
} else {
	
	echo exibe_errohtml ( 'Nenhum produto estornado neste per�odo' );

}
?>