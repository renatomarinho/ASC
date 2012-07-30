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

$tarefa = $validations->validStringForm ( $_POST ['tarefa'] );

$horaescolhida1 = $validations->validNumeric ( $_POST ['he1'] );
$minutoescolhido1 = $validations->validNumeric ( $_POST ['mi1'] );
$diaescolhido1 = $validations->validNumeric ( $_POST ['de1'] );
$mesescolhido1 = $validations->validNumeric ( $_POST ['me1'] );
$anoescolhido1 = $validations->validNumeric ( $_POST ['ae1'] );

$horaescolhida2 = $validations->validNumeric ( $_POST ['he2'] );
$minutoescolhido2 = $validations->validNumeric ( $_POST ['mi2'] );
$diaescolhido2 = $validations->validNumeric ( $_POST ['de2'] );
$mesescolhido2 = $validations->validNumeric ( $_POST ['me2'] );
$anoescolhido2 = $validations->validNumeric ( $_POST ['ae2'] );

$acompanhamento = $validations->validNumeric ( $_POST ['acompanhamento'] );

$data1 = mktime ( $horaescolhida1, $minutoescolhido1, 0, $mesescolhido1, $diaescolhido1, $anoescolhido1 );
$data2 = mktime ( $horaescolhida2, $minutoescolhido2, 0, $mesescolhido2, $diaescolhido2, $anoescolhido2 );

if ($_POST ['id_agenda'] == "") {
	
	$sql = "INSERT INTO rvs_agendaeventos ( inicio, final, tarefa, status, sync_timestamp ) VALUES ( " . $data1 . ", " . $data2 . ", '" . nl2br ( $tarefa ) . "', " . $acompanhamento . ", " . strtotime ( 'now' ) . " )";
	$db->query ( $sql );
	echo $db->insert_id ();
} else {
	$sql = "UPDATE rvs_agendaeventos SET inicio = '{$data1}',  final = '{$data2}', tarefa = '" . nl2br ( $tarefa ) . "', status = '{$acompanhamento}', sync_timestamp = " . strtotime ( 'now' ) . " WHERE idagendaeventos = " . $_POST ['id_agenda'] . " ";
	$db->query ( $sql );
	echo $_POST ['id_agenda'];
}

?>
