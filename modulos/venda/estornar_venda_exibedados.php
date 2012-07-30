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

$controle = $validations->validNumeric ( $_GET ['c'] );

$sql = "SELECT l.nome AS vendedor, c.txtnome AS txtnomecliente, mvm.estornado AS estorno, SUM(mvm.quant) AS quantidade, SUM(mvm.vr_total) as valortotal, mvv.vr_totalvenda FROM mv_vendas_movimento AS mvm JOIN mv_vendas AS mvv ON (mvm.controle = mvv.controle)  LEFT JOIN cliente AS c ON mvm.id_cliente=c.idcliente LEFT JOIN cad_login AS l ON mvm.id_login=l.id WHERE mvm.controle='" . $controle . "' GROUP BY mvm.controle";

$query = $db->query ( $sql );

if ($db->num_rows ( $query )) {
	
	$row = $db->fetch_assoc ( $query );
	
	$datacontrole = timestamp_converte ( $controle, 0 );
	
	$confere_diferenca = dateDiff ( date ( 'd-m-Y', $controle ), date ( 'd-m-Y' ) );
	
	$estornados = 0;
	$quantidade_produtos = ( int ) $row ['quantidade'];
	
	$sql = "SELECT SUM(mv_vendas.vr_totalvenda), SUM(quant) AS quantidade, SUM(vr_total) as valortotal FROM mv_vendas_movimento JOIN mv_vendas on (mv_vendas.controle = mv_vendas_movimento.controle) WHERE mv_vendas_movimento.controle='" . $controle . "' AND estornado=1 ";
	$queryestornos = $db->query ( $sql );
	$rowestornos = $db->fetch_assoc ( $queryestornos );
	$quantidade_produtos_estorno = ($rowestornos ['quantidade']) ? ( int ) $rowestornos ['quantidade'] : 0;
	;
	$valor_estornos = ($rowestornos ['valortotal']) ? $rowestornos ['valortotal'] : 0;
	
	?>

<table>
	<?
	if ($quantidade_produtos <= $quantidade_produtos_estorno) {
		$color = "style='color:red;'";
		?>
	<tr>
		<td width="5"></td>
		<td height="25" colspan="3"><b style="color: red;"><u>Todos os itens
		da venda foram estornados</u></b></td>
	</tr>
	<?
	} else if ($quantidade_produtos >= $quantidade_produtos_estorno && $quantidade_produtos_estorno > 0) {
		$color = "style='color:red;'";
		?>
	<tr>
		<td width="5"></td>
		<td height="25" colspan="3"><b style="color: red;"><u><?=ucwords ( numero_extenso ( $quantidade_produtos_estorno, 1 ) );?> ite<?=($quantidade_produtos_estorno > 1) ? 'ns' : 'm';?> fo<?=($quantidade_produtos_estorno > 1) ? 'ram' : 'i';?>  estornado<?=($quantidade_produtos_estorno > 1) ? 's' : '';?></u></b></td>
	</tr>
	<?
	} else {
		$color = '';
	}
	?>
	<tr>
		<td width="5"></td>
		<td><b>Data</b></td>
		<td height="25" width="10"></td>
		<td><?=$datacontrole;?></td>
	</tr>
	<tr>
		<td width="5"></td>
		<td><b>Cliente</b></td>
		<td height="25" width="10"></td>
		<td><?=($row ['txtnomecliente']) ? ucwords ( strtolower ( $row ['txtnomecliente'] ) ) : 'N�o informado';?></td>
	</tr>
	<tr>
		<td width="5"></td>
		<td><b>Vendedor</b></td>
		<td height="25" width="10"></td>
		<td><?=($row ['vendedor']) ? ucwords ( strtolower ( $row ['vendedor'] ) ) : 'N�o informado';?></td>
	</tr>
	<?
	if (isset ( $row ['vr_totalvenda'] )) {
		?>
	<tr>
		<td width="5"></td>
		<td><b>Total da venda</b></td>
		<td height="25" width="10"></td>
		<td>R$ <?=number_format ( $row ['vr_totalvenda'], 2, ',', '.' );?></td>
	</tr>
	<?
	}
	?>
	<?
	if ($valor_estornos > 0) {
		?>
	<tr>
		<td width="5"></td>
		<td><b>Total do<?=($quantidade_produtos_estorno > 1) ? 's' : '';?> estorno<?=($quantidade_produtos_estorno > 1) ? 's' : '';?></b></td>
		<td height="25" width="10"></td>
		<td <?=$color;?>>R$ <?=number_format ( $valor_estornos, 2, ',', '.' );?></td>
	</tr>
	<?
	}
	?>
	<?
	if (isset ( $row ['valortotal'] ) && $valor_estornos > 0) {
		?>
	<tr>
		<td width="5"></td>
		<td><b>Total da venda caixa</b></td>
		<td height="25" width="10"></td>
		<td <?=$color;?>>R$ <?=number_format ( ($row ['valortotal'] - $valor_estornos), 2, ',', '.' );?></td>
	</tr>
	<?
	}
	?>
</table>

<?
} else {
	
	echo exibe_errohtml ( 'Nenhuma venda encontrada para o controle digitado' );

}
?>