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

/*
 * FIXME Change cad_empresa_id to dinamic id
 */

$sql = "SELECT reducao_estoque AS auth FROM configuracao WHERE cad_empresa_id=1";
$query = $db->query($sql);
$row = $db->fetch_assoc($query);
$auth = $row['auth'];

$idproduto = $validations->validNumeric ( $_GET ['id'] );

if (isset ( $_GET ['add_nomegrade'] ) && isset ( $_GET ['add_qtdgrade'] )) {
	
	$add_nomegrade = $validations->validStringForm ( $_GET ['add_nomegrade'] );
	$add_qtdgrade = $validations->validNumeric ( $_GET ['add_qtdgrade'] );
	$add_precounico = $validations->validStringForm ( $_GET ['add_precounico'] );
	
	$sql = "INSERT INTO cad_produtos_grade ( id_produto, descricao, quantidade, vlprodgrade ) VALUES ( " . $idproduto . ", '" . strtoupper ( $add_nomegrade ) . "', " . $add_qtdgrade . ", '" . $add_precounico . "' )";
	$db->query ( $sql );
	
	$sql = "UPDATE estoque SET nquantidade=nquantidade+" . $add_qtdgrade . " WHERE produto_idproduto=" . $idproduto . "";
	$db->query ( $sql );

}

$sql = "SELECT id, id_produto, descricao, quantidade, vlprodgrade FROM cad_produtos_grade WHERE id_produto=" . $idproduto . " ORDER BY descricao ASC";
$querygrade = $db->query ( $sql );
$total = 0;
while ( $rowgrade = $db->fetch_assoc ( $querygrade ) ) {
	$_SESSION ['gradeproduto'] ['idgrade'] [$total] = $rowgrade ['id'];
	$_SESSION ['gradeproduto'] ['idproduto'] [$total] = $rowgrade ['id_produto'];
	$_SESSION ['gradeproduto'] ['descricao'] [$total] = ucwords ( strtolower ( $rowgrade ['descricao'] ) );
	$_SESSION ['gradeproduto'] ['quantidade'] [$total] = ( int ) $rowgrade ['quantidade'];
	$_SESSION ['gradeproduto'] ['vlprodgrade'] [$total] = $rowgrade ['vlprodgrade'];
	$total ++;
}

if ($total > 0) {
	?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<? for($i = 0; $i < $total; $i ++) { ?>
	<input type="hidden" id="idgrade_input_<?=$i;?>" value="<?=$_SESSION ['gradeproduto'] ['idgrade'] [$i];?>" />
	<input type="hidden" id="quantidade_input_<?=$i;?>" value="<?=$_SESSION ['gradeproduto'] ['quantidade'] [$i];?>" />
	<input type="hidden" id="vlprodgrade_input_<?=$i;?>" value="<?=$_SESSION ['gradeproduto'] ['vlprodgrade'] [$i];?>" />
	<input type="hidden" id="descricao_input_<?=$i;?>" value="<?=$_SESSION ['gradeproduto'] ['descricao'] [$i];?>" />
	<tr bgcolor="<?=$cor;?>" onmouseover="rowOver(this)" onmouseout="rowOut(this)">
		<td height="25">&nbsp;&nbsp;<span id="descricao_<?=$i;?>"><?=$_SESSION ['gradeproduto'] ['descricao'] [$i];?></span></td>
		<td width="100" align="center"><span id="vlprodgrade_<?=$i;?>"><?=$_SESSION ['gradeproduto'] ['vlprodgrade'] [$i];?></span></td>
		<td width="70" align="center"><span id="quantidade_<?=$i;?>"><?=$_SESSION ['gradeproduto'] ['quantidade'] [$i];?></span></td>
		<td width="60" align="center"><input type="button" class="botao green" id="maisitem_<?=$i;?>" value="editar" style="width: 50px;" onclick="javascript:Product.Authentication=<?=($auth==1)?'true':'false';?>;Product.AddItem('<?=$i;?>','<?=$_SESSION ['gradeproduto'] ['idgrade'] [$i];?>', '<?=$total;?>');" /></td>
	</tr>
	<tr>
		<td colspan="4" style="border-bottom: 1px solid #c0c0c0;"></td>
	</tr>
	<? } ?>
</table>
<?
}
?>