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
?>
<fieldset id="g"><legend>Relatorio de Estoque <span
	id="titrelatorioescolhido">&nbsp;&nbsp;[ todos produtos : com estoque ]</span></legend>

<div class="linha_separador">
<table width="100%">
	<tr>
		<td align="left">
		<table>
			<tr>
				<td><b>Relatário : </b></td>
				<td width="5"></td>
				<td>Quantidade em estoque</td>
			</tr>
		</table>
		</td>
		<td align="right">
		<table>
			<tr>
				<td><b>Critério : </b></td>
				<td width="5"></td>
				<td><select
					onchange="javascript:troca_relatorioestoque(this.value);"
					style="width: 200px;">
					<optgroup label="Produtos com estoque"></optgroup>
					<option value="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Todos os produtos</option>
					<option value="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Agrupados por
					categoria</option>
					<option value="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Agrupados por
					fornecedor</option>
					<option value="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Agrupados por
					coleção</option>
					<optgroup label="Produtos sem estoque"></optgroup>
					<option value="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Todos os produtos</option>
					<option value="6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Agrupados por
					categoria</option>
					<option value="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Agrupados por
					fornecedor</option>
					<option value="8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Agrupados por
					coleção</option>
				</select></td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</div>

<div style="z-index: 9999">

<table width="932">
	<tr>
		<td bgcolor="#f0f0f0">
		<div id="tabela_titulos"></div>
		</td>
	</tr>
	<tr>
		<td>
		<div id="listaestoque"
			style="overflow: auto; height: 290px; width: 932px"></div>
		</td>
	</tr>
	<tr>
		<td>
		<div style="border-top: 1px solid #c0c0c0"></div>
		</td>
	</tr>
	<tr>
		<td align="right">
		<table>
			<tr>
				<td><b style="color: gray;">Opções do relatório</b></td>
				<td width="5"></td>
				<td width="22"><img
					src="<?=$_CONF ['PATH_VIRTUAL']?>imgs/icon_pdf.jpg" width="22"
					height="22"
					onMouseover="ddrivetip('<font style=color:#fff><b style=padding:10px>Exportar para PDF</b></font>','#555555', 130)"
					; onMouseout="hideddrivetip()"
					style="cursor: pointer; cursor: hand;"
					onclick="javascript:export_pdf('listaestoque', 'Relatorio de Estoque', document.getElementById('titrelatorioescolhido').innerHTML)"></td>
				<td width="5"></td>
				<td width="22"><img
					src="<?=$_CONF ['PATH_VIRTUAL']?>imgs/icon_excel.jpg" width="22"
					height="22" onclick="javascript:gera_excel();"
					onMouseover="ddrivetip('<font style=color:#fff><b style=padding:10px>Exportar para Excel</b></font>','#555555', 135)"
					; onMouseout="hideddrivetip()"
					style="cursor: pointer; cursor: hand;"></td>
				<td width="5"></td>
				<td width="22"><img
					src="<?=$_CONF ['PATH_VIRTUAL']?>imgs/icon_print.jpg" width="22"
					height="22"
					onMouseover="ddrivetip('<font style=color:#fff><b style=padding:10px>Imprimir</b></font>','#555555', 72)"
					; onMouseout="hideddrivetip()"
					style="cursor: pointer; cursor: hand;"></td>
				<td width="20"></td>
			</tr>
		</table>
		</td>
	</tr>
</table>

</div>

</fieldset>