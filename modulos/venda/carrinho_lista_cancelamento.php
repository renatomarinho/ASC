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

if (isset ( $_GET ['params'] ) || isset ( $_SESSION ['carrinho_venda'] )) {
	
	$lista_carrinho = array ();
	
	if (isset ( $_SESSION ['carrinho_venda'] )) {
		$lista_carrinho = $_SESSION ['carrinho_venda'];
	}
	
	if (isset ( $_GET ['retirar'] )) {
		
		$idproduto_retirar = $_GET ['retirar'];
		unset ( $lista_carrinho ['produto_nome'] [$idproduto_retirar] );
		unset ( $lista_carrinho ['produto_desconto'] [$idproduto_retirar] );
		unset ( $lista_carrinho ['produto_valortotal'] [$idproduto_retirar] );
		unset ( $lista_carrinho ['produto_quantidadetotal'] [$idproduto_retirar] );
		unset ( $lista_carrinho ['grade_nome'] [$idproduto_retirar] );
		unset ( $lista_carrinho ['grade_qtd'] [$idproduto_retirar] );
		unset ( $lista_carrinho ['grade_valor'] [$idproduto_retirar] );
	
	} else if (isset ( $_GET ['params'] )) {
		
		$desmonta_params = explode ( '|', $_GET ['params'] );
		$quantidade = $desmonta_params [0];
		$opc = $desmonta_params [1];
		$valortotal = $desmonta_params [2];
		$idproduto = $desmonta_params [3];
		
		$sql = "SELECT txtproduto FROM produto WHERE idproduto=" . $idproduto . "";
		$queryproduto = $db->query ( $sql );
		$rowproduto = $db->fetch_assoc ( $queryproduto );
		$lista_carrinho ['produto_nome'] [$idproduto] = ucwords ( strtolower ( $rowproduto ['txtproduto'] ) );
		$lista_carrinho ['produto_desconto'] [$idproduto] = $opc;
		if (isset ( $lista_carrinho ['produto_nome'] [$idproduto] )) {
			$lista_carrinho ['produto_valortotal'] [$idproduto] = $lista_carrinho ['produto_valortotal'] [$idproduto] + $valortotal;
		} else {
			$lista_carrinho ['produto_valortotal'] [$idproduto] = $valortotal;
		}
		$desmonta_grade = explode ( '�', $desmonta_params [4] );
		$totalprods_grade = count ( $desmonta_grade );
		
		for($i = 0; $i < $totalprods_grade; $i ++) {
			
			$desmonta_gradeproduto = explode ( '*', $desmonta_grade [$i] );
			if (isset ( $desmonta_gradeproduto [0] ) && $desmonta_gradeproduto [0] > 0) {
				$sql = "SELECT id, descricao FROM cad_produtos_grade WHERE id=" . $desmonta_gradeproduto [0] . "";
				$querygradeproduto = $db->query ( $sql );
				if ($db->num_rows ( $querygradeproduto )) {
					$rowgradeproduto = $db->fetch_assoc ( $querygradeproduto );
					$lista_carrinho ['grade_nome'] [$idproduto] [$rowgradeproduto ['id']] = ucwords ( strtolower ( $rowgradeproduto ['descricao'] ) );
					if (isset ( $lista_carrinho ['grade_qtd'] [$idproduto] [$rowgradeproduto ['id']] )) {
						$lista_carrinho ['grade_qtd'] [$idproduto] [$rowgradeproduto ['id']] = $lista_carrinho ['grade_qtd'] [$idproduto] [$rowgradeproduto ['id']] + $desmonta_gradeproduto [1];
					} else {
						$lista_carrinho ['grade_qtd'] [$idproduto] [$rowgradeproduto ['id']] = $desmonta_gradeproduto [1];
					}
					$lista_carrinho ['grade_valor'] [$idproduto] [$rowgradeproduto ['id']] = $desmonta_gradeproduto [2];
				}
			} else {
				$lista_carrinho ['produto_quantidadetotal'] [$idproduto] = $lista_carrinho ['produto_quantidadetotal'] [$idproduto] + $quantidade;
			}
		}
	
	}
	
	array_reverse ( $lista_carrinho ['produto_nome'] );
	?>
<table width="100%">
		<?
	$cor = 'F0F0F0';
	$num_lista = 0;
	foreach ( $lista_carrinho ['produto_nome'] as $key => $value ) {
		$cor = (($cor == 'F0F0F0') ? 'FFFFFF' : 'F0F0F0');
		
		if (isset ( $lista_carrinho ['grade_nome'] [$key] ) && is_array ( $lista_carrinho ['grade_nome'] [$key] )) {
			$quantidade_total = array_sum ( $lista_carrinho ['grade_qtd'] [$key] );
			$grade = true;
		} else {
			$quantidade_total = $lista_carrinho ['produto_quantidadetotal'] [$key];
			$grade = false;
		}
		?>
		<tr bgcolor="#<?=$cor;?>">
		<td>
		<table width="100%">
			<tr <?
		if ($grade) {
			?> style="cursor: pointer; cursor: hand;"
				onclick="javascript:div_grade_<?=$num_lista;?>=document.getElementById('produto_lista_<?=$num_lista;?>');div_grade_<?=$num_lista;?>.style.display =((div_grade_<?=$num_lista;?>.style.display=='none')?'block':'none');"
				<?
		}
		?>>
				<td height="20"><b><?=$lista_carrinho ['produto_nome'] [$key];?></b></td>
				<td width="60" align="center"><b><?=$quantidade_total . ' ite' . (($quantidade_total > 1) ? 'ns' : 'm');?></b></td>
				<td width="60" align="right"><b><?=(($lista_carrinho ['produto_desconto'] [$key] != 0) ? (($lista_carrinho ['produto_desconto'] [$key] > 0) ? 'Acr�s. R$ ' . $lista_carrinho ['produto_desconto'] [$key] : 'Desc. R$ ' . $lista_carrinho ['produto_desconto'] [$key]) : '');?></b></td>
				<td width="80" align="right"><b>R$ <?=number_format ( $lista_carrinho ['produto_valortotal'] [$key], 2 );?></b></td>
			</tr>
					<?
		if (isset ( $lista_carrinho ['grade_nome'] [$key] ) && is_array ( $lista_carrinho ['grade_nome'] [$key] ) && $grade) {
			?>
					<tr>
				<td colspan="4">
				<div id="produto_lista_<?=$num_lista;?>" style="display: none;">
				<table cellpadding="0" cellspacing="0">
									<?
			foreach ( $lista_carrinho ['grade_nome'] [$key] as $key2 => $value2 ) {
				?>
									<tr>
						<td height="20" width="35"></td>
						<td align="left"><?=$lista_carrinho ['grade_nome'] [$key] [$key2];?></td>
						<td width="15"></td>
						<td align="center"><?=$lista_carrinho ['grade_qtd'] [$key] [$key2] . ' ite' . (($lista_carrinho ['grade_qtd'] [$key] [$key2] > 1) ? 'ns' : 'm');?></td>
						<td width="15"></td>
						<td align="left">Valor item R$ <?=number_format ( $lista_carrinho ['grade_valor'] [$key] [$key2], 2 );?></td>
					</tr>
									<?
			}
			?>
								</table>
				</div>
				</td>
			</tr>
					<?
		} else {
			?>
					<tr>
				<td colspan="4">
				<div id="produto_lista_<?=$num_lista;?>" style="display: none;">
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td height="20" width="35"></td>
						<td align="left">Valor item R$</td>
					</tr>
				</table>
				</div>
				</td>
			</tr>
					<?
		}
		?>
				</table>
		</td>
	</tr>
		<?
		$num_lista ++;
	}
	
	$_SESSION ['carrinho_venda'] = $lista_carrinho;
	?>
	</table>
<?
}

?>