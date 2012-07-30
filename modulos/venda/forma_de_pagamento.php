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

<fieldset id="m"><legend><span id="titmain">Detalhes Formas de Pagamento</span> [ <?=$_SESSION ['controlevenda'];?> ]</legend>

<div id="opcextra"></div>

<div class="linha_separador" id="linha_separadorpagamento" style="width: 480px; height: 55px;">
<table width="100%" height="100%">
	<tr>
		<td align="center">
		<h1 id="valordotroco"></h1>
		<span id="pagamentocomplemento"></span></td>
	</tr>
</table>
</div>

<div id="pagamento_counteudo">

<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td height="15"></td>
	</tr>
	<tr>
		<td>
		<div style="height: 290px; overflow: auto;">
		<table width="100%">
			<tr>
				<td>

				<div id="dados_cheques_tabela" style="display: none;">
				<table width="100%">
					<tr>
						<td colspan="4" height="20">
						<table width="100%">
							<tr>
								<td><b>Cheque</b></td>
								<td align="right"><span id="titcheque"></span></td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td colspan="4" class="l3"></td>
					</tr>
					<tr>
						<td height="25" width="177"><b>Data vencimento</b></td>
						<td width="130"><b>Banco</b></td>
						<td width="100"><b>N�mero</b></td>
						<td><b>Valor</b></td>
					</tr>
					<tr>
						<td colspan="4" class="l3"></td>
					</tr>
				</table>
				</div>

				<div id="dados_cheques" style="display: none;">
				<table width="100%">
					<tr>
						<td>
						<table>
							<tr>
								<td>
									<select id="diacheque">
									<?
									for($i = 1; $i < 32; $i ++) {
									?>
										<option value="<?=$i?>" <?=((date ( 'd' ) == $i) ? 'selected' : '');?>>&nbsp;<?=$i?>&nbsp;</option>
									<?
									}
									?>
									</select>
								</td>
								<td>
									<select id="mescheque">
									<?
									for($i = 1; $i < 13; $i ++) {
									?>
										<option value="<?=$i?>" <?=((date ( 'm' ) == $i) ? 'selected' : '');?>>&nbsp;<?=$i?>&nbsp;</option>
									<?
									}
									?>
									</select>
								</td>
								<td>
									<select id="anocheque">
									<?
									for($i = 2008; $i < 2012; $i ++) {
									?>
										<option value="<?=$i?>" <?=((date ( 'Y' ) == $i) ? 'selected' : '');?>>&nbsp;<?=$i?>&nbsp;</option>
									<?
									}
									?>
									</select>
								</td>
							</tr>
						</table>
						</td>
						<td width="4"></td>
						<td><input type="text" id="chequebanco" style="width: 100px;"></td>
						<td width="4"></td>
						<td><input type="text" id="chequenumero" style="width: 70px; text-align: right;"></td>
						<td width="4"></td>
						<td><b>R$</b></td>
						<td><input type="text" id="chequevalor" onfocus="javascript:this.value='';" onkeydown="javascript:formata_valor(this.id, 13, event)" style="width: 60px; text-align: right;" /></td>
				
				</table>
				</div>

				<div id="exibe_quantidecheques"></div>

				</td>
			</tr>
			<tr>
				<td class="l3"></td>
			</tr>
			<tr>
				<td>

				<div id="dados_credito_tabela" style="display: none;">
				<table width="100%">
					<tr>
						<td height="20">
						<table width="100%">
							<tr>
								<td><b>Cart�o de Cr�dito</b></td>
								<td align="right">
								<table>
									<tr>
										<td><b>selecione</b></td>
										<td width="5"></td>
										<td><select id="credito_cartao_qtd" style="width: 105px;" onchange="javascript:carrega_dadoscredito(this.value);vendas_vendanormal_pagcredito();">
											<?
											for($i = 1; $i < 6; $i ++) {
												?>
											<option value="<?=$i;?>">&nbsp;&nbsp;<?=$i;?>&nbsp;&nbsp;<?=($i < 10) ? '&nbsp;&nbsp;' : '';?> cart<?=($i == 1) ? '�o' : '�es';?></option>
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
					</tr>
					<tr>
						<td class="l3"></td>
					</tr>
					<tr>
						<td>
						<table>
							<tr>
								<td height="20" width="92"><b>Valor</b></td>
								<td width="110"><b>Parcelas</b></td>
								<td><b>Cart�o</b></td>
								<td width="100"></td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td class="l3"></td>
					</tr>
				</table>
				</div>

				<div id="dados_credito" style="display: none;">
				<table width="100%">
					<tr>
						<td>
						<table>
							<tr>
								<td><b>R$</b></td>
								<td width="4"></td>
								<td><input type="text" id="creditovalor" readOnly style="width: 60px; text-align: right;"></td>
								<td width="4"></td>
								<td>
									<select id="creditoparcela" style="width: 105px;" onchange="javascript:Sell.PriceUpdate();">
										<?
										for($i = 1; $i < 13; $i ++) {
											?>
										<option value="<?=$i;?>">&nbsp;&nbsp;<?=$i;?>&nbsp;&nbsp;<?=($i < 10) ? '&nbsp;&nbsp;' : '';?> parcela<?=($i == 1) ? '' : 's';?></option>
										<?
										}
										?>
									</select>
								</td>
								<td width="4"></td>
								<td>
									<select id="cartaodecredito" style="width: 140px;" onchange="javascript:;">
										<?
										$sql = "SELECT id, nome FROM cad_cartoes WHERE status=1 AND credito=1 ORDER BY nome ASC";
										$query = $db->query($sql);
										while ($row = $db->fetch_assoc($query)) {
										?>
										<option value="<?=$row['id'];?>">&nbsp;&nbsp;<?=ucwords(strtolower($row['nome']));?>&nbsp;&nbsp;</option>
										<?
										}
										?>
									</select>
								</td>
								<td width="4"></td>
								<td><span id="valortotal_credito"></span></td>
							</tr>
						</table>
						</td>
					</tr>
				</table>
				</div>

				<div id="exibe_quantidecreditos"></div>

				</td>
			</tr>
		</table>
		</div>
		</td>
	</tr>
</table>



</div>

<div id="pagamento_venda"></div>

</fieldset>