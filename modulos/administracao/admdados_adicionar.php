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


<table width="100%">
	<tr>
		<td height="20"><span id="msgdadosusu"></span></td>
	</tr>
	<tr>
		<td height="25">
		<table width="100%">
			<tr>
				<td align="left"><b>Dados do usu�rio</b></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td style="border-top: 2px solid black"></td>
	</tr>
	<tr>
		<td>
		<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td colspan="2">
				<table width="100%">
					<tr>
						<td>
						<table cellpadding="4" cellspacing="4">
							<tr>
								<td height="25"><b>Nome</b></td>
								<td width="10"></td>
								<td><input type="text" id="add_usu_nome" style="width: 200px;" maxlength="20" /></td>
							</tr>
						</table>
						</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="border-top: 2px solid black"></td>
			</tr>
			<tr>
				<td colspan="2" height="10"></td>
			</tr>
			<tr>
				<td width="50%">
				<table cellpadding="4" cellspacing="4">
					<tr>
						<td height="25"><b>Login</b></td>
						<td height="20" width="10"></td>
						<td><input type="text" id="add_usu_login" maxlength="15" /></td>
					</tr>
					<tr>
						<td height="25"><b>Senha</b></td>
						<td height="20" width="10"></td>
						<td><input type="password" id="add_usu_senha" value="" onfocus="javascript:document.getElementById('msgdadosusu').innerHTML='<b style=color:red>Preencha a senha com no m�nimo 4 caracteres</b>';" onblur="javascript:document.getElementById('msgdadosusu').innerHTML='';" maxlength="20" /></td>
					</tr>
				</table>
				</td>
				<td width="50%" valign="top"></td>
			</tr>
			<tr>
				<td colspan="2">
				<div id="exibir_dadosusersel" style="height: 190px; overflow: auto;"></div>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>