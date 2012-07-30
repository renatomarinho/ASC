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
$db = new db ( );
$db->connect ();

$fluxo = $_REQUEST ['fluxo'];
$tipo_lancamento = strtoupper ( $_REQUEST ['tipo_lancamento'] );
$numero_documento = $_REQUEST ['numero_documento'];
$favorecido_id = $_REQUEST ['favorecido'];
$plano_id = $_REQUEST ['plano'];

$_vencimento = explode ( "-", $_REQUEST ['vencimento'] );
$vencimento = $_vencimento [2] . "-" . $_vencimento [1] . "-" . $_vencimento [0];

$periodicidade = $_REQUEST ['periodicidade'];

$fluxo_valor = ( float ) $_REQUEST ['fluxo_valor'];

$efetuado = ( int ) $_REQUEST ['efetuado'];

$descricao = $_REQUEST ['descricao'];

$plano = $_REQUEST ['novo_plano'];
$terminal = 1;

$mv_financeiro_id = $_REQUEST ['mv_financeiro_id'];

if ($mv_financeiro_id) {
	echo $sql = "UPDATE mv_financeiro SET
			-- controle = '{$controle}',
			data_lancamento = now(),
			data_vencimento = '{$vencimento}',
			tipo_lancamento = '{$tipo_lancamento}',
			terminal		= '{$terminal}',
			turno			= '0',
			vr_pago			= {$fluxo_valor},
			plano_id		= '{$plano_id}',
			numero_documento= '{$numero_documento}',
			fornecedor_id	= '{$favorecido_id}',
			periodicidade	= '{$periodicidade}',
			pagamento_efetuado	= '{$efetuado}',
			descricao		= '{$descricao}'
	WHERE id={$mv_financeiro_id} ";
	
	$result = $db->query ( $sql );
	
	if ($result) {
		echo ucfirst ( $fluxo ) . " atualizado com sucesso!";
	}
} else {
	$controle = strtotime ( 'now' );
	
	$sql = "INSERT INTO
	mv_financeiro (controle, data_lancamento, data_vencimento, tipo_lancamento, terminal, turno, vr_pago,  plano_id, numero_documento, fornecedor_id, periodicidade, pagamento_efetuado, descricao )
		   VALUES ('{$controle}', now(), '{$vencimento}', '{$tipo_lancamento}', '{$terminal}', '0', {$fluxo_valor}, '{$plano_id}', '{$numero_documento}', '{$favorecido_id}', '{$periodicidade}', '{$efetuado}', '{$descricao}'
	);";
	
	$result = $db->query ( $sql );
	
	if ($result) {
		echo ucfirst ( $fluxo ) . " adicionada com sucesso!";
	}
}

?>
<!--
<meta name="nome_fake" content="Fluxo de Caixa">
<meta name="nome_rvs" content="fluxo_add_receita_despesa.php">
<meta name="localizacao" content="/modulos/financeiro">
<meta name="descricao" content="Correcoes.">
</head>
-->