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

if (isset ( $_GET ['refer'] )) {
	$refer = $_GET ['refer'];
} else {
	$refer = '';
}

?>



<fieldset id="m"><legend>Adicionar Cliente</legend>

<div class="linha_separador" style="width: 480px; height: 30px;">
<table width="100%" style="height: 30px;">
	<tr>
		<td align="left" width="150"><input type="button"
			class="botao btn_irpara" value="Ir para listagem"
			onclick="carrega_listagemcliente(path+'modulos/cliente/lista.php','conteudo_total');">
		</td>
		<td align="right"><span id="mensagem"></span></td>
	</tr>
</table>
</div>


<div id="cliente_editardados" style="overflow: hidden;">
<table width="100%">
	<tr>
		<td height="15"></td>
	</tr>
	<tr>
		<td height="20">
		<table width="100%">
			<tr>
				<td><b>Nome</b></td>
				<td width="5"></td>
				<td><input type="text" id="nome"
					style="font-size: 12px; width: 320px;" maxlength="60"></td>
			</tr>
			<tr>
				<td><b>E-mail</b></td>
				<td width="5"></td>
				<td><input type="text" id="email"
					style="font-size: 12px; width: 320px;" maxlength="100"></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td class="l3"></td>
	</tr>
	<tr>
		<td height="25"><b>Dados Gerais</b></td>
	</tr>
	<tr>
		<td class="l3"></td>
	</tr>
	<tr>
		<td>
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td width="40%" valign="top">
				<table>
					<tr>
						<td width="70" height="20"><b>Telefone 1</b></td>
						<td height="20">(&nbsp;<input type="text" id="dddtel"
							maxlength="2" value="<?=$_CONF ['COD_AREA_TEL'];?>"
							onfocus="javascript:this.value='';"
							style="width: 20px; text-align: center;">&nbsp;)&nbsp;<input
							type="text" id="tel1" maxlength="4" style="width: 30px;"> - <input
							type="text" name="tel2" id="tel2" maxlength="4"
							style="width: 30px;"></td>
					</tr>
					<tr>
						<td width="70" height="20"><b>Telefone 2</b></td>
						<td height="20">(&nbsp;<input type="text" id="dddcel"
							maxlength="2" style="width: 20px; text-align: center;">&nbsp;)&nbsp;<input
							type="text" id="cel1" maxlength="4" style="width: 30px;"> - <input
							type="text" id="cel2" maxlength="4" style="width: 30px;"></td>
					</tr>
					<tr>
						<td width="70" height="20"><b>Anivers�rio</b></td>
						<td height="20"><select id="dia">
												<?
												for($n = 1; $n <= 31; $n ++) {
													?>
												<option value="<?=$n;?>"><?=$n;?></option>
												<?
												}
												?>
											</select> <select id="mes" style="width: 76px;">
							<option value="0">escolha</option>
												<?
												for($n = 1; $n <= 12; $n ++) {
													?>
												<option value="<?=$n;?>"><?=$meses [$n];?></option>
												<?
												}
												?>
											</select></td>
					</tr>
					<tr>
						<td width="70" height="20"><b>CPF</b></td>
						<td height="20"><input type="text" id="cpf" maxlength="11"
							onfocus="javascript:editar_cliente_cpf();"
							onblur="javascript:editar_cliente_cpf();" style="width: 110px;"></td>
					</tr>
					<tr>
						<td width="70" height="20"><b>Identidade</b></td>
						<td height="20"><input type="text" id="identidade" maxlength="10"
							onfocus="javascript:editar_cliente_rg();"
							onblur="javascript:editar_cliente_rg();" style="width: 110px;"></td>
					</tr>
				</table>
				</td>
				<td width="60%" valign="top">
				<table>
					<tr>
						<td width="70" height="20"><b>Endere&ccedil;o</b></td>
						<td height="20"><input type="text" id="endereco" maxlength="50"
							style="width: 220px;"></td>
					</tr>
					<tr>
						<td width="70" height="20"><b>Bairro</b></td>
						<td height="20"><input type="text" id="bairro" maxlength="30"
							style="width: 220px;"></td>
					</tr>
					<tr>
						<td width="70" height="20"><b>Cidade</b></td>
						<td height="20"><input type="text" id="cidade" maxlength="30"
							value="<?=$_CONF ['CIDADE'];?>"
							onfocus="javascript:this.value='';" style="width: 220px;"></td>
					</tr>
					<tr>
						<td width="70" height="20"><b>Estado</b></td>
						<td height="20"><select id="estado">
							<option value="AC" <?
							echo ($_CONF ['UF'] == 'AC') ? 'selected' : '';
							?>>AC</option>
							<option value="AL" <?
							echo ($_CONF ['UF'] == 'AL') ? 'selected' : '';
							?>>AL</option>
							<option value="AP" <?
							echo ($_CONF ['UF'] == 'AP') ? 'selected' : '';
							?>>AP</option>
							<option value="AM" <?
							echo ($_CONF ['UF'] == 'AM') ? 'selected' : '';
							?>>AM</option>
							<option value="BA" <?
							echo ($_CONF ['UF'] == 'BA') ? 'selected' : '';
							?>>BA</option>
							<option value="CE" <?
							echo ($_CONF ['UF'] == 'CE') ? 'selected' : '';
							?>>CE</option>
							<option value="DF" <?
							echo ($_CONF ['UF'] == 'DF') ? 'selected' : '';
							?>>DF</option>
							<option value="GO" <?
							echo ($_CONF ['UF'] == 'GO') ? 'selected' : '';
							?>>GO</option>
							<option value="ES" <?
							echo ($_CONF ['UF'] == 'ES') ? 'selected' : '';
							?>>ES</option>
							<option value="MA" <?
							echo ($_CONF ['UF'] == 'MA') ? 'selected' : '';
							?>>MA</option>
							<option value="MT" <?
							echo ($_CONF ['UF'] == 'MT') ? 'selected' : '';
							?>>MT</option>
							<option value="MS" <?
							echo ($_CONF ['UF'] == 'MS') ? 'selected' : '';
							?>>MS</option>
							<option value="MG" <?
							echo ($_CONF ['UF'] == 'MG') ? 'selected' : '';
							?>>MG</option>
							<option value="PA" <?
							echo ($_CONF ['UF'] == 'PA') ? 'selected' : '';
							?>>PA</option>
							<option value="PB" <?
							echo ($_CONF ['UF'] == 'PB') ? 'selected' : '';
							?>>PB</option>
							<option value="PR" <?
							echo ($_CONF ['UF'] == 'PR') ? 'selected' : '';
							?>>PR</option>
							<option value="PE" <?
							echo ($_CONF ['UF'] == 'PE') ? 'selected' : '';
							?>>PE</option>
							<option value="PI" <?
							echo ($_CONF ['UF'] == 'PI') ? 'selected' : '';
							?>>PI</option>
							<option value="RJ" <?
							echo ($_CONF ['UF'] == 'RJ') ? 'selected' : '';
							?>>RJ</option>
							<option value="RN" <?
							echo ($_CONF ['UF'] == 'RN') ? 'selected' : '';
							?>>RN</option>
							<option value="RS" <?
							echo ($_CONF ['UF'] == 'RS') ? 'selected' : '';
							?>>RS</option>
							<option value="RO" <?
							echo ($_CONF ['UF'] == 'RO') ? 'selected' : '';
							?>>RO</option>
							<option value="RR" <?
							echo ($_CONF ['UF'] == 'RR') ? 'selected' : '';
							?>>RR</option>
							<option value="SP" <?
							echo ($_CONF ['UF'] == 'SP') ? 'selected' : '';
							?>>SP</option>
							<option value="SC" <?
							echo ($_CONF ['UF'] == 'SC') ? 'selected' : '';
							?>>SC</option>
							<option value="SE" <?
							echo ($_CONF ['UF'] == 'SE') ? 'selected' : '';
							?>>SE</option>
							<option value="TO" <?
							echo ($_CONF ['UF'] == 'TO') ? 'selected' : '';
							?>>TO</option>
						</select></td>
					</tr>
					<tr>
						<td width="70" height="20"><b>CEP</b></td>
						<td height="20"><input type="text" id="cep" style="width: 38px"
							maxlength="5"> - <input type="text" id="cepdv"
							style="width: 23px" maxlength="3"></td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td class="l3"></td>
	</tr>
	<tr>
		<td height="25"><b>Informa��es adicionais</b></td>
	</tr>
	<tr>
		<td class="l3"></td>
	</tr>
	<tr>
		<td>
		<table width="100%" cellpadding="2">
			<tr>
				<td height="20"><textarea id="infoadd" style="width: 490px;"></textarea></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td class="l3"></td>
	</tr>
	<tr>
		<td>
		<table width="100%">
			<tr>
				<td align="right">
							<?
							if ($_REQUEST ['venda']) {
								?>
							<input type="button" class="botao btn_irpara"
					id="adicionarcliente" value="voltar a venda"
					onclick="javascript:cliente_voltar_venda();"> <input type="button"
					class="botao btn_adicionargreen green" style="width: 225px;"
					id="adicionarcliente" value="adicionar cliente / voltar a venda"
					onclick="javascript:adicionar_dadoscliente('modulos/cliente/cliente_salvar_adicionar.php', 'adicionar', true);">
							<?
							} else {
								?>
							<input type="button" class="botao btn_adicionargreen green"
					id="adicionarcliente" value="adicionar cliente"
					onclick="javascript:adicionar_dadoscliente('modulos/cliente/cliente_salvar_adicionar.php', 'adicionar');">
							<?
							}
							?>
							<input type="button" class="botao btn_adicionargreen green"
					id="adicionarnovocliente" style="display: none"
					value="adicionar cliente"
					onclick="javascript:adicionar_outro_cliente();"></td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</div>

</fieldset>