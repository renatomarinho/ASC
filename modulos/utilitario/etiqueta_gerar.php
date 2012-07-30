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
<fieldset id="m"><legend>Gerar Etiqueta</legend>
<div class="linha_separador" style="width: 480px; height: 27px;">
<div id="flash" align="center"></div>
</div>
<div id="divetiqueta">
<table width="100%">
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td height="25">
		<table width="100%">
			<tr>
				<td><b>Preview<!-- do produto--></b></td>
				<td align="right"><input type="button" class="botao_inativo"
					disabled="true" id="bntImprimirEtiquetas"
					value="Imprimir Etiquetas" onClick="checkGerarEtiqueta();"></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td height="15"></td>
	</tr>
	<tr>
		<td>
		<div id="divgerandoetiqueta" style="overflow: auto; height: 270px;"></div>
		</td>
	</tr>
</table>
</div>
</fieldset>