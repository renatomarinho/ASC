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

header ( 'Content-Type: text/xml' );
header ( "Cache-Control: no-cache, must-revalidate" );
//A date in the past
header ( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
if (! isset ( $_CONF ['PATH'] )) {
	require "../../config/default.php";
}

$validations = new validations ( );
$db = new db ( );
$db->connect ();

if ($_REQUEST ['fluxo'] == 'receita') {
	$tipo_lancamento = "E";
} elseif ($_REQUEST ['fluxo'] == 'despesa') {
	$tipo_lancamento = "S";
}

$plano = utf8_decode ( $_REQUEST ['novo_plano'] );

$sql = "INSERT INTO
		cad_plano_de_contas ( id , nome_plano , tipo_lancamento , sync_timestamp )
		VALUES (
		NULL , '{$plano}', '{$tipo_lancamento}', NOW()
		);";

$db->query ( $sql );

$new_id = $db->insert_id ();

echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n";
echo "<plano>\n";
echo "<id>" . $new_id . "</id>\n";
echo "<nome><![CDATA[" . $plano . "]]></nome>\n";
echo "</plano>\n";

?>