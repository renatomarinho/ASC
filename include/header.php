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


ob_start ();

require "config/default.php";

if (! isset ( $_SESSION ['nomeuser'] )) {
	header ( "Location: login.php" );
}

for($n = 0; $n < $_CONF ['max_perm']; $n ++) {
	if (permite ( $_SESSION ['nomeuser'], $n ))
		$permissoes [$n] = TRUE;
	else
		$permissoes [$n] = 0;
}

$validations = new validations ( );
$db = new db ( );
$db->connect ();

$sql = "SELECT mvc.fechamento, mvc.turno FROM mv_caixa AS mvc ORDER BY mvc.id DESC LIMIT 1";
$query = $db->query ( $sql );
if ($db->num_rows ( $query )) {
	$rowcaixa = $db->fetch_assoc ( $query );
	if ($rowcaixa ['fechamento']) {
		$fechamento = 'FECHADO';
	} else {
		$fechamento = 'ABERTO';
	}
	$turno = $rowcaixa ['turno'];
} else {
	$fechamento = 'FECHADO';
	$turno = 1;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; UTF-8" />

<link rel="stylesheet" type="text/css" media="screen" title="estilo" href="<?=$_CONF ['PATH_VIRTUAL'];?>css/estilo.css" />
<link rel="stylesheet" type="text/css" media="screen" title="listagem" href="<?=$_CONF ['PATH_VIRTUAL'];?>css/listagem.css" />
<link rel="stylesheet" type="text/css" media="print" title="etiqueta_6081" href="<?=$_CONF ['PATH_VIRTUAL'];?>css/impressao_6081.css" disabled="true" />

<link rel="stylesheet" type="text/css" media="print" title="etiqueta_6087" href="<?=$_CONF ['PATH_VIRTUAL'];?>css/impressao_6087.css" disabled="true" />
<link rel="stylesheet" type="text/css" media="print" title="etiqueta_6089" href="<?=$_CONF ['PATH_VIRTUAL'];?>css/impressao_6089.css" disabled="true" />
<link rel="stylesheet" type="text/css" media="print" title="etiqueta_default" href="<?=$_CONF ['PATH_VIRTUAL'];?>css/impressao.css" disabled="true" />

<script type="text/javascript">
<!--

var path = '<?=$_CONF ['PATH_VIRTUAL'];?>';
var bg_btn_clicado = '<?=$_CONF ['btn_clicado'];?>';
var bg_btn_normal = '<?=$_CONF ['btn_normal'];?>';

var row_over = '<?=$_CONF ['bg_row_over'];?>';
var row_out = '<?=$_CONF ['bg_row_out'];?>';

var numero = 0;


var menu_cadastro=new Array()
<?
if ($permissoes [0]) {
	?>
menu_cadastro[numero]='<a href="javascript:;" onclick="javascript:carrega_listagemcliente();"><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/clientes_menu.png" class="t22" align="absmiddle">1&nbsp;clientes</a>';
numero++;
<?
}
?>
<?

if ($permissoes [1]) {
?>
menu_cadastro[numero]='<a href="javascript:;" onclick="javascript:carrega_listagemprodutos(path+\'modulos/produto/lista.php\',\'conteudo_total\');"><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/produtos_menu.png" class="t22" align="absmiddle">2&nbsp;produtos</a>';
numero++
<?
}
?>
<?

if ($permissoes [2]) {
	?>
menu_cadastro[numero]='<a href="javascript:;" onclick="javascript:carrega_listagemcolecoes(path+\'modulos/colecao/colecao_lista.php\',\'conteudo_direito\', \'historico\');"><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/colecoes_menu.png" class="t22" align="absmiddle">3&nbsp;coleções</a>';
numero++
<?
}
?>
<?

if ($permissoes [3]) {
	?>
menu_cadastro[numero]='<a href="javascript:;" onclick="javascript:carrega_listagemfornecedores(path+\'modulos/fornecedor/fornecedor_lista.php\',\'conteudo_direito\', \'historico\');"><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/fornecedores_menu.png" class="t22" align="absmiddle">4&nbsp;fornecedores</a>'
numero++
<?
}
?>
<?

if ($permissoes [4]) {
	//menu_cadastro[numero]='<a href="#">Item ao Estoque</a>'
//numero++
}
?>

numero = 0;

var menu_vendas=new Array()
<?
if ($fechamento == 'ABERTO') {
	?>
<?

	if ($permissoes [5]) {
		?>
menu_vendas[numero]='<a href="javascript:;" onclick="javascript:carrega_efetuarvenda(path+\'modulos/venda/seleciona_produto.php\',\'normal\');"><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/vendanormal_menu.png" class="t22" align="absmiddle">1&nbsp;venda normal</a>'
numero++
<?
	}
	?>
<?

	if ($permissoes [6]) {
		?>
menu_vendas[numero]='<a href="javascript:;" onclick="javascript:carrega_efetuarvenda(path+\'modulos/venda/seleciona_produto.php\',\'vip\');"><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/vendavip_menu.png" class="t22" align="absmiddle">2&nbsp;venda vip</a>'
numero++
<?
	}
	?>
<?

	if ($permissoes [8]) {
		?>
menu_vendas[numero]='<a href="javascript:;" onclick="javascript:carrega_estornarvenda(path+\'modulos/venda/estornar_venda.php\',\'conteudo_esquerdo\');"><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/estornar_menu.png" class="t22" align="absmiddle">3&nbsp;estornar produto</a>'
numero++
<?
	}
	?>
<?

	if ($permissoes [8]) {
		?>
menu_vendas[numero]='<a href="javascript:;" onclick="javascript:carrega_estornarvenda(path+\'modulos/venda/estornar_venda.php?tipo_venda=vip\',\'conteudo_esquerdo\');"><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/estornar_menu.png" class="t22" align="absmiddle">4&nbsp;retornar prod. vip</a>'
numero++
<?
	}
	?>
menu_vendas[numero]='<a href="javascript:;" onclick="javascript:carrega_abrirturno();"><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/turnofechar_menu.png" class="t22" align="absmiddle"> fechar turno</a>'
numero++
<?
} else {
	?>
menu_vendas[numero]='<a href="javascript:;" onclick="javascript:carrega_abrirturno();"><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/turnoabrir_menu.png" class="t22" align="absmiddle"> abrir turno</a>'
numero++
<?
}
?>


numero = 0;

var menu_financeiro=new Array()
<?
if ($permissoes [9]) {
	?>
menu_financeiro[numero]='<a href="javascript:;" onclick="javascript:carrega_financeiro_fluxo_lista(<?=date ( 'd' )?>,<?=date ( 'm' )?>,<?=date ( 'Y' )?>);">1&nbsp;Fluxo de Caixa</a>'
numero++
<?
}
?>
<?

if ($permissoes [10]) {
	?>
//menu_financeiro[numero]='<a href="#">Todos Lançamentos</a>'
//numero++
<?
}
?>
<?

if ($permissoes [7]) {
	?>
//menu_financeiro[numero]='<a href="#">Lançamento Caixa</a>'
//numero++
<?
}
?>
<?

if ($permissoes [11]) {
	?>
//menu_financeiro[numero]='<a href="#">Lançamento Turno</a>'
//numero++
<?
}
?>

numero = 0;

var menu_relatorios=new Array()
<?
if ($permissoes [12]) {
	?>
menu_relatorios[numero]='<a href="javascript:;" onclick="javascript:carrega_relatorioprodutosvendidos(path+\'modulos/relatorios/produtos.php\',\'conteudo_total\');"><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/relatorio_menu.png" class="t22" align="absmiddle">1&nbsp;produtos</a>'
numero++
<?
}
?>
<?

if ($permissoes [13]) {
	?>
menu_relatorios[numero]='<a href="javascript:;" onclick="javascript:carrega_relatoriolucratividade(path+\'modulos/relatorios/venda_lucratividade_periodo.php\',\'conteudo_total\');"><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/relatorio_menu.png" class="t22" align="absmiddle">2&nbsp;vendas</a>'
numero++
<?
}
?>
<?

if ($permissoes [13]) {
	?>
menu_relatorios[numero]='<a href="javascript:;" onclick="javascript:carrega_relatorio_venda_vip(path+\'modulos/relatorios/venda_lucratividade_periodo.php\',\'conteudo_total\');"><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/relatorio_menu.png" class="t22" align="absmiddle">3&nbsp;vendas vip vendas</a>'
numero++
<?
}
?>
<?

if ($permissoes [14]) {
	?>
menu_relatorios[numero]='<a href="javascript:;" onclick="javascript:carrega_relatorioestoque(path+\'modulos/relatorios/estoque.php\',\'conteudo_total\');"><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/relatorio_menu.png" class="t22" align="absmiddle">4&nbsp;estoque</a>'
numero++
<?
}
?>
<?

if ($permissoes [15]) {
	?>
menu_relatorios[numero]='<a href="javascript:;" onclick="javascript:carrega_relatoriofornecedores(path+\'modulos/relatorios/fornecedores.php\',\'conteudo_total\');"><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/relatorio_menu.png" class="t22" align="absmiddle">5&nbsp;fornecedores</a>'
numero++
<?
}
?>
<?

if ($permissoes [16]) {
	?>
menu_relatorios[numero]='<a href="javascript:;" onclick="javascript:carrega_relatorioclientes(path+\'modulos/relatorios/clientes.php\',\'conteudo_total\');"><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/relatorio_menu.png" class="t22" align="absmiddle">6&nbsp;clientes</a>'
numero++
<?
}
?>

<?
if ($permissoes [17]) {
	?>
//menu_relatorios[numero]='<a href="#"><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/relatorio_menu.png" class="t22" align="absmiddle"> financeiros</a>'
//numero++
<?
}
?>
<?

if ($permissoes [18]) {
	?>
//menu_relatorios[numero]='<a href="#"><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/relatorio_menu.png" class="t22" align="absmiddle"> auxiliares</a>'
//numero++
<?
}
?>

numero = 0;

var menu_util=new Array()
<?
if ($permissoes [19]) {
	?>
menu_util[numero]='<a href="javascript:;" onclick="javascript:Calendar.Starting(<?=date ( 'd' )?>,<?=date ( 'm' )?>,<?=date ( 'Y' )?>);"><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/agenda_menu.png" class="t22" align="absmiddle">1&nbsp;agenda</a>'
numero++
<?
}
?>
<?

if ($permissoes [20]) {
	?>
menu_util[numero]='<a href="javascript:;" onclick="javascript:carrega_emissaoetiqueta();"><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/etiqueta_menu.png" class="t22" align="absmiddle">2&nbsp;etiquetas</a>'
numero++
menu_util[numero]='<a href="javascript:;" onclick="javascript:carrega_emissaomailling();"><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/mailling_menu.png" class="t22" align="absmiddle">3&nbsp;mailing</a>'
numero++
<?
}
?>
<?

if ($permissoes [21]) {
	?>
menu_util[numero]='<a href="javascript:;" onclick="javascript:autentica_software();"><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/atualizacao_menu.png" class="t22" align="absmiddle">4&nbsp;atualizações</a>'
numero++
<?
}
?>

numero = 0;

var menu_config=new Array()

<?
if ($permissoes [22]) {
	?>
menu_config[numero]='<a href="#"><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/backup_menu.png" class="t22" align="absmiddle">1&nbsp;backup</a>'
numero++
<?
}
?>
<?

if ($permissoes [23]) {
	?>
menu_config[numero]='<a href="javascript:;" onclick="javascript:carrega_usuariosadm(path+\'modulos/administracao/lista_adm.php\',\'conteudo_esquerdo\');"><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/adm_menu.png" class="t22" align="absmiddle">2&nbsp;administradores</a>'
numero++
<?
}
?>
<?

if ($permissoes [24]) {
	?>
menu_config[numero]='<a href="javascript:;"  onclick="javascript:Configuration.Starting();"><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/config_menu.png" class="t22" align="absmiddle">3&nbsp;configurações</a>'
numero++
<?
}
?>

var menu_ajuda=new Array()
menu_ajuda[0]='<a href="javascript:;"  onclick="javascript:Help.Starting();"><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/manual_menu.png" class="t22" align="absmiddle">1&nbsp;manual</a>'
menu_ajuda[1]='<a href="#"><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/ajudaonline_menu.png" class="t22" align="absmiddle">2&nbsp;ajuda online</a>'

-->
</script>
<script src="<?=$_CONF ['PATH_VIRTUAL'];?>js/shortcut.js" type="text/javascript"></script>
<script src="<?=$_CONF ['PATH_VIRTUAL'];?>js/selector.js" type="text/javascript"></script>
<script src="<?=$_CONF ['PATH_VIRTUAL'];?>js/behavior.js" type="text/javascript"></script>
<script src="<?=$_CONF ['PATH_VIRTUAL'];?>js/main.js" type="text/javascript"></script>
<script src="<?=$_CONF ['PATH_VIRTUAL'];?>js/listagem.js" type="text/javascript"></script>
<script src="<?=$_CONF ['PATH_VIRTUAL'];?>js/kernel.js" type="text/javascript"></script>
<script src="<?=$_CONF ['PATH_VIRTUAL'];?>js/tooltips.js" type="text/javascript"></script>

<script src="<?=$_CONF ['PATH_VIRTUAL'];?>js/financeiro/rules.js" type="text/javascript"></script>
<script src="<?=$_CONF ['PATH_VIRTUAL'];?>js/financeiro/financeiro.js" type="text/javascript"></script>

<script src="<?=$_CONF ['PATH_VIRTUAL'];?>js/produto/shortcut.js" type="text/javascript"></script>
<script src="<?=$_CONF ['PATH_VIRTUAL'];?>js/produto/rule.js" type="text/javascript"></script>
<script src="<?=$_CONF ['PATH_VIRTUAL'];?>js/produto/produto.js" type="text/javascript"></script>

<script src="<?=$_CONF ['PATH_VIRTUAL'];?>js/venda/shortcut.js" type="text/javascript"></script>
<script src="<?=$_CONF ['PATH_VIRTUAL'];?>js/venda/rule.js" type="text/javascript"></script>
<script src="<?=$_CONF ['PATH_VIRTUAL'];?>js/venda/venda.js" type="text/javascript"></script>

<script src="<?=$_CONF ['PATH_VIRTUAL'];?>js/relatorios/shortcut.js" type="text/javascript"></script>
<script src="<?=$_CONF ['PATH_VIRTUAL'];?>js/relatorios/rules.js" type="text/javascript"></script>
<script src="<?=$_CONF ['PATH_VIRTUAL'];?>js/relatorios/relatorios.js" type="text/javascript"></script>
<script src="<?=$_CONF ['PATH_VIRTUAL'];?>js/relatorios/vendas.js" type="text/javascript"></script>

<script src="<?=$_CONF ['PATH_VIRTUAL'];?>js/agenda/rules.js" type="text/javascript"></script>
<script src="<?=$_CONF ['PATH_VIRTUAL'];?>js/agenda/agenda.js" type="text/javascript"></script>

<script src="<?=$_CONF ['PATH_VIRTUAL'];?>js/extra/rules.js" type="text/javascript"></script>
<script src="<?=$_CONF ['PATH_VIRTUAL'];?>js/extra/extra.js" type="text/javascript"></script>

<script src="<?=$_CONF ['PATH_VIRTUAL'];?>js/ajuda/rules.js" type="text/javascript"></script>
<script src="<?=$_CONF ['PATH_VIRTUAL'];?>js/ajuda/ajuda.js" type="text/javascript"></script>

<script src="<?=$_CONF ['PATH_VIRTUAL'];?>js/configuracao/rules.js" type="text/javascript"></script>
<script src="<?=$_CONF ['PATH_VIRTUAL'];?>js/configuracao/configuracao.js" type="text/javascript"></script>


<title><?=$_CONF ['nome_loja']?></title>

</head>

<body
	onload="javascript:<?=((isset ( $_SESSION ['update_codigo'] ) && (count ( $_SESSION ['update_codigo'] ) > 0)) ? 'carrega_atualizacao()"' : 'carrega_inicial_rvs()');?>;">

<div id="versaoimpressao"></div>

<div class="all" id="apagarimprimir">
<div id="dhtmltooltip"></div>
<table width="100%" height="100%" border="0" cellpadding="0"
	cellspacing="0">
	<tr>
		<td align="center" valign="top">

		<table width="1000" height="600" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td align="center" valign="top">

				<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td style="padding: 0 15px 0 15px; height: auto; overflow: hidden;">

						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td align="left" valign="middle" width="250"><a href="index.php"><img src="imgs/logo.jpg" height="66" title="Ir para página inicial" alt="Ir para página inicial" /></a></td>
								<td align="right" valign="top" width="210">

								<table border="0" cellspacing="0" cellpadding="0" style="width: 210px">
									<tr>
										<td align="center"><a href="index.php"><img src="imgs/ASC - Ajax Sales Cloud.jpg" title="Ir para página inicial" alt="Ir para página inicial" /></a></td>
									</tr>
									<tr>
										<td align="right">

										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td align="center" width="100">
                                            		<? if ($fechamento == 'FECHADO') { ?>
                                            		<div id="abrir_turno" style="cursor: pointer; cursor: hand;" onclick="javascript:carrega_abrirturno();">
													<div id="btns"><img src="imgs/btn_left.jpg" style="float: left;">
													<p class="botoes"><a href="#" style="text-decoration: none; color: green;">Abrir Turno</a></p>
													<img src="imgs/btn_right.jpg" style="float: left;"></div>
													</div>
													<? } ?>
                                            	</td>
												<td align="center">
												<div id="sair_ASC - Ajax Sales Cloud" style="cursor: pointer; cursor: hand;" onclick="javascript:location.href='logoff.php';">
												<div id="btns"><img src="imgs/btn_left.jpg" style="float: left;">
												<p class="botoes"><a href="#" style="text-decoration: none;">Sair</a></p>
												<img src="imgs/btn_right.jpg" style="float: left;"></div>
												</div>
												</td>
											</tr>
										</table>
										</td>
									</tr>
								</table>
								</td>
							</tr>
						</table>

						</td>
					</tr>
					<tr>
						<td background="imgs/001.jpg" style="padding: 0 15px 0 15px; height: 41px; overflow: hidden;">

							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td align="left" valign="middle"><p id="pathsistema">&nbsp;&nbsp;&nbsp;<b>LOGADO : <?=$_SESSION ['nomeuser'];?></b></p></td>
									<td align="right">
										<table>
											<tr>
												<?if ($permissoes [0]) {?>
												<td><a href="javascript:;" onclick="javascript:carrega_listagemcliente();">[ clientes ]</a></td>
												<? }
												if ($permissoes [1]) {
												?>
												<td><a href="javascript:;" onclick="javascript:carrega_listagemprodutos('modulos/produto/lista.php','conteudo_total');">[ produtos ]</a></td>
												<? }
												if ($fechamento == 'ABERTO') {
												if ($permissoes [5]) {
												?>
												<td><a href="javascript:;" onclick="javascript:carrega_efetuarvenda('modulos/venda/seleciona_produto.php','normal');">[ venda normal ]</a></td>
												<? }
												if ($permissoes [6]) {
												?>
												<td><a href="javascript:;" onclick="javascript:carrega_efetuarvenda('modulos/venda/seleciona_produto.php','vip');">[ venda vip ]</a></td>
												<? } } ?>
											</tr>
										</table>
									</td>
									<td width="150" align="right" valign="middle"> <p><b><?=$turno;?> TURNO : </b> <B style="color: <?=($fechamento == 'ABERTO') ? 'green' : 'red';?>"><?=($fechamento == 'ABERTO') ? 'ABERTO' : 'FECHADO';?></B>&nbsp;&nbsp;&nbsp;</p></td>
								</tr>
							</table>

						</td>
					</tr>
					<tr>
						<td align="center" valign="middle" background="imgs/002.jpg" style="padding: 0 15px 0 15px; height: 30px; overflow: hidden;">
							<div id="menu_ASC - Ajax Sales Cloud">
								<table>
									<td align="center"><a href="#" onclick="return dropdownmenu(this, event, menu_cadastro, '130px', this.id);" onMouseout="javascript:delayhidemenu();" id="menu_cadastro" class="menu_a">Cadastro&nbsp;(F2)</a></td>
									<td width="10"></td>
									<td align="center"><a href="#" onclick="return dropdownmenu(this, event, menu_vendas, '130px', this.id);" onMouseout="javascript:delayhidemenu();" id="menu_vendas" class="menu_a">Vendas&nbsp;(F3)</a></td>
									<td width="10"></td>
									<td align="center"><a href="#" onclick="return dropdownmenu(this, event, menu_financeiro, '130px', this.id);" onMouseout="javascript:delayhidemenu();" id="menu_financeiro" class="menu_a">Financeiro&nbsp;(F4)</a></td>
									<td width="10"></td>
									<td align="center"><a href="#" onclick="return dropdownmenu(this, event, menu_relatorios, '130px', this.id);" onMouseout="javascript:delayhidemenu();" id="menu_relatorios" class="menu_a">Relat&oacute;rios&nbsp;(F6)</a></td>
									<td width="10"></td>
									<td align="center"><a href="#" onclick="return dropdownmenu(this, event, menu_util, '130px', this.id);" onMouseout="javascript:delayhidemenu();" id="menu_util" class="menu_a">Utilit&aacute;rios&nbsp;(F7)</a></td>
									<td width="10"></td>
									<td align="center"><a href="#" onclick="return dropdownmenu(this, event, menu_config, '130px', this.id);" onMouseout="javascript:delayhidemenu();" id="menu_config" class="menu_a">Configura&ccedil;&otilde;es&nbsp;(F8)</a></td>
									<td width="10"></td>
									<td align="center"><a href="#" onclick="return dropdownmenu(this, event, menu_ajuda, '130px', this.id);" onMouseout="javascript:delayhidemenu();" id="menu_ajuda" class="menu_a">Ajuda&nbsp;(F1)</a></td>
								</table>
							</div>
						</td>
					</tr>
					<tr>
						<td align="left" valign="top" background="imgs/all.jpg" style="padding: 0 15px 0 15px; height: 473px; overflow: hidden; position: relative;" align="center">