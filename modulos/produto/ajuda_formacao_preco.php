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


<fieldset id="p"><legend>Mark-Up ( beta )</legend>

<div class="linha_separador">
<table width="100%">
	<tr>
		<td><b>Escolha uma das opções abaixo</b></td>
	</tr>
	<tr>
		<td>
		<table>
			<tr>
				<td><input type="radio" onclick=""></td>
				<td width="5"></td>
				<td>Mark-Up Simples</td>
				<td width="10"></td>
				<td><input type="radio" onclick=""></td>
				<td width="5"></td>
				<td>Mark-Up avançado</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</div>

<div style="width: 377px; height: 350px; overflow: auto;">
<table width="377" cellpadding="6" cellspacing="6">
	<tr>
		<td height="25" bgcolor="#6aa9e9" align="center"><b style="color: white;">Mark-Up avançado</b></td>
	</tr>
	<tr>
		<td>

		<table width="100%">
			<tr>
				<td align="center">
				<div id="resposta_markup"></div>
				<div id="markup_avancado">
				<table>
					<tr>
						<td colspan="5" height="25"><b>Impostos</b></td>
					</tr>
					<tr>
						<td width="60" height="25">IR</td>
						<td width="20"><input type="text" id="ir" style="width: 40px; text-align: right;" /></td>
						<td>%</td>
						<td width="10"></td>
						<td align="right"><a href="#" onMouseover="ddrivetip('<font style=color:#fff><b>O que é Cofins?</b><BR>Contribuição para Financiamento da Seguridade Social. É um tributo cobrado pela União sobre o faturamento bruto das pessoas jurídicas, destinado a atender programas sociais do Governo Federal.</font>','#6aa9e9', 250);" onMouseout="hideddrivetip()">[ ? ]</a></td>

						<td width="50"></td>

						<td width="60" height="25">Cofins</td>
						<td width="20"><input type="text" id="cofins" style="width: 40px; text-align: right;" /></td>
						<td>%</td>
						<td width="10"></td>
						<td align="right"><a href="#" onMouseover="ddrivetip('<font style=color:#fff><b>O que � Cofins?</b><BR>Contribui��o para Financiamento da Seguridade Social. � um tributo cobrado pela Uni�o sobre o faturamento bruto das pessoas jur�dicas, destinado a atender programas sociais do Governo Federal.</font>','#6aa9e9', 250);" onMouseout="hideddrivetip()">[ ? ]</a></td>
					</tr>
					<tr>
						<td height="25">ICMS</td>
						<td><input type="text" id="icms" style="width: 40px; text-align: right;" /></td>
						<td>%</td>
						<td width="10"></td>
						<td align="right"><a href="#" onMouseover="ddrivetip('<font style=color:#fff><b>O que � ICMS?</b><BR>Imposto sobre Opera��es Relativas � Circula��o de Mercadorias e sobre Presta��o de Servi�os de Transporte Interestadual e Intermunicipal e de Comunica��o, tamb�m chamado de Imposto sobre Circula��o de Mercadorias e Servi�os. � um imposto estadual n�o-cumulativo.</font>','#6aa9e9', 250);" onMouseout="hideddrivetip()">[ ? ]</a></td>

						<td width="50"></td>

						<td height="25">PIS</td>
						<td><input type="text" id="pis"
							style="width: 40px; text-align: right;"></td>
						<td>%</td>
						<td width="10"></td>
						<td align="right"><a href="#" onMouseover="ddrivetip('<font style=color:#fff><b>O que � PIS?</b><BR>Programas de Integra��o Social e de Forma��o do Patrim�nio do Servidor P�blico. Para mant�-los, as pessoas jur�dicas s�o obrigadas a contribuir com uma al�quota vari�vel sobre o total das receitas, com exce��o das microempresas e empresas de pequeno porte que estejam aderido ao SIMPLES.</font>','#6aa9e9', 250);" onMouseout="hideddrivetip()">[ ? ]</a></td>
					</tr>
					<tr>
						<td height="25">Outro</td>
						<td><input type="text" id="outro"
							style="width: 40px; text-align: right;"></td>
						<td>%</td>
						<td width="10"></td>
						<td align="right"><a href="#" onMouseover="ddrivetip('<font style=color:#fff><b>Outro Imposto</b><BR>Campo opcional caso haja algum outro imposto que deseje incluir.</font>','#6aa9e9', 250);" onMouseout="hideddrivetip()">[ ? ]</a></td>
					</tr>
					<tr>
						<td colspan="5" height="25"><b>Despesas</b></td>
					</tr>
					<tr>
						<td height="25">Cart�o</td>
						<td><input type="text" id="cartao"
							style="width: 40px; text-align: right;"></td>
						<td>%</td>
						<td width="10"></td>
						<td align="right"><a href="#" onMouseover="ddrivetip('<font style=color:#fff><b>Venda com cart�o</b><BR>Especifique o valor m�dio em porcentagem da taxa cobrada sobre a venda com cart�o de cr�dito e d�bito.</font>','#6aa9e9', 250);" onMouseout="hideddrivetip()">[ ? ]</a></td>
					</tr>
					<tr>
						<td height="25">Comiss�o</td>
						<td><input type="text" id="comissao"
							style="width: 40px; text-align: right;"></td>
						<td>%</td>
						<td width="10"></td>
						<td align="right"><a href="#" onMouseover="ddrivetip('<font style=color:#fff><b>Comiss�o</b><BR>Especifique o valor m�dio em porcentagem das comiss�o sobre a venda de direito do vendedor.</font>','#6aa9e9', 250);" onMouseout="hideddrivetip()">[ ? ]</a></td>

						<td width="50"></td>

						<td height="25">Outra</td>
						<td><input type="text" id="outra"
							style="width: 40px; text-align: right;"></td>
						<td>%</td>
						<td width="10"></td>
						<td align="right"><a href="#" onMouseover="ddrivetip('<font style=color:#fff><b>Outra Despesa</b><BR>Campo opcional caso haja alguma outra despesa que deseje incluir.</font>','#6aa9e9', 250);" onMouseout="hideddrivetip()">[ ? ]</a></td>
					</tr>
					<tr>
						<td colspan="11" align="left"><input type="button" class="botao" onclick="javascript:calcular_markupavancado('0');" value="Calcular Mark-Up" /></td>
					</tr>
				</table>
				</div>
				</td>
			</tr>
		</table>

		</td>
	</tr>
</table>
</div>

</fieldset>