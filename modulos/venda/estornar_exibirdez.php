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

$tipo_venda_estorno = $_REQUEST ['tipo_venda_estorno'];

$validations = new validations ( );
$db = new db ( );
$db->connect ();

?>

<?
// modelo venda vip
if ($tipo_venda_estorno == "vip") {
	$sql = "SELECT vip_id, controle FROM mv_vendas_vip ORDER BY controle DESC LIMIT 10";
	$query = $db->query ( $sql );
	?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<?
	while ( $row = $db->fetch_assoc ( $query ) ) {
		
		$controle = $row ['controle'];
		$todos_estornados = 0;
		$sql = "SELECT estornado FROM mv_vendas_vip_movimento WHERE venda_vip_id=" . $row ['vip_id'] . "";
		$querymvv = $db->query ( $sql );
		$quantidade = $db->num_rows ( $querymvv );
		while ( $rowmvv = $db->fetch_assoc ( $querymvv ) ) {
			if ($rowmvv ['estornado'] == 1) {
				$todos_estornados ++;
			}
		}
		
		$datacontrole = timestamp_converte ( $controle, 0 );
		?>
		<tr style="cursor: pointer; cursor: hand;" onmouseover="rowOver(this)"
		onmouseout="rowOut(this)"
		onclick="javascript:document.getElementById('ncontrole').value=<?=$row ['controle'];?>;carrega_estorno_venda_vip();">
		<td height="22" width="10"></td>
		<td <?=($todos_estornados == $quantidade) ? 'style="color:red;"' : ''?>><?=$row ['controle'];?></td>
		<td <?=($todos_estornados == $quantidade) ? 'style="color:red;"' : ''?>><?=$datacontrole;?></td>
		<td align="right"
			<?=($todos_estornados == $quantidade) ? 'style="color:red;"' : ''?>>R$ <?=number_format ( $row ['vr_totalvenda'], 2, ',', '.' );?></td>
		<td width="10"></td>
	</tr>
	<tr>
		<td colspan="5" style="border-bottom: 1px solid #c0c0c0;"></td>
	</tr>
	<?
	}
	?>
</table>
<?
}
?>

<?
// modelo venda normal
if ($tipo_venda_estorno != "vip") {
	$sql = "SELECT controle, vr_totalvenda FROM mv_vendas ORDER BY controle DESC LIMIT 10";
	$query = $db->query ( $sql );
	?>

<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<?
	while ( $row = $db->fetch_assoc ( $query ) ) {
		
		$controle = $row ['controle'];
		$todos_estornados = 0;
		$sql = "SELECT estornado FROM mv_vendas_movimento WHERE controle=" . $row ['controle'] . "";
		$querymvv = $db->query ( $sql );
		$quantidade = $db->num_rows ( $querymvv );
		while ( $rowmvv = $db->fetch_assoc ( $querymvv ) ) {
			if ($rowmvv ['estornado'] == 1) {
				$todos_estornados ++;
			}
		}
		
		$datacontrole = timestamp_converte ( $controle, 0 );
		?>
		<tr style="cursor: pointer; cursor: hand;" onmouseover="rowOver(this)"
		onmouseout="rowOut(this)"
		onclick="javascript:document.getElementById('ncontrole').value=<?=$row ['controle'];?>;carrega_estornocontrolevenda('<?=$row ['controle'];?>');">
		<td height="22" width="10"></td>
		<td <?=($todos_estornados == $quantidade) ? 'style="color:red;"' : ''?>><?=$row ['controle'];?></td>
		<td <?=($todos_estornados == $quantidade) ? 'style="color:red;"' : ''?>><?=$datacontrole;?></td>
		<td align="right"
			<?=($todos_estornados == $quantidade) ? 'style="color:red;"' : ''?>>R$ <?=number_format ( $row ['vr_totalvenda'], 2, ',', '.' );?></td>
		<td width="10"></td>
	</tr>
	<tr>
		<td colspan="5" style="border-bottom: 1px solid #c0c0c0;"></td>
	</tr>
	<?
	}
	?>
</table>
<?
}
?>