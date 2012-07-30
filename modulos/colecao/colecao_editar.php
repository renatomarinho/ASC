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

$sql = "SELECT idcolecao, txtnome, txtperiodo, txtdescricao FROM colecao WHERE idcolecao=" . $_GET ['id'] . "";
$query = $db->query ( $sql );
$rowcolecao = $db->fetch_assoc ( $query );

if (strpos ( $rowcolecao ['txtperiodo'], 'at�' )) {
	$periodo = str_replace ( ' at� ', '|', $rowcolecao ['txtperiodo'] );
	$periodo = explode ( '|', $periodo );
	$periodo01 = explode ( '/', $periodo [0] );
	$periodo01_mes = adiciona_zeronumero ( $periodo01 [0] );
	$periodo01_ano = $periodo01 [1];
	$periodo02 = explode ( '/', $periodo [1] );
	$periodo02_mes = adiciona_zeronumero ( $periodo02 [0] );
	$periodo02_ano = $periodo02 [1];
} else {
	$periodo01 = explode ( '/', $rowcolecao ['txtperiodo'] );
	$periodo01_mes = adiciona_zeronumero ( $periodo01 [0] );
	$periodo01_ano = $periodo01 [1];
}

?>


<fieldset id="p"><legend>Editar Cole��o</legend>


<div class="linha_separador" style="width: 352px;">
<table width="100%">
	<tr>
		<td align="center"><span id="mensagem"><b>Defina o nome e o per�odo da
		cole��o</b></span></td>
	</tr>
</table>
</div>

<div id="conteudocolecao">
<table width="370">
	<tr>
		<td height="5" colspan="2"></td>
	</tr>
	<tr>
		<td height="20"><b>Dados da Cole��o</b></td>
	</tr>
	<tr>
		<td colspan="2" style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td align="center">
		<table>
			<tr>
				<td height="25"><b>Nome</b></td>
				<td width="5"></td>
				<td><input class="input" type="text" id="nomenovacolecao"
					value="<?=ucwords ( strtolower ( $rowcolecao ['txtnome'] ) );?>"
					style="width: 240px" maxlength="30"></td>
			</tr>
			<tr>
				<td height="25"><b>Per�odo</b></td>
				<td width="5"></td>
				<td><select id="colecaomes1">
										<?
										for($n = 1; $n <= 12; $n ++) {
											?>
										<option value="<?=$n;?>"
						<?=($n == $periodo01_mes) ? 'selected' : '';?>><?=$n;?></option>
										<?
										}
										?>
									</select> &nbsp;de&nbsp; <select id="colecaoano1">
										<?
										$ano_inicial = date ( 'Y' ) - 2;
										$ano_final = date ( 'Y' ) + 3;
										for($n = $ano_inicial; $n <= $ano_final; $n ++) {
											?>
										<option value="<?=$n;?>"
						<?=($n == $periodo01_ano) ? 'selected' : '';?>><?=$n;?></option>
										<?
										}
										?>
									</select> &nbsp;at�&nbsp; <select id="colecaomes2">
										<?
										for($n = 1; $n <= 12; $n ++) {
											?>
										<option value="<?=$n;?>"
						<?=($n == $periodo02_mes) ? 'selected' : '';?>><?=$n;?></option>
										<?
										}
										?>
									</select> &nbsp;de&nbsp; <select id="colecaoano2">
										<?
										for($n = $ano_inicial; $n <= $ano_final; $n ++) {
											?>
										<option value="<?=$n;?>"
						<?=($n == $periodo02_ano) ? 'selected' : '';?>><?=$n;?></option>
										<?
										}
										?>
									</select></td>
			</tr>
			<tr>
				<td valign="top"><b>Descri��o</b></td>
				<td width="5"></td>
				<td><textarea id="descricaocolecao" style="width: 240px;" rows="6"><?=strip_tags ( $rowcolecao ['txtdescricao'] );?></textarea></td>
			</tr>
			<tr>
				<td height="25"></td>
				<td width="5"></td>
				<td align="right"><input type="button" class="botao"
					style="cursor: pointer; cursor: hand; width: 80px;"
					value="adicionar"
					onClick="javascript:adicionar_novacolecaosalvar('sim', '<b style=color:green>A colecao foi adicionada com sucesso</b><br/><br/>Obs.: A colecao adicionada encontra-se selecionada no combo <b>Cole��o</b> do produto. Para mudar a cole��o atual do produto para a que foi adicionada clique no bot�o <b>Editar dados do produto</b>.');"></td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</div>

</fieldset>