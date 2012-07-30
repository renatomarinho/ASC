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

// identificando tipo de venda
$venda = $_REQUEST ['tipo_venda'];

$validations = new validations ( );
$db = new db ( );
$db->connect ();
?>
<fieldset id="g"><legend>Relatorio de Vendas <?
if ($venda) {
	?> Vip <span
	id="titrelatorioescolhido"></span><?
} else {
	?> <span
	id="titrelatorioescolhido">&nbsp;&nbsp;[ lucratividade por venda ]</span> <?
}
?></legend>

<div class="linha_separador">
<table width="100%">
	<tr>
		<td>
		<div id="lucratividadevenda">
		<table>
			<tr>
				<td>
				<table>
					<tr>
						<td><select id="dia1">
													<?
													for($i = 1; $i < 32; $i ++) {
														?>
													<option value="<?=$i?>"
								<?=((date ( 'd' ) == $i) ? 'selected' : '');?>>&nbsp;<?=$i?>&nbsp;</option>
													<?
													}
													?>
												</select></td>
						<td>
												<?
												$mes = date ( 'm' ) - 1;
												if ($mes == 0) {
													$mes = 12;
													$ano = date ( 'Y' ) - 1;
												}
												?>
												<select id="mes1">
													<?
													for($i = 1; $i < 13; $i ++) {
														?>
													<option value="<?=$i?>" <?=(($mes == $i) ? 'selected' : '');?>>&nbsp;<?=$i?>&nbsp;</option>
													<?
													}
													?>
												</select></td>
						<td>
												<?
												if (! isset ( $ano )) {
													$ano = date ( 'Y' );
												}
												?>
												<select id="ano1">
													<?
													for($i = 2005; $i < 2012; $i ++) {
														?>
													<option value="<?=$i?>" <?=(($ano == $i) ? 'selected' : '');?>>&nbsp;<?=$i?>&nbsp;</option>
													<?
													}
													?>
												</select></td>
					</tr>
				</table>
				</td>
				<td>&nbsp;<b>at&eacute;</b>&nbsp;</td>
				<td>
				<table>
					<tr>
						<td><select id="dia2">
													<?
													for($i = 1; $i < 32; $i ++) {
														?>
													<option value="<?=$i?>"
								<?=((date ( 'd' ) == $i) ? 'selected' : '');?>>&nbsp;<?=$i?>&nbsp;</option>
													<?
													}
													?>
												</select></td>
						<td><select id="mes2">
													<?
													for($i = 1; $i < 13; $i ++) {
														?>
													<option value="<?=$i?>"
								<?=((date ( 'm' ) == $i) ? 'selected' : '');?>>&nbsp;<?=$i?>&nbsp;</option>
													<?
													}
													?>
												</select></td>
						<td><select id="ano2">
													<?
													for($i = 2005; $i < 2012; $i ++) {
														?>
													<option value="<?=$i?>"
								<?=((date ( 'Y' ) == $i) ? 'selected' : '');?>>&nbsp;<?=$i?>&nbsp;</option>
													<?
													}
													?>
												</select></td>
					</tr>
				</table>
				</td>
				<td width="5"></td>
				<td><input type="button" value="buscar" class="botao"
					style="cursor: pointer; cursor: hand; width: 60px;"
					onclick="javascript:carrega_relatoriovendaescolhido('?diaescolhido1='+document.getElementById('dia1').value+'&mesescolhido1='+document.getElementById('mes1').value+'&anoescolhido1='+document.getElementById('ano1').value+'&diaescolhido2='+document.getElementById('dia2').value+'&mesescolhido2='+document.getElementById('mes2').value+'&anoescolhido2='+document.getElementById('ano2').value);"></td>
			</tr>
		</table>
		</div>

		<div id="lucratividadevendedor" style="display: none;">
		<table>
			<tr>
				<td><select id="vendedor" style="width: 130px;"
					onchange="javascript:carrega_relatoriovendaescolhido('?vendedor='+this.value+'&diaescolhido1='+document.getElementById('dia1_2').value+'&mesescolhido1='+document.getElementById('mes1_2').value+'&anoescolhido1='+document.getElementById('ano1_2').value+'&diaescolhido2='+document.getElementById('dia2_2').value+'&mesescolhido2='+document.getElementById('mes2_2').value+'&anoescolhido2='+document.getElementById('ano2_2').value);">
										<?
										$sql = "SELECT id, nome FROM cad_login ORDER BY nome ASC";
										$queryvendedor = $db->query ( $sql );
										while ( $rowvendedor = $db->fetch_assoc ( $queryvendedor ) ) {
											?>
										<option value="<?=$rowvendedor ['id'];?>"><?=ucwords ( strtolower ( $rowvendedor ['nome'] ) );?></option>
										<?
										}
										?>
									</select></td>
				<td width="5"></td>
				<td>
				<table>
					<tr>
						<td><select id="dia1_2">
													<?
													for($i = 1; $i < 32; $i ++) {
														?>
													<option value="<?=$i?>"
								<?=((date ( 'd' ) == $i) ? 'selected' : '');?>>&nbsp;<?=$i?>&nbsp;</option>
													<?
													}
													?>
												</select></td>
						<td>
												<?
												$mes = date ( 'm' ) - 1;
												if ($mes == 0) {
													$mes = 12;
													$ano = date ( 'Y' ) - 1;
												}
												?>
												<select id="mes1_2">
													<?
													for($i = 1; $i < 13; $i ++) {
														?>
													<option value="<?=$i?>" <?=(($mes == $i) ? 'selected' : '');?>>&nbsp;<?=$i?>&nbsp;</option>
													<?
													}
													?>
												</select></td>
						<td>
												<?
												if (! isset ( $ano )) {
													$ano = date ( 'Y' );
												}
												?>
												<select id="ano1_2">
													<?
													for($i = 2005; $i < 2012; $i ++) {
														?>
													<option value="<?=$i?>" <?=(($ano == $i) ? 'selected' : '');?>>&nbsp;<?=$i?>&nbsp;</option>
													<?
													}
													?>
												</select></td>
					</tr>
				</table>
				</td>
				<td>&nbsp;<b>at&eacute;</b>&nbsp;</td>
				<td>
				<table>
					<tr>
						<td><select id="dia2_2">
													<?
													for($i = 1; $i < 32; $i ++) {
														?>
													<option value="<?=$i?>"
								<?=((date ( 'd' ) == $i) ? 'selected' : '');?>>&nbsp;<?=$i?>&nbsp;</option>
													<?
													}
													?>
												</select></td>
						<td><select id="mes2_2">
													<?
													for($i = 1; $i < 13; $i ++) {
														?>
													<option value="<?=$i?>"
								<?=((date ( 'm' ) == $i) ? 'selected' : '');?>>&nbsp;<?=$i?>&nbsp;</option>
													<?
													}
													?>
												</select></td>
						<td><select id="ano2_2">
													<?
													for($i = 2005; $i < 2012; $i ++) {
														?>
													<option value="<?=$i?>"
								<?=((date ( 'Y' ) == $i) ? 'selected' : '');?>>&nbsp;<?=$i?>&nbsp;</option>
													<?
													}
													?>
												</select></td>
					</tr>
				</table>
				</td>
				<td width="5"></td>
				<td><input type="button" value="buscar" class="botao"
					style="cursor: pointer; cursor: hand; width: 60px;"
					onclick="javascript:carrega_relatoriovendaescolhido('?vendedor='+document.getElementById('vendedor').value+'&diaescolhido1='+document.getElementById('dia1_2').value+'&mesescolhido1='+document.getElementById('mes1_2').value+'&anoescolhido1='+document.getElementById('ano1_2').value+'&diaescolhido2='+document.getElementById('dia2_2').value+'&mesescolhido2='+document.getElementById('mes2_2').value+'&anoescolhido2='+document.getElementById('ano2_2').value);"></td>
			</tr>
		</table>
		</div>

		</td>
		<td align="right">
				<?
				if (! $venda) {
					?>
					<table>
			<tr>
				<td><b>Selecione o relat&oacute;rio : </b></td>
				<td width="5"></td>
				<td><select
					onchange="javascript:troca_relatoriovendas(this.value, '<?=date ( 'd' );?>', '<?=$mes;?>', '<?=$ano?>', '<?=date ( 'd' )?>', '<?=date ( 'm' );?>', '<?=date ( 'Y' );?>');"
					style="width: 200px;">
					<option value="1">Lucratividade por venda</option>
					<option value="2">Lucratividade por vendedor</option>
				</select></td>
			</tr>
		</table>
				<?
				}
				?>
				</td>
	</tr>
</table>
</div>

<div style="z-index: 9999">

<table width="932" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td bgcolor="#f0f0f0">
		<div id="tabela_titulos"></div>
		</td>
	</tr>
	<tr>
		<td>
		<div id="listavenda"
			style="overflow: auto; height: 330px; width: 932px"></div>
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
				<td><b style="color: gray;">Op&ccedil;&otilde;es do relat&oacute;rio</b></td>
				<td width="5"></td>
				<td width="22"><img
					src="<?=$_CONF ['PATH_VIRTUAL']?>imgs/icon_pdf.jpg" width="22"
					height="22"
					onMouseover="ddrivetip('<font style=color:#fff><b style=padding:10px>Exportar para PDF</b></font>','#555555', 130)"
					; onMouseout="hideddrivetip()"
					style="cursor: pointer; cursor: hand;"
					onclick="javascript:export_pdf('listavenda', 'Relatorio de Vendas <?
					if ($venda) {
						?> Vip<?
					}
					?>', document.getElementById('titrelatorioescolhido').innerHTML)"></td>
				<td width="5"></td>
				<td width="22"><img
					src="<?=$_CONF ['PATH_VIRTUAL']?>imgs/icon_excel.jpg" width="22"
					height="22"
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