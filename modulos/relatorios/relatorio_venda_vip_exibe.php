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

$quantidade_total_vendas = 0;

$sql = "SELECT
vv.controle,
vv.data_venda,
c.txtnome AS cliente,
cl.nome AS vendedor,
p.txtproduto AS produto,
vvm.produto_quantidade AS quantidade
FROM mv_vendas_vip vv
JOIN cliente c ON (c.idcliente = vv.id_cliente)
JOIN mv_vendas_vip_movimento vvm ON (vv.vip_id = vvm.venda_vip_id)
JOIN produto p ON (p.idproduto = vvm.produto_idproduto)
JOIN cad_login cl ON (cl.id = vv.cad_login_id)
WHERE (vv.data_venda BETWEEN '{$data1}' AND '{$data2}' )
ORDER BY vv.data_venda ASC;";

$query_mvvendas = $db->query ( $sql );

if ($db->num_rows ( $query_mvvendas )) {
	?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr bgcolor="#f0f0f0">
		<td height="25" align="center"><b>Controle</b></td>
		<td height="25" align="center"><b>Data</b></td>
		<td height="25" align="center"><b>Cliente</b></td>
		<td height="25" align="center"><b>Vendedor</b></td>
		<td height="25" align="center"><b>Produto</b></td>
		<td height="25" align="center"><b>Quantidade</b></td>
	</tr>
<?
	while ( $row_mvvendas = $db->fetch_assoc ( $query_mvvendas ) ) {
		
		$explo = explode ( "-", $row_mvvendas ['data_venda'] );
		$row_mvvendas ['data_venda'] = $explo [2] . '/' . $explo [1] . '/' . $explo [0];
		
		$valor_custo_venda = $row_mvvendas ['custo'];
		$total_itens_vendidosvenda = $row_mvvendas ['quant'];
		$valor_lucrovenda_real = $row_mvvendas ['lucro_real'];
		$valor_lucrovenda_porc = $row_mvvendas ['lucro_percent'];
		
		?>
	<tr>
		<td style="border-bottom: 1px solid #c0c0c0;" colspan="6"></td>
	</tr>
	<tr class="hover_venda" id="venda_<?=$row_mvvendas ['controle']?>">
		<!--		<td>-->
		<!--			<table width="100%" cellpadding="0" cellspacing="0">-->
		<!--				<tr>-->
		<td align="center" height="25"><?=$row_mvvendas ['controle'];?></td>
		<td align="center"><?=$row_mvvendas ['data_venda'];?></td>
		<td align="center"><?=$row_mvvendas ['cliente'];?></td>
		<td align="center"><?=$row_mvvendas ['vendedor'];?></td>
		<td align="center"><?=$row_mvvendas ['produto'];?></td>
		<td align="center"><?=$row_mvvendas ['quantidade'];?></td>
		<!--				</tr>-->
		<!--			</table>-->
		<!--		</td>-->
	</tr>
	<tr>
		<td colspan="6">
		<div style="display: none;"
			id="itens_venda_<?=$row_mvvendas ['controle']?>"></div>
		</td>
	</tr>

	<?
		$quantidade_total_vendas ++;
	}
	
	$media_venda_itens = $total_itens_vendidos / $quantidade_total_vendas;
	
	//number_format($vr_custo_varejo,2,',','.')
	?>
	<tr>
		<td style="border-top: 2px solid black" align="left" colspan="6">
		<table>
			<tr>
				<td height="25"><b>Total de vendas : </b><?=$quantidade_total_vendas;?></td>
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
		<td align=center><BR> <BR> <BR> <BR> <img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/aviso.png"> <b style="color: red"> <BR> [ Nenhum dado disponível para este período ]</b><BR></td>
	</tr>
<table>
<?
}
?>