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

require "_language.php";

if (! isset ( $_CONF ['PATH'] )) {
	require "../../config/default.php";
}

$validations = new validations ( );
$db = new db ( );
$db->connect ();

$sql = "SELECT cnpj, ie as insc_estadual, nome_empresa, endereco, bairro, cidade, uf, cep, telefone, fax, email, site, qtd_turnos, qtd_terminal, filiais FROM cad_empresa WHERE id=1";
$query = $db->query ( $sql );
$rowempresa = $db->fetch_assoc ( $query );

$nome_empresa = $rowempresa ['nome_empresa'];
$endereco = $rowempresa ['endereco'];
$cidade = $rowempresa ['cidade'];
$uf = $rowempresa ['uf'];
$cnpj = $rowempresa ['cnpj'];
$ie = $rowempresa ['insc_estadual'];
$filiais = $rowempresa ['filiais'];

$telefone = (strlen ( $rowempresa ['telefone'] )) ? explode ( '-', $rowempresa ['telefone'] ) : '';
$dddtel = $telefone [0];
$tel1 = $telefone [1];
$tel2 = $telefone [2];

$fax = (strlen ( $rowempresa ['fax'] )) ? explode ( '-', $rowempresa ['fax'] ) : '';
$dddfax = $fax [0];
$fax1 = $fax [1];
$fax2 = $fax [2];

$qtd_terminal = $rowempresa ['qtd_terminal'];
$im = $rowempresa ['ie'];
$qtd_turnos = $rowempresa ['qtd_turnos'];
$email = $rowempresa ['email'];
$site = $rowempresa ['site'];
$bairro = $rowempresa ['bairro'];

$cep = (strlen ( $rowempresa ['cep'] )) ? explode ( '-', $rowempresa ['cep'] ) : '';
?>

<table width="100%">
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td align="center">

		<table width="100%">
			<tr>
				<td><b><?=$_CONF['lang']['empresa_lista'][0];?> <?=$nome_empresa;?></b></td>
			</tr>
			<tr>
				<td>

				<table>
					<tr>
						<td width="80" height="25"><?=$_CONF['lang']['empresa_lista'][1];?></td>
						<td><input type="text" id="cnpj" value="<?=$cnpj;?>" maxlength="18" style="width: 150px;" /></td>
					</tr>
					<tr>
						<td height="25"><?=$_CONF['lang']['empresa_lista'][2];?></td>
						<td><input type="text" id="ie" value="<?=$ie;?>" maxlength="16" style="width: 150px;" /></td>
					</tr>
					<tr>
						<td height="25"><?=$_CONF['lang']['empresa_lista'][3];?></td>
						<td><input type="text" id="endereco" value="<?=$endereco;?>" maxlength="100" style="width: 150px;" /></td>
					</tr>
					<tr>
						<td height="25"><?=$_CONF['lang']['empresa_lista'][4];?></td>
						<td><input type="text" id="bairro" value="<?=$bairro;?>" maxlength="200" style="width: 150px;" /></td>
					</tr>
					<tr>
						<td height="25"><?=$_CONF['lang']['empresa_lista'][5];?></td>
						<td><input type="text" id="cidade" value="<?=$cidade;?>" style="width: 100px;" maxlength="30" /> / <select id="estado">
							<option value="AC" <?=($uf == 'AC') ? 'selected="selected"' : '';?>>AC</option>
							<option value="AL" <?=($uf == 'AL') ? 'selected="selected"' : '';?>>AL</option>
							<option value="AP" <?=($uf == 'AP') ? 'selected="selected"' : '';?>>AP</option>
							<option value="AM" <?=($uf == 'AM') ? 'selected="selected"' : '';?>>AM</option>
							<option value="BA" <?=($uf == 'BA') ? 'selected="selected"' : '';?>>BA</option>
							<option value="CE" <?=($uf == 'CE') ? 'selected="selected"' : '';?>>CE</option>
							<option value="DF" <?=($uf == 'DF') ? 'selected="selected"' : '';?>>DF</option>
							<option value="GO" <?=($uf == 'GO') ? 'selected="selected"' : '';?>>GO</option>
							<option value="ES" <?=($uf == 'ES') ? 'selected="selected"' : '';?>>ES</option>
							<option value="MA" <?=($uf == 'MA') ? 'selected="selected"' : '';?>>MA</option>
							<option value="MT" <?=($uf == 'MT') ? 'selected="selected"' : '';?>>MT</option>
							<option value="MS" <?=($uf == 'MS') ? 'selected="selected"' : '';?>>MS</option>
							<option value="MG" <?=($uf == 'MG') ? 'selected="selected' : '';?>>MG</option>
							<option value="PA" <?=($uf == 'PA') ? 'selected="selected' : '';?>>PA</option>
							<option value="PB" <?=($uf == 'PB') ? 'selected="selected' : '';?>>PB</option>
							<option value="PR" <?=($uf == 'PR') ? 'selected="selected' : '';?>>PR</option>
							<option value="PE" <?=($uf == 'PE') ? 'selected="selected' : '';?>>PE</option>
							<option value="PI" <?=($uf == 'PI') ? 'selected="selected' : '';?>>PI</option>
							<option value="RJ" <?=($uf == 'RJ') ? 'selected="selected"' : '';?>>RJ</option>
							<option value="RN" <?=($uf == 'RN') ? 'selected="selected' : '';?>>RN</option>
							<option value="RS" <?=($uf == 'RS') ? 'selected="selected' : '';?>>RS</option>
							<option value="RO" <?=($uf == 'RO') ? 'selected="selected' : '';?>>RO</option>
							<option value="RR" <?=($uf == 'RR') ? 'selected="selected' : '';?>>RR</option>
							<option value="SP" <?=($uf == 'SP') ? 'selected="selected' : '';?>>SP</option>
							<option value="SC" <?=($uf == 'SC') ? 'selected="selected' : '';?>>SC</option>
							<option value="SE" <?=($uf == 'SE') ? 'selected="selected' : '';?>>SE</option>
							<option value="TO" <?=($uf == 'TO') ? 'selected="selected' : '';?>>TO</option>
						</select></td>
					</tr>
					<tr>
						<td height="25"><?=$_CONF['lang']['empresa_lista'][6];?></td>
						<td><input type="text" id="cep1" value="<?=$cep [0];?>" maxlength="5" style="width: 35px;" /> - <input type="text" id="cep2" value="<?=$cep [1];?>" maxlength="3" style="width: 22px;" /></td>
					</tr>
				</table>
				</td>
				<td>
				<table>
					<tr>
						<td width="80" height="25"><?=$_CONF['lang']['empresa_lista'][7];?></td>
						<td>(<input type="text" id="tel1" value="<?=$dddtel;?>" style="width: 20px; text-align: center;" maxlength="2" />) <input type="text" id="tel2" value="<?=$tel1;?>" style="width: 30px;" maxlength="4" /> - <input type="text" id="tel3" value="<?=$tel2;?>" style="width: 30px;" maxlength="4" /></td>
					</tr>
					<tr>
						<td height="25"><?=$_CONF['lang']['empresa_lista'][8];?></td>
						<td>(<input type="text" id="fax1" value="<?=$dddfax;?>" style="width: 20px; text-align: center;" maxlength="2" />) <input type="text" id="fax2" value="<?=$fax1;?>" style="width: 30px;" maxlength="4" /> - <input type="text" id="fax3" value="<?=$fax2;?>" style="width: 30px;" maxlength="4" /></td>
					</tr>
					<tr>
						<td height="25"><?=$_CONF['lang']['empresa_lista'][9];?></td>
						<td><input type="text" id="email" value="<?=$email;?>" maxlength="200" /></td>
					</tr>
					<tr>
						<td height="25"><?=$_CONF['lang']['empresa_lista'][10];?></td>
						<td><input type="text" id="site" value="<?=$site;?>" maxlength="200" /></td>
					</tr>
					<tr>
						<td height="25"><?=$_CONF['lang']['empresa_lista'][11];?></td>
						<td><input type="text" id="qtdfiliais" value="<?=$filiais;?>" style="width: 40px; text-align: center;" maxlength="3" /></td>
					</tr>
					<tr>
						<td height="25"><?=$_CONF['lang']['empresa_lista'][12];?></td>
						<td><input type="text" id="qtdturnos" value="<?=$qtd_turnos;?>" style="width: 40px; text-align: center;" maxlength="1" /></td>
					</tr>
					<tr>
						<td height="25"><?=$_CONF['lang']['empresa_lista'][13];?></td>
						<td><input type="text" id="qtdterminais" value="<?=$qtd_terminal;?>" style="width: 40px; text-align: center;" maxlength="3" /></td>
					</tr>
				</table>
				</td>
			</tr>
		</table>

		</td>
	</tr>
	<tr>
		<td class="l1"></td>
	</tr>
	<tr>
		<td class="l2-r">
		<table width="100%">
			<tr>
				<td align="left"><div id="response"></div> </td>
				<td align="right"><input type="button" value="<?=$_CONF['lang']['empresa_lista'][14];?>" class="botao btn_salvar" style="width: 145px;" onclick="javascript:Configuration.CompanySave();" /></td>
			</tr>
		</table>
		</td>
	</tr>
</table>