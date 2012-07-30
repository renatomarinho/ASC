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

$mes1 = date ( 'm' );
$mes2 = date ( 'm' );
$ano1 = date ( 'Y' );
$ano2 = date ( 'Y' );
?>


<fieldset id="p"><legend>Adicionar cole��o</legend>


<div class="linha_separador" id="linha_separador_colecao"
	style="width: 352px; height: 27px;">
<table width="100%" height="100%">
	<tr>
		<td align="center"><span id="mensagem"></span></td>
	</tr>
</table>
</div>

<div id="conteudocolecao">
<table width="370">
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td height="20"><b>Dados Gerais da cole��o</b></td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td>
		<table>
			<tr>
				<td height="25">Nome</td>
				<td width="5"></td>
				<td><input class="input" type="text" id="nomenovacolecao"
					style="width: 240px" maxlength="30"></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td height="20">
		<table width="100%">
			<tr>
				<td><b>Per�odo</b></td>
				<td align="right">
				<table>
					<tr>
						<td>dura��o indeterminada</td>
						<td width="2"></td>
						<td><input type="checkbox" id="duracaocolecao"
							onclick="javascript:var p1=document.getElementById('peridodeterminado');p1.style.display=((p1.style.display=='none')?'block':'none');var p2=document.getElementById('peridoindeterminado');p2.style.display=((p1.style.display=='none')?'block':'none')"></td>
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
		<td height="25">
		<div id="peridodeterminado">
		<table align="center">
			<tr>
				<td><select id="colecaomes1" style="width: 90px;">
											<?
											for($n = 1; $n <= 12; $n ++) {
												?>
											<option value="<?=$n;?>" <?=($n == $mes1) ? 'selected' : '';?>><?=$meses [$n];?></option>
											<?
											}
											?>
										</select></td>
				<td>&nbsp;de&nbsp;</td>
				<td><select id="colecaoano1" style="width: 50px;">
											<?
											$ano_inicial = date ( 'Y' ) - 2;
											$ano_final = date ( 'Y' ) + 3;
											for($n = $ano_inicial; $n <= $ano_final; $n ++) {
												?>
											<option value="<?=$n;?>"
						<?=($n == date ( 'Y' )) ? 'selected' : '';?>><?=$n;?></option>
											<?
											}
											?>
										</select></td>
				<td>&nbsp;at�&nbsp;</td>
				<td><select id="colecaomes2" style="width: 90px;">
											<?
											for($n = 1; $n <= 12; $n ++) {
												?>
											<option value="<?=$n;?>" <?=($n == $mes2) ? 'selected' : '';?>><?=$meses [$n];?></option>
											<?
											}
											?>
										</select></td>
				<td>&nbsp;de&nbsp;</td>
				<td><select id="colecaoano2" style="width: 50px;">
											<?
											$ano_inicial = date ( 'Y' ) - 2;
											$ano_final = date ( 'Y' ) + 3;
											for($n = $ano_inicial; $n <= $ano_final; $n ++) {
												?>
											<option value="<?=$n;?>"
						<?=($n == date ( 'Y' )) ? 'selected' : '';?>><?=$n;?></option>
											<?
											}
											?>
										</select></td>
			</tr>
		</table>
		</div>
		<div id="peridoindeterminado" style="display: none;"><b
			style="color: red;">Sem per�odo definido</b></div>
		</td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td height="20"><b>Descri��o</b></td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td height="2"></td>
	</tr>
	<tr>
		<td><textarea id="descricaocolecao" style="width: 370px;" rows="5"></textarea></td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td height="2"></td>
	</tr>
	<tr>
		<td height="25" align="right"><input type="button" class="botao"
			style="cursor: pointer; cursor: hand; width: 140px; background-color: green;"
			value="adicionar cole��o"
			onClick="javascript:adicionar_novacolecaosalvar('nao', '<b style=color:green>A colecao foi adicionada com sucesso</b>');"></td>
	</tr>
</table>
</div>

</fieldset>