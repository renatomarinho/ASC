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

<table width="100%" height="100%">
	<tr>
		<td style="border-top: 2px solid black"></td>
	</tr>
	<tr>
		<td align="center">
		<table>
			<tr>
				<td align="center">
				<h1>Tem certeza que deseja cancelar a venda?</h1>
				</td>
			</tr>
			<tr>
				<td align="center" style="color: #c0c0c0;"><b> Todos os produtos que constam no carrinho de compras retornar�o ao estoque. <BR> Controle da venda [ <?=$_SESSION ['controlevenda'];?> ]</b></td>
			</tr>
			<tr>
				<td height="10"></td>
			</tr>
			<tr>
				<td align="center">
				<table>
					<tr>
						<td><input type="button" value="n�o" class="botao" style="width: 40px;" onclick="javascript:carregar_cancelarvendanao();"></td>
						<td width="25"></td>
						<td><input type="button" value="sim" class="botao" style="width: 40px;" onclick="javascript:carregar_cancelarvendasim();"></td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>