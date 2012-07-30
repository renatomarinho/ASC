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

/*
 * FIXME Change cad_empresa_id to dinamic id
 */

if (! isset ( $_GET ['u'] )) {
	$_SESSION ['controlevenda'] = strtotime ( 'now' );
	unset ( $_SESSION ['carrinho_venda'] );
} else {
	$usuario = $validations->validNumeric($_GET ['u']);
	$cliente = $validations->validNumeric($_GET ['c']);
}

// Distinguindo tipo de venda
$txt_tipo_venda = "";
$key_tipo_venda = null;

switch (strtolower ( $_REQUEST['tipo_venda'] )) {
	case "vip" :
		$sql = "SELECT vendavip AS auth FROM configuracao WHERE cad_empresa_id=1";
		$txtTipoVenda = "VIP";
		$key_tipo_venda = "vip";
		break;
	
	case "normal" :
		$sql = "SELECT vendanormal AS auth FROM configuracao WHERE cad_empresa_id=1";
		$txtTipoVenda = "Normal";
		$key_tipo_venda = "normal";
		break;
	
	default :
		$sql = "SELECT vendanormal AS auth FROM configuracao WHERE cad_empresa_id=1";
		$txtTipoVenda = "Normal";
		$key_tipo_venda = "normal";
		break;
}
$query = $db->query($sql);
$row = $db->fetch_assoc($query);
$auth = $row['auth'];

$_SESSION['tipovenda'] = $_REQUEST['tipo_venda'];

?>

<fieldset id="p"><legend>Dados Venda <?=$txtTipoVenda;?></legend>

<div class="linha_separador">

<table border="0" width="100%">
	<tr>
		<td valign="top"><img src="imgs/icons/vendanormal_72.png" class="t72"></td>
		<td align="right">
		<table border="0" width="100%">
			<tr>
				<td height="25"><b>Controle</b></td>
				<td align="right"><b>[ <?=$_SESSION ['controlevenda'];?> ]</b></td>
			</tr>
			<tr>
				<td height="25"><b>Vendedor</b></td>
				<td align="right">
					<input type="hidden" value="<?=$key_tipo_venda?>" id="tipo_venda" /> 
					<select id="idusuario" style="width: 130px;" <?=((isset ( $usuario )) ? 'disabled' : '');?> onchange="javascript:<?=($auth==1)?'Sell.WithAuth(this.value)':'Sell.WithoutAuth()';?>;">
						<option value="0">selecione</option>
						<?
						$sql = "SELECT id, nome FROM cad_login WHERE ativo='ativo'";
						$query = $db->query ( $sql );
						while ( $row = $db->fetch_assoc ( $query ) ) {
						?>
						<option value="<?=$row ['id'];?>" <?=((isset ( $usuario ) && $usuario == $row ['id']) ? 'selected' : '');?>><?=ucwords ( strtolower ( $row ['nome'] ) );?></option>
						<? } ?>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2">
				<div id="confirmasenha" style="display: none">
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td height="25"><b>Senha</b></td>
						<td align="right"><input type="text" id="pwdusuario" onfocus="javascript:troca_textpwd('pwdusuario');" style="color: #c0c0c0; width: 130px;" onkeyup="returnCallBack(event, Sell.WithAuthConfirm())" /></td>
					</tr>
					<tr>
						<td height="5"></td>
					</tr>
					<tr>
						<td class="l3" colspan="2"></td>
					</tr>
					<tr>
						<td height="5"></td>
					</tr>
					<tr>
						<td colspan="2">
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td align="left"><span id="msgautentica"></span></td>
								<td align="right"><input type="submit" class="botao green btn_simgreen" value="confirmar" style="width: 105px;" onclick="javascript:Sell.WithAuthConfirm();" /></td>
							</tr>
						</table>
						</td>
					</tr>
				</table>
				</div>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>

</div>

<div id="produtosselecionarcliente" style="height: 150px; display: none;">

<div id="produtosselecionarcliente_1">
<table width="378">
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td align="left"><input type="button" class="botao btn_diminuir" value="iniciar a venda" onclick="javascript:carrega_iniciovenda_escolhaprodutos();" style="display:<?=($_REQUEST['tipo_venda']=='normal')?'block':'none';?>" /></td>
		<td align="right"><input type="button" class="botao btn_avancar" value="selecionar cliente" onclick="javascript:carrega_selecionarcliente_primeiro();" /></td>
	</tr>
</table>
</div>

<div id="produtosselecionarcliente_2" style="display:none;">
<table width="378">
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td align="left"><div style="display:<?=($_REQUEST['tipo_venda']=='normal')?'block':'none';?>"><input type="button" class="botao" value="cancelar e iniciar a venda" style="cursor: pointer; cursor: hand; width: 160px;" onclick="javascript:carrega_iniciovenda_escolhaprodutos();" /></div></td>
		<td align="right"><!--<input type="button" class="botao" value="adicionar novo cliente" style="cursor:pointer;cursor:hand;width:160px;" onclick="javascript:carrega_iniciovenda_escolhaprodutos();">--></td>
	</tr>
</table>
</div>

</div>

<div id="vendapermite" style="display:<?=((isset ( $usuario )) ? 'block' : 'none');?>;">
<input type="hidden" id="idclienteescolhido"
	<?=((isset ( $cliente )) ? 'value="' . $cliente . '"' : '');?>>
<table width="377" border="1" cellpadding="0" cellspacing="0">
	<tr>
		<td height="20"><span id="nomecliente"></span></td>
	</tr>
	<tr>
		<td height="20"><span id="msgerrovendageral"></span></td>
	</tr>
	<tr>
		<td>
		<table width="100%">
			<tr>
				<td height="25"><b>Op��es de venda</b></td>
				<td align="right">
					<select id="opcvenda" style="width: 180px;" onclick="javascript:pesquisarproduto_venda();">
						<option value="varejo">Varejo</option>
						<option value="pentrega">Pronta entrega</option>
						<option value="atacado">Atacado</option>
					</select>
				</td>
				<td width="8"></td>
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
				<td align="left" height="25"><b>C�d. de barra</b></td>
				<td align="right"><input type="text" id="codbarra" style="width: 119px;" onclick="javascript:document.getElementById('nomeprod').value='';this.value='';" onkeyup="javascript:return checkKey(event);" /></td>
				<td width="5"></td>
				<td align="right" width="1"><input type="button" value="buscar" class="botao btn_buscar" style="width: 90px;" onclick="javascript:carrega_produtovendacodbarra();" /></td>
				<td width="8"></td>
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
				<td align="left" height="25"><b>Nome do produto</b></td>
				<td align="right"><input type="text" id="nomeprod" style="width: 119px;" onclick="javascript:document.getElementById('codbarra').value='';this.value='';" onkeypress="javascript:returnCallBack(event, pesquisarproduto_venda);" /></td>
				<td width="5"></td>
				<td align="right" width="1"><input type="button" value="buscar" class="botao btn_buscar" style="width: 90px;" onclick="javascript:pesquisarproduto_venda();" /></td>
				<td width="8"></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td class="l3"></td>
	</tr>
	<tr>
		<td height="25"><b>Busca refinada por :</b></td>
	</tr>
	<tr>
		<td class="l3"></td>
	</tr>
	<tr>
		<td>
		<table width="100%">
			<tr>
				<td width="15"></td>
				<td align="left" height="25"><b>Categoria</b></td>
				<td align="right">
					<select name="produtotipo" id="produtotipo" onfocus="javascript:fechacancelar();" onclick="javascript:document.getElementById('codbarra').value='';pesquisarproduto_venda();" style="width: 180px; font-size: 11px;">
						<option value="0">Selecione uma categoria</option>
						<?
						$sql = "SELECT idprodutotipo, txtnome FROM produtotipo ORDER BY txtnome ASC";
						$query = $db->query ( $sql );
						while ( $rows = $db->fetch_assoc ( $query ) ) {
							echo "<option value='" . $rows ['idprodutotipo'] . "'>" . ucwords ( strtolower ( $rows ['txtnome'] ) ) . "</option>";
						}
						?>
					</select>
				</td>
				<td width="8"></td>
			</tr>
			<tr>
				<td width="15"></td>
				<td align="left" height="25"><b>Fornecedor</b></td>
				<td align="right">
					<select name="produtofornec" id="produtofornec" onfocus="javascript:fechacancelar();" onclick="javascript:document.getElementById('codbarra').value='';pesquisarproduto_venda();" style="width: 180px; font-size: 11px;">
						<option value="0">Selecione um fornecedor</option>
						<?
						$sql = "SELECT idfornecedor, nome FROM fornecedor ORDER BY nome ASC";
						$query = $db->query ( $sql );
						while ( $rows = $db->fetch_assoc ( $query ) ) {
							echo "<option value='" . $rows ['idfornecedor'] . "'>" . ucwords ( strtolower ( $rows ['nome'] ) ) . "</option>";
						}
						?>
					</select>
				</td>
				<td width="8"></td>
			</tr>
			<tr>
				<td width="15"></td>
				<td align="left" height="25"><b>Cole��o</b></td>
				<td align="right">
					<select name="produtocolecao" id="produtocolecao" onfocus="javascript:fechacancelar();" onclick="javascript:document.getElementById('codbarra').value='';pesquisarproduto_venda();" style="width: 180px; font-size: 11px;">
						<option value="0">Selecione uma cole��o</option>
						<?
						$sql = "SELECT idcolecao, txtnome FROM colecao ORDER BY txtnome ASC";
						$query = $db->query ( $sql );
						while ( $rows = $db->fetch_assoc ( $query ) ) {
							echo "<option value='" . $rows ['idcolecao'] . "'>" . ucwords ( strtolower ( $rows ['txtnome'] ) ) . "</option>";
						}
						?>
					</select>
				</td>
				<td width="8"></td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</div>

</fieldset>
<!--
<meta name="nome_fake" content="Selecionar Produto">
<meta name="nome_rvs" content="seleciona_produto.php">
<meta name="localizacao" content="/modulos/venda">
<meta name="descricao" content="venda com busca de produto">
 -->