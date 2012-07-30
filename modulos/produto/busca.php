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

$fornecedor = $_GET ['f'];

if (! isset ( $_GET ['order'] )) {
	$_GET ['order'] = "ASC";
}

if ($fornecedor != 0) {
	$sqlfor = " AND f.idfornecedor=" . $_GET ['f'] . " ";
} else {
	$sqlfor = "";
}

$tipo = $_GET ['t'];

if ($tipo != 0) {
	$sqltipo = " AND pt.idprodutotipo=" . $_GET ['t'] . " ";
} else {
	$sqltipo = "";
}

$colecao = $_GET ['col'];

if ($colecao != 0) {
	$sqlcol = " AND col.idcolecao=" . $_GET ['col'] . " ";
} else {
	$sqlcol = "";
}

if (isset ( $_GET ['z'] )) {
	$sqlqt = " AND e.nquantidade != " . $_GET ['z'] . " ";
} else {
	$sqlqt = "";
}

$quant = $_GET ['quant'];

$sql = "SELECT p.idproduto, p.cod_interno, p.txtproduto, p.vlvarejo as vlvenda, e.nquantidade, col.txtnome as colecao, p.cod_barra
FROM  produto AS p
INNER JOIN estoque AS e ON e.produto_idproduto=p.idproduto
LEFT JOIN produtotipo AS pt ON  p.produtotipo_idprodutotipo=pt.idprodutotipo
LEFT JOIN fornecedor AS f ON p.fornecedor_idfornecedor=f.idfornecedor
LEFT JOIN `colecao` as col ON col.idcolecao = p.colecao_idcolecao
WHERE e.nquantidade >= " . $quant . "
AND p." . $_GET ['c'] . " LIKE '%" . $_GET ['s'] . "%' " . $sqlfor . " " . $sqltipo . " " . $sqlqt . " " . $sqlcol . "
ORDER BY " . $_GET ['c2'] . " " . $_GET ['order'];

//echo $sql;
$query = $db->query ( $sql );

if ($db->num_rows ( $query )) {
	?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td colspan="6" class="l3"></td>
	</tr>
	<?
	while ( $rows = $db->fetch_assoc ( $query ) ) {
		$color_red = ($rows ['nquantidade'] == 0) ? 'style="color:red;"' : '';
		?>
		<tr style="cursor: pointer; cursor: hand;" onmouseover="rowOver(this)" onmouseout="rowOut(this)">
		<td width="140" height="25" align="center" <?=$color_red;?> onclick="javascript:carrega_dadosproduto('?refer=listagem&id=<?=$rows ['idproduto'];?>');"><?=$rows ['cod_barra'];?></td>
		<td width="400" height="25" align="left" <?=$color_red;?> onclick="javascript:carrega_dadosproduto('?refer=listagem&id=<?=$rows ['idproduto'];?>');"><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/produto_22.png" class="t22" align="absmiddle"> <?=(($rows['cod_interno'])?$rows['cod_interno'].' - ':'').ucwords(strtolower($rows['txtproduto']));?></td>
		<td width="220" height="25" align="left" <?=$color_red;?> onclick="javascript:carrega_dadosproduto('?refer=listagem&id=<?=$rows ['idproduto'];?>');"><?=qtdCaracteres ( ucwords ( strtolower ( $rows ['colecao'] ) ), 25 );?></td>
		<td width="160" height="25" align="right" <?=$color_red;?> onclick="javascript:carrega_dadosproduto('?refer=listagem&id=<?=$rows ['idproduto'];?>');">R$ <?=$rows ['vlvenda'];?></td>
		<td width="150" height="25" align="center" <?=$color_red;?> onclick="javascript:carrega_dadosproduto('?refer=listagem&id=<?=$rows ['idproduto'];?>');"><?=$rows ['nquantidade'];?> itens</td>
		<td width="100" height="25"><?=(($color_red != '') ? "<input type=\"button\" onclick=\"javascript:carrega_editarproduto('?refer=listagem&id=" . $rows ['idproduto'] . "');\" value='add itens' style='cursor:pointer;cursor:hand;' onmouseover=\"javascript:this.style.background='#c0c0c0'\" onmouseout=\"javascript:this.style.background='#FFFFFF'\">" : '');?></td>
	</tr>
	<tr>
		<td colspan="6" class="l3"></td>
	</tr>
	<?
	}
	?>
	</table>
	<?
} else {
	
	$sql = "SELECT idproduto FROM produto";
	$queryproduto = $db->query ( $sql );
	$totalprodutos = $db->num_rows ( $queryproduto );
	
	if ($totalprodutos == 0) {
		echo exibe_errohtml ( 'N�o possui nenhum produto cadastrado' );
	} else {
		echo exibe_errohtml ( '' . $_GET ['s'] . ' - n�o encontrado');
	}

}
?>