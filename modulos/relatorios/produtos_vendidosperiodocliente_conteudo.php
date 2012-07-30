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

N�o criada parte de otimizacao da pagina produtos_vendidosperiodocliente_exibe.php

*/
if (! isset ( $_CONF ['PATH'] )) {
	require "../../config/default.php";
}

$validations = new validations ( );
$db = new db ( );
$db->connect ();

?>

<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="5" style="border-top: 2px solid black"></td>
	</tr>
	<tr>
		<td width="90" height="25" align="center"><b>Data</b></td>
		<td width="120" height="25" align="center"><b>C�d barras</b></td>
		<td height="25"><b>Produto</b></td>
		<td width="140" height="25" align="center"><b>Quantidade</b></td>
		<td width="140" height="25" align="center"><b>Valor R$</b></td>
	</tr>

	<?
	$cor = '#f0f0f0';
	$vendidos = 0;
	$total = 0;
	
	while ( $rowmv = $db->fetch_assoc ( $querymv ) ) {
		
		$sql = "SELECT p.cod_interno, p.txtproduto AS nome, p.idproduto, p.cod_barra FROM produto AS p WHERE p.idproduto=" . $rowmv ['id_produto'] . "";
		$query = $db->query ( $sql );
		
		while ( $rows = $db->fetch_assoc ( $query ) ) {
			$cor = ($cor == '#add4fb') ? '#f0f0f0' : '#add4fb';
			$sql2 = "SELECT SUM(vr_total) as total, SUM(quant) as vendidos FROM mv_vendas_movimento WHERE estornado = 0 AND id_cliente=" . $rowcliente ['idcliente'] . " AND id_produto = " . $rows ['idproduto'];
			$query2 = $db->query ( $sql2 );
			$result = $db->fetch_assoc ( $query2 );
			if ($result ['vendidos'] > 0) {
				$sql3 = "SELECT data_venda FROM mv_vendas_movimento WHERE estornado = 0 AND id_cliente=" . $rowcliente ['idcliente'] . " AND id_produto = " . $rows ['idproduto'];
				$querymv3 = $db->query ( $sql3 );
				$row_mvdata = $db->fetch_assoc ( $querymv3 );
				$explo = explode ( "-", $row_mvdata ['data_venda'] );
				$row_mvdata ['data_venda'] = $explo [2] . '/' . $explo [1] . '/' . $explo [0];
				?>

	<tr bgcolor="<?=$cor;?>" style="cursor: pointer; cursor: hand;" onclick="javascript:carrega_dadosproduto('?refer=listagem&id=<?=$rows ['idproduto'];?>');">

		<td width="90" height="25" align="center"><?=$row_mvdata ['data_venda'];?></td>
		<td width="120" height="25" align="center"><?=$rows ['cod_barra'];?></td>
		<td height="25"><?=(($rows['cod_interno'])?$rows['cod_interno'].' - ':'').ucwords(strtolower($rows['nome']));?></td>
		<td width="140" height="25" align="center"><?=( int ) $result ['vendidos'];?></td>
		<td width="140" height="25" align="center"><?=number_format ( $result ['total'], 2, ',', '.' );?></td>
	</tr>
	<?
				$sql3 = "SELECT grade.descricao as nome,SUM(mv.quant) as quantidade FROM mv_vendas_movimento AS mv LEFT JOIN `cad_produtos_grade` AS grade ON grade.id = mv.id_grade WHERE mv.id_grade > 0 AND mv.id_produto = " . $rows ['idproduto'] . " AND mv.id_cliente=" . $rowcliente ['idcliente'] . " AND mv.estornado=0 GROUP BY grade.descricao";
				$query3 = $db->query ( $sql3 );
				while ( $rows3 = $db->fetch_assoc ( $query3 ) ) {
					?>
	<tr bgcolor="<?=$cor;?>" style="cursor: pointer; cursor: hand;"
		onclick="javascript:carrega_dadosproduto(\'?refer=listagem&id='.$rows['idproduto'].'\');">
		<td width="90"></td>
		<td width="120"></td>
		<td height="25" style="font-size: 9px; color: #666"><?=ucwords ( strtolower ( $rows3 ['nome'] ) );?></td>
		<td width="140" height="20" align="center"
			style="font-size: 9px; color: #666"><?=( int ) $rows3 ['quantidade'];?></td>
		<td width="140" height="20"></td>
	</tr>
	<?
				}
			}
			$vendidos += $result ['vendidos'];
			$total += $result ['total'];
	}
}