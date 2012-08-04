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

$i = 0;
?>

<fieldset id="p"><legend>Histórico do Produto</legend>

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
				$datacadastro = '<b style="color:red">não consta</b>';
			}
			
			$sql2 = 'SELECT SUM(vr_total) as total, SUM(quant) as vendidos FROM mv_vendas_movimento WHERE estornado=0 AND id_produto = ' . $rows ['idproduto'];
			$query2 = mysql_query ( $sql2 );
			$result = mysql_fetch_assoc ( $query2 );
			
			?>
			<div class="linha_separador ls_conf_P">
<table width="100%">
	<tr>
					<?
			if (isset ( $_GET ['origem'] ) && $_GET ['origem'] == 'colecao') {
				?>
						<td><input type="button" class="botao"
			style="cursor: pointer; cursor: hand; width: 200px;"
			value="Ir para estatísticas das coleções"
			onClick="javascript:historicocolecao();"></td>
					<?
			} else if (isset ( $_GET ['origem'] ) && $_GET ['origem'] == 'fornecedor') {
				?>
						<td><input type="button" class="botao"
			style="cursor: pointer; cursor: hand; width: 220px;"
			value="Ir para estatísticas dos fornecedores"
			onClick="javascript:historicofornecedor();"></td>
					<?
			} else {
				?>
						<!-- <td align="right"><input type="button" class="botao" style="cursor:pointer; cursor:hand;width:180px;" value="Ir para dados do produto" onClick="javascript:carregar_get('conteudo_direito', 'modulos/produto/produto_mostradados.php?id=<?=$idproduto;?>');"></td> -->
					<?
			}
			?>
					</tr>
</table>
</div>

<div>

<table cellspacing="0" cellpadding="0" width="380">
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td>
		<table cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td width="40"><img
					src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/prodvenda_22.png"
					class="t32"></td>
				<td><b style="font-size: 16px;">&nbsp;&nbsp;<?=ucwords ( strtolower ( $rows ['nome'] ) );?> : vendidos</b></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td class="l1"></td>
	</tr>
</table>

<div id="dados_texto" style="display: none;">
					<?
			if ($result ['vendidos'] > 0) {
				$sql3 = 'SELECT grade.descricao as nome,SUM(mv.quant) as quantidade FROM mv_vendas_movimento AS mv LEFT JOIN `cad_produtos_grade` AS grade ON grade.id = mv.id_grade WHERE mv.id_grade > 0 AND mv.id_produto = ' . $rows ['idproduto'] . ' AND mv.estornado=0 GROUP BY grade.descricao';
				$query3 = mysql_query ( $sql3 );
				$i = 0;
				if (mysql_num_rows ( $query3 )) {
					?>
					<table cellspacing="0" cellpadding="0" width="382">
	<tr>
		<td colspan="2">
		<div style="overflow: auto; height: 229px; width: 378px">
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
										<?
					$monta_url = '?total=' . mysql_num_rows ( $query3 );
					while ( $rows3 = $db->fetch_assoc ( $query3 ) ) {
						$monta_url .= '&nome' . $i . '=' . ucwords ( strtolower ( $rows3 ['nome'] ) ) . '&quantidade' . $i . '=' . ( int ) $rows3 ['quantidade'];
						?>
										<tr onmouseover="rowOver(this)" onmouseout="rowOut(this)">
				<td width="30"></td>
				<td height="25"><?=ucwords ( strtolower ( $rows3 ['nome'] ) )?></td>
				<td width="80" align="right"><?=( int ) $rows3 ['quantidade'];?></td>
				<td width="30"></td>
			</tr>
			<tr>
				<td colspan="4" class="l3"></td>
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
		</div>

<div id="dados_charts">
			<?
			if ($i > 0) {
				?>
			<table>
	<tr>
		<td>
					<?
				require $_CONF ['PATH'] . 'modulos/charts/library/open_flash_chart_object.php';
				open_flash_chart_object ( 375, 225, $_CONF ['PATH_VIRTUAL'] . 'modulos/charts/chart-historicoproduto.php' . $monta_url, false );
				?>
					</td>
	</tr>
</table>
			<?
			}
			?>
		</div>

		<?
		if ($total > 0) {
			?>
		<table cellspacing="0" width="380">
	<tr>
		<td colspan="2" class="l1"></td>
	</tr>
	<tr>
		<td>
		<table>
			<tr>
				<td><b><?=$vendidos . (($vendidos > 1) ? ' itens vendidos' : ' item vendido');?></b></td>
			</tr>
			<tr>
				<td><b>Total : R$ <?=number_format ( $total, 2, ',', '.' );?></b></td>
			</tr>
		</table>
		</td>
		<td align="right">
		<table cellspacing="4">
			<tr>
				<td><input type="button" class="botao btn_texto" id="modografico"
					value="ver modo texto"
					onclick="javascript:produto_exibe_modotexto();"> <input
					type="button" class="botao btn_stats" id="modotexto"
					value="ver modo gráfico" style="display: none;"
					onclick="javascript:produto_exibe_modocharts();"></td>
			</tr>
		</table>
		</td>
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
		<td align=center><b style="color: red;">nenhum produto foi vendido</b></td>
	</tr>
</table>
		<?
		}
		?>
	</div>

</fieldset>