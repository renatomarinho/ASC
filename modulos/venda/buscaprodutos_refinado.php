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

$fornecedor = $validations->validNumeric ( $_GET ['f'] );

if ($fornecedor != 0) {
	$sqlfor = " AND f.idfornecedor=" . $fornecedor . " ";
} else {
	$sqlfor = " ";
}

$tipo = $validations->validNumeric ( $_GET ['t'] );

if ($tipo != 0) {
	$sqltipo = " AND pt.idprodutotipo=" . $tipo . " ";
} else {
	$sqltipo = " ";
}

$colecao = $validations->validNumeric ( $_GET ['c'] );

if ($colecao != 0) {
	$sqlcol = " AND col.idcolecao=" . $colecao . " ";
} else {
	$sqlcol = " ";
}

$produto = $validations->validStringForm ( $_GET ['p'] );

//if ( $produto != "" )
//{
$sqlprd = " AND p.txtproduto LIKE '%" . $produto . "%' ";
//} else {
//	$sqlprd = " ";
//}


$opcvenda = $_GET ['o'];
$lista_carrinho = array ();
if (isset ( $_SESSION ['carrinho_venda'] )) {
	$lista_carrinho = $_SESSION ['carrinho_venda'];
}

$sql = "SELECT p.idproduto as idproduto, p.txtproduto, p.vlvarejo as vlvenda, p.vlatacado as vlatacado, p.vlprontaentrega as vlprontaentrega, e.nquantidade FROM produto AS p INNER JOIN estoque AS e ON e.produto_idproduto=p.idproduto LEFT JOIN produtotipo AS pt ON p.produtotipo_idprodutotipo=pt.idprodutotipo LEFT JOIN fornecedor AS f ON p.fornecedor_idfornecedor=f.idfornecedor LEFT JOIN `colecao` as col ON col.idcolecao=p.colecao_idcolecao WHERE p.idproduto>0 " . $sqlfor . $sqltipo . $sqlcol . $sqlprd . " AND e.nquantidade>0 ORDER BY p.txtproduto ASC";

//echo $sql;
$query = $db->query ( $sql );

if ($db->num_rows ( $query )) {
	?>

<table width="100%">
	<tr>
		<td>
		<div id="listaprodutos_refinados"
			style="overflow: auto; width: 500px; height: 288px;">
		<table cellpadding="0" cellspacing="0" border="0">

						<?
	while ( $rows = $db->fetch_assoc ( $query ) ) {
		
		$sqlgrade = "SELECT id, descricao, quantidade, vlprodgrade FROM cad_produtos_grade WHERE id_produto = " . $rows ['idproduto'];
		$querygrade = $db->query ( $sqlgrade );
		while ( $rowgrade = $db->fetch_assoc ( $querygrade ) ) {
			if (isset ( $lista_carrinho ['grade_qtd'] [$rows ['idproduto']] [$rowgrade ['id']] ) && $lista_carrinho ['grade_qtd'] [$rows ['idproduto']] [$rowgrade ['id']] > 0) {
				$rows ['nquantidade'] -= $lista_carrinho ['grade_qtd'] [$rows ['idproduto']] [$rowgrade ['id']];
			}
		}
		
		if (isset ( $lista_carrinho ['produto_quantidadetotal'] [$rows ['idproduto']] ) && $lista_carrinho ['produto_quantidadetotal'] [$rows ['idproduto']] > 0) {
			$rows ['nquantidade'] -= $lista_carrinho ['produto_quantidadetotal'] [$rows ['idproduto']];
		}
		
		$color_red = ($rows ['nquantidade'] == 0) ? 'style="color:red;"' : '';
		?>
							<tr onmouseover="rowOver(this)" onmouseout="rowOut(this)">
				<td width="10"></td>
				<td width="100" height="25"><?=(($color_red == '') ? '<input type="button" onclick="javascript:fechacancelar();carregar_produtoescolhido(\'' . $rows ['idproduto'] . '\')" value="escolher" style="cursor:pointer;cursor:hand;color:black" onmouseover="javascript:this.style.background=\'#6aa9e9\';this.style.color=\'white\';" onmouseout="javascript:this.style.background=\'#FFFFFF\';this.style.color=\'black\';">' : '');?></td>
				<td width="430" height="25" align="left" <?=$color_red;?> ><?=ucwords ( strtolower ( $rows ['txtproduto'] ) );?></td>
							<?
		if ($opcvenda == 'varejo') {
			$valor = $rows ['vlvenda'];
		} else if ($opcvenda == 'pentrega') {
			$valor = $rows ['vlprontaentrega'];
		} else if ($opcvenda == 'atacado') {
			$valor = $rows ['vlatacado'];
		}
		if ($_SESSION['tipovenda']=='normal') {
		?>
				<td width="160" height="25" align="center" <?=$color_red;?>>R$ <?=$valor;?></td>
		<? } ?>		
				<td width="80" height="25" align="center" <?=$color_red;?>><?=$rows ['nquantidade'];?></td>
				<td width="10"></td>
			</tr>
			<tr>
				<td colspan="6" class="l3"></td>
			</tr>
						<?
	}
	?>
					</table>
		</div>
		</td>
	</tr>
	<table>

<?
} else {
	if (isset ( $_GET ['s'] ) && strlen ( $_GET ['s'] )) {
		$_GET ['s'] = '[ ' . $_GET ['s'] . ' ]<BR>';
	} else {
		$_GET ['s'] = '';
	}
	$table = exibe_errohtml ( '' . $_GET ['s'] . ' - n�o encontrado' );
}

?>