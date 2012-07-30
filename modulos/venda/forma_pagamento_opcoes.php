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

$usuario = $validations->validStringForm ( $_GET ['usuario'] );
$dinheiro = $validations->validStringForm ( $_GET ['dinheiro'] );
$cheque = $validations->validStringForm ( $_GET ['cheque'] );
$cartao_debito = $validations->validStringForm ( $_GET ['cartao_debito'] );
$cartao_credito = $validations->validStringForm ( $_GET ['cartao_credito'] );
?>

<table width="460">
	<tr>
		<td align="center">
			<?
			if ($dinheiro == 'true' || $cheque == 'true' || $cartao_debito == 'true' || $cartao_credito == 'true') {
				?>
			<table width="100%">
				<?
				if ($dinheiro == 'true') {
					?>
				<tr>
				<td height="15"></td>
			</tr>
			<tr>
				<td>
				<table width="100%">
					<tr>
						<td><b>Dinheiro</b></td>
						<td align="right"></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td class="l3"></td>
			</tr>
				<?
				}
				?>
				<?
				if ($cheque == 'true') {
					?>
				<tr>
				<td height="15"></td>
			</tr>
			<tr>
				<td>
				<table width="100%">
					<tr>
						<td><b>Cheque</b></td>
								<?
					if ($usuario > 0) {
						?>
								<td align="right">
						<table>
							<tr>
								<td width="5"></td>
								<td><select id="select_chequebanco" style="width: 150px;"
									onchange="javascript:carrega_dadoschequemudabanco();">
													<?
						$sqlbanco = "SELECT idbanco, nome FROM banco WHERE status=1 ORDER BY nome ASC";
						$querybanco = $db->query ( $sqlbanco );
						while ( $rowbanco = $db->fetch_assoc ( $querybanco ) ) {
							?>
													<option value="<?=$rowbanco ['nome'];?>"><?=$rowbanco ['nome'];?></option>
													<?
						}
						?>
												</select></td>
								<td width="5"></td>
								<td><select id="formapagamento_cheque_qtd" style="width: 105px;"
									onchange="javascript:carrega_dadoscheque(this.value);">
									<option value="0">quantidade</option>
													<?
						for($i = 1; $i < 13; $i ++) {
							?>
													<option value="<?=$i;?>">&nbsp;&nbsp;<?=$i;?>&nbsp;&nbsp;<?=($i < 10) ? '&nbsp;&nbsp;' : '';?> cheque<?=($i == 1) ? '' : 's';?></option>
													<?
						}
						?>
												</select></td>
							</tr>
						</table>
						</td>
								<?
					}
					?>
							</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td class="l3"></td>
			</tr>
			<tr>
				<td>
				<table width="100%">
					<tr>
						<td width="24"></td>
						<td width="148"><b>Data</b></td>
						<td width="116"><b>Banco</b></td>
						<td width="80"><b>N�mero</b></td>
						<td width="80"></td>
					</tr>
					<tr>
						<td colspan="5">
						<div id="dados_cheques" style="display: none;">
						<table width="100%">
							<tr>
								<td width="20"></td>
								<td>
								<table>
									<tr>
										<td><select id="diacheque">
																<?
					for($i = 1; $i < 32; $i ++) {
						?>
																<option value="<?=$i?>"
												<?=((date ( 'd' ) == $i) ? 'selected' : '');?>>&nbsp;<?=$i?>&nbsp;</option>
																<?
					}
					?>
															</select></td>
										<td><select id="mescheque">
																<?
					for($i = 1; $i < 13; $i ++) {
						?>
																<option value="<?=$i?>"
												<?=((date ( 'm' ) == $i) ? 'selected' : '');?>>&nbsp;<?=$i?>&nbsp;</option>
																<?
					}
					?>
															</select></td>
										<td><select id="anocheque">
																<?
					for($i = 2008; $i < 2012; $i ++) {
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
								<td width="4"></td>
								<td><input type="text" id="chequebanco" style="width: 100px;"></td>
								<td width="4"></td>
								<td><input type="text" id="chequenumero"
									style="width: 70px; text-align: right;"></td>
								<td width="4"></td>
								<td><b>R$</b></td>
								<td><input type="text" id="chequevalor"
									onfocus="javascript:carrega_voltarvalorconfirma();"
									onkeydown="javascript:formata_valor(this.id, 13, event)"
									style="width: 60px; text-align: right;"></td>
						
						</table>
						</div>
						<div id="exibe_quantidecheques"></div>
						</td>
					</tr>
				</table>
				</td>
			</tr>
				<?
					if ($usuario == 0) {
						?>
				<tr>
				<td>
				<table width="100%">
					<tr>
						<td><b style="color: red;">ATEN��O :</b></td>
					</tr>
					<tr>
						<td><b>Para utilizar <u>cheque</u> como forma de pagamento deve-se
						selecione um cliente</b></td>
					</tr>
					<tr>
						<td height="5"></td>
					</tr>
					<tr>
						<td>
						<table>
							<tr>
								<td align="right"><input type="button"
									value="selecionar cliente j� cadastrado" class="botao"
									style="cursor: pointer; cursor: hand; width: 210px;"
									onclick="javascript:carrega_selecionaclientevenda();"></td>
								<td width="10"></td>
								<td align="right" width="80"><input type="button"
									value="adicionar novo cliente" class="botao"
									style="cursor: pointer; cursor: hand; width: 160px;"
									onclick="javascript:carrega_cadastraclientevenda();"></td>
							</tr>
						</table>
						</td>
					</tr>
				</table>
				</td>
			</tr>
				<?
					}
					?>
				<?
				}
				?>
				<?
				if ($cartao_debito == 'true') {
					?>
				<tr>
				<td height="15"></td>
			</tr>
			<tr>
				<td>
				<table width="100%">
					<tr>
						<td><b>Cart�o de D�bito</b></td>
						<td align="right">
						<table>
							<tr>
								<td><b>R$</b></td>
								<td width="5"></td>
								<td><input type="text" id="valor_cartaodebito" style="width: 70px; text-align: right;" onfocus="javascript:carrega_voltarvalorconfirma();" onkeydown="javascript:formata_valor('valor_cartaodebito', 13, event)"></td>
								<td width="5"></td>
								<td>
									<select id="tipo_cartaodebito" style="width: 105px;" onfocus="javascript:carrega_voltarvalorconfirma();">
										<?
										$sql = "SELECT id, nome FROM cad_cartoes WHERE debito=1";
										$query = $db->query ( $sql );
										while ( $row = $db->fetch_assoc ( $query ) ) {
										?>
										<option value="<?=$row['id'];?>">&nbsp;&nbsp;<?=ucwords(strtolower($row['nome'] ) );?>&nbsp;&nbsp;</option>
										<?
										}
										?>
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
				<td colspan="2" class="l3"></td>
			</tr>
				<?
				}
				?>
				<?
				if ($cartao_credito == 'true') {
					?>
				<tr>
				<td height="15"></td>
			</tr>
			<tr>
				<td>
				<table width="100%">
					<tr>
						<td><b>Cart�o de Cr�dito</b></td>
						<td align="right">
						<table>
							<tr>
								<td><b>R$</b></td>
								<td width="5"></td>
								<td><input type="text" id="valor_cartaocredito" style="width: 70px; text-align: right;" onfocus="javascript:carrega_voltarvalorconfirma();" onkeydown="javascript:formata_valor('valor_cartaocredito', 13, event)"></td>
								<td width="5"></td>
								<td>
									<select id="tipo_cartaocredito" style="width: 100px;" onfocus="javascript:carrega_voltarvalorconfirma();">
										<?
										$sql = "SELECT id, nome FROM cad_cartoes WHERE credito=1";
										$query = $db->query($sql);
										while ( $row = $db->fetch_assoc($query)) {
										?>
										<option value="<?=$row['id'];?>">&nbsp;&nbsp;<?=ucwords(strtolower($row['nome']));?>&nbsp;&nbsp;</option>
										<?
										}
										?>
									</select>
								</td>
								<td width="5"></td>
								<td>
									<select id="parcela_cartaocredito" style="width: 105px;" onfocus="javascript:carrega_voltarvalorconfirma();">
										<option value="1">&nbsp;&nbsp;� vista</option>
										<?
										for($i = 2; $i < 25; $i ++) {
										?>
										<option value="<?=$i;?>">&nbsp;&nbsp;<?=$i;?>&nbsp;<?=($i < 10) ? '&nbsp;&nbsp;' : '';?> parcela<?=($i == 1) ? '' : 's';?></option>
										<?
										}
										?>
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
				<td colspan="2" class="l3"></td>
			</tr>
			<tr>
				<td align="right"><span id="cartao_valorporparcela"></span></td>
			</tr>
				<?
				}
				?>
			</table>
			<?
			} else {
				?>
			<table cellpadding="20" cellspacing="20">
			<tr>
				<td height="40"><b style="color: red;">Marque uma op��o de pagamento
				para que a venda possa ser finalizada</b></td>
			</tr>
		</table>
		<div style="width: 300px; height: 50px; color: red;"></div>
			<?
			}
			?>
		</td>
	</tr>
</table>