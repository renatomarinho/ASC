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

$idusuario = $validations->validNumeric ( $_GET ['i'] );

if ($idusuario) {
	$sql = 'SELECT id, login, senha, autoriza, ativo, nome FROM cad_login WHERE id=' . $idusuario;
	$query = $db->query ( $sql );
	$row = $db->fetch_assoc ( $query );
	for($n = 0; $n < $_CONF ['max_perm']; $n ++) {
		if (permite ( $row ['login'], $n ))
			$per [$n] = TRUE;
		else
			$per [$n] = 0;
	}
	
	$ativo = TRUE;
	if ($row ['ativo'] == 'desativo')
		$ativo = FALSE;

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
				<td align="left"><b>Dados do usuário selecionado</b></td>
				<td align="right">
					<input type="button" value="desativado" class="botao" id="btndesativado_dados_<?=$idusuario;?>" style="cursor:pointer;cursor:hand;width:80px;background-color:red;display:<?=(! $ativo) ? 'block' : 'none'?>" onclick="javascript:carrega_usuariosadm_ativa(<?=$idusuario;?>);" onMouseover="ddrivetip('<font style=color:#fff><center><b>DESATIVADO</b><BR>Clique para ativar</center></font>','<?=$_CONF ['sub_red'];?>', 110)"; onMouseout="hideddrivetip()">
					<input type="button" value="ativado" class="botao" id="btnativado_dados_<?=$idusuario;?>" style="cursor:pointer;cursor:hand;width:80px;background-color:green;display:<?=(! $ativo) ? 'none' : 'block'?>" onclick="javascript:carrega_usuariosadm_desativa(<?=$idusuario;?>);" onMouseover="ddrivetip('<font style=color:#fff><center><b>ATIVADO</b><BR>Clique para desativar</center></font>','<?=$_CONF ['sub_green'];?>', 130)"; onMouseout="hideddrivetip()">
				</td>
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
								<td><span id="usu_nome"><?=ucwords ( strtolower ( $row ['nome'] ) );?></span></td>
							</tr>
						</table>
						</td>
						<td align="right">
							<input type="button" value="editar usuario" class="botao" id="btneditar" style="cursor: pointer; cursor: hand; width: 120px;" onclick="javascript:carrega_usuariosadm_editar(<?=$idusuario;?>);" />
							<input type="button" value="salvar dados" class="botao" id="btnsalvar" style="cursor: pointer; cursor: hand; width: 120px; background-color: green; display: none;" onclick="javascript:carrega_usuariosadm_salvar(<?=$idusuario;?>);" />
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
						<td><span id="usu_login"><?=$row ['login'];?></span></td>
					</tr>
					<tr>
						<td height="25"><b>Senha</b></td>
						<td height="20" width="10"></td>
						<td><span id="usu_senha">**********</span></td>
					</tr>
				</table>
				</td>
				<td width="50%" valign="top">
				<table>
					<tr>
						<td><input type="button" value="ver logs acesso" class="botao" id="btnlogacesso" style="cursor: pointer; cursor: hand; width: 120px;" onclick="javascript:carrega_usuariosadm_logacesso('<?=$idusuario;?>');" /></td>
						<td></td>
						<td><input type="button" value="ver permissoes" class="botao" id="btnpermissoes" style="cursor: pointer; cursor: hand; width: 120px;" onclick="javascript:carrega_usuariosadm_permissoesacesso('<?=$idusuario;?>');" /></td>
					</tr>
				</table>
				</td>
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