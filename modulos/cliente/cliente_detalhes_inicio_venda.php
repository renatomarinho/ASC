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

if (isset ( $row ['dtcadastro'] )) {
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
?>

<div class="linha_separador" id="listacliente_inicio"
	style="width: 480px; height: 57px;">
<table width="100%" height="100%" cellpadding="0" cellspacing="2">
	<tr>
		<td align="right"><input type="button" class="botao"
			value="buscar outro cliente"
			style="cursor: pointer; cursor: hand; width: 160px;"
			onclick="javascript:carrega_selecionarcliente_primeiro();"></td>
	</tr>
</table>
</div>

<div>
<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td>
		<div id="listacliente"
			style="overflow: auto; height: 265px; width: 502px">

		<table width="100%">
			<tr>
				<td height="5"></td>
			</tr>
			<tr>
				<td height="20">
				<table>
					<tr>
						<td><b>Nome</b></td>
						<td width="5"></td>
						<td><?=ucwords ( strtolower ( $txtnome ) );?></td>
					</tr>
					<tr>
						<td><b>E-mail</b></td>
						<td width="5"></td>
						<td><?
						if ($txtemail) {
							?><?=

							strtolower ( $txtemail );
							?><?
						} else {
							?>N�o informado<?
						}
						?></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td class="l3"></td>
			</tr>
			<tr>
				<td height="20"><b>Dados Gerais</b></td>
			</tr>
			<tr>
				<td class="l3"></td>
			</tr>
			<tr>
				<td>
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td width="40%" valign="top">
						<table>
							<tr>
								<td width="70" height="20"><b>Telefone 1</b></td>
								<td height="20"><?
								if ($dddtel || $tel1 || $tel2) {
									?>( <?=$dddtel;?> ) <?=$tel1;?> - <?=$tel2;?><?} else {?>N�o informado<?
								}
								?></td>
							</tr>
							<tr>
								<td width="70" height="20"><b>Telefone 2</b></td>
								<td height="20"><?
								if ($dddcel || $cel1 || $cel2) {
									?>( <?=$dddcel;?> ) <?=$cel1;?> - <?=$cel2;?><?} else {?>N�o informado<?
								}
								?></td>
							</tr>
							<tr>
								<td width="70" height="20"><b>Anivers�rio</b></td>
								<td height="20"><?
								if ($dia && $mes) {
									?><?=

									$dia;
									?> &nbsp;de&nbsp; <?=$meses [$mes];?><?} else {?>N�o informado<?
								}
								?></td>
							</tr>
							<tr>
								<td width="70" height="20"><b>CPF</b></td>
								<td height="20"><?
								if ($txtcpf) {
									?><?=

									$txtcpf;
									?><?
								} else {
									?>N�o informado<?
								}
								?></td>
							</tr>
							<tr>
								<td width="70" height="20"><b>Identidade</b></td>
								<td height="20"><?
								if ($txtrg) {
									?><?=

									$txtrg;
									?><?
								} else {
									?>N�o informado<?
								}
								?></td>
							</tr>
						</table>
						</td>
						<td width="60%" valign="top">
						<table>
							<tr>
								<td width="70" height="20"><b>Endere&ccedil;o</b></td>
								<td height="20"><?
								if ($txtendereco) {
									?><?=

									ucwords ( strtolower ( $txtendereco ) );
									?><?
								} else {
									?>N�o informado<?
								}
								?></td>
							</tr>
							<tr>
								<td width="70" height="20"><b>Bairro</b></td>
								<td height="20"><?
								if ($txtbairro) {
									?><?=

									ucwords ( strtolower ( $txtbairro ) );
									?><?
								} else {
									?>N�o informado<?
								}
								?></td>
							</tr>
							<tr>
								<td width="70" height="20"><b>Cidade</b></td>
								<td height="20"><?
								if ($txtcidade) {
									?><?=

									ucwords ( strtolower ( $txtcidade ) );
									?><?
								} else {
									?>N�o informada<?
								}
								?></td>
							</tr>
							<tr>
								<td width="70" height="20"><b>Estado</b></td>
								<td height="20"><?
								if ($txtuf) {
									?><?=

									$txtuf;
									?><?
								} else {
									?>N�o informado<?
								}
								?></td>
							</tr>
							<tr>
								<td width="70" height="20"><b>CEP</b></td>
								<td height="20"><?
								if ($txtcep) {
									?><?=

									substr ( $txtcep, 0, 5 );
									?> - <?=substr ( $txtcep, 5, 3 );?><?} else {?>N�o informado<?
								}
								?></td>
							</tr>
						</table>
						</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td class="l3"></td>
			</tr>
			<tr>
				<td height="25"><b>Informa��es adicionais</b></td>
			</tr>
			<tr>
				<td class="l3"></td>
			</tr>
			<tr>
				<td>
				<table width="100%" cellpadding="2">
					<tr>
						<td height="20"><?
						if ($txtinf_adicional) {
							?><?=

							$txtinf_adicional;
							?><?
						} else {
							?>Sem informa��es adicionais<?
						}
						?></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td class="l3"></td>
			</tr>
		</table>
		</div>
		</td>
	</tr>
	<tr>
		<td height="10" class="l3"></td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td align="right" height="25">
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td><input type="button" class="botao green btn_simgreen"
					value="selecionar cliente"
					onclick="javascript:carregar_cliente_inicioselecionadoparavenda('<?=$idcliente;?>', '<?=ucwords ( strtolower ( $txtnome ) );?>');"></td>
				<td align="right"><input type="button" value="iniciar venda"
					style="width: 120px;" class="botao btn_irpara"
					onclick="javascript:fechacancelar();pesquisarproduto_venda();carrega_iniciovenda_escolhaprodutos();"></td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</div>

