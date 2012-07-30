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
?>

<fieldset id="m"><legend>Detalhes da atualiza��o</legend>

<div class="linha_separador" id="linha_atualizacao"
	style="width: 480px; height: 13px;">
<table width="100%" height="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td align="center"><span id="msg_atualizacao"></span></td>
	</tr>
</table>
</div>


<div>
<table width="100%">
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td height="20"><b>Informa��es detalhadas</b></td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td>
		<div id="lista_atualizacoes_arquivos"
			style="width: 500px; height: 285px; overflow: auto;">
		<table width="100%">
							<?
							$total = $_SESSION ['arquivo_total'];
							for($i = 0; $i < $total; $i ++) {
								?>
							<input type="hidden" id="dados_arquivo_<?=$i;?>"
				value="<?=$_SESSION ['arquivo_nome'] [$i] . '-|-' . $_SESSION ['arquivo_nomervs'] [$i] . '-|-' . $_SESSION ['arquivo_localizacao'] [$i] . '-|-' . $_SESSION ['arquivo_hasharquivo'] [$i];?>">
			<tr>
				<td height="25">
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td width="10"></td>
						<td width="300"><?=ucfirst ( strtolower ( $_SESSION ['arquivo_nomefake'] [$i] ) );?></td>
						<td width="10"></td>
						<td>
						<div id="main_barra_<?=$i;?>"
							style="width: 200px; border: 1px solid #fff;">
						<p id="barradown_<?=$i;?>" style="width:0px;height:15px;background-color:<?=$_CONF ['btn_normal'];?>;text-align:right;">
						<span id="msgdown_<?=$i;?>"></span></p>
						</div>
						</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td colspan="11" style="border-bottom: 1px solid #c0c0c0;"></td>
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
		<td height="8"></td>
	</tr>
	<tr>
		<td align="center"><span id="msgatualizacoes_status"></td>
	</tr>
</table>
</div>

</fieldset>