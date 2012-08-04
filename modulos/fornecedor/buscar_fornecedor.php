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

$sql = "SELECT COUNT(pr.idproduto) AS total, f.idfornecedor, f.nome, f.telefone, p.nome AS nomepais FROM fornecedor AS f INNER JOIN paises AS p ON f.idpais=p.numcode LEFT JOIN produto AS pr ON f.idfornecedor=pr.fornecedor_idfornecedor GROUP BY f.nome ORDER BY f.nome ASC";
$query = $db->query ( $sql );

if ($db->num_rows ( $query )) {
	
	$table = '<table width="100%" cellpadding="0" cellspacing="0" border="0">';
	
	while ( $rows = $db->fetch_assoc ( $query ) ) {
		
		if (strlen ( $rows ['nome'] ) > 0) {
			$telefone = (formata_telefone ( $rows ['telefone'] ) != ('(00) 0000-0000')) ? formata_telefone ( $rows ['telefone'] ) : '';
			$table .= '<tr style="cursor:pointer; cursor:hand;" onmouseover="rowOver(this)" onmouseout="rowOut(this)" onclick="javascript:carrega_dadosfornecedor(\'' . $rows ['idfornecedor'] . '\');">';
			$table .= '<td width="10" height="25"></td>';
			$table .= '<td width="180" height="25">' . qtdCaracteres ( ucwords ( strtolower ( $rows ['nome'] ) ), 30 ) . '</td>';
			$table .= '<td align="right" height="25">' . $telefone . '</td>';
			$table .= '<td align="right" height="25">' . qtdCaracteres ( $rows ['nomepais'], 15 ) . '</td>';
			$table .= '<td width="70" height="25" align="center">' . $rows ['total'] . '</td>';
			$table .= '</tr>';
			$table .= '<tr>';
			$table .= '<td colspan="5" style="border-bottom: 1px solid #c0c0c0;"></td>';
			$table .= '</tr>';
		}
	}
	
	$table .= '<table>';

} else {
	
	$table = exibe_errohtml ( 'Não possui nenhum fornecedor cadastrado' );

}

echo $table;

?>