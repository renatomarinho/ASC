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

/*
 * FIXME Possibilitar a venda de v�rios cart�es de cr�ditos
 */

if (! isset ( $_CONF ['PATH'] )) {
	require "../../config/default.php";
}

$_POST['credit_id'] = 0;
$_POST['debit_id']  = 0;


$validations = new validations ( );
$db = new db ( );
$db->connect ();

$dados_cheque = array ();
$dados_credito = array ();

$idcliente = $validations->validNumeric($_POST['cliente']);
$idlogin = $validations->validNumeric($_POST['usuario']);
$vr_totalvenda = $validations->validNumeric($_POST['totalvenda']);
$vr_opcionalvenda = $validations->validNumeric($_POST['opcvenda']);
$vr_opcionalvenda_final = $validations->validNumeric($_POST['opcvenda_final']);
$parcelas = $validations->validNumeric($_POST['parcelas']);
$vr_dinheiro = $validations->validNumeric($_POST['dinheiro']);

if (! $vr_dinheiro || $vr_dinheiro < 0) {
	$vr_dinheiro = 0;
}

$vr_cheque = $validations->validNumeric($_POST['cheque']);
$vr_credito = $validations->validNumeric($_POST['credito']);
$vr_debito = $validations->validNumeric($_POST['debito']);
$vr_outro = $validations->validNumeric($_POST['outro']);
$terminal = $validations->validNumeric($_POST['terminal']);

$vr_chequetotal = 0;
$vr_creditototal = 0;

if (! isset ( $_SESSION ['turno'] )) {
	$turno = 0;
} else {
	$turno = $_SESSION ['turno'];
}

$credit_id = $validations->validNumeric($_POST['credit_id']);
$debit_id = $validations->validNumeric($_POST['debit_id']);
$sync_timestamp = strtotime('now');

$estornado = 0;

if ($vr_cheque > 0) {
	
	//$total_cheque = number_format(array_sum($dados_cheque['valor'],2));
	

	for($i = 0; $i < $vr_cheque; $i ++) {
		
		$dados_cheque ['valor'] [$i] = $_POST ['chequevalor_' . $i];
		$historico = ($i+1) . '|' . $_POST ['chequevalor_' . $i] . '|' . utf8_decode ( $_POST ['chequebanco_' . $i] ) . '|' . $_POST ['chequenumero_' . $i];
		$vencimento = $_POST ['anocheque_' . $i] . '-' . $_POST ['mescheque_' . $i] . '-' . $_POST ['diacheque_' . $i];
		$sql = "INSERT INTO mv_financeiro ( controle, data_lancamento, data_vencimento, origem_lancamento, tipo_lancamento, parcela, estornado, terminal, turno, vr_pago, vr_parcela, historico, id_cliente, sync_timestamp ) VALUES ( " . $_SESSION ['controlevenda'] . ", '" . date ( 'Y-m-d' ) . "', '" . $vencimento . "', 1, 'E', " . ($i+1) . ", 0, " . $terminal . ", " . $turno . ", '" . $_POST ['chequevalor_' . $i] . "', '" . $_POST ['chequevalor_' . $i] . "', '" . $historico . "', ".$idcliente.", " . $sync_timestamp . " )";
		$query = $db->query ( $sql );
		
		$vr_chequetotal += $_POST ['chequevalor_' . $i];
	
	}
	
	$vr_chequetotal = $vr_chequetotal;

} else {
	$vr_chequetotal = 0;
}

$vcredito = 30;
$diaatual = date ( 'd' );

if ($vr_credito > 0) {
	
	//$total_credito = number_format(array_sum($dados_credito['valor'],2));
	

	for($i = 0; $i < $vr_credito; $i ++) {
		
		$qtd_parcela = $_POST ['qtdparcela_' . $i];
		$dados_credito ['valor'] [$i] = $_POST ['creditovalor_' . $i];
		
		for($u = 0; $u < $qtd_parcela; $u ++) {
			
			$historico = $u . '|' . $_POST ['creditovalor_' . $i] . '|' . ($u + 1) . '|' . $_POST ['cartao_' . $i];
			
			$vencimento = mktime ( 0, 0, 0, date ( 'm' ), ($diaatual + $vcredito), date ( 'Y' ) );
			
			$vencimento = date ( 'Y-m-d', $vencimento );
			$sql = "INSERT INTO mv_financeiro ( controle, data_lancamento, data_vencimento, origem_lancamento, tipo_lancamento, parcelas, estornado, terminal, turno, vr_pago, historico, sync_timestamp ) VALUES ( " . $_SESSION ['controlevenda'] . ", '" . date ( 'Y-m-d' ) . "', '" . $vencimento . "', 1, 'E', " . $i . ", 0, " . $terminal . ", " . $turno . ", '" . $_POST ['creditovalor_' . $i] . "','" . $historico . "', " . $sync_timestamp . " )";
			$query = $db->query ( $sql );
			
			$diaatual += 30;
			$vr_creditototal += $_POST ['creditovalor_' . $i];
		
		}
	
	}
	
	$vr_creditototal = $vr_creditototal;

} else {
	
	$vr_creditototal = 0;

}

$total_temp = ($vr_dinheiro+$vr_chequetotal+$vr_creditototal+$vr_debito+$vr_outro)-$vr_totalvenda;

//if ($total_temp>0){
	$vr_dinheiro = $vr_dinheiro-$total_temp;
//}

$sql = "INSERT INTO mv_vendas ( controle, data_venda, id_cliente, id_login, vr_totalvenda, vr_opcionalvenda, parcelas, vr_dinheiro, vr_cheque, vr_cartao, vr_debito, vr_outro, terminal, turno, credit_id, debit_id, sync_timestamp ) VALUES ( " . $_SESSION ['controlevenda'] . ", '" . date ( 'Y-m-d' ) . "', " . $idcliente . ", " . $idlogin . ", '" . $vr_totalvenda . "', '" . $vr_opcionalvenda . "', " . $parcelas . ", '" . $vr_dinheiro . "', '" . $vr_chequetotal . "', '" . $vr_creditototal . "', '" . $vr_debito . "', '" . $vr_outro . "', '" . $terminal . "', '" . $turno . "', " . $credit_id . ", " . $debit_id . ", " . $sync_timestamp . " )";
$query = $db->query($sql);

$sql = "UPDATE mv_financeiro SET venda_id=".$db->insert_id()." WHERE controle=".$_SESSION ['controlevenda']."";
$query = $db->query ( $sql );

$lista_carrinho = $_SESSION['carrinho_venda'];

$num_lista = 0;

$totalitens = count($lista_carrinho ['produto_nome']);

foreach ( $lista_carrinho['produto_nome'] as $key => $value ) {
	
	$sql = "SELECT vlcusto FROM produto WHERE idproduto=" . $key . "";
	$query = $db->query ( $sql );
	$row = $db->fetch_array ( $query );
	
	$quantidade = $lista_carrinho['produto_quantidadetotal'][$key];
	
	$novo_desconto_no_item = $lista_carrinho['produto_desconto'][$key];
	$novo_valor_total_item = $lista_carrinho['produto_valortotal'][$key];
	
	if ( $vr_opcionalvenda_final != 0 ){
		
		//  dividindo desconto do final da venda pelos itens do carrinho
		//percentual correspondente do item
		$item_perc = (($lista_carrinho['produto_valortotal'][$key] / ($vr_totalvenda + ($vr_opcionalvenda * - 1))) * 100);
		
		//quanto representa do desocntro
		$desconto_por_item = ($vr_opcionalvenda_final*$item_perc) / 100;
		
		$novo_desconto_no_item = $lista_carrinho['produto_desconto'][$key] + (($desconto_por_item>0)?$desconto_por_item:$desconto_por_item);
		$novo_valor_total_item = $lista_carrinho['produto_valortotal'][$key] + (($desconto_por_item>0)?$novo_desconto_no_item:$novo_desconto_no_item);
		//$novo_valor_total_item = ($quantidade * $row['vlcusto']) + $novo_desconto_no_item;
		
	}
	
	
	if (isset($lista_carrinho['grade_nome'][$key])) {
		$quantidade = array_sum($lista_carrinho['grade_qtd'][$key]);
		//if ($grade) {
		
		foreach ( $lista_carrinho ['grade_nome'] [$key] as $key2 => $value2 ) {
			
			$novo_desconto_no_item = ($novo_desconto_no_item/$quantidade)*$lista_carrinho['grade_qtd'][$key][$key2];
			$novo_valor_total_item = ($novo_valor_total_item/$quantidade)*$lista_carrinho['grade_qtd'][$key][$key2];
			
			$quantidade = $lista_carrinho['grade_qtd'][$key][$key2];
			
			if (isset ( $lista_carrinho ['produto_desconto'][$key] )) {
				$quantidade_total = array_sum ( $lista_carrinho ['grade_qtd'] [$key] );
				
				//$novo_desconto_no_item = (($lista_carrinho ['produto_desconto'] [$key] ) * $quantidade) + $vr_opcionalvenda_final;
			} else {
				$novo_desconto_no_item = 0 + $vr_opcionalvenda_final;
			}
			
			$sql = "INSERT INTO mv_vendas_movimento ( controle, data_venda, id_cliente, id_login, id_produto, id_grade, quant, vr_custo, vr_opcional, vr_total, estornado, terminal, turno, sync_timestamp ) VALUES ( " . $_SESSION ['controlevenda'] . ", '" . date ( 'Y-m-d' ) . "', " . $idcliente . ", " . $idlogin . ", " . $key . ", " . $key2 . ", " . $quantidade . ", '" . $row ['vlcusto'] . "', '" . $novo_desconto_no_item . "', '" . $novo_valor_total_item . "', 0, " . $terminal . ", " . $turno . ", " . $sync_timestamp . " )";
			$query = $db->query ( $sql );
			
			$sql = "UPDATE cad_produtos_grade SET quantidade=(quantidade-" . $quantidade . "), sync_timestamp=" . $sync_timestamp . " WHERE id_produto=" . $key . " AND id=" . $key2 . "";
			$query = $db->query ( $sql );
		
		}
	
	//}
		
		
		$grade = true;
	} else {
		$sql = "INSERT INTO mv_vendas_movimento ( controle, data_venda, id_cliente, id_login, id_produto, id_grade, quant, vr_custo, vr_opcional, vr_total, estornado, terminal, turno, sync_timestamp ) VALUES ( " . $_SESSION ['controlevenda'] . ", '" . date ( 'Y-m-d' ) . "', " . $idcliente . ", " . $idlogin . ", " . $key . ", 0, " . $quantidade . ", '" . $row ['vlcusto'] . "', '" . $novo_desconto_no_item . "', '" . $novo_valor_total_item . "', 0, " . $terminal . ", " . $turno . ", " . $sync_timestamp . " )";
		$query = $db->query($sql);
		$grade = false;
	}
	
	$sql = "UPDATE estoque SET nquantidade=(nquantidade-" . $quantidade . "), sync_timestamp=" . $sync_timestamp . " WHERE produto_idproduto=" . $key . "";
	$query = $db->query($sql);
	
	$sql = "UPDATE produto SET qtdestoque=(qtdestoque-" . $quantidade . "), sync_timestamp=" . $sync_timestamp . " WHERE idproduto=" . $key . "";
	$query = $db->query($sql);

}

echo '1';

?>