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
<!--
<meta name="nome_fake" content="Fluxo de Caixa">
<meta name="nome_rvs" content="fluxo_caixa.php">
<meta name="localizacao" content="/modulos/caixa">
<meta name="descricao" content="-">
</head>
-->
<?

/**
 *   1 - Compra de produtos (cadastrar valor total e datas de pagamentos) 
 *   2 - Contas a pagar (cadastrar todas as contas a pagar sendo estas mensal ou unica) 
 *   3 - Entradas futuras de Cartao de Credito 
 *   4 - Entradas futuras de Cheque  
 * 
 * 	 Sua equa��o gen�rica �:
 * 
 *   	Saldo Inicial + Entradas � Sa�das = Saldo Final
 * 
 *   Na equa��o acima as express�es �saldo inicial� e �saldo final� referem-se aos saldos do Dispon�vel no in�cio e no final do per�odo considerado.
 * 
 *   Tipos de Fluxo de caixa : direto, estrutural, conjuntural, composto
 * 
 * 	 Obs : Ora, se este empr�stimo n�o for expurgado, n�o poderemos determinar a capacidade de gera��o de caixa do neg�cio. Este ajuste � feito �de *	 salavancando� o fluxo de caixa, ou seja, considerando que todos os pagamentos vencidos no per�odo tenham sido pagos, mesmo que n�o o tenham.
 * 
 */

?>

<fieldset id="m"><legend>Fluxo de Caixa</legend>

<div class="linha_separador" style="width: 480px;">

<table width="100%">
	<tr>
		<td align="left" width="160"><input type="button"
			value="estat�sticas fornecedores" class="botao"
			style="cursor: pointer; cursor: hand; width: 160px;"
			onclick="javascript:historicofornecedor();document.getElementById('adicionarfornecedor').style.display='block';"></td>
		<td align="center"><input type="button" value="comparar fornecedores"
			class="botao" style="cursor: pointer; cursor: hand; width: 160px;"
			onclick="javascript:comparar_colecoes();"></td>
		<td align="right" width="140"><input type="button"
			value="adicionar fornecedor" id="adicionarfornecedor" class="botao"
			style="cursor: pointer; cursor: hand; width: 140px;"
			onclick="javascript:adicionar_fornecedor();this.style.display='none';"></td>
	</tr>
</table>

</div>

<div></div>

</fieldset>