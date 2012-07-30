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

$sql = "SELECT idproduto FROM produto";
$query = $db->query ( $sql );
$totalprodutos = $db->num_rows ( $query );

?>

<fieldset id="p"><legend>Resultado da compara��o</legend>

<div class="linha_separador" style="width: 350px; height: 25px;">
<table width="100%">
	<tr>
		<td align="left"><input type="button"
			value="Estat�sticas dos fornecedores" id="irestatisticas_resultado"
			class="botao" style="cursor: pointer; cursor: hand; width: 190px;"
			onclick="javascript:historicofornecedor();"></td>
		<td align="right"><input type="button" value="Ir para listagem"
			id="irlistagem_resultado" class="botao"
			style="cursor: pointer; cursor: hand; width: 140px;"
			onclick="javascript:carrega_listagemfornecedores(path+'modulos/fornecedor/fornecedor_lista.php','conteudo_direito', '-');"></td>
	</tr>
</table>
</div>

<div style="width: 372px; height: 320px; overflow: auto;">
<table width="100%">
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td height="20"><b>Gr�fico comparativo dos fornecedores</b></td>
	</tr>
	<tr>
		<td style="border-top: 2px solid black"></td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td>
		<div style="width: 340px;">
					<?
					$total = $validations->validNumeric ( $_GET ['total'] );
					$param = $validations->validNumeric ( $_GET ['param'] );
					$remonta_url = '';
					for($i = 0; $i < $total; $i ++) {
						$remonta_url .= '&idfor' . $i . '=' . $_GET ['idfor' . $i];
					}
					require $_CONF ['PATH'] . 'modulos/charts/library/open_flash_chart_object.php';
					open_flash_chart_object ( 340, 280, $_CONF ['PATH_VIRTUAL'] . 'modulos/charts/chart-comparafornecedor.php?total=' . $total . '&param=' . $param . $remonta_url, false );
					?>
				</div>
		</td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td style="border-top: 2px solid black"></td>
	</tr>
	<tr>
		<td height="20"><b>Relat�rio comparativo dos fornecedores</b></td>
	</tr>
	<tr>
		<td style="border-top: 2px solid black"></td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td>
		<table width="100%">
				<?
				$nome_fornecedor = array ();
				
				$total = $_GET ['total'];
				$param = $_GET ['param'];
				
				$vetor_url = array ();
				
				for($i = 0; $i < $total; $i ++) {
					$vetor_url [$i] = $_GET ['idfor' . $i];
				}
				
				foreach ( $vetor_url as $key => $value ) {
					
					$sql = "SELECT idfornecedor, nome FROM fornecedor WHERE idfornecedor=" . $value;
					$query = $db->query ( $sql );
					$rowfornecedor = $db->fetch_assoc ( $query );
					
					?>
					<tr>
				<td height="25"><?=qtdCaracteres ( ucwords ( strtolower ( $rowfornecedor ['nome'] ) ), 30 )?></td>
				<td align="right">
						<?
					$resultado = resultadorelatorio_fornecedor ( $vetor_url [$key], $param );
					if ($param == 1) {
						if ($resultado > 0)
							echo 'R$ ' . number_format ( $resultado, 2, ',', '.' );
						else
							echo 'nenhum produto';
					} else if ($param == 2) {
						if ($resultado > 0)
							echo 'R$ ' . number_format ( $resultado, 2, ',', '.' );
						else
							echo 'nenhum lucro';
					} else if ($param == 3) {
						if ($resultado == 0)
							echo 'nenhum item';
						else
							echo $resultado . ' ite' . (($resultado == 1) ? 'm' : 'ns');
					} else if ($param == 4) {
						if ($resultado > 0)
							echo 'R$ ' . number_format ( $resultado, 2, ',', '.' );
						else
							echo 'nenhuma venda';
					} else if ($param == 5) {
						if ($resultado == 0)
							echo 'nenhum produto';
						else
							echo $resultado . ' produto' . (($resultado == 1) ? '' : 's');
					} else if ($param == 6) {
						if ($resultado > 0)
							echo number_format ( $resultado, 2 ) . ' %';
						else
							echo 'nenhum lucro';
					} else if ($param == 7) {
						if ($resultado == 0)
							echo 'nenhum item';
						else
							echo $resultado . ' ite' . (($resultado == 1) ? 'm' : 'ns');
					} else if ($param == 8) {
						if ($resultado > 0)
							echo 'R$ ' . number_format ( $resultado, 2, ',', '.' );
						else
							echo 'nenhuma venda';
					}
					?>
						</td>
			</tr>
				<?
				}
				?>
				</table>
		</td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td style="border-top: 2px solid black"></td>
	</tr>
</table>
</div>

<div style="height: 60px;">
<table>
	<tr>
		<td><a href="#"><img
			src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icon_excel.jpg" height="22"
			width="22" border="0"></a></td>
		<td width="10"></td>
		<td><a href="#"><img
			src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icon_pdf.jpg" height="22"
			width="22" border="0"></a></td>
		<td width="10"></td>
		<td><a href="#"><img
			src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icon_print.jpg" height="22"
			width="22" border="0"></a></td>
	</tr>
</table>
</div>

</fieldset>