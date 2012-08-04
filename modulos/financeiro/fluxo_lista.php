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

$data_inicial = date ( 'Y-m-d', mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) - 5, date ( 'Y' ) ) );
$data_final = date ( 'Y-m-d', mktime ( 23, 59, 59, date ( 'm' ), date ( 'd' ) + 5, date ( 'Y' ) ) );

//$sql = "SELECT id FROM mv_financeiro WHERE data_vencimento BETWEEN ".$data_inicial." AND ".$data_final."";
//$query = $db->query($sql);
//$total = $db->num_rows($query);


?>

<fieldset id="m"><legend>Fluxo de Caixa</legend>
<div class="linha_separador ls_conf_M">
<table width="100%" height="100%">
	<tr>
		<td>
		<table>
			<tr>
				<td><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/fluxo_32.png" class="t32" /></td>
				<td width="10"></td>
				<td><b>Lista de todos os clientes cadastrados</b> <br />
				Clique em <i>"ir para listagem"</i> para efetuar uma nova busca</td>
			</tr>
		</table>
		</td>
		<td align="right">
			<input type="button" value="modo texto" class="botao" style="width: 120px; display: none;" onclick="javascript:utilitarios_agenda_tarefasalvar();"> 
			<input type="button" value="modo gráfico" class="botao" style="width: 120px; display: none;" onclick="javascript:utilitarios_agenda_tarefasalvar();">
		</td>
	</tr>
</table>
</div>
<div>
<table width="100%">
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td>
		<table width="100%" cellspacing="0" cellpadding="0" border="1">
			<tr>
				<td align="center">
				<table>
					<tr>
						<td>Período:</td>
						<td>
						<table>

							<tr>
								<td>
									<select id="dia1">
									<?
									for($i = 1; $i < 32; $i ++) {
									?>
										<option value="<?=$i?>" <?=((date ( 'd' ) == $i) ? 'selected' : '');?>>&nbsp;<?=$i?>&nbsp;</option>
									<? } ?>
									</select>
								</td>
								<td>
									<select id="mes1">
									<?
									for($i = 1; $i < 13; $i ++) {
									?>
										<option value="<?=$i?>" <?=((date ( 'm' ) == $i) ? 'selected' : '');?>>&nbsp;<?=$i?>&nbsp;</option>
									<? } ?>
									</select>
								</td>
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
									<? } ?>
									</select>
								</td>
							</tr>
						</table>
						</td>
						<td>&nbsp;até&nbsp;</td>
						<td>
						<table>
							<tr>
								<td>
									<select id="dia2">
									<?
									for($i = 1; $i < 32; $i ++) {
									?>
										<option value="<?=$i?>" <?=((date ( 'd' ) == $i) ? 'selected' : '');?>>&nbsp;<?=$i?>&nbsp;</option>
									<? } ?>
									</select>
								</td>
								<td>
									<select id="mes2">
									<?
									for($i = 1; $i < 13; $i ++) {
									?>
										<option value="<?=$i?>" <?=((date ( 'm' ) == $i) ? 'selected' : '');?>>&nbsp;<?=$i?>&nbsp;</option>
									<? } ?>
									</select>
								</td>
								<td>
									<select id="ano2">
									<?
									for($i = 2005; $i < 2012; $i ++) {
									?>
										<option value="<?=$i?>" <?=((date ( 'Y' ) == $i) ? 'selected' : '');?>>&nbsp;<?=$i?>&nbsp;</option>
									<? } ?>
									</select>
								</td>
							</tr>
						</table>
						</td>
						<td><input type="button" value="buscar" class="botao" style="cursor: pointer; cursor: hand; width: 60px;" onclick="javascript:fluxo_reload_date(0);" /></td>
						</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td><input type="hidden" value="<?=date ( 'n' );?>" name="calendario_mes" id="calendario_mes" />
				<table width="100%">
					<tr>
						<td align="left" width="50"><input type="button" value="- ano" id="ano_anterior" class="botao" style="cursor: pointer; cursor: hand; width: 50px;" onclick="javascript:fluxo_reload_date(8);" /></td>
						<td align="left" width="50"><input type="button" value="- mês" id="mes_anterior" class="botao" style="cursor: pointer; cursor: hand; width: 50px;" onclick="javascript:fluxo_reload_date(4);" /></td>
						<td align="left" width="50"><input type="button" value="- dia" id="dia_anterior" class="botao" style="cursor: pointer; cursor: hand; width: 50px;" onclick="javascript:fluxo_reload_date(2);" /></td>
						<td align="right" width="50"><input type="button" value="dia +" id="dia_proximo" class="botao" style="cursor: pointer; cursor: hand; width: 50px;" onclick="javascript:fluxo_reload_date(1);" /></td>
						<td align="right" width="50"><input type="button" value="mês +" id="mes_proximo" class="botao" style="cursor: pointer; cursor: hand; width: 50px;" onclick="javascript:fluxo_reload_date(3);" /></td>
						<td align="right" width="50"><input type="button" value="ano +" id="ano_proximo" class="botao" style="cursor: pointer; cursor: hand; width: 50px;" onclick="javascript:fluxo_reload_date(7);" /></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td class="l3"></td>
			</tr>
			<tr>
				<td>
				<div id="calendario"></div>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>

</div>

</fieldset>
