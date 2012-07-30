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

$cliente_id = $_GET['cliente_id'];

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

$url = '?cliente_id='.$cliente_id.'&dia1='.$dia1.'&mes1='.$mes1.'&ano1='.$ano1.'&dia2='.$dia2.'&mes2='.$mes2.'&ano2='.$ano2;

require $_CONF ['PATH'] . 'modulos/charts/library/open_flash_chart_object.php';
open_flash_chart_object ( 920, 320, $_CONF ['PATH_VIRTUAL'] . 'modulos/charts/chart_clientes_vendidosperiodo.php'.$url, false );

exit();

if (! isset ( $_GET ['dia1'] )) {
	$data1 = date ( 'Y-m-d', mktime ( 0, 0, 0, date ( 'm' ) - 1, date ( 'd' ), date ( 'Y' ) ) );
	$data2 = date ( 'Y-m-d', mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) ) );
}



$sql = "SELECT vm.data_venda, vm.controle, p.txtproduto AS produto, p.vlcusto AS custo, vm.quant AS quantidade, v.vr_totalvenda AS total_venda, l.nome AS vendedor, pg.descricao AS grade_descricao,
 (SELECT SUM(quant) FROM mv_vendas_movimento WHERE controle = v.controle) as quantidade_total
FROM cliente c
JOIN mv_vendas v ON (v.id_cliente = c.idcliente)
JOIN mv_vendas_movimento vm ON (vm.id_cliente = c.idcliente AND vm.controle = v.controle)
LEFT JOIN cad_produtos_grade pg ON (pg.id = vm.id_grade)
JOIN produto p ON (p.idproduto = vm.id_produto)
JOIN cad_login l ON (l.id = vm.id_login )
WHERE c.idcliente = {$cliente_id} AND vm.estornado=0
AND vm.data_venda BETWEEN '{$data1}' AND '{$data2}'
GROUP BY vm.controle, p.txtproduto, pg.descricao
ORDER BY vm.data_venda DESC";
$rs_clientes_produtos = $db->query ( $sql );

if ($cliente_id <= 0) {
	echo exibe_errohtml ( 'Selecione um cliente.' );
	exit ();
}

if ($db->num_rows ( $rs_clientes_produtos )) {
	?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">

	<tr bgcolor="#f0f0f0">
		<td height="25" align="center"><strong>Data</strong></td>
		<td height="25" align="center"><strong>Controle</strong></td>
		<td height="25" align="center"><strong>Produto</strong></td>
		<!--	<td height="25" align="center"><strong>Valor Unit�rio</strong></td>-->
		<td height="25" align="center"><strong>Qtd.</strong></td>
		<td height="25" align="center"><strong>Valor Total</strong></td>
		<td height="25" align="center"><strong>Vendedor</strong></td>
	</tr>

<?
	$vendidos = 0;
	$total = 0;
	
	$_vendas = array ();
	$controle_tmp = "";
	while ( $row_cliente = $db->fetch_assoc ( $rs_clientes_produtos ) ) {
		if (! in_array ( $row_cliente ['controle'], $_vendas )) {
			
			$vendidos += $row_cliente ['quantidade_total'];
			$total += $row_cliente ['total_venda'];
			?>
		<tr>
		<td colspan="7" style="border-bottom: 1px solid #c0c0c0;"></td>
	</tr>
	<!--		<tr onmouseover="rowOver(this);document.getElementById('produto_<?=$rows ['idproduto'];?>').style.backgroundColor='<?=$_CONF ['bg_row_over'];?>';" onmouseout="rowOut(this);document.getElementById('produto_<?=$rows ['idproduto'];?>').style.backgroundColor='<?=$_CONF ['bg_row_out'];?>';" style="cursor:pointer;cursor:hand;">-->
	<tr class="show_cliente_itens" id="<?=$row_cliente ['controle'];?>">
		<td align="center"><?=$row_cliente ['data_venda']?></td>
		<td height="25" align="center"><?=$row_cliente ['controle']?></td>
		<td>&nbsp;</td>
		<!--			<td width="80" height="25" align="center"><?=$row_cliente ['custo']?></td>-->
		<td height="25" align="center"><?=$row_cliente ['quantidade_total']?></td>
		<td height="25" align="center"><?=number_format ( $row_cliente ['total_venda'], 2, ',', '.' );?></td>
		<td height="25" align="center"><?=$row_cliente ['vendedor']?></td>
	</tr>
<?
		}
		
		if (! in_array ( $row_cliente ['controle'], $_vendas ) || $controle_tmp == $row_cliente ['controle']) {
			?>
		<tr id="cliente_<?=$row_cliente ['controle'];?>" class="show_export">
		<td align="center">&nbsp;</td>
		<td height="25" align="center">&nbsp;</td>
		<td><?=ucwords ( strtolower ( ($row_cliente ['produto']) ) );?> (<?=$row_cliente ['grade_descricao']?>)</td>
		<td height="25" align="center"><?=$row_cliente ['quantidade']?></td>
		<td height="25" align="center">&nbsp;</td>
		<td height="25" align="center">&nbsp;</td>
	</tr>
<?
		}
		
		// variaveis temp
		array_push ( $_vendas, $row_cliente ['controle'] );
		$controle_tmp = $row_cliente ['controle'];
	}
	?>
	<tr>
		<td colspan="7" style="border-top: 2px solid black">
		<table cellspacing="8" width="100%">
			<tr>
				<td><b>Produtos vendidos : <?=$vendidos;?> itens</b></td>
				<td align="right"><b>Valor das vendas : R$ <?=number_format ( $total, 2, ',', '.' );?></b></td>
			</tr>
		</table>
		</td>
	</tr>
</table>
<?
} else {
	
	echo exibe_errohtml ( 'Nenhum produto vendido para o cliente neste per�odo' );

}
?>