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

if (isset ( $_SESSION ['col'] )) {
	unset ( $_SESSION ['col'] );
}

$sql = "SELECT idproduto FROM produto";
$query = $db->query ( $sql );
$totalprodutos = $db->num_rows ( $query );
?>

<fieldset id="g"><legend>Lista de Produtos</legend>
<div class="linha_separador">
<table width="100%">
	<tr>
		<td>
		<table>
			<tr>
				<td><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/produto_72.png"
					class="t72"></td>
				<td width="10"></td>
				<td><b>Atualmente <?=(($totalprodutos == 0) ? 'n�o possui nenhum produto cadastrado' : 'possui ' . $totalprodutos . ' produtos cadastrado') . (($totalprodutos <= 1) ? '' : 's');?></b>
				<br />
				Para encontrar um produto com facilidade utilize a busca</i></td>
			</tr>
		</table>
		</td>
		<td align="right">
		<table>
			<tr>
				<td>
				<table>
					<tr>
						<td><input type="text" id="pesquisaproduto"
							style="width: 239px; font-size: 16px;" maxlength="50"></td>
						<td width="5"></td>
						<td align="left">
						<table cellpadding="0" cellspacing="0">
							<tr>
								<td><input type="radio" id="rdopesquisaprod" name="pesquisa"
									checked onClick="javascript:pesquisarproduto();"></td>
								<td>nome</td>
								<td width="5"><input type="hidden" id="rdopesquisacodigo"></td>
								<td><input type="radio" id="rdopesquisacodbarra" name="pesquisa"
									onClick="javascript:pesquisarproduto();"></td>
								<td>c�d. barras</td>
							</tr>
						</table>
						</td>
						<td width="5"></td>
						<td align="left"><input type="button" value="buscar produto"
							class="botao btn_buscar" onclick="javascript:pesquisarproduto();"></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td>
				<table>
					<tr>
						<td><input type="checkbox"
							onClick="javascript:disablecampo('produtotipo'); pesquisarproduto();"></td>
						<td><select name="produtotipo" id="produtotipo"
							onChange="javascript:pesquisarproduto();"
							style="width: 100px; font-size: 11px;" disabled>
							<option value="0">categoria</option>
												<?
												$sql = "SELECT idprodutotipo, txtnome FROM produtotipo ORDER BY txtnome ASC";
												$query = $db->query ( $sql );
												while ( $rows = $db->fetch_assoc ( $query ) ) {
													echo "<option value='" . $rows ['idprodutotipo'] . "'>" . ucwords ( strtolower ( $rows ['txtnome'] ) ) . "</option>";
												}
												?>
											</select></td>
						<td width="5"></td>
						<td><input type="checkbox"
							onClick="javascript:disablecampo('produtofornec'); pesquisarproduto();"></td>
						<td><select name="produtofornec" id="produtofornec"
							onChange="javascript:pesquisarproduto();"
							style="width: 100px; font-size: 11px;" disabled>
							<option value="0">fornecedor</option>
												<?
												$sql = "SELECT idfornecedor, nome FROM fornecedor ORDER BY nome ASC";
												$query = $db->query ( $sql );
												while ( $rows = $db->fetch_assoc ( $query ) ) {
													echo "<option value='" . $rows ['idfornecedor'] . "'>" . ucwords ( strtolower ( $rows ['nome'] ) ) . "</option>";
												}
												?>
											</select></td>
						<td width="5"></td>
						<td><input type="checkbox"
							onClick="javascript:disablecampo('produtocolecao'); pesquisarproduto();"></td>
						<td><select name="produtocolecao" id="produtocolecao"
							onChange="javascript:pesquisarproduto();"
							style="width: 100px; font-size: 11px;" disabled>
							<option value="0">cole��o</option>
												<?
												$sql = "SELECT idcolecao, txtnome FROM colecao ORDER BY txtnome ASC";
												$query = $db->query ( $sql );
												while ( $rows = $db->fetch_assoc ( $query ) ) {
													echo "<option value='" . $rows ['idcolecao'] . "'>" . ucwords ( strtolower ( $rows ['txtnome'] ) ) . "</option>";
												}
												?>
											</select></td>
						<td width="5"></td>
						<td><input type="button" value="adicionar produto"
							class="botao btn_adicionargreen green"
							onclick="javascript:carrega_adicionarproduto('modulos/produto/produto_cadastrar.php', '<?=date ( 'simyhd' );?>');"></td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</div>
<div style="z-index: 9999">

<table width="932">
	<!--<tr>
				<td bgcolor="#f0f0f0">
					<table width="100%" cellpadding="0" cellspacing="0">
						<tr>
							<td align="center" width="120" height="25"><a href="javascript:;" onclick="javascript:ordenaproduto('p.cod_barra', 'issetcodigo');"><strong>C&oacute;d. Barra</strong><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/asset.png" id="issetcodigo" valign="absmiddle" border="0"></a></td>
							<td width="360" height="25"><a href="javascript:;" onclick="javascript:ordenaproduto('p.txtproduto', 'issetproduto');"><strong>Nome</strong><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/asset.png" id="issetproduto" valign="absmiddle" border="0"></a></td>
							<td width="170" height="25" align="center"><a href="javascript:;" onclick="javascript:ordenaproduto('col.idcolecao', 'issetcolecao');"><strong>Colecao</strong><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/asset.png"" id="issetcolecao" valign="absmiddle" border="0"></a></td>
							<td width="120" height="25" align="center"><a href="javascript:;" onclick="javascript:ordenaproduto('p.vlvarejo', 'issetvalor');"><strong>Pre�o varejo</strong><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/asset.png" id="issetvalor" valign="absmiddle" border="0"></a></td>
							<td width="70" height="25" align="center"><a href="javascript:;" onclick="javascript:ordenaproduto('e.nquantidade', 'issetestoque');"><strong>Estoque</strong><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/asset.png" id="issetestoque" valign="absmiddle" border="0"></a></td>
							<td width="120"></td>
						</tr>
					</table>
				</td>
			</tr> -->
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td>
		<div id="listaprodutos"
			style="overflow: auto; height: 270px; width: 932px"></div>
		</td>
	</tr>
</table>

</div>

</fieldset>
