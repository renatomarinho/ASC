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

$arquivo = $validations->validStringForm ( $_GET ['a'] );
$hash = $validations->validStringForm ( $_GET ['h'] );
$localizacao = $_CONF ['PATH'] . $validations->validStringForm ( $_GET ['l'] ) . '/';
$salvar = $_CONF ['PATH'] . 'repositorio/';

if (file_exists ( $salvar . $arquivo )) {
	unlink ( $salvar . $arquivo );
}

$arquivo_conteudo = file_get_contents ( $_CONF ['PATH_VIRTUAL_SERVER_CA'] . $arquivo );

if ($hash == sha1 ( $arquivo_conteudo )) {
	
	$arquivo_explo = explode ( '.', $arquivo );
	
	$arquivo_conteudo = decrypt ( $arquivo_conteudo, 'rvs' . $arquivo_explo [1] );
	
	$handle = fopen ( $salvar . $arquivo, 'w+' );
	fwrite ( $handle, $arquivo_conteudo );
	fclose ( $handle );
	
	if (copy ( $salvar . $arquivo, $localizacao . $arquivo_explo [0] . '.php' )) {
		
		$sql = "SELECT timestamp FROM atualizacao WHERE timestamp=" . $arquivo_explo [1] . "";
		$query = $db->query ( $sql );
		
		if (! $db->num_rows ( $query )) {
			
			$sql = "INSERT INTO atualizacao (timestamp) VALUES (" . $arquivo_explo [1] . ")";
			$db->query ( $sql );
		
		}
		
		$status_arquivo = '1';
		
		unlink ( $salvar . $arquivo );
	
	} else {
		
		$status_arquivo = '0';
	
	}

} else {
	
	$status_arquivo = '0';

}

echo $status_arquivo;

//copy($nome_arquivo,$nome_arquivo_novo);
//


?>