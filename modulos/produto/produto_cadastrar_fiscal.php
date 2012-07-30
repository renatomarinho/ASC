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

if (isset ( $_GET ['id'] )) {
	$idproduto = $_GET ['id'];
} else {
	$idproduto = 0;
}

?>


<fieldset id="p"><legend>Adicionar Informa��es Fiscais do Produto</legend>

<div class="linha_separador" style="height: 28px;">
<center><span id="msggrade"><b style="color: red;">Os dados da nota
fiscal n�o s�o obrigat�rios</b><BR>
<b style="color: blue;">Para finalizar a inclus�o do produto clique em
"concluir"</b><span></center>
</div>

<div>

<table width="370">
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td height="20">
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td align="left"><b>Nota fiscal do<?=($_SESSION ['produto'] ['qtdestoque'] == 1) ? '' : 's';?> produto<?=($_SESSION ['produto'] ['qtdestoque'] == 1) ? '' : 's';?></b></td>
				<td align="right"><span id="msgerro"></span></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td>
		<table width="100%">
			<tr>
				<td height="20" width="80"><b>Fornecedor</b></td>
				<td>
							<?
							if ($_SESSION ['produto'] ['fornecedor'] > 0) {
								$sqlfornecedor = "SELECT nome FROM fornecedor WHERE idfornecedor=" . $_SESSION ['produto'] ['fornecedor'] . "";
								$queryfornecedor = $db->query ( $sqlfornecedor );
								$rowfornecedor = $db->fetch_assoc ( $queryfornecedor )?>
							<?=ucwords ( strtolower ( $rowfornecedor ['nome'] ) );?>
							<?
							} else {
								?>
							<select id="fornecedornotafiscal" style="width: 160px;">
					<option value="0">selecione</option>
								<?
								$sqlfornecedor = "SELECT idfornecedor, nome FROM fornecedor ORDER BY txtnome ASC";
								$queryfornecedor = $db->query ( $sqlfornecedor );
								while ( $rowfornecedor = $db->fetch_assoc ( $queryfornecedor ) ) {
									echo '<option value="' . $rowfornecedor ['idfornecedor'] . '">' . ucwords ( strtolower ( $rowfornecedor ['nome'] ) ) . '</option>';
								}
								?>
							</select>
							<?
							}
							?>
							</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td height="5" style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td>
		<table width="100%">
			<tr>
				<td width="50%">
				<table width="100%">
					<tr>
						<td height="15"><b>N� nota</b></td>
					</tr>
					<tr>
						<td height="25"><input type="text" id="nnota"></td>
					</tr>
					<tr>
						<td height="15"><b>ICMS</b></td>
					</tr>
					<tr>
						<td height="15">R$&nbsp;&nbsp;<input type="text" id="icms"
							onkeydown="javascript:formata_valor('icms', 13, event);"
							style="width: 60px; text-align: right;" maxlength="12"></td>
					</tr>
					<tr>
						<td height="15"><b>Frete</b></td>
					</tr>
					<tr>
						<td height="15">R$&nbsp;&nbsp;<input type="text" id="frete"
							onkeydown="javascript:formata_valor('frete', 13, event);"
							style="width: 60px; text-align: right;" maxlength="12"></td>
					</tr>
					<tr>
						<td height="15"><b>Valor desc.</b></td>
					</tr>
					<tr>
						<td height="15">R$&nbsp;&nbsp;<input type="text" id="vldesc"
							onkeydown="javascript:formata_valor('vldesc', 13, event);"
							style="width: 60px; text-align: right;" maxlength="12"></td>
					</tr>
				</table>
				</td>
				<td width="50%">
				<table width="100%">
					<tr>
						<td height="15"><b>Data emiss�o</b></td>
					</tr>
					<tr>
						<td height="25">
						<table>
							<tr>
								<td><select id="dianota" style="width: 40px;">
															<?
															for($n = 1; $n <= 31; $n ++) {
																?>
															<option value="<?=$n;?>"
										<?=(date ( 'd' ) == $n) ? 'selected' : '';?>><?=$n;?></option>
															<?
															}
															?>
														</select></td>
								<td><select id="mesnota" style="width: 76px;">
															<?
															for($n = 1; $n <= 12; $n ++) {
																?>
															<option value="<?=$n;?>"
										<?=(date ( 'm' ) == $n) ? 'selected' : '';?>><?=$meses [$n];?></option>
															<?
															}
															?>
														</select></td>
								<td><select id="anonota">
															<?
															$ano_inicial = date ( 'Y' );
															$ano_final = $ano_inicial + 3;
															for($n = $ano_inicial; $n <= $ano_final; $n ++) {
																?>
															<option value="<?=$n;?>"
										<?=(date ( 'Y' ) == $n) ? 'selected' : '';?>><?=$n;?></option>
															<?
															}
															?>
														</select></td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td height="15"><b>ICMS Sub.</b></td>
					</tr>
					<tr>
						<td height="15">R$&nbsp;&nbsp;<input type="text" id="icmssub"
							onkeydown="javascript:formata_valor('icmssub', 13, event);"
							style="width: 60px; text-align: right;" maxlength="12"></td>
					</tr>
					<tr>
						<td height="15"><b>IPI</b></td>
					</tr>
					<tr>
						<td height="15">R$&nbsp;&nbsp;<input type="text" id="ipi"
							onkeydown="javascript:formata_valor('ipi', 13, event);"
							style="width: 60px; text-align: right;" maxlength="12"></td>
					</tr>
					<tr>
						<td height="15"><b>Valor total</b></td>
					</tr>
					<tr>
						<td height="15">R$&nbsp;&nbsp;<input type="text" id="vltotal"
							onkeydown="javascript:formata_valor('vltotal', 13, event);"
							style="width: 60px; text-align: right;" maxlength="12"></td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td height="25"></td>
	</tr>
	<tr>
		<td>
		<table width="100%">
			<tr>
				<td align="left"><input type="button" class="botao"
					id="cancelarproduto" value="Cancelar"
					style="cursor: pointer; cursor: hand; width: 140px; background-color: red;"
					onClick="javascript:carrega_listagemprodutos(path+'modulos/produto/lista.php','conteudo_total');"></td>
				<td align="right"><input type="button" class="botao"
					id="salvarproduto" value="Concluir"
					style="cursor: pointer; cursor: hand; width: 140px; background-color: green;"
					onclick="javascript:cadastro_produto_adicionarsalvar();"></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td height="5" style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td height="20"><b style="color: green">CONCLUIR</b> clique para
		finalizar a inclus�o do produto</td>
	</tr>
	<tr>
		<td height="20"><b style="color: red">CANCELAR</b> clique para
		cancelar a inclus�o do produto</td>
	</tr>
</table>

</div>

</fieldset>

