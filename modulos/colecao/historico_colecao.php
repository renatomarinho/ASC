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

$sql = "SELECT idcolecao, txtnome FROM colecao ORDER BY txtnome ASC";
$query = $db->query ( $sql );
$totalcolecoes = $db->num_rows ( $query );

$monta_url = '?total=' . ( int ) $totalcolecoes;
$i = 0;
while ( $row = $db->fetch_assoc ( $query ) ) {
	$sqlprodcol = "SELECT colecao_idcolecao FROM produto WHERE colecao_idcolecao=" . $row ['idcolecao'] . "";
	$queryprocol = $db->query ( $sqlprodcol );
	$totalprods = $db->num_rows ( $queryprocol );
	$monta_url .= '&id' . $i . '=' . $row ['idcolecao'] . '&nome' . $i . '=' . ucwords ( strtolower ( $row ['txtnome'] ) ) . '&quantidade' . $i . '=' . ( int ) $totalprods;
	$i ++;
}
?>

<fieldset id="p"><legend>Estatísticas das Coleções</legend>

<div class="linha_separador" style="width: 350px;"><b>Gráfico das
coleções que possuem produtos cadastrados</b></div>

<div>

<table>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td>Clique na listagem ou no gráfico abaixo para obter informações
		detalhadas sobre cada uma das coleções</td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td>
				<?
				require $_CONF ['PATH'] . 'modulos/charts/library/open_flash_chart_object.php';
				open_flash_chart_object ( 364, 285, $_CONF ['PATH_VIRTUAL'] . 'modulos/charts/chart-historicocolecao1.php' . $monta_url, false );
				?>
				</td>
	</tr>
	<tr>
		<td align="center"><b style="font-size: 9px; color: #c0c0c0">* Somente
		as coleções com produtos cadastrados constam no gráfico</b></td>
	</tr>
</table>


</div>

</fieldset>