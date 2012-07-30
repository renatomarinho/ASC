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
$validations = new validations ();
$db = new db ();
$db->connect ();

/*
 * FIXME Change cad_empresa_id to dinamic id
 */

$sql = "SELECT vendanormal, vendavip, reducao_estoque, estorno_estoque, etiquetas, mailling, administradores, configuracoes FROM configuracao WHERE cad_empresa_id=1";
$query = $db->query($sql);
$row = $db->fetch_assoc($query);
?>		
		<table>
			<tr>
				<td>
				<table>
					<tr>
						<td height="25" colspan="2"><b><?=$_CONF['lang']['autenticacao_lista'][0];?></b></td>
					</tr>
					<tr>
						<td height="25"><input type="radio" name="vendanormal" id="vendanormal_sim" <?=($row['vendanormal']==1)?'checked':'';?> /></td>
						<td><?=$_CONF['lang']['autenticacao_lista'][3];?></td>
					</tr>
					<tr>
						<td height="25"><input type="radio" name="vendanormal" id="vendanormal_nao" <?=($row['vendanormal']==0)?'checked':'';?> /></td>
						<td><?=$_CONF['lang']['autenticacao_lista'][4];?></td>
					</tr>
				</table>
				</td>
				<td width="40"></td>
				<td>
				<table>
					<tr>
						<td height="25" colspan="2"><b><?=$_CONF['lang']['autenticacao_lista'][1];?></b></td>
					</tr>
					<tr>
						<td height="25"><input type="radio" name="vendavip" id="vendavip_sim" <?=($row['vendavip']==1)?'checked':'';?> /></td>
						<td><?=$_CONF['lang']['autenticacao_lista'][3];?></td>
					</tr>
					<tr>
						<td height="25"><input type="radio" name="vendavip" id="vendavip_nao" <?=($row['vendavip']==0)?'checked':'';?> /></td>
						<td><?=$_CONF['lang']['autenticacao_lista'][4];?></td>
					</tr>
				</table>
				</td>
				<td width="40"></td>
				<td>
				<table>
					<tr>
						<td height="25" colspan="2"><b><?=$_CONF['lang']['autenticacao_lista'][2];?></b></td>
					</tr>
					<tr>
						<td height="25"><input type="radio" name="reducaoestoque" id="reducaoestoque_sim" <?=($row['reducao_estoque']==1)?'checked':'';?> /></td>
						<td><?=$_CONF['lang']['autenticacao_lista'][3];?></td>
					</tr>
					<tr>
						<td height="25"><input type="radio" name="reducaoestoque" id="reducaoestoque_nao" <?=($row['reducao_estoque']==0)?'checked':'';?> /></td>
						<td><?=$_CONF['lang']['autenticacao_lista'][4];?></td>
					</tr>
				</table>
				</td>
				<td width="40"></td>
				<td>
				<table>
					<tr>
						<td height="25" colspan="2"><b><?=$_CONF['lang']['autenticacao_lista'][5];?></b></td>
					</tr>
					<tr>
						<td height="25"><input type="radio" name="estornoprodutos" id="estornoprodutos_sim" <?=($row['estorno_estoque']==1)?'checked':'';?> disabled="disabled" /></td>
						<td><?=$_CONF['lang']['autenticacao_lista'][3];?></td>
					</tr>
					<tr>
						<td height="25"><input type="radio" name="estornoprodutos" id="estornoprodutos_nao" <?=($row['estorno_estoque']==0)?'checked':'';?> disabled="disabled" /></td>
						<td><?=$_CONF['lang']['autenticacao_lista'][4];?></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td>
				<table>
					<tr>
						<td height="25" colspan="2"><b><?=$_CONF['lang']['autenticacao_lista'][6];?></b></td>
					</tr>
					<tr>
						<td height="25"><input type="radio" name="etiquetas" id="etiquetas_sim" <?=($row['etiquetas']==1)?'checked':'';?> disabled="disabled" /></td>
						<td><?=$_CONF['lang']['autenticacao_lista'][3];?></td>
					</tr>
					<tr>
						<td height="25"><input type="radio" name="etiquetas" id="etiquetas_nao" <?=($row['etiquetas']==0)?'checked':'';?> disabled="disabled" /></td>
						<td><?=$_CONF['lang']['autenticacao_lista'][4];?></td>
					</tr>
				</table>
				</td>
				<td width="40"></td>
				<td>
				<table>
					<tr>
						<td height="25" colspan="2"><b><?=$_CONF['lang']['autenticacao_lista'][7];?></b></td>
					</tr>
					<tr>
						<td height="25"><input type="radio" name="mailling" id="mailling_sim" <?=($row['mailling']==1)?'checked':'';?> disabled="disabled" /></td>
						<td><?=$_CONF['lang']['autenticacao_lista'][3];?></td>
					</tr>
					<tr>
						<td height="25"><input type="radio" name="mailling" id="mailling_nao" <?=($row['mailling']==0)?'checked':'';?> disabled="disabled" /></td>
						<td><?=$_CONF['lang']['autenticacao_lista'][4];?></td>
					</tr>
				</table>
				</td>
				<td width="40"></td>
				<td>
				<table>
					<tr>
						<td height="25" colspan="2"><b><?=$_CONF['lang']['autenticacao_lista'][8];?></b></td>
					</tr>
					<tr>
						<td height="25"><input type="radio" name="administradores" id="administradores_sim" <?=($row['administradores']==1)?'checked':'';?> disabled="disabled" /></td>
						<td><?=$_CONF['lang']['autenticacao_lista'][3];?></td>
					</tr>
					<tr>
						<td height="25"><input type="radio" name="administradores" id="administradores_nao" <?=($row['administradores']==0)?'checked':'';?> disabled="disabled" /></td>
						<td><?=$_CONF['lang']['autenticacao_lista'][4];?></td>
					</tr>
				</table>
				</td>
				<td width="40"></td>
				<td>
				<table>
					<tr>
						<td height="25" colspan="2"><b><?=$_CONF['lang']['autenticacao_lista'][9];?></b></td>
					</tr>
					<tr>
						<td height="25"><input type="radio" name="configuracoes" id="configuracoes_sim" <?=($row['configuracoes']==1)?'checked':'';?> disabled="disabled" /></td>
						<td><?=$_CONF['lang']['autenticacao_lista'][3];?></td>
					</tr>
					<tr>
						<td height="25"><input type="radio" name="configuracoes" id="configuracoes_nao" <?=($row['configuracoes']==0)?'checked':'';?> disabled="disabled" /></td>
						<td><?=$_CONF['lang']['autenticacao_lista'][4];?></td>
					</tr>
				</table>
				</td>
			</tr>
		</table>