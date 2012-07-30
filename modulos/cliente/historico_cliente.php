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

?>

<fieldset id="p"><legend>Hist�rico de Clientes</legend>
	
		<?
		if (isset ( $_GET ['id'] )) {
			$idproduto = $_GET ['id'];
		}
		
		if (! isset ( $_GET ['qtd'] )) {
			$_GET ['qtd'] = '';
		}
		
		$sql = 'SELECT p.txtproduto AS nome, p.idproduto, p.dtcadastro FROM `produto` AS p WHERE p.idproduto=' . $idproduto;
		$query = mysql_query ( $sql );
		
		if ($db->num_rows ( $query )) {
			
			$vendidos = 0;
			$total = 0;
			$rows = $db->fetch_assoc ( $query );
			
			if ($rows ['dtcadastro'] > 1) {
				$datacadastro = gmdate ( 'd/m/Y h:i:s', $rows ['dtcadastro'] );
			} else {
				$datacadastro = '<b style="color:red">n�o consta</b>';
			}
			
			$sql2 = 'SELECT SUM(vr_total) as total, SUM(quant) as vendidos FROM mv_vendas_movimento WHERE estornado=0 AND id_produto = ' . $rows ['idproduto'];
			$query2 = mysql_query ( $sql2 );
			$result = mysql_fetch_assoc ( $query2 );
			
			?>
			<div class="linha_separador" style="height: 25px;">
<table width="100%" height="100%">
	<tr>
						<?
			if (isset ( $_GET ['exibe'] ) && $_GET ['exibe'] == 'btncolecao') {
				?>
						<td><input type="button" class="botao"
			style="cursor: pointer; cursor: hand; width: 200px;"
			value="Ir para estat�sticas das cole��es"
			onClick="javascript:historicocolecao();"></td>
						<?
			} else {
				?>
						<td align="right"><input type="button" class="botao"
			style="cursor: pointer; cursor: hand; width: 180px;"
			value="Ir para dados do produto"
			onClick="javascript:carregar_get('conteudo_direito', 'modulos/produto/produto_mostradados.php?id=<?=$idproduto;?>');"></td>
						<?
			}
			?>
					</tr>
</table>
</div>

<div>
<table cellspacing="0" cellpadding="0" width="380">
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td colspan="2" style="border-top: 2px solid black"></td>
	</tr>
	<tr>
		<td height="20">&nbsp;&nbsp;<b><?=ucwords ( strtolower ( $rows ['nome'] ) )?></b></td>
		<td align=right><b>Clientes que compraram</b>&nbsp;&nbsp;</td>
	</tr>
</table>
			<?
			
			if ($result ['vendidos'] > 0) {
				$sql3 = 'SELECT c.txtnome, c.idcliente , grade.descricao as nome, SUM(mv.quant) AS quant FROM mv_vendas_movimento AS mv LEFT JOIN `cad_produtos_grade` AS grade ON grade.id = mv.id_grade INNER JOIN cliente AS c ON mv.id_cliente=c.idcliente WHERE mv.id_grade > 0 AND mv.id_produto = ' . $rows ['idproduto'] . ' AND mv.estornado=0 GROUP BY c.idcliente';
				$query3 = mysql_query ( $sql3 );
				$i = 0;
				if (mysql_num_rows ( $query3 )) {
					?>
					<table cellspacing="0" cellpadding="0" width="380">
	<tr>
		<td colspan="2" style="border-top: 2px solid black"></td>
	</tr>
	<tr>
		<td colspan="2">
		<div style="overflow: auto; height: 280px; width: 378px">
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
									<?
					$monta_url = '?total=' . mysql_num_rows ( $query3 );
					$cor = '#f0f0f0';
					while ( $rows3 = $db->fetch_assoc ( $query3 ) ) {
						$cor = ($cor == '#add4fb') ? '#f0f0f0' : '#add4fb';
						$monta_url .= '&nome' . $i . '=' . ucwords ( strtolower ( $rows3 ['nome'] ) ) . '&quantidade' . $i . '=' . ( int ) $rows3 ['quant'];
						?>
										<tr>
				<td colspan="4" height="15"></td>
			</tr>
			<tr>
				<td colspan="4" height="20">&nbsp;&nbsp;<a href="#"
					onclick="javascript:carregar_get('conteudo_direito', 'modulos/cliente/cliente_mostradados.php?id=<?=$rows3 ['idcliente'];?>');"><b><?=ucwords ( strtolower ( $rows3 ['txtnome'] ) )?></b></a></td>
			</tr>
			<tr>
				<td colspan="4" style="border-top: 2px solid black"></td>
			</tr>
			<tr bgcolor="<?=$cor;?>">
				<td width="30"></td>
				<td height="20"><?=ucwords ( strtolower ( $rows3 ['nome'] ) )?></td>
				<td width="80" height="25"><?=( int ) $rows3 ['quant'];?></td>
				<td width="10"></td>
			</tr>
			<tr>
				<td colspan="4" style="border-top: 2px solid black"></td>
			</tr>
									<?
						$i ++;
					}
					?>
									</table>
		</div>
		</td>
	</tr>
</table>
		<?
				}
			}
			
			$vendidos = ( int ) $result ['vendidos'];
			$total = $result ['total'];
		
		}
		
		?>	
					
		<?
		if ($total > 0) {
			?>
			<table cellspacing="0" width="380">
	<tr>
		<td height="15"></td>
	</tr>
	<tr>
		<td style="border-top: 2px solid black" colspan=2></td>
	</tr>
	<tr>
		<td><b><?=$vendidos . (($vendidos > 1) ? ' itens vendidos' : ' item vendido');?></b></td>
		<td align="right"><b>Total das vendas : R$ <?=number_format ( $total, 2, ',', '.' );?></b></td>
	</tr>
</table>
		<?
		} else {
			?>
			<table cellspacing="0" width="380">
	<tr>
		<td height="25"></td>
	</tr>
	<tr>
		<td align=center><b style="color: red;">Nenhum item deste produto foi
		vendido</b></td>
	</tr>
</table>
		<?
		}
		?>
	
	</div>

</fieldset>