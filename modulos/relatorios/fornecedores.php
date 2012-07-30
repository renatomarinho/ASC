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

<fieldset id="g"><legend>Relatorio de Fornecedores</legend>

<div class="linha_separador">
<table width="100%">
	<tr>
		<td><b>Clientes: </b></td>
		<td width="5"></td>
		<td><select id="cliente_id" style="width: 450px;"
			onchange="javascript:pesquisar_fornecedorperiodo();">
			<option value="0">Selecione um fornecedor</option>
				<?
				
				$sql_fornecedores = "SELECT idfornecedor, nome FROM fornecedor WHERE tipo_lancamento is null OR tipo_lancamento = 'E'   ORDER BY nome";
				$rs_fornecedores = $db->query ( $sql_fornecedores );
				
				while ( $row_cliente = $db->fetch_assoc ( $rs_fornecedores ) ) {
					echo "<option value=\"" . $row_cliente ['idfornecedor'] . "\">&nbsp;" . $row_cliente ['nome'] . "</option>";
				}
				?>
					</select></td>
		<td align="right">
		<table>
			<tr>
				<td>&nbsp;</td>
				<td width="5"></td>
				<td>
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
						<td>&nbsp;<b>at�</b>&nbsp;</td>
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
					</tr>
				</table>
				</td>
				<td width="5"></td>
				<td><input type="button" value="buscar" class="botao"
					style="cursor: pointer; cursor: hand; width: 60px;"
					onclick="javascript:pesquisar_fornecedorperiodo();"></td>
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
		<div id="listaprodutosvendidos"
			style="overflow: auto; height: 280px; width: 932px"></div>
		</td>
	</tr>
	<tr>
		<td>
		<div style="border-top: 1px solid #c0c0c0"></div>
		</td>
	</tr>
	<tr>
		<td>
		<table width="100%">
			<tr>
				<td><span id="mensagemcriterio"></span></td>
				<td align="right">
				<table>
					<tr>
						<td><!--										<b style="color:gray;">Op��es do relat�rio</b>-->
						</td>
						<td width="5"></td>
						<td>
						<table>
							<tr>
								<td><!--													<a href="javascript:;" onclick="javascript:var opc = document.getElementById('relopcgrafico');opc.style.display = (opc.style.display=='none')?'block':'none';">Modo Gr�fico</a>-->
								</td>
								<td>
								<div id="relopcgrafico" style="display: none;">
								<table>
									<tr>
										<td><a href="javascript:carrega('');;" onclick="javascript:;">Opc
										1</a></td>
										<td width="5"></td>
										<td><a href="javascript:;" onclick="javascript:;">Opc 2</a></td>
										<td width="5"></td>
										<td><a href="javascript:;" onclick="javascript:;">Opc 3</a></td>
									</tr>
								</table>
								</div>
								</td>
							</tr>
						</table>
						</td>
						<td width="5"></td>
						<td width="22"><img
							src="<?=$_CONF ['PATH_VIRTUAL']?>imgs/icon_pdf.jpg" width="22"
							height="22"
							onMouseover="ddrivetip('<font style=color:#fff><b style=padding:10px>Exportar para PDF</b></font>','#555555', 130)"
							; onMouseout="hideddrivetip()"
							style="cursor: pointer; cursor: hand;"
							onclick="javascript:export_pdf('listaprodutosvendidos', 'Relatorio de Fornecedores	', '')"></td>
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
		</td>
	</tr>
</table>

</div>


</fieldset>