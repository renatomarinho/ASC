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
//
//    echo "<pre>";
//    print_r($_SESSION);
//    echo "</pre>";
//    


$validations = new validations ( );
$db = new db ( );
$db->connect ();

$usuario = $validations->validNumeric ( $_GET ['u'] );
$valorvenda = $validations->validStringForm ( $_GET ['v'] );

if (isset ( $_GET ['c'] ) && $_GET ['c'] > 0) {
	$cliente = $validations->validNumeric ( $_GET ['c'] );
	$sql = "SELECT idcliente, txtnome FROM cliente WHERE idcliente=" . $cliente . " ";
	$querycliente = $db->query ( $sql );
	$rowcliente = $db->fetch_assoc ( $querycliente );
	$idcliente = $rowcliente ['idcliente'];
	$txtnome = ucwords ( strtolower ( $rowcliente ['txtnome'] ) );
} else {
	$idcliente = 0;
	$txtnome = '';
}

// Distinguindo tipo de venda
$txt_tipo_venda = "";
$key_tipo_venda = null;

switch (strtolower ( $_REQUEST ['t'] )) {
	case "vip" :
		$txtTipoVenda = "VIP";
		$key_tipo_venda = "vip";
		break;
	
	case "normal" :
		$txtTipoVenda = "Normal";
		$key_tipo_venda = "normal";
		break;
	
	default :
		$txtTipoVenda = "Normal";
		$key_tipo_venda = "normal";
		break;
}

if (isset ( $_REQUEST ['d'] )) {
	
	$valor_desconto = $_REQUEST ['d'];
	$valor_desconto_final = $_REQUEST ['d_final'];
} else
	$valor_desconto = array_sum ( $_SESSION ['carrinho_venda'] ['produto_desconto'] );

$valor_real = $valorvenda + (- 1 * $valor_desconto);

?>

<fieldset id="p"><legend>Fechar Venda <?=$txtTipoVenda;?></legend>
<div class="linha_separador"><input type="hidden" value="<?=$_SESSION['tipovenda']?>" id="tipo_venda" />
		<?
		$sql = "SELECT id, nome FROM cad_login WHERE id=" . $usuario . "";
		$query = $db->query ( $sql );
		$row = $db->fetch_assoc ( $query );
		?>
		<input type="hidden" id="usuario" value="<?=$row ['id'];?>">
<table width="100%">
	<tr>
		<td width="72" valign="top"><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/vendanormal_72.png" class="t72" /></td>
		<td align="right">
		<table>
			<tr>
				<td height="25"><b>Vendedor</b></td>
				<td align="right"><b><?=ucwords ( strtolower ( $row ['nome'] ) );?></b></td>
			</tr>
			<? if ($_SESSION['tipovenda'] == 'normal') { ?>
			<tr>
				<td height="10"><b>Valor da venda</b></td>
				<td align="right"><b>R$ <?=number_format ( $valor_real, 2, ',', '.' );?></b></td>
			</tr>
			<tr>
				<td height="10"><b>Desconto/Acr�scimo</b></td>
				<td align="right"><b>R$ <?=number_format ( $valor_desconto, 2, ',', '.' );?></b></td>
			</tr>
			<tr>
				<td height="10"><b>Total</b></td>
				<td align="right"><b>R$ <?=number_format ( $valorvenda, 2, ',', '.' );?></b></td>
			</tr>
			<? } ?>
		</table>
		</td>
	</tr>
</table>
</div>
<div id="venda_normal">
<table width="377" border="0">
	<tr>
		<td height="0"></td>
	</tr>
	<tr>
		<td height="35" valign="middle">
		<div id="clientevenda" style="float:left;display:<?=($idcliente > 0) ? 'none' : 'block';?>;">
		<table width="100%" border="1">
			<tr>
				<td width="20"><span id="titcliente"></td>
				<td width="100%"><b style="color: blue;">Nenhum cliente selecionado</b></td>
				<td align="right" width="100"><input type="button" value="selecionar" id="btnselecionarcliente" class="botao" style="width: 80px;" onclick="javascript:carrega_selecionarcliente_venda();this.style.display=(this.style.display=='none')?'block':'none';" /></td>
				<td align="right" width="100"><input type="button" value="adicionar" id="btnadicionarcliente" class="botao green btn_adicionargreen" style="width: 80px; display: none;" onclick="javascript:carrega_selecionaclientevenda();" /></td>
			</tr>
		</table>
		</div>
		<div id="clientevendaselecionado" style="display:<?=($idcliente > 0) ? 'block' : 'none';?>;">
		<input type="hidden" id="inputclientevendaselecionado" value="<?=$idcliente;?>">
		<table width="100%">
			<tr>
				<td width="20"><span id="titcliente"></td>
				<td width="100%"><span id="nomeclientevendaselecionado"><?=$txtnome;?></span></td>
				<td align="right" width="120"><input type="button" value="alterar / retirar" class="botao btn_avancar" style="width: 130px;display:<?=($_SESSION['tipovenda']=='normal')?'block':'none';?>" onclick="javascript:carrega_voltarselecionaclientevenda();" /></td>
			</tr>
		</table>
		</div>
		</td>
	</tr>
	<tr>
		<td height="0"></td>
	</tr>
	<tr>
		<td>
		<div id="formadepagamento" style="display:<?=($key_tipo_venda) == 'normal' ? 'block;' : 'none;';?>;">
		<table border="0" width="100%">
			<tr>
				<td>
				<table width="100%">
					<tr>
						<td><b>Formas de Pagamento</b></td>
						<td align="right"><span id="msgformapag"></span></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td class="l3"></td>
			</tr>
			<tr>
				<td>
				<div id="formapagamento">
				<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td height="30">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tr>
								<td width="30" align="center"><input type="checkbox" id="dinheiro" onchange="javascript:vendas_vendanormal_pagdinheiro();"></td>
								<td><b>Dinheiro</b></td>
								<td align="right">
								<div id="pag_dinheiro" style="display: none;">
								<table>
									<tr>
										<td><b>R$</b></td>
										<td width="5"></td>
										<td><input type="text" id="valor_dinheiro" style="width: 70px; text-align: right;" onclick="javascript:this.value='';" onfocus="javascript:this.value='';" onkeydown="javascript:formata_valor('valor_dinheiro', 13, event);" /></td>
									</tr>
								</table>
								</div>
								</td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td class="l3"></td>
					</tr>
					<tr>
						<td height="30">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tr>
								<td width="30" align="center"><input type="checkbox" id="cheque" onchange="javascript:Sell.SelectCustomerCheque();"></td>
								<td><b>Cheque</b></td>
								<td align="right">
								<div id="pag_cheque" style="display: none;">
								<table>
									<tr>
										<td width="5"></td>
										<td>
											<input type="hidden" id="banco_nome" /> 
											<select id="select_banco" style="width:130px;" onchange="javascript:Sell.SelectBank();" />
												<option value="">selecione o banco</option>
												<?
												$sqlbanco = "SELECT id, nome FROM cad_bancos WHERE status=1 ORDER BY nome ASC";
												$querybanco = $db->query ( $sqlbanco );
												while ( $rowbanco = $db->fetch_assoc ( $querybanco ) ) {
													?>
												<option value="<?=ucwords(strtolower($rowbanco['nome']));?>"><?=ucwords(strtolower($rowbanco ['nome']));?></option>
												<?
												}
												?>
											</select>
										</td>
										<td width="5"></td>
										<td>
											<input type="hidden" id="cheque_qtd" value="0" /> 
											<select id="select_cheque" style="width: 105px;" onchange="javascript:Sell.SelectBank();" />
												<?
												for($i = 1; $i < 13; $i ++) {
												?>
												<option value="<?=$i;?>">&nbsp;&nbsp;<?=$i;?>&nbsp;&nbsp;<?=($i < 10) ? '&nbsp;&nbsp;' : '';?> cheque<?=($i == 1) ? '' : 's';?></option>
												<?
												}
												?>
											</select>
										</td>
									</tr>
								</table>
								</div>
								</td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td class="l3"></td>
					</tr>
					<tr>
						<td height="30">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tr>
								<td width="30" align="center"><input type="checkbox" id="debito" onchange="javascript:vendas_vendanormal_pagdebito();" /></td>
								<td><b>Cart�o D�bito</b></td>
								<td align="right">
								<div id="pag_debito" style="display: none;">
								<table>
									<tr>
										<td><b>R$</b></td>
										<td width="5"></td>
										<td><input type="text" id="valor_debito" style="width: 70px; text-align: right;" onclick="javascript:this.value='';" onkeydown="javascript:formata_valor('valor_debito', 13, event)"></td>
										<td width="5"></td>
										<td>
											<select id="tipo_cartaodebito" style="width: 140px;">
												<?
												$sql = "SELECT id, nome FROM cad_cartoes WHERE status=1 AND debito=1 ORDER BY nome ASC";
												$query = $db->query($sql);
												while ($row = $db->fetch_assoc($query)) {
												?>
												<option value="<?=$row['id'];?>">&nbsp;&nbsp;<?=ucwords(strtolower($row['nome']));?>&nbsp;&nbsp;</option>
												<?
												}
												?>
											</select>
										</td>
									</tr>
								</table>
								</div>
								</td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td class="l3"></td>
					</tr>
					<tr>
						<td height="30">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tr>
								<td width="30" align="center"><input type="checkbox" id="credito" onchange="javascript:carrega_exibicao_credito();exibe_btnconcretizar();vendas_vendanormal_pagcredito();" /></td>
								<td><b>Cart�o Cr�dito</b></td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td class="l3"></td>
					</tr>
					<tr>
						<td height="10"></td>
					</tr>
				</table>
				</div>
				</td>
			</tr>
		</table>
		</div>
		</td>
	</tr>
	<tr>
		<td>
			<input type="hidden" id="valorrealvenda" value="<?=str_replace ( ',', '', number_format ( $valor_real, 2 ) );?>" /> 
			<input type="hidden" id="valortotalvenda" value="<?=str_replace ( ',', '', number_format ( $valorvenda, 2 ) );?>" /> 
			<input type="hidden" id="opcvendatotal" value="<?=$valor_desconto;?>" /> 
			<input type="hidden" id="opcvendatotal_final" value="<?=$valor_desconto_final;?>" />
		<table width="100%">
			<tr>
				<td height="25"><input type="button" class="botao btn_irpara" id="btnvoltarvenda" value="voltar para venda" onclick="javascript:carregar_voltarparavenda();" /></td>
				<td align="right">
					<?
					if ($key_tipo_venda == "vip") {
					?>
					<input type="button" class="botao green btn_simgreen" id="btnconfirmapagamento" value="confirmar fechamento" style="width: 170px; display: none;" onclick="javascript:carrega_confirmapagamento();" />
					<?
					} else {
					?>
					<input type="button" class="botao green btn_simgreen" id="btnconfirmapagamento" value="confirmar pagamento" style="width: 170px; display: none;" onclick="javascript:Sell.ConfirmPayment();" />
					<?
					}
					?>
					<input type="button" class="botao green btn_simgreen" value="finalizar venda" id="btnfinalizarvenda" style="width: 130px; display: none;" onclick="javascript:carrega_finalizarvenda();" />
				</td>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</div>

</fieldset>