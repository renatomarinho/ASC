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

$IR = (isset ( $_POST ['ir'] )) ? $_POST ['ir'] : 0;
$cofins = (isset ( $_POST ['cofins'] )) ? $_POST ['cofins'] : 0;
$icms = (isset ( $_POST ['icms'] )) ? $_POST ['icms'] : 0;
$pis = (isset ( $_POST ['pis'] )) ? $_POST ['pis'] : 0;
$outro = (isset ( $_POST ['outro'] )) ? $_POST ['outro'] : 0;

$total_impostos = $IR + $cofins + $icms + $pis + $outro;

$cartao = (isset ( $_POST ['cartao'] )) ? $_POST ['cartao'] : 0;
$comissao = (isset ( $_POST ['comissao'] )) ? $_POST ['comissao'] : 0;
$outra = (isset ( $_POST ['outra'] )) ? $_POST ['outra'] : 0;

$total_despesas = $cartao + $comissao + $outra;

$total_porcentagem = ($total_impostos + $total_despesas) / 100;

$markup = 1 / (1 - $total_porcentagem);
$markup = number_format ( $markup, 5 );

$vlcusto = (isset ( $_POST ['vlcusto'] )) ? $_POST ['vlcusto'] : 0;

if (isset ( $_POST ['lucro'] )) {
	
	$lucro = $_POST ['lucro'];
	$total_porcentagem_c_lucro = ($total_impostos + $total_despesas + $lucro) / 100;
	
	$markup_c_lucro = 1 / (1 - $total_porcentagem_c_lucro);
	$markup_c_lucro = number_format ( $markup_c_lucro, 5 );
	
	$preco_varejo_c_lucro = $vlcusto * $markup_c_lucro;

} else {
	$lucro = '0';
}

$preco_varejo = $vlcusto * $markup;

?>

<table width="100%">
	<tr>
		<td height="25"><b>Resultado do Mark-Up</b></td>
	</tr>
	<tr>
		<td style="border: 1px solid #c0c0c0"></td>
	</tr>
	<tr>
		<td>
		<table width="100%">
			<tr>
				<td height="25">Mínimo para a venda varejo</td>
				<td align="right"><?=$markup;?></td>
			</tr>
			<tr>
				<td height="25">Minimo para o produto</td>
				<td align="right">R$ <?=number_format ( $preco_varejo, 2 );?></td>
			</tr>
			<tr>
				<td height="25">Aplicar preço no produto</td>
				<td align="right"><select onchange="javascript:document.getElementById(this.value).value='<?=number_format ( $preco_varejo, 2 );?>';">
					<option>Selecione</option>
					<option value="vlatacado">Aplicar no preço de atacado</option>
					<option value="vlvarejo">Aplicar no preço de varejo</option>
				</select></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td style="border: 1px solid #c0c0c0"></td>
	</tr>
	<tr>
		<td>
		<div id="respobtermeulucro" style="display:<?=(isset ( $_POST ['lucro'] ) ? 'block' : 'none');?>">
		<table width="100%">
			<tr>
				<td height="25">Mínimo para a venda varejo c/ lucro</td>
				<td align="right"><?=$markup_c_lucro;?></td>
			</tr>
			<tr>
				<td height="25">Mínimo para o produto com lucro</td>
				<td align="right">R$ <?=number_format ( $preco_varejo_c_lucro, 2 );?></td>
			</tr>
			<tr>
				<td height="25">Aplicar preço no produto</td>
				<td align="right"><select onchange="javascript:document.getElementById(this.value).value='<?=number_format ( $preco_varejo_c_lucro, 2 );?>';">
					<option>Selecione</option>
					<option value="vlvarejo">Aplicar no preço de varejo</option>
					<option value="vlatacado">Aplicar no preço de atacado</option>
				</select></td>
			</tr>
		</table>
		</div>
		</td>
	</tr>
	<tr>
		<td style="border: 1px solid #c0c0c0"></td>
	</tr>
	<tr>
		<td>

		<div id="obtermeulucro">
		<table width="100%">
			<tr>
				<td height="25">Acrescentar o meu lucro sobre o produto</td>
				<td width="10"></td>
				<td align="right"><input type="text" id="meulucrovarejo" style="width: 40px; text-align: right;" value="<?=$lucro;?>"> %</td>
			</tr>
			<tr>
				<td colspan="3">
				<table width="100%">
					<tr>
						<td><input type="button" class="botao" onclick="javascript:ajuda_definir_preco();;" value="Recalcular Mark-Up" /></td>
						<td align="right"><input type="button" class="botao" onclick="javascript:calcular_markupavancado('1');" value="Calcular com Lucro" /></td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</div>

		</td>
	</tr>
</table>