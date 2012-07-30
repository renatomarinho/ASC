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

$sql = "SELECT idcolecao, txtnome FROM colecao ORDER BY txtnome ASC";
$query = $db->query ( $sql );

?>

<fieldset id="m"><legend>Comparar Cole��es</legend>

<div class="linha_separador" style="width: 480px; height: 25px;">

<table width="100%">
	<tr>
		<td align="left"><input type="button" value="Ir para listagem"
			id="irlistagem_comparar" class="botao"
			style="cursor: pointer; cursor: hand; width: 140px;"
			onclick="javascript:carrega_listagemcolecoes(path+'modulos/colecao/colecao_lista.php','conteudo_direito', '-');"></td>
		<td align="right">
		<div id="mensagem"></div>
		</td>
	</tr>
</table>

</div>


<div style="width: 480px;">
<table width="100%" cellspacing="0" cellpadding="0" border="0">
	<tr>
		<td height="10"></td>
	</tr>
			<?
			$totalcolecoes = $db->num_rows ( $query );
			if ($totalcolecoes >= 2) {
				?>
				<tr>
		<td height="25" bgcolor="#f0f0f0">&nbsp;&nbsp;&nbsp;&nbsp;<b>Marque as
		cole��es que deseja realizar uma compara��o</b></td>
	</tr>
	<tr>
		<td>
		<div id="listacolecao"
			style="overflow: auto; height: 170px; width: 498px; border: 1px solid #c0c0c0;">

		<table width="100%" cellspacing="0" cellpadding="0" border="0">

								<?
				$coluna = 1;
				while ( $rowcolecao = $db->fetch_assoc ( $query ) ) {
					
					if ($coluna == 1) {
						echo '<tr><td width="50">';
					} else {
						echo '<td width="50">';
					}
					?>
										<table cellpadding="5" cellspacing="5">
				<tr>
					<td><input type="checkbox" value="<?=$rowcolecao ['idcolecao'];?>"></td>
					<td width="5"></td>
					<td><?=qtdCaracteres ( ucwords ( strtolower ( $rowcolecao ['txtnome'] ) ), 25 );?></td>
				</tr>
			</table>

								<?
					if ($coluna == 1) {
						echo '</td>';
						$coluna = 2;
					} else {
						echo '</td></tr>';
						$coluna = 1;
					}
				
				}
				?>

							</table>

		</div>
		</td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td height="25"><b>Selecione o par�metro para a compara��o</b></td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td>
		<div id="parametro">
		<table>
			<tr>
				<td><input type="radio" name="grafico" value="1" checked></td>
				<td>Custo da cole��o</td>
				<td width="10"></td>
				<td><input type="radio" name="grafico" value="2"></td>
				<td>Lucro bruto ( R$ )</td>
				<td width="10"></td>
				<td><input type="radio" name="grafico" value="3"></td>
				<td>Itens em estoque</td>
				<td width="10"></td>
				<td><input type="radio" name="grafico" value="4"></td>
				<td>Valor das vendas</td>
			</tr>
			<tr>
				<td height="10" colspan="10"></td>
			</tr>
			<tr>
				<td><input type="radio" name="grafico" value="5"></td>
				<td>Qtd. de produtos</td>
				<td width="10"></td>
				<td><input type="radio" name="grafico" value="6"></td>
				<td>Lucro bruto ( % )</td>
				<td width="10"></td>
				<td><input type="radio" name="grafico" value="7"></td>
				<td>Itens vendidos</td>
				<td width="10"></td>
				<td><input type="radio" name="grafico" value="8"></td>
				<td>Valor custo vendas</td>
			</tr>
		</table>
		</div>
		</td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td align="right"><input type="button" value="Gerar relat�rio"
			id="geracomparacaocolecao" class="botao"
			style="cursor: pointer; cursor: hand; width: 140px; background-color: green;"
			onclick="javascript:carrega_colecaocomparacaografico();"></td>
	</tr>
			<?
			} else {
				?>
				<tr>
		<td height="15"></td>
	</tr>
	<tr>
		<td height="25" align="center"><b style="color: red;">Aten��o : Para
		utilizar este recurso voc� dever no m�nimo duas cole��es</b></td>
	</tr>
	<tr>
		<td height="15"></td>
	</tr>
	<tr>
		<td style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td align="right"><input type="button" value="adicionar nova cole��o"
			class="botao" id="addnovacolecao"
			style="cursor: pointer; cursor: hand; width: 160px; background-color: green;"
			onclick="javascript:adicionar_colecao(path+'modulos/colecao/colecao_adicionarmain.php');this.style.display='none';"></td>
	</tr>
			<?
			}
			?>
			</table>
</div>

</fieldset>
