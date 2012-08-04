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


<fieldset id="p"><legend><span id="titcompromisso">Conta Pagar / Receber</span></legend>

<div class="linha_separador ls_conf_P " style="width: 350px;">

<table width="100%" height="100%">
	<tr>
		<td>
		<table>
			<tr>
				<td><img
					src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/fluxoreceita_32.png" class="t32" /></td>
				<td width="10"></td>
				<td>
				<div id="dadosreceita"><b>Dados da Receita</b> <br />
				Clique em <i>"adicionar receita"</i></div>
				<div id="dadosdespesa" style="display: none;"><b>Dados da Despesa</b>
				<br />
				Clique em <i>"adicionar despesa"</i></div>
				</td>
			</tr>
		</table>
		</td>
		<td align="right">
			<input type="button" value="receita" id="btn_exibe_receita_despesa" class="botao btn_irpara exibe_receita_despesa" onclick="javascript:financeiro_fluxo_exibe_receita_despesa(this);" style="width: 100px; display: block;" /> 
			<input type="hidden" value="receita" id="fluxo" name="fluxo" /> 
			<input type="hidden" value="" id="mv_financeiro_id" name="mv_financeiro_id" />
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

		<div id="form_despesa">
		<table width="370">
			<tr>
				<td>
				<table width="100%" border="0">
					<tr>
						<td height="25">
						<div id="label_numero_documento"><b>N&deg; documento</b></div>
						</td>
						<td><input id="numero_documento" type="text"></td>
					</tr>
					<tr>
						<td height="25">
						<div id="label_favorecido"><b>Favorecido</b></div>
						</td>
						<td>
							<select id="fornecedorsaida" name="fornecedor" style="width: 230px; display: none; float: left;">
								<optgroup value=""></optgroup>
								<?
								$sql = "SELECT idfornecedor, nome FROM fornecedor WHERE tipo_lancamento='S' or tipo_lancamento IS NULL";
								$query = $db->query ( $sql );
								while ( $rowconta = $db->fetch_assoc ( $query ) ) {
								?>
								<option value="<?=$rowconta ['idfornecedor'];?>">&nbsp;&nbsp;<?=ucwords ( strtolower ( $rowconta ['nome'] ) );?></option>
								<?
								}
								?>
							</select> 
								<select id="fornecedorentrada" name="fornecedor" style="width: 230px; float: left;">
									<optgroup value=""> </optgroup>
									<?
									$sql = "SELECT idfornecedor, nome FROM fornecedor WHERE tipo_lancamento='E'";
									$query = $db->query ( $sql );
									while ( $rowconta = $db->fetch_assoc ( $query ) ) {
									?>
									<option value="<?=$rowconta ['idfornecedor'];?>">&nbsp;&nbsp;<?=ucwords ( strtolower ( $rowconta ['nome'] ) );?></option>
									<? } ?>
								</select>
							<div id="div_icons_favorecido">
							<div id="icon_mais" class="add_fornecedor"></div>
							<div id="icon_menos_favorecido">
							<div id="icon_menos" class="remove_fornecedor"></div>
						</div>
						</div>
						</td>
					</tr>
					<tr>
						<td height="25">
						<div id="label_plano"><b>Plano</b></div>
						</td>
						<td>
							<select id="planosaida" style="width: 230px; display: none; float: left;">
								<optgroup value=""> </optgroup>
								<?
								$sql = "SELECT id, nome_plano FROM cad_plano_de_contas WHERE tipo_lancamento='S'";
								$query = $db->query ( $sql );
								while ( $rowconta = $db->fetch_assoc ( $query ) ) {
								?>
								<option value="<?=$rowconta ['id'];?>">&nbsp;&nbsp;<?=ucwords ( strtolower ( $rowconta ['nome_plano'] ) );?></option>
								<? } ?>
							</select> 
							<select id="planoentrada" style="width: 230px; float: left;">
								<optgroup value=""> </optgroup>
								<?
								$sql = "SELECT id, nome_plano FROM cad_plano_de_contas WHERE tipo_lancamento='E'";
								$query = $db->query ( $sql );
								while ( $rowconta = $db->fetch_assoc ( $query ) ) {
								?>
								<option value="<?=$rowconta ['id'];?>">&nbsp;&nbsp;<?=ucwords ( strtolower ( $rowconta ['nome_plano'] ) );?></option>
								<? } ?>
							</select>
						<div id="div_icons_plano">
						<div id="icon_mais" class="add_plano"></div>
						<div id="icon_menos" class="remove_plano"></div>
						</div>
						</td>
					</tr>
					<tr>
						<td height="25"><b>Vencimento</b></td>
						<td>
						<table cellpadding="0" cellspacing="0">
							<tr>
								<td>
									<select id="fluxo_vencimento_dia" style="width: 40px;">
										<?
										for($i = 1; $i < 32; $i ++) {
										?>
										<option value="<?=$i;?>" <?=(date ( 'd' ) == $i) ? 'selected' : '';?>><?=$i;?></option>
										<? } ?>
									</select>
								</td>
								<td width="4"></td>
								<td>
									<select id="fluxo_vencimento_mes" style="width: 90px;">
										<?
										for($i = 1; $i < 13; $i ++) {
										?>
										<option value="<?=$i;?>" <?=(date ( 'm' ) == $i) ? 'selected' : '';?>><?=$meses [$i];?></option>
										<? } ?>
									</select>
								</td>
								<td width="4"></td>
								<td>
									<select id="fluxo_vencimento_ano" style="width: 55px;">
										<?
										for($i = (date ( 'Y' ) - 1); $i < (date ( 'Y' ) + 4); $i ++) {
										?>
										<option value="<?=$i?>" <?=(date ( 'Y' ) == $i) ? 'selected' : '';?>><?=$i?></option>
										<? } ?>
									</select>
								</td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td height="25">
						<div id="label_periodicidade"><b>Periodicidade</b>
						<div>
						
						</td>
						<td><select id="periodicidade" style="width: 140px;">
							<optgroup label="Recebimento"></optgroup>
							<option value="1">&nbsp;&nbsp;Diário</option>
							<option value="2">&nbsp;&nbsp;Semanal</option>
							<option value="3">&nbsp;&nbsp;Quinzenal</option>
							<option value="4">&nbsp;&nbsp;Mensal</option>
							<option value="5">&nbsp;&nbsp;Bimestral</option>
							<option value="6">&nbsp;&nbsp;Trimestral</option>
							<option value="7">&nbsp;&nbsp;Semestral</option>
							<option value="8">&nbsp;&nbsp;Anual</option>
						</select></td>
					</tr>
					<tr>
						<td height="25"><b>Valor a pagar</b></td>
						<td>
						<table cellpadding="0" cellspacing="0">
							<tr>
								<td height="25"><b>R$</b> <input type="text" id="fluxo_valor" style="width: 60px; text-align: right;" onclick="javascript:this.value='';" onkeydown="javascript:formata_valor('fluxo_valor', 13, event)" /></td>
								<td width="70"></td>
								<td><b>Efetuado</b></td>
								<td width="5"></td>
								<td><select id="efetuado" style="width: 50px;">
									<option value="0">Não</option>
									<option value="1">Sim</option>
								</select></td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td height="25"><b>Descrição</b></td>
						<td><textarea id="descricao" style="width: 250px;"></textarea></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td height="4"></td>
			</tr>
			<tr>
				<td class="l3"></td>
			</tr>
			<tr>
				<td height="4"></td>
			</tr>
			<tr>
				<td>
				<table width="100%">
					<tr>
						<td><input type="button" id="novo_receita_despesa" value="nova receita" class="botao btn_adicionar" style="display: none;" /></td>
						<td align="right"><input type="button" id="btn_add_receita_despesa" class="botao btn_adicionargreen green" value="adicionar receita" onclick="javascript:add_receita_despesa();" /></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td height="4"></td>
			</tr>
			<tr>
				<td class="l3"></td>
			</tr>
			<tr>
				<td height="4"></td>
			</tr>
			<tr>
				<td align="right">
				<div id="flash"></div>
				<div id="divplano" style="display: none;">
				<table>
					<tr>
						<td><b>Nome</b></td>
						<td width="5"></td>
						<td><input type="text" id="novo_plano" name="novo_plano" /></td>
						<td width="5"></td>
						<td colspan="3"><input type="button" class="botao btn_adicionargreen green add_plano" value="adicionar plano" /></td>
					</tr>
				</table>
				</div>
				<div id="divfavorecido" style="display: none;">
				<table>
					<tr>
						<td><b>Nome</b></td>
						<td width="5"></td>
						<td><input type="text" id="novo_favorecido" name="novo_favorecido" /></td>
						<td width="5"></td>
						<td colspan="3"><input type="button" class="botao btn_adicionargreen green" style="width: 160px;" value="adicionar favorecido" onclick="javascript:add_favorecido();" /></td>
					</tr>
				</table>
				</div>
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
				<td align="center"><b style="color: green;">evento adicionado com sucesso</b></td>
			</tr>
		</table>
		</div>

		</td>
	</tr>
</table>

</div>

</fieldset>

<!--
<meta name="nome_fake" content="Fluxo de Caixa">
<meta name="nome_rvs" content="fluxo_adiciona.php">
<meta name="localizacao" content="/modulos/financeiro">
<meta name="descricao" content="Correcoes.">
</head>
-->