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



<fieldset id="p"><legend>Emissão de Mailling</legend>

<div class="linha_separador" style="height: 28px;">
<table width="100%" height="100%">
	<tr>
		<td align="center"><span id="msggrade"><b style="color: blue;">Escolha
		as opções para a impressão do mailling</b><span></td>
	</tr>
</table>
</div>

<div>

<table width="375">
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td height="25"><b>Campos para impressão das etiquetas</b></td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td>
		<table>
			<tr>
				<td height="25"><input type="checkbox" name="valor" id="nome"
					checked></td>
				<td>Nome</td>
				<td width="30"></td>
				<td><input type="checkbox" name="valor" id="bairro" checked></td>
				<td>Bairro</td>
				<td width="30"></td>
				<td><input type="checkbox" name="valor" id="estado" checked></td>
				<td>Estado</td>
				<td width="30"></td>
				<td><input type="checkbox" name="valor" id="pais"></td>
				<td>País</td>
			</tr>
			<tr>
				<td height="25"><input type="checkbox" name="valor" id="endereco"
					checked></td>
				<td>Endereço</td>
				<td width="30"></td>
				<td><input type="checkbox" name="valor" id="cidade" checked></td>
				<td>Cidade</td>
				<td width="30"></td>
				<td><input type="checkbox" name="valor" id="cep" checked></td>
				<td>CEP</td>
				<td width="30"></td>
				<td><input type="checkbox" name="valor" id="dtcadastro"></td>
				<td>Data de Cadastro</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td height="25"><b>Critério de clientes</b></td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td>
		<table width="375">
			<tr>
				<td height="26" width="15"><input type="radio" name="cliente"
					id="cliente_todos" onchange="javascript:etiqueta_cliente_todos();"
					checked></td>
				<td>Todos os clientes</td>
			</tr>
			<tr>
				<td height="26" width="15"><input type="radio" name="cliente"
					id="cliente_estado"
					onchange="javascript:etiqueta_cliente_estado();"></td>
				<td>
				<table width="100%">
					<tr>
						<td>Estado específico</td>
						<td align="right">
						<div id="etiquetaporestado" style="display: none;">
						<table>
							<tr>
								<td><select id="sel_estado" style="width: 140px;">
									<option value="0">selecione o estado</option>
									<option value="AC">AC</option>
									<option value="AL">AL</option>
									<option value="AP">AP</option>
									<option value="AM">AM</option>
									<option value="BA">BA</option>
									<option value="CE">CE</option>
									<option value="DF">DF</option>
									<option value="GO">GO</option>
									<option value="ES">ES</option>
									<option value="MA">MA</option>
									<option value="MT">MT</option>
									<option value="MS">MS</option>
									<option value="MG">MG</option>
									<option value="PA">PA</option>
									<option value="PB">PB</option>
									<option value="PR">PR</option>
									<option value="PE">PE</option>
									<option value="PI">PI</option>
									<option value="RJ">RJ</option>
									<option value="RN">RN</option>
									<option value="RS">RS</option>
									<option value="RO">RO</option>
									<option value="RR">RR</option>
									<option value="SP">SP</option>
									<option value="SC">SC</option>
									<option value="SE">SE</option>
									<option value="TO">TO</option>
								</select></td>
							</tr>
						</table>
						</div>
						</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td height="26" width="15"><input type="radio" name="cliente"
					id="cliente_mes" onchange="javascript:etiqueta_cliente_mes();"></td>
				<td>
				<table width="100%">
					<tr>
						<td>Mês de aniversário</td>
						<td align="right">
						<div id="etiquetapormes" style="display: none;">
						<table>
							<tr>
								<td><select id="mes_niver" style="width: 140px;">
									<option value="0">selecione o mês</option>
																<?
																for($n = 1; $n <= 12; $n ++) {
																	?>
																<option value="<?=$n;?>"><?=$meses [$n];?></option>
																<?
																}
																?>
															</select></td>
							</tr>
						</table>
						</div>
						</td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td height="25"><b>Modelo</b></td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td>
		<table>
			<tr>
				<td height="25">Selecione o modelo</td>
				<td width="10"></td>
				<td><select id="etiqueta_modelo">
					<option value="etiqueta_6081">&nbsp;&nbsp;6081 - branca&nbsp;&nbsp;</option>
				</select></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td>
		<table width="100%">
			<tr>
				<td align="left"><span id="msgerro"></span></td>
				<td align="right" width="150"><input type="button" class="botao"
					id="geraetiquetas" value="Gerar Etiquetas"
					style="cursor: pointer; cursor: hand; width: 150px;"
					onClick="javascript:geraretiqueta_impressao_cliente();"></td>
			</tr>
		</table>
		</td>
	</tr>
</table>

</div>

</fieldset>