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

$data_inicial = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) );
$data_final = mktime ( 23, 59, 59, date ( 'm' ), date ( 'd' ), date ( 'Y' ) );

$sql = "SELECT idagendaeventos FROM rvs_agendaeventos WHERE inicio>" . $data_inicial . " AND final<" . $data_final . "";
$query = $db->query ( $sql );
$total = $db->num_rows ( $query );

?>


<fieldset id="p"><legend><span id="titcompromisso">Adicionar Novo
Compromisso</span></legend>

<div class="linha_separador ls_conf_P" style="width: 350px;">

<table width="100%">
	<tr>
		<td width="10"></td>
		<td>
			<div id="bnt_add_new_agenda" style="display: none;">
				<input type="button" value="adicionar" class="botao" style="cursor: pointer; cursor: hand; width: 80px; background-color: green;" onclick="javascript:carrega_utilitario_agenda();" />
			</div>
		</td>
	</tr>
</table>

</div>

<div>

<table border=0 width="100%">
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td>

		<div id="form_exibicao">
		<table width="100%">
			<tr>
				<td>
				<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td><b>Data</b></td>
						<td align="right">
						<table>
							<tr>
								<td>
									<select id="diaescolhido1" style="width: 40px;">
                                    	<? for($i = 1; $i < 32; $i ++) { ?>
                	               		<option value="<?=$i;?>" <?=(date ( 'd' ) == $i) ? 'selected' : '';?>><?=$i;?></option>
                                        <? } ?>
                                	</select>
								</td>
								<td width="4"></td>
								<td>
									<select id="mesescolhido1" style="width: 90px;">
										<? for($i = 1; $i < 13; $i ++) { ?>
										<option value="<?=$i;?>" <?=(date ( 'm' ) == $i) ? 'selected' : '';?>><?=$meses [$i];?></option>
										<? } ?>
									</select>
								</td>
								<td width="4"></td>
								<td>
									<select id="anoescolhido1" style="width: 55px;">
									<? for($i = (date ( 'Y' ) - 1); $i < (date ( 'Y' ) + 4); $i ++) { ?>
										<option value="<?=$i?>" <?=(date ( 'Y' ) == $i) ? 'selected' : '';?>><?=$i?></option>
									<? } ?>
									</select>
								</td>
							</tr>
						</table>
						</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td height="10"></td>
			</tr>
			<tr>
				<td>
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td width="155"><b>Hor�rio</b></td>
						<td align="right">
							<select id="horaescolhida1" style="width: 40px;">
								<? for($i = 0; $i < 24; $i ++) { ?>
								<option value="<?=$i;?>"
								<?=(date ( 'H' ) == $i) ? 'selected' : ''; ?>><?=$i;?></option>
								<? } ?>
							</select>
						</td>
						<td width="5" align="center"><b>:</b></td>
						<td>
							<select id="minutoescolhido1" style="width: 40px;">
								<option value="00">00</option>
								<option value="30">30</option>
							</select>
						</td>
						<td align="center" width="40"><b>at�</b></td>
						<td align="right">
							<select id="horaescolhida2" style="width: 40px;">
								<? for($i = 0; $i < 24; $i ++) { ?>
								<option value="<?=$i;?>" <?=(date ( 'H' ) == $i) ? 'selected' : '';?>><?=$i;?></option>
								<? } ?>
							</select>
						</td>
						<td width="5" align="center"><b>:</b></td>
						<td>
							<select id="minutoescolhido2" style="width: 40px;">
								<option value="00">00</option>
								<option value="30" selected>30</option>
							</select>
						</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td>
				<div style="display: none;">
				<table>
					<tr>
						<td>
							<select id="diaescolhido2" style="width: 40px;">
								<? for($i = 1; $i < 32; $i ++) { ?>
								<option value="<?=$i;?>" <?=(date ( 'd' ) == $i) ? 'selected' : '';?>><?=$i;?></option>
								<? } ?>
							</select>
						</td>
						<td width="4"></td>
						<td>
							<select id="mesescolhido2" style="width: 90px;">
								<? for($i = 1; $i < 13; $i ++) { ?>
								<option value="<?=$i;?>" <?=(date ( 'm' ) == $i) ? 'selected' : '';?>><?=$meses [$i];?></option>
								<? } ?>
							</select>
						</td>
						<td width="4"></td>
						<td>
							<select id="anoescolhido2" style="width: 55px;">
								<? for($i = (date ( 'Y' ) - 1); $i < (date ( 'Y' ) + 4); $i ++) { ?>
								<option value="<?=$i;?>"><?=$i?></option>
								<? } ?>
							</select>
						</td>
					</tr>
				</table>
				</div>
				</td>
			</tr>
			<tr>
				<td height="10"></td>
			</tr>
			<tr>
				<td>
					<textarea id="tarefa" style="width: 365px; height: 180px;"></textarea>
					<input type="hidden" id="id_agenda" value="" />
				</td>
			</tr>
			<tr>
				<td height="10"></td>
			</tr>

			<tr>
				<td>
				<table width="100%">
					<tr>
						<td><b>Acompanhamento</b></td>
						<td align="right">
							<select id="acompanhamento" style="width: 132px;">
								<option value="1">Pendente</option>
								<option value="0">Conclu�do</option>
							</select>
						</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td height="2"></td>
			</tr>
			<tr>
				<td style="border-bottom: 2px solid black;"></td>
			</tr>
			<tr>
				<td height="2"></td>
			</tr>
			<tr>
				<td>
				<table width="100%">
					<tr>
						<td align="left"><span id="msgevento"></span></td>
						<td align="right">
							<input id="bnt_adicionar_evento" type="button" value="adicionar" class="botao" style="cursor: pointer; cursor: hand; width: 80px; background-color: green;" onclick="javascript:Calendar.ScreenMode();Calendar.SaveTask();" />
						</td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</div>

		<div id="form_exibicao_adicionado" style="display: none;">
		<table width="100%">
			<tr>
				<td height="25"><b>Adicionar evento</b></td>
			</tr>
			<tr>
				<td style="border-bottom: 2px solid black;"></td>
			</tr>
			<tr>
				<td height="15"></td>
			</tr>
			<tr>
				<td align="center"><b style="color: green;">Evento adicionado com sucesso</b></td>
			</tr>
		</table>
		</div>

		</td>
	</tr>
</table>

</div>

</fieldset>


<fieldset id="m"><legend>Agenda de Compromissos</legend>

<div class="linha_separador ls_conf_M">

<table>
	<tr>
		<td><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/calendario_32.png" class="t32" /></td>
		<td width="10"></td>
		<td><b>Escolha o modo de exibi��o</b></td>
		<td width="160"></td>
		<td>
			<input type="button" value="Exibir modo di�rio" class="botao" id="btnModoDiario" onclick="javascript:Calendar.ScreenMode();Calendar.Daily(<?=date ( 'd' );?>,<?=date ( 'm' );?>,<?=date ( 'Y' );?>);" />
			<input type="button" value="Exibir modo mensal" class="botao" style="display: none;" id="btnModoMensal" onclick="javascript:Calendar.ScreenMode();Calendar.Monthly(0);" />
		</td>
	</tr>
</table>

</div>
<div id="calendar"></div>

</fieldset>

