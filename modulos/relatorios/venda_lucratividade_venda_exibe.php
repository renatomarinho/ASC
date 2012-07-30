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

$dia1 = (isset ( $_GET ['diaescolhido1'] )) ? $validations->validNumeric($_GET ['diaescolhido1']) : date ( 'd' );
$mes1 = (isset ( $_GET ['mesescolhido1'] )) ? $validations->validNumeric($_GET ['mesescolhido1']) : date ( 'm' );
$ano1 = (isset ( $_GET ['anoescolhido1'] )) ? $validations->validNumeric($_GET ['anoescolhido1']) : date ( 'Y' );

$dia2 = (isset ( $_GET ['diaescolhido2'] )) ? $validations->validNumeric($_GET ['diaescolhido2']):date('d');
$mes2 = (isset ( $_GET ['mesescolhido2'] )) ? $validations->validNumeric($_GET ['mesescolhido2']):date('m');
$ano2 = (isset ( $_GET ['anoescolhido2'] )) ? $validations->validNumeric($_GET ['anoescolhido2']):date('Y');

$url = '?diaescolhido1='.$dia1.'&mesescolhido1='.$mes1.'&anoescolhido1='.$ano1.'&diaescolhido2='.$dia2.'&mesescolhido2='.$mes2.'&anoescolhido2='.$ano2;

require $_CONF ['PATH'] . 'modulos/charts/library/open_flash_chart_object.php';
open_flash_chart_object ( 920, 320, $_CONF ['PATH_VIRTUAL'] . 'modulos/charts/chart_vendalucratividade.php'.$url, false );

exit();

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

$total_estorno = 0.00;

$sql = "SELECT
v.controle,
v.data_venda,
v.turno,
c.txtnome AS cliente,
sum(vm.quant) as quant,
sum((vm.quant * vm.vr_custo)) as custo,
v.vr_opcionalvenda,
v.vr_totalvenda,
(v.vr_totalvenda - sum((vm.quant * vm.vr_custo))) as lucro_real,
round( (((v.vr_totalvenda - sum((vm.quant * vm.vr_custo))) / sum((vm.quant * vm.vr_custo))) * 100), 2) as lucro_percent
FROM mv_vendas v
-- JOIN mv_vendas_movimento vm ON (v.controle = vm.controle AND vm.estornado = 0)
LEFT JOIN cliente c on (c.idcliente = v.id_cliente)
JOIN mv_vendas_movimento vm ON (v.controle = vm.controle)
WHERE (v.data_venda BETWEEN '{$data1}' AND '{$data2}' )
group by v.controle
ORDER BY v.data_venda ASC;
";

//old query SELECT controle, data_venda, turno, vr_opcionalvenda, vr_totalvenda FROM mv_vendas WHERE data_venda BETWEEN '".$data1."' AND '".$data2."' ORDER BY data_venda ASC


$query_mvvendas = $db->query ( $sql );

if ($db->num_rows ( $query_mvvendas )) {
	?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">

	<tr bgcolor="#f0f0f0">
		<td height="25" width="100" align="center" id="td_controle_id"><b>Controle</b></td>
		<td height="25" align="center"><b>Data / Produto</b></td>
		<td height="25" align="center"><b>Cliente</b></td>
		<td height="25" width="55" align="center"><b>Qtd</b></td>
		<td height="25" width="55" align="center"><b>Custo</b></td>
		<td height="25" width="55" align="center"><b>Opcional</b></td>
		<td height="25" width="55" align="center"><b>Venda</b></td>
		<td height="25" width="65" align="center"><b>Lucro (R$)</b></td>
		<td height="25" width="65" align="center"><b>Lucro (%)</b></td>
	</tr>


<?
	while ( $row_mvvendas = $db->fetch_assoc ( $query_mvvendas ) ) {
		
		$explo = explode ( "-", $row_mvvendas ['data_venda'] );
		$row_mvvendas ['data_venda'] = $explo [2] . '/' . $explo [1] . '/' . $explo [0];
		
		$valor_custo_venda = $row_mvvendas ['custo'];
		$total_itens_vendidosvenda = $row_mvvendas ['quant'];
		$valor_lucrovenda_real = $row_mvvendas ['lucro_real'];
		$valor_lucrovenda_porc = $row_mvvendas ['lucro_percent'];
		
		$sql3 = "select p.txtproduto AS nome,
						v.turno,
						c.txtnome AS cliente,
						sum(vm.quant) as quant,
						sum((vm.quant * vm.vr_custo)) as custo,
						case when vm.estornado != 0 then sum((vm.quant * vm.vr_custo)) else 0.00 end as valor_estorno,
						vm.estornado,
						vm.vr_opcional,
						sum(vm.vr_total) as valor_total_item,

						(vm.vr_total - sum((vm.quant * vm.vr_custo))) as lucro_real,
						round( (((vm.vr_total - sum((vm.quant * vm.vr_custo))) / sum((vm.quant * vm.vr_custo))) * 100), 2) as lucro_percent

						-- sum(v.vr_totalvenda)

						from mv_vendas_movimento vm

						join produto p on (p.idproduto = vm.id_produto)
						join mv_vendas v on (v.controle = vm.controle)
						LEFT JOIN cliente c on (c.idcliente = v.id_cliente)
						where vm.controle = " . $row_mvvendas ['controle'] . "
						group by nome, estornado";
		
		$query3 = $db->query ( $sql3 );
		
		$lista_itens = array ();
		$quantidade_acumulado_principal = "";
		$custo_acumulado_principal = "";
		$opcional_acumulado_principal = "";
		$venda_acumulado_principal = "";
		$lucro_acumulado_principal = "";
		$lucro_percent_acumulado_principal = "";
		while ( $_rows = $db->fetch_assoc ( $query3 ) ) {
			$lista_itens [] = $_rows;
			
			// DADOS PARA REPRESNTAR O ACUMULADO
			if ($_rows ['estornado'] > 0) {
				$quantidade_acumulado_principal = "&nbsp;<span class=\"t_mark\">(" . $_rows ['quant'] . ")</span>";
				$custo_acumulado_principal = "&nbsp;<span class=\"t_mark\">(" . number_format ( $_rows ['custo'], 2, ',', '.' ) . ")</span>";
				$opcional_acumulado_principal = "&nbsp;<span class=\"t_mark\">(" . number_format ( $_rows ['vr_opcional'], 2, ',', '.' ) . ")</span>";
				$venda_acumulado_principal = "&nbsp;<span class=\"t_mark\">(" . number_format ( $_rows ['valor_total_item'], 2, ',', '.' ) . ")</span>";
				$lucro_acumulado_principal = "&nbsp;<span class=\"t_mark\">(" . number_format ( $_rows ['lucro_real'], 2, ',', '.' ) . ")</span>";
				$lucro_percent_acumulado_principal = "&nbsp;<span class=\"t_mark\">(" . number_format ( $_rows ['lucro_percent'], 2, ',', '.' ) . ")</span>";
			}
		
		}
		
		?>
	<!-- 
	<tr>
		<td style="border-bottom: 1px solid #c0c0c0;" colspan="9"></td>
	</tr>
	<tr class="show_venda_itens" id="venda_<?=$row_mvvendas ['controle']?>">

		<td align="center" height="25"><?=$row_mvvendas ['controle'];?></td>
		<td align="center"><?=$row_mvvendas ['data_venda'];?></td>
		<td align="center"><?=$row_mvvendas ['cliente'];?></td>
		<td align="center"><?=$total_itens_vendidosvenda . $quantidade_acumulado_principal;?></td>
		<td align="center"><?=number_format ( $valor_custo_venda, 2, ',', '.' ) . $custo_acumulado_principal;?></td>
		<td align="center"><?=number_format ( $row_mvvendas ['vr_opcionalvenda'], 2, ',', '.' ) . $opcional_acumulado_principal;?></td>
		<td align="center"><?=number_format ( $row_mvvendas ['vr_totalvenda'], 2, ',', '.' ) . $venda_acumulado_principal;?></td>
		<td align="center"><?=number_format ( $valor_lucrovenda_real, 2, ',', '.' ) . $lucro_acumulado_principal;?></td>
		<td align="center"><?=number_format ( $valor_lucrovenda_porc, 2, ',', '.' ) . $lucro_percent_acumulado_principal;?></td>

	</tr>
	 -->
	<?
		foreach ( $lista_itens as $rows3 ) {
			// acumulando estorno
			$total_estorno += $rows3 ['valor_estorno'];
			
			$class = "";
			if ($rows3 ['estornado'] > 0) {
				$class = "t_mark";
			}
			
			?>
	<!-- 
	<tr align="center" height="25" class="show_export" id="itens_venda_<?=$row_mvvendas ['controle']?>">
		<td class="<?=$class?>"></td>
		<td class="<?=$class?>"><?=ucwords ( strtolower ( ($rows3 ['nome']) ) );?></td>
		<td class="<?=$class?>"><?=$rows3 ['cliente'];?></td>
		<td class="<?=$class?>"><?=( int ) $rows3 ['quant'];?></td>
		<td class="<?=$class?>"><?=number_format ( $rows3 ['custo'], 2, ',', '.' );?></td>
		<td class="<?=$class?>"><?=number_format ( $rows3 ['vr_opcional'], 2, ',', '.' );?></td>
		<td class="<?=$class?>"><?=number_format ( $rows3 ['valor_total_item'], 2, ',', '.' );?></td>
		<td class="<?=$class?>"><?=number_format ( $rows3 ['lucro_real'], 2, ',', '.' );?></td>
		<td class="<?=$class?>"><?=number_format ( $rows3 ['lucro_percent'], 2, ',', '.' );?></td>
	</tr>
	 -->
		<?
		}
		
		$valor_total_custo += $valor_custo_venda;
		$valor_total_adicional += $row_mvvendas ['vr_opcionalvenda'];
		$valor_total_venda += $row_mvvendas ['vr_totalvenda'];
		$valor_totallucro_real += $valor_lucrovenda_real;
		$valor_custo_venda = 0;
		$total_itens_vendidosvenda = 0;
		$quantidade_total_vendas ++;
	}
	
	$media_venda_itens = $total_itens_vendidos / $quantidade_total_vendas;
	
	//number_format($vr_custo_varejo,2,',','.')
	?>
	<tr>
		<td style="border-top: 2px solid black" align="center" colspan="9">
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
				<td width="10"></td>
				<td><b>Estorno : </b>R$ <?=number_format ( $total_estorno, 2, ',', '.' );?></td>
			</tr>
		</table>
		</td>
	</tr>
</table>

<?
} else {
	?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td align=center><BR><BR><BR><BR><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/aviso.png"> <b style="color: red"> <BR> [ Nenhum dado dispon�vel para este per�odo ]<BR></b></td>
	</tr>
<table>
<?
}
?>