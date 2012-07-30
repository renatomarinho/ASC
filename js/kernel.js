/*
<meta name="nome_fake" content="Systema">
<meta name="nome_rvs" content="kernel.js">
<meta name="localizacao" content="/js">
<meta name="descricao" content="Correcoes.">
</head>
*/


/*
 * TODO Funcoes necessarias para todo o sistema
 */

var kernel = {
		
	dge : function (el){
		return document.getElementById(el);
	},

	blockNone : function (obj){
		if (obj.constructor.toString().indexOf("Array") == -1){
			obj.style.display = (obj.style.display=='none')?'block':'none';
		}else{
			for(el in obj){
				obj[el].style.display = (obj[el].style.display=='none')?'block':'none';
			}
		}
	}
		
};





/* Variaveis Pagamento */
var dinheiro=0,cheque=0,debito=0,credito=0,totalcompra=0;totalpago=0;marcados=0;


function limpa_area(idelement){
	var conteudo_total = document.getElementById('conteudo_total');
	conteudo_total.style.display = 'block';
	var conteudo_esquerdo = document.getElementById('conteudo_esquerdo');
	conteudo_esquerdo.style.display = 'block';
	var conteudo_direito = document.getElementById('conteudo_direito');
	conteudo_direito.style.display = 'block';
	var element = document.getElementById(idelement);
	element.style.display = 'none';
	element.innerHTML = '';
}

function carregar_get(idelement, url){
	//limpa_area();
	var element = document.getElementById(idelement);
	element.style.display = 'block';
	element.innerHTML = loading_dados;
    xmlhttp.open("GET", path+url);
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
    		element.innerHTML = xmlhttp.responseText;
    		carregar_get_status_return = true;
    	}
    }
    xmlhttp.send(null);
}

function modificar_tamanho(idelement1, tamanho1, idelement2, tamanho2, optvisible, optinvisible){

	var element1 = document.getElementById(idelement1);
	element1.style.height = tamanho1+'px';
	var element2 = document.getElementById(idelement2);
	element2.style.height = tamanho2+'px';

	var element3 = document.getElementById(optvisible);
	element3.style.display = 'block';
	var element4 = document.getElementById(optinvisible);
	element4.style.display = 'none';

}



/**
*	Autentica��o do software e atualiza��es
**/

function autentica_software(){
	/*
	xmlhttp.open("GET", path+'modulos/atualizacao/checa_software.php');
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
    		window.location='index.php';
    	}
    }
    xmlhttp.send(null);
    */
}

var carrega_atualizacao_status = false;
function carrega_atualizacao(){
	if (!carrega_atualizacao_status){
		carrega_atualizacao_status = true;
		var element = document.getElementById('conteudo_esquerdo');
		xmlhttp.open("GET", path+'modulos/atualizacao/checa_atualizacao.php');
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				element.innerHTML = xmlhttp.responseText;
				carrega_atualizacao_status = false;
				carrega_atualizacao_detalhes()
			}
	    }
	    xmlhttp.send(null);
	}
}

var carrega_atualizacao_detalhes_status = false;
function carrega_atualizacao_detalhes(){
	if (!carrega_atualizacao_detalhes_status){
		carrega_atualizacao_detalhes_status = true;
		var element = document.getElementById('conteudo_direito');
		xmlhttp.open("GET", path+'modulos/atualizacao/exibe_arquivo_atualizacao.php');
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				element.innerHTML = xmlhttp.responseText;
				carrega_atualizacao_detalhes_status = false;
			}
	    }
	    xmlhttp.send(null);
	}
}


var barra_time = 100, id_barra_down='', idspan_barra_down='', divmain_barra='', input_dados_arquivo = '', barra_down_largura=0, total_loadings=0,total_loading_atual=0, scroll_altura = -25, status_arquivo=0;
var vetor_p = new Array();
var vetor_span = new Array();
var vetor_div = new Array();
var vetor_input = new Array();
var vetor_erro = new Array();
var vetor_danificados = new Array();

function carrega_loading_arquivos(){

	document.getElementById('msg_atualizacao').innerHTML = '<b style="color:blue;">Atualiza��o do software Real Virtual Store iniciada</b>';

	var x=document.getElementById("conteudo_esquerdo");
	var input = x.getElementsByTagName("input");
	for (loop = 0; loop < input.length; loop++) {
		if (document.getElementById(input[loop].id)){
			document.getElementById(input[loop].id).style.display = 'none';
		}
	}

	diminui_opacidade("conteudo_esquerdo");

	document.getElementById("menu_ASC - Ajax Sales Cloud").style.display = 'none';
	document.getElementById("sair_ASC - Ajax Sales Cloud").style.display = 'none';

	var x=document.getElementById("lista_atualizacoes_arquivos");
	var p = x.getElementsByTagName("p");
	var span_split;
	for (loop = 0; loop<p.length; loop++) {
		span_split = (p[loop].id).split('_');
		vetor_p[loop] = p[loop].id
		vetor_span[loop] = 'msgdown_'+span_split[1];
		vetor_div[loop] = 'main_barra_'+span_split[1];
		vetor_input[loop] = document.getElementById('dados_arquivo_'+span_split[1]).value;
	}
	total_loadings = loop;
	divmain_barra = vetor_div[total_loading_atual];
	id_barra_down = vetor_p[total_loading_atual];
	idspan_barra_down = vetor_span[total_loading_atual];
	input_dados_arquivo = vetor_input[total_loading_atual];
	carrega_loading_movimento();

}

function carrega_loading_movimento(){

	if ( document.getElementById(divmain_barra) ){

		document.getElementById(divmain_barra).style.border = '1px solid #c0c0c0';
		movimento_setinterval=self.setInterval("carrega_loading_movimento_largura()",barra_time);

		var dadosdoarquivo = (input_dados_arquivo).split('-|-');
		
		xmlhttp.open("GET", path+'modulos/atualizacao/download_file.php?a='+dadosdoarquivo[0]+'&h='+dadosdoarquivo[3]+'&l='+dadosdoarquivo[2]);
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    		status_arquivo = xmlhttp.responseText;
	    		barra_down_largura = 190;
			}
	    }
	    xmlhttp.send(null);

	} else {
		window.clearInterval(movimento_setinterval);
		window.clearInterval(verifica_integridade_setinterval);
		carrega_verificao_arquivos_danificados();
	}

}

function carrega_loading_movimento_largura(){

	if ( barra_down_largura == 201 ){

		document.getElementById('lista_atualizacoes_arquivos').scrollTop = scroll_altura;
		scroll_altura = parseInt(scroll_altura) + 25;
		window.clearInterval(movimento_setinterval);
		verifica_integridade_setinterval=self.setInterval("carrega_loading_verifica_arquivo()",250);

	} else {

		document.getElementById(id_barra_down).style.width = barra_down_largura+'px';
		document.getElementById(idspan_barra_down).innerHTML = '<b style="color:#fff;">'+parseInt(barra_down_largura/2)+'%</b>&nbsp;&nbsp;';
		barra_down_largura = parseInt(barra_down_largura)+1;

	}

}

var status_texto = false;

function carrega_loading_verifica_arquivo(){

	carrega_loading_verifica_arquivo_texto();

}

var count_integridade = 0;
var msgatualizacoes='', msgatualizacoes_danificados='', atualizados_fake=1, atualizados_fake_danificados=1;

function carrega_loading_verifica_arquivo_texto(){


	if (!status_texto){
		document.getElementById(idspan_barra_down).innerHTML = '<label style="color:#fff;letter-spacing:1px;">verificando integridade</label>&nbsp;&nbsp;';
		status_texto = true;
		count_integridade++
	}else{
		document.getElementById(idspan_barra_down).innerHTML = '';
		status_texto = false;
	}

	if ( count_integridade == 5 && total_loadings > total_loading_atual ){

		if ( status_arquivo == 1 ){
			document.getElementById(idspan_barra_down).innerHTML = '<label style="color:#fff;letter-spacing:1px;">atualiza��o efetuada</label>&nbsp;&nbsp;';
			document.getElementById(id_barra_down).style.backgroundColor = 'green';
			msgatualizacoes = '<b style="color:green">'+atualizados_fake+' arquivo'+((atualizados_fake>1)?'s':'')+' fo'+((atualizados_fake>1)?'ram':'i')+' atualizado'+((atualizados_fake>1)?'s':'')+'</b>';
			atualizados_fake++;
		} else {
			document.getElementById(idspan_barra_down).innerHTML = '<label style="color:#fff;letter-spacing:1px;">ocorreu um erro</label>&nbsp;&nbsp;';
			document.getElementById(id_barra_down).style.backgroundColor = 'red';
			vetor_danificados[total_loading_atual] = input_dados_arquivo+'-|-'+total_loading_atual;
			msgatualizacoes_danificados = '<b style="color:red">'+atualizados_fake_danificados+' arquivo'+((atualizados_fake_danificados>1)?'s':'')+' est'+((atualizados_fake_danificados>1)?'�o':'�')+' danificado'+((atualizados_fake_danificados>1)?'s':'')+'</b> ';
			atualizados_fake_danificados++;
		}

		++total_loading_atual;
		window.clearInterval(verifica_integridade_setinterval);
		divmain_barra = vetor_div[total_loading_atual];
		id_barra_down = vetor_p[total_loading_atual];
		idspan_barra_down = vetor_span[total_loading_atual];
		input_dados_arquivo = vetor_input[total_loading_atual];
		barra_down_largura = 0;
		count_integridade = 0;
		carrega_loading_movimento();

		document.getElementById('msgatualizacoes_status').innerHTML = msgatualizacoes + (( atualizados_fake_danificados > 1 && atualizados_fake > 1 )?'&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;':'') + msgatualizacoes_danificados;

	}

}

function carrega_verificao_arquivos_danificados(){
	document.getElementById('linha_atualizacao').style.height = '50px';
	document.getElementById('lista_atualizacoes_arquivos').style.height = '248px';
	document.getElementById('msg_atualizacao').innerHTML = '<input type="button" class="botao" style="cursor:pointer; cursor:hand;width:250px;height:35px;background-color:blue;" value="reiniciar o software Real Virtual Store" onclick="javascript:autentica_software();">';
}

function carregar_atualizacao_depois(){
	carrega_listagemcliente(path+'modulos/cliente/lista.php','conteudo_total');
}



/**
*	Pagina Inicial
**/

var carrega_inicial_rvs_status = false;
function carrega_inicial_rvs(){

	var conteudo_esquerdo = document.getElementById('conteudo_esquerdo');
	conteudo_esquerdo.style.display = 'block';
	conteudo_esquerdo.innerHTML = '';
	var conteudo_direito = document.getElementById('conteudo_direito');
	conteudo_direito.style.display = 'block';
	conteudo_direito.innerHTML = '';
	var conteudo_total = document.getElementById('conteudo_total');
	conteudo_total.style.display = 'none';
	conteudo_total.innerHTML = '';
	var element = document.getElementById('conteudo_esquerdo');
	//element.innerHTML = loading_dados;
	if ( !carrega_inicial_rvs_status ){
		carrega_inicial_rvs_status = true;
    		xmlhttp.open("GET", path+'modulos/extra/inicial_define.php');
    		xmlhttp.onreadystatechange = function() {
    			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					carrega_inicial_rvs_status = false;
					paginas = xmlhttp.responseText;
					paginas = (paginas).split('|');
					carrega_inicial_rvs_esquerda(paginas[0], paginas[1]);
				}
    		}
    	}
    xmlhttp.send(null);
}

function carrega_inicial_rvs_esquerda(pagina_esquerda, pagina_direita){

	xmlhttp.open("GET", path+'modulos/extra/'+pagina_esquerda+'.php');
    		xmlhttp.onreadystatechange = function() {
    			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById('conteudo_esquerdo').innerHTML = xmlhttp.responseText;
					carrega_inicial_rvs_direita(pagina_direita);
				}
    		}
    xmlhttp.send(null);
}

function carrega_inicial_rvs_direita(pagina_direita){

	xmlhttp.open("GET", path+'modulos/extra/'+pagina_direita+'.php');
    		xmlhttp.onreadystatechange = function() {
    			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById('conteudo_direito').innerHTML = xmlhttp.responseText;
				}
    		}
    xmlhttp.send(null);
}


/**
* Financeiro - Fluxo de Caixa
**/
var carrega_financeiro_fluxo_lista_status = false;
function carrega_financeiro_fluxo_lista(){

	var conteudo_esquerdo = document.getElementById('conteudo_esquerdo');
	conteudo_esquerdo.style.display = 'block';
	conteudo_esquerdo.innerHTML = '';
	var conteudo_direito = document.getElementById('conteudo_direito');
	conteudo_direito.style.display = 'block';
	conteudo_direito.innerHTML = '';
	var conteudo_total = document.getElementById('conteudo_total');
	conteudo_total.style.display = 'none';
	conteudo_total.innerHTML = '';
	var element = conteudo_direito;
	//element.innerHTML = loading_dados;
	if ( !carrega_financeiro_fluxo_lista_status )
	{
//		try
//		{
//			conteudo_esquerdo.innerHTML = loading_dados;
//		}
//		catch(err)
//		{
//			alert(err);
//		}

		carrega_financeiro_fluxo_lista_status = true;
    		xmlhttp.open("GET", path+'modulos/financeiro/fluxo_lista.php');
    		xmlhttp.onreadystatechange = function() {
    			if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    			{
    				carrega_financeiro_fluxo_lista_status = false;
					element.innerHTML = xmlhttp.responseText;
					carrega_financeiro_fluxo_adiciona();
				}
    		}
    	}
    xmlhttp.send(null);

}

var carrega_financeiro_fluxo_adiciona_status = false;
function carrega_financeiro_fluxo_adiciona()
{

	var conteudo_esquerdo = document.getElementById('conteudo_esquerdo');
	//conteudo_esquerdo.innerHTML = loading_dados;
	if ( !carrega_financeiro_fluxo_adiciona_status ){

		carrega_financeiro_fluxo_adiciona_status = true;
    		xmlhttp.open("GET", path+'modulos/financeiro/fluxo_adiciona.php');
    		xmlhttp.onreadystatechange = function() {
    			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
    				carrega_financeiro_fluxo_adiciona_status = false;
					conteudo_esquerdo.innerHTML = xmlhttp.responseText;
					load_calendario();
					Behavior.apply();
				}
    		}
    	}
    xmlhttp.send(null);

}

function financeiro_fluxo_exibe_receita(clear)
{
	fluxo_habilita_all();

	document.getElementById('btn_exibe_receita_despesa').value = 'receita';
	document.getElementById('dadosdespesa').style.display = 'none';
	document.getElementById('dadosreceita').style.display = 'block';

	document.getElementById('planosaida').style.display = 'none';
	document.getElementById('planoentrada').style.display = 'block';

	document.getElementById('fornecedorsaida').style.display = 'none';
	document.getElementById('fornecedorentrada').style.display = 'block';

	document.getElementById('fluxo').value = 'receita';
	document.getElementById('mv_financeiro_id').value = '';
	document.getElementById('novo_receita_despesa').style.display = 'none';

	document.getElementById('btn_add_receita_despesa').value = 'adicionar receita';
	document.getElementById('icon_menos_favorecido').style.display = 'block';


	if (clear)
	{
		document.getElementById('numero_documento').value = '';
		document.getElementById('planoentrada').options[0].selected = true;
		document.getElementById('fornecedorentrada').options[0].selected = true;
		document.getElementById('fluxo_valor').value = '';
		document.getElementById('efetuado').options[0].selected = true;
		document.getElementById('descricao').value = '';
	}
}

function financeiro_fluxo_exibe_despesa(clear)
{
	fluxo_habilita_all();

	document.getElementById('btn_exibe_receita_despesa').value = 'despesa';
	document.getElementById('dadosdespesa').style.display = 'block';
	document.getElementById('dadosreceita').style.display = 'none';

	document.getElementById('planosaida').style.display = 'block';
	document.getElementById('planoentrada').style.display = 'none';

	document.getElementById('fornecedorsaida').style.display = 'block';
	document.getElementById('fornecedorentrada').style.display = 'none';

	document.getElementById('fluxo').value = 'despesa';
	document.getElementById('mv_financeiro_id').value = '';
	document.getElementById('novo_receita_despesa').style.display = 'none';

	document.getElementById('btn_add_receita_despesa').value = 'adicionar despesa';

	document.getElementById('icon_menos_favorecido').style.display = 'none';

	if (clear)
	{
		document.getElementById('numero_documento').value = '';
		document.getElementById('planosaida').options[0].selected = true;
		document.getElementById('fornecedorsaida').options[0].selected = true;
		document.getElementById('fluxo_valor').value = '';
		document.getElementById('efetuado').options[0].selected = true;
		document.getElementById('descricao').value = '';
	}
}

function fluxo_habilita_all()
{
	document.getElementById('numero_documento').disabled = false;
	document.getElementById('label_numero_documento').style.color = '#000000';

	document.getElementById('fornecedorentrada').disabled = false;
	document.getElementById('fornecedorsaida').disabled = false;
	document.getElementById('label_favorecido').style.color = '#000000';

	document.getElementById('planoentrada').disabled = false;
	document.getElementById('planosaida').disabled = false;
	document.getElementById('label_plano').style.color = '#000000';

	document.getElementById('periodicidade').disabled = true;
	document.getElementById('label_periodicidade').style.color = '#000000';

	document.getElementById('div_icons_favorecido').style.display = 'block';
	document.getElementById('div_icons_plano').style.display = 'block';
}


function financeiro_fluxo_exibe_receita_despesa(elm)
{
	fluxo_habilita_all();

	if (elm.value == 'despesa')
	{
		return financeiro_fluxo_exibe_receita()
	}

	if (elm.value == 'receita')
	{
		return financeiro_fluxo_exibe_despesa()
	}
}

/*
* Forma de Pagamento
*/

function vendas_vendanormal_init(){

	dinheiro=0;
	cheque=0;
	debito=0;
	credito=0;
	totalcompra=0;
	totalpago=0;
	marcados = 0;
}

function vendas_vendanormal_valortotal()
{
	if (totalcompra==0)
	{
		totalcompra = document.getElementById('valortotalvenda').value;
		totalpago = totalcompra;
	}
}



function vendas_vendanormal_pagdinheiro()
{
	document.getElementById('pagamentocomplemento').innerHTML = '';
	vendas_vendanormal_valortotal()
	exibe_btnconcretizar();

	var pd=document.getElementById('pag_dinheiro');
	pd.style.display=(pd.style.display=='none')?'block':'none';

	Sell.PriceUpdate();
	//vendas_vendanormal_valoratualiza();

}

function vendas_vendanormal_pagdebito()
{
	var pd=document.getElementById('pag_debito');
	var cheque_checkbox = document.getElementById('debito');

	if ( cheque_checkbox.checked )
	{
		confirm = comfirmaClienteSelecionado("");
	  	if (confirm)
		{
			vendas_vendanormal_valortotal()
			exibe_btnconcretizar();
			pd.style.display = 'block';

			Sell.PriceUpdate();
			//vendas_vendanormal_valoratualiza();

	    }
	    else
		{
			pd.style.display = 'none';
			cheque_checkbox.checked = false;
			document.getElementById('pagamentocomplemento').innerHTML =  '<b style="color:red;font-size:18px;">SELECIONE UM CLIENTE PARA PAGAMENTO<br />COM CART�O DE D�BITO</b>';
		}

	}
	else
	{
		
		pd.style.display = 'none';
		exibe_btnconcretizar();
		
		Sell.PriceUpdate();
		
		//vendas_vendanormal_valoratualiza();
	}
}



function vendas_vendanormal_pagcredito(){

	vendas_vendanormal_valortotal()
	exibe_btnconcretizar();

	Sell.PriceUpdate();
	//vendas_vendanormal_valoratualiza();

}


/* Configura��es */

var configuracao_cadastrodebanco_status = false;
function configuracao_cadastrodebanco(){

	var conteudo_direito = document.getElementById('conteudo_direito');
	//conteudo_esquerdo.innerHTML = loading_dados;
	if ( !configuracao_cadastrodebanco_status ){
		configuracao_cadastrodebanco_status = true;
    		xmlhttp.open("GET", path+'modulos/configuracao/cadastro_banco.php');
    		xmlhttp.onreadystatechange = function() {
    			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
    				configuracao_cadastrodebanco_status = false;
					conteudo_direito.innerHTML = xmlhttp.responseText;
				}
    		}
    	}
    xmlhttp.send(null);

}

function configuracao_adicionarbanco(){

	document.getElementById('addbanco').style.display = 'none';
	document.getElementById('salvabanco').style.display = 'block';
	document.getElementById('cadbanco').style.display = 'block';
	document.getElementById('msgcadbanco').innerHTML = '';

}

var configuracao_adicionarbanco_salvar_status = false;
function configuracao_adicionarbanco_salvar(){

	var n = document.getElementById('numero');
    var b = document.getElementById('banco');
	var msg = document.getElementById('msgcadbanco');
	n.style.border = '1px solid '+bg_btn_normal;
	b.style.border = '1px solid '+bg_btn_normal;

	if ( !n.value || !checanumero(n.value, 0) || !b.value ){

		if (!n.value){
			msg.innerHTML = '<b>Preencha o n�mero do banco</b>';
			msg.style.color = 'red';
			n.style.border = '1px solid red';
		} else if (!checanumero(n.value, 0)){
			msg.innerHTML = '<b>Preencha o n�mero do banco corretamente</b>';
			msg.style.color = 'red';
			n.style.border = '1px solid red';
		} else if (!b.value){
			msg.innerHTML = '<b>Preencha o nome do banco</b>';
			msg.style.color = 'red';
			b.style.border = '1px solid red';
		}

	} else {

		msg.innerHTML = '';

		if ( !configuracao_adicionarbanco_salvar_status ){
			configuracao_adicionarbanco_salvar_status = true;
			xmlhttp.open("GET", path+'modulos/configuracao/salvar_banco.php?n='+n.value+'&b='+b.value);
	    	xmlhttp.onreadystatechange = function() {
	    		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    			configuracao_adicionarbanco_salvar_status = false;
	    			n.value = '';
	    			b.value = '';
	    			msg.style.color = 'green';
	    			msg.innerHTML = '<b>BANCO ADICIONADO COM SUCESSO</b>';
	    			document.getElementById('addbanco').style.display = 'block';
					document.getElementById('salvabanco').style.display = 'none';
					document.getElementById('cadbanco').style.display = 'none';
	    			configuracao_lista_banco();
					//conteudo_direito.innerHTML = xmlhttp.responseText;
				}
	    	}
	    }
	    xmlhttp.send(null);

	}

}


function configuracao_lista_banco(){



}


String.prototype.trim = function() {
	return this.replace(/^\s+|\s+$/g,"");
}
String.prototype.ltrim = function() {
	return this.replace(/^\s+/,"");
}
String.prototype.rtrim = function() {
	return this.replace(/\s+$/,"");
}



