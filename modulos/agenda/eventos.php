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

if (! isset ( $_GET ['id_agenda'] )) {
	$dinicio = $validations->validNumeric ( $_GET ['d1'] );
	$minicio = $validations->validNumeric ( $_GET ['m1'] );
	$ainicio = $validations->validNumeric ( $_GET ['a1'] );
	
	$diainicio = mktime ( 0, 0, 0, $minicio, $dinicio, $ainicio );
	$diafinal = mktime ( 23, 59, 59, $minicio, $dinicio, $ainicio );
	
	$sql = "SELECT idagendaeventos, inicio, final, tarefa, status FROM rvs_agendaeventos WHERE inicio>" . $diainicio . " AND final<" . $diafinal . "";
} else {
	$sql = "SELECT idagendaeventos, inicio, final, tarefa, status FROM rvs_agendaeventos WHERE idagendaeventos = " . $_GET ['id_agenda'];
}

$query = $db->query ( $sql );
$total = $db->num_rows ( $query );

$retorno = $total . "|*|";

while ( $row = $db->fetch_assoc ( $query ) ) {
	
	$retorno .= $row ['idagendaeventos'] . '|' . date ( 'H:i', $row ['inicio'] ) . '|' . date ( 'H:i', $row ['final'] ) . '|' . $row ['tarefa'] . '|' . $row ['status'] . '+|+';

}

echo $retorno;
?>