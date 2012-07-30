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

$sql = "SELECT idcliente, txtendereco, txtbairro, txtcidade, txtuf, txttelefone, txtcelular, txtemail, txtcpf, txtcep, dtaniversario, txtrg, txtinf_adicional FROM cliente";
$query = $db->query ( $sql );
$total_clientes = $db->num_rows ( $query );
$i = 0;
while ( $rowcliente = $db->fetch_assoc ( $query ) ) {
	$cliente_stats ['txtendereco'] [$i] = $rowcliente ['txtendereco'];
	$cliente_stats ['txtbairro'] [$i] = $rowcliente ['txtbairro'];
	$cliente_stats ['txtcidade'] [$i] = $rowcliente ['txtcidade'];
	$cliente_stats ['txtuf'] [$i] = $rowcliente ['txtuf'];
	$cliente_stats ['txttelefone'] [$i] = $rowcliente ['txttelefone'];
	$cliente_stats ['txtcelular'] [$i] = $rowcliente ['txtcelular'];
	$cliente_stats ['txtemail'] [$i] = $rowcliente ['txtemail'];
	$cliente_stats ['txtcpf'] [$i] = $rowcliente ['txtcpf'];
	$cliente_stats ['txtcep'] [$i] = $rowcliente ['txtcep'];
	$cliente_stats ['dtaniversario'] [$i] = $rowcliente ['dtaniversario'];
	$cliente_stats ['txtrg'] [$i] = $rowcliente ['txtrg'];
	$cliente_stats ['txtinf_adicional'] [$i] = $rowcliente ['txtinf_adicional'];
	$i ++;
}

if ($i > 0) {
	
	$total_semendereco = 0;
	$total_sembairro = 0;
	$total_semcidade = 0;
	$total_semuf = 0;
	$total_semtelefone = 0;
	$total_semcelular = 0;
	$total_sememail = 0;
	$total_semcpf = 0;
	$total_semcep = 0;
	$total_semaniversario = 0;
	$total_semrg = 0;
	$total_seminfoadd = 0;
	
	for($x = 0; $x < $total_clientes; $x ++) {
		if (! $cliente_stats ['txtendereco'] [$x]) {
			++ $total_semendereco;
		}
		if (! $cliente_stats ['txtbairro'] [$x]) {
			++ $total_sembairro;
		}
		if (! $cliente_stats ['txtcidade'] [$x]) {
			++ $total_semcidade;
		}
		if (! $cliente_stats ['txtuf'] [$x]) {
			++ $total_semuf;
		}
		if (! $cliente_stats ['txttelefone'] [$x]) {
			++ $total_semtelefone;
		}
		if (! $cliente_stats ['txtcelular'] [$x]) {
			++ $total_semcelular;
		}
		if (! $cliente_stats ['txtemail'] [$x]) {
			++ $total_sememail;
		}
		if (! $cliente_stats ['txtcpf'] [$x]) {
			++ $total_semcpf;
		}
		if (! $cliente_stats ['txtcep'] [$x]) {
			++ $total_semcep;
		}
		if ($cliente_stats ['dtaniversario'] [$x] == '0000-00-00') {
			++ $total_semaniversario;
		}
		if (! $cliente_stats ['txtrg'] [$x]) {
			++ $total_semrg;
		}
		if (! $cliente_stats ['txtinf_adicional'] [$x]) {
			++ $total_seminfoadd;
		}
	}
	
	$total_semendereco_porcento = number_format ( ($total_semendereco / $total_clientes) * 100, 2 );
	$total_sembairro_porcento = number_format ( ($total_sembairro / $total_clientes) * 100, 2 );
	$total_semcidade_porcento = number_format ( ($total_semcidade / $total_clientes) * 100, 2 );
	$total_semuf_porcento = number_format ( ($total_semuf / $total_clientes) * 100, 2 );
	$total_semtelefone_porcento = number_format ( ($total_semtelefone / $total_clientes) * 100, 2 );
	$total_semcelular_porcento = number_format ( ($total_semcelular / $total_clientes) * 100, 2 );
	$total_sememail_porcento = number_format ( ($total_sememail / $total_clientes) * 100, 2 );
	$total_semaniversario_porcento = number_format ( ($total_semaniversario / $total_clientes) * 100, 2 );
	$total_semcep_porcento = number_format ( ($total_semcep / $total_clientes) * 100, 2 );
	$total_semcpf_porcento = number_format ( ($total_semcpf / $total_clientes) * 100, 2 );
	$total_semrg_porcento = number_format ( ($total_semrg / $total_clientes) * 100, 2 );
	$total_seminfoadd_porcento = number_format ( ($total_seminfoadd / $total_clientes) * 100, 2 );

}

?>

<fieldset id="p"><legend>Estat�sticas</legend>

<div class="linha_separador ls_conf_P">
<table>
	<tr>
		<td><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/relatorio_32.png"
			class="t32"></td>
		<td width="10"></td>
		<td><b>Estat�sticas dos cadastros de clientes</b> <br />
		Procure obter a maior quantidade de dados do cliente</td>
	</tr>
</table>
</div>


<div style="width: 377px;">
<table width="100%" cellpadding="6" cellspacing="6">
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td align="center">
					<?
					if ($i > 0) {
						?>
					<table cellpadding="8" cellspacing="8">
			<tr>
				<td align="right"><b><?=$total_clientes;?></b></td>
				<td width="5"></td>
				<td>clientes cadastrados</td>
			</tr>
						<?
						if ($total_sememail > 0) {
							?>
						<tr>
				<td><b style="color:<?=($total_sememail_porcento < 50) ? 'blue' : 'red';?>"><?=$total_sememail_porcento;?>% ( <?=$total_sememail;?> )</b></td>
				<td width="5"></td>
				<td>sem E-mail</td>
			</tr>
						<?
						} else {
							?>
						<tr>
				<td colspan="3">Todos possuem <b style="color: blue;">E-mail</b></td>
			</tr>
						<?
						}
						?>
						<?
						if ($total_semtelefone > 0) {
							?>
						<tr>
				<td><b style="color:<?=($total_semtelefone_porcento < 50) ? 'blue' : 'red';?>"><?=$total_semtelefone_porcento;?>% ( <?=$total_semtelefone;?> )</b></td>
				<td width="5"></td>
				<td>sem Telefone 1</td>
			</tr>
						<?
						} else {
							?>
						<tr>
				<td colspan="3">Todos possuem <b style="color: blue;">Telefone 1</b></td>
			</tr>
						<?
						}
						?>
						<?
						if ($total_semcelular > 0) {
							?>
						<tr>
				<td><b style="color:<?=($total_semcelular_porcento < 50) ? 'blue' : 'red';?>"><?=$total_semcelular_porcento;?>% ( <?=$total_semcelular;?> )</b></td>
				<td width="5"></td>
				<td>sem Telefone 2</td>
			</tr>
						<?
						} else {
							?>
						<tr>
				<td colspan="3">Todos possuem <b style="color: blue;">Telefone 2</b></td>
			</tr>
						<?
						}
						?>
						<?
						if ($total_semaniversario > 0) {
							?>
						<tr>
				<td><b style="color:<?=($total_semaniversario_porcento < 50) ? 'blue' : 'red';?>"><?=$total_semaniversario_porcento;?>% ( <?=$total_semaniversario;?> )</b></td>
				<td width="5"></td>
				<td>sem Anivers�rio</td>
			</tr>
						<?
						} else {
							?>
						<tr>
				<td colspan="3">Todos possuem <b style="color: blue;">Anivers�rio</b></td>
			</tr>
						<?
						}
						?>
						<?
						if ($total_semendereco > 0) {
							?>
						<tr>
				<td><b style="color:<?=($total_semendereco_porcento < 50) ? 'blue' : 'red';?>"><?=$total_semendereco_porcento;?>% ( <?=$total_semendereco;?> )</b></td>
				<td width="5"></td>
				<td>sem Endere�o</td>
			</tr>
						<?
						} else {
							?>
						<tr>
				<td colspan="3">Todos possuem <b style="color: blue;">Endere�o</b></td>
			</tr>
						<?
						}
						?>
						<?
						if ($total_sembairro > 0) {
							?>
						<tr>
				<td><b style="color:<?=($total_sembairro_porcento < 50) ? 'blue' : 'red';?>"><?=$total_sembairro_porcento;?>% ( <?=$total_sembairro;?> )</b></td>
				<td width="5"></td>
				<td>sem Bairro</td>
			</tr>
						<?
						} else {
							?>
						<tr>
				<td colspan="3">Todos possuem <b style="color: blue;">Bairro</b></td>
			</tr>
						<?
						}
						?>
						<?
						if ($total_semcidade > 0) {
							?>
						<tr>
				<td><b style="color:<?=($total_semcidade_porcento < 50) ? 'blue' : 'red';?>"><?=$total_semcidade_porcento;?>% ( <?=$total_semcidade;?> )</b></td>
				<td width="5"></td>
				<td>sem Cidade</td>
			</tr>
						<?
						} else {
							?>
						<tr>
				<td colspan="3">Todos possuem <b style="color: blue;">Cidade</b></td>
			</tr>
						<?
						}
						?>
						<?
						if ($total_semuf > 0) {
							?>
						<tr>
				<td><b style="color:<?=($total_semuf_porcento < 50) ? 'blue' : 'red';?>"><?=$total_semuf_porcento;?>% ( <?=$total_semuf;?> )</b></td>
				<td width="5"></td>
				<td>sem Estado</td>
			</tr>
						<?
						} else {
							?>
						<tr>
				<td colspan="3">Todos possuem <b style="color: blue;">Estado</b></td>
			</tr>
						<?
						}
						?>
						<?
						if ($total_semcep > 0) {
							?>
						<tr>
				<td><b style="color:<?=($total_semcep_porcento < 50) ? 'blue' : 'red';?>"><?=$total_semcep_porcento;?>% ( <?=$total_semcep;?> )</b></td>
				<td width="5"></td>
				<td>sem CEP</td>
			</tr>
						<?
						} else {
							?>
						<tr>
				<td colspan="3">Todos possuem <b style="color: blue;">CEP</b></td>
			</tr>
						<?
						}
						?>
						<?
						if ($total_semcpf > 0) {
							?>
						<tr>
				<td><b style="color:<?=($total_semcpf_porcento < 50) ? 'blue' : 'red';?>"><?=$total_semcpf_porcento;?>% ( <?=$total_semcpf;?> )</b></td>
				<td width="5"></td>
				<td>sem CPF</td>
			</tr>
						<?
						} else {
							?>
						<tr>
				<td colspan="3">Todos possuem <b style="color: blue;">CPF</b></td>
			</tr>
						<?
						}
						?>
						<?
						if ($total_semrg > 0) {
							?>
						<tr>
				<td><b style="color:<?=($total_semrg_porcento < 50) ? 'blue' : 'red';?>"><?=$total_semrg_porcento;?>% ( <?=$total_semrg;?> )</b></td>
				<td width="5"></td>
				<td>sem Identidade</td>
			</tr>
						<?
						} else {
							?>
						<tr>
				<td colspan="3">Todos possuem <b style="color: blue;">Identidade</b></td>
			</tr>
						<?
						}
						?>
						<?
						if ($total_seminfoadd > 0) {
							?>
						<tr>
				<td><b style="color:<?=($total_seminfoadd_porcento < 50) ? 'blue' : 'red';?>"><?=$total_seminfoadd_porcento;?>% ( <?=$total_seminfoadd;?> )</b></td>
				<td width="5"></td>
				<td>sem Informa��es Adicionais</td>
			</tr>
						<?
						} else {
							?>
						<tr>
				<td colspan="3">Todos possuem <b style="color: blue;">Informa��es
				Adicionais</b></td>
			</tr>
						<?
						}
						?>
					</table>
					<?
					} else {
						?>
					<table cellpadding="6" cellspacing="6">
			<tr>
				<td><b style="color: red">N�o possui nenhum cliente cadastrado</b></td>
			</tr>
		</table>
					<?
					}
					?>
				</td>
	</tr>
</table>
</div>

</fieldset>