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

if (! isset ( $_GET ['id'] )) {
	$sql = " ORDER BY idcliente DESC";
} else {
	$idcliente = $validations->validNumeric ( $_GET ['id'] );
	$sql = "WHERE idcliente=" . $idcliente;
}

if (isset ( $_GET ['refer'] )) {
	$refer = $_GET ['refer'];
} else {
	$refer = '';
}

$sql = "SELECT idcliente, txtnome, txtendereco, txtcep, txtbairro, txtcidade, txtuf, txttelefone, txtcelular, txtemail, txtcpf, dtaniversario, txtrg, txtinf_adicional, dtcadastro FROM cliente " . $sql;

$query = $db->query ( $sql );

$row = $db->fetch_assoc ( $query );

if (! isset ( $_GET ['id'] )) {
	$idcliente = $row ['idcliente'];
}

$txtnome = $row ['txtnome'];
$txtendereco = $row ['txtendereco'];

$txtcep = (strlen ( $row ['txtcep'] )) ? str_pad ( str_replace ( '-', '', $row ['txtcep'] ), 8, '0', STR_PAD_LEFT ) : '';
//$txtcep = substr($txtcep,0,5).'-'.substr($txtcep,5,3);


$txtbairro = $row ['txtbairro'];
$txtcidade = $row ['txtcidade'];
$txtuf = $row ['txtuf'];
/*
	$txttelefone = explode('-', $row['txttelefone']);
	$dddtel = $txttelefone[0];
	$tel1 = $txttelefone[1];
	$tel2 = $txttelefone[2];*/
$row ['txttelefone'] = (strlen ( $row ['txttelefone'] )) ? str_pad ( str_replace ( '-', '', $row ['txttelefone'] ), 10, '0', STR_PAD_LEFT ) : '';
$dddtel = substr ( $row ['txttelefone'], 0, 2 );
$tel1 = substr ( $row ['txttelefone'], 2, 4 );
$tel2 = substr ( $row ['txttelefone'], 6, 4 );

/*$txtcelular = explode('-', $row['txtcelular']);
	$dddcel = $txttelefone[0];
	$cel1 = $txttelefone[1];
	$cel2 = $txttelefone[2];*/

$row ['txtcelular'] = (strlen ( $row ['txtcelular'] )) ? str_pad ( str_replace ( '-', '', $row ['txtcelular'] ), 10, '0', STR_PAD_LEFT ) : '';
$dddcel = substr ( $row ['txtcelular'], 0, 2 );
$cel1 = substr ( $row ['txtcelular'], 2, 4 );
$cel2 = substr ( $row ['txtcelular'], 6, 4 );

$txtemail = $row ['txtemail'];

$txtcpf = (strlen ( $row ['txtcpf'] )) ? str_pad ( str_replace ( '-', '', $row ['txtcpf'] ), 11, '0', STR_PAD_LEFT ) : '';
$txtcpf = ($txtcpf == str_pad ( '', 11, '0', STR_PAD_LEFT )) ? '' : $txtcpf;
//$txtcpf = substr($txtcpf,0,3).'.'.substr($txtcpf,3,3).'.'.substr($txtcpf,6,3).'-'.substr($txtcpf,9,2);


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
$dtcadastro = explode ( '-', $row ['dtcadastro'] );
$ddcadastro = $dtcadastro [2];
$mmcadastro = $dtcadastro [1];
$yycadastro = $dtcadastro [0];

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



<fieldset id="m"><legend>Dados do Cliente</legend>

<div class="linha_separador" style="width: 480px;"><span id="mensagem"></span></div>

<div>

<form><input type="hidden" id="idcliente" value="<?=$idcliente;?>">

<table width="100%">
	<tr>
		<td width="50%" valign="top">
		<table>
			<tr>
				<td height="30">Nome</td>
				<td width="5"></td>
				<td><input value="<?=ucwords ( strtolower ( $txtnome ) );?>" type="text"
					name="nome" id="nome" maxlength="60"></td>
			</tr>
			<tr>
				<td height="30">Telefone 1</td>
				<td></td>
				<td><input value="<?=$dddtel;?>" type="text" name="dddtel"
					id="dddtel" maxlength="2" style="width: 20px;"> - <input
					value="<?=$tel1;?>" type="text" name="tel1" id="tel1" maxlength="4"
					style="width: 30px;"> - <input value="<?=$tel2;?>" type="text"
					name="tel2" id="tel2" maxlength="4" style="width: 30px;"></td>
			</tr>
			<tr>
				<td height="30">E-mail</td>
				<td></td>
				<td><input type="text" value="<?=strtolower ( $txtemail );?>"
					name="email" id="email" maxlength="100"></td>
			</tr>
			<tr>
				<td height="30">Identidade</td>
				<td></td>
				<td><input value="<?=$txtrg;?>" type="text" name="identidade"
					id="identidade" maxlength="9"
					onfocus="javascript:editar_cliente_rg();"
					onblur="javascript:editar_cliente_rg();"></td>
			</tr>
			<tr>
				<td height="30">Adicionais</td>
				<td></td>
				<td><textarea name="infoadd" style="width: 158px;" id="infoadd"
					rows="7"><?=$txtinf_adicional;?></textarea></td>
			</tr>
		</table>
		</td>
		<td width="20"></td>
		<td width="50%" valign="top">
		<table>
			<tr>
				<td height="30">Aniversario</td>
				<td width="5"></td>
				<td><SELECT NAME="dia" id="dia">
									<?
									for($n = 1; $n <= 31; $n ++) {
										?>
									<OPTION value="<?=$n;?>" <?=($n == $dia) ? 'selected' : '';?>><?=$n;?></option>
									<?
									}
									?>
								</SELECT>&nbsp;de&nbsp;<SELECT NAME="mes" id="mes">
									<?
									for($n = 1; $n <= 12; $n ++) {
										?>
									<OPTION value="<?=$n;?>" <?=($n == $mes) ? 'selected' : '';?>><?=$meses [$n];?></option>
									<?
									}
									?>
								</SELECT></td>
			</tr>
			<tr>
				<td height="30">Telefone 2</td>
				<td></td>
				<td><input value="<?=$dddcel;?>" type="text" name="dddcel"
					id="dddcel" maxlength="2" style="width: 20px;"> - <input
					value="<?=$cel1;?>" type="text" name="cel1" id="cel1" maxlength="4"
					style="width: 30px;"> - <input value="<?=$cel2;?>" type="text"
					name="cel2" id="cel2" maxlength="4" style="width: 30px;"></td>
			</tr>
			<tr>
				<td height="30">CPF</td>
				<td></td>
				<td><input value="<?=$txtcpf;?>" type="text" name="cpf" id="cpf"
					maxlength="11" onfocus="javascript:editar_cliente_cpf();"
					onblur="javascript:editar_cliente_cpf();"></td>
			</tr>
			<tr>
				<td height="30">CEP</td>
				<td></td>
				<td><input value="<?=substr ( $txtcep, 0, 5 );?>" style="width: 38px"
					type="text" id="cep" name="cep" maxlength="5"> - <input
					value="<?=substr ( $txtcep, 5, 3 );?>" style="width: 23px" type="text"
					id="cepdv" name="cepdv" maxlength="3"> <a href="javascript:;"
					onclick="javascript:carrega_CEP();">Buscar
				</button></td>
			</tr>
			<tr>
				<td colspan="3">
				<div id="cepdados" style="height: 150px; padding: 0px;">
				<table width="100%">
					<tr>
						<td width="60" height="30">Endere&ccedil;o</td>
						<td align="left"><input
							value="<?=ucwords ( strtolower ( $txtendereco ) );?>" type="text"
							name="endereco" id="endereco" maxlength="50"></td>
					</tr>
					<tr>
						<td height="30">Bairro</td>
						<td><input value="<?=ucwords ( strtolower ( $txtbairro ) );?>"
							type="text" name="bairro" id="bairro" maxlength="30"></td>
					</tr>
					<tr>
						<td height="30">Cidade</td>
						<td><input value="<?=ucwords ( strtolower ( $txtcidade ) );?>"
							type="text" name="cidade" id="cidade" value="RIO DE JANEIRO"
							maxlength="30"></td>
					</tr>
					<tr>
						<td height="30">Estado</td>
						<td><select name="estado" id="estado">
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
				</table>
				</div>
				</td>
			</tr>
		</table>
		</td>
	</tr>
			<?
			if ($refer != 'aniver') {
				?>
			<tr>
		<td colspan="3" align="right">
		<table>
			<tr>
				<td><input type="button" class="botao" value="Voltar para lista"
					onclick="javascript:carrega_listagemcliente(path+'modulos/cliente/lista.php','conteudo_total');"></td>
							<?
				if ($refer == 'cadastro') {
					?>
							<td width="10"></td>
				<td><input type="button" class="botao" name="editcliente"
					value="Cadastrar outro cliente"
					onclick="javascript:carrega_edicaocliente('modulos/cliente/cadastrar.php');"></td>
							<?
				}
				?>
							<td width="10"></td>
				<td><input type="button" class="botao" name="editcliente"
					value="Editar dados"
					onclick="javascript:editar_dadoscliente('modulos/cliente/cliente_salvar.php');"></td>
			</tr>
		</table>
		</td>
	</tr>
			<?
			}
			?>
		</table>

</form>

</div>

</fieldset>
