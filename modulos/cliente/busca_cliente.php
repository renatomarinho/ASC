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

$sql = "SELECT idcliente, txtnome, txttelefone, txtemail FROM cliente ";
$sql .= (isset ( $_GET ['s'] ) && $_GET ['s'] != '') ? "WHERE " . $_GET ['c'] . " LIKE '%" . $_GET ['s'] . "%' ORDER BY " . $_GET ['c2'] . " " . $_GET ['order'] . "" : ' ORDER BY idcliente DESC LIMIT 100';

$query = $db->query ( $sql );

if ($db->num_rows ( $query )) {
	
	$table = '<table width="100%" cellpadding="0" cellspacing="0" border="0">';
	$table .= '<tr>';
	$table .= '<td colspan="5" class="l3"></td>';
	$table .= '</tr>';
	while ( $rows = $db->fetch_assoc ( $query ) ) {
		if (strlen ( $rows ['txtnome'] ) > 0) {
			$telefone = (formata_telefone ( $rows ['txttelefone'] ) != ('(00) 0000-0000')) ? formata_telefone ( $rows ['txttelefone'] ) : '';
			$table .= '<tr style="cursor:pointer; cursor:hand;" onmouseover="rowOver(this)" onmouseout="rowOut(this)" onclick="javascript:carrega_edicaocliente(\'' . $rows ['idcliente'] . '\')">';
			$table .= '<td width="20" height="25"></td>';
			$table .= '<td width="350"><img src="' . $_CONF ['PATH_VIRTUAL'] . 'imgs/icons/vcard.png" class="t22" align="absmiddle"> ' . ucwords ( strtolower ( $rows ['txtnome'] ) ) . '</td>';
			$table .= '<td width="140">&nbsp;' . $telefone . '</td>';
			$table .= '<td width="200">&nbsp;' . strtolower ( $rows ['txtemail'] ) . '</td>';
			$table .= '</tr>';
			$table .= '<tr>';
			$table .= '<td colspan="5" class="l3"></td>';
			$table .= '</tr>';
		}
	}
	
	$table .= '<table>';

} else {
	
	$sql = "SELECT idcliente FROM cliente";
	$querycliente = $db->query ( $sql );
	$quantidade = $db->num_rows ( $querycliente );
	if ($quantidade == 0) {
		$table = exibe_errohtml ( 'N�o possui nenhum cliente cadastrado' );
	} else {
		$table = exibe_errohtml ( '' . $_GET ['s'] . ' - n�o encontrado' );
	}
}

echo $table;

?>