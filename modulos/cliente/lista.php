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

$sql = "SELECT idcliente as total FROM cliente";
$query = $db->query ( $sql );
$totalclientes = $db->num_rows ( $query );

?>

<fieldset id="g"><legend>Lista de Clientes</legend>

<div class="linha_separador">
<table width="100%">
	<tr>
		<td>
		<table>
			<tr>
				<td><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/vcard_72.png"
					class="t72"></td>
				<td width="10"></td>
				<td><b>Atualmente <?=(($totalclientes == 0) ? 'não possui nenhum cliente cadastrado' : 'possui ' . $totalclientes . ' clientes cadastrado') . (($totalclientes <= 1) ? '' : 's');?></b>
				<br />
				Para encontrar um cliente com facilidade utilize a busca</i></td>
			</tr>
		</table>
		</td>
		<td align="right">
		<table>
			<tr>
				<td>
				<table>
					<tr>
						<td><input type="text" id="pesquisacliente"
							style="width: 329px; font-size: 16px;" maxlength="50"></td>
						<td width="11"></td>
						<td><input type="button" value="buscar cliente"
							class="botao btn_buscar"
							onclick="javascript:pesquisar_cliente();"></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td>
				<table>
					<tr>
						<td>
						<table width="100%" cellpadding="0" cellspacing="0">
							<tr>
								<td><input type="radio" name="pesquisa" id="rdopesquisanome" checked onclick="javascript:pesquisar_cliente();"></td>
								<td>nome</td>
								<td width="10"></td>
								<td><input type="radio" id="rdopesquisacodigo" name="pesquisa" value="2" onclick="javascript:pesquisar_cliente();"></td>
								<td>c&oacute;digo</td>
								<td width="10"></td>
								<td><input type="radio" id="rdopesquisacpf" name="pesquisa" value="3" onclick="javascript:pesquisar_cliente();"></td>
								<td>CFP/CNPJ</td>
								<td width="10"></td>
								<td><input type="radio" id="rdopesquisaemail" name="pesquisa" value="4" onclick="javascript:pesquisar_cliente();"></td>
								<td>e-mail</td>
								<td width="10"></td>
								<td><input type="radio" id="rdopesquisatelefone" name="pesquisa" value="5" onclick="javascript:pesquisar_cliente();"></td>
								<td>telefone</td>
								<td width="10"></td>
								<td><input type="radio" id="rdopesquisacelular" name="pesquisa" value="6" onclick="javascript:pesquisar_cliente();"></td>
								<td>celular</td>
							</tr>
						</table>
						</td>
						<td width="10"></td>
						<td><input type="button" value="adicionar cliente" class="botao btn_adicionargreen green" onclick="javascript:adicionar_cliente_obs();"></td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</div>
<div>

<table width="932">
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td>
		<div id="listacliente" style="overflow: auto; height: 270px; width: 927px;"></div>
		</td>
	</tr>
</table>

</div>

</fieldset>
