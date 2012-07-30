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

$sql = "SELECT idcolecao, txtnome, txtperiodo FROM colecao ORDER BY txtnome ASC";
$query = $db->query ( $sql );

if ($db->num_rows ( $query )) {
	
	$table = '<table width="100%" cellpadding="0" cellspacing="0" border="0">';
	
	while ( $rows = $db->fetch_assoc ( $query ) ) {
		
		if (strlen ( $rows ['txtperiodo'] ) > 8) {
			$periodo_explode = explode ( ' at� ', $rows ['txtperiodo'] );
			$periodo_1 = explode ( '/', $periodo_explode [0] );
			$periodo_2 = explode ( '/', $periodo_explode [1] );
			if ($periodo_1 [0] < 10)
				$periodo_1 [0] = str_replace ( '0', '', $periodo_1 [0] );
			if ($periodo_2 [0] < 10)
				$periodo_2 [0] = str_replace ( '0', '', $periodo_2 [0] );
			$periodocolecao = $meses [$periodo_1 [0]] . ' de ' . $periodo_1 [1] . ' at� ' . $meses [$periodo_2 [0]] . ' de ' . $periodo_2 [1];
		} else {
			$periodocolecao = 'indeterminado';
		}
		
		$sql2 = 'SELECT count(idproduto) as total FROM produto WHERE colecao_idcolecao = ' . $rows ['idcolecao'];
		$query2 = $db->query ( $sql2 );
		$rows2 = $db->fetch_assoc ( $query2 );
		if (strlen ( $rows ['txtnome'] ) > 0) {
			$table .= '<tr style="cursor:pointer; cursor:hand;" onmouseover="rowOver(this)" onmouseout="rowOut(this)" onclick="javascript:carrega_dadoscolecao(\'' . $rows ['idcolecao'] . '\');">';
			$table .= '<td width="10" height="25"></td>';
			$table .= '<td width="180" height="25">' . qtdCaracteres ( ucwords ( strtolower ( $rows ['txtnome'] ) ), 30 ) . '</td>';
			$table .= '<td align="right" height="25">' . $periodocolecao . '</td>';
			$table .= '<td width="90" height="25" align="center">' . $rows2 ['total'] . '</td>';
			$table .= '</tr>';
			$table .= '<tr>';
			$table .= '<td colspan="4" style="border-bottom: 1px solid #c0c0c0;"></td>';
			$table .= '</tr>';
		}
	}
	
	$table .= '<table>';

} else {
	
	$table = exibe_errohtml ( 'N�o possui nenhuma cole��o cadastrada' );

}

echo $table;

?>