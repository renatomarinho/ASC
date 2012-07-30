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
	
	$sql = "SELECT id, controle, data_venda, id_login, id_produto, vr_custo, quant, vr_total, vr_opcional, id_cliente, estornado, terminal, turno, id_grade FROM mv_vendas_movimento WHERE id=" . $param_divisao [0] . " ";
	$query = $db->query ( $sql );
	$row = $db->fetch_assoc ( $query );
	
	$sqlestoque = "UPDATE estoque SET nquantidade = (nquantidade+" . $param_divisao [1] . ") WHERE produto_idproduto=" . $row ['id_produto'] . "";
	$db->query ( $sqlestoque );
	
	$estoque_produto = $row ['quant'] - $param_divisao [1];
	$vr_total = ($row ['vr_total'] / $row ['quant']) * $param_divisao [1];
	$vr_opcional = (($row ['vr_opcional'] > 0) ? (($row ['vr_opcional'] / $row ['quant']) * $param_divisao [1]) : 0);
	
	$sqlvenda_movimento = "UPDATE mv_vendas_movimento SET estornado=1, vr_total='" . $vr_total . "', vr_opcional='" . $vr_opcional . "', quant=" . $param_divisao [1] . " WHERE id=" . $row ['id'] . "";
	$db->query ( $sqlvenda_movimento );
	
	if ($row ['id_grade'] > 0) {
		$sql_grade = "UPDATE cad_produtos_grade SET quantidade=(quantidade+" . $param_divisao [1] . ") WHERE id=" . $row ['id_grade'] . "";
		$db->query ( $sql_grade );
	}
	
	if ($estoque_produto > 0) {
		
		$vr_total = ($row ['vr_total'] / $row ['quant']) * $estoque_produto;
		$vr_opcional = (($row ['vr_opcional'] > 0) ? (($row ['vr_opcional'] / $row ['quant']) * $estoque_produto) : 0);
		
		$sqlvenda_movimento2 = "INSERT INTO mv_vendas_movimento ( controle, data_venda, id_login, id_produto, vr_custo, quant, vr_total, vr_opcional, id_cliente, estornado, terminal, turno, sync_timestamp, id_grade ) VALUES ( '" . $row ['controle'] . "', '" . $row ['data_venda'] . "', " . $row ['id_login'] . ", " . $row ['id_produto'] . ", '" . $row ['vr_custo'] . "', '" . $estoque_produto . "', '" . $vr_total . "', " . $vr_opcional . ", " . $row ['id_cliente'] . ", 0, '" . $row ['terminal'] . "', '" . $row ['turno'] . "', " . strtotime ( 'now' ) . ", " . $row ['id_grade'] . " )";
		$db->query ( $sqlvenda_movimento2 );
	
	}
	
	$sql_controles = "SELECT SUM(quant) AS quantidade, COUNT(id) AS total FROM mv_vendas_movimento WHERE controle=" . $row ['controle'] . " AND id_produto=" . $row ['id_produto'] . " AND id_grade=" . $row ['id_grade'] . " AND estornado=1";
	$querycontroles = $db->query ( $sql_controles );
	$rowcontroles = $db->fetch_assoc ( $querycontroles );
	
	if ($rowcontroles ['total'] > 1) {
		
		$totalestornados = $rowcontroles ['quantidade'];
		
		$vr_total = ($row ['vr_total'] / $row ['quant']) * $totalestornados;
		$vr_opcional = (($row ['vr_opcional'] > 0) ? (($row ['vr_opcional'] / $row ['quant']) * $totalestornados) : 0);
		
		$sqldel_vendasmovimento = "DELETE FROM mv_vendas_movimento WHERE controle=" . $row ['controle'] . " AND id_produto=" . $row ['id_produto'] . " AND id_grade=" . $row ['id_grade'] . " AND estornado=1";
		$db->query ( $sqldel_vendasmovimento );
		
		$sqlnova_vendamovimento = "INSERT INTO mv_vendas_movimento ( controle, data_venda, id_login, id_produto, vr_custo, quant, vr_total, vr_opcional, id_cliente, estornado, terminal, turno, sync_timestamp, id_grade ) VALUES ( '" . $row ['controle'] . "', '" . $row ['data_venda'] . "', " . $row ['id_login'] . ", " . $row ['id_produto'] . ", '" . $row ['vr_custo'] . "', '" . $totalestornados . "', '" . $vr_total . "', " . $vr_opcional . ", " . $row ['id_cliente'] . ", 1, '" . $row ['terminal'] . "', '" . $row ['turno'] . "', " . strtotime ( 'now' ) . ", " . $row ['id_grade'] . " )";
		$db->query ( $sqlnova_vendamovimento );
	
	}

}
?>