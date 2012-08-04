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

$validations = new validations ();
$db = new db ();
$db->connect ();

$dia_inicio = isset ( $_REQUEST ['dia_inicio'] ) ? $_REQUEST ['dia_inicio'] : date ( 'd' );
$mes_inicio = isset ( $_REQUEST ['mes_inicio'] ) ? $_REQUEST ['mes_inicio'] : date ( 'm' );
$ano_inicio = isset ( $_REQUEST ['ano_inicio'] ) ? $_REQUEST ['ano_inicio'] : date ( 'Y' );

$dia_fim = isset ( $_REQUEST ['dia_fim'] ) ? $_REQUEST ['dia_fim'] : date ( 'd' );
$mes_fim = isset ( $_REQUEST ['mes_fim'] ) ? $_REQUEST ['mes_fim'] : date ( 'm' ) + 1;
$ano_fim = isset ( $_REQUEST ['ano_fim'] ) ? $_REQUEST ['ano_fim'] : date ( 'Y' );

$totalperiodo = 0;
$dinheiro = 0;
$debito = 0;

/**
 * Consulta a dados da mesma operação
 */
$sql = "SELECT * FROM (

SELECT controle, data_venda AS data_vencimento, vr_totalvenda AS vr_pago, '' AS historico, 'E' AS tipo_lancamento, '1' AS pagamento_efetuado,
vr_cheque, vr_cartao, vr_debito, vr_dinheiro, v.parcelas, v.id_cartao AS cartao_id, v.credit_id, v.debit_id,

0 AS valor_receita_depesa,
CASE  WHEN v.vr_cartao > 0 THEN '' END AS nome_cartao,

CASE  WHEN v.vr_cartao > 0 THEN '' END AS valor_credito,
CASE  WHEN v.vr_cheque > 0 THEN '' END AS valor_cheque,
CASE  WHEN v.vr_cheque > 0 THEN '' END AS nome_banco,
CASE  WHEN v.vr_cheque > 0 THEN '' END AS numero_cheque,

CASE  WHEN v.vr_debito > 0 THEN v.vr_debito END AS valor_debito,
CASE  WHEN v.vr_dinheiro > 0 THEN vr_dinheiro END AS valor_dinheiro

FROM mv_vendas v WHERE
controle not in (
	SELECT
	f.controle
	FROM mv_financeiro f
	LEFT JOIN mv_vendas v on (v.controle = f.controle)
	LEFT JOIN cad_cartoes c on (c.id = substring_index(f.historico, '|', -1))
	WHERE f.data_vencimento	BETWEEN '{$ano_inicio}-{$mes_inicio}-{$dia_inicio}' AND '{$ano_fim}-{$mes_fim}-{$dia_fim}'
)
AND data_venda 	BETWEEN '{$ano_inicio}-{$mes_inicio}-{$dia_inicio}' AND '{$ano_fim}-{$mes_fim}-{$dia_fim}'
union all
SELECT
f.controle, f.data_vencimento, f.vr_pago, f.historico, f.tipo_lancamento, f.pagamento_efetuado,
v.vr_cheque, v.vr_cartao, v.vr_debito, v.vr_dinheiro, v.parcelas,

CASE WHEN v.id_cartao > 0 THEN v.id_cartao ELSE c.id END AS cartao_id,

CASE  WHEN  (f.numero_documento IS NOT NULL) and (f.numero_documento != '0') THEN f.vr_pago END AS valor_receita_depesa,
CASE  WHEN v.vr_cartao > 0 THEN c.nome END AS nome_cartao,

CASE  WHEN v.vr_cartao > 0 THEN substring_index(substring_index(f.historico, '|', 2), '|', -1) END AS valor_credito,
CASE  WHEN v.vr_cheque > 0 THEN substring_index(substring_index(f.historico, '|', 2), '|', -1) END AS valor_cheque,
CASE  WHEN v.vr_cheque > 0 THEN substring_index(substring_index(f.historico, '|', -2), '|', 1) END AS nome_banco,
CASE  WHEN v.vr_cheque > 0 THEN substring_index(substring_index(f.historico, '|', -2), '|', -1) END AS numero_cheque,

CASE  WHEN v.vr_debito > 0 THEN v.vr_debito END AS valor_debito,
CASE  WHEN v.vr_dinheiro > 0 THEN vr_dinheiro END AS valor_dinheiro

FROM mv_financeiro f
LEFT JOIN mv_vendas v on (v.controle = f.controle)
LEFT JOIN cad_cartoes c on (c.id = substring_index(f.historico, '|', -1))
WHERE
	f.data_vencimento	BETWEEN '{$ano_inicio}-{$mes_inicio}-{$dia_inicio}' AND '{$ano_fim}-{$mes_fim}-{$dia_fim}'
) AS calendario ORDER BY data_vencimento";

$query = $db->query ( $sql );

$grupo_movimento = array ();
$controle = array ();
$total_mes_receita = 0;
$total_mes_despesa = 0;

while ( $row = $db->fetch_assoc ( $query ) ) {
	$descricao = "";
	$valor = "";
	
	$data = explode ( '-', $row ['data_vencimento'] );
	$data = $data [2] . '/' . $data [1] . '/' . $data [0];
	
	$tipo_lancamento = $row ['tipo_lancamento'];
	
	$controle = $row ['controle'];
	
	// cartao de credito
	if ($row ['valor_credito'] > 0) {
		
		// numero de parcelas
		$sql_n_parcelas = "SELECT substring_index(substring_index(historico, '|', 3), '|', -1) AS total_parcelas_cartao FROM mv_financeiro WHERE controle = ".$row ['controle']." ORDER BY id DESC LIMIT 1";
		
		$query_n_parcelas = $db->query ( $sql_n_parcelas );
		$row_n_parcelas = $db->fetch_assoc ( $query_n_parcelas );
		
		if ($row_n_parcelas ['total_parcelas_cartao'] <= 1)
			$tipo_venda = 'vista';
		else
			$tipo_venda = 'parcelada';
			
		// encontrando taxa
		//$sql_taxa = "SELECT * FROM empresas_cartoes WHERE cartao_id = " . $row ['cartao_id'] . " AND tipo_venda = '{$tipo_venda}'";
		
		$sql_taxa = "SELECT nome, tx_credito2 FROM cad_cartoes WHERE id=".$row['credit_id']."";	
			
		$query_taxa = $db->query ( $sql_taxa );
		$row_taxa = $db->fetch_assoc ( $query_taxa );
		
		$descricao = "Cartão de Crédito : " . $row ['nome'];
		
		// calculando valor
		$valor = ($row ['vr_cartao'] - ($row ['vr_cartao'] * ($row_taxa ['tx_credito2'] / 100))) / $row_n_parcelas ['total_parcelas_cartao'];
		
		$total_mes_receita += ($tipo_lancamento == 'E' ? $valor : 0);
		$total_mes_despesa += ($tipo_lancamento == 'S' ? $valor : 0);
		$pagamento_efetuado = $row ['pagamento_efetuado'];
		
		$grupo_movimento [$row ['controle']] [] = array ('data' => $data, 'descricao' => $descricao, 'valor' => number_format ( $valor, 2, ',', '.' ), 'tipo' => $tipo_lancamento, 'efetuado' => $pagamento_efetuado, 'pagamento' => 'credito' );
	}
	
	// cartao de debito
	if ($row ['valor_debito'] > 0) {
		
		$sql_debito = "SELECT nome, tx_debito1 FROM cad_cartoes WHERE id=".$row['debit_id']."";	
		//$sql_debito = "SELECT * FROM empresas_cartoes WHERE cartao_id = " . $row ['cartao_id'] . " AND tipo_venda = 'debito'";
		$query_debito = $db->query ( $sql_debito );
		$row_debito = $db->fetch_assoc ( $query_debito );
		
		$descricao = "Cartão de Débito : " . $row ['nome'];
		$valor = ($row ['valor_debito'] - ($row ['valor_debito'] * ($row_debito ['tx_debito1'] / 100)));
		$total_mes_receita += ($tipo_lancamento == 'E' ? $valor : 0);
		$total_mes_despesa += ($tipo_lancamento == 'S' ? $valor : 0);
		$pagamento_efetuado = 1;
		
		$grupo_movimento [$row ['controle']] [] = array ('data' => $data, 'descricao' => $descricao, 'valor' => number_format ( $valor, 2, ',', '.' ), 'tipo' => $tipo_lancamento, 'efetuado' => $pagamento_efetuado, 'pagamento' => 'debito' );
	}
	
	// Cheques
	if ($row ['valor_cheque'] > 0) {
		$descricao = "Cheque - Número : " . $row ['numero_cheque'] . " Banco: " . $row ['nome_banco'];
		$valor = $row ['valor_cheque'];
		$total_mes_receita += ($tipo_lancamento == 'E' ? $valor : 0);
		$total_mes_despesa += ($tipo_lancamento == 'S' ? $valor : 0);
		$pagamento_efetuado = $row ['pagamento_efetuado'];
		
		$grupo_movimento [$row ['controle']] [] = array ('data' => $data, 'descricao' => $descricao, 'valor' => $valor, 'tipo' => $tipo_lancamento, 'efetuado' => $pagamento_efetuado, 'pagamento' => 'cheque' );
	}
	
	// DINHEIRO
	if ($row ['valor_dinheiro'] > 0) {
		$descricao = "Dinheiro : ";
		$valor = $row ['valor_dinheiro'];
		$total_mes_receita += ($tipo_lancamento == 'E' ? $valor : 0);
		$total_mes_despesa += ($tipo_lancamento == 'S' ? $valor : 0);
		$pagamento_efetuado = 1;
		
		$grupo_movimento [$row ['controle']] [] = array ('data' => $data, 'descricao' => $descricao, 'valor' => $valor, 'tipo' => $tipo_lancamento, 'efetuado' => $pagamento_efetuado, 'pagamento' => 'dinheiro' );
	}
	
	// receita/despesa
	if ($row ['valor_receita_depesa'] > 0) {
		$descricao = "Dinheiro : ";
		$valor = $row ['valor_receita_depesa'];
		$total_mes_receita += ($tipo_lancamento == 'E' ? $valor : 0);
		$total_mes_despesa += ($tipo_lancamento == 'S' ? $valor : 0);
		$pagamento_efetuado = $row ['pagamento_efetuado'];
		
		$grupo_movimento [$row ['controle']] [] = array ('data' => $data, 'descricao' => $descricao, 'valor' => $valor, 'tipo' => $tipo_lancamento, 'efetuado' => $pagamento_efetuado, 'pagamento' => 'null' );
	}
}

?>

<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td><!--		<div id="calendario_movimento" style="overflow:auto;height:207px;display:block;">-->
		<div id="calendario_movimento"
			style="overflow: auto; height: 240px; display: block;">
		<?
		echo '<table width="100%" cellspacing="0" cellpadding="0">';
		
		foreach ( $grupo_movimento as $controle => $movimentos ) {
			foreach ( $movimentos as $value ) {
				echo "<tr>
					<td height=\"25\">
						<div id=\"{$controle}\" class=\"" . ($value ['efetuado'] ? "t_mark item_movimento_hover" : "item_movimento_hover") . ($value ['pagamento'] == 'dinheiro' || $value ['pagamento'] == 'debito' ? " item_movimento_no_hand " : " item_movimento_hand") . "\" style=\"color:" . ($value ['tipo'] == 'E' ? 'green' : 'red') . "\"><b>" . $value ['data'] . "</b> [ " . $value ['descricao'] . " - Valor : " . $value ['valor'] . " ]</div>
					</td>
				</tr>";
			}
			echo '<tr>
					<td class="l3"></td>
				</tr>';
		}
		echo '</table>';
		?>
		</div>
		</td>
	</tr>
	<tr>
		<td class="l3"></td>
	</tr>
	<tr>
		<td height="20"></td>
	</tr>
	<tr>
		<td>
		<table>
			<!--	<tr>
				<td width="120"><b>Dados Per�odo</b></td>
				<td height="25"><b style="color:green;">Receita </b></td>
				<td width="10"></td>
				<td>R$ <?=number_format ( $totalperiodo, 2, ',', '.' );?></td>
				<td width="40"></td>
				<td height="25"><b style="color:red;">Despesa </b></td>
				<td width="10"></td>
				<td></td>
			</tr>
			<tr>
				<td colspan="9" class="l3"></td>
			</tr>-->
			<tr>
				<td width="120"><b>Dados mês</b></td>
				<td height="25"><b style="color: green;">Receita </b></td>
				<td width="10"></td>
				<td>R$ <?=number_format ( $total_mes_receita, 2, ',', '.' );?></td>
				<td width="40"></td>
				<td height="25"><b style="color: red;">Despesa </b></td>
				<td width="10"></td>
				<td>R$ <?=number_format ( $total_mes_despesa, 2, ',', '.' );?></td>
			</tr>
		</table>
		</td>
	</tr>
</table>
<!--
<meta name="nome_fake" content="Fluxo de Caixa">
<meta name="nome_rvs" content="fluxo_calendario.php">
<meta name="localizacao" content="/modulos/financeiro">
<meta name="descricao" content="Correcoes.">
</head>
-->