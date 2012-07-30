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

$db = new db ( );
$db->connect ();

?>

<fieldset id="p"><legend>Administradores</legend>

<div class="linha_separador" style="height: 25px;">
<table width="100%">
	<tr>
		<td align="right"><input type="button" value="adicionar administrador"
			class="botao" id="btnadicionaradm"
			style="cursor: pointer; cursor: hand; width: 180px;"
			onclick="javascript:carregar_usuarioadm_adicionar();"></td>
	</tr>
</table>
</div>

<div>
<table width="378">
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td height="25"><b>Lista dos usu�rios administradores</b></td>
	</tr>
	<tr>
		<td style="border-top: 2px solid black"></td>
	</tr>
	<tr>
		<td>
		<div id="listausers" style="height: 300px; overflow: auto;">
		<table cellpadding="0" cellspacing="0" width="100%">
							<?
							$sql = "SELECT l.id , l.nome, l.ativo, count( h.id ) as total FROM cad_login as l LEFT JOIN log_login AS h ON h.cad_login_id=l.id GROUP BY l.id ORDER BY l.nome ASC";
							$query = $db->query ( $sql );
							$ativo = TRUE;
							while ( $result = $db->fetch_assoc ( $query ) ) {
								$ativo = TRUE;
								if ($result ['ativo'] == 'desativo')
									$ativo = FALSE;
								?>
							<tr onmouseover="rowOver(this)" onmouseout="rowOut(this)"
				style="cursor: pointer; cursor: hand;">
				<td width="10"></td>
				<td height="25"
					onclick="javascript:carrega_usuariosadm_dados('<?=$result ['id']?>');"><span id="usunome_<?=$result ['id'];?>" style="color:<?=($ativo) ? 'black' : 'red';?>"><?=ucwords ( strtolower ( $result ['nome'] ) );?></span></td>
				<td align="right"
					onclick="javascript:carrega_usuariosadm_dados('<?=$result ['id']?>');">
									<?
								if ($result ['total'] == 0) {
									?>
									nenhum acesso
									<?
								} else {
									?>
									<?=( int ) $result ['total'];?> acesso<?=($result ['total'] == 1) ? '' : 's';?>
									<?
								}
								?>
								</td>
				<td align="right" width="100"><input type="button" value="desativado" class="botao" id="btndesativado_<?=$result ['id'];?>" style="cursor:pointer;cursor:hand;width:80px;background-color:red;display:<?=(! $ativo) ? 'block' : 'none'?>" onclick="javascript:carrega_usuariosadm_ativa(<?=$result ['id'];?>);" onMouseover="ddrivetip('<font style=color:#fff><center><b>DESATIVADO</b><BR>Clique para ativar</center></font>','<?=$_CONF ['sub_red'];?>', 110)"; onMouseout="hideddrivetip()">

				<input type="button" value="ativado" class="botao" id="btnativado_<?=$result ['id'];?>" style="cursor:pointer;cursor:hand;width:80px;background-color:green;display:<?=(! $ativo) ? 'none' : 'block'?>" onclick="javascript:carrega_usuariosadm_desativa(<?=$result ['id'];?>);" onMouseover="ddrivetip('<font style=color:#fff><center><b>ATIVADO</b><BR>Clique para desativar</center></font>','<?=$_CONF ['sub_green'];?>', 130)"; onMouseout="hideddrivetip()">
				</td>
				<td width="5"></td>
			</tr>
			<tr>
				<td colspan="5" style="border-bottom: 1px solid #c0c0c0;"></td>
			</tr>
							<?
							}
							?>
						</table>
		</div>
		</td>
	</tr>
</table>
</div>

</fieldset>