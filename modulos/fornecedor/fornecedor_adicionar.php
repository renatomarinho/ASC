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

$db = new db ( );
$db->connect ();

?>

<fieldset id="p"><legend>Adicionar fornecedor</legend>


<div class="linha_separador" id="linha_separador_fornecedor"
	style="width: 352px; height: 27px;">
<table width="100%" height="100%">
	<tr>
		<td align="center"><span id="mensagem"></span></td>
	</tr>
</table>
</div>

<div id="conteudofornecedor">
<table width="370">
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td height="20"><b>Dados do fornecedor</b></td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td>
		<table width="100%">
			<tr>
				<td width="65" height="20">Nome</td>
				<td><input type="text" id="nomefornec" style="width: 290px"
					maxlength="60"></td>
			</tr>
			<tr>
				<td height="20">Contato</td>
				<td><input type="text" id="contato" style="width: 290px"
					maxlength="30"></td>
			</tr>
			<tr>
				<td height="20">E-mail</td>
				<td><input type="text" id="email" style="width: 290px"
					maxlength="100"></td>
			</tr>
			<tr>
				<td colspan="2">
				<table width="100%">
					<tr>
						<td height="20" width="60">Telefone</td>
						<td>(<input type="text" id="telefone" maxlength="2"
							style="width: 20px; text-align: center;"
							onfocus="javascript:this.value='';"
							value="<?=$_CONF ['COD_AREA_TEL'];?>">) <input type="text"
							id="telefone2" maxlength="4" style="width: 30px;"> - <input
							type="text" id="telefone3" maxlength="4" style="width: 30px;"></td>
						<td width="10"></td>
						<td align="right">
						<table cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td height="20" width="28">Fax</td>
								<td>(<input type="text" id="fax" maxlength="2"
									style="width: 20px; text-align: center;">) <input type="text"
									id="fax2" maxlength="4" style="width: 30px;"> - <input
									type="text" id="fax3" maxlength="4" style="width: 30px;"></td>
							</tr>
						</table>
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
		<td height="20"><b>Dados da Empresa</b></td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td>
		<table width="100%">
			<tr>
				<td height="20" width="66">CNPJ/CFP</td>
				<td><input type="text" id="cpf" style="width: 90px" maxlength="18"></td>
				<td width="10"></td>
				<td height="20" width="90">Insc. Estadual</td>
				<td><input type="text" id="idenest" style="width: 90px"
					maxlength="16"></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td height="20"><b>Dados Gerais</b></td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td>
		<table width="100%">
			<tr>
				<td width="70" height="20">
				<table cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td height="20" width="66">Endere�o</td>
						<td><input type="text" id="endereco" style="width: 120px"
							maxlength="50"></td>
						<td width="10"></td>
						<td height="20" width="40">Bairro</td>
						<td align="right"><input type="text" id="bairro"
							style="width: 120px" maxlength="60"></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td>
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td>
						<table cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td height="20" width="66">Cidade</td>
								<td><input type="text" id="cidade" style="width: 120px"
									value="<?=$_CONF ['CIDADE'];?>" maxlength="20"></td>
							</tr>
							<tr>
								<td height="25">Estado</td>
								<td align="right"><select id="estado" style="width: 100px"
									onchange="javascript:document.getElementById('cidade').value='';">
									<option value="AC" <?=($_CONF ['UF'] == 'AC') ? 'selected' : '';?>>AC</option>
									<option value="AL" <?=($_CONF ['UF'] == 'AL') ? 'selected' : '';?>>AL</option>
									<option value="AP" <?=($_CONF ['UF'] == 'AP') ? 'selected' : '';?>>AP</option>
									<option value="AM" <?=($_CONF ['UF'] == 'AM') ? 'selected' : '';?>>AM</option>
									<option value="BA" <?=($_CONF ['UF'] == 'BA') ? 'selected' : '';?>>BA</option>
									<option value="CE" <?=($_CONF ['UF'] == 'CE') ? 'selected' : '';?>>CE</option>
									<option value="DF" <?=($_CONF ['UF'] == 'DF') ? 'selected' : '';?>>DF</option>
									<option value="GO" <?=($_CONF ['UF'] == 'GO') ? 'selected' : '';?>>GO</option>
									<option value="ES" <?=($_CONF ['UF'] == 'ES') ? 'selected' : '';?>>ES</option>
									<option value="MA" <?=($_CONF ['UF'] == 'MA') ? 'selected' : '';?>>MA</option>
									<option value="MT" <?=($_CONF ['UF'] == 'MT') ? 'selected' : '';?>>MT</option>
									<option value="MS" <?=($_CONF ['UF'] == 'MS') ? 'selected' : '';?>>MS</option>
									<option value="MG" <?=($_CONF ['UF'] == 'MG') ? 'selected' : '';?>>MG</option>
									<option value="PA" <?=($_CONF ['UF'] == 'PA') ? 'selected' : '';?>>PA</option>
									<option value="PB" <?=($_CONF ['UF'] == 'PB') ? 'selected' : '';?>>PB</option>
									<option value="PR" <?=($_CONF ['UF'] == 'PR') ? 'selected' : '';?>>PR</option>
									<option value="PE" <?=($_CONF ['UF'] == 'PE') ? 'selected' : '';?>>PE</option>
									<option value="PI" <?=($_CONF ['UF'] == 'PI') ? 'selected' : '';?>>PI</option>
									<option value="RJ" <?=($_CONF ['UF'] == 'RJ') ? 'selected' : '';?>>RJ</option>
									<option value="RN" <?=($_CONF ['UF'] == 'RN') ? 'selected' : '';?>>RN</option>
									<option value="RS" <?=($_CONF ['UF'] == 'RS') ? 'selected' : '';?>>RS</option>
									<option value="RO" <?=($_CONF ['UF'] == 'RO') ? 'selected' : '';?>>RO</option>
									<option value="RR" <?=($_CONF ['UF'] == 'RR') ? 'selected' : '';?>>RR</option>
									<option value="SP" <?=($_CONF ['UF'] == 'SP') ? 'selected' : '';?>>SP</option>
									<option value="SC" <?=($_CONF ['UF'] == 'SC') ? 'selected' : '';?>>SC</option>
									<option value="SE" <?=($_CONF ['UF'] == 'SE') ? 'selected' : '';?>>SE</option>
									<option value="TO" <?=($_CONF ['UF'] == 'TO') ? 'selected' : '';?>>TO</option>
									<option value="OU" <?=($_CONF ['UF'] == 'OU') ? 'selected' : '';?>>Outro</option>
								</select></td>
							</tr>
						</table>
						</td>
						<td width="10"></td>
						<td>
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td height="20" width="40">CEP</td>
								<td align="right"><input type="text" id="cep" maxlength="5"
									style="width: 40px"> - <input type="text" id="cep2"
									maxlength="3" style="width: 25px"></td>
							</tr>
							<tr>
								<td height="25">Pa�s</td>
								<td align="right"><select id="pais" style="width: 125px"
									onchange="javascript:document.getElementById('cidade').value='';document.getElementById('estado').selectedIndex=27;">
																<?
																$sql = "SELECT iso, numcode, nome FROM paises ORDER BY nome ASC";
																$querypais = $db->query ( $sql );
																while ( $rowpais = $db->fetch_assoc ( $querypais ) ) {
																	?>
																<option value="<?=$rowpais ['numcode'];?>"
										<?=($_CONF ['PAIS'] == $rowpais ['iso']) ? 'selected' : '';?>><?=$rowpais ['nome'];?></option>
																<?
																}
																?>
															</select></td>
							</tr>
						</table>
						</td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td align="right"><input type="button" class="botao"
			style="cursor: pointer; cursor: hand; width: 150px; background-color: green;"
			onclick="javascript:adicionar_fornecedorsalvar_form();"
			value="adicionar fornecedor"></td>
	</tr>
</table>
</div>

</fieldset>