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
	require "config/default.php";
}

session_unset ();
session_destroy ();

$nomecliente = $_CONF ['nome_loja'];

?>
<HTML>
<HEAD>

<title><?=$_CONF ['nome_loja']?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="css/estilo.css" />

</head>
<body>

<form action="autenticacao.php" method="POST">
<table width="100%" height="100%">
	<tr>
		<td align="center">
		<table background="imgs/bglogin.jpg" width="552" height="286">
			<tr>
				<td>
				<table>
					<tr>
						<td height="38"></td>
					</tr>
					<tr>
						<td width="30"></td>
						<td>
						<table width="302" height="126" background="imgs/boxlogin.jpg">
							<tr>
								<td align="center">
								<TABLE align="center">
									<tr>
										<td height="8"></td>
									</tr>
									<TR>
										<TD width="70"><b style="font-size: 14px; color: #666;">Usuário</b></TD>
										<TD><input type="text" name="usuario_1" class="inputacesso"
											maxlength="15"
											style="width: 120px; font-size: 14px; border: 1px solid #c0c0c0;"></TD>
									</TR>
									<TR>
										<TD><b style="font-size: 14px; color: #666;">Senha</b></TD>
										<TD><input type="password" name="senha_1" class="inputacesso"
											maxlength="20"
											style="width: 120px; font-size: 14px; border: 1px solid #c0c0c0;"></TD>
									</TR>
									<TR>
										<TD colspan="2" align="right"><input type="image"src="imgs/btnacessar.jpg" name="acessar" value="Fazer Login"style="border: none;"></TD>
									</TR>
								</TABLE>
								</td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td height="23"></td>
					</tr>
					<td>
					
					
					<td colspan="2">
					<div style="margin-left: 120px;font-size:12px;">&nbsp;<?=$nomecliente;?></div>
					</td>
					</td>
				</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>


</FORM>

</body>
</html>