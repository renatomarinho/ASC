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

$titulo_venda = "";
$titulo_principal_venda = "Estornar Venda";
$tipo_venda = "";

if (strtolower ( $_REQUEST ['tipo_venda'] ) == "vip") {
	$titulo_venda = "VIP";
	$tipo_venda = "vip";
	$titulo_principal_venda = "Retornar Produto Venda Vip";
}

?>

<fieldset id="p"><legend><?=$titulo_principal_venda;?></legend>

<div class="linha_separador" style="height: 15px;">
<center><b style="color: blue;">Escolha uma das op��es abaixo para
efetuar um estorno</b></center>
</div>

<div>
<table width="377">
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td>
		<div id="formcontroledez">
		<table width="100%">
			<tr>
				<td align="right"><input type="button" class="botao"
					value="exibir as 10 �ltimas vendas <?=strtolower ( $titulo_venda )?> realizadas"
					style="cursor: pointer; cursor: hand; width: 280px;"
					onclick="javascript:carrega_estornocontrolevendadez('<?=$tipo_venda?>');"></td>
			</tr>
						<?
						if ($tipo_venda == "vip") {
							?>
							<tr>
				<td align="right"><input type="button" class="botao_inativo"
					disabled value="exibir as 10 �ltimas vendas vips n�o retornadas"
					style="width: 280px;"
					onclick="javascript:carrega_estornocontrolevendadez('<?=$tipo_venda?>');"></td>
			</tr>
							<?
						}
						?>
					</table>
		</div>
		</td>
	</tr>
	<tr>
		<td>
		<div id="formcontrole">
		<table width="100%">
			<tr>
				<td colspan="5" height="15"><span id="msgerroestorno"></span></td>
			</tr>
			<tr>
				<td><b>Controle</b></td>
				<td width="5"></td>
				<td><input type="text" id="ncontrole" maxlength="14"
					style="width: 160px; font-size: 14px;"
					onkeypress="returnCallBack(event, <?=$tipo_venda == "vip" ? 'carrega_estorno_venda_vip()' : 'carrega_estornocontrolevenda'?>)"></td>
				<td width="5"></td>
				<td align="right"><input type="button" class="botao" value="buscar"
					style="cursor: pointer; cursor: hand; width: 80px;"
					onclick="javascript:<?=$tipo_venda == "vip" ? 'carrega_estorno_venda_vip()' : 'carrega_estornocontrolevenda()'?>;"></td>
			</tr>
		</table>
		</div>
		</td>
	</tr>
	<tr>
		<td style="border-top: 2px solid black"></td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td>
		<div id="apresenta_dadosvenda" style="display: none;">
		<table width="100%">
			<tr>
				<td height="25"><span id="titdadosvenda"><b>Dados da venda</b></span></td>
			</tr>
			<tr>
				<td style="border-top: 2px solid black"></td>
			</tr>
			<tr>
				<td>
				<div id="dadosvenda"></div>
				</td>
			</tr>
		</table>
		</div>
		</td>
	</tr>
</table>
</div>

</fieldset>