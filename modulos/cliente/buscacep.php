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

function Cep($cep1, $cep2) {
	$cepnum = (isset ( $cep1 ) ? $cep1 : '');
	$cepdv = (isset ( $cep2 ) ? $cep2 : '');
	$cepstr = $cepnum . $cepdv;
	if (strlen ( $cepstr ) != 8)
		return false;
	for($i = 0; $i < 8; $i ++) {
		$dig = ord ( $cepstr [$i] );
		if (($dig < 48) || ($dig > 57))
			return false;
	}
	return $cepstr;
}

function busca_cep($cep) {
	$resultado = @file_get_contents ( 'http://republicavirtual.com.br/web_cep.php?cep=' . urlencode ( $cep ) . '&formato=query_string' );
	if (! $resultado) {
		$resultado = "&resultado=0&resultado_txt=erro+ao+buscar+cep";
	}
	parse_str ( $resultado, $retorno );
	return $retorno;
}

$cep = Cep ( $_GET ['cep1'], $_GET ['cep2'] );
if ($cep)
	$endereco = busca_cep ( $cep );

?>
<table>
	<tr>
		<td width="60" height="30">Endereço</td>
		<td><input type="text" name="endereco" id="endereco"
			class="inputform250"
			value="<?=$endereco ['tipo_logradouro'] . ' ' . $endereco ['logradouro'];?>"
			onKeyUp="javascript:upper('endereco');"
			onKeyDown="if(event.keyCode==13) event.keyCode=9;" maxlength="50"></td>
	</tr>
	<tr>
		<td height="30">Bairro</td>
		<td><input type="text" name="bairro" id="bairro" class="inputform250"
			value="<?=$endereco ['bairro'];?>"
			onKeyUp="javascript:upper('bairro');"
			onKeyDown="if(event.keyCode==13) event.keyCode=9;" maxlength="30"></td>
	</tr>
	<tr>
		<td height="30">Cidade</td>
		<td><input type="text" name="cidade" id="cidade" class="inputform250"
			value="<?=$endereco ['cidade'];?>"
			onKeyUp="javascript:upper('cidade');"
			onKeyDown="if(event.keyCode==13) event.keyCode=9;" maxlength="30"></td>
	</tr>
	<tr>
		<td height="30">Estado</td>
		<td>
			<?
			$txtuf = strtoupper ( $endereco ['uf'] );
			?>
			<select name="estado" id="estado">
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
