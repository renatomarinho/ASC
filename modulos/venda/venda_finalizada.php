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
?>

<div id="venda_finalizada">
<br /><br /><br /><br />
<table width="100%">
	<tr>
		<td height="15"></td>
	</tr>
	<tr>
		<td align="center">
		<h1 style="color:green;font-size:18px;">
			<? 
			if ( $_SESSION['tipovenda'] == 'vip' ){ 
				echo 'VENDA VIP<br />FINALIZADA COM SUCESSO';
			} else {
				echo 'VENDA NORMAL<br />FINALIZADA COM SUCESSO';
			}
			?>
		</h1>
		</td>
	</tr>
	<tr>
		<td height="20"></td>
	</tr>
	<tr>
		<td align="center">
			<? if ( $_SESSION['tipovenda'] == 'vip' ){ ?>
			<input type="button" value="efetuar uma nova venda vip" class="botao" style="cursor:pointer;cursor:hand;width:180px;background-color:green;text-align:center;" onclick="javascript:carrega_efetuarvenda('modulos/venda/seleciona_produto.php','vip');">
			<? } else {?>
			<input type="button" value="efetuar uma nova venda normal" class="botao" style="cursor:pointer;cursor:hand;width:180px;background-color:green;text-align:center;" onclick="javascript:carrega_efetuarvenda('modulos/venda/seleciona_produto.php','normal');">
			<? } ?>
		</td>
	</tr>
</table>

</div>