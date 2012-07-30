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

if (! isset ( $_GET ['mes'] )) {
	$data_mes = date ( 'n' );
} else {
	$data_mes = $_GET ['mes'] + 1;
}

function calculateYearsOld($bday, $bmonth, $byear) {
	$years = date ( "Y" ) - intval ( $byear );
	
	$day = str_pad ( intval ( $bday ), 2, "0", STR_PAD_LEFT );
	$month = str_pad ( intval ( $bmonth ), 2, "0", STR_PAD_LEFT );
	if (intval ( "$month$day" ) > intval ( date ( "md" ) ))
		$years -= 1;
	
	return $years;
}

?>

<fieldset id="p"><legend>Aniversariantes - <?=ucwords ( $meses [$data_mes] );?></legend>
<div class="linha_separador">
<table cellpadding="0" cellspacing="0">
	<tr>
		<td>Selecione o mes</td>
		<td width="10"></td>
		<td><select id="mesescolhido">
			<option <?
			echo ($data_mes == 1) ? 'selected' : '';
			?>>Janeiro</option>
			<option <?
			echo ($data_mes == 2) ? 'selected' : '';
			?>>Fevereiro</option>
			<option <?
			echo ($data_mes == 3) ? 'selected' : '';
			?>>Marco</option>
			<option <?
			echo ($data_mes == 4) ? 'selected' : '';
			?>>Abril</option>
			<option <?
			echo ($data_mes == 5) ? 'selected' : '';
			?>>Maio</option>
			<option <?
			echo ($data_mes == 6) ? 'selected' : '';
			?>>Junho</option>
			<option <?
			echo ($data_mes == 7) ? 'selected' : '';
			?>>Julho</option>
			<option <?
			echo ($data_mes == 8) ? 'selected' : '';
			?>>Agosto</option>
			<option <?
			echo ($data_mes == 9) ? 'selected' : '';
			?>>Setembro</option>
			<option <?
			echo ($data_mes == 10) ? 'selected' : '';
			?>>Outubro</option>
			<option <?
			echo ($data_mes == 11) ? 'selected' : '';
			?>>Novembro</option>
			<option <?
			echo ($data_mes == 12) ? 'selected' : '';
			?>>Dezembro</option>
		</select></td>
		<td width="10"></td>
		<td><input type="button" value="ver todos" class="botao"
			onclick="javascript:carrega_conteudomeios(path+'modulos/cliente/aniversariantes.php?mes='+document.getElementById('mesescolhido').selectedIndex, 'conteudo_esquerdo');"></td>
	</tr>
</table>
</div>
<div style="width: 377px; height: 350px; overflow: auto;">
<table width="100%">
			<?
			
			$sql = "SELECT * FROM cliente WHERE `dtaniversario` LIKE '%-" . $data_mes . "-%' OR `dtaniversario` LIKE '%/" . $data_mes . "' ORDER BY dtaniversario ASC";
			$query = $db->query ( $sql );
			if ($db->num_rows ( $db->query ( $sql ) ) == 0) {
				echo "
					<tr>
						<td align=center><b>Nenhum aniversariante</b></td>
					</tr>
				";
			}
			$n = 1;
			$cor = 0;
			
			/*
			** APAGAR!
			$tstrows = $db->fetch_assoc($query);
			echo '<b>'.print_r($tstrows).'</b>';
			*/
			$cor = '#f0f0f0';
			while ( $rows = $db->fetch_assoc ( $query ) ) {
				if (strpos ( $rows ['dtaniversario'], '/' )) {
					$dtaniversario = explode ( '/', $rows ['dtaniversario'] );
					$dia = $dtaniversario [0];
					$mes = $dtaniversario [1];
				}
				
				if (strpos ( $rows ['dtaniversario'], '-' )) {
					$dtaniversario = explode ( '-', $rows ['dtaniversario'] );
					$dia = $dtaniversario [2];
					$mes = $dtaniversario [1];
				}
				$mktime = mktime ( 0, 0, 0, $mes, $dia, date ( "Y" ) );
				$rows ['dtaniversario'] = $dia . '/' . $mes;
				//$anos = calculateYearsOld($explo[2], $explo[1], $explo[0]);
				$telefone = formata_telefone ( $rows ['txttelefone'] );
				if (strlen ( $rows ['txtcelular'] ) > 0)
					$telefone .= ' / ' . formata_telefone ( $rows ['txtcelular'] );
				if (substr ( $telefone, 0, 3 ) == ' / ')
					$telefone = substr ( $telefone, 3 );
				
				$telefone = str_replace ( '(00) 0000-0000 / ', '', $telefone );
				$telefone = str_replace ( '(00) 0000-0000', '', $telefone );
				if (strlen ( $telefone ) <= 17)
					$telefone = str_replace ( '/', '', $telefone );
				
				$cor = ($cor == '#add4fb') ? '#f0f0f0' : '#add4fb';
				if ($dia == date ( 'd' ) && $mes == date ( 'm' ))
					$aniversariante = true;
				else
					$aniversariante = false;
				?>
						<tr bgcolor="<?=$cor;?>"
		onclick="javascript:carrega_conteudomeios(path+'modulos/cliente/editar.php?id=<?=$rows ['idcliente'];?>&refer=aniver', 'conteudo_direito');">
		<td height="25"
			onMouseover="ddrivetip('<font style=color:#fff><b>Dados do Cliente</b><BR>Nome : <?=ucwords ( strtolower ( $rows ['txtnome'] ) );?><BR>Telefone : <?=$telefone;?><Br/>E-mail : <?=$rows ['txtemail'];?></font>','#6aa9e9', 250)"
			; onMouseout="hideddrivetip()" align="center"><?=$rows ['dtaniversario'];?></td>
		<td height="25"
			onMouseover="ddrivetip('<font style=color:#fff><b>Dados do Cliente</b><BR>Nome : <?=ucwords ( strtolower ( $rows ['txtnome'] ) );?><BR>Telefone : <?=$telefone;?><Br/>E-mail : <?=$rows ['txtemail'];?></font>','#6aa9e9', 250)"
			; onMouseout="hideddrivetip()">&nbsp;&nbsp;<?=qtdCaracteres ( ucwords ( strtolower ( $rows ['txtnome'] ) ), 30 );?></td>
		<td width="50" align="center"
			onMouseover="ddrivetip('<font style=color:#fff><b>Enviar E-mail</b><BR>Clique para enviar um e-mail ao cliente</font>','#6aa9e9', 250)"
			; onMouseout="hideddrivetip()"><a
			href="mailto:<?=$rows ['txtemail'];?>?subject=<?=$_CONF ['nome_loja'] . " - " . $_CONF ['assunto_aniversario'];?>">E-mail</a></td>
	</tr>
			<?
			}
			?>
					</table>

</div>

</fieldset>