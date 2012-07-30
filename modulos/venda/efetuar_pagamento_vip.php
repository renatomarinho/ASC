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

$dados_cheque = array ();
$dados_credito = array ();

$idcliente = $validations->validNumeric ( $_POST ['cliente'] );
$idlogin = $validations->validNumeric ( $_POST ['usuario'] );
$vr_totalvenda = $validations->validNumeric ( $_POST ['totalvenda'] );

$terminal = $validations->validNumeric ( $_POST ['terminal'] );

if (! isset ( $_SESSION ['turno'] )) {
	$turno = 0;
} else {
	$turno = $_SESSION ['turno'];
}

$sync_timestamp = strtotime ( 'now' );

$estornado = 0;

$diaatual = date ( 'd' );

$sql = "INSERT INTO mv_vendas_vip ( controle, data_venda, id_cliente, cad_login_id, sync_timestamp ) VALUES ( " . $_SESSION ['controlevenda'] . ", '" . date ( 'Y-m-d' ) . "', " . $idcliente . ", " . $idlogin . ", '" . $sync_timestamp . "' )";
$query = $db->query ( $sql );

$venda_vip_id = $db->insert_id ();

$lista_carrinho = $_SESSION ['carrinho_venda'];

$num_lista = 0;
foreach ( $lista_carrinho ['produto_nome'] as $key => $value ) {
	$sql = "SELECT vlcusto FROM produto WHERE idproduto=" . $key . "";
	$query = $db->query ( $sql );
	$row = $db->fetch_array ( $query );
	
	if (isset ( $lista_carrinho ['grade_nome'] [$key] )) {
		$quantidade = array_sum ( $lista_carrinho ['grade_qtd'] [$key] );
		$grade = true;
	} else {
		$quantidade = $lista_carrinho ['produto_quantidadetotal'] [$key];
		
		$sql = "INSERT INTO mv_vendas_vip_movimento (venda_vip_id, produto_idproduto, produto_quantidade, grade_id, sync_timestamp) VALUES ( {$venda_vip_id}, '{$key}', {$quantidade}, '0',{$sync_timestamp} )";
		$query = $db->query ( $sql );
		
		$grade = false;
	}
	
	$sql = "UPDATE estoque SET nquantidade=(nquantidade-" . $quantidade . "), sync_timestamp=" . $sync_timestamp . " WHERE produto_idproduto=" . $key . "";
	$query = $db->query ( $sql );
	
	$sql = "UPDATE produto SET qtdestoque=(qtdestoque-" . $quantidade . "), sync_timestamp=" . $sync_timestamp . " WHERE idproduto=" . $key . "";
	$query = $db->query ( $sql );
	
	if ($grade) {
		foreach ( $lista_carrinho ['grade_nome'] [$key] as $key2 => $value2 ) {
			$quantidade = $lista_carrinho ['grade_qtd'] [$key] [$key2];
			
			$sql = "INSERT INTO mv_vendas_vip_movimento ( venda_vip_id, produto_idproduto, produto_quantidade, grade_id, sync_timestamp ) VALUES ( {$venda_vip_id}, '{$key}', {$quantidade}, '{$key2}',{$sync_timestamp} )";
			$query = $db->query ( $sql );
			
			$sql = "UPDATE cad_produtos_grade SET quantidade=(quantidade-" . $quantidade . "), sync_timestamp=" . $sync_timestamp . " WHERE id_produto=" . $key . " AND id=" . $key2 . "";
			$query = $db->query ( $sql );
		}
	}
}

echo '1';

?>