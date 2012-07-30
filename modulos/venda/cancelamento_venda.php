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

//unset($_SESSION['carrinho_venda']);


?>


<fieldset id="m"><legend>Cancelamento da Venda em Andamento</legend>

<div class="linha_separador" style="width: 480px;">

<table width="100%">
	<tr>
		<td align="center">
		<h1 style="color: red">A venda foi cancelada com sucesso</h1>
		</td>
	</tr>
</table>

</div>

<div><input type="hidden" id="cliente"> <input type="hidden"
	id="usuario"> <input type="hidden" id="controle"
	value="<?=$_SESSION ['controlevenda'];?>"> <input type="hidden"
	id="valortotal">
<table width="100%">
	<tr>
		<td height="25"></td>
	</tr>
	<tr>
		<td align="center">
		<table>
			<tr>
				<td>
				<h1>Vamos melhorar os nossos processos internos?</h1>
				</td>
			</tr>
			<tr>
				<td height="30" align="center"><span id="msginforme"></span></td>
			</tr>
			<tr>
				<td align="center">
				<table>
					<tr>
						<td><input type="radio" name="cancelamento"
							id="cancelamento_informado"
							onchange="javascript:document.getElementById('textomotivo').style.display='block';"></td>
						<td><b>Informe o motivo do cancelamento</b></td>
					</tr>
					<tr>
						<td colspan="2" height="5"></td>
					</tr>
					<tr>
						<td colspan="2"><textarea id="textomotivo"
							style="width: 220px; display: none" rows="4"></textarea></td>
					</tr>
					<tr>
						<td colspan="2" height="10"></td>
					</tr>
					<tr>
						<td><input type="radio" name="cancelamento"
							id="cancelamento_orcamento"
							onchange="javascript:document.getElementById('textomotivo').style.display='none';"></td>
						<td><b>Motivo do cancelamento : Or�amento</b></td>
					</tr>
					<tr>
						<td colspan="2" height="20"></td>
					</tr>
					<tr>
						<td><input type="radio" name="cancelamento"
							id="cancelamento_naoinformado"
							onchange="javascript:document.getElementById('textomotivo').style.display='none';"></td>
						<td><b>Motivo do cancelamento : N�o informado</b></td>
					</tr>
					<tr>
						<td height="20"></td>
					</tr>
					<tr>
						<td colspan="2"><input type="button"
							class="botao green btn_simgreen" value="confirmar"
							style="width: 105px;"
							onclick="javascript:carrega_explicamotivcocancelamento();"></td>
					</tr>
				</table>
				</td>
			</tr>

		</table>
		</td>
	</tr>
</table>

</div>

</fieldset>

<?
//unset($_SESSION['controlevenda']);
?>