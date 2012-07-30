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


<fieldset id="p"><legend>Real Virtual Store</legend>

<div class="linha_separador">
<table width="100%" height="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td align="center"><b style="color: red">Existem novas atualiza��es
		dispon�veis</b></td>
	</tr>
</table>
</div>

<div>
<table width="100%">
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td height="20"><b>Lista de atualiza��es</b></td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td>
		<div id="lista_atualizacoes"
			style="width: 377px; height: 285px; overflow: auto;">
		<table width="100%">
							<?
							$total = count ( $_SESSION ['update_codigo'] ) - 1;
							for($i = 0; $i <= $total; $i ++) {
								?>
							<tr>
				<td height="25"><b>Data</b></td>
				<td width="5">:</td>
				<td><?=timestamp_converte ( $_SESSION ['update_codigo'] [$i], 1 );?></td>
				<td width="30"></td>
				<td><b>Prioridade</b></td>
				<td width="5">:</td>
				<td><?=strtoupper ( prioridade_converte ( $_SESSION ['update_prioridade'] [$i] ) );?></td>
				<td width="30"></td>
				<td><b>Total de Arquivos</b></td>
				<td width="5">:</td>
				<td><?=$_SESSION ['update_arquivos'] [$i];?></td>
				<td width="5"></td>
			</tr>
			<tr>
				<td colspan="12" style="border-bottom: 1px solid #c0c0c0;"></td>
			</tr>
							<?
							}
							?>
						</table>
		</div>
		</td>
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
				<td align="left"><input type="button" class="botao"
					id="depoisatualizacao"
					style="cursor: pointer; cursor: hand; width: 160px; background-color: red;"
					value="deixar para mais tarde"
					onclick="javascript:carregar_atualizacao_depois();"></td>
				<td align="right"><input type="button" class="botao"
					id="iniciaratualizacao"
					style="cursor: pointer; cursor: hand; width: 160px; background-color: green;"
					value="iniciar atualiza��es"
					onclick="javascript:carrega_loading_arquivos();"></td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</div>

</fieldset>