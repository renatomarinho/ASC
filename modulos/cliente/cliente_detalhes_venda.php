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


<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td height="30" align="center"><span id="mensagem"></span></td>
	</tr>
	<tr>
		<td bgcolor="#6aa9e9" height="25">
		<table width="100%">
			<tr>
				<td width="5"></td>
				<td><b style="color: white;">Detalhes do cliente</b></td>
				<td align="right"><input type="button" value="fechar" class="botao"
					style="cursor: pointer; cursor: hand; width: 70px; background-color: red; color: white;"
					onclick="javascript:carrega_selecionaclientevenda_fechar();"></td>
				<td width="5"></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td align="center">

		<table width="100%">
			<tr>
				<td width="50%" valign="top">
				<table>
					<tr>
						<td height="25">Nome</td>
						<td width="5"></td>
						<td><b><?=ucwords ( strtolower ( $txtnome ) );?></b></td>
					</tr>
							<?
							if ($dddtel || $tel1 || $tel2) {
								?>
							<tr>
						<td height="25">Telefone 1</td>
						<td></td>
						<td><b>( <?=$dddtel;?> ) <?=$tel1;?> - <?=$tel2;?></b></td>
					</tr>
							<?
							}
							?>
							<?
							if ($txtemail) {
								?>
							<tr>
						<td height="25">E-mail</td>
						<td></td>
						<td><b><?=strtolower ( $txtemail );?></b></td>
					</tr>
							<?
							}
							?>
							<?
							if ($txtrg) {
								?>
							<tr>
						<td height="25">Identidade</td>
						<td></td>
						<td><b><?=$txtrg;?></b></td>
					</tr>
							<?
							}
							?>
							<?
							if ($txtinf_adicional) {
								?>
							<tr>
						<td height="25">Adicionais</td>
						<td></td>
						<td><b><?=$txtinf_adicional;?></b></td>
					</tr>
							<?
							}
							?>
						</table>
				</td>
				<td width="20"></td>
				<td width="50%" valign="top">
				<table>
							<?
							if ($dia && $mes) {
								?>
							<tr>
						<td width="60" height="25">Aniversário</td>
						<td width="5"></td>
						<td><b><?=$dia;?> &nbsp;de&nbsp; <?=$meses [$mes];?></b></td>
					</tr>
							<?
							}
							?>
							<?
							if ($dddcel || $cel1 || $cel2) {
								?>
							<tr>
						<td height="25">Telefone 2</td>
						<td></td>
						<td><b>( <?=$dddcel;?> ) <?=$cel1;?> - <?=$cel2;?></b></td>
					</tr>
							<?
							}
							?>
							<?
							if ($txtcpf) {
								?>
							<tr>
						<td height="25">CPF</td>
						<td></td>
						<td><b><?=$txtcpf;?></b></td>
					</tr>
							<?
							}
							?>
							<?
							if ($txtcep) {
								?>
							<tr>
						<td height="25">CEP</td>
						<td></td>
						<td><b><?=substr ( $txtcep, 0, 5 );?> - <?=substr ( $txtcep, 5, 3 );?></b> <!--<a href="javascript:;" onclick="javascript:carrega_CEP();">Buscar</button>-->
						</td>
					</tr>
							<?
							}
							?>
							<?
							if ($txtendereco) {
								?>
							<tr>
						<td width="60" height="25">Endere&ccedil;o</td>
						<td></td>
						<td align="left"><b><?=ucwords ( strtolower ( $txtendereco ) );?></b></td>
					</tr>
							<?
							}
							?>
							<?
							if ($txtbairro) {
								?>
							<tr>
						<td height="25">Bairro</td>
						<td></td>
						<td><b><?=ucwords ( strtolower ( $txtbairro ) );?></b></td>
					</tr>
							<?
							}
							?>
							<?
							if ($txtcidade) {
								?>
							<tr>
						<td height="25">Cidade</td>
						<td></td>
						<td><b><?=ucwords ( strtolower ( $txtcidade ) );?></b></td>
					</tr>
							<?
							}
							?>
							<?
							if ($txtuf) {
								?>
							<tr>
						<td height="25">Estado</td>
						<td></td>
						<td><b><?=$txtuf;?></b></td>
					</tr>
							<?
							}
							?>
						</table>
				</td>
			</tr>
			<tr>
				<td colspan="3" align="right"><input type="button"
					class="botao green btn_simgreen" value="selecionar cliente"
					onclick="javascript:carregar_clienteselecionadoparavenda('<?=$idcliente;?>', '<?=ucwords ( strtolower ( $txtnome ) );?>');"></td>
			</tr>
		</table>
		</td>
	</tr>
</table>

