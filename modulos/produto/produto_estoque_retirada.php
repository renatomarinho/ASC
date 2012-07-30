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
<table width="100%">
	<tr>
		<td>
			<b style="color:red;"><u>Voc� est� retirando <span id="qtdItens"></span> do estoque</u>
			<BR>Deseja confirmar a retirada?</b>
		</td>
		<td width="15"></td>
		<td align="left">
			<a href="javascript:;" class="botao red btn_naored" style="width:70px;" id="btnRetiradaNao">N�o</a>
			<br />
			<a href="javascript:;" class="botao green btn_simgreen" style="width:70px;" id="btnRetiradaSim">Sim</a>
		</td>
	</tr>
</table>
