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

if (! isset ( $_GET ['id'] )) {
	$sql = " ORDER BY idcliente DESC";
} else {
	$idcliente = $validations->validNumeric ( $_GET ['id'] );
	$sql = "WHERE idcliente=" . $idcliente;
}

if (isset ( $_GET ['refer'] )) {
	$refer = $_GET ['refer'];
} else {
	$refer = '';
}

$sql = "SELECT idcliente, txtnome, txtendereco, txtcep, txtbairro, txtcidade, txtuf, txttelefone, txtcelular, txtemail, txtcpf, dtaniversario, txtrg, txtinf_adicional, dtcadastro FROM cliente " . $sql;

$query = $db->query ( $sql );

$row = $db->fetch_assoc ( $query );

if (! isset ( $_GET ['id'] )) {
	$idcliente = $row ['idcliente'];
}

$_SESSION ['cliente_escolhido'] ['idcliente'] = $row ['idcliente'];
$_SESSION ['cliente_escolhido'] ['txtnome'] = $row ['txtnome'];
$_SESSION ['cliente_escolhido'] ['txtendereco'] = $row ['txtendereco'];
$_SESSION ['cliente_escolhido'] ['txtcep'] = $row ['txtcep'];
$_SESSION ['cliente_escolhido'] ['txtbairro'] = $row ['txtbairro'];
$_SESSION ['cliente_escolhido'] ['txtcidade'] = $row ['txtcidade'];
$_SESSION ['cliente_escolhido'] ['txtuf'] = $row ['txtuf'];
$_SESSION ['cliente_escolhido'] ['txttelefone'] = $row ['txttelefone'];
$_SESSION ['cliente_escolhido'] ['txtcelular'] = $row ['txtcelular'];
$_SESSION ['cliente_escolhido'] ['txtemail'] = $row ['txtemail'];
$_SESSION ['cliente_escolhido'] ['txtcpf'] = $row ['txtcpf'];
$_SESSION ['cliente_escolhido'] ['dtaniversario'] = $row ['dtaniversario'];
$_SESSION ['cliente_escolhido'] ['txtrg'] = $row ['txtrg'];
$_SESSION ['cliente_escolhido'] ['txtinf_adicional'] = $row ['txtinf_adicional'];
$_SESSION ['cliente_escolhido'] ['dtcadastro'] = $row ['dtcadastro'];

$txtnome = $row ['txtnome'];
$txtendereco = $row ['txtendereco'];

$txtcep = (strlen ( $row ['txtcep'] )) ? str_pad ( str_replace ( '-', '', $row ['txtcep'] ), 8, '0', STR_PAD_LEFT ) : '';
//$txtcep = substr($txtcep,0,5).'-'.substr($txtcep,5,3);


$txtbairro = $row ['txtbairro'];
$txtcidade = $row ['txtcidade'];
$txtuf = $row ['txtuf'];
/*
	$txttelefone = explode('-', $row['txttelefone']);
	$dddtel = $txttelefone[0];
	$tel1 = $txttelefone[1];
	$tel2 = $txttelefone[2];*/
$row ['txttelefone'] = (strlen ( $row ['txttelefone'] )) ? str_pad ( str_replace ( '-', '', $row ['txttelefone'] ), 10, '0', STR_PAD_LEFT ) : '';
$dddtel = substr ( $row ['txttelefone'], 0, 2 );
$tel1 = substr ( $row ['txttelefone'], 2, 4 );
$tel2 = substr ( $row ['txttelefone'], 6, 4 );

/*$txtcelular = explode('-', $row['txtcelular']);
	$dddcel = $txttelefone[0];
	$cel1 = $txttelefone[1];
	$cel2 = $txttelefone[2];*/

$row ['txtcelular'] = (strlen ( $row ['txtcelular'] )) ? str_pad ( str_replace ( '-', '', $row ['txtcelular'] ), 10, '0', STR_PAD_LEFT ) : '';
$dddcel = substr ( $row ['txtcelular'], 0, 2 );
$cel1 = substr ( $row ['txtcelular'], 2, 4 );
$cel2 = substr ( $row ['txtcelular'], 6, 4 );

$txtemail = $row ['txtemail'];

$txtcpf = (strlen ( $row ['txtcpf'] )) ? str_pad ( str_replace ( '-', '', $row ['txtcpf'] ), 11, '0', STR_PAD_LEFT ) : '';
$txtcpf = ($txtcpf == str_pad ( '', 11, '0', STR_PAD_LEFT )) ? '' : $txtcpf;
//$txtcpf = substr($txtcpf,0,3).'.'.substr($txtcpf,3,3).'.'.substr($txtcpf,6,3).'-'.substr($txtcpf,9,2);


$dia = 0;
$mes = 0;

if (strpos ( $row ['dtaniversario'], '/' )) {
	$dtaniversario = explode ( '/', $row ['dtaniversario'] );
	@$dia = $dtaniversario [0];
	@$mes = $dtaniversario [1];
}

if (strpos ( $row ['dtaniversario'], '-' )) {
	$dtaniversario = explode ( '-', $row ['dtaniversario'] );
	@$dia = $dtaniversario [2];
	@$mes = $dtaniversario [1];
}
$dia = (($dia < 10) && (strlen ( $dia ) == 2)) ? substr ( $dia, 1, 1 ) : $dia;
$mes = (($mes < 10) && (strlen ( $mes ) == 2)) ? substr ( $mes, 1, 1 ) : $mes;

$txtrg = (strlen ( $row ['txtrg'] )) ? str_pad ( str_replace ( '-', '', $row ['txtrg'] ), 9, '0', STR_PAD_LEFT ) : '';
$txtrg = ($txtrg == str_pad ( '', 9, '0', STR_PAD_LEFT )) ? '' : $txtrg;
$txtinf_adicional = $row ['txtinf_adicional'];
if ($row ['dtcadastro']) {
	$dtcadastro = explode ( '-', $row ['dtcadastro'] );
	$ddcadastro = $dtcadastro [2];
	$mmcadastro = $dtcadastro [1];
	$yycadastro = $dtcadastro [0];
}

if (! isset ( $txtnome )) {
	$txtnome = '';
}

if (! isset ( $txtendereco )) {
	$txtendereco = '';
}

if (! isset ( $cep1 ) && ! isset ( $cep2 )) {
	$cep1 = '';
	$cep2 = '';
}

if (! isset ( $txtbairro )) {
	$txtbairro = '';
}

if (! isset ( $txtcidade )) {
	$txtcidade = '';
}

if (! isset ( $txtuf )) {
	$txtuf = '';
}

if (! isset ( $dddtel ) && ! isset ( $tel1 ) && ! isset ( $tel2 )) {
	$dddtel = '';
	$tel1 = '';
	$tel2 = '';
}

if (! isset ( $dddcel ) && ! isset ( $cel1 ) && ! isset ( $cel2 )) {
	$dddcel = '';
	$cel1 = '';
	$cel2 = '';
}

if (! isset ( $txtemail )) {
	$txtemail = '';
}

if (! isset ( $txtcpf )) {
	$txtcpf = '';
}

if (! isset ( $dia ) && ! isset ( $mes )) {
	$dia = '';
	$mes = '';
}

if (! isset ( $txtrg )) {
	$txtrg = '';
}

if (! isset ( $txtinf_adicional )) {
	$txtinf_adicional = '';
}

if (! isset ( $ddcadastro ) && ! isset ( $mmcadastro ) && ! isset ( $yycadastro )) {
	$ddcadastro = '';
	$mmcadastro = '';
	$yycadastro = '';
}

$data_venda = Array ();
$total_venda = Array ();
$total_custo = Array ();
$total_quant = Array ();

$sql = "SELECT SUM(vr_total) AS vr_total, SUM(vr_custo) AS valor , SUM(quant) AS quant, data_venda FROM mv_vendas_movimento WHERE id_cliente=" . $idcliente . " GROUP BY controle ORDER BY data_venda DESC";
$query = $db->query ( $sql );

$i = 0;
while ( $rowvenda = $db->fetch_assoc ( $query ) ) {
	$data_venda [$i] = $rowvenda ['data_venda'];
	$total_venda [$i] = $rowvenda ['vr_total'];
	$total_custo [$i] = $rowvenda ['valor'];
	$total_quant [$i] = $rowvenda ['quant'];
	$i ++;
}

if (isset ( $data_venda [0] )) {
	
	$explo = explode ( "-", $data_venda [0] );
	$periodo1 = $explo [2] . '/' . $explo [1] . '/' . $explo [0];
	$explo = explode ( "-", $data_venda [($i - 1)] );
	$periodo2 = $explo [2] . '/' . $explo [1] . '/' . $explo [0];
	
	$total_vezes_comprou = count ( $data_venda );
	$ticket_medio = number_format ( array_sum ( $total_venda ) / count ( $data_venda ), 2, '.', ',' );
	
	$lucro_vendas = (array_sum ( $total_venda ) - array_sum ( $total_custo ));
	$retorno_sobre_investimento = number_format ( (array_sum ( $total_custo ) / $lucro_vendas) * 100, 2 );
	
	$preferencia = '';
	$sql = "SELECT pt.txtnome FROM mv_vendas_movimento AS mvv INNER JOIN produto AS p ON mvv.id_produto=p.idproduto LEFT JOIN produtotipo AS pt ON p.produtotipo_idprodutotipo=pt.idprodutotipo WHERE estornado=0 AND id_cliente=" . $idcliente . " GROUP BY pt.idprodutotipo ORDER BY SUM(mvv.quant) DESC LIMIT 57";
	$querytipo = $db->query ( $sql );

}
?>


<fieldset id="m"><legend>Dados do Cliente</legend>

<div class="linha_separador" style="width: 470px;">
<table width="100%">

	<tr>
		<td align="left"><input type="button" class="botao btn_irpara"
			value="Ir para listagem"
			onclick="carrega_listagemcliente(path+'modulos/cliente/lista.php','conteudo_total');">
		</td>
				<?
				if ($db->num_rows ( $query )) {
					?>
					<td align="right"><input type="button" class="botao btn_aumentar"
			style="width: 195px; display: block;"
			value="abrir dados estrat�gicos" id="cliente_tamanho_mais"
			onclick="javascript:modificar_tamanho('cliente_dadosgerais', 60, 'cliente_estrategicos', 265, 'cliente_tamanho_menos', 'cliente_tamanho_mais');">
		<input type="button" class="botao btn_diminuir"
			style="width: 195px; display: none;"
			value="fechar dados estratagicos" id="cliente_tamanho_menos"
			onclick="javascript:modificar_tamanho('cliente_estrategicos', 0, 'cliente_dadosgerais', 260, 'cliente_tamanho_mais', 'cliente_tamanho_menos');">
		</td>
				<?
				}
				?>
				</tr>
</table>
</div>


<input type="hidden" id="idcliente" value="<?=$idcliente;?>">

<div id="cliente_dadosgerais" style="overflow: hidden;">
<table width="100%">
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td height="20">
		<table width="100%">
			<tr>
				<td width="40"><img
					src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/cliente_escolhido.png"
					class="t32"></td>
				<td><b style="font-size: 16px;"><?=ucwords ( strtolower ( $txtnome ) );?></b>
				<BR>
								<?
								if ($txtemail) {
									?>
								<a href="mailto:<?=strtolower ( $txtemail );?>">[ <?=strtolower ( $txtemail );?> ]</a>
								<?
								} else {
									?>
								<a href="javascript:;">[ sem e-mail ]</a>
								<?
								}
								?>
							</td>
				<td align="right">Cliente desde<BR><?=(isset ( $ddcadastro )) ? $ddcadastro . '/' . $mmcadastro . '/' . $yycadastro : '<b>-</b>';?></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td class="l1"></td>
	</tr>
	<tr>
		<td class="l2-r">
		<table width="100%">
			<tr>
				<td align="left">
								<?
								if ($db->num_rows ( $query )) {
									?>
									<b style="color: blue;">Realizou <?=numero_extenso ( $total_vezes_comprou );?> compra<?=($total_vezes_comprou > 1) ? 's' : '';?>
									<?
									if ($total_vezes_comprou > 1) {
										?>
									<BR>
									No período de <?=$periodo2;?> à <?=$periodo1;?>
									<?
									} else {
										?>
									em <?=$periodo1;?>
									<?
									}
									?></b>
								<?
								}
								?>
							</td>
				<td align="right" width="135"><input type="button"
					class="botao btn_editargreen green" value="editar cliente"
					style="width: 135px;"
					onClick="javascript:carregar_editardadoscliente('<?=$idcliente?>');"></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td class="l1"></td>
	</tr>
	<tr>
		<td>
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td colspan="2" height="10"></td>
			</tr>
			<tr>
				<td width="40%" valign="top">
				<table>
					<tr>
						<td width="70" height="20"><b>Telefone 1</b></td>
						<td height="20"><?=($tel1) ? '( ' . $dddtel . ' ) ' . $tel1 . ' - ' . $tel2 : 'Não informado';?></td>
					</tr>
					<tr>
						<td width="70" height="20"><b>Telefone 2</b></td>
						<td height="20"><?=($dddcel) ? '( ' . $dddcel . ' ) ' . $cel1 . ' - ' . $cel2 : 'Não informado';?></td>
					</tr>
					<tr>
						<td width="70" height="20"><b>Aniversário</b></td>
						<td height="20"><?=($dia) ? $dia . ' de ' . $meses [$mes] : 'Não informado';?></td>
					</tr>
					<tr>
						<td width="70" height="20"><b>CPF</b></td>
						<td height="20"><?=($txtcpf) ? $txtcpf : 'Não informado';?></td>
					</tr>
					<tr>
						<td width="70" height="20"><b>Identidade</b></td>
						<td height="20"><?=($txtrg) ? $txtrg : 'Não informado';?></td>
					</tr>
				</table>
				</td>
				<td width="60%" valign="top">
				<table>
					<tr>
						<td width="70" height="20"><b>Endere&ccedil;o</b></td>
						<td height="20"><?=($txtendereco) ? ucwords ( strtolower ( $txtendereco ) ) : 'Não informado';?></td>
					</tr>
					<tr>
						<td width="70" height="20"><b>Bairro</b></td>
						<td height="20"><?=($txtbairro) ? ucwords ( strtolower ( $txtbairro ) ) : 'Não informado';?></td>
					</tr>
					<tr>
						<td width="70" height="20"><b>Cidade</b></td>
						<td height="20"><?=($txtcidade) ? ucwords ( strtolower ( $txtcidade ) ) : 'Não informado';?></td>
					</tr>
					<tr>
						<td width="70" height="20"><b>Estado</b></td>
						<td height="20"><?=($txtuf) ? strtoupper ( $txtuf ) : 'Não informado';?></td>
					</tr>
					<tr>
						<td width="70" height="20"><b>CEP</b></td>
						<td height="20"><?=($txtcep) ? substr ( $txtcep, 0, 5 ) . ' - ' . substr ( $txtcep, 5, 3 ) : 'Não informado';?></td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td class="l1"></td>
	</tr>
</table>
</div>

<div id="cliente_estrategicos"
	style="overflow: auto; height: 0px; width: 500px;">
<table width="100%" cellpadding="0" cellspacing="0" border="0">
			<?
			if ($txtinf_adicional) {
				?>
			<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td height="25">&nbsp&nbsp<b>Informções adicionais</b></td>
	</tr>
	<tr>
		<td class="l1"></td>
	</tr>
	<tr>
		<td>
		<table width="100%">
			<tr>
				<td height="10"></td>
			</tr>
			<tr>
				<td><?=ucwords ( strtolower ( $txtinf_adicional ) );?></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td class="l1"></td>
	</tr>
			<?
			}
			
			if ($db->num_rows ( $query )) {
				?>
			<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td height="25">&nbsp&nbsp<b>Dados estratégicos</b></td>
	</tr>
	<tr>
		<td class="l1"></td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td height="25"><b style="color: blue;">Realizou <?=numero_extenso ( $total_vezes_comprou );?> compra<?=($total_vezes_comprou > 1) ? 's' : '';?>
				<?
				if ($total_vezes_comprou > 1) {
					?>
				no período de <?=$periodo2;?> à <?=$periodo1;?>
				<?
				} else {
					?>
				em <?=$periodo1;?>
				<?
				}
				?></b></td>
	</tr>
	<tr>
		<td height="25"><b style="color: blue;">Preferência<?=($db->num_rows ( $querytipo ) > 1) ? 's' : '';?> :
				<?
				$i=0;
				while ( $rowtipo = $db->fetch_assoc ( $querytipo ) ) {
					$preferencia .= ucwords ( strtolower ( $rowtipo ['txtnome'] ) ) . ' - ';
					if ($i>=3)break;
					$i++;
				}
				echo substr ( $preferencia, 0, - 2 );
				?></b></td>
	</tr>
	<tr>
		<td height="25"><b style="color: blue;">Ticket médio : R$ <?=$ticket_medio;?></b></td>
	</tr>
	<tr>
		<td class="l1"></td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td height="25">&nbsp&nbsp<b>Compras realizadas</b></td>
	</tr>
	<tr>
		<td class="l1"></td>
	</tr>
	<tr>
		<td>
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<?
				$num_lista = 0;
				$sql = "SELECT DISTINCT mv.controle, cl.nome, mv.vr_totalvenda, mv.vr_dinheiro, mv.vr_cheque, mv.vr_cartao, mv.vr_debito, mv.vr_outro, mv.id_login, mv.data_venda FROM mv_vendas AS mv INNER JOIN cad_login AS cl ON mv.id_login=cl.id WHERE mv.id_cliente=" . $idcliente . " ORDER BY mv.data_venda DESC";
				$query = $db->query ( $sql );
				while ( $rowvendas = $db->fetch_assoc ( $query ) ) {
					$explo = explode ( "-", $rowvendas ['data_venda'] );
					$data = $explo [2] . '/' . $explo [1] . '/' . $explo [0];
					$id_vendedor = $rowvendas ['id_login'];
					$nome_vendedor = $rowvendas ['nome'];
					$vr_total = $rowvendas ['vr_totalvenda'];
					$vr_dinheiro = $rowvendas ['vr_dinheiro'];
					$vr_cheque = $rowvendas ['vr_cheque'];
					$vr_cartao = $rowvendas ['vr_cartao'];
					$vr_debito = $rowvendas ['vr_debito'];
					$vr_outro = $rowvendas ['vr_outro'];
					
					?>
						<tr style="cursor: pointer; cursor: hand;"
				onclick="javascript:var p<?=$num_lista;?>=document.getElementById('produto_<?=$num_lista;?>');p<?=$num_lista;?>.style.display=(p<?=$num_lista;?>.style.display=='none')?'block':'none';">
				<td height="20">&nbsp;&nbsp;Data : <?=$data?></td>
				<td align="right">Vendedor : <?=ucwords ( strtolower ( $rowvendas ['nome'] ) );?> - Total : R$ <?=number_format ( $vr_total, 2, '.', ',' );?>&nbsp;&nbsp;&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2">
				<div id="produto_<?=$num_lista;?>" style="display: none;">
				<table>
										<?
					$sql = "SELECT p.idproduto, p.cod_interno, p.txtproduto, mvv.id_grade, mvv.quant, mvv.estornado FROM mv_vendas_movimento AS mvv INNER JOIN produto AS p ON mvv.id_produto=p.idproduto WHERE mvv.controle=" . $rowvendas ['controle'] . "";
					$queryproduto = $db->query ( $sql );
					while ( $rowprodutos = $db->fetch_assoc ( $queryproduto ) ) {
						
						$sql = "SELECT descricao FROM cad_produtos_grade WHERE id=" . $rowprodutos ['id_grade'] . "";
						$querygrade = $db->query ( $sql );
						$grade = $db->num_rows ( $querygrade );
						?>
										<tr bgcolor="<?=$cor;?>" <?
						if ($grade) {
							?>
						style="cursor: pointer; cursor: hand;"
						onclick="javascript:div_grade_<?=$num_lista;?>=document.getElementById('produto_lista_<?=$num_lista;?>');div_grade_<?=$num_lista;?>.style.display =((div_grade_<?=$num_lista;?>.style.display=='none')?'block':'none');"
						<?
						}
						?>>
						<td width="20" height="20"></td>
						<td <?=($rowprodutos ['estornado'] == 1) ? 'class="estornado"' : '';?>><?=(($rowprodutos['cod_interno'])?$rowprodutos['cod_interno'].' - ':'').ucwords(strtolower($rowprodutos['txtproduto']));?>&nbsp;( <?=(int)$rowprodutos['quant'];?> )</td>
					</tr>
										<?
						
						if ($db->num_rows ( $querygrade )) {
							$rowgrade = $db->fetch_assoc ( $querygrade );
							?>
										<tr bgcolor="<?=$cor;?>">
						<td></td>
						<td>
						<div id="produto_lista_<?=$num_lista;?>" style="display: none;">
						<table>
							<tr>
								<td width="25" height="20"></td>
								<td <?=($rowprodutos ['estornado'] == 1) ? 'class="estornado"' : '';?>><?=ucwords ( strtolower ( $rowgrade ['descricao'] ) );?></td>
							</tr>
						</table>
						</div>
						</td>
					</tr>
										<?
							$num_lista ++;
						}
					}
					?>
										<tr>
						<td></td>
						<td>
						<table>
							<tr>
								<td><b>Forma de pagamento - </b></td>
														<?
					if ($vr_dinheiro != '0.00') {
						?>
														<td>Dinheiro :</td>
								<td>R$ <?=number_format ( $vr_dinheiro, 2, '.', ',' );?></td>
								<td width="5"></td>
														<?
					}
					if ($vr_cheque != '0.00') {
						?>
														<td>Cheque :</td>
								<td>R$ <?=number_format ( $vr_cheque, 2, '.', ',' );?></td>
								<td width="5"></td>
														<?
					}
					if ($vr_cartao != '0.00') {
						?>
														<td>Crédito :</td>
								<td>R$ <?=number_format ( $vr_cartao, 2, '.', ',' );?></td>
								<td width="5"></td>
														<?
					}
					if ($vr_debito != '0.00') {
						?>
														<td>Débito :</td>
								<td>R$ <?=number_format ( $vr_debito, 2, '.', ',' );?></td>
								<td width="5"></td>
														<?
					}
					if ($vr_outro != '0.00') {
						?>
														<td>Débito :</td>
								<td>R$ <?=number_format ( $vr_outro, 2, '.', ',' );?></td>
								<td width="5"></td>
														<?
					}
					?>
													</tr>
						</table>
						</td>
					</tr>
				</table>
				</div>
				</td>
			</tr>
			<tr>
				<td colspan="2" height="5"></td>
			</tr>
			<tr>
				<td colspan="2" class="l3"></td>
			</tr>
						<?
				
				}
				?>
					</table>
		</td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td height="25">&nbsp&nbsp<b>Clientes clones ( baseado no ticket médio
		~15% )</b></td>
	</tr>
	<tr>
		<td class="l1"></td>
	</tr>
	<tr>
		<td>
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<?
				$data_venda_clone = array ();
				$total_venda_clone = array ();
				$total_custo_clone = array ();
				$total_quant_clone = array ();
				
				$sql = "SELECT idcliente, txtnome FROM cliente WHERE idcliente!= " . $idcliente . " ORDER BY txtnome ASC";
				$querycliente = $db->query ( $sql );
				$cor = '#f0f0f0';
				
				while ( $rowcliente = $db->fetch_assoc ( $querycliente ) ) {
					
					$idcliente = $rowcliente ['idcliente'];
					
					$sql = "SELECT SUM(vr_total) AS vr_total, SUM(vr_custo) AS valor , SUM(quant) AS quant, data_venda FROM mv_vendas_movimento WHERE id_cliente=" . $idcliente . " GROUP BY controle ORDER BY data_venda ASC";
					$queryvenda = $db->query ( $sql );
					
					if ($db->num_rows ( $queryvenda )) {
						$j = 0;
						while ( $rowvenda = $db->fetch_assoc ( $queryvenda ) ) {
							$data_venda_clone [$idcliente] [$j] = $rowvenda ['data_venda'];
							$total_venda_clone [$idcliente] [$j] = $rowvenda ['vr_total'];
							$total_custo_clone [$idcliente] [$j] = $rowvenda ['valor'];
							$total_quant_clone [$idcliente] [$j] = $rowvenda ['quant'];
							$j ++;
						}
						
						$total_vezes_comprou_clone = count ( $data_venda_clone [$idcliente] );
						$ticket_medio_clone = (array_sum ( $total_venda_clone [$idcliente] ) / count ( $data_venda_clone [$idcliente] ));
						$ticket_porcentagem = ($ticket_medio_clone / 100) * 10;
						$ticket_medio_clone_menos = $ticket_medio_clone - $ticket_porcentagem;
						$ticket_medio_clone_mais = $ticket_medio_clone + $ticket_porcentagem;
						if (($ticket_medio < $ticket_medio_clone_mais) && ($ticket_medio > $ticket_medio_clone_menos)) {
							?>
						<tr style="cursor: pointer; cursor: hand;"
				onclick="javascript:carrega_cliente_mostradados('<?=$rowcliente ['idcliente'];?>');">
				<td height="25">&nbsp;&nbsp;<?=ucwords ( strtolower ( $rowcliente ['txtnome'] ) );?></td>
				<td width="5"></td>
				<td><?=numero_extenso ( $total_vezes_comprou_clone );?> compra<?=($total_vezes_comprou_clone == 1) ? '' : 's';?></td>
				<td width="5"></td>
				<td>R$ <?=number_format ( $ticket_medio_clone, 2, '.', ',' );?></td>
			</tr>
			<tr>
				<td colspan="5" class="l3"></td>
			</tr>
						<?
						}
					}
				}
				?>
					</table>
		</td>
	</tr>
			<?
			}
			?>
		</table>
</div>

</fieldset>
