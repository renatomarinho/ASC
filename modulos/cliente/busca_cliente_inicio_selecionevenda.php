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

if (isset ( $_GET ['c'] ) || isset ( $_GET ['s'] )) {
	$sqldinamic = "WHERE " . $_GET ['c'] . " LIKE '%" . $_GET ['s'] . "%' ORDER BY txtnome ASC";
} else {
	$sqldinamic = '';
}

$sql = "SELECT idcliente, txtnome FROM cliente " . $sqldinamic . "";
$query = $db->query ( $sql );

if ($db->num_rows ( $query )) {
	
	$table = '<table width="100%" cellpadding="0" cellspacing="0" border="0">';
	while ( $rows = $db->fetch_assoc ( $query ) ) {
		
		$table .= '<tr onmouseover="rowOver(this)" onmouseout="rowOut(this)">';
		$table .= '<td width="5"></td>';
		$table .= '<td width="80" align="center"><input type="button" onclick="javascript:carregar_cliente_inicioselecionadoparavenda(\'' . $rows ['idcliente'] . '\', \'' . ucwords ( strtolower ( $rows ['txtnome'] ) ) . '\');" value="selecionar" style="cursor:pointer;cursor:hand;color:black" onmouseover="javascript:this.style.background=\'#6aa9e9\';this.style.color=\'white\';" onmouseout="javascript:this.style.background=\'#FFFFFF\';this.style.color=\'black\';"></td>';
		$table .= '<td width="80" align="center"><input type="button" onclick="javascript:carregar_cliente_inicioselecionadodetalhes(\'' . $rows ['idcliente'] . '\');" value="detalhes" style="cursor:pointer;cursor:hand;color:black" onmouseover="javascript:this.style.background=\'#6aa9e9\';this.style.color=\'white\';" onmouseout="javascript:this.style.background=\'#FFFFFF\';this.style.color=\'black\';"></td>';
		$table .= '<td width=10></td>';
		$table .= '<td height="25">' . ucwords ( strtolower ( $rows ['txtnome'] ) ) . '</td>';
		$table .= '</tr>';
		$table .= '<tr>';
		$table .= '<td colspan="5" class="l3"></td>';
		$table .= '</tr>';
	
	}
	
	$table .= '<table>';

} else {
	
	$table = '<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">';
	$table .= '<tr><td align=center><img src="' . $_CONF ['PATH_VIRTUAL'] . 'imgs/aviso.png"><BR><b style=color:red>[ ' . $_GET ['s'] . ' ]<BR><BR>cliente n�o encontrado</b></td></tr>';
	$table .= '<table>';

}

echo $table;

?>