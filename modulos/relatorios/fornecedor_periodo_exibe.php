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

$fornecedor_id = $_REQUEST ['fornecedor_id'];

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

/*
 -- possivel query
SELECT p.txtproduto AS produto, p.grade, e.nquantidade AS quantidade_estoque,
SUM( CASE WHEN vm.estornado = 1 THEN vm.quant END ) AS quantidade_estornado,
SUM( CASE WHEN vm.estornado = 0 THEN vm.quant END ) AS quantidade_vendida

FROM fornecedor f
JOIN produto p ON (p.fornecedor_idfornecedor = f.idfornecedor)
JOIN estoque AS e ON (e.produto_idproduto = p.idproduto)
LEFT JOIN produtotipo AS pt ON (p.produtotipo_idprodutotipo = pt.idprodutotipo)
JOIN colecao as col ON (col.idcolecao = p.colecao_idcolecao)
LEFT JOIN mv_vendas_movimento vm ON (vm.id_produto = p.idproduto)
WHERE f.idfornecedor = 16
GROUP BY p.txtproduto
ORDER BY p.txtproduto ASC

*/

$sql = "SELECT p.idproduto, p.txtproduto AS produto, p.grade, e.nquantidade AS quantidade_estoque,
SUM( CASE WHEN vm.estornado = 0 THEN vm.quant END ) AS quantidade_vendida,
SUM( CASE WHEN vm.estornado = 1 THEN vm.quant END ) AS quantidade_estornado
FROM fornecedor f
JOIN produto p ON (p.fornecedor_idfornecedor = f.idfornecedor)
JOIN estoque AS e ON (e.produto_idproduto = p.idproduto)
LEFT JOIN produtotipo AS pt ON (p.produtotipo_idprodutotipo = pt.idprodutotipo)
JOIN colecao as col ON (col.idcolecao = p.colecao_idcolecao)
LEFT JOIN mv_vendas_movimento vm ON (vm.id_produto = p.idproduto)
WHERE f.idfornecedor = {$fornecedor_id}
AND vm.data_venda BETWEEN '{$data1}' AND '{$data2}'
GROUP BY p.txtproduto
ORDER BY p.txtproduto ASC";

$rs_fornecedor_produtos = $db->query ( $sql );

if ($fornecedor_id <= 0) {
	echo exibe_errohtml ( 'Selecione um fornecedor.' );
	exit ();
}

if ($db->num_rows ( $rs_fornecedor_produtos )) {
	?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr bgcolor="#f0f0f0">
		<td height="25" align="center"><strong>Produto / Grade</strong></td>
		<td height="25" align="center"><strong>Quantidade em Estoque</strong></td>
		<td height="25" align="center"><strong>Quantidade Vendida</strong></td>
		<td height="25" align="center"><strong>Quantidade Estornado</strong></td>
	</tr>
<?
	$total_estoque = 0;
	$total_vendidos = 0;
	$total_estornado = 0;
	
	while ( $row_fornecedor = $db->fetch_assoc ( $rs_fornecedor_produtos ) ) {
		
		?>
		<tr>
		<td colspan="7" style="border-bottom: 1px solid #c0c0c0;"></td>
	</tr>
	<!--		<tr onmouseover="rowOver(this);document.getElementById('produto_<?=$rows ['idproduto'];?>').style.backgroundColor='<?=$_CONF ['bg_row_over'];?>';" onmouseout="rowOut(this);document.getElementById('produto_<?=$rows ['idproduto'];?>').style.backgroundColor='<?=$_CONF ['bg_row_out'];?>';" style="cursor:pointer;cursor:hand;">-->
	<tr
		onmouseover="rowOver(this);document.getElementById('fornecedor_<?=$row_fornecedor ['idproduto'];?>').style.backgroundColor='<?=$_CONF ['bg_row_over'];?>';"
		onmouseout="rowOut(this);document.getElementById('fornecedor_<?=$row_fornecedor ['idproduto'];?>').style.backgroundColor='<?=$_CONF ['bg_row_out'];?>';"
		style="cursor: pointer; cursor: hand;"
		onclick="javascript:document.getElementById('fornecedor_<?=$row_fornecedor ['idproduto'];?>').style.display = ((document.getElementById('fornecedor_<?=$row_fornecedor ['idproduto'];?>').style.display=='none')?'block':'none');">
		<td align="center"><?=ucwords ( strtolower ( ($row_fornecedor ['produto']) ) )?></td>
		<td height="25" align="center"><?=$row_fornecedor ['quantidade_estoque']?></td>
		<td height="25" align="center"><?=$row_fornecedor ['quantidade_vendida']?></td>
		<td height="25" align="center"><?=$row_fornecedor ['quantidade_estornado']?></td>
	</tr>
	<tr>
		<td colspan="7">
		<div id="fornecedor_<?=$row_fornecedor ['idproduto'];?>"
			style="display: none;">
<?
		
		$sql_grade = "SELECT g.descricao, g.quantidade,
SUM( CASE WHEN vm.estornado = 0 THEN vm.quant ELSE 0 END ) AS quantidade_vendida,
SUM( CASE WHEN vm.estornado = 1 THEN vm.quant ELSE 0 END ) AS quantidade_estornado
from cad_produtos_grade g
LEFT JOIN mv_vendas_movimento vm ON (g.id_produto = vm.id_produto AND g.id = vm.id_grade)
where g.id_produto = " . $row_fornecedor ['idproduto'] . "
GROUP BY g.id";
		$rs_grade = $db->query ( $sql_grade );
		
		while ( $row_grade = $db->fetch_assoc ( $rs_grade ) ) {
			?>
					<table width="100%">
			<tr>
				<td width="250" align="center"><?=ucwords ( strtolower ( ($row_grade ['descricao']) ) );?> </td>
				<td width="150" height="25" align="center"><?=$row_grade ['quantidade']?></td>
				<td width="150" height="25" align="center"><?=$row_grade ['quantidade_vendida']?></td>
				<td width="150" height="25" align="center"><?=$row_grade ['quantidade_estornado']?></td>
				</td>
		
		</table>
<?
		}
		?>
				</div>
		</td>
	</tr>
	<?
		
		$total_estoque += $row_fornecedor ['quantidade_estoque'];
		$total_vendidos += $row_fornecedor ['quantidade_vendida'];
		$total_estornado += $row_fornecedor ['quantidade_estornado'];
	}
	?>
	<tr>
		<td colspan="7" style="border-top: 2px solid black">
		<table cellspacing="8" width="100%">
			<tr>
				<td><b>Total em estoque : <?=$total_estoque;?> itens</b></td>
				<td><b>Produtos vendidos : <?=$total_vendidos;?> itens</b></td>
				<td><b>Produtos estornados : <?=$total_estornado;?> itens</b></td>
				<!--					<td align="right"><b>Valor das vendas : R$ <?=number_format ( $total, 2, ',', '.' );?></b></td>-->
			</tr>
		</table>
		</td>
	</tr>
	<table>
<?
} else {
	
	echo exibe_errohtml ( 'N�o existem dados para o fornecedor neste per�odo' );

}
?>