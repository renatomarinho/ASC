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

$dia1 = (isset ( $_GET ['diaescolhido1'] )) ? $validations->validNumeric ( $_GET ['diaescolhido1'] ) : date ( 'd' );
$mes1 = (isset ( $_GET ['mesescolhido1'] )) ? $validations->validNumeric ( $_GET ['mesescolhido1'] ) : date ( 'm' );
$ano1 = (isset ( $_GET ['anoescolhido1'] )) ? $validations->validNumeric ( $_GET ['anoescolhido1'] ) : date ( 'Y' );

$data_dia1 = $dia1;
$data_mes1 = $mes1;
$data_ano1 = $ano1;
$data1 = date ( 'Y-m-d', mktime ( 0, 0, 0, $data_mes1, $data_dia1, $data_ano1 ) );

$dia2 = (isset ( $_GET ['diaescolhido2'] )) ? $validations->validNumeric ( $_GET ['diaescolhido2'] ) : date ( 'd' );
$mes2 = (isset ( $_GET ['mesescolhido2'] )) ? $validations->validNumeric ( $_GET ['mesescolhido2'] ) : date ( 'm' );
$ano2 = (isset ( $_GET ['anoescolhido2'] )) ? $validations->validNumeric ( $_GET ['anoescolhido2'] ) : date ( 'Y' );

$data_dia2 = $dia2;
$data_mes2 = $mes2;
$data_ano2 = $ano2;
$data2 = date ( 'Y-m-d', mktime ( 0, 0, 0, $data_mes2, $data_dia2, $data_ano2 ) );

if ($data1==$data2) {
	$data1 = date ( 'Y-m-d', mktime ( 0, 0, 0, date ( 'm' )-30, date ( 'd' ), date ( 'Y' ) ) );
	$data2 = date ( 'Y-m-d', mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) ) );
}

if (isset ( $_GET ['vendedor'] )) {
	$vendedor = $validations->validNumeric ( $_GET ['vendedor'] );
}

$url = '?vendedor='.$vendedor.'&diaescolhido1='.$dia1.'&mesescolhido1='.$mes1.'&anoescolhido1='.$ano1.'&diaescolhido2='.$dia2.'&mesescolhido2='.$mes2.'&anoescolhido2='.$ano2;

require $_CONF ['PATH'] . 'modulos/charts/library/open_flash_chart_object.php';
open_flash_chart_object ( 920, 320, $_CONF ['PATH_VIRTUAL'] . 'modulos/charts/chart_venda_lucratividade_vendedor.php'.$url, false );

exit();

?>

<?
if (! isset ( $_CONF ['PATH'] )) {
	require "../../config/default.php";
}

$validations = new validations ( );
$db = new db ( );
$db->connect ();

/*
$data_dia1 = $validations->validNumeric($_GET['diaescolhido1']);
$data_mes1 = $validations->validNumeric($_GET['mesescolhido1']);
$data_ano1 = $validations->validNumeric($_GET['anoescolhido1']);
$data1 = date('Y-m-d', mktime(0,0,0,$data_mes1,$data_dia1,$data_ano1));

$data_dia2 = $validations->validNumeric($_GET['diaescolhido2']);
$data_mes2 = $validations->validNumeric($_GET['mesescolhido2']);
$data_ano2 = $validations->validNumeric($_GET['anoescolhido2']);
$data2 = date('Y-m-d', mktime(0,0,0,$data_mes2,$data_dia2,$data_ano2));

if ($data1 == '1999-11-30'){
	$data1 = date('Y-m-d', mktime(0,0,0,date('m')-1,date('d'),date('Y')));
	$data2 = date('Y-m-d', mktime(0,0,0,date('m'),date('d'),date('Y')));
}
*/

$dia1 = (isset ( $_GET ['diaescolhido1'] )) ? $validations->validNumeric ( $_GET ['diaescolhido1'] ) : date ( 'd' );
$mes1 = (isset ( $_GET ['mesescolhido1'] )) ? $validations->validNumeric ( $_GET ['mesescolhido1'] ) : date ( 'm' );
$ano1 = (isset ( $_GET ['anoescolhido1'] )) ? $validations->validNumeric ( $_GET ['anoescolhido1'] ) : date ( 'Y' );

$data_dia1 = $dia1;
$data_mes1 = $mes1;
$data_ano1 = $ano1;
$data1 = date ( 'Y-m-d', mktime ( 0, 0, 0, $data_mes1, $data_dia1, $data_ano1 ) );

$dia2 = (isset ( $_GET ['diaescolhido2'] )) ? $validations->validNumeric ( $_GET ['diaescolhido2'] ) : date ( 'd' );
$mes2 = (isset ( $_GET ['mesescolhido2'] )) ? $validations->validNumeric ( $_GET ['mesescolhido2'] ) : date ( 'm' );
$ano2 = (isset ( $_GET ['anoescolhido2'] )) ? $validations->validNumeric ( $_GET ['anoescolhido2'] ) : date ( 'Y' );

$data_dia2 = $dia2;
$data_mes2 = $mes2;
$data_ano2 = $ano2;
$data2 = date ( 'Y-m-d', mktime ( 0, 0, 0, $data_mes2, $data_dia2, $data_ano2 ) );

if (! isset ( $_GET ['diaescolhido1'] )) {
	$data1 = date ( 'Y-m-d', mktime ( 0, 0, 0, date ( 'm' ) - 1, date ( 'd' ), date ( 'Y' ) ) );
	$data2 = date ( 'Y-m-d', mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) ) );
}

if ($data1 > $data2) {
	echo exibe_errohtml ( 'Selecione a data inicial e final corretamente' );
	exit ();
}

if (isset ( $_GET ['vendedor'] )) {
	$vendedor = $validations->validNumeric ( $_GET ['vendedor'] );
}

if (! isset ( $vendedor )) {
	$sql = "SELECT id, nome FROM cad_login ORDER BY nome ASC LIMIT 1";
	$queryvendedor = $db->query ( $sql );
	$rowvendedor = $db->fetch_assoc ( $queryvendedor );
	$vendedor = $rowvendedor ['id'];
} else {
	$sql = "SELECT id, nome FROM cad_login WHERE id=" . $vendedor . "";
	$queryvendedor = $db->query ( $sql );
	$rowvendedor = $db->fetch_assoc ( $queryvendedor );
	$vendedor = $rowvendedor ['id'];
}

$vendedornome = $rowvendedor ['nome'];

$valor_custo_venda = 0;
$total_itens_vendidos = 0;
$total_itens_vendidosvenda = 0;

$valor_total_custo = 0;
$valor_total_adicional = 0;
$valor_total_venda = 0;

$valor_totallucro_real = 0;
$valor_totallucro_porc = 0;

$quantidade_total_vendas = 0;
$media_venda_itens = 0;

$valor_lucrovenda_real = 0;
$valor_lucrovenda_porc = 0;

$sql = "SELECT controle, data_venda, turno, vr_opcionalvenda, vr_totalvenda FROM mv_vendas WHERE id_login=" . $vendedor . " AND data_venda BETWEEN '" . $data1 . "' AND '" . $data2 . "' ORDER BY data_venda ASC";
$query_mvvendas = $db->query ( $sql );

if ($db->num_rows ( $query_mvvendas )) {
	?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr bgcolor="#f0f0f0">
		<td height="25" align="center" id="td_controle_id"><b>Controle</b></td>
		<td height="25" align="center"><b>Data / Produto</b></td>
		<td height="25" align="center"><b>Turno</b></td>
		<td height="25" align="center"><b>Qtd</b></td>
		<td height="25" align="center"><b>Custo</b></td>
		<td height="25" align="center"><b>Opcional</b></td>
		<td height="25" align="center"><b>Venda</b></td>
		<td height="25" align="center"><b>Lucro (R$)</b></td>
		<td height="25" align="center"><b>Lucro (%)</b></td>
	</tr>
<?
	while ( $row_mvvendas = $db->fetch_assoc ( $query_mvvendas ) ) {
		
		$sql2 = "SELECT id_produto, id_grade, estornado, vr_custo, vr_total, quant FROM mv_vendas_movimento WHERE controle=" . $row_mvvendas ['controle'] . "";
		$query_mvvendasmov = $db->query ( $sql2 );
		while ( $row_mvvendasmov = $db->fetch_assoc ( $query_mvvendasmov ) ) {
			$valor_custo_venda += $row_mvvendasmov ['vr_custo'] * $row_mvvendasmov ['quant'];
			$total_itens_vendidosvenda += $row_mvvendasmov ['quant'];
			$total_itens_vendidos += $row_mvvendasmov ['quant'];
		}
		
		$explo = explode ( "-", $row_mvvendas ['data_venda'] );
		$row_mvvendas ['data_venda'] = $explo [2] . '/' . $explo [1] . '/' . $explo [0];
		
		$valor_lucrovenda_real = $row_mvvendas ['vr_totalvenda'] - $valor_custo_venda;
		$valor_lucrovenda_porc = number_format ( ($valor_lucrovenda_real / $valor_custo_venda) * 100, 2 );
		;
		
		?>
	<tr>
		<td colspan="10" style="border-bottom: 1px solid #c0c0c0;"></td>
	</tr>
	<tr onmouseover="rowOver(this);" onmouseout="rowOut(this);">
		<td width="90" align="center" height="25"><?=$row_mvvendas ['controle'];?></td>
		<td width="90" align="center"><?=$row_mvvendas ['data_venda'];?></td>
		<td width="80" align="center"><?=$row_mvvendas ['turno'];?></td>
		<td width="110" align="center"><?=$total_itens_vendidosvenda;?></td>
		<td width="110" align="center"><?=number_format ( $valor_custo_venda, 2, ',', '.' );?></td>
		<td width="110" align="center"><?=number_format ( $row_mvvendas ['vr_opcionalvenda'], 2, ',', '.' );?></td>
		<td width="110" align="center"><?=number_format ( $row_mvvendas ['vr_totalvenda'], 2, ',', '.' );?></td>
		<td width="110" align="center"><?=number_format ( $valor_lucrovenda_real, 2, ',', '.' );?></td>
		<td align="center"><?=number_format ( $valor_lucrovenda_porc, 2, ',', '.' );?></td>
		<td width="5"></td>
	</tr>
	<?
		
		$valor_total_custo += $valor_custo_venda;
		$valor_total_adicional += $row_mvvendas ['vr_opcionalvenda'];
		$valor_total_venda += $row_mvvendas ['vr_totalvenda'];
		$valor_totallucro_real += $valor_lucrovenda_real;
		$valor_custo_venda = 0;
		$total_itens_vendidosvenda = 0;
		$quantidade_total_vendas ++;
	}
	
	$media_venda_itens = $total_itens_vendidos / $quantidade_total_vendas;
	
	?>
	<tr>
		<td colspan="9" style="border-top: 2px solid black" align="center">
		<table>
			<tr>
				<td height="25"><b>Total de vendas : </b><?=$quantidade_total_vendas;?></td>
				<td width="10"></td>
				<td><b>M�dia de itens por venda : </b><?=number_format ( $media_venda_itens, 2 );?></td>
				<td width="10"></td>
				<td><b>Custo : </b>R$ <?=number_format ( $valor_total_custo, 2, ',', '.' );?></td>
				<td width="10"></td>
				<td><b>Opcional : </b>R$ <?=number_format ( $valor_total_adicional, 2, ',', '.' );?></td>
				<td width="10"></td>
				<td><b>Venda : </b>R$ <?=number_format ( $valor_total_venda, 2, ',', '.' );?></td>
				<td width="10"></td>
				<td><b>Lucro : </b>R$ <?=number_format ( $valor_totallucro_real, 2, ',', '.' );?></td>
			</tr>
		</table>
		</td>
	</tr>
</table>

<?
} else {
	
	echo exibe_errohtml ( 'Nenhuma venda realizada pelo vendedor no per�odo selecionado' );

}
?>