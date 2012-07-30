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

<fieldset id="m"><legend><span id="titmain">Venda Carrinho</span> [ <?=$_SESSION ['controlevenda'];?> ]</legend>

<div id="carrinho_header" style="display: 'block';"></div>

<div id="carrinho_counteudo"></div>

<div id="cancelar_venda"></div>

</fieldset>
<?
exit ();
?>

<div id="produtosselecionarcliente_sim"></div>

<div id="produtosselecionados" style="display: none;">
<div class="linha_separador" style="width: 480px;">
<table width="100%">
	<tr>
		<td><span id="titlistagem"><b>Produtos adicionados ao carrinho</b></span></td>
	</tr>
	<tr>
		<td width="20" valign="middle">
		<div style="border-top: 1px solid #c0c0c0"></div>
		</td>
	</tr>
	<tr>
		<td>
		<div id="produtosselecionadoslista" style="overflow: auto; height: 100px; width: 480px"></div>
		</td>
	</tr>
	<tr>
		<td width="20" valign="middle">
		<div style="border-top: 1px solid #c0c0c0"></div>
		</td>
	</tr>
	<tr>
		<td height="28">
		<table width="100%">
			<tr>
				<td>
				<table width="230" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td>
							<input type="button" value="fechar venda" class="botao green btn_simgreen" id="btnfechar" style="width: 120px; display: none;" onclick="javascript:carregar_fecharvenda();">
							<input type="button" value="voltar para venda" class="botao" id="btnvoltarvenda" style="cursor: pointer; cursor: hand; width: 120px; display: none;" onclick="javascript:carregar_voltarparavenda();">
						</td>
						<td width="10"></td>
						<td><input type="button" value="cancelar venda" class="botao red btn_naored" id="btncancelar" style="width: 100px; display: none;" onclick="javascript:carregar_cancelarvendaconfirmacao();"></td>
					</tr>
				</table>
				</td>
				<td align="right">
				<h1 id="totalvenda"></h1>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</div>
</div>

<div id="produtoslistagem" style="overflow: auto; height: 0px; width: 502px"></div>

