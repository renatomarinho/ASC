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

if (isset ( $_SESSION ['gradeproduto'] )) {
	$total = count ( $_SESSION ['gradeproduto'], COUNT_RECURSIVE ) / 3;
} else {
	$total = 1;
}

if ((isset ( $_GET ['add_qtdgrade'] ) && strlen ( $_GET ['add_qtdgrade'] ) > 0) && (isset ( $_GET ['add_nomegrade'] ) && strlen ( $_GET ['add_nomegrade'] ) > 0)) {
	$_SESSION ['gradeproduto'] ['descricao'] [$total] = $_GET ['add_nomegrade'];
	$_SESSION ['gradeproduto'] ['quantidade'] [$total] = $_GET ['add_qtdgrade'];
	$_SESSION ['gradeproduto'] ['vlprodgrade'] [$total] = $_GET ['add_precounico'];
	$total ++;
}

if ($total > 1) {
	?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<?
	for($i = 1; $i < $total; $i ++) {
		?>
	<input type="hidden" id="descricao_input_<?=$i;?>" 	value="<?=$_SESSION ['gradeproduto'] ['descricao'] [$i];?>">
	<input type="hidden" id="quantidade_input_<?=$i;?>" value="<?=$_SESSION ['gradeproduto'] ['quantidade'] [$i];?>">
	<input type="hidden" id="vlprodgrade_input_<?=$i;?>" value="<?=$_SESSION ['gradeproduto'] ['vlprodgrade'] [$i];?>">
	<tr onmouseover="rowOver(this)" onmouseout="rowOut(this)">
		<td height="25">&nbsp;&nbsp;<?=ucwords ( strtolower ( $_SESSION ['gradeproduto'] ['descricao'] [$i] ) );?></td>
		<td width="100" align="center"><span id="vlprodgrade_<?=$i;?>"><?=$_SESSION ['gradeproduto'] ['vlprodgrade'] [$i];?></span></td>
		<td width="85" align="center"><span id="quantidade_<?=$i;?>"><?=$_SESSION ['gradeproduto'] ['quantidade'] [$i];?></span></td>
	</tr>
	<tr>
		<td colspan="3" style="border-bottom: 1px solid #c0c0c0;"></td>
	</tr>
	<?
	}
	?>
</table>
<?
}
?>