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

$row ['idcliente'] = $_SESSION ['cliente_escolhido'] ['idcliente'];
$row ['txtnome'] = $_SESSION ['cliente_escolhido'] ['txtnome'];
$row ['txtendereco'] = $_SESSION ['cliente_escolhido'] ['txtendereco'];
$row ['txtcep'] = $_SESSION ['cliente_escolhido'] ['txtcep'];
$row ['txtbairro'] = $_SESSION ['cliente_escolhido'] ['txtbairro'];
$row ['txtcidade'] = $_SESSION ['cliente_escolhido'] ['txtcidade'];
$row ['txtuf'] = $_SESSION ['cliente_escolhido'] ['txtuf'];
$row ['txttelefone'] = $_SESSION ['cliente_escolhido'] ['txttelefone'];
$row ['txtcelular'] = $_SESSION ['cliente_escolhido'] ['txtcelular'];
$row ['txtemail'] = $_SESSION ['cliente_escolhido'] ['txtemail'];
$row ['txtcpf'] = $_SESSION ['cliente_escolhido'] ['txtcpf'];
$row ['dtaniversario'] = $_SESSION ['cliente_escolhido'] ['dtaniversario'];
$row ['txtrg'] = $_SESSION ['cliente_escolhido'] ['txtrg'];
$row ['txtinf_adicional'] = strip_tags ( $_SESSION ['cliente_escolhido'] ['txtinf_adicional'] );
$row ['dtcadastro'] = $_SESSION ['cliente_escolhido'] ['dtcadastro'];

$idcliente = $row ['idcliente'];

$txtnome = $row ['txtnome'];
$txtendereco = $row ['txtendereco'];

$txtcep = (strlen ( $row ['txtcep'] )) ? str_pad ( str_replace ( '-', '', $row ['txtcep'] ), 8, '0', STR_PAD_LEFT ) : '';

$txtbairro = $row ['txtbairro'];
$txtcidade = $row ['txtcidade'];
$txtuf = $row ['txtuf'];

$row ['txttelefone'] = (strlen ( $row ['txttelefone'] )) ? str_pad ( str_replace ( '-', '', $row ['txttelefone'] ), 10, '0', STR_PAD_LEFT ) : '';
$dddtel = substr ( $row ['txttelefone'], 0, 2 );
$tel1 = substr ( $row ['txttelefone'], 2, 4 );
$tel2 = substr ( $row ['txttelefone'], 6, 4 );

$row ['txtcelular'] = (strlen ( $row ['txtcelular'] )) ? str_pad ( str_replace ( '-', '', $row ['txtcelular'] ), 10, '0', STR_PAD_LEFT ) : '';
$dddcel = substr ( $row ['txtcelular'], 0, 2 );
$cel1 = substr ( $row ['txtcelular'], 2, 4 );
$cel2 = substr ( $row ['txtcelular'], 6, 4 );

$txtemail = $row ['txtemail'];

$txtcpf = (strlen ( $row ['txtcpf'] )) ? str_pad ( str_replace ( '-', '', $row ['txtcpf'] ), 11, '0', STR_PAD_LEFT ) : '';
$txtcpf = ($txtcpf == str_pad ( '', 11, '0', STR_PAD_LEFT )) ? '' : $txtcpf;

$dia = 0;
$mes = 0;

if (strpos ( $row ['dtaniversario'], '/' )) {
	$dtaniversario = explode ( '/', $row ['dtaniversario'] );
	@$dia = $dtaniversario [0];
	@$mes = $dtaniversario [1];
}

if (strpos ( $row ['dtaniversario'], '-' )) {
	$dtaniversario = explode ( '-', $row ['dtaniversario'] );
	@$dia = $dtaniversario [2];
	@$mes = $dtaniversario [1];
}
$dia = (($dia < 10) && (strlen ( $dia ) == 2)) ? substr ( $dia, 1, 1 ) : $dia;
$mes = (($mes < 10) && (strlen ( $mes ) == 2)) ? substr ( $mes, 1, 1 ) : $mes;

$txtrg = (strlen ( $row ['txtrg'] )) ? str_pad ( str_replace ( '-', '', $row ['txtrg'] ), 9, '0', STR_PAD_LEFT ) : '';
$txtrg = ($txtrg == str_pad ( '', 9, '0', STR_PAD_LEFT )) ? '' : $txtrg;
$txtinf_adicional = $row ['txtinf_adicional'];

if ( $dtcadastro = explode ( '-', $row ['dtcadastro'] ) ){
    $ddcadastro = @$dtcadastro[2];
    $mmcadastro = @$dtcadastro[1];
    $yycadastro = @$dtcadastro[0];
}

if (! isset ( $txtnome )) {
	$txtnome = '';
}

if (! isset ( $txtendereco )) {
	$txtendereco = '';
}

if (! isset ( $cep1 ) && ! isset ( $cep2 )) {
	$cep1 = '';
	$cep2 = '';
}

if (! isset ( $txtbairro )) {
	$txtbairro = '';
}

if (! isset ( $txtcidade )) {
	$txtcidade = '';
}

if (! isset ( $txtuf )) {
	$txtuf = '';
}

if (! isset ( $dddtel ) && ! isset ( $tel1 ) && ! isset ( $tel2 )) {
	$dddtel = '';
	$tel1 = '';
	$tel2 = '';
}

if (! isset ( $dddcel ) && ! isset ( $cel1 ) && ! isset ( $cel2 )) {
	$dddcel = '';
	$cel1 = '';
	$cel2 = '';
}

if (! isset ( $txtemail )) {
	$txtemail = '';
}

if (! isset ( $txtcpf )) {
	$txtcpf = '';
}

if (! isset ( $dia ) && ! isset ( $mes )) {
	$dia = '';
	$mes = '';
}

if (! isset ( $txtrg )) {
	$txtrg = '';
}

if (! isset ( $txtinf_adicional )) {
	$txtinf_adicional = '';
}

if (! isset ( $ddcadastro ) && ! isset ( $mmcadastro ) && ! isset ( $yycadastro )) {
	$ddcadastro = '';
	$mmcadastro = '';
	$yycadastro = '';
}

?>



<fieldset id="m"><legend>Editar Dados do Cliente</legend>

<div class="linha_separador" style="width: 480px; height: 30px;">
<table width="100%" style="height: 30px;">
	<tr>
		<td align="left" width="150"><input type="button"
			class="botao botao btn_irpara" value="Ir para listagem"
			onclick="carrega_listagemcliente(path+'modulos/cliente/lista.php','conteudo_total');">
		</td>
		<td align="right"><span id="mensagem"></span></td>
	</tr>
</table>
</div>


<input type="hidden" id="idcliente" value="<?=$idcliente;?>">

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
					style="font-size: 12px; width: 320px;"
					value="<?=ucwords ( strtolower ( $txtnome ) );?>" maxlength="60"></td>
			</tr>
			<tr>
				<td><b>E-mail</b></td>
				<td width="5"></td>
				<td><input type="text" id="email"
					style="font-size: 12px; width: 320px;"
					value="<?=strtolower ( $txtemail );?>" maxlength="100"></td>
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
							maxlength="2" value="<?=$dddtel;?>"
							style="width: 20px; text-align: center;">&nbsp;)&nbsp;<input
							type="text" id="tel1" maxlength="4" value="<?=$tel1;?>"
							style="width: 30px;"> - <input value="<?=$tel2;?>" type="text"
							name="tel2" id="tel2" maxlength="4" style="width: 30px;"></td>
					</tr>
					<tr>
						<td width="70" height="20"><b>Telefone 2</b></td>
						<td height="20">(&nbsp;<input type="text" id="dddcel"
							value="<?=$dddcel;?>" maxlength="2"
							style="width: 20px; text-align: center;">&nbsp;)&nbsp;<input
							type="text" id="cel1" maxlength="4" value="<?=$cel1;?>"
							style="width: 30px;"> - <input type="text" id="cel2"
							maxlength="4" value="<?=$cel2;?>" style="width: 30px;"></td>
					</tr>
					<tr>
						<td width="70" height="20"><b>Aniversário</b></td>
						<td height="20"><select id="dia">
												<?
												for($n = 1; $n <= 31; $n ++) {
													?>
												<option value="<?=$n;?>" <?=($n == $dia) ? 'selected' : '';?>><?=$n;?></option>
												<?
												}
												?>
											</select> <select id="mes" style="width: 76px;">
												<?
												if (! $mes) {
													?>
												<option value="0">escolha</option>
												<?
												}
												for($n = 1; $n <= 12; $n ++) {
													?>
												<option value="<?=$n;?>" <?=($n == $mes) ? 'selected' : '';?>><?=$meses [$n];?></option>
												<?
												}
												?>
											</select></td>
					</tr>
					<tr>
						<td width="70" height="20"><b>CPF</b></td>
						<td height="20"><input type="text" id="cpf" maxlength="11"
							onfocus="javascript:editar_cliente_cpf();"
							onblur="javascript:editar_cliente_cpf();" value="<?=$txtcpf;?>"
							style="width: 110px;"></td>
					</tr>
					<tr>
						<td width="70" height="20"><b>Identidade</b></td>
						<td height="20"><input type="text" id="identidade" maxlength="10"
							onfocus="javascript:editar_cliente_rg();"
							onblur="javascript:editar_cliente_rg();" value="<?=$txtrg;?>"
							style="width: 110px;"></td>
					</tr>
				</table>
				</td>
				<td width="60%" valign="top">
				<table>
					<tr>
						<td width="70" height="20"><b>Endere&ccedil;o</b></td>
						<td height="20"><input type="text" id="endereco"
							value="<?=ucwords ( strtolower ( $txtendereco ) );?>" maxlength="50"
							style="width: 220px;"></td>
					</tr>
					<tr>
						<td width="70" height="20"><b>Bairro</b></td>
						<td height="20"><input type="text" id="bairro"
							value="<?=ucwords ( strtolower ( $txtbairro ) );?>" maxlength="30"
							style="width: 220px;"></td>
					</tr>
					<tr>
						<td width="70" height="20"><b>Cidade</b></td>
						<td height="20"><input type="text" id="cidade"
							value="<?=ucwords ( strtolower ( $txtcidade ) );?>" maxlength="30"
							style="width: 220px;"></td>
					</tr>
					<tr>
						<td width="70" height="20"><b>Estado</b></td>
						<td height="20"><select id="estado">
							<option value="AC" <?
							echo ($txtuf == 'AC') ? 'selected' : '';
							?>>AC</option>
							<option value="AL" <?
							echo ($txtuf == 'AL') ? 'selected' : '';
							?>>AL</option>
							<option value="AP" <?
							echo ($txtuf == 'AP') ? 'selected' : '';
							?>>AP</option>
							<option value="AM" <?
							echo ($txtuf == 'AM') ? 'selected' : '';
							?>>AM</option>
							<option value="BA" <?
							echo ($txtuf == 'BA') ? 'selected' : '';
							?>>BA</option>
							<option value="CE" <?
							echo ($txtuf == 'CE') ? 'selected' : '';
							?>>CE</option>
							<option value="DF" <?
							echo ($txtuf == 'DF') ? 'selected' : '';
							?>>DF</option>
							<option value="GO" <?
							echo ($txtuf == 'GO') ? 'selected' : '';
							?>>GO</option>
							<option value="ES" <?
							echo ($txtuf == 'ES') ? 'selected' : '';
							?>>ES</option>
							<option value="MA" <?
							echo ($txtuf == 'MA') ? 'selected' : '';
							?>>MA</option>
							<option value="MT" <?
							echo ($txtuf == 'MT') ? 'selected' : '';
							?>>MT</option>
							<option value="MS" <?
							echo ($txtuf == 'MS') ? 'selected' : '';
							?>>MS</option>
							<option value="MG" <?
							echo ($txtuf == 'MG') ? 'selected' : '';
							?>>MG</option>
							<option value="PA" <?
							echo ($txtuf == 'PA') ? 'selected' : '';
							?>>PA</option>
							<option value="PB" <?
							echo ($txtuf == 'PB') ? 'selected' : '';
							?>>PB</option>
							<option value="PR" <?
							echo ($txtuf == 'PR') ? 'selected' : '';
							?>>PR</option>
							<option value="PE" <?
							echo ($txtuf == 'PE') ? 'selected' : '';
							?>>PE</option>
							<option value="PI" <?
							echo ($txtuf == 'PI') ? 'selected' : '';
							?>>PI</option>
							<option value="RJ" <?
							echo ($txtuf == 'RJ') ? 'selected' : '';
							?>>RJ</option>
							<option value="RN" <?
							echo ($txtuf == 'RN') ? 'selected' : '';
							?>>RN</option>
							<option value="RS" <?
							echo ($txtuf == 'RS') ? 'selected' : '';
							?>>RS</option>
							<option value="RO" <?
							echo ($txtuf == 'RO') ? 'selected' : '';
							?>>RO</option>
							<option value="RR" <?
							echo ($txtuf == 'RR') ? 'selected' : '';
							?>>RR</option>
							<option value="SP" <?
							echo ($txtuf == 'SP') ? 'selected' : '';
							?>>SP</option>
							<option value="SC" <?
							echo ($txtuf == 'SC') ? 'selected' : '';
							?>>SC</option>
							<option value="SE" <?
							echo ($txtuf == 'SE') ? 'selected' : '';
							?>>SE</option>
							<option value="TO" <?
							echo ($txtuf == 'TO') ? 'selected' : '';
							?>>TO</option>
						</select></td>
					</tr>
					<tr>
						<td width="70" height="20"><b>CEP</b></td>
						<td height="20"><input type="text" id="cep"
							value="<?=substr ( $txtcep, 0, 5 );?>" style="width: 38px"
							maxlength="5"> - <input type="text" id="cepdv"
							value="<?=substr ( $txtcep, 5, 3 );?>" style="width: 23px"
							maxlength="3"></td>
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
		<td height="25"><b>Informações adicionais</b></td>
	</tr>
	<tr>
		<td class="l3"></td>
	</tr>
	<tr>
		<td>
		<table width="100%" cellpadding="2">
			<tr>
				<td height="20"><textarea id="infoadd" style="width: 490px;"><?=ucwords ( strtolower ( $txtinf_adicional ) );?></textarea></td>
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
				<td><input type="button" class="botao btn_irpara"
					value="Ir para o cliente"
					onclick="javascript:carregar_get('conteudo_direito', 'modulos/cliente/cliente_mostradados.php?id=<?=$idcliente;?>')"></td>
				<td align="right"><input type="button"
					class="botao btn_editargreen green" style="width: 135px;"
					value="editar cliente"
					onclick="javascript:editar_dadoscliente('modulos/cliente/cliente_salvar.php', 'true');"></td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</div>

</fieldset>

<?
unset ( $_SESSION ['cliente_escolhido'] );
?>
