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

ob_start ();

if (! isset ( $_CONF ['PATH'] )) {
	require "../../config/default.php";
}

// provis�rio POG!
unset ( $_SESSION ['update_empresa'] );
unset ( $_SESSION ['update_software'] );
unset ( $_SESSION ['update_cliente'] );
unset ( $_SESSION ['update_licenca'] );
unset ( $_SESSION ['update_erro'] );
unset ( $_SESSION ['update_codigo'] );
unset ( $_SESSION ['update_arquivos'] );
unset ( $_SESSION ['update_prioridade'] );
unset ( $_SESSION ['arquivo_nome'] );
unset ( $_SESSION ['arquivo_nomervs'] );
unset ( $_SESSION ['arquivo_localizacao'] );
unset ( $_SESSION ['arquivo_hasharquivo'] );
unset ( $_SESSION ['arquivo_nomefake'] );
unset ( $_SESSION ['arquivo_total'] );

$validations = new validations ( );
$db = new db ( );
$db->connect ();

$arquivos_total = 0;

$sql = "SELECT id, nome_empresa, qtd_terminal, serial_key, sync_timestamp FROM cad_empresa ORDER BY id ASC LIMIT 1";
$query = $db->query ( $sql );
$row = $db->fetch_assoc ( $query );

$urlparams = 'i=' . $row ['id'] . '&s=' . $row ['serial_key'] . '&e=' . str_replace ( ' ', '_', $row ['nome_empresa'] ) . '&t=' . $row ['qtd_terminal'] . '&ts=' . $row ['sync_timestamp'];

$xml_txt = file_get_contents ( $_CONF ['PATH_VIRTUAL_SERVER'] . "/controle_versao/atualizacoes.php?" . $urlparams );

$xml = simplexml_load_string ( $xml_txt, 'SimpleXMLElement', LIBXML_NOCDATA ); //LIBXML_NOCDATA LIBXML_NOWARNING


$empresa = ( string ) $xml->dados ['empresa'];

if ($empresa != '') {
	
	$_SESSION ['update_empresa'] = ( string ) $xml->dados ['empresa'];
	$_SESSION ['update_software'] = ( string ) $xml->dados ['software'];
	$_SESSION ['update_cliente'] = ( string ) $xml->dados ['cliente'];
	$_SESSION ['update_licenca'] = ( string ) $xml->dados ['licenca'];
	$_SESSION ['update_erro'] = '';
	
	$versao_total = count ( $xml->dados->versao );
	$arquivos_total = 0;
	$j = 0;
	//echo '<BR>';
	for($i = 0; $i < $versao_total; $i ++) {
		
		$sql = "SELECT timestamp FROM atualizacao WHERE timestamp>=" . ( int ) $xml->dados->versao [$i] ['codigo'] . "";
		$query = $db->query ( $sql );
		
		if (! $db->num_rows ( $query )) {
			
			$_SESSION ['update_codigo'] [$i] = ( string ) $xml->dados->versao [$i] ['codigo'];
			//echo '<BR>';
			$_SESSION ['update_arquivos'] [$i] = ( string ) $xml->dados->versao [$i] ['arquivos'];
			//echo '<BR>';
			$_SESSION ['update_prioridade'] [$i] = ( string ) $xml->dados->versao [$i] ['prioridade'];
			
			$total_arquivos = ( string ) $xml->dados->versao [$i] ['arquivos'];
			$xml_txt_versao = file_get_contents ( $_CONF ['PATH_VIRTUAL_SERVER'] . "/controle_versao/versoes/codigo.php?c=" . ( int ) $xml->dados->versao [$i] ['codigo'] );
			$xml_versao = simplexml_load_string ( $xml_txt_versao, 'SimpleXMLElement', LIBXML_NOCDATA ); //LIBXML_NOCDATA LIBXML_NOWARNING
			

			$arquivos_total += $total_arquivos;
			
			for($y = 0; $y < $total_arquivos; $y ++) {
				
				$_SESSION ['arquivo_nome'] [$j] = ( string ) $xml_versao->arquivo [$y] ['nome'];
				$_SESSION ['arquivo_nomervs'] [$j] = ( string ) $xml_versao->arquivo [$y] ['nome_rvs'];
				$_SESSION ['arquivo_localizacao'] [$j] = ( string ) $xml_versao->arquivo [$y] ['localizacao'];
				$_SESSION ['arquivo_hasharquivo'] [$j] = ( string ) $xml_versao->arquivo [$y] ['hash_arquivo'];
				$_SESSION ['arquivo_nomefake'] [$j] = ( string ) $xml_versao->arquivo [$y];
				$j ++;
			
			}
		
		}
	}

} else {
	
	$_SESSION ['update_erro'] = ( string ) $xml->dados ['erro'];

}

$_SESSION ['arquivo_total'] = ( int ) $arquivos_total;

?>

