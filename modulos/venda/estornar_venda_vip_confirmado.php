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

if (isset ( $_GET ['param'] )) {
	$param = $_GET ['param'];
}

$param_produtos = explode ( '|', $param );

for($i = 1; $i < count ( $param_produtos ); $i ++) {
	
	$param_divisao = explode ( '-', $param_produtos [$i] );
	
	$sql = "SELECT
			vip_movimento_id, produto_idproduto, produto_quantidade, estornado, grade_id
			FROM
			mv_vendas_vip_movimento WHERE vip_movimento_id=" . $param_divisao [0] . " ";
	$query = $db->query ( $sql );
	$row = $db->fetch_assoc ( $query );
	
	$sqlestoque = "UPDATE estoque SET nquantidade = (nquantidade+" . $param_divisao [1] . ") WHERE produto_idproduto=" . $row ['produto_idproduto'] . "";
	$db->query ( $sqlestoque );
	
	$estoque_produto = $row ['produto_quantidade'] - $param_divisao [1];
	$sqlvenda_movimento = "UPDATE mv_vendas_vip_movimento SET estornado=1, produto_quantidade=" . $param_divisao [1] . " WHERE vip_movimento_id=" . $row ['vip_movimento_id'] . "";
	$db->query ( $sqlvenda_movimento );
	
	if ($row ['grade_id'] > 0) {
		$sql_grade = "UPDATE cad_produtos_grade SET quantidade=(quantidade+" . $param_divisao [1] . ") WHERE id=" . $row ['grade_id'] . "";
		$db->query ( $sql_grade );
	}
	
	if ($estoque_produto > 0) {
		
		$sqlvenda_movimento2 = "INSERT INTO mv_vendas_vip_movimento ( vip_movimento_id, produto_idproduto, produto_quantidade, estornado, sync_timestamp, grade_id ) VALUES ( '" . $row ['vip_movimento_id'] . "', " . $row ['produto_idproduto'] . ", '" . $estoque_produto . "', 0, " . strtotime ( 'now' ) . ", " . $row ['grade_id'] . " )";
		$db->query ( $sqlvenda_movimento2 );
	
	}
	
	$sql_controles = "SELECT SUM(produto_quantidade) AS quantidade, COUNT(vip_movimento_id) AS total FROM mv_vendas_vip_movimento WHERE vip_movimento_id=" . $row ['vip_movimento_id'] . " AND produto_idproduto=" . $row ['produto_idproduto'] . " AND grade_id=" . $row ['grade_id'] . " AND estornado=1";
	$querycontroles = $db->query ( $sql_controles );
	$rowcontroles = $db->fetch_assoc ( $querycontroles );
	
	if ($rowcontroles ['total'] > 1) {
		
		$totalestornados = $rowcontroles ['quantidade'];
		
		$sqldel_vendasmovimento = "DELETE FROM mv_vendas_vip_movimento WHERE vip_movimento_id=" . $row ['vip_movimento_id'] . " AND produto_idproduto=" . $row ['produto_idproduto'] . " AND grade_id=" . $row ['grade_id'] . " AND estornado=1";
		$db->query ( $sqldel_vendasmovimento );
		
		$sqlnova_vendamovimento = "INSERT INTO mv_vendas_vip_movimento ( vip_movimento_id, produto_idproduto, produto_quantidade, estornado, sync_timestamp, grade_id ) VALUES ( '" . $row ['vip_movimento_id'] . "', " . $row ['produto_idproduto'] . ",'" . $totalestornados . "', 1, " . strtotime ( 'now' ) . ", " . $row ['grade_id'] . " )";
		$db->query ( $sqlnova_vendamovimento );
	
	}

}
?>