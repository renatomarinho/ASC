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
<fieldset id="p"><legend>Carrinho de Compras</legend>

<div class="linha_separador" style="height: 25px;">

<table width="100%">
	<tr>
		<td align="center" height="25"><b style="color: red;">Produtos que
		constavam no carrinho de compras</b></td>
	</tr>
</table>

</div>


<div id="produtos_constavamcarrinho"
	style="overflow: auto; height: 310px; width: 377px"></div>

<div>
<table width="377">
	<tr>
		<td class="l3"></td>
	</tr>
	<tr>
		<td height="3"></td>
	</tr>
	<tr>
		<td align="right"><span id="totalcarrinho"></span></td>
	</tr>
</table>
</div>

</fieldset>