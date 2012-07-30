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

if (! isset ( $_GET ['order'] )) {
	$_GET ['order'] = "ASC";
}

if (isset ( $_GET ['refer'] )) {
	$refer = $_GET ['refer'];
} else {
	$refer = '';
}

?>
<fieldset id="p"><legend>Todos Clientes</legend>

<div class="linha_separador ls_conf_P">
<table>
	<tr>
		<td><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/vcard_32.png"
			class="t32"></td>
		<td width="10"></td>
		<td><b>Lista de todos os clientes cadastrados</b> <br />
		Clique em <i>"ir para listagem"</i> para efetuar uma nova busca</td>
	</tr>
</table>
</div>


<div id="lista_todos_clientes"
	style="width: 380px; height: 330px; overflow: auto;">
		<?
		$sql = "SELECT idcliente, txtnome, txttelefone, txtemail FROM cliente ORDER BY txtnome ASC";
		$query = $db->query ( $sql );
		
		if ($db->num_rows ( $query )) {
			?>
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td class="l3"></td>
	</tr>
		<?
			while ( $rows = $db->fetch_assoc ( $query ) ) {
				
				if (strlen ( $rows ['txtnome'] ) > 0) {
					$telefone = (formata_telefone ( $rows ['txttelefone'] ) != ('(00) 0000-0000')) ? formata_telefone ( $rows ['txttelefone'] ) : '';
					?>
				<tr id="clienteescolhido_bg_<?=$rows ['idcliente'];?>"
		style="cursor: pointer; cursor: hand;"
		onclick="javascript:carrega_cliente_mostradados('<?=$rows ['idcliente'];?>')">
		<td height="25" id="clienteescolhido_<?=$rows ['idcliente'];?>">&nbsp;<img
			src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/vcard.png" class="t22"
			align="absmiddle"> <span id="nomecliente_<?=$rows ['idcliente'];?>"
			style="height: 25px;"><?=qtdCaracteres ( ucwords ( strtolower ( $rows ['txtnome'] ) ), 50 );?><span></td>
	</tr>
	<tr>
		<td class="l3"></td>
	</tr>
		<?
				}
			}
			?>
			<table>
		<?
		} else {
			echo exibe_errohtml ( 'nenhum cliente cadastrado' );
		}
		?>
		</div>

		</fieldset>