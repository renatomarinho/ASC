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
?>
<div class="linha_separador" style="width: 480px; height: 100px;">
<table width="100%" height="100%" border="0">
	<tr>
		<td>
			<div id="dadosgerais_venda" style="display: none;">
			<table cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td height="25"><input type="button" value="ir para o carrinho" class="botao btn_irpara" id="btnircarrinho" style="display: none;" onclick="javascript:carrega_carrinholista('?solista=true');"></td>
				</tr>
				<tr>
					<td height="10"></td>
				</tr>
				<tr>
					<td height="20">
					<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td align="left" width="85"><b><?=($_SESSION['tipovenda']=='normal')?'Valor da Venda':'';?></b></td>
							<td align="right" width="20"><?=($_SESSION['tipovenda']=='normal')?'R$&nbsp;':'';?></td>
							<td align="right">
							<div id="valor_total_venda" style="display:<?=($_SESSION['tipovenda']=='normal')?'block':'none';?>">0.00</div>
							</td>
						</tr>
					</table>
					<input type="hidden" value="0.00" id="input_total_venda" /> 
					<input type="hidden" value="0.00" id="input_total_venda_tmp" />
					</td>
				</tr>
				<tr>
					<td height="20">
					<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td align="left" width="85"><b><?=($_SESSION['tipovenda']=='normal')?'Desc/Acr&eacute;sc':'';?></b></td>
							<td align="right" width="20">
							<div id="rs_da"><?=($_SESSION['tipovenda']=='normal')?'R$&nbsp;':'';?></div>
							</td>
							<td align="right">
								<div id="valor_desconto_acrescimo" style="display:<?=($_SESSION['tipovenda']=='normal')?'block':'none';?>">0.00</div>
							</td>
						</tr>
					</table>
					<input type="hidden" value="0.00" id="input_total_desconto_acrescimo" /> 
					<input type="hidden" value="0.00" id="input_total_desconto_acrescimo_tmp" />
					</td>
				</tr>
				<tr>
					<td height="20">
					<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td align="left" width="85"><b><?=($_SESSION['tipovenda']=='normal')?'Total':'';?></b></td>
							<td align="right" width="20"><?=($_SESSION['tipovenda']=='normal')?'R$&nbsp;':'';?></td>
							<td align="right">
							<div id="valor_total_final" style="display:<?=($_SESSION['tipovenda']=='normal')?'block':'none';?>">0.00</div>
							</td>
						</tr>
					</table>
					<input type="hidden" value="0.00" id="input_total_final" /> 
					<input type="hidden" value="0.00" id="input_total_final_tmp" />
					</td>
				</tr>
			</table>
			</div>
		</td>
		<td align="right" valign="top">
			<div id="btns_header" style="display: none;">
			<table cellpadding="0" cellspacing="0" border="1">
				<tr>
					<td height="25" width="165">
					<div id="div_btnopcional_final"><input class="botao btn_diminuir" type="button" onclick="javascript:produto_abriropcional_final();" style="width: 100px;display:<?=($_SESSION['tipovenda']=='normal')?'block':'none';?>" value="opcional" /></div>
					</td>
					<td height="25"><input type="button" value="fechar venda" id="btnfechar" class="botao green btn_simgreen" style="width: 130px;" onclick="javascript:carregar_fecharvenda();"></td>
				</tr>
				<tr>
					<td height="10" colspan="2"></td>
				</tr>
				<tr>
					<td width="85" align="left">
					<div id="div_desconto_final" style="display: none;">
						<input id="precoprodutoselecionadototal_final" type="hidden" value="" style="border: medium none; width: 80px; font-size: 16px; font-weight: bold; color: blue; text-align: right; background-color: rgb(255, 255, 255);" readonly="" />
					</div>
					</td>
					<td height="25" align="right">
						<input type="button" value="cancelar venda" id="btncancelar" class="botao red btn_naored" style="width: 130px;" onclick="javascript:produto_selecionadofechar();">
					</td>
				</tr>
			</table>
			</div>
		</td>
	</tr>
</table>
</div>