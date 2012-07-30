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

$db = new db ( );
$db->connect ();

$validations = new validations ( );

$titulo = 'Abrir Turno';

$sql = "SELECT id, abertura, fechamento, turno FROM mv_caixa ORDER BY id DESC";
$query = $db->query ( $sql );
if (! $db->num_rows ( $query )) {
	$msg = '<b style="color:red">Primeira vez que o turno ser� aberto</b>';
	$vr_anterior = false;
	$st_turno = 'true';
	$turno = 1;
} else {
	$row = $db->fetch_assoc ( $query );
	$ultimo_turno = $row ['turno'];
	$abertura = $row ['abertura'];
	$ultimo_fechamento = $row ['fechamento'];
	if ($ultimo_fechamento == '') {
		$titulo = 'Fechar Turno';
		$msg = '<b style="color:blue;">O ' . $ultimo_turno . '� turno est� aberto, feche para abrir um novo turno</b>';
		$turno = $ultimo_turno;
		$st_turno = 'fechar';
	} else {
		$sql = "SELECT qtd_turnos FROM cad_empresa WHERE id=1";
		$query = $db->query ( $sql );
		$row = $db->fetch_assoc ( $query );
		$qtd_turnos = $row ['qtd_turnos'];
		if ($ultimo_turno == $qtd_turnos) {
			$data_ultimo = timestamp_converte ( $ultimo_fechamento, 1 );
			$data_atual = date ( 'd/m/Y' );
			if ($data_ultimo == $data_atual) {
				$msg = '<b style="color:red;">Foram abertos ' . $qtd_turnos . ' turnos, n�o � poss�vel abrir um novo turno hoje</b>';
				$st_turno = 'false';
			} else {
				$msg = '<b style="color:blue;">Abra o turno para iniciar as vendas</b>';
				$st_turno = 'true';
				$turno = 1;
			}
		} else {
			$turno = $ultimo_turno + 1;
			$msg = '<b style="color:blue;">Abra o turno para iniciar as vendas</b>';
			$st_turno = 'true';
		}
		$vr_anterior = true;
	}
}

?>


<fieldset id="g"><legend><?=$titulo?></legend>

<div class="linha_separador" style="width: 905px;">

<table width="100%" height="100%">
	<tr>
		<td>
		<table>
			<tr>
				<td><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/turno_72.png"
					class="t72"></td>
				<td width="10"></td>
				<td>
								<?=$msg;?>
							</td>
			</tr>
		</table>
		</td>
	</tr>
</table>

</div>

<div>

		<?
		if ($st_turno != 'fechar') {
			?>
	
		<input type="hidden" id="abertura" value="<?=strtotime ( 'now' );?>"> <input
	type="hidden" id="turno" value="<?=$turno;?>"> <input type="hidden"
	id="terminal" value="1">

<table width="370">
	<tr>
		<td height="5"></td>
	</tr>
			<?
			if ($st_turno == 'true') {
				?>
			<tr>
		<td height="25"><b>Dados Gerais do Turno</b></td>
	</tr>
	<tr>
		<td class="l3"></td>
	</tr>
	<tr>
		<td>
		<table width="100%">
			<tr>
				<td height="25">&nbsp;&nbsp;<b>Valor atual no caixa</b></td>
				<td align="right">R$ <input type="text" id="valor_caixa"
					style="text-align: right; width: 60px;"
					onkeydown="javascript:formata_valor('valor_caixa', 13, event)"></td>
			</tr>
			<tr>
				<td height="25">&nbsp;&nbsp;<b>Abertura</b></td>
				<td align="right"><?=date ( 'd/m/Y' )?> �s <?=date ( 'H:i' )?>&nbsp;&nbsp;</td>
			</tr>
			<tr>
				<td height="25">&nbsp;&nbsp;<b>Turno</b></td>
				<td align="right"><?=$turno;?>� turno&nbsp;&nbsp;</td>
			</tr>
			<tr>
				<td height="25">&nbsp;&nbsp;<b>Terminal</b></td>
				<td align="right">�nico&nbsp;&nbsp;</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td class="l3"></td>
	</tr>
	<tr>
		<td>
		<table width="100%">
			<tr>
				<td height="25"><b>Respons�vel pelo turno</b></td>
				<td align="right"><select id="idusuario" style="width: 180px;"
					<?=((isset ( $usuario )) ? 'disabled' : '');?>
					onchange="javascript:var boxconfsenha=document.getElementById('confirmasenha');boxconfsenha.style.display = ((this.value>0)?'block':'none');var pwdusuario = document.getElementById('pwdusuario');pwdusuario.type='text';pwdusuario.value='digite sua senha';document.getElementById('msgautentica').innerHTML='';">
					<option value="0">selecione</option>
									<?
				$sql = "SELECT id, nome FROM cad_login WHERE ativo='ativo'";
				$query = $db->query ( $sql );
				while ( $row = $db->fetch_assoc ( $query ) ) {
					?>
									<option value="<?=$row ['id'];?>"
						<?=((isset ( $usuario ) && $usuario == $row ['id']) ? 'selected' : '');?>><?=ucwords ( strtolower ( $row ['nome'] ) );?></option>
									<?
				}
				?>
								</select></td>
			</tr>
			<tr>
				<td colspan="2">
				<div id="confirmasenha" style="display: none">
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td height="25"><b>Digite sua senha</b></td>
						<td align="right"><input type="text" id="pwdusuario"
							onfocus="javascript:troca_textpwd('pwdusuario');"
							style="color: #c0c0c0; width: 178px;"></td>
					</tr>
					<tr>
						<td colspan="2" class="l3"></td>
					</tr>
					<tr>
						<td height="10"></td>
					</tr>
					<tr>
						<td colspan="2">
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td align="left"><span id="msgautentica"></span></td>
								<td align="right"><input type="button" class="botao"
									value="confirmar"
									style="cursor: pointer; cursor: hand; background-color: green; width: 100px;"
									onclick="javascript:carrega_confirmacaoauthturno();"></td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td height="8"></td>
					</tr>
				</table>
				</div>
				</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td class="l3"></td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td align="right"><input type="button" class="botao"
			id="btnabrirturno" value="abrir agora o <?=$turno;?>� turno"
			style="cursor: pointer; cursor: hand; width: 140px; display: none;"
			onclick="javascript:confirmaabrirturno();"></td>
	</tr>
			<?
			} else {
				?>
			<tr>
		<td><BR>
		Clique no menu <b>Configura��es >> Configura��o Geral</b> para alterar
		a quantidade de turnos e poder efetuar novas vendas hoje</td>
	</tr>
			<?
			}
			?>
		</table>
		
	<?
		} else {
			?>
		
		<input type="hidden" id="fechamento" value="<?=strtotime ( 'now' );?>">

<table width="370">
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td height="25"><b>Dados Gerais do Turno</b></td>
	</tr>
	<tr>
		<td class="l3"></td>
	</tr>
	<tr>
		<td>
		<table width="100%">
			<tr>
				<td height="25">&nbsp;&nbsp;<b>Valor do caixa</b></td>
				<td align="right">R$ <input type="text" id="valor_caixa"
					style="text-align: right; width: 60px;"
					onkeydown="javascript:formata_valor('valor_caixa', 13, event)"></td>
			</tr>
			<tr>
				<td height="25">&nbsp;&nbsp;<b>Fechamento</b></td>
				<td align="right"><?=date ( 'd/m/Y' )?> �s <?=date ( 'H:i' )?>&nbsp;&nbsp;</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td class="l3"></td>
	</tr>
	<tr>
		<td height="25"><b>Valores do Turno</b></td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black;"></td>
	</tr>
			<?
			$sql = "SELECT SUM(mvv.vr_dinheiro) AS dinheiro, SUM(mvv.vr_cheque) AS cheque, SUM(mvv.vr_cartao) AS credito, SUM(mvv.vr_debito) AS debito FROM mv_vendas AS mvv INNER JOIN mv_vendas_movimento AS mvvm ON mvv.controle=mvvm.controle WHERE mvvm.estornado=0 AND mvvm.controle>=" . $abertura . " GROUP BY mvvm.data_venda";
			$query = $db->query ( $sql );
			$rowvendas = $db->fetch_assoc ( $query );
			?>
			<tr>
		<td>
		<table width="100%">
			<tr>
				<td height="25">&nbsp;&nbsp;<b>Dinheiro</b></td>
				<td align="right">R$ <?=number_format ( $rowvendas ['dinheiro'], 2, ',', '.' );?>&nbsp;&nbsp;</td>
			</tr>
			<tr>
				<td height="25">&nbsp;&nbsp;<b>Cheque</b></td>
				<td align="right">R$ <?=number_format ( $rowvendas ['cheque'], 2, ',', '.' );?>&nbsp;&nbsp;</td>
			</tr>
			<tr>
				<td height="25">&nbsp;&nbsp;<b>D�bito</b></td>
				<td align="right">R$ <?=number_format ( $rowvendas ['debito'], 2, ',', '.' );?>&nbsp;&nbsp;</td>
			</tr>
			<tr>
				<td height="25">&nbsp;&nbsp;<b>Cr�dito</b></td>
				<td align="right">R$  <?=number_format ( $rowvendas ['credito'], 2, ',', '.' );?>&nbsp;&nbsp;</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td class="l3"></td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>

	<tr>
		<td align="right"><input type="button" class="botao"
			id="btnfecharturno" value="fechar agora o <?=$turno;?>� turno"
			style="cursor: pointer; cursor: hand; width: 140px;"
			onclick="javascript:confirmafecharturno();"></td>
	</tr>
</table>	
			
	<?
		}
		?>
	
	</div>

</fieldset>



