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

$diretorio = $_CONF ['PATH'] . 'controle_arquivos';

function encrypt($string, $key) {
	$result = '';
	for($i = 0; $i < strlen ( $string ); $i ++) {
		$char = substr ( $string, $i, 1 );
		$keychar = substr ( $key, ($i % strlen ( $key )) - 1, 1 );
		$char = chr ( ord ( $char ) + ord ( $keychar ) );
		$result .= $char;
	}
	return base64_encode ( $result );
}

function decrypt($string, $key) {
	$result = '';
	$string = base64_decode ( $string );
	
	for($i = 0; $i < strlen ( $string ); $i ++) {
		$char = substr ( $string, $i, 1 );
		$keychar = substr ( $key, ($i % strlen ( $key )) - 1, 1 );
		$char = chr ( ord ( $char ) - ord ( $keychar ) );
		$result .= $char;
	}
	return $result;
}

$id_desenvolvedor = 1;

$db = new db ( );
$db->connect ();

$timestamp = strtotime ( 'now' );

$sql = "INSERT INTO atualizacao (timestamp) VALUES (" . $timestamp . ")";
$db->query ( $sql );
$id_atualizacao = $db->insert_id ();

$arquivo = Array ();
$i = 0;
if ($handle = opendir ( $diretorio )) {
	while ( false !== ($file = readdir ( $handle )) ) {
		if ($file != "." && $file != "..") {
			$file_ext = explode ( '.', $diretorio . '/' . $file );
			if (! is_numeric ( $file_ext [1] ) || (isset ( $file_ext [2] ) && $file_ext [2] != 'rvs')) {
				
				$nome_arquivo_simples = $file;
				
				$file_ext = explode ( '.', $nome_arquivo_simples );
				$nome_arquivo_novo_simples = $file_ext [0] . '.' . $timestamp . '.rvs';
				
				$nome_arquivo = $diretorio . '/' . $nome_arquivo_simples;
				$nome_arquivo_novo = $diretorio . '/' . $nome_arquivo_novo_simples;
				
				$tags = get_meta_tags ( $nome_arquivo );
				$nome_fake = $tags ['nome_fake'];
				$nome_rvs = $tags ['nome_rvs'];
				$localizacao = $tags ['localizacao'];
				$descricao = $tags ['descricao'];
				
				$arquivo_conteudo = file_get_contents ( $nome_arquivo );
				$arquivo_conteudo = encrypt ( $arquivo_conteudo, 'rvs' . $timestamp );
				
				$handle2 = fopen ( $nome_arquivo, 'w+' );
				fwrite ( $handle2, $arquivo_conteudo );
				fclose ( $handle2 );
				
				copy ( $nome_arquivo, $nome_arquivo_novo );
				unlink ( $nome_arquivo );
				
				//$arquivo['nome'][$i] = $nome_arquivo_novo;
				//$arquivo['sha1'][$i] = sha1_file($nome_arquivo_novo);
				

				$sql = "INSERT INTO atualizacao_arquivo ( atualizacao_codigo, desenvolvedor_iddesenvolvedor, nome_fake, nome_arquivo, nome_rvs, localizacao, hash, descricao) VALUES ( " . $id_atualizacao . ", " . $id_desenvolvedor . ", '" . $nome_fake . "', '" . $nome_arquivo_novo_simples . "', '" . $nome_rvs . "', '" . $localizacao . "', '" . sha1_file ( $nome_arquivo_novo ) . "', '" . $descricao . "' )";
				$db->query ( $sql );
				
				$i ++;
			}
		}
	}
	closedir ( $handle );
}

?>
<!--
<meta name="nome_fake" content="Topo da P�gina">
<meta name="nome_rvs" content="header.php">
<meta name="localizacao" content="/include">
<meta name="descricao" content="Mudan�a nos links do menu e espa�amentos">
</head>
-->