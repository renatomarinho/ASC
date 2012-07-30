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
if (! isset ( $_CONF ['PATH'] )) {
	require "../../config/default.php";
}

$validations = new validations ( );
$db = new db ( );
$db->connect ();

$controle = $_REQUEST ['controle'];
$mes = $_REQUEST ['mes'];

$sql = "SELECT
f.id, f.controle, f.numero_documento, f.fornecedor_id, f.plano_id, f.data_vencimento, f.periodicidade, f.vr_pago as valor, f.pagamento_efetuado, f.descricao, f.tipo_lancamento
FROM mv_financeiro f
LEFT JOIN mv_vendas v on (v.controle = f.controle)
LEFT JOIN cartoes c on (c.id = substring_index(f.historico, '|', -1))
WHERE f.controle = {$controle} AND MONTH(f.data_vencimento)={$mes};";

$result = $db->query ( $sql );

$id = 0;

while ( $row = $db->fetch_assoc ( $result ) ) {
	$id = $row ['id'] ? $row ['id'] : "0";
	$numero_documento = $row ['numero_documento'] ? $row ['numero_documento'] : " ";
	$fornecedor_id = $row ['fornecedor_id'] ? $row ['fornecedor_id'] : " ";
	$plano_id = $row ['plano_id'] ? $row ['plano_id'] : " ";
	$data_vencimento = $row ['data_vencimento'] ? $row ['data_vencimento'] : " ";
	
	$data_vencimento_dia = date ( "j", strtotime ( $data_vencimento ) );
	$data_vencimento_mes = date ( "n", strtotime ( $data_vencimento ) );
	$data_vencimento_ano = date ( "Y", strtotime ( $data_vencimento ) );
	
	$periodicidade = $row ['periodicidade'] ? $row ['periodicidade'] : " ";
	$valor = $row ['valor'] ? $row ['valor'] : " ";
	$pagamento_efetuado = $row ['pagamento_efetuado'] != null ? $row ['pagamento_efetuado'] : "1";
	$descricao = $row ['descricao'] ? $row ['descricao'] : " ";
	$tipo_lancamento = $row ['tipo_lancamento'] ? $row ['tipo_lancamento'] : " ";

}

echo $xml = <<<XML
<?xml version="1.0" encoding="ISO-8859-1"?>
<fluxo>
<id>{$id}</id>
<mv_financeiro_id>{$id}</mv_financeiro_id>
<tipo>{$tipo_lancamento}</tipo>
<controle>{$controle}</controle>
<numero_documento>{$numero_documento}</numero_documento>
<fornecedor_id>{$fornecedor_id}</fornecedor_id>
<plano_id>{$plano_id}</plano_id>
<data_vencimento dia="{$data_vencimento_dia}" mes="{$data_vencimento_mes}" ano="{$data_vencimento_ano}">{$data_vencimento}</data_vencimento>
<periodicidade>{$periodicidade}</periodicidade>
<valor>{$valor}</valor>
<pagamento_efetuado>{$pagamento_efetuado}</pagamento_efetuado>
<descricao>{$descricao}</descricao>
</fluxo>
XML;

?>
<!--
<meta name="nome_fake" content="Fluxo de Caixa">
<meta name="nome_rvs" content="fluxo_load_receita_despesa.php">
<meta name="localizacao" content="/modulos/financeiro">
<meta name="descricao" content="Correcoes.">
</head>
-->