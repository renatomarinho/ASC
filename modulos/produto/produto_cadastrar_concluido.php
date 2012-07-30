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

if (isset ( $_GET ['id'] )) {
	$idproduto = $_GET ['id'];
} else {
	$idproduto = 0;
}

?>


<fieldset id="p"><legend>Produto Adicionado com Sucesso</legend>

<div class="linha_separador" style="height: 28px;">
<table width="100%" height="100%">
	<tr>
		<td align="center"><b style="color: green">Produto adicionado com
		sucesso</b></td>
	</tr>
</table>
</div>

<div>

<table width="370">
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td height="20"><b>Escolha uma das op��es abaixo</b></td>
	</tr>
	<tr>
		<td height="5" style="border-bottom: 2px solid black"></td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td>
		<table width="100%">
			<tr>
				<td align="left">
							<?
							if (isset ( $_SESSION ['col'] )) {
								?>
							<input type="button" class="botao" value="Voltar para cole��o"
					style="cursor: pointer; cursor: hand; width: 160px; background-color: green;"
					onClick="javascript:carrega_dadoscolecaoproduto('<?=$_SESSION ['col'];?>');">
							<?
								unset ( $_SESSION ['col'] );
							} else if (isset ( $_SESSION ['for'] )) {
								?>
							<input type="button" class="botao" value="Voltar para fornecedor"
					style="cursor: pointer; cursor: hand; width: 180px; background-color: green;"
					onClick="javascript:carrega_dadosfornecedor('<?=$_SESSION ['for'];?>');">
							<?
								unset ( $_SESSION ['for'] );
							} else {
								?>
							<input type="button" class="botao" value="Ir para listagem"
					style="cursor: pointer; cursor: hand; width: 160px;"
					onClick="javascript:carrega_listagemprodutos(path+'modulos/produto/lista.php','conteudo_total');">
							<?
							}
							?>
							</td>
				<td align="right"><input type="button" class="botao"
					value="Adicionar novo produto"
					style="cursor: pointer; cursor: hand; width: 180px;"
					onclick="javascript:carrega_adicionarproduto('modulos/produto/produto_cadastrar.php', '<?=date ( 'simyhd' );?>');"></td>
			</tr>
		</table>
		</td>
	</tr>
</table>

</div>

</fieldset>