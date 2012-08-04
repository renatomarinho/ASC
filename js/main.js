var dias = new Array('Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sabado');
var meses = new Array('','Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');

// etiquetas por pagina
var etiqueta_modelo_6081 = 20;
var etiqueta_modelo_6087 = 80;
var etiqueta_modelo_6089 = 60;

function loading(top,left,right){
	return '<div id="loading" style="padding:10px;margin-top:'+top+'px;margin-left:'+left+'px;margin-right:'+right+'px;text-align:center;background-color:#ccdced;border:#9ab0c6 solid 1px;color:#385674;"><b>CARREGANDO DADOS</b><br><img src="../../imgs/loading.gif"></div>';
}

var loading_dados = '<table width="100%" height="100%"><tr><td align="center"><table cellpadding="5"><tr><td align="center"><b>Carregando</b></td></tr><tr><td align="center"></td></tr><tr><td align="center"><img src="imgs/loading.gif"></td></tr></table></td></tr></table>';
var loading_dados_horizontal = '<table width="100%" height="100%"><tr><td align="center"><b>Carregando</b></td><td align="center"><img src="imgs/loading.gif"></td></tr></table>';

/* Final Default */

var xmlhttp=false;

if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
} else if (window.ActiveXObject) {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}

if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
	xmlhttp = new XMLHttpRequest();
	xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
}

//try {
 //   netscape.security.PrivilegeManager.enablePrivilege("UniversalBrowserRead");
 //  } catch (e) {
 //   alert("Permission UniversalBrowserRead denied.");
 //  }

function SingleXmlHttp(create)
{
	if (create)
	{
		var xmlhttp=false;
		if (window.XMLHttpRequest) {
		    xmlhttp = new XMLHttpRequest();
		} else if (window.ActiveXObject) {
		    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}

		if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
			xmlhttp = new XMLHttpRequest();
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
		}
	}

	return xmlhttp;
}


/* Inicio Cadastro Cliente */

var ordenaporquecliente = 'ASC';
var buscarpor2cliente = 'idcliente';

function pesquisar_cliente(){

	var txtpesquisa = document.getElementById("pesquisacliente").value;

	var buscarporcliente;

	if ( document.getElementById("rdopesquisanome").checked == true){
		buscarporcliente = 'txtnome';
		txtpesquisa = txtpesquisa.toUpperCase();
	} else if ( document.getElementById("rdopesquisacodigo").checked == true ) {
		buscarporcliente = 'idcliente';
	} else if ( document.getElementById("rdopesquisacpf").checked == true ){
		buscarporcliente = 'txtcpf';
	} else if ( document.getElementById("rdopesquisaemail").checked == true ){
		buscarporcliente = 'txtemail';
	} else if ( document.getElementById("rdopesquisatelefone").checked == true ){
		buscarporcliente = 'txttelefone';
	} else if ( document.getElementById("rdopesquisacelular").checked == true ){
		buscarporcliente = 'txtcelular';
	}

	carrega_clientelista(path+'modulos/cliente/busca_cliente.php?c='+buscarporcliente+'&c2='+buscarpor2cliente+'&s='+txtpesquisa+'&order='+ordenaporquecliente);

}

function pesquisar_clienteselecionevenda(){

	var txtpesquisa = document.getElementById("pesquisacliente").value;

	var buscarporcliente;

	if ( document.getElementById("rdopesquisanome").checked == true){
		buscarporcliente = 'txtnome';
		txtpesquisa = txtpesquisa.toUpperCase();
	} else if ( document.getElementById("rdopesquisacodigo").checked == true ) {
		buscarporcliente = 'idcliente';
	} else if ( document.getElementById("rdopesquisacpf").checked == true ){
		buscarporcliente = 'txtcpf';
	} else if ( document.getElementById("rdopesquisaemail").checked == true ){
		buscarporcliente = 'txtemail';
	} else if ( document.getElementById("rdopesquisatelefone").checked == true ){
		buscarporcliente = 'txttelefone';
	} else if ( document.getElementById("rdopesquisacelular").checked == true ){
		buscarporcliente = 'txtcelular';
	}

	carrega_clientelista(path+'modulos/cliente/busca_cliente_selecionevenda.php?c='+buscarporcliente+'&s='+txtpesquisa);

}

function pesquisar_inicio_clienteselecionevenda(){

	var txtpesquisa = document.getElementById("pesquisacliente").value;

	var buscarporcliente;

	if ( document.getElementById("rdopesquisanome").checked == true){
		buscarporcliente = 'txtnome';
		txtpesquisa = txtpesquisa.toUpperCase();
	} else if ( document.getElementById("rdopesquisacodigo").checked == true ) {
		buscarporcliente = 'idcliente';
	} else if ( document.getElementById("rdopesquisacpf").checked == true ){
		buscarporcliente = 'txtcpf';
	} else if ( document.getElementById("rdopesquisaemail").checked == true ){
		buscarporcliente = 'txtemail';
	} else if ( document.getElementById("rdopesquisatelefone").checked == true ){
		buscarporcliente = 'txttelefone';
	} else if ( document.getElementById("rdopesquisacelular").checked == true ){
		buscarporcliente = 'txtcelular';
	}

	carrega_clientelista(path+'modulos/cliente/busca_cliente_inicio_selecionevenda.php?c='+buscarporcliente+'&s='+txtpesquisa);

}

function pesquisar_final_clienteselecionevenda(){

	var txtpesquisa = document.getElementById("pesquisacliente").value;

	var buscarporcliente;

	if ( document.getElementById("rdopesquisanome").checked == true){
		buscarporcliente = 'txtnome';
		txtpesquisa = txtpesquisa.toUpperCase();
	} else if ( document.getElementById("rdopesquisacodigo").checked == true ) {
		buscarporcliente = 'idcliente';
	} else if ( document.getElementById("rdopesquisacpf").checked == true ){
		buscarporcliente = 'txtcpf';
	} else if ( document.getElementById("rdopesquisaemail").checked == true ){
		buscarporcliente = 'txtemail';
	} else if ( document.getElementById("rdopesquisatelefone").checked == true ){
		buscarporcliente = 'txttelefone';
	} else if ( document.getElementById("rdopesquisacelular").checked == true ){
		buscarporcliente = 'txtcelular';
	}

	carrega_clientelista(path+'modulos/cliente/busca_cliente_final_selecionevenda.php?c='+buscarporcliente+'&s='+txtpesquisa);

}

var orderactioncliente = "ASC";

function ordenapor(value, value2){

	var imgs = new Array('issetcod', 'issetnome', 'issettelefone', 'issetemail');

	for ( valueimg in imgs ){
		document.getElementById(imgs[valueimg]).src = path+'imgs/asset.png';
	}

	if ( orderaction == "ASC" ){
		orderaction = "DESC";
		document.getElementById(value2).src = path+'imgs/asset2.png';
	} else {
		orderaction = "ASC";
		document.getElementById(value2).src = path+'imgs/asset.png';
	}

	ordenaporquecliente = orderactioncliente;
	buscarpor2cliente = value;
	pesquisar_cliente();

}

var carrega_clientelista_status = false;
function carrega_clientelista(url){
	var element = document.getElementById('listacliente');
	if ( !carrega_clientelista_status ){
		carrega_clientelista_status = true;
		xmlhttp.open("GET", url);
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				element.innerHTML = xmlhttp.responseText;
				carrega_clientelista_status = false;
			}
	    }
	    xmlhttp.send(null);
	}
}


var marcado_idclientenome = '';

function marca_clienteescolhido(idcliente, idclientenome){

	if ( marcado_idclientenome > '' ){
		document.getElementById(marcado_idclientenome).style.fontWeight = 'normal';
		document.getElementById(marcado_idclientenome).style.backgroundColor = document.getElementById('clienteescolhido_bg_'+idcliente).style.backgroundColor;
		document.getElementById(marcado_idclientenome).style.color = '#000000';
	}

	//tamanho scroll = document.getElementById(idwindowscroll).scrollHeight;
	document.getElementById(idclientenome+idcliente).style.fontWeight = 'bold';
	document.getElementById(idclientenome+idcliente).style.backgroundColor = bg_btn_normal;
	document.getElementById(idclientenome+idcliente).style.color = 'white';

	//if ( idwindowscroll != '' ){
		document.getElementById('lista_todos_clientes').scrollTop = (parseInt(document.getElementById(idclientenome+idcliente).offsetTop)-parseInt(25));
	//}

	marcado_idclientenome = idclientenome+idcliente;

}


function listasimples_cliente(refer, idcliente){
 	var element = document.getElementById('conteudo_esquerdo');
	element.style.display = 'block';
	//element.innerHTML = loading_dados;
    	xmlhttp.open("GET", path+'modulos/cliente/lista_cliente_nome.php?refer='+refer);
    	xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
			marca_clienteescolhido(idcliente, 'clienteescolhido_');
		}
    }
    xmlhttp.send(null);
}

var adicionar_categoria_status = false;
function adicionar_categoria(){
	if (!adicionar_categoria_status){
		adicionar_categoria_status = true;
		var element = document.getElementById('conteudo_esquerdo');
		//element.innerHTML = loading_dados;
	    xmlhttp.open("GET", path+'modulos/produto/categoria_adicionar.php');
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				element.innerHTML = xmlhttp.responseText;
				adicionar_categoria_status = false;
			}
	    }
	    xmlhttp.send(null);
	}
}

var comparar_colecoes_status = false;
function comparar_colecoes(){
	var element = document.getElementById('conteudo_direito');
	//element.innerHTML = loading_dados;
	if ( !comparar_colecoes_status ){
		comparar_colecoes_status = true;
	    xmlhttp.open("GET", path+'modulos/colecao/colecao_comparar.php');
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				element.innerHTML = xmlhttp.responseText;
				comparar_colecoes_status = false
			}
	    }
	    xmlhttp.send(null);
	}
}

var cadastro_fornecedor_comparar_status = false;
function cadastro_fornecedor_comparar(){
	var element = document.getElementById('conteudo_direito');
	//element.innerHTML = loading_dados;
	if ( !cadastro_fornecedor_comparar_status ){
		cadastro_fornecedor_comparar_status = true;
	    xmlhttp.open("GET", path+'modulos/fornecedor/fornecedor_comparar.php');
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				element.innerHTML = xmlhttp.responseText;
				cadastro_fornecedor_comparar_status = false
			}
	    }
	    xmlhttp.send(null);
	}
}

var adicionar_colecao_status = false;
function adicionar_colecao(url){
	if (!adicionar_colecao_status){
		adicionar_colecao_status = true;
		var element = document.getElementById('conteudo_esquerdo');
		//element.innerHTML = loading_dados;
	    xmlhttp.open("GET", url);
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				element.innerHTML = xmlhttp.responseText;
				adicionar_colecao_status = false;
			}
	    }
	    xmlhttp.send(null);
	}
}

var carrega_emissaoetiqueta_status = false;
function carrega_emissaoetiqueta(){
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
	if ( !carrega_emissaoetiqueta_status ){
		carrega_emissaoetiqueta_status = true;
    		xmlhttp.open("GET", path+'modulos/utilitario/etiqueta_opcoes.php');
    		xmlhttp.onreadystatechange = function() {
    			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				element.innerHTML = xmlhttp.responseText;
				carrega_emissaoetiqueta_status = false;
				geraretiqueta();
			}
    		}
    	}
    xmlhttp.send(null);
}

function etiqueta_produto()
{
	var opc_prod_especifico = document.getElementById('prod_especifico');
	var ecodbarra = document.getElementById('ecodbarra');

	var opc_prod_todos =document.getElementById('prod_todos');
	var div_categoria = document.getElementById('div_categoria');

	if (opc_prod_especifico.checked && ecodbarra.style.display == 'none')
	{
		div_categoria.style.display = 'none';

		document.getElementById('produtotipo_id').value = '';
		document.getElementById('fornecedor_id').value = '';
		document.getElementById('colecao_id').value = '';

		ecodbarra.style.display = 'block';
		document.getElementById('codbarra').focus();
	}
	else
	{
		div_categoria.style.display = 'block';

		ecodbarra.style.display = 'none';
		document.getElementById('codbarra').value = '';
	}
}

function etiqueta_cliente_todos(){
	document.getElementById('etiquetaporestado').style.display = 'none';
	document.getElementById('etiquetapormes').style.display = 'none';
}

function etiqueta_cliente_estado(){
	var btn = document.getElementById('cliente_estado');
	var eestado = document.getElementById('etiquetaporestado');
	if (btn.checked && eestado.style.display == 'none'){
		eestado.style.display = 'block';
		document.getElementById('etiquetapormes').style.display = 'none';
	} else {
		eestado.style.display = 'none';
	}
}

function etiqueta_cliente_mes(){
	var btn = document.getElementById('cliente_mes');
	var emes = document.getElementById('etiquetapormes');
	if (btn.checked && emes.style.display == 'none'){
		emes.style.display = 'block';
		document.getElementById('etiquetaporestado').style.display = 'none';
	} else {
		emes.style.display = 'none';
	}
}

function cliente_voltar_venda()
{
	//retornando dados da venda
	document.getElementById('conteudo_esquerdo').innerHTML = document.getElementById('conteudo_esquerdo_tmp').innerHTML;
	document.getElementById('conteudo_esquerdo_tmp').innerHTML = '';

	document.getElementById('conteudo_direito').innerHTML = document.getElementById('conteudo_direito_tmp').innerHTML;
	document.getElementById('conteudo_direito_tmp').innerHTML = '';

}

function adicionar_cliente_obs(venda)
{
	// armazenando venda
	if (venda)
	{
		document.getElementById('conteudo_esquerdo_tmp').innerHTML = document.getElementById('conteudo_esquerdo').innerHTML;
		document.getElementById('conteudo_direito_tmp').innerHTML = document.getElementById('conteudo_direito').innerHTML;
	}

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
    	xmlhttp.open("GET", path+'modulos/cliente/cliente_adicionar_obs.php');
    	xmlhttp.onreadystatechange = function()
    	{
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
			adicionar_cliente(venda);
		}
    }
    xmlhttp.send(null);
}

function geraretiqueta(){
	var conteudo_direito = document.getElementById('conteudo_direito');
	conteudo_direito.style.display = 'block';
	conteudo_direito.innerHTML = '';
	xmlhttp.open("GET", path+'modulos/utilitario/etiqueta_gerar.php');
    	xmlhttp.onreadystatechange = function() {
    		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			conteudo_direito.innerHTML = xmlhttp.responseText;
		}
    }
    xmlhttp.send(null);
}


function etiquetaclienteimpressao(nome,endereco,bairro,cidade,estado,cep)
{
	var astr;

	nome	= nome ? nome : '';
	endereco= endereco ? endereco : '';
	//bairro	= bairro ? (endereco ? ' - ' : '') + bairro : '';
	bairro	= bairro ? (endereco ? ' - ' : '') + bairro : '';
	cidade	= cidade ? cidade : '';
	estado	= estado ? (cidade ? ' - ' : '') + estado : '';
	cep		= cep ? ((cidade || estado) ? ' - ' : '') + ' CEP: ' + cep : '';

	astr = '<center><table border="0" width="350" cellpadding="0" cellspacing="2" ><tr><td><b style="font-family:Verdana,sans serif;font-size:14px">' + nome + '</b></td></tr>';
	astr += '<tr><td style="font-family:Verdana,sans serif;font-size:12px">' + endereco +bairro + '</td></tr>';
	astr += '<tr><td style="font-family:Verdana,sans serif;font-size:12px">' + cidade + estado + cep + '</td></tr></table></center>';

	astr = '<table border="0"  width="100%" height="100%" cellpadding="0" cellspacing="0"><tr><td valign="middle" align="center">' + astr + '</td></tr></table>';

	return astr;
}


function etiquetaprodutoimpressao(prod,cod, preco, view_ean){

	alfabet = new Array('AAAAAACCCCCC','AABABBCCCCCC','AABBABCCCCCC','AABBBACCCCCC','ABAABBCCCCCC','ABBAABCCCCCC','ABBBAACCCCCC','ABABABCCCCCC','ABABBACCCCCC','ABBABACCCCCC');
  	acode = new Array('0001101','0011001','0010011','0111101','0100011','0110001','0101111','0111011','0110111','0001011');
  	bcode = new Array('0100111','0110011','0011011','0100001','0011101','0111001','0000101','0010001','0001001','0010111');
  	ccode = new Array('1110010','1100110','1101100','1000010','1011100','1001110','1010000','1000100','1001000','1110100');
  	value = new Array('0','1','2','3','4','5','6','7','8','9');

  	ean = cod;
  	eanok = (ean != null);
  	if (eanok) eanok = (ean != "");
	if (eanok) {
		chksum = 0;
		code = ean;
		for (i = 0; i < ean.length; i++) {
			v = -1;
			for (j = 0; j < value.length; j++) {
  				if (value[j] == ean.charAt(i)) {
    					if (i % 2 == 0) {
      					v=j;
    					} else {
      					v=3*j;
    					}
  				}
			}
			chksum += v;
		}

		chksum = chksum % 10;
		chksum = (10 - chksum) % 10;
		ean = ean + value[chksum];

		for (i=0; i<value.length; i++) {
			if (value[i] == ean.charAt(0)) {
  				alfstr = alfabet[i];
			}
 		}

		wstr = "101";

		for (i = 0; i < 6; i++) {
			if (alfstr.charAt(i) == "A") {
  				wstr += acode[ean.charAt(i+1)];
			}
			if (alfstr.charAt(i) == "B") {
  				wstr += bcode[ean.charAt(i+1)];
			}
		}

		wstr += "01010";

		for (i = 6; i < 12; i++) {
  			wstr += ccode[ean.charAt(i+1)];
		}

		wstr += "101";

		if (preco != '')
		{
			preco = ' ('+preco+')';
			prod = prod.substring(0,33);
		}
		else
		{
			prod = prod.substring(0,39);
			preco = '';
		}

		var astr = '';
		astr += '\n<div align="center" id="etiqueta_produto" style="border:1px solid white;display:block;">';

		astr +='<div align="center" id="etiqueta_titulo_cod_barra">'+prod + preco+'</div>';
		//astr +='<div >||</div>';

		for (i = 0; i < wstr.length; i++)
		{
			astr +=  '<img height="40px" width="1px" src="'+path+'imgs/Pbc-' + wstr.charAt(i) + '.png" alt="' + wstr.charAt(i) + '" class="etiqueta_codigo_barra" style="margin-top:2px;cursor:pointer">';
		}

		if (view_ean)
		{
			astr +='<div align="center" id="etiqueta_cod_ean"><B style="font-family:Verdana;">' + ean + '</B></div>';
		}

		astr += '\n</div><!--etiqueta_produto-->';
		//alert(astr);
		return astr;

  	}
}

var geraretiqueta_impressao_status = false;

function geraretiqueta_impressao_produto()
{

	var vlatacado = document.getElementById('vlatacado').checked;
	var vlpentrega = document.getElementById('vlpentrega').checked;
	var vlvarejo = document.getElementById('vlvarejo').checked;

	var prod_especifico = document.getElementById('prod_especifico').checked;
	var produtotipo_id  = document.getElementById('produtotipo_id').value;
	var fornecedor_id	= document.getElementById('fornecedor_id').value;
	var colecao_id		=  document.getElementById('colecao_id').value;

	var prod_todos = document.getElementById('prod_todos').checked;
	var codbarra = document.getElementById('codbarra');
	var etiqueta_modelo		= document.getElementById('etiqueta_modelo').value;



	var view_ean = true;

	// setando Stilo da para etiqueta
	setEtiquetaStyleSheet(etiqueta_modelo, true);

	var msgerro = document.getElementById('msgerro');

	if ( prod_especifico && !codbarra.value ){
		codbarra.style.border = '1px solid red';
		msgerro.innerHTML = '<b style="color:red">Preencha o Cód. Barra do produto</b>';
		return;
	}

	codbarra.style.border = '1px solid '+bg_btn_normal;
	msgerro.innerHTML = '';

	var params = 'vla='+vlatacado+'&vle='+vlpentrega+'&vlv='+vlvarejo+'&pes='+prod_especifico+'&pto='+prod_todos+'&cod='+codbarra.value+'&produtotipo_id='+produtotipo_id+'&fornecedor_id='+fornecedor_id+'&colecao_id='+colecao_id;

	try
	  {
		//document.getElementById('flash').innerHTML = '<div style="float:left;">Gerando etiqueta . . .</div><div align="left"><img src="imgs/mozilla_blu.gif" /></div>';
		document.getElementById('flash').innerHTML = loading_dados_horizontal;
		document.getElementById('divgerandoetiqueta').innerHTML = '';
		document.getElementById('versaoimpressao').innerHTML = '';
	  }
	catch(err)
	  {
	  txt="There was an error on this page.\n\n";
	  txt+="Error description: " + err.description + "\n\n";
	  txt+="Click OK to continue.\n\n";
	  }

	if (!geraretiqueta_impressao_status){
		geraretiqueta_impressao_status = true;
		xmlhttp.open("POST", path+'modulos/utilitario/etiqueta_dados.php', true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.setRequestHeader("Content-length", params.length);
		xmlhttp.setRequestHeader("Connection", "close");
		xmlhttp.onreadystatechange = function() {
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				geraretiqueta_impressao_status = false;
				var retorno = xmlhttp.responseText;
				retorno = retorno.split('+||+');

				var totaletiquetas = retorno[0];
				retorno = retorno[1].split('+|+');

				var codigobarra, nomeproduto, aberto, preco, html='';

				var html='';

				switch(etiqueta_modelo)
				{
					case 'etiqueta_6087':
					  etiqueta_pagina = etiqueta_modelo_6087;
					  view_ean = false;
					  break;
					case 'etiqueta_6089':
					  etiqueta_pagina = etiqueta_modelo_6089;
					  break;
					default:
					  etiqueta_pagina = 0;
				}

				total=0;

				if (totaletiquetas > 0)
				{
					html= '\n<div id="margintop"></div><div id="separabloco">';
					for(y=0; y < totaletiquetas; y++)
					{
						if ( etiqueta_pagina == total)
						{
							html += '\n</div><!--separabloco--><br /><div id="etiqueta_quebra_pagina"></div><!--quebra-->\n<div id="margintop2"></div><div id="separabloco">';
							total = 0;
						}

						html += '\n\t<div id="daespaco">\n\t\t<div id="separacao">';

						aberto = retorno[y].split('|');
						codigobarra = aberto[0];
						nomeproduto = aberto[1];
						preco = aberto[2];

						html += etiquetaprodutoimpressao(nomeproduto, codigobarra, preco,view_ean);

						html += '\n\t</div><!--separacao-->\n\t\t</div><!--daespaco-->';
						total ++;

					}

					html += '\n</div><!--separabloco--><br />';

					document.getElementById('divgerandoetiqueta').innerHTML = html;
					document.getElementById('versaoimpressao').innerHTML = html;
					flash('Etiqueta gerada com sucesso.');
					enablePrintBnt();
				}
				else
				{
					enablePrintBnt(false);
					flash('Não foi possível gerar etiquetas com o filtro selecionado.', 'erro');
				}
			}
		}
		xmlhttp.send(params);
	}

}

/**
 * Gera etiqueta de clientes
 */
function geraretiqueta_impressao_cliente()
{

	var nome 				= document.getElementById('nome').checked;
	var bairro 				= document.getElementById('bairro').checked;
	var estado 				= document.getElementById('estado').checked;
	var endereco 			= document.getElementById('endereco').checked;
	var cidade 				= document.getElementById('cidade').checked;
	var cep 				= document.getElementById('cep').checked;
	var dtcadastro 			= document.getElementById('dtcadastro').checked;

	var cliente_todos 		= document.getElementById('cliente_todos').checked;

	var cliente_estado 		= document.getElementById('cliente_estado').checked;
	var sel_estado 			= document.getElementById('sel_estado');

	var cliente_mes 		= document.getElementById('cliente_mes').checked;
	var mes_niver 				= document.getElementById('mes_niver');

	var etiqueta_modelo		= document.getElementById('etiqueta_modelo').value;

	// setando Stilo da para etiqueta
	setEtiquetaStyleSheet(etiqueta_modelo, true);

	var msgerro = document.getElementById('msgerro');

	if ( cliente_estado && sel_estado.value == '0')
	{
		sel_estado.style.border = '1px solid red';
		msgerro.innerHTML = '<b style="color:red">Selecione um estado específico</b>';
		return;
	}


	if ( cliente_mes && mes_niver.value == '0')
	{
		mes_niver.style.border = '1px solid red';
		msgerro.innerHTML = '<b style="color:red">Selecione o mês de aniversário</b>';
		return;
	}

	msgerro.innerHTML = '';

	var params = 'nome='+nome+'&bairro='+bairro+'&estado='+estado+'&endereco='+endereco+'&cidade='+cidade+'&cep='+cep+'&dtcadastro='+dtcadastro+'&cliente_todos='+cliente_todos+'&cliente_estado='+cliente_estado+'&sel_estado='+sel_estado.value+'&cliente_mes='+cliente_mes+'&mes_niver='+mes_niver.value+'&etiqueta_modelo='+etiqueta_modelo+'&';


		if (!geraretiqueta_impressao_status)
		{
			try
			  {
				//document.getElementById('flash').innerHTML = '<div style="float:left;">Gerando etiqueta . . .</div><div align="left"><img src="imgs/mozilla_blu.gif" /></div>';
				document.getElementById('flash').innerHTML = loading_dados_horizontal;
				document.getElementById('divgerandoetiqueta').innerHTML = '';
				document.getElementById('versaoimpressao').innerHTML = '';
			  }
			catch(err)
			  {
			  txt="There was an error on this page.\n\n";
			  txt+="Error description: " + err.description + "\n\n";
			  txt+="Click OK to continue.\n\n";

			  }

			geraretiqueta_impressao_status = true;
			xmlhttp.open("POST", path+'modulos/utilitario/etiqueta_dados_mailling.php', true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.setRequestHeader("Content-length", params.length);
			xmlhttp.setRequestHeader("Connection", "close");
			xmlhttp.onreadystatechange = function() {
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					geraretiqueta_impressao_status = false;

					var retorno = xmlhttp.responseText;
					//flash(retorno);
					//return;
					retorno = retorno.split('+||+');

					var totaletiquetas = retorno[0];
					retorno = retorno[1].split('+|+');

					var html='';

					// esse valor deve ser setado, pois para cada etiqueta tem sua quantidade
					// como a etique para cliente s� tem uma esse valor ta fixo
					etiqueta_pagina = etiqueta_modelo_6081;
					total=0;

					if (totaletiquetas > 0)
					{
						html = '\n<div id="margintop"></div><div id="separabloco">';
						
						for(y=0; y < totaletiquetas; y++)
						{
							if ( etiqueta_pagina == total)
							{
								html += '\n</div><br /><div id="etiqueta_quebra_pagina"></div>\n<div id="margintop2"></div><div id="separabloco">';
								total = 0;
							}

							html += '\n\t<div id="daespaco">\n\t\t<div id="separacao">';

							aberto		= retorno[y].split('|');
							nome		= nome		? aberto[0] : false;
							endereco	= endereco	? aberto[1] : false;
							bairro		= bairro	? aberto[2] : false;
							cidade		= cidade	? aberto[3] : false;
							estado		= estado	? aberto[4] : false;
							cep			= cep		? aberto[5] : false;

							html += etiquetaclienteimpressao(nome,endereco,bairro,cidade,estado,cep);

							html += '</div>\n\t</div>';
							total ++;

						}

						html += '\n</div><br />';

						document.getElementById('divgerandoetiqueta').innerHTML = html;
						document.getElementById('versaoimpressao').innerHTML = html;
						flash('Etiqueta gerada com sucesso.', 'noticia');
						enablePrintBnt();
					}
					else
					{
						enablePrintBnt(false);
						flash('Não foi possível gerar etiquetas com o filtro selecionado.', 'erro');
					}

				}
			}
			xmlhttp.send(params);
	}

}


var adicionar_outro_cliente_status = false;
function adicionar_outro_cliente(){
	if (!adicionar_outro_cliente_status){
		adicionar_outro_cliente_status = true;
		var element = document.getElementById('conteudo_direito');
		xmlhttp.open("GET", path+'modulos/cliente/cliente_adicionar.php');
	    	xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				element.innerHTML = xmlhttp.responseText;
				adicionar_outro_cliente_status = false;
			}
	    	}
	    	xmlhttp.send(null);
	}
}


function habilita_botaovincular()
{

	var x=document.getElementById("listaprodutosemcolecao");
	var input = x.getElementsByTagName("input");
	var i = 0;
	for (loop = 0; loop < input.length; loop++) {
		if (document.getElementById(input[loop].id).checked){
			i++;
		}
	}

	if ( i > 0 )
	{
		document.getElementById('btnvincularprodutos_sel').style.display = 'block';
	} else {
		document.getElementById('btnvincularprodutos_sel').style.display = 'none';
	}

}

function cadastro_fornecedor_vincularproduto_sel(){

	var x=document.getElementById("listaprodutosem");
	var input = x.getElementsByTagName("input");
	var i_produto = 0, i_fornecedor = 0;
	var conteudo;
	var vetor = new Array();
	for (loop = 0; loop<input.length; loop++) {
		if (document.getElementById(input[loop].id).checked){
			conteudo = (document.getElementById(input[loop].id).id).split('_');
			vetor[loop] = conteudo[1];
			i_produto++;
		}
	}

	var conteudo_produto='', conteudo_html_produto='', conteudo_html_fornecedor='';
	var prods = '';

	for (loop=0; loop<vetor.length; loop++){

		if (document.getElementById('conteudo_'+vetor[loop])){

			conteudo_split = (document.getElementById('produto_'+vetor[loop]).value).split(':|:');
			conteudo_html_produto += '<table width="100%" cellpadding="0" cellspacing="0">';
			conteudo_html_produto += '<tr style="cursor:pointer;cursor:hand;" onClick="javascript:listasimples_historicoproduto(\'?exibe=btnfornecedor&id='+conteudo_split[0]+'\',\'fornecedor\');">';
			conteudo_html_produto += '<td width="10" height="25"></td>';
			conteudo_html_produto += '<td width="145">'+conteudo_split[1]+'</td>';
			conteudo_html_produto += '<td width="30" align="center">'+conteudo_split[2]+'</td>';
			conteudo_html_produto += '<td width="70" align="right">'+conteudo_split[3]+'</td>';
			conteudo_html_produto += '<td width="70" align="right">'+conteudo_split[5]+'</td>';
			conteudo_html_produto += '<td width="70" align="right">'+conteudo_split[4]+'</td>';
			conteudo_html_produto += '<td width="70" align="right">'+conteudo_split[6]+'</td>';
			conteudo_html_produto += '<td width="10"></td>';
			conteudo_html_produto += '</tr>';
			conteudo_html_produto += '<tr>';
			conteudo_html_produto += '<td colspan="8" style="border-bottom: 1px solid #c0c0c0;"></td>';
			conteudo_html_produto += '</tr>';
			conteudo_html_produto += '</table>';

			prods += '|'+conteudo_split[0];

			if ( !(document.getElementById('fornec_'+conteudo_split[7])) ){

				if ( conteudo_split[8] != '' ){

					conteudo_html_fornecedor += '<table width="100%" cellpadding="0" cellspacing="0">';
					conteudo_html_fornecedor += '<tr style="cursor:pointer; cursor:hand;" onClick="javascript:listasimples_historicoproduto(\'?exibe=btnfornecedor&id='+conteudo_split[7]+'\',\'fornecedor\');">';
					conteudo_html_fornecedor += '<td width="10" height="25"><input type="hidden" id="fornec_'+conteudo_split[7]+'"></td>';
					conteudo_html_fornecedor += '<td>'+conteudo_split[8]+'</td>';
					conteudo_html_fornecedor += '<td align="right">'+conteudo_split[9]+'</td>';
					conteudo_html_fornecedor += '<td width="10"></td>';
					conteudo_html_fornecedor += '</tr>';
					conteudo_html_fornecedor += '<tr>';
					conteudo_html_fornecedor += '<td colspan="4" style="border-bottom: 1px solid #c0c0c0;"></td>';
					conteudo_html_fornecedor += '</tr>';
					conteudo_html_fornecedor += '</table>';

				}

			}

			document.getElementById('conteudo_'+vetor[loop]).innerHTML = '';

		}

	}

	var fornecedor_listadeprodutos = document.getElementById('fornecedor_listadeprodutos');
	var fornecedor_listadecolecoes = document.getElementById('fornecedor_listadecolecoes');

	var fornecedor_pontoprodutos = document.getElementById('fornecedor_pontoprodutos');
	var ponto_produto = defineponto_scroll(fornecedor_pontoprodutos);
	fornecedor_listadeprodutos.innerHTML = conteudo_html_produto + fornecedor_listadeprodutos.innerHTML;
	fornecedor_listadecolecoes.innerHTML = conteudo_html_fornecedor + fornecedor_listadecolecoes.innerHTML;
	document.getElementById('fornecedordados_main').scrollTop = ponto_produto-230;

	var idfornecedor = document.getElementById('idfornecedor').value
	xmlhttp.open("GET", path+'modulos/fornecedor/fornecedor_vincular_produto_salvar.php?f='+idfornecedor+'&p='+prods);
	xmlhttp.send(null);
	cadastro_fornecedor_vincularproduto()

}

function carrega_vincularprodutosacolecao(){

	var x=document.getElementById("listaprodutosemcolecao");
	var input = x.getElementsByTagName("input");
	var i_produto = 0, i_fornecedor = 0;
	var conteudo;
	var vetor = new Array();
	for (loop = 0; loop<input.length; loop++) {
		if (document.getElementById(input[loop].id).checked){
			conteudo = (document.getElementById(input[loop].id).id).split('_');
			vetor[loop] = conteudo[1];
			i_produto++;
		}
	}

	var conteudo_produto='', conteudo_html_produto='', conteudo_html_fornecedor='';
	var prods = '';

	for (loop=0; loop<vetor.length; loop++){

		if (document.getElementById('conteudo_'+vetor[loop])){

			conteudo_split = (document.getElementById('produto_'+vetor[loop]).value).split(':|:');
			conteudo_html_produto += '<table width="100%" cellpadding="0" cellspacing="0">';
			conteudo_html_produto += '<tr style="cursor:pointer;cursor:hand;" onClick="javascript:listasimples_historicoproduto(\'?exibe=btncolecao&id='+conteudo_split[0]+'\',\'colecao\');">';
			conteudo_html_produto += '<td width="10" height="25"></td>';
			conteudo_html_produto += '<td width="105">'+conteudo_split[1]+'</td>';
			conteudo_html_produto += '<td width="30" align="center">'+conteudo_split[2]+'</td>';
			conteudo_html_produto += '<td width="80" align="right">'+conteudo_split[3]+'</td>';
			conteudo_html_produto += '<td width="80" align="right">'+conteudo_split[5]+'</td>';
			conteudo_html_produto += '<td width="80" align="right">'+conteudo_split[4]+'</td>';
			conteudo_html_produto += '<td width="80" align="right">'+conteudo_split[6]+'</td>';
			conteudo_html_produto += '<td width="10"></td>';
			conteudo_html_produto += '</tr>';
			conteudo_html_produto += '<tr>';
			conteudo_html_produto += '<td colspan="8" style="border-bottom: 1px solid #c0c0c0;"></td>';
			conteudo_html_produto += '</tr>';
			conteudo_html_produto += '</table>';

			prods += '|'+conteudo_split[0];

			if ( !(document.getElementById('fornec_'+conteudo_split[7])) ){

				if ( conteudo_split[8] != '' ){

					conteudo_html_fornecedor += '<table width="100%" cellpadding="0" cellspacing="0">';
					conteudo_html_fornecedor += '<tr style="cursor:pointer; cursor:hand;" onClick="javascript:listasimples_historicoproduto(\'?exibe=btncolecao&id='+conteudo_split[7]+'\',\'colecao\');">';
					conteudo_html_fornecedor += '<td width="10" height="25"><input type="hidden" id="fornec_'+conteudo_split[7]+'"></td>';
					conteudo_html_fornecedor += '<td>'+conteudo_split[8]+'</td>';
					conteudo_html_fornecedor += '<td align="right">'+conteudo_split[9]+'</td>';
					conteudo_html_fornecedor += '<td width="10"></td>';
					conteudo_html_fornecedor += '</tr>';
					conteudo_html_fornecedor += '<tr>';
					conteudo_html_fornecedor += '<td colspan="4" style="border-bottom: 1px solid #c0c0c0;"></td>';
					conteudo_html_fornecedor += '</tr>';
					conteudo_html_fornecedor += '</table>';

				}

			}

			document.getElementById('conteudo_'+vetor[loop]).innerHTML = '';

		}

	}

	var colecao_listadeprodutos = document.getElementById('colecao_listadeprodutos');
	var colecao_listadefornecedores = document.getElementById('colecao_listadefornecedores');

	var colecao_pontoprodutos = document.getElementById('colecao_pontoprodutos');
	var ponto_produto = defineponto_scroll(colecao_pontoprodutos);
	colecao_listadeprodutos.innerHTML = conteudo_html_produto + colecao_listadeprodutos.innerHTML;
	colecao_listadefornecedores.innerHTML = conteudo_html_fornecedor + colecao_listadefornecedores.innerHTML;
	document.getElementById('colecaodados_main').scrollTop = ponto_produto-230;

	var idcolecao = document.getElementById('idcol').value

	xmlhttp.open("GET", path+'modulos/colecao/colecao_vincular_produto_salvar.php?c='+idcolecao+'&p='+prods);
	xmlhttp.send(null);

        carrega_vincularproduto(idcolecao);

}

function defineponto_scroll(element) {
    var valueAltura = 0;
    do {
      valueAltura += element.offsetTop || 0;
      element = element.offsetParent;
    } while (element);
    return valueAltura;
}

var carrega_vincularproduto_status = false;
function carrega_vincularproduto(value){
	var element = document.getElementById('conteudo_esquerdo');
	//element.innerHTML = loading_dados;
	if ( !carrega_vincularproduto_status ){
		carrega_vincularproduto_status = true;
	    xmlhttp.open("GET", path+'modulos/colecao/colecao_vincular_produto.php');
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    		document.getElementById('btnvincularproduto').style.display = 'none';
	    		document.getElementById('irlistagem_resultado').style.display = 'none';
				element.innerHTML = xmlhttp.responseText;
				carrega_vincularproduto_status = false;
				document.getElementById('idcol').value = value;
			}
	    }
	    xmlhttp.send(null);
	}
}

var cadastro_fornecedor_vincularproduto_status = false;
function cadastro_fornecedor_vincularproduto(){
	var element = document.getElementById('conteudo_esquerdo');
	//element.innerHTML = loading_dados;
	if ( !carrega_vincularproduto_status ){
		carrega_vincularproduto_status = true;
	    xmlhttp.open("GET", path+'modulos/fornecedor/fornecedor_vincular_produto.php');
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    		document.getElementById('btnvincularproduto').style.display = 'none';
	    		document.getElementById('irlistagem_resultado').style.display = 'none';
				element.innerHTML = xmlhttp.responseText;
				carrega_vincularproduto_status = false;
			}
	    }
	    xmlhttp.send(null);
	}
}


var adicionar_cliente_status = false;
function adicionar_cliente(venda){
	var element = document.getElementById('conteudo_direito');
	var from_venda = '';
	//element.innerHTML = loading_dados;
	if ( !adicionar_cliente_status ){
		adicionar_cliente_status = true;

		if (venda) from_venda = '?venda=' + venda;

	    xmlhttp.open("GET", path+'modulos/cliente/cliente_adicionar.php'+from_venda);
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				element.innerHTML = xmlhttp.responseText;
				adicionar_cliente_status = false;
			}
	    }
	    xmlhttp.send(null);
	}
}

var adicionar_novacolecaosalvar_status = false;
function adicionar_novacolecaosalvar(dropdown, texto){

	var nomecolecao = document.getElementById('nomenovacolecao');
	var mensagem = document.getElementById('mensagem');

	if ( !nomecolecao.value ){
		mensagem.innerHTML = '<b style="color:red">Preencha o nome da coleção corretamente</b>';
		nomecolecao.style.border = '1px solid red';
	} else {
		nomecolecao.style.border = '1px solid #6aa9e9';
		nomecolecao = nomecolecao.value;
		var ano1 = document.getElementById('colecaoano1').value;
		var mes1 = document.getElementById('colecaomes1').value;
		var ano2 = document.getElementById('colecaoano2').value;
		var mes2 = document.getElementById('colecaomes2').value;
		var descricao = document.getElementById('descricaocolecao').value;

		params = "colecao="+nomecolecao+"&descricao="+descricao+"&mes1="+mes1+"&ano1="+ano1+"&mes2="+mes2+"&ano2="+ano2;

		if ( !adicionar_novacolecaosalvar_status ){
			adicionar_novacolecaosalvar_status = true;
			xmlhttp.open("POST", path+'modulos/colecao/colecao_salvar.php', true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.setRequestHeader("Content-length", params.length);
			xmlhttp.setRequestHeader("Connection", "close");
			xmlhttp.onreadystatechange = function() {
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					adicionar_novacolecaosalvar_status = false;
					document.getElementById('conteudocolecao').style.display = 'none';
					if ( dropdown == 'sim' ){
						var x=document.getElementById("colecao");
					    var options = x.getElementsByTagName("option");
					    if (x.selectedIndex>=0){
					        var y=document.createElement('option');
					        var sel_novo;
					        y.text=nomecolecao;
					        y.value=xmlhttp.responseText;
					        var sel=x.options[x.selectedIndex];
					        try{
					        	x.add(y,sel);
					            sel_novo=x.options[x.selectedIndex-1];
					        } catch(ex) {
					        	x.add(y,x.selectedIndex);
					            sel_novo=x.selectedIndex-1;
					        }
					        sel_novo.selected="selected";
					        if (document.getElementById('linha_separador_colecao')){
					        	document.getElementById('linha_separador_colecao').style.height = '60px';
					        }
					    }
					} else {
						var element = document.getElementById('conteudo_direito');
						//element.innerHTML = loading_dados;
					    xmlhttp.open("GET", path+'modulos/colecao/colecao_lista.php');
					    xmlhttp.onreadystatechange = function() {
					    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
								element.innerHTML = xmlhttp.responseText;
								pesquisarcolecao(path+'modulos/colecao/buscar_colecoes.php', 'somente');
							}
					    }
					    xmlhttp.send(null);
					}
					document.getElementById('mensagem').innerHTML = texto;
				}
			}
			xmlhttp.send(params);
		}
	}
}


function adicionar_novacategoriasalvar(){

	var categoria = document.getElementById('nomenovacategoria1').value;

	params = "categoria="+categoria;

	xmlhttp.open("POST", path+'modulos/produto/categoria_salvar.php', true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", params.length);
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.onreadystatechange = function() {
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById('catbtnvoltar').style.display = 'none';
			document.getElementById('catbtnsalvar').style.display = 'none';
			document.getElementById('nomenovacategoria2').style.display = 'none';
			var x=document.getElementById("categoria");
		    var options = x.getElementsByTagName("option");
		    if (x.selectedIndex>=0){
		        var y=document.createElement('option');
		        var sel_novo;
		        y.text=categoria;
		        y.value=xmlhttp.responseText;
		        var sel=x.options[x.selectedIndex];
		        try{
		        	x.add(y,sel);
		            sel_novo=x.options[x.selectedIndex-1];
		        } catch(ex) {
		        	x.add(y,x.selectedIndex);
		            sel_novo=x.selectedIndex-1;
		        }
		        sel_novo.selected="selected";
		        document.getElementById('msgcorrecaocat').innerHTML = '<b style="color:green">A categoria foi adicionada com sucesso</b><br/><br/>Obs.: A categoria adicionada encontra-se selecionada no combo <b>Categoria</b> do produto.</b>';
		        if ( document.getElementById('etapa2_texto') ){
		        	document.getElementById('etapa2_texto').style.display = 'none';
		        }
		    }
		}
	}
	xmlhttp.send(params);

}

function adicionar_novacategoriavoltaretapa(){
	document.getElementById('etapa1').style.display = 'block';
	document.getElementById('etapa2').style.display = 'none';
}

function adicionar_novacategoria(){

	var categoria = document.getElementById('nomenovacategoria1');
	categoria.style.border = '1px solid #6aa9e9';

	if ( categoria.value ){

		document.getElementById('etapa1').style.display = 'none';
		document.getElementById('etapa2').style.display = 'block';
		document.getElementById('nomenovacategoria2').innerHTML = '[<b> '+categoria.value+' </b>]';

	} else {

		var mensagem_texto = document.getElementById('mensagem_texto');
		mensagem_texto.innerHTML = '<font color="red"><b>Preencha corretamente o nome da categoria corretamente</b></font>';
		categoria.style.border = '1px solid red';

	}

}

var adicionar_fornecedor_status = false;
function adicionar_fornecedor(){
	if (!adicionar_fornecedor_status){
		adicionar_fornecedor_status = true;
		var element = document.getElementById('conteudo_esquerdo');
		//element.innerHTML = loading_dados;
	    xmlhttp.open("GET", path+'modulos/fornecedor/fornecedor_adicionar.php');
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				element.innerHTML = xmlhttp.responseText;
				adicionar_fornecedor_status = false;
			}
	    }
	    xmlhttp.send(null);
	}
}

var adicionar_fornecedorsalvar_form_status = false;
function adicionar_fornecedorsalvar_form(){

	var emailval = new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/);

	var erro = false;
	var msg;

	nomefornec = document.getElementById('nomefornec');
	cidade = document.getElementById('cidade').value;
	telefone = document.getElementById('telefone').value;
	telefone += document.getElementById('telefone2').value;
	telefone += document.getElementById('telefone3').value;
	fax = document.getElementById('fax').value;
	fax += document.getElementById('fax2').value;
	fax += document.getElementById('fax3').value;
	cpf = document.getElementById('cpf');
	cep = document.getElementById('cep').value;
	cep += document.getElementById('cep2').value;
	email = document.getElementById('email');
	idenest = document.getElementById('idenest');
	estado = document.getElementById('estado').value;
	contato = document.getElementById('contato').value;
	endereco = document.getElementById('endereco').value;
	bairro = document.getElementById('bairro').value;
	pais = document.getElementById('pais').value;

	if ( !checanumero(cep,0) && cep ){
		msg = '<p style="color:red"><b>Preencha o CEP corretamente ( Opcional )</b></p>';
		document.getElementById('cep').style.border = '1px solid red';
		document.getElementById('cep2').style.border = '1px solid red';
	}else{
		document.getElementById('cep').style.border = '1px solid #6aa9e9';
		document.getElementById('cep2').style.border = '1px solid #6aa9e9';
	}

	if ( !checanumero(idenest.value,0) && idenest.value ){
		msg = '<p style="color:red"><b>Preencha a insc. estadual com somente números ( Opcional )</b></p>';
		idenest.style.border = '1px solid red';
	} else {
		idenest.style.border = '1px solid #6aa9e9';
	}

	if ( !checanumero(cpf.value, 0) && cpf.value ){
		msg = '<p style="color:red"><b>Preencha o CPF/CNPJ com somente números( Opcional )</b></p>';
		cpf.style.border = '1px solid red';
	} else {
		cpf.style.border = '1px solid #6aa9e9';
	}

	if ( !checanumero(fax,10) && fax ){
		msg = '<p style="color:red"><b>Preencha o fax corretamente ( Opcional )</b></p>';
		document.getElementById('fax').style.border = '1px solid red';
		document.getElementById('fax2').style.border = '1px solid red';
		document.getElementById('fax3').style.border = '1px solid red';
	} else {
		document.getElementById('fax').style.border = '1px solid #6aa9e9';
		document.getElementById('fax2').style.border = '1px solid #6aa9e9';
		document.getElementById('fax3').style.border = '1px solid #6aa9e9';
	}

	if ( !checanumero(telefone,10) ){
		msg = '<p style="color:red"><b>Preencha o telefone corretamente ( Obrigatório )</b></p>';
		document.getElementById('telefone').style.border = '1px solid red';
		document.getElementById('telefone2').style.border = '1px solid red';
		document.getElementById('telefone3').style.border = '1px solid red';
	} else {
		document.getElementById('telefone').style.border = '1px solid #6aa9e9';
		document.getElementById('telefone2').style.border = '1px solid #6aa9e9';
		document.getElementById('telefone3').style.border = '1px solid #6aa9e9';
	}

	if ( email.value && !emailval.test(email.value)){
		msg = '<p style="color:red"><b>Preencha o e-mail corretamente ( Opcional )</b></p>';
		email.style.border = '1px solid red';
	} else {
		email.style.border = '1px solid #6aa9e9';
	}

	if ( !nomefornec.value ){
		msg = '<p style="color:red"><b>Preencha nome do fornecedor corretamente ( Obrigatório )</b></p>';
		nomefornec.style.border = '1px solid red';
	} else {
		nomefornec.style.border = '1px solid #6aa9e9';
	}

	if ( !msg ){

		params = "nomefornec="+nomefornec.value+"&cidade="+cidade+"&telefone="+telefone+"&fax="+fax+"&cep="+cep+"&email="+email.value+"&idenest="+idenest.value+"&estado="+estado+'&cpf='+cpf.value+'&contato='+contato+'&endereco='+endereco+'&bairro='+bairro+'&pais='+pais;
		if ( !adicionar_fornecedorsalvar_form_status ){
			adicionar_fornecedorsalvar_form_status = true;
			xmlhttp.open("POST", path+'modulos/fornecedor/fornecedor_salvar.php', true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.setRequestHeader("Content-length", params.length);
			xmlhttp.setRequestHeader("Connection", "close");
			xmlhttp.onreadystatechange = function() {
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					adicionar_fornecedorsalvar_form_status = false;
					document.getElementById('adicionarfornecedor').style.display = 'block';
					var retorno = xmlhttp.responseText;
				    retorno = retorno.split('|');
				    carrega_listagemfornecedores(path+'modulos/fornecedor/fornecedor_lista.php','conteudo_direito', '-');
				    document.getElementById('conteudofornecedor').style.display = 'none';
				    document.getElementById('mensagem').innerHTML = '<b style="color:green">O fornecedor foi adicionado com sucesso</b>';
				}
			}
			xmlhttp.send(params);
		}

	} else {
		document.getElementById('mensagem').innerHTML = msg;
		msg = ''
	}

}

var adicionar_fornecedorsalvar_status = false;
function adicionar_fornecedorsalvar(){

	var emailval = new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/);

	var erro = false;
	var msg;

	nomefornec = document.getElementById('nomefornec');
	cidade = document.getElementById('cidade').value;
	telefone = document.getElementById('telefone').value;
	telefone += document.getElementById('telefone2').value;
	telefone += document.getElementById('telefone3').value;
	fax = document.getElementById('fax').value;
	fax += document.getElementById('fax2').value;
	fax += document.getElementById('fax3').value;
	cpf = document.getElementById('cpf');
	cep = document.getElementById('cep').value;
	cep += document.getElementById('cep2').value;
	email = document.getElementById('email');
	idenest = document.getElementById('idenest');
	estado = document.getElementById('estado').value;
	contato = document.getElementById('contato').value;
	endereco = document.getElementById('endereco').value;
	bairro = document.getElementById('bairro').value;
	pais = document.getElementById('pais').value;

	if ( !checanumero(cep,0) && cep ){
		msg = '<p style="color:red"><b>Preencha o CEP corretamente ( Opcional )</b></p>';
		document.getElementById('cep').style.border = '1px solid red';
		document.getElementById('cep2').style.border = '1px solid red';
	}else{
		document.getElementById('cep').style.border = '1px solid #6aa9e9';
		document.getElementById('cep2').style.border = '1px solid #6aa9e9';
	}

	if ( !checanumero(idenest.value,0) && idenest.value ){
		msg = '<p style="color:red"><b>Preencha a insc. estadual com somente números ( Opcional )</b></p>';
		idenest.style.border = '1px solid red';
	} else {
		idenest.style.border = '1px solid #6aa9e9';
	}

	if ( !checanumero(cpf.value, 0) && cpf.value ){
		msg = '<p style="color:red"><b>Preencha o CPF/CNPJ com somente números( Opcional )</b></p>';
		cpf.style.border = '1px solid red';
	} else {
		cpf.style.border = '1px solid #6aa9e9';
	}

	if ( !checanumero(fax,10) && fax ){
		msg = '<p style="color:red"><b>Preencha o fax corretamente ( Opcional )</b></p>';
		document.getElementById('fax').style.border = '1px solid red';
		document.getElementById('fax2').style.border = '1px solid red';
		document.getElementById('fax3').style.border = '1px solid red';
	} else {
		document.getElementById('fax').style.border = '1px solid #6aa9e9';
		document.getElementById('fax2').style.border = '1px solid #6aa9e9';
		document.getElementById('fax3').style.border = '1px solid #6aa9e9';
	}

	if ( !checanumero(telefone,10) ){
		msg = '<p style="color:red"><b>Preencha o telefone corretamente ( Obrigatório )</b></p>';
		document.getElementById('telefone').style.border = '1px solid red';
		document.getElementById('telefone2').style.border = '1px solid red';
		document.getElementById('telefone3').style.border = '1px solid red';
	} else {
		document.getElementById('telefone').style.border = '1px solid #6aa9e9';
		document.getElementById('telefone2').style.border = '1px solid #6aa9e9';
		document.getElementById('telefone3').style.border = '1px solid #6aa9e9';
	}

	if ( email.value && !emailval.test(email.value)){
		msg = '<p style="color:red"><b>Preencha o e-mail corretamente ( Opcional )</b></p>';
		email.style.border = '1px solid red';
	} else {
		email.style.border = '1px solid #6aa9e9';
	}

	if ( !nomefornec.value ){
		msg = '<p style="color:red"><b>Preencha nome do fornecedor corretamente ( Obrigatório )</b></p>';
		nomefornec.style.border = '1px solid red';
	} else {
		nomefornec.style.border = '1px solid #6aa9e9';
	}

	if ( !msg ){

		params = "nomefornec="+nomefornec.value+"&cidade="+cidade+"&telefone="+telefone+"&fax="+fax+"&cep="+cep+"&email="+email.value+"&idenest="+idenest.value+"&estado="+estado+'&cpf='+cpf.value+'&contato='+contato+'&endereco='+endereco+'&bairro='+bairro+'&pais='+pais;
		if ( !adicionar_fornecedorsalvar_status ){
			adicionar_fornecedorsalvar_status = true;
			xmlhttp.open("POST", path+'modulos/fornecedor/fornecedor_salvar.php', true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.setRequestHeader("Content-length", params.length);
			xmlhttp.setRequestHeader("Connection", "close");
			xmlhttp.onreadystatechange = function() {
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					adicionar_fornecedorsalvar_status = false;
					document.getElementById('conteudofornecedor').style.display = 'none';
					var x=document.getElementById("fornecedor");
				    var options = x.getElementsByTagName("option");
				    if (x.selectedIndex>=0){
				    	var retorno = xmlhttp.responseText;
				    	retorno = retorno.split('|');
				        var y=document.createElement('option');
				        var sel_novo;
				        y.text=nomefornec.value;
				        y.value=retorno[0];
				        var sel=x.options[x.selectedIndex];
				        try{
				        	x.add(y,sel);
				            sel_novo=x.options[x.selectedIndex-1];
				        } catch(ex) {
				        	x.add(y,x.selectedIndex);
				            sel_novo=x.selectedIndex-1;
				        }
				        sel_novo.selected="selected";
				        var msgresposta;
				        if (retorno[1]==0){
				        	msgresposta = '<b style="color:green">O Fornecedor foi adicionado com sucesso</b><br/><br/>Obs.: O fornecedor adicionado encontra-se selecionado no combo <b>Fornecedor</b> do produto.';
				        } else {
				        	msgresposta = '<b style="color:green">O nome do Fornecedor já está cadastrado</b><br/><br/>Obs.: O fornecedor encontra-se selecionado no combo <b>Fornecedor</b> do produto.';
				        }
				        document.getElementById('linha_separador_fornecedor').style.height = '60px';
				        document.getElementById('mensagem').innerHTML = msgresposta;
				    }
				}
			}
			xmlhttp.send(params);
		}

	} else {
		document.getElementById('mensagem').innerHTML = msg;
		msg = ''
	}

}

var cadastro_fornecedor_editar_status = false;
function cadastro_fornecedor_editar(){

	var emailval = new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/);

	var erro = false;
	var msg;

	nomefornec = document.getElementById('edita_nomefornec');
	cidade = document.getElementById('edita_cidade').value;
	telefone = document.getElementById('edita_telefone').value;
	telefone += document.getElementById('edita_telefone2').value;
	telefone += document.getElementById('edita_telefone3').value;
	fax = document.getElementById('edita_fax').value;
	fax += document.getElementById('edita_fax2').value;
	fax += document.getElementById('edita_fax3').value;
	cpf = document.getElementById('edita_cpf');
	cep = document.getElementById('edita_cep1').value;
	cep += document.getElementById('edita_cep2').value;
	email = document.getElementById('edita_email');
	idenest = document.getElementById('edita_idenest');
	estado = document.getElementById('edita_estado').value;
	contato = document.getElementById('edita_contato').value;
	endereco = document.getElementById('edita_endereco').value;
	bairro = document.getElementById('edita_bairro').value;
	pais = document.getElementById('edita_pais').value;

	if ( !checanumero(cep,0) && cep ){
		msg = '<p style="color:red"><b>Preencha o CEP corretamente ( Opcional )</b></p>';
		document.getElementById('edita_cep1').style.border = '1px solid red';
		document.getElementById('edita_cep2').style.border = '1px solid red';
	} else {
		document.getElementById('edita_cep1').style.border = '1px solid #6aa9e9';
		document.getElementById('edita_cep2').style.border = '1px solid #6aa9e9';
	}

	if ( !checanumero(idenest.value,0) && idenest.value ){
		msg = '<p style="color:red"><b>Preencha a insc. estadual com somente números ( Opcional )</b></p>';
		idenest.style.border = '1px solid red';
	} else {
		idenest.style.border = '1px solid #6aa9e9';
	}

	if ( !checanumero(cpf.value, 0) && cpf.value ){
		msg = '<p style="color:red"><b>Preencha o CPF/CNPJ com somente números( Opcional )</b></p>';
		cpf.style.border = '1px solid red';
	} else {
		cpf.style.border = '1px solid #6aa9e9';
	}

	if ( !checanumero(fax,10) && fax ){
		msg = '<p style="color:red"><b>Preencha o fax corretamente ( Opcional )</b></p>';
		document.getElementById('edita_fax').style.border = '1px solid red';
		document.getElementById('edita_fax2').style.border = '1px solid red';
		document.getElementById('edita_fax3').style.border = '1px solid red';
	} else {
		document.getElementById('edita_fax').style.border = '1px solid #6aa9e9';
		document.getElementById('edita_fax2').style.border = '1px solid #6aa9e9';
		document.getElementById('edita_fax3').style.border = '1px solid #6aa9e9';
	}

	if ( !checanumero(telefone,10) ){
		msg = '<p style="color:red"><b>Preencha o telefone corretamente ( Obrigatório )</b></p>';
		document.getElementById('edita_telefone').style.border = '1px solid red';
		document.getElementById('edita_telefone2').style.border = '1px solid red';
		document.getElementById('edita_telefone3').style.border = '1px solid red';
	} else {
		document.getElementById('edita_telefone').style.border = '1px solid #6aa9e9';
		document.getElementById('edita_telefone2').style.border = '1px solid #6aa9e9';
		document.getElementById('edita_telefone3').style.border = '1px solid #6aa9e9';
	}

	if ( email.value && !emailval.test(email.value)){
		msg = '<p style="color:red"><b>Preencha o e-mail corretamente ( Opcional )</b></p>';
		email.style.border = '1px solid red';
	} else {
		email.style.border = '1px solid #6aa9e9';
	}

	if ( !nomefornec.value ){
		msg = '<p style="color:red"><b>Preencha nome do fornecedor corretamente ( Obrigatório )</b></p>';
		nomefornec.style.border = '1px solid red';
	} else {
		nomefornec.style.border = '1px solid #6aa9e9';
	}

	if ( !msg ){

		var idfor = document.getElementById('idfornecedor');
		params = "id="+idfor.value+"&nomefornec="+nomefornec.value+"&cidade="+cidade+"&telefone="+telefone+"&fax="+fax+"&cep="+cep+"&email="+email.value+"&idenest="+idenest.value+"&estado="+estado+'&cpf='+cpf.value+'&contato='+contato+'&endereco='+endereco+'&bairro='+bairro+'&pais='+pais;

		if ( !adicionar_fornecedorsalvar_status ){
			cadastro_fornecedor_editar_status = true;
			xmlhttp.open("POST", path+'modulos/fornecedor/fornecedor_editar.php', true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.setRequestHeader("Content-length", params.length);
			xmlhttp.setRequestHeader("Connection", "close");
			xmlhttp.onreadystatechange = function() {
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {

						cadastro_fornecedor_editar_status = false;

						document.getElementById('txtnome').innerHTML = nomefornec.value;
						document.getElementById('cidade').innerHTML = document.getElementById('edita_cidade').value;
						document.getElementById('dddtel1').innerHTML = document.getElementById('edita_telefone').value;
						document.getElementById('tel1').innerHTML = document.getElementById('edita_telefone2').value;
						document.getElementById('tel2').innerHTML = document.getElementById('edita_telefone3').value;
						document.getElementById('dddtel1_2').innerHTML = document.getElementById('edita_fax').value;
						document.getElementById('tel1_2').innerHTML = document.getElementById('edita_fax2').value;
						document.getElementById('tel2_2').innerHTML = document.getElementById('edita_fax3').value;
						document.getElementById('cpf').innerHTML = document.getElementById('edita_cpf');
						document.getElementById('cep').innerHTML = document.getElementById('edita_cep1').value + '-' + document.getElementById('edita_cep2').value;
						document.getElementById('txtemail').innerHTML = email.value;
						document.getElementById('idenest').innerHTML = document.getElementById('edita_idenest').value;
						document.getElementById('estado').innerHTML = estado;
						document.getElementById('txtcontato').innerHTML = contato;
						document.getElementById('endereco').innerHTML = endereco;
						document.getElementById('bairro').innerHTML = bairro;
						document.getElementById('pais').innerHTML = pais;

						document.getElementById('fornecedor_edicao').style.display = 'none';
				    	document.getElementById('fornecedor_exibicao').style.display = 'block';

				    	document.getElementById('btnsalvarfor').style.display = 'none';
				    	document.getElementById('btneditarfor').style.display = 'block';

				    	document.getElementById('mensagem').innerHTML = '';

				}
			}
			xmlhttp.send(params);
		}

	} else {
		document.getElementById('mensagem').innerHTML = msg;
		msg = ''
	}

}

function lista_adicionargrade(){
	var conteudo_esquerdo = document.getElementById('conteudo_esquerdo');
	var element = conteudo_esquerdo;
	//element.innerHTML = loading_dados;
	xmlhttp.open("GET", path+'modulos/produto/grade_cadastro.php');
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
			carrega_listagrade();
		}
    }
    xmlhttp.send(null);
}

function lista_editargrade(){
	var conteudo_esquerdo = document.getElementById('conteudo_esquerdo');
	var element = conteudo_esquerdo;
	//element.innerHTML = loading_dados;
	xmlhttp.open("GET", path+'modulos/produto/grade_edicao.php');
    	xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
			carrega_listagradeedicao();
		}
    }
    xmlhttp.send(null);

}

/*
function modificar_quantidadeemestoque(id, idgrade, total, reduz){

	var qtdestoque = document.getElementById('qtdestoque');
	var quantidadenova = document.getElementById('quantidade_itemmais_'+id);
	var vlprodgradenova = document.getElementById('vlprodgrade_itemmais_'+id);
	var descricaonova = document.getElementById('descricao_itemmais_'+id);
	var quantidade_input = document.getElementById('quantidade_input_'+id);
	var vlprodgrade_input = document.getElementById('vlprodgrade_input_'+id);
	var quantidadeestoque = 0;

	quantidade_input.value = parseFloat(quantidadenova.value);
	vlprodgrade_input.value = parseFloat(vlprodgradenova.value);

	var x=document.getElementById("listagrade");
	var input = x.getElementsByTagName("input");
	var i = 0;
	for (loop = 0; loop < input.length; loop++) {
		if (document.getElementById(input[loop].id).id == 'quantidade_input_'+i){
			quantidadeestoque += parseFloat(input[loop].value);
			i++;
		}
	}

	qtdestoque.value = quantidadeestoque;
	qtdestoque.style.border = '1px solid #6aa9e9';
	qtdestoque.style.color = '#484848';

	params = 'idgrade='+document.getElementById('idgrade_input_'+id).value+'&descricao='+descricaonova.value+'&quantidade='+quantidade_input.value+'&vlprodgrade='+vlprodgrade_input.value+'&totalestoque='+quantidadeestoque;

	total = parseFloat(quantidadenova.value);

	xmlhttp.open("POST", path+'modulos/produto/grade_salvar.php', true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", params.length);
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.onreadystatechange = function() {
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById('descricao_input_'+id).value = descricaonova.value;
			document.getElementById('descricao_'+id).innerHTML = descricaonova.value;
			document.getElementById('vlprodgrade_'+id).innerHTML = formatadinheiro(vlprodgrade_input.value);
			document.getElementById('quantidade_'+id).innerHTML = quantidade_input.value;
			document.getElementById('maisitem_'+id).value = 'editar';
			document.getElementById('maisitem_'+id).onclick = function(){carrega_additemestoque(id, idgrade, total);};
			document.getElementById('msggrade').innerHTML = '<b style="color:red;"><u>Altera��o efetuada</u></b>';
		}
	}
	xmlhttp.send(params);

}

function salvar_additemestoque(id, idgrade, total){

	var qtdestoque = document.getElementById('qtdestoque');
	var descricaonova = document.getElementById('descricao_itemmais_'+id);
	var quantidadenova = document.getElementById('quantidade_itemmais_'+id);
	var vlprodgradenova = document.getElementById('vlprodgrade_itemmais_'+id);
	var quantidade_input = document.getElementById('quantidade_input_'+id);
	var vlprodgrade_input = document.getElementById('vlprodgrade_input_'+id);

	//if (!vlprodgradenova.value){
	//	vlprodgradenova.value = '0.00';
	//}
	//document.getElementById('listagrade').style.height = '190px';


	if ( checanumero(quantidadenova.value,0) ){

		var total_itensretirados = quantidade_input.value-quantidadenova.value;
		if ( total_itensretirados > 0 ){
			document.getElementById('linha_separador_gradeedicao').style.display = 'block';
			document.getElementById('linha_separador_gradeedicao2').style.display = 'none';
			quantidadenova.style.border = '1px solid red';
			document.getElementById('listagrade').style.height = '187px';
			document.getElementById('linha_separador_gradeedicao').style.height = '60px';
			document.getElementById('linha_separador_gradeedicao').innerHTML = '<table width="100%"><tr><td><b style="color:red;"><u>Voc� est� retirando '+total_itensretirados+' ite'+((total_itensretirados>1)?'ns':'m')+' do estoque</u><BR>Deseja confirmar a retirada?</td><td width="15"></td><td align="left"><table><tr><td><input type="button" class="botao red btn_naored" style="width:70px;" onclick="javascript:habilitatudopagina_altestoque('+id+', '+idgrade+', '+total+');" value="n�o"></td></tr><tr><td><input type="button" class="botao green btn_simgreen" style="width:70px;" onclick="javascript:carregar_diminuirestoque('+id+', '+idgrade+', '+total+', '+total_itensretirados+');" value="sim"></td></tr></table></td></tr></table>';
			desabilitatudo_altestoque();
		} else {
			if ( (descricaonova.value).length > 0 ){
				modificar_quantidadeemestoque(id, idgrade, total, '0');
			} else {
				document.getElementById('msggrade').innerHTML = '<b style="color:red;">Preencha o nome da grade corretamente</b>';
			}
		}

	} else {
		document.getElementById('msggrade').innerHTML = '<b style="color:red;">Preencha a quantidade com n�meros</b>';
	}

}


function carregar_diminuirestoque(id, idgrade, total, total_itensretirados){

	var element = document.getElementById('linha_separador_gradeedicao');
	xmlhttp.open("GET", path+'modulos/produto/grade_diminuiestoque_confirma.php?retirados='+total_itensretirados+'&id='+id+'&idgrade='+idgrade+'&total='+total);
    	xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
		}
    }
    xmlhttp.send(null);

}



var carrega_confirmacaoauth_status = false;
function carrega_confirmacaoauth( id, idgrade, total, total_itensretirados ){

	var idusuario = document.getElementById('idusuario');
	var pwdusuario = document.getElementById('pwdusuario');
	var msg = document.getElementById('msgautentica_gradeerro');
	msg.innerHTML = '';

	if ( !idusuario.value ){
		msg.innerHTML = '<b style="color:red">Selecione o usu�rio corretamente</b>';
	} else if ( !pwdusuario.value || pwdusuario.value == 'digite sua senha' ) {
		msg.innerHTML = '<b style="color:red">Digite a sua senha corretamente</b>';
	} else {
		var element = document.getElementById('msggrade');
		var resposta;
		if (!carrega_confirmacaoauth_status){
			carrega_confirmacaoauth_status = true;
			xmlhttp.open("GET", path+'modulos/produto/grade_diminuiestoque_autentica.php?i='+idusuario.value+'&p='+pwdusuario.value);
		    xmlhttp.onreadystatechange = function() {
		    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					resposta = xmlhttp.responseText;
					if ( resposta == 'ok' ){
						modificar_quantidadeemestoque(id, idgrade, total, total_itensretirados);
						habilitatudopagina_altestoque(id, idgrade, total);
						document.getElementById('msggrade').innerHTML = '<b style="color:red;"><u>O estoque do produto foi modificado</u><BR>As altera��es do item da grade foram salvas com sucesso</b>';
					} else if ( resposta == 'no' ){
						habilitatudopagina_altestoque(id, idgrade, total);
						document.getElementById('msggrade').innerHTML = '<b style="color:red;">Usu�rio n�o possui permiss�o para efetuar o procedimento<BR><u style="color:blue;">N�o houve altera��o no estoque</u></b>';
					} else if( resposta == 'erro' ){
						document.getElementById('msgautentica_gradeerro').innerHTML = '<b style="color:red;">ERRO - Preencha os dados corretamente ou clique em cancelar</b>'
					}
					carrega_confirmacaoauth_status = false;
				}
		    }
		    xmlhttp.send(null);
		}
	}
}
*/

function checkKey(e)
{
	carrega_produtovendacodbarra_auto();
	var targ = e ? e : window.event;
	key = targ.keyCode ? targ.keyCode : targ.charCode;
	if(targ.ctrlKey == true && (key == 106 || key == 107)) { // 106 is key 'j', 107 is key 'k'

		return false;
		//carrega_produtovendacodbarra_auto();
	}
}

var confirmaabrirturno_status = false;
function confirmaabrirturno(){

	var abertura = document.getElementById('abertura').value;
	var turno = document.getElementById('turno').value;
	var terminal = document.getElementById('terminal').value;
	var idusuario = document.getElementById('idusuario').value;
	var valor_caixa = document.getElementById('valor_caixa').value;

	var params = 'ab='+abertura+'&tu='+turno+'&te='+terminal+'&i='+idusuario+'&v='+valor_caixa;

	if ( !confirmaabrirturno_status ){
		confirmaabrirturno_status = true;
		xmlhttp.open("POST", path+'modulos/venda/turno_abrir_dados_salvar.php', true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.setRequestHeader("Content-length", params.length);
		xmlhttp.setRequestHeader("Connection", "close");
		xmlhttp.onreadystatechange = function() {
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				confirmaabrirturno_status = false;
				location.href = path+'index.php';
			}
		}
		xmlhttp.send(params);
	}
}

var confirmafecharturno_status = false;
function confirmafecharturno(){

	var fechamento = document.getElementById('fechamento').value;
	var valor_caixa = document.getElementById('valor_caixa').value;

	var params = 'f='+fechamento+'&v='+valor_caixa;

	if ( !confirmafecharturno_status ){
		confirmafecharturno_status = true;
		xmlhttp.open("POST", path+'modulos/venda/turno_fechar_dados_salvar.php', true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.setRequestHeader("Content-length", params.length);
		xmlhttp.setRequestHeader("Connection", "close");
		xmlhttp.onreadystatechange = function() {
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				confirmafecharturno_status = false;
				location.href = path+'index.php';
			}
		}
		xmlhttp.send(params);
	}
}

function carrega_produtovendacodbarra_auto()
{

	var codbarra = document.getElementById('codbarra').value;

	if ( checanumero(codbarra,0) )
	{
		document.getElementById('msgerrovendageral').innerHTML = '';
		if ( codbarra.length > 8 )
		{
			var status = 1;
			if (document.getElementById("opcvenda"))
				opc = document.getElementById("opcvenda").value;
			var conteudo_produtotoslistavenda = document.getElementById('carrinho_counteudo');
			var element = conteudo_produtotoslistavenda;
			if ( status == 1)
			{
				status = 0;
				xmlhttp.open("GET", path+'modulos/venda/exibe_produto_selecionado_codbarra.php?cb='+codbarra+'&opc='+opc);
			    	xmlhttp.onreadystatechange = function()
			    	{
			    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200 )
			    	{
			    		document.getElementById('carrinho_counteudo').style.display = 'block';
						element.innerHTML = xmlhttp.responseText;
						element.style.height = '220px';
						//document.getElementById('produtosselecionadoslista').style.height = '100px';
						//document.getElementById('btncancelar').style.display = 'none';
						//document.getElementById('btnfechar').style.display = 'none';
						status = 1;
					}
			    }
			    xmlhttp.send(null);
			}
		}
	}
	else
	{
		document.getElementById('msgerrovendageral').innerHTML = '<b style="color:red;">ERRO - O código de barra deve conter somente números</b>';
	}
}

function carrega_produtovendacodbarra(){

	var codbarra = document.getElementById('codbarra').value;
	if ( codbarra.length > 8 ){
		carrega_produtovendacodbarra_auto();
	} else {
		document.getElementById('msgerrovendageral').innerHTML = '<b style="color:red;">ERRO - Preencha o código de barra corretamente</b>';
	}

}




var carrega_confirmacaoauthturno_status = false;
function carrega_confirmacaoauthturno(){

	var idusuario = document.getElementById('idusuario');
	var pwdusuario = document.getElementById('pwdusuario');
	var msg = document.getElementById('msgautentica');
	msg.innerHTML = '';

	if ( !idusuario.value ){
		msg.innerHTML = '<b style="color:red">Selecione o usuário corretamente</b>';
	} else if ( !pwdusuario.value || pwdusuario.value == 'digite sua senha' ) {
		msg.innerHTML = '<b style="color:red">Digite a sua senha corretamente</b>';
	} else {
		var resposta;
		if ( !carrega_confirmacaoauthturno_status ){
			carrega_confirmacaoauthturno_status = true;
			xmlhttp.open("GET", path+'modulos/venda/venda_autentica_vendedor.php?i='+idusuario.value+'&p='+pwdusuario.value);
		    	xmlhttp.onreadystatechange = function() {
		    		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					resposta = xmlhttp.responseText;
					if ( resposta == 'ok' ){
						document.getElementById('confirmasenha').innerHTML = '';
						idusuario.disabled = true;
						document.getElementById('btnabrirturno').style.display = 'block';
					} else if ( resposta == 'no' ){
						msg.innerHTML = '<b style="color:red">Senha incorreta, tente novamente</b>';
					} else {
						msg.innerHTML = '<b style="color:red">Ocorreu um erro, tente novamente</b>';
					}
					carrega_confirmacaoauthturno_status = false;
				}
	    		}
	    		xmlhttp.send(null);
		}
	}
}

var carrega_selecionarcliente_primeiro_status = false;
function carrega_selecionarcliente_primeiro(){

	document.getElementById('produtosselecionarcliente_1').style.display = 'none';
	document.getElementById('produtosselecionarcliente_2').style.display = 'block';

	document.getElementById('carrinho_header').style.display = 'none';

	var produtoslistagem = document.getElementById('carrinho_counteudo');
	produtoslistagem.style.height = '310px';
	var element = produtoslistagem;
	if ( !carrega_selecionarcliente_primeiro_status ){
		carrega_selecionarcliente_primeiro_status = true;
		xmlhttp.open("GET", path+'modulos/cliente/lista_cliente_inicio_venda.php');
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				element.innerHTML = xmlhttp.responseText;
				document.getElementById('titmain').innerHTML = 'Selecionar Cliente para Venda';
				carrega_selecionarcliente_primeiro_status = false;
			}
	    }
	    xmlhttp.send(null);
	}

}

var carrega_selecionarcliente_venda_status = false;
function carrega_selecionarcliente_venda(){

	document.getElementById('linha_separadorpagamento').style.display = 'none';
	document.getElementById('pagamento_counteudo').style.display = 'none';
	document.getElementById('opcextra').style.display = 'block';
	//document.getElementById('titcliente').innerHTML = '<b>Cliente</b>';
	document.getElementById('pagamentocomplemento').innerHTML = '';

	var produtoslistagem = document.getElementById('opcextra');
	//produtoslistagem.style.height = '310px';
	var element = produtoslistagem;
	if ( !carrega_selecionarcliente_venda_status ){
		carrega_selecionarcliente_venda_status = true;
		xmlhttp.open("GET", path+'modulos/cliente/lista_cliente_final_venda.php');
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				element.innerHTML = xmlhttp.responseText;
				document.getElementById('titmain').innerHTML = 'Selecionar Cliente para Venda';
				carrega_selecionarcliente_venda_status = false;
			}
	    }
	    xmlhttp.send(null);
	}

}

function carrega_finalvenda_escolhapagamento(){

	document.getElementById('opcextra').style.display = 'none';
	document.getElementById('btnselecionarcliente').style.display = 'block';
	document.getElementById('linha_separadorpagamento').style.display = 'block';
	document.getElementById('pagamento_counteudo').style.display = 'block';
	document.getElementById('titmain').innerHTML = 'Detalhes Formas de Pagamento';

}


function carregar_cliente_inicioselecionadoparavenda( id, nome ){

	document.getElementById('idclienteescolhido').value = id;

	var texto_cliente = '<b>Cliente : </b>'+nome+'<br/>';

	xmlhttp.open("GET", path+'modulos/cliente/cliente_preferencias.php?id='+id);
	xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById('nomecliente').innerHTML = texto_cliente + xmlhttp.responseText;
			if ( document.getElementById('listacliente_inicio') ){
				carrega_iniciovenda_escolhaprodutos();
				pesquisarproduto_venda();
			}
		}
    }
    xmlhttp.send(null);

}


function carregar_cliente_finalselecionadoparavenda( id, nome ){

	document.getElementById('titmain').innerHTML = 'Detalhes Formas de Pagamento';
	document.getElementById('opcextra').style.display = 'none';
	document.getElementById('linha_separadorpagamento').style.display = 'block';
	document.getElementById('pagamento_counteudo').style.display = 'block';
	document.getElementById('clientevenda').style.display = 'none';
	document.getElementById('btnselecionarcliente').style.display = 'block';
	document.getElementById('clientevendaselecionado').style.display = 'block';


	document.getElementById('inputclientevendaselecionado').value = id;
	var texto_cliente = '<b>Cliente : </b>'+nome+'<br/>';

	xmlhttp.open("GET", path+'modulos/cliente/cliente_preferencias.php?id='+id);
	xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById('nomeclientevendaselecionado').innerHTML = texto_cliente + xmlhttp.responseText;

			if (document.getElementById('btnconfirmapagamento').style.display == 'block')
				exibe_btnconfirmapagamento(true);
		}
    }
    xmlhttp.send(null);


}

var carrega_editarproduto_salvar_status = false;
function carrega_editarproduto_salvar(){

		var idproduto, nome, vlcusto, vlpentrega, vlatacado, vlvarejo, qtdestoque, categoria, fornecedor, colecao, codbarra;
		var msgerro_html = document.getElementById('msgerro');
		var msgerro;

		msgerro_html.innerHTML = '...';

		idproduto = document.getElementById('idproduto').value;
		nome = document.getElementById('produto');
		codigo = document.getElementById('codigo');
		vlcusto = document.getElementById('vlcusto');
		vlpentrega = document.getElementById('vlpentrega');
		vlatacado = document.getElementById('vlatacado');
		vlvarejo = document.getElementById('vlvarejo');
		qtdestoque = document.getElementById('qtdestoque');
		categoria = document.getElementById('categoria');
		fornecedor = document.getElementById('fornecedor');
		colecao = document.getElementById('colecao');
		codbarra = document.getElementById('codbarra');

		if ( !qtdestoque.value ){
			msgerro = 'Preencha a quantidade em estoque do produto corretamente';
			qtdestoque.style.border = '1px solid red';
		} else {
			qtdestoquenumero = checanumero(qtdestoque.value,0);
			if ( !qtdestoquenumero ){
				msgerro = 'A quantidade em estoque deve conter somente números';
				qtdestoque.style.border = '1px solid red';
			} else {
				qtdestoque.style.border = '1px solid #6aa9e9';
			}
		}

		if ( !vlvarejo.value ){
			msgerro = 'Preencha o preço de varejo do produto corretamente ou adicione "zeros"';
			vlvarejo.style.border = '1px solid red';
		} else {
			vlvarejonumero = vlvarejo.value;
			vlvarejonumero = vlvarejonumero.replace('.','');
			vlvarejonumero = vlvarejonumero.replace(',','');
			vlvarejonumero = checanumero(vlvarejonumero,0);
			if ( !vlvarejonumero ){
				msgerro = 'O preço de varejo do produto deve conter somente números, ponto e virgula';
				vlvarejo.style.border = '1px solid red';
			} else {
				vlvarejo.style.border = '1px solid #6aa9e9';
			}
		}

		if ( !vlatacado.value ){
			msgerro = 'Preencha o preço de pronta entrega do produto corretamente ou adicione "zeros"';
			vlatacado.style.border = '1px solid red';
		} else {
			vlatacadonumero = vlatacado.value;
			vlatacadonumero = vlatacadonumero.replace('.','');
			vlatacadonumero = vlatacadonumero.replace(',','');
			vlatacadonumero = checanumero(vlatacadonumero,0);
			if ( !vlatacadonumero ){
				msgerro = 'O preço de atacado do produto deve conter somente números, ponto e virgula';
				vlatacado.style.border = '1px solid red';
			} else {
				vlatacado.style.border = '1px solid #6aa9e9';
			}
		}

		if ( !vlpentrega.value ){
			msgerro = 'Preencha o preço de pronta entrega do produto corretamente ou adicione "zeros"';
			vlpentrega.style.border = '1px solid red';
		} else {
			vlpentreganumero = vlpentrega.value;
			vlpentreganumero = vlpentreganumero.replace('.','');
			vlpentreganumero = vlpentreganumero.replace(',','');
			vlpentreganumero = checanumero(vlpentreganumero,0);
			if ( !vlpentreganumero ){
				msgerro = 'O preço de pronta entrega do produto deve conter somente números, ponto e virgula';
				vlpentrega.style.border = '1px solid red';
			} else {
				vlpentrega.style.border = '1px solid #6aa9e9';
			}
		}

		if ( !vlcusto.value ){
			msgerro = 'Preencha o preço de custo do produto corretamente ou adicione "zeros"';
			vlcusto.style.border = '1px solid red';
		} else {
			vlcustonumero = vlcusto.value;
			vlcustonumero = vlcustonumero.replace('.','');
			vlcustonumero = vlcustonumero.replace(',','');
			vlcustonumero = checanumero(vlcustonumero,0);
			if ( !vlcustonumero ){
				msgerro = 'O preço de custo do produto deve conter somente números, ponto e virgula';
				vlcusto.style.border = '1px solid red';
			} else {
				vlcusto.style.border = '1px solid #6aa9e9';
			}
		}

		if ( !nome.value ){
			msgerro = 'Preencha o nome do produto corretamente'
			nome.style.border = '1px solid red';
		} else {
			nome.style.border = '1px solid #6aa9e9';
		}

		if (!msgerro){

			params = 'codigo='+codigo.value+'&idproduto='+idproduto+'&nome='+nome.value+'&vlcusto='+vlcusto.value+'&vlpentrega='+vlpentrega.value+'&vlatacado='+vlatacado.value+'&vlvarejo='+vlvarejo.value+'&qtdestoque='+qtdestoque.value+'&categoria='+categoria.value+'&fornecedor='+fornecedor.value+'&colecao='+colecao.value;

			var status = document.getElementById('gradestatus').value;

			if ( status == 'nao' ){
				editarproduto_salvar(params);
			} else if ( status == 'sim' ) {
				editarproduto_salvar(params);
			}

		} else {

			msgerro_html.innerHTML = '<b style="color:red">'+msgerro+'</b>';

		}


}

var editarproduto_salvar_status = false;
function editarproduto_salvar(params){

	var msgerro_html = document.getElementById('msgerro');
	if (!editarproduto_salvar_status){
		editarproduto_salvar_status = true;
		xmlhttp.open("POST", path+'modulos/produto/produto_editar_salvar.php', true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.setRequestHeader("Content-length", params.length);
		xmlhttp.setRequestHeader("Connection", "close");
		xmlhttp.onreadystatechange = function() {
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				msgerro_html.innerHTML = '<b style="color:green;">PRODUTO EDITADO COM SUCESSO</b>';
				editarproduto_salvar_status = false;
			}
		}
		xmlhttp.send(params);
	}

}

var adicionar_itemgrade_status = false;
function adicionar_itemgrade(){

	var nome = document.getElementById('add_nomegrade');
	var qtdgrade = document.getElementById('add_qtdgrade');
	var precounico = document.getElementById('add_precounico');
	var msgerro;
	var addgradeerro = document.getElementById('addgradeerro');

	if ( !nome.value ){
		nome.style.border = '1px solid red';
		msgerro = 'Preencha o nome corretamente';
	} else {
		if ( (nome.value).length < 3 ){
			nome.style.border = '1px solid red';
			msgerro = 'O nome deve ter no minimo 3 letras';
		} else {
			nome.style.border = '1px solid #6aa9e9';
			if ( !checanumero(qtdgrade.value,0) ){
				qtdgrade.style.border = '1px solid red';
				msgerro = 'Preencha a quantidade corretamente';
			} else {
				qtdgrade.style.border = '1px solid #6aa9e9';
				msgerro = '';
			}
		}
	}

	if ( msgerro != '' ){
		addgradeerro.innerHTML = '<b style="color:red;">'+msgerro+'</b>';
	} else {

		var element = document.getElementById('listagrade');
		element.style.display = 'block';

		var qtdestoque_total = 0;

		if ( document.getElementById('quantidade_input_0') ){
			qtdestoque_total = document.getElementById('qtdestoque').value;
		}

		if ( !adicionar_itemgrade_status ){
			var adicionar_itemgrade_status = true;
			xmlhttp.open("GET", path+'modulos/produto/lista_grade_edicao.php?id='+document.getElementById('idproduto').value+'&add_nomegrade='+nome.value+'&add_qtdgrade='+qtdgrade.value+'&add_precounico='+precounico.value);
			xmlhttp.onreadystatechange = function() {
	    		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					adicionar_itemgrade_status = false;
	    			element.innerHTML = xmlhttp.responseText;
					var qtdestoque = document.getElementById('qtdestoque');
					qtdestoque.readOnly = true;
					qtdestoque.style.border = '1px solid #6aa9e9';
					qtdestoque.style.color = '#484848';
					qtdestoque.value = parseFloat(qtdestoque_total)+parseFloat(qtdgrade.value);
					nome.value = '';
					qtdgrade.value = '';
				}
	    	}
	    	xmlhttp.send(null);
		}
	}
}

var adicionar_itemgradenova_status = false;
function adicionar_itemgradenova()
{

	var nome        = document.getElementById('add_nomegrade');
	var qtdgrade	= document.getElementById('add_qtdgrade');
	var precounico	= document.getElementById('add_precounico');
	var msgerro;
	var addgradeerro= document.getElementById('addgradeerro');
	var qtdestoque  = document.getElementById('qtdestoque');

	if ( !nome.value ){
		nome.style.border = '1px solid red';
		msgerro = 'Preencha o nome corretamente';
	} else {
		if ( (nome.value).length < 3 ){
			nome.style.border = '1px solid red';
			msgerro = 'O nome deve ter no minimo 3 letras';
		} else {
			nome.style.border = '1px solid #6aa9e9';
			if ( !checanumero(qtdgrade.value,0) ){
				qtdgrade.style.border = '1px solid red';
				msgerro = 'Preencha a quantidade corretamente';
			} else {
				qtdgrade.style.border = '1px solid #6aa9e9';
				msgerro = '';
			}
		}
	}

	if ( msgerro != '' )
	{
		addgradeerro.innerHTML = '<b style="color:red;">'+msgerro+'</b>';
	}
	else
	{

		var element = document.getElementById('listagrade');
		element.style.display = 'block';

		var qtdestoque_total = 0;

		if ( qtdestoque.readOnly == true)
		{
			qtdestoque_total = qtdestoque.value;
		}

		if ( !adicionar_itemgradenova_status ){
			adicionar_itemgradenova_status = true;
			xmlhttp.open("GET", path+'modulos/produto/lista_grade_cadastro.php?add_nomegrade='+nome.value+'&add_qtdgrade='+qtdgrade.value+'&add_precounico='+precounico.value);
			xmlhttp.onreadystatechange = function() {
	    		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    			adicionar_itemgradenova_status = false;
					element.innerHTML = xmlhttp.responseText;
					var qtdestoque = document.getElementById('qtdestoque');
					qtdestoque.readOnly = true;
					qtdestoque.style.border = '1px solid #6aa9e9';
					qtdestoque.style.color = '#484848';
					qtdestoque.value = parseFloat(qtdestoque_total)+parseFloat(qtdgrade.value);
					nome.value = '';
					qtdgrade.value = '';
				}
	    	}
	    	xmlhttp.send(null);
		}
	}
}


function desabilitatudo_altestoque(){

	var x=document.getElementById("conteudo_direito");
	var input = x.getElementsByTagName("input");
	for (loop = 0; loop < input.length; loop++) {
		if (document.getElementById(input[loop].id)){
			document.getElementById(input[loop].id).disabled = true;
		}
	}
	var select = x.getElementsByTagName("select");
	for (loop = 0; loop < select.length; loop++) {
		if (document.getElementById(select[loop].id)){
			document.getElementById(select[loop].id).disabled = true;
		}
	}

	diminui_opacidade('diveditarproduto');

	var x=document.getElementById("conteudo_esquerdo");
	var input = x.getElementsByTagName("input");
	for (loop = 0; loop < input.length; loop++) {
		if (document.getElementById(input[loop].id)){
			document.getElementById(input[loop].id).disabled = true;
		}
	}

	diminui_opacidade('divadicionaritem');
	diminui_opacidade('linha_separadoreditarproduto');

	document.getElementById("menu_ASC - Ajax Sales Cloud").style.display = 'none';
	document.getElementById("sair_ASC - Ajax Sales Cloud").style.display = 'none';

}

function aumenta_opacidade(id_div){

	document.getElementById(id_div).style.MozOpacity = 1.00;
	document.getElementById(id_div).style.opacity = 1.00;
	document.getElementById(id_div).style.filter = "alpha(opacity=100)";

}

function diminui_opacidade(id_div){

	document.getElementById(id_div).style.MozOpacity = 0.20;
	document.getElementById(id_div).style.opacity = 0.20;
	document.getElementById(id_div).style.filter = "alpha(opacity=20)";

}




function carrega_listagradeedicao(){
	document.getElementById('listagrade').style.display = 'block';
	var element = document.getElementById('listagrade');
	//element.innerHTML = loading_dados;
    xmlhttp.open("GET", path+'modulos/produto/lista_grade_edicao.php?id='+document.getElementById('idproduto').value);
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
		}
    }
    xmlhttp.send(null);
}

var carrega_adicionarproduto_status = false;
function carrega_adicionarproduto(url, value){
	var conteudo_total = document.getElementById('conteudo_total');
	conteudo_total.style.display = 'none';
	conteudo_total.innerHTML = '';
	var conteudo_esquerdo = document.getElementById('conteudo_esquerdo');
	conteudo_esquerdo.style.display = 'block';
	conteudo_esquerdo.innerHTML = '';
	var conteudo_direito = document.getElementById('conteudo_direito');
	conteudo_direito.style.display = 'block';
	conteudo_direito.innerHTML = '';

	var element = conteudo_direito;
	//element.innerHTML = loading_dados;
	if ( !carrega_adicionarproduto_status ){
		carrega_adicionarproduto_status = true;
		xmlhttp.open("GET", url);
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				element.innerHTML = xmlhttp.responseText;
				carrega_adicionarproduto_status = false;
				lista_adicionargrade();
				gerarcodigodebarras(value)
			}
	    }
	    xmlhttp.send(null);
	}
}



function editar_colecao(idcolecao){

	var data = new Date();
	var txtnomecol, txtperiodocol, txtdescricol, periodo, ano_inicial, ano_final;
	var periodo01, periodo02 = new Array();
	var nomecol = document.getElementById('txtnomecol');
	var periodocol = document.getElementById('txtperiodocol');
	var descricol = document.getElementById('txtdescricol');

	if ( document.getElementById('duracaocolecao').checked ){
		document.getElementById('peridoindeterminado').style.display = 'block';
		document.getElementById('peridodeterminado').style.display = 'none';
	} else {
		document.getElementById('peridoindeterminado').style.display = 'none';
		document.getElementById('peridodeterminado').style.display = 'block';
	}

	if (document.getElementById('btneditarcolecao')){
		document.getElementById('btneditarcolecao').style.display = 'none';
	}

	txtnomecol = nomecol.innerHTML;
	txtperiodocol = periodocol.innerHTML;
	txtdescricol = descricol.innerHTML;

	if ( txtperiodocol.indexOf('até') > 0 ){
		periodo = txtperiodocol.replace(' até ', '|');
		periodo = periodo.split('|');
		periodo01 = periodo[0].split(' de ');
		periodo02 = periodo[1].split(' de ');
		for (i=1;i<=meses.length;i++){
			if ( periodo01[0] == meses[i] )
				periodo01[0] = i;
			if ( periodo02[0] == meses[i] )
				periodo02[0] = i;
		}
	} else {
		periodo01 = txtperiodocol.split('/');
		periodo02[0] = data.getMonth();
		periodo02[1] = data.getFullYear();
	}

	var select_colecaomes1 = '<select id="select_colecaomes1">';
	for (n = 1; n <= 12; n++) {
		select_colecaomes1 += '<option value="'+n+'" '+((n == periodo01[0]) ? 'selected':'')+'>'+meses[n]+'</option>';
	}
	select_colecaomes1 += '</select>';

	var select_colecaomes2 = '<select id="select_colecaomes2">';
	for (n = 1; n <= 12; n++) {
		select_colecaomes2 += '<option value="'+n+'" '+((n == periodo02[0]) ? 'selected':'')+'>'+meses[n]+'</option>';
	}
	select_colecaomes2 += '</select>';

	ano_inicial = (data.getFullYear())-2;
	ano_final = parseInt(data.getFullYear())+parseInt(3);

	var select_colecaoano1 = '<select id="select_colecaoano1">';
	for (n = ano_inicial; n <= ano_final; n++) {
		select_colecaoano1 += '<option value="'+n+'" '+((n == periodo01[1]) ? 'selected':'')+'>'+n+'</option>';
	}
	select_colecaoano1 += '</select>';

	var select_colecaoano2 = '<select id="select_colecaoano2">';
	for (n = ano_inicial; n <= ano_final; n++) {
		select_colecaoano2 += '<option value="'+n+'" '+((n == periodo02[1]) ? 'selected':'')+'>'+n+'</option>';
	}
	select_colecaoano2 += '</select>';

	nomecol.innerHTML = '<input type="text" id="input_txtnomecol" value="'+txtnomecol+'" style="width:220px" maxlength="30">';
	periodocol.innerHTML = select_colecaomes1+'&nbsp;de&nbsp;'+select_colecaoano1+'&nbsp;até&nbsp;'+select_colecaomes2+'&nbsp;de&nbsp;'+select_colecaoano2;
	descricol.innerHTML = '<textarea id="textarea_txtdescricol" style="width:380px;" rows="4">'+strip_tags(txtdescricol)+'</textarea>'

	document.getElementById('diveditar').style.display = 'block';
	document.getElementById('defineduracao').style.display = 'block';

}

var editar_colecao_salvar_status = false;
function editar_colecao_salvar(){

	var nomecol = document.getElementById('txtnomecol');
	var periodocol = document.getElementById('txtperiodocol');
	var descricol = document.getElementById('txtdescricol');

	var txtnomecol = document.getElementById('input_txtnomecol');
	var colecaomes1 = document.getElementById('select_colecaomes1');
	var colecaoano1 = document.getElementById('select_colecaoano1');
	var colecaomes2 = document.getElementById('select_colecaomes2');
	var colecaoano2 = document.getElementById('select_colecaoano2');
	var txtdescricol = document.getElementById('textarea_txtdescricol');
	var idcol = document.getElementById('idcol').value

	params = 'id='+idcol+'&colecao='+txtnomecol.value+'&mes1='+colecaomes1.value+'&ano1='+colecaoano1.value+'&mes2='+colecaomes2.value+'&ano2='+colecaoano2.value+'&descricao='+txtdescricol.value;

	if (!editar_colecao_salvar_status){
		editar_colecao_salvar_status = true;
		xmlhttp.open("POST", path+'modulos/colecao/colecao_editar_salvar.php', true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.setRequestHeader("Content-length", params.length);
		xmlhttp.setRequestHeader("Connection", "close");
		xmlhttp.onreadystatechange = function() {
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				editar_colecao_salvar_status = false;
				nomecol.innerHTML = txtnomecol.value;
				var txtperiodo;
				if ( document.getElementById('duracaocolecao').checked ){
					txtperiodo = 'indeterminado';
				} else {
					txtperiodo = meses[colecaomes1.value]+' de '+colecaoano1.value+' até '+meses[colecaomes2.value]+' de '+colecaoano2.value;
				}
				periodocol.innerHTML = txtperiodo;
				descricol.innerHTML = nl2br(txtdescricol.value);
				document.getElementById('btneditarcolecao').style.display = 'block';
				document.getElementById('diveditar').style.display = 'none';
				document.getElementById('defineduracao').style.display = 'none';
				document.getElementById('peridoindeterminado').style.display = 'none';
				document.getElementById('peridodeterminado').style.display = 'block';
			}
		}
		xmlhttp.send(params);
	}

}


var carrega_adicionarproduto_salvar_status = false;
function carrega_adicionarproduto_salvar(){

	var nome, vlcusto, vlpentrega, vlatacado, vlvarejo, qtdestoque, categoria, fornecedor, colecao, codbarra;
	var msgerro;

	nome = document.getElementById('produto');
	codigo = document.getElementById('codigo');
	vlcusto = document.getElementById('vlcusto');
	vlpentrega = document.getElementById('vlpentrega');
	vlatacado = document.getElementById('vlatacado');
	vlvarejo = document.getElementById('vlvarejo');
	qtdestoque = document.getElementById('qtdestoque');
	categoria = document.getElementById('categoria');
	fornecedor = document.getElementById('fornecedor');
	colecao = document.getElementById('colecao');
	codbarra = document.getElementById('codbarra');

	if ( !qtdestoque.value ){
		msgerro = 'Preencha a quantidade em estoque do produto corretamente';
		qtdestoque.style.border = '1px solid red';
	} else {
		qtdestoquenumero = checanumero(qtdestoque.value,0);
		if ( !qtdestoquenumero ){
			msgerro = 'A quantidade em estoque deve conter somente números';
			qtdestoque.style.border = '1px solid red';
		} else {
			qtdestoque.style.border = '1px solid #6aa9e9';
		}
	}

	if ( !vlvarejo.value ){
		msgerro = 'Preencha o valor de varejo do produto corretamente';
		vlvarejo.style.border = '1px solid red';
	} else {
		/*
		vlvarejonumero = vlvarejo.value;
		vlvarejonumero = vlvarejonumero.replace('.','');
		vlvarejonumero = vlvarejonumero.replace(',','');
		vlvarejonumero = checanumero(vlvarejonumero,0);
		*/
		if ( !checa_numero_valor(vlvarejo.value) ){
			msgerro = 'O valor de varejo do produto deve conter somente números, ponto e virgula';
			vlvarejo.style.border = '1px solid red';
		} else {
			vlvarejo.style.border = '1px solid #6aa9e9';
		}
	}

	if ( !vlatacado.value ){
		msgerro = 'Preencha o valor de pronta entrega do produto corretamente';
		vlatacado.style.border = '1px solid red';
	} else {
		/*
		vlatacadonumero = vlatacado.value;
		vlatacadonumero = vlatacadonumero.replace('.','');
		vlatacadonumero = vlatacadonumero.replace(',','');
		vlatacadonumero = checanumero(vlatacadonumero,0);
		*/
		if ( !checa_numero_valor(vlatacado.value) ){
			msgerro = 'O valor de atacado do produto deve conter somente números, ponto e virgula';
			vlatacado.style.border = '1px solid red';
		} else {
			vlatacado.style.border = '1px solid #6aa9e9';
		}
	}

	if ( !vlpentrega.value ){
		msgerro = 'Preencha o valor de pronta entrega do produto corretamente';
		vlpentrega.style.border = '1px solid red';
	} else {
		/*
		vlpentreganumero = vlpentrega.value;
		vlpentreganumero = vlpentreganumero.replace('.','');
		vlpentreganumero = vlpentreganumero.replace(',','');
		vlpentreganumero = checanumero(vlpentreganumero,0);
		*/
		if ( !checa_numero_valor(vlpentrega.value) ){
			msgerro = 'O valor de pronta entrega do produto deve conter somente números, ponto e virgula';
			vlpentrega.style.border = '1px solid red';
		} else {
			vlpentrega.style.border = '1px solid #6aa9e9';
		}
	}

	if ( !vlcusto.value ){
		msgerro = 'Preencha o valor de custo do produto corretamente';
		vlcusto.style.border = '1px solid red';
	} else {
		/*
		vlcustonumero = vlcusto.value;
		vlcustonumero = vlcustonumero.replace('.','');
		vlcustonumero = vlcustonumero.replace(',','');
		vlcustonumero = checanumero(vlcustonumero,0);
		*/
		if ( !checa_numero_valor(vlcusto.value) ){
			msgerro = 'O valor de custo do produto deve conter somente números, ponto e virgula';
			vlcusto.style.border = '1px solid red';
		} else {
			vlcusto.style.border = '1px solid #6aa9e9';
		}
	}

	if ( !nome.value ){
		msgerro = 'Preencha o nome do produto corretamente'
		nome.style.border = '1px solid red';
	} else {
		nome.style.border = '1px solid #6aa9e9';
	}

	if (msgerro){
		document.getElementById('msgerro').innerHTML = '<b style="color:red">'+msgerro+'</b>';
	} else {

		document.getElementById('msgerro').innerHTML = '...';

		params = 'codigo='+codigo.value+'&nome='+nome.value+'&vlcusto='+vlcusto.value+'&vlpentrega='+vlpentrega.value+'&vlatacado='+vlatacado.value+'&vlvarejo='+vlvarejo.value+'&qtdestoque='+qtdestoque.value+'&categoria='+categoria.value+'&fornecedor='+fornecedor.value+'&colecao='+colecao.value+'&codbarra='+codbarra.value;
				
		if (!carrega_adicionarproduto_salvar_status){
			carrega_adicionarproduto_salvar_status = true;
			xmlhttp.open("POST", path+'modulos/produto/produto_cadastrar_salvar.php', true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.setRequestHeader("Content-length", params.length);
			xmlhttp.setRequestHeader("Connection", "close");
			xmlhttp.onreadystatechange = function() {
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					carrega_adicionarproduto_salvar_status = false;
					carrega_adicionarproduto_infofiscal();
					desabilita_adicionarproduto();
				}
			}
			xmlhttp.send(params);
		}
	}
}


function checa_numero_valor(valor){
	valor = valor.replace('.','');
	valor = valor.replace(',','');
	valor = checanumero(valor,0);
	return valor
}

var cadastro_produto_adicionarsalvar_status = false;
function cadastro_produto_adicionarsalvar(){

	var msgerro;
	var icms_valor, frete_valor, vldesc_valor, icmssub_valor, ipi_valor, vltotal_valor;
	var nnota = document.getElementById('nnota');
	var icms = document.getElementById('icms');
	var frete = document.getElementById('frete');
	var vldesc = document.getElementById('vldesc');
	var dianota = document.getElementById('dianota');
	var mesnota = document.getElementById('mesnota');
	var anonota = document.getElementById('anonota');
	var icmssub = document.getElementById('icmssub');
	var ipi = document.getElementById('ipi');
	var vltotal = document.getElementById('vltotal');
	icms_valor = icms.value;
	frete_valor = frete.value;
	vldesc_valor = vldesc.value;
	icmssub_valor = icmssub.value;
	ipi_valor = ipi.value;
	vltotal_valor = vltotal.value;

	if ( !checa_numero_valor(vltotal_valor) && vltotal_valor ){
		msgerro = 'Preencha o valor total da nota corretamente';
		vltotal.style.border = '1px solid red';
	} else {
		vltotal.style.border = '1px solid #6aa9e9';
	}

	if ( !checa_numero_valor(ipi_valor) && ipi_valor ){
		msgerro = 'Preencha o valor do IPI corretamente';
		ipi.style.border = '1px solid red';
	} else {
		ipi.style.border = '1px solid #6aa9e9';
	}

	if ( !checa_numero_valor(icmssub_valor) && icmssub_valor ){
		msgerro = 'Preencha o valor do ICMS Sub corretamente';
		icmssub.style.border = '1px solid red';
	} else {
		icmssub.style.border = '1px solid #6aa9e9';
	}

	if ( !checa_numero_valor(vldesc_valor) && vldesc_valor ){
		msgerro = 'Preencha o valor do desconto corretamente';
		vldesc.style.border = '1px solid red';
	} else {
		vldesc.style.border = '1px solid #6aa9e9';
	}

	if ( !checa_numero_valor(frete_valor) && frete_valor ){
		msgerro = 'Preencha o valor do frete corretamente';
		frete.style.border = '1px solid red';
	} else {
		frete.style.border = '1px solid #6aa9e9';
	}

	if ( !checa_numero_valor(icms_valor) && icms_valor ){
		msgerro = 'Preencha o valor do ICMS corretamente';
		icms.style.border = '1px solid red';
	} else {
		icms.style.border = '1px solid #6aa9e9';
	}

	if ( !checanumero(nnota.value,0) && nnota.value ){
		msgerro = 'Preencha o número da nota corretamente';
		nnota.style.border = '1px solid red';
	} else {
		nnota.style.border = '1px solid #6aa9e9';
	}

	var param_fornecedor;

	if ( document.getElementById('fornecedornotafiscal') ){
		var fornecedor = document.getElementById('fornecedornotafiscal').value;
		if ( (fornecedor == 0 ) && ( nnota.value || icms_valor || frete_valor || vldesc_valor || icmssub_valor || ipi_valor || vltotal_valor ) ){
			msgerro = 'A nota deve ter um fornecedor';
			document.getElementById('fornecedornotafiscal').style.border = '1px solid red';
		} else {
			document.getElementById('fornecedornotafiscal').style.border = '1px solid #6aa9e9';
			param_fornecedor = '&fornecedor='+fornecedor;
		}
	} else {
		param_fornecedor = '';
	}

	if ( msgerro ){

		document.getElementById('msgerro').innerHTML = '<b style="color:red">'+msgerro+'</b>';

	} else {
		params = 'nnota='+nnota.value+'&icms='+icms_valor+'&frete='+frete_valor+'&vldesc='+vldesc_valor+'&icmssub='+icmssub_valor+'&ipi='+ipi_valor+'&vltotal='+vltotal_valor+'&dianota='+dianota.value+'&mesnota='+mesnota.value+'&anonota='+anonota.value+param_fornecedor;

		if ( !cadastro_produto_adicionarsalvar_status ){
			cadastro_produto_adicionarsalvar_status = true;
			xmlhttp.open("POST", path+'modulos/produto/produto_cadastrar_salvar_final.php', true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.setRequestHeader("Content-length", params.length);
			xmlhttp.setRequestHeader("Connection", "close");
			xmlhttp.onreadystatechange = function() {
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					cadastro_produto_adicionarsalvar_status = false;
					carrega_adicionarproduto_concluido();
				}
			}

			xmlhttp.send(params);
		}

	}
}

function carrega_adicionarproduto_concluido(){
	//alert('carrega_adicionarproduto_concluido');
	var conteudo_esquerdo = document.getElementById('conteudo_esquerdo');
	var element = conteudo_esquerdo;
	xmlhttp.open("GET", path+'modulos/produto/produto_cadastrar_concluido.php');
    	xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
		}
    }
    xmlhttp.send(null);
}

function carrega_adicionarproduto_infofiscal(){
	var conteudo_esquerdo = document.getElementById('conteudo_esquerdo');
	var element = conteudo_esquerdo;
	xmlhttp.open("GET", path+'modulos/produto/produto_cadastrar_fiscal.php');
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
		}
    }
    xmlhttp.send(null);
}


function desabilita_adicionarproduto(){

	diminui_opacidade('divadicionarproduto');
	diminui_opacidade('linhaadicionarproduto');

	var x=document.getElementById('conteudo_direito');
	var input = x.getElementsByTagName("input");
	for (loop = 0; loop < input.length; loop++) {
		if (document.getElementById(input[loop].id)){
			document.getElementById(input[loop].id).disabled = true;
		}
	}
	var select = x.getElementsByTagName("select");
	for (loop = 0; loop < select.length; loop++) {
		if (document.getElementById(select[loop].id)){
			document.getElementById(select[loop].id).disabled = true;
		}
	}

}


function gerarcodigodebarras(value_cod){

  alfabet = new Array(
   'AAAAAACCCCCC',
   'AABABBCCCCCC',
   'AABBABCCCCCC',
   'AABBBACCCCCC',
   'ABAABBCCCCCC',
   'ABBAABCCCCCC',
   'ABBBAACCCCCC',
   'ABABABCCCCCC',
   'ABABBACCCCCC',
   'ABBABACCCCCC'
  );
  acode = new Array(
   '0001101','0011001','0010011','0111101','0100011',
   '0110001','0101111','0111011','0110111','0001011'
  )
  bcode = new Array(
   '0100111','0110011','0011011','0100001','0011101',
   '0111001','0000101','0010001','0001001','0010111'
  )
  ccode = new Array(
   '1110010','1100110','1101100','1000010','1011100',
   '1001110','1010000','1000100','1001000','1110100'
  )
  value = new Array(
   '0','1','2','3','4','5','6','7','8','9'
  )

  ean=value_cod;
  eanok = (ean != null);
  if (eanok) eanok = (ean != "");
  if (eanok) {
    chksum = 0;
    code = ean;
    for (i = 0; i < ean.length; i++) {
      v = -1;
      for (j = 0; j < value.length; j++) {
        if (value[j] == ean.charAt(i)) {
          if (i % 2 == 0) {
            v=j;
          } else {
            v=3*j;
          }
        }
      }
      chksum += v;
    }
    chksum = chksum % 10;
    chksum = (10 - chksum) % 10;
    ean = ean + value[chksum];
    document.getElementById('codbarra').value = ean;
  }

}


function carrega_edicaocliente(idcliente){
	var conteudo_total = document.getElementById('conteudo_total');
	conteudo_total.style.display = 'none';
	conteudo_total.innerHTML = '';
	var conteudo_esquerdo = document.getElementById('conteudo_esquerdo');
	conteudo_esquerdo.style.display = 'block';
	conteudo_esquerdo.innerHTML = '';
	var conteudo_direito = document.getElementById('conteudo_direito');
	conteudo_direito.style.display = 'block';
	conteudo_direito.innerHTML = '';

	var element = conteudo_direito;
	//element.innerHTML = loading_dados;
	xmlhttp.open("GET", 'modulos/cliente/cliente_mostradados.php?id='+idcliente);
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
			listasimples_cliente('listagem', idcliente);
		}
    }
    xmlhttp.send(null);
}


/*
function carrega_edicaoclientesimples(url){
	var conteudo_direito = document.getElementById('conteudo_direito');
	var element = conteudo_direito;
	//element.innerHTML = loading_dados;
	xmlhttp.open("GET", url);
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
		}
    }
    xmlhttp.send(null);

}
*/

function produto_cancelaropcional(){
	document.getElementById('vlnumero').value = '';
	atualiza_quantidadeprodutos();
	document.getElementById('produtoopcional').innerHTML = '';
}


function produto_abriropcional(){

	var conteudo_produtoopcional = document.getElementById('produtoopcional');
	if ( ((conteudo_produtoopcional.innerHTML).length) == 0 ){
		var element = conteudo_produtoopcional;
		xmlhttp.open("GET", path+'modulos/venda/opcional_produto.php');
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				element.innerHTML = xmlhttp.responseText;
				atualiza_quantidadeprodutos();
			}
	    }
	    xmlhttp.send(null);
	} else {
		document.getElementById('vlnumero').value = '';
		atualiza_quantidadeprodutos();
		conteudo_produtoopcional.innerHTML = '';
	}
}


function venda_zerarselects(){

	document.getElementById('produtotipo').selectedIndex = 0;
	document.getElementById('produtofornec').selectedIndex = 0;
	document.getElementById('produtocolecao').selectedIndex = 0;

}

function produto_selecionadofechar(){

	venda_zerarselects()
	if ( valor_total_final>0 ){
		document.getElementById('btncancelar').style.display = 'block';
		document.getElementById('btnfechar').style.display = 'block';
	}
	document.getElementById('cancelar_venda').style.height = '0px';
	document.getElementById('cancelar_venda').innerHTML = '';

	carregar_cancelarvendaconfirmacao();

}

function carrega_voltarselecionaclientevenda(){

	document.getElementById('clientevenda').style.display = 'block';
	document.getElementById('clientevendaselecionado').style.display = 'none';
	document.getElementById('inputclientevendaselecionado').value = 0;
	document.getElementById('nomeclientevendaselecionado').innerHTML = '';

	exibe_btnconfirmapagamento(false);

	if (document.getElementById('credito'))
	{
		document.getElementById('credito').checked = false;
		carrega_exibicao_credito();
		exibe_btnconcretizar();
		vendas_vendanormal_pagcredito();
	}

	if (document.getElementById('debito'))
	{
		document.getElementById('debito').checked = false;
		vendas_vendanormal_pagdebito();
	}

	if (document.getElementById('cheque'))
	{
		document.getElementById('cheque').checked = false;
		Sell.SelectCustomer();
	}
}


function carrega_cadastraclientevenda(){

	document.getElementById('produtosselecionadoslista').style.height = '0px';

	var produtoslistagem = document.getElementById('produtoslistagem');
	produtoslistagem.style.height = '310px';
	var element = produtoslistagem;
	//element.innerHTML = loading_dados;
	xmlhttp.open("GET", path+'modulos/cliente/cliente_cadastrar_venda.php');
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
		}
    }
    xmlhttp.send(null);

}


function carregar_clienteselecionadodetalhes(idcliente){

	document.getElementById('produtosselecionadoslista').style.height = '0px';

	var produtoslistagem = document.getElementById('produtoslistagem');
	produtoslistagem.style.height = '310px';
	var element = produtoslistagem;
	//element.innerHTML = loading_dados;
	xmlhttp.open("GET", path+'modulos/cliente/cliente_detalhes_venda.php?id='+idcliente);
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
		}
    }
    xmlhttp.send(null);

}

function carregar_cliente_inicioselecionadodetalhes(idcliente){

	//document.getElementById('produtosselecionadoslista').style.height = '0px';

	var produtoslistagem = document.getElementById('carrinho_counteudo');
	produtoslistagem.style.height = '310px';
	var element = produtoslistagem;
	//element.innerHTML = loading_dados;
	xmlhttp.open("GET", path+'modulos/cliente/cliente_detalhes_inicio_venda.php?id='+idcliente);
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
			document.getElementById('titmain').innerHTML = 'Detalhes do Cliente para Venda';
		}
    }
    xmlhttp.send(null);

}

function carregar_cliente_finalselecionadodetalhes(idcliente){

	var pagamento_counteudo = document.getElementById('opcextra');
	//pagamento_counteudo.style.height = '310px';
	var element = pagamento_counteudo;
	//element.innerHTML = loading_dados;
	xmlhttp.open("GET", path+'modulos/cliente/cliente_detalhes_final_venda.php?id='+idcliente);
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
			document.getElementById('titmain').innerHTML = 'Detalhes do Cliente para Venda';
		}
    }
    xmlhttp.send(null);

}

function carrega_selecionaclientevenda_fechar(){

	document.getElementById('produtoslistagem').innerHTML = '';
	document.getElementById('produtoslistagem').style.height = '0px';
	document.getElementById('produtosselecionadoslista').style.height = '310px';

}

function carrega_formapag_chequeparcelado(){

	document.getElementById('formapagamento_cheque_parcelado_etapa1').style.display = 'block';

}

function retorna_valorcadacheque(){

	quantidade_cheque = document.getElementById('formapagamento_cheque_qtd').value;
	total_cada_cheque = valor_total_final/quantidade_cheque;
	document.getElementById('cheque_valor_unico').innerHTML = '<b style="color:blue;">Valor de cada cheque : R$ '+formatadinheiro(total_cada_cheque)+'</b>';

}


/*
var carrega_confirmacaomodopag_status = false;
function carrega_confirmacaomodopag(){

	document.getElementById('btnvoltarvenda').style.display = 'none';
	document.getElementById('btnconfirmapagamento').style.display = 'block';

	var dinheiro, cartaodebito, cartaodebito_tipocartao, cartaocredito, cartaocredito_parcelas, cartaocredito_tipocartao, cheque, cheque_parcelas, cheque_banco, cheque_data;

	if (document.getElementById('valor_dinheiro')){
		dinheiro = ((document.getElementById('valor_dinheiro').value>0)?document.getElementById('valor_dinheiro').value:'');
	} else {
		dinheiro = '';
	}

	if (document.getElementById('chequevalor')){
		cheque = 0;
		var input = document.getElementsByTagName('input');
		for (var i=0; i<input.length; i++){
			var inputs = input[i];
		  	var id = inputs.getAttribute('id');
		  	if (id == 'chequevalor'){
		   		cheque += parseFloat(input[i].value);
		   		alert(cheque);
		  	}
		}
	}

	if (document.getElementById('valor_cartaodebito')){
		cartaodebito = ((document.getElementById('valor_cartaodebito').value>0)?document.getElementById('valor_cartaodebito').value:'');
		cartaodebito_tipocartao = document.getElementById('tipo_cartaodebito').selectedIndex;
	} else {
		cartaodebito = '';
	}

	if (document.getElementById('valor_cartaocredito')){
		cartaocredito = ((document.getElementById('valor_cartaocredito').value>0)?document.getElementById('valor_cartaocredito').value:'');
		cartaocredito_tipocartao = document.getElementById('tipo_cartaocredito').selectedIndex;
		cartaocredito_parcelas = document.getElementById('parcela_cartaocredito').selectedIndex;
	} else {
		cartaocredito = '';
	}

	if( valortroco == '-' || valortroco < 0 ) {
		var produtoslistagem = document.getElementById('produtosselecionadoslista');
		var element = produtoslistagem;
		element.style.height = '310px';
		if ( !carrega_confirmacaomodopag_status ){
			carrega_confirmacaomodopag_status = true;
			xmlhttp.open("GET", path+'modulos/venda/forma_de_pagamento.php?valor='+valor_total_final);
		    xmlhttp.onreadystatechange = function() {
		    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		    		element.innerHTML = xmlhttp.responseText;
					carrega_opcoesformapagamento(dinheiro, cartaodebito, cartaodebito_tipocartao, cartaocredito, cartaocredito_parcelas, cartaocredito_tipocartao, cheque, cheque_parcelas, cheque_banco, cheque_data);
					atualiza_valorfinal();
					carrega_confirmacaomodopag_status = false;

				}
		    }
		    xmlhttp.send(null);
		}
	} else {
		alert(valortroco);
	}
}
*/

var memoria_html_credito = '';
function carrega_dadoscredito(quantidade){

	  document.getElementById('dados_credito_tabela').style.display = 'block';
      document.getElementById('dados_credito').style.display = 'block';

      if ( document.getElementById('dados_credito') && memoria_html_credito.length < 5 )
            memoria_html_credito = document.getElementById('dados_credito').innerHTML;

      document.getElementById('dados_credito').innerHTML = '';

      document.getElementById('exibe_quantidecreditos').innerHTML = '';
      var listatodos_html = '';

      for (i=0;i<quantidade;i++)
            listatodos_html += memoria_html_credito;

      document.getElementById('exibe_quantidecreditos').innerHTML = listatodos_html;

      var input = document.getElementsByTagName('input');
      var campo_numero = 0;
      for (i=0; i<input.length; i++){
            var id = input[i].id;
            if (id == 'creditovalor' || id == 'creditovalor_'+i){
                  input[i].id = 'creditovalor_'+campo_numero;
                  campo_numero++;
            }
      }
      campo_numero = 0;
      var select = document.getElementsByTagName('select');
      for (i=0; i<select.length; i++){
            var id = select[i].id;
            if (id == 'creditoparcela' || id == 'creditoparcela_'+i)
                  select[i].id = 'creditoparcela_'+campo_numero;
            if (id == 'cartaodecredito' || id == 'cartaodecredito_'+i){
                  select[i].id = 'cartaodecredito_'+campo_numero;
                  campo_numero++;
            }

      }
      campo_numero = 0;
      var span = document.getElementsByTagName('span');
      for (i=0; i<span.length; i++){
           var id = span[i].id;
           if (id == 'valortotal_credito' || id == 'valortotal_credito_'+i){
                 span[i].id = 'valortotal_credito_'+campo_numero;
                 campo_numero++;
           }
     }

     //for (i=0;i<quantidade;i++){
     //     multiplicaparcelacredito(1, 'id_'+i);
     //}
}

function multiplicaparcelacredito(value, id){

      var dinheiro=0, cheque=0, debito=0, totalpago=0, total, valor;
      if ( document.getElementById('dinheiro').checked ){
            var dinheiro = document.getElementById('valor_dinheiro').value;
      }
      if ( document.getElementById('debito').checked ){
            var debito = document.getElementById('valor_debito').value;
      }
      if ( document.getElementById('cheque').checked ){
	      var x = document.getElementById('exibe_quantidecheques');
	      var input = x.getElementsByTagName('input');
	      for (i=0;i<input.length;i++){
	            campo = (input[i].id).split('_');
	            if ( campo[0] == 'chequevalor' ){
	                  cheque = parseFloat(cheque)+parseFloat(document.getElementById(input[i].id).value);
	            }
	      }
      }
      var quantidade, campo = id.split('_');

      quantidade = document.getElementById('credito_cartao_qtd').value;

      dinheiro = (dinheiro!='')?dinheiro:0;
      cheque = (cheque!='')?cheque:0;
      debito = (debito!='')?debito:0;

      totalpago = parseFloat(dinheiro)+parseFloat(cheque)+parseFloat(debito);
      if ( totalpago == 0 ){
            valor = (parseFloat(document.getElementById('valortotalvenda').value))/quantidade;
      } else {
            valor = (parseFloat(document.getElementById('valortotalvenda').value)-parseFloat(totalpago))/quantidade;
      }

      valor = (parseFloat(document.getElementById('valortotalvenda').value)-parseFloat(totalpago))/quantidade;

      valor = formatadinheiro(valor/value);
      if ( valor > 0 ){
            document.getElementById('creditovalor_'+campo[1]).value = valor;
            total = parseFloat(valor)*parseFloat(value);
            document.getElementById('valortotal_credito_'+campo[1]).innerHTML = '<b style="color:blue;">Total cartão R$ '+formatadinheiro(total)+'</b>';
      } else {
            document.getElementById('pagamentocomplemento').innerHTML = '<b style="color:red">Atenção<br>A venda encontra-se paga, para adicionar o cartão de crédito altere as formas de pagamento</b>';
            //descarrega_dadoscredito();
      }
}

function descarrega_dadoscredito(){

      document.getElementById('dados_credito_tabela').style.display = 'none';
      document.getElementById('dados_credito').style.display = 'none';
      document.getElementById('dados_credito').innerHTML = memoria_html_credito;
      document.getElementById('exibe_quantidecreditos').innerHTML = '';

}

function carrega_exibicao_credito()
{
      if ( document.getElementById('credito').checked )
      {
      	confirm = comfirmaClienteSelecionado("");
      	if (confirm)
		{
            document.getElementById('credito_cartao_qtd').selectedIndex = 0;
            memoria_html_credito = '';
            carrega_dadoscredito(1);
        }
		else
		{
			document.getElementById('credito').checked = false;
			document.getElementById('pagamentocomplemento').innerHTML =  '<b style="color:red;font-size:18px;">SELECIONE UM CLIENTE PARA PAGAMENTO<br />Com cartão crédito</b>';
		}
      }
      else
      {
            descarrega_dadoscredito();
      }
}

var memoria_html_cheque = '';

function carrega_dadoscheque(quantidade){

	document.getElementById('titcheque').innerHTML = '<b>'+quantidade+' cheque'+((quantidade>1)?'s':'')+'</b>';
	document.getElementById('dados_cheques_tabela').style.display = 'block';

	if ( document.getElementById('dados_cheques') && memoria_html_cheque.length < 5 )
		memoria_html_cheque = document.getElementById('dados_cheques').innerHTML;

	document.getElementById('dados_cheques').innerHTML = '';

	document.getElementById('exibe_quantidecheques').innerHTML = '';
	var listatodos_html = '';

	var dinheiro = (document.getElementById('valor_dinheiro').value)?document.getElementById('valor_dinheiro').value:0;
	var cartao_debito = (document.getElementById('valor_debito').value)?document.getElementById('valor_debito').value:0;
	var totalvenda = formatadinheiro(document.getElementById('valortotalvenda').value);
	var cartao_credito = 0;

	valordavenda_menosopcoes = (parseFloat(dinheiro) + parseFloat(cartao_debito) + parseFloat(cartao_credito))-parseFloat(totalvenda);

	parcelacheque_valor = (quantidade>1)?-1*((parseFloat(valordavenda_menosopcoes))/quantidade):valordavenda_menosopcoes;

	parcelacheque_valor = ((parcelacheque_valor<0)?-1*parcelacheque_valor:parcelacheque_valor);

      for (i=0;i<quantidade;i++)
		listatodos_html += memoria_html_cheque;

	document.getElementById('exibe_quantidecheques').innerHTML = listatodos_html;

	var input = document.getElementsByTagName('input');

	var chequev=0, chequeb=0, chequen=0;
	for (i=0; i<input.length; i++){
	  	var inputs = input[i];
	  	var id = inputs.getAttribute('id');
	  	if (id == 'chequevalor' || id == 'chequevalor_'+i){
	   		input[i].id = 'chequevalor_'+chequev;
	   		chequev++;
	   	//	document.getElementById('chequevalor_'+i).value = formatadinheiro(parcelacheque_valor);
	  	}
	  	if (id == 'chequebanco' || id == 'chequebanco_'+i ){
	  		input[i].id = 'chequebanco_'+chequeb;
	  		document.getElementById('chequebanco_'+chequeb).value = document.getElementById('banco_nome').value;
	  		chequeb++;
	  	}
	  	if (id == 'chequenumero' || id == 'chequenumero_'+i ){
            input[i].id = 'chequenumero_'+chequen;
        	chequen++;
        }
	}

	var mes = 0;
	var mescheque_selectedIndex = 0;
	var select = document.getElementsByTagName('select');
	var mudaano = false;
	var soma_selectedmes = 0 ;
	for (i=0; i<select.length;i++){
		var selects = select[i];
	  	var id = selects.getAttribute('id');
	  	if ( id == 'diacheque' ){
	  	      select[i].id = 'diacheque_'+i;
	  	}

		if (id == 'mescheque'){

			if ( mescheque_selectedIndex == 0 && !mudaano )
				mescheque_selectedIndex = select[i].selectedIndex;

	  		if (soma_selectedmes == 11 ){
	  			mes = 0;
	  			mescheque_selectedIndex = 0;
	  			mudaano = true;
	  		}

	  		soma_selectedmes = (parseFloat(mescheque_selectedIndex)+parseFloat(mes));
	  		select[i].selectedIndex = soma_selectedmes;
	  		select[i].id = 'mescheque_'+i;
	  		mes++;

	  	}

	  	if (id == 'anocheque'){
		  	if (mudaano ){
		  		if (soma_selectedmes >= 0)
		  			select[i].selectedIndex = (parseFloat(select[i].selectedIndex)+parseFloat(1));
		  	}
		  	select[i].id = 'anocheque_'+i;
	  	}

	}
	if ( quantidade == 0 )
		descarrega_dadoscheque();
}

function descarrega_dadoscheque(){

	document.getElementById('dados_cheques_tabela').style.display = 'none';
	document.getElementById('dados_cheques').style.display = 'none';
	document.getElementById('dados_cheques').innerHTML = memoria_html_cheque;

}


function carrega_dadoschequemudabanco(){

	var input = document.getElementsByTagName('input');
	for (var i=0; i<input.length; i++){
		if ( input[i].id == 'chequebanco_'+i ){
	  		input[i].value = document.getElementById('banco_nome').value;
		}
	}

}

function carrega_exibicao_cheque( value ){

	if ( document.getElementById('cheque').checked ){
		carrega_dadoscheque(value);
	} else {
		descarrega_dadoscheque();
	}

}


function carrega_opcoesformapagamento(dinheiro, cartaodebito, cartaodebito_tipocartao, cartaocredito, cartaocredito_parcelas, cartaocredito_tipocartao, cheque, cheque_parcelas, cheque_banco, cheque_data){

	var x=document.getElementById("formapagamento");
	var option = x.getElementsByTagName("input");
	var msgforma = document.getElementById('msgformapag');
	var usuario = document.getElementById('inputclientevendaselecionado').value;
	var i = 0;
	var params = '';
	var cheque = 'false';

	for (loop = 0; loop < option.length; loop++) {
		if ( document.getElementById(option[loop].id).checked == true ){
			params += '&'+option[loop].id+'=true';
			if ( option[loop].id == 'cheque' ){
				cheque = 'true';
			}
			i++
		} else {
			params += '&'+option[loop].id+'=false';
		}
	}

	if ( usuario == 0 && cheque == 'true' ){
		document.getElementById('clientevenda').style.display = 'none';
	} else if ( usuario == 0 ) {
		document.getElementById('clientevenda').style.display = 'block';
	}

	if ( i == 0 ){
		msgforma.innerHTML = '<b style="color:red">Marque uma forma de pagamento</b>';
	} else {
		msgforma.innerHTML = '';
	}

	document.getElementById('titmain').innerHTML = 'Forma de Pagamento Escolhida';
	document.getElementById('titlistagem').innerHTML = '<b style="color:blue">Preencha os dados do pagamento para finalizar a venda</b>';

	var pagamento_opcoes = document.getElementById('pagamento_opcoes');
	var element = pagamento_opcoes;
	pagamento_opcoes.style.height = '260px';
	xmlhttp.open("GET", path+'modulos/venda/forma_pagamento_opcoes.php?usuario='+usuario+params);
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
			preenchecampos_formapagamento(dinheiro, cartaodebito, cartaodebito_tipocartao, cartaocredito, cartaocredito_parcelas, cartaocredito_tipocartao, cheque, cheque_parcelas, cheque_banco, cheque_data)
		}
    }
    xmlhttp.send(null);

}

function preenchecampos_formapagamento(dinheiro, cartaodebito, cartaodebito_tipocartao, cartaocredito, cartaocredito_parcelas, cartaocredito_tipocartao, cheque, cheque_parcelas, cheque_banco, cheque_data){

	if (document.getElementById('valor_dinheiro'))
		document.getElementById('valor_dinheiro').value = dinheiro;

	if (document.getElementById('valor_cartaodebito')){
		document.getElementById('valor_cartaodebito').value = cartaodebito;
		document.getElementById('tipo_cartaodebito').selectedIndex = cartaodebito_tipocartao;
	}

	if (document.getElementById('valor_cartaocredito')){
		document.getElementById('valor_cartaocredito').value = cartaocredito;
		document.getElementById('tipo_cartaocredito').selectedIndex = cartaocredito_tipocartao;
		document.getElementById('parcela_cartaocredito').selectedIndex = cartaocredito_parcelas;
	}

}


function carregar_cancelarvendanao(){

	document.getElementById('cancelar_venda').innerHTML = '';
	document.getElementById('cancelar_venda').style.height = '0px';
	if ( document.getElementById('listaprodutos_refinados') ){
		document.getElementById('listaprodutos_refinados').style.height = '288px';
	} else if ( document.getElementById('listagemprodutos_escolhidos') ) {
		document.getElementById('listagemprodutos_escolhidos').style.height = '310px';
	}
}

function carregar_cancelarvendasim(){

	var usuario = document.getElementById('idusuario').value;
	var cliente;

	if ( document.getElementById('inputclientevendaselecionado') ){
		cliente = document.getElementById('inputclientevendaselecionado').value;
	} else {
		cliente = 0;
	}

	var conteudo_esquerdo = document.getElementById('conteudo_esquerdo');
	conteudo_esquerdo.style.display = 'block';
	conteudo_esquerdo.innerHTML = '';
	var conteudo_direito = document.getElementById('conteudo_direito');
	conteudo_direito.style.display = 'block';
	conteudo_direito.innerHTML = '';

	var element = conteudo_direito;
	xmlhttp.open("GET", path+'modulos/venda/cancelamento_venda.php');
      xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
			document.getElementById('valortotal').value = valor_total_final;
			document.getElementById('usuario').value = usuario;
			document.getElementById('cliente').value = cliente;
			carrega_cancelarvendasim_produtos();
		}
    }
    xmlhttp.send(null);

}

function carrega_cancelarvendasim_produtos(){

	var element = document.getElementById('conteudo_esquerdo');
	xmlhttp.open("GET", path+'modulos/venda/cancelamento_venda_listaprodutos.php');
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
			carrega_cancelarvendasim_produtoslista();
		}
    }
    xmlhttp.send(null);

}

function carrega_cancelarvendasim_produtoslista(){
	var element = document.getElementById('produtos_constavamcarrinho');
	xmlhttp.open("GET", path+'modulos/venda/carrinho_lista_cancelamento.php');
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
			document.getElementById('totalcarrinho').innerHTML = '<h1>Total R$ '+formatadinheiro(valor_total_final)+'</h1>';
		}
    }
    xmlhttp.send(null);
}


function carrega_explicamotivcocancelamento(){

	var cancelamento_informado = document.getElementById('cancelamento_informado').checked;
	var cancelamento_naoinformado = document.getElementById('cancelamento_naoinformado').checked;
	var cancelamento_orcamento = document.getElementById('cancelamento_orcamento').checked;
	var cliente, usuario, controle, valortotal, textomotivo, statusmotivo;

	if ( cancelamento_informado || cancelamento_naoinformado || cancelamento_orcamento ){

		document.getElementById('msginforme').innerHTML = '';

		if ( cancelamento_orcamento ){
			textomotivo = 'Motivo do cancelamento : Orçamento';
			statusmotivo = 0;
		} else if ( cancelamento_naoinformado ) {
			textomotivo = 'Motivo do cancelamento : Não informado';
			statusmotivo = 1;
		} else {
			textomotivo = document.getElementById('textomotivo').value;
			statusmotivo = 2;
		}

		cliente = document.getElementById('cliente').value;
		usuario = document.getElementById('usuario').value;
		controle = document.getElementById('controle').value;
		valortotal = document.getElementById('valortotal').value;

		params = 'cliente='+cliente+'&usuario='+usuario+'&controle='+controle+'&valortotal='+valortotal+'&statusmotivo='+statusmotivo+'&textomotivo='+textomotivo;

		xmlhttp.open("POST", path+'modulos/venda/cancelamento_venda_salvarmotivo.php', true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.setRequestHeader("Content-length", params.length);
		xmlhttp.setRequestHeader("Connection", "close");
		xmlhttp.onreadystatechange = function() {
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				carrega_efetuarvenda(path+'modulos/venda/seleciona_produto.php','conteudo_esquerdo');
			}
		}
		xmlhttp.send(params);
	} else {
		document.getElementById('msginforme').innerHTML = '<b style="color:red">Por favor selecione uma das opções e clique em "confirmar"</b>';
	}

}


function carregar_cancelarvendaconfirmacao(){

	if ( document.getElementById('listaprodutos_refinados') ){
		document.getElementById('listaprodutos_refinados').style.height = '170px';
	}else if ( document.getElementById('listagemprodutos_escolhidos') ) {
		document.getElementById('listagemprodutos_escolhidos').style.height = '208px';
	}
	var produtoslistagem = document.getElementById('cancelar_venda');
	var element = produtoslistagem;
	element.style.height = '80px';
	xmlhttp.open("GET", path+'modulos/venda/confirma_cancelar_venda.php');
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
		}
    }
    xmlhttp.send(null);
	//carrega_efetuarvenda(path+'modulos/venda/seleciona_produto.php','conteudo_esquerdo');

}

/**
 Funcoes venda
**/

var carregar_produtoescolhido_status = false;
function carregar_produtoescolhido(valor){

	if ( !carregar_produtoescolhido_status ){

		carregar_produtoescolhido_status = true;

		if (document.getElementById("opcvenda"))
			opc = document.getElementById("opcvenda").value;

		var conteudo_produtotoslistavenda = document.getElementById('carrinho_counteudo');
		var element = conteudo_produtotoslistavenda;

		xmlhttp.open("GET", path+'modulos/venda/exibe_produto_selecionado.php?p='+valor+'&opc='+opc);
		xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    		carregar_produtoescolhido_status = false;
				element.innerHTML = xmlhttp.responseText;
				//document.getElementById('produtosselecionadoslista').style.height = '100px';
				document.getElementById('btncancelar').style.display = 'none';
				document.getElementById('btnfechar').style.display = 'none';
				document.getElementById('div_btnopcional_final').style.display = 'none';

			}
	    }
	    xmlhttp.send(null);
	}
}

function fechacancelar(){
	carregar_cancelarvendanao();
}


function carrega_iniciovenda_escolhaprodutos(){

	document.getElementById('produtosselecionarcliente').innerHTML = '';
	document.getElementById('produtosselecionarcliente').style.display = 'none';
	document.getElementById('vendapermite').style.display = 'block';
	document.getElementById('codbarra').focus();

}



function carregar_clienteselecionadoparavenda( id, nome ){

	document.getElementById('clientevenda').style.display = 'none';
	document.getElementById('clientevendaselecionado').style.display = 'block';
	document.getElementById('inputclientevendaselecionado').value = id;
	document.getElementById('nomeclientevendaselecionado').innerHTML = nome;
	//document.getElementById('titcliente').innerHTML = '<b>Cliente</b>';
	document.getElementById('btnselecionarcliente').style.backgroundColor = bg_btn_normal;
	if ( document.getElementById('cheque').checked == true){
		//carrega_confirmacaomodopag();
	}

}

var carrega_selecionaclientevenda_status = false;
function carrega_selecionaclientevenda(){

	//document.getElementById('produtosselecionados').style.display = 'none';

	//var produtoslistagem = document.getElementById('carrinho_counteudo');
	//produtoslistagem.style.height = '310px';
	//var element = produtoslistagem;
	if ( !carrega_selecionaclientevenda_status ){
		//carrega_selecionaclientevenda_status = true;
		//xmlhttp.open("GET", path+'modulos/cliente/lista_cliente_venda.php');
	   // xmlhttp.onreadystatechange = function() {
	    	//if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    		//carrega_selecionaclientevenda_status = false;
				//element.innerHTML = xmlhttp.responseText;
				//document.getElementById('titmain').innerHTML = 'Selecionar Cliente para Venda';
			//}
	   // }
	   // xmlhttp.send(null);
	}
}

function exibe_btnconcretizar()
{
	var exibe = 0;
	var d = document.getElementById('formapagamento');
	var input = d.getElementsByTagName('input');
	for (i=0; i<input.length; i++){
		if ( document.getElementById(input[i].id).checked ){
			if ( input[i].id == 'cheque' ){
				carrega_pagamentoemcheque();
			}
			exibe++;
		}
	}


	if ( exibe > 0){
		document.getElementById('btnconfirmapagamento').style.display = 'block';
	}  else {
		document.getElementById('btnconfirmapagamento').style.display = 'none';
	}
}


function exibe_btnconfirmapagamento(exibe)
{
	if ( exibe )
	{
		document.getElementById('btnconfirmapagamento').style.display = 'block';
	}
	else
	{
		document.getElementById('btnconfirmapagamento').style.display = 'none';
	}
}

function carrega_pagamentoemcheque(){

	var idcliente = document.getElementById('inputclientevendaselecionado');
	if ( idcliente.value == 0 ){
		document.getElementById('titcliente').innerHTML = '<b style="color:red;font-size:16px;">SELECIONE UM CLIENTE PARA EFETUAR<BR />O PAGAMENTO EM CHEQUE</b>';
		carrega_selecionaclientevenda();
	} else {
		//document.getElementById('titcliente').innerHTML = '<b>Cliente</b>';
		document.getElementById('btnselecionarcliente').style.backgroundColor = bg_btn_normal;
	}

}

/**
 Funcoes venda final
**/








function carrega_selecionaclientevenda_fechar(){



}


function carrega_carrinholistaretirarproduto( idproduto, valorretirado, desc_acresc )
{

	valorretirado_desc_acrec = valorretirado - desc_acresc

	valor_total_venda_tmp= (parseFloat(valor_total_venda_tmp)-parseFloat(valorretirado_desc_acrec));

	valor_total_final_tmp = (parseFloat(valor_total_final_tmp)-parseFloat(valorretirado));

	valor_desconto_acrescimo_tmp = (parseFloat(valor_desconto_acrescimo_tmp)-parseFloat(desc_acresc));


	if ( valor_total_final < 0 ){
		valor_total_final = '0.00';
		carrega_carrinhoatualizatotal()
	}
	carrega_carrinholista('?retirar='+idproduto);
}



var carrega_estornarvenda_status = false;
function carrega_estornarvenda(url){
	var conteudo_total = document.getElementById('conteudo_total');
	conteudo_total.style.display = 'none';
	conteudo_total.innerHTML = '';
	var conteudo_esquerdo = document.getElementById('conteudo_esquerdo');
	conteudo_esquerdo.style.display = 'block';
	conteudo_esquerdo.innerHTML = '';
	var conteudo_direito = document.getElementById('conteudo_direito');
	conteudo_direito.style.display = 'block';
	conteudo_direito.innerHTML = '';

	var element = conteudo_esquerdo;
	//element.innerHTML = loading_dados;
	if ( !carrega_estornarvenda_status ){
		carrega_estornarvenda_status = true;
		xmlhttp.open("GET", url);
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				element.innerHTML = xmlhttp.responseText;
				carrega_estornarvenda_status = false;
				carrega_estornarvendaproduto()
			}
	    }
	    xmlhttp.send(null);
	}
}

var carrega_estornarvendaproduto_status = false;
function carrega_estornarvendaproduto(){

	var conteudo_direito = document.getElementById('conteudo_direito');
	var element = conteudo_direito;
	if ( !carrega_estornarvendaproduto_status ){
		carrega_estornarvendaproduto_status = true;
		xmlhttp.open("GET", path+'modulos/venda/estornar_venda_produto.php');
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				element.innerHTML = xmlhttp.responseText;
				carrega_estornarvendaproduto_status = false;
			}
	    }
	    xmlhttp.send(null);
	}
}



function carrega_estorno_venda_vip()
{
	carrega_estornocontrolevenda('', 'vip');
}

var carrega_estornocontrolevenda_status = false;
function carrega_estornocontrolevenda(controle, tipo_venda_estorno){

	var ncontrole = document.getElementById('ncontrole');
	var msgerroestorno = document.getElementById('msgerroestorno');
	var apresenta_dadosvenda = document.getElementById('apresenta_dadosvenda');

	t = '';
	url = path+'modulos/venda/estornar_venda_exibedados.php?c='+ncontrole.value+'&t='+t;

	if (tipo_venda_estorno)
	{
		t = tipo_venda_estorno;
		url = path+'modulos/venda/estornar_venda_vip_exibedados.php?c='+ncontrole.value+'&t='+t;
	}


	apresenta_dadosvenda.style.display = 'none';

	if ( !checanumero(ncontrole.value,0) ){
		msgerroestorno.innerHTML = '<b style="color:red">Preencha somente com números</b>';
		ncontrole.style.border = '1px solid red';
	} else {
		if ( (ncontrole.value).length < 8 ){
			msgerroestorno.innerHTML = '<b style="color:red">O código do controle possui 14 dígitos</b>';
		ncontrole.style.border = '1px solid red';
		} else {
			msgerroestorno.innerHTML = '';
			ncontrole.style.border = '1px solid #6aa9e9';
			apresenta_dadosvenda.style.display = 'block';
			var element = document.getElementById('dadosvenda');
			if ( !carrega_estornocontrolevenda_status ){
				carrega_estornocontrolevenda_status = true;
			    xmlhttp.open("GET", url);
			   	xmlhttp.onreadystatechange = function() {
			    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			    			document.getElementById('titdadosvenda').innerHTML = '<b>Dados da venda</b>';
						element.innerHTML = xmlhttp.responseText;
						carrega_estornocontrolevenda_status = false;
						carrega_estornocontrolevenda_produto(ncontrole.value, tipo_venda_estorno);
					}
			    }
			    xmlhttp.send(null);
			}

		}
	}

}

var carregar_efetuarestornovenda_status = false;
function carregar_efetuarestornovenda(tipo_venda){

	var param = '';

	var msg = document.getElementById('msnerroestorno');
	var x = document.getElementById("produtosestornar");

	var select = x.getElementsByTagName("select");
	var input = x.getElementsByTagName("input");

	for (loop = 0; loop < input.length; loop++)
	{
		if (document.getElementById(input[loop].id).checked == true){
			param += '|'+input[loop].value+'-'+select[loop].value;
		}
	}

	url = path+'modulos/venda/estornar_venda_confirmado.php?param='+param;

	if (tipo_venda == 'vip')
	{
		url = path+'modulos/venda/estornar_venda_vip_confirmado.php?param='+param;
	}


	if ( param == '' ){
		msg.innerHTML = '<b style="color:red;">Selecione ao menos um produto para estornar</b>';
	} else {
		msg.innerHTML = '';
		var element = document.getElementById('produtoestornar');
		if ( !carregar_efetuarestornovenda_status ){
			carregar_efetuarestornovenda_status = true;
		    xmlhttp.open("GET", url);
		    //element.innerHTML = loading_dados;
		    xmlhttp.onreadystatechange = function() {
		    		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					//element.innerHTML = xmlhttp.responseText;
					carregar_efetuarestornovenda_status = false;
					carrega_estornocontrolevenda('',tipo_venda);
				}
		    }
		    xmlhttp.send(null);
		}
	}

}


function carregar_alteraropcaoestorno(value){

	var acao;

	if (value == 1){
		acao = 'block';
	} else {
		acao = 'none';
	}

	var x = document.getElementById("produtosestornar");
	var select = x.getElementsByTagName("select");
	for (loop = 0; loop < select.length; loop++) {
		if (document.getElementById(select[loop].id)){
			if ( value == 1){
				document.getElementById(select[loop].id).disabled = false;
			} else {
				document.getElementById(select[loop].id).disabled = true;
			}
		}
	}
	var input = x.getElementsByTagName("input");
	for (loop = 0; loop < input.length; loop++) {
		if (document.getElementById(input[loop].id)){
			if ( value == 1){
				document.getElementById(input[loop].id).disabled = false;
			} else {
				document.getElementById(input[loop].id).disabled = true;
				document.getElementById(input[loop].id).checked = false;
			}
		}
	}

	document.getElementById('btnefetuar_estorno').style.display = acao;

}

var carrega_abrirturno_status = false;
function carrega_abrirturno(){
	var conteudo_total = document.getElementById('conteudo_total');
	conteudo_total.style.display = 'block';
	conteudo_total.innerHTML = '';
	var conteudo_esquerdo = document.getElementById('conteudo_esquerdo');
	conteudo_esquerdo.style.display = 'none';
	conteudo_esquerdo.innerHTML = '';
	var conteudo_direito = document.getElementById('conteudo_direito');
	conteudo_direito.style.display = 'none';
	conteudo_direito.innerHTML = '';

	var element = conteudo_total;
	//element.innerHTML = loading_dados;
	xmlhttp.open("GET", path+'modulos/venda/turno_abrir_dados.php');
    	xmlhttp.onreadystatechange = function() {
    		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
    			if (document.getElementById('abrir_turno'))
    				document.getElementById('abrir_turno').style.display = 'none';
			element.innerHTML = xmlhttp.responseText;
		}
    	}
    xmlhttp.send(null);
}

var carrega_estornocontrolevenda_produto_status = false;
function carrega_estornocontrolevenda_produto(c, tipo_venda){

	var element = document.getElementById('produtosvendidos');
	if ( !carrega_estornocontrolevenda_produto_status ){
		carrega_estornocontrolevenda_produto_status = true;

		url = path+'modulos/venda/estornar_venda_produto_paraestornar.php?c='+c;

		if (tipo_venda)
			url = path+'modulos/venda/estornar_venda_vip_produto_paraestornar.php?c='+c;

	    xmlhttp.open("GET", url);
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    		//document.getElementById('produtoestornar').style.display = 'block';
				element.innerHTML = xmlhttp.responseText;
				carrega_estornocontrolevenda_produto_status = false;
			}
	    }
	    xmlhttp.send(null);
	}

}

var carrega_listagemcliente_status = false;
function carrega_listagemcliente() {
	var conteudo_esquerdo = document.getElementById('conteudo_esquerdo');
	conteudo_esquerdo.style.display = 'none';
	conteudo_esquerdo.innerHTML = '';
	var conteudo_direito = document.getElementById('conteudo_direito');
	conteudo_direito.style.display = 'none';
	conteudo_direito.innerHTML = '';
	var conteudo_total = document.getElementById('conteudo_total');
	conteudo_total.style.display = 'block';
	//conteudo_total.innerHTML = loading(200,360,360);
	if ( !carrega_listagemcliente_status ){
		carrega_listagemcliente_status = true;
	    xmlhttp.open("GET", path+"modulos/cliente/lista.php");
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				conteudo_total.innerHTML = xmlhttp.responseText;
				carrega_listagemcliente_status = false;
				pesquisar_cliente();
			}
	    }
	    xmlhttp.send(null);
	}
}

/* Final Cadastro Cliente */


/* Inicio Relatorios */

/* Produtos Vendidos */
function pesquisar_produto(){
	var txtpesquisa1 = document.getElementById("txtpesquisaproduto").value;
	var buscapor = 1;
	carrega_produtosvendidoslista(path+'modulos/relatorios/produtos_vendidos_exibe.php?produto='+txtpesquisa1+'&qtd='+buscapor);
}

function pesquisar_clienteperiodo(){

	var dia1, mes1, ano1, dia2, mes2, ano2, criterio, paginaproduto;

	paginacliente = 'clientes_vendidosperiodo_exibe';

	dia1 = document.getElementById('dia1').value;
	mes1 = document.getElementById('mes1').value;
	ano1 = document.getElementById('ano1').value;
	dia2 = document.getElementById('dia2').value;
	mes2 = document.getElementById('mes2').value;
	ano2 = document.getElementById('ano2').value;
	cliente_id = document.getElementById('cliente_id').value;

	carrega_produtosvendidoslista(path+'modulos/relatorios/'+paginacliente+'.php?cliente_id='+cliente_id+'&dia1='+dia1+'&mes1='+mes1+'&ano1='+ano1+'&dia2='+dia2+'&mes2='+mes2+'&ano2='+ano2);
}


function pesquisar_fornecedorperiodo(){

	var dia1, mes1, ano1, dia2, mes2, ano2, criterio, paginaproduto;

	paginacliente = 'fornecedor_periodo_exibe';

	dia1 = document.getElementById('dia1').value;
	mes1 = document.getElementById('mes1').value;
	ano1 = document.getElementById('ano1').value;
	dia2 = document.getElementById('dia2').value;
	mes2 = document.getElementById('mes2').value;
	ano2 = document.getElementById('ano2').value;
	fornecedor_id = document.getElementById('cliente_id').value;

	carrega_produtosvendidoslista(path+'modulos/relatorios/'+paginacliente+'.php?fornecedor_id='+fornecedor_id+'&dia1='+dia1+'&mes1='+mes1+'&ano1='+ano1+'&dia2='+dia2+'&mes2='+mes2+'&ano2='+ano2);
}

function pesquisar_produtoperiodo()
{

	var dia1, mes1, ano1, dia2, mes2, ano2, criterio, paginaproduto;

	paginaproduto = 'produtos_vendidosperiodo_exibe';

	dia1 = document.getElementById('dia1').value;
	mes1 = document.getElementById('mes1').value;
	ano1 = document.getElementById('ano1').value;
	dia2 = document.getElementById('dia2').value;
	mes2 = document.getElementById('mes2').value;
	ano2 = document.getElementById('ano2').value;
	produto = (document.getElementById('produtos_criterio').value)?document.getElementById('produtos_criterio').value:0;
	vendido = document.getElementById('vendidos_criterio').value;

	if ( produto==0 ){
		if ( vendido==1 ){
			document.getElementById('tabela_titulos').style.display = 'block';
			document.getElementById('listaprodutosvendidos').style.height = '280px';
			document.getElementById('titrelatorioescolhido').innerHTML = '&nbsp;&nbsp;[ todos os produtos : vendidos ]';
			paginaproduto = 'produtos_vendidosperiodo_exibe';
			document.getElementById('mensagemcriterio').innerHTML = '<b style="color:red">Exibição de todos os produtos vendidos no período selecionado</b>';
		} else if ( vendido==2 ) {
			document.getElementById('tabela_titulos').style.display = 'none';
			document.getElementById('listaprodutosvendidos').style.height = '305px';
			document.getElementById('titrelatorioescolhido').innerHTML = '&nbsp;&nbsp;[ agrupados por cliente : vendidos ]';
			document.getElementById('mensagemcriterio').innerHTML = '<b style="color:red">Exibição dos produtos vendidos somente para os clientes cadastrados</b>';
			paginaproduto = 'produtos_vendidosperiodocliente_exibe';
		} else if ( vendido==3 ) {
			document.getElementById('tabela_titulos').style.display = 'none';
			document.getElementById('listaprodutosvendidos').style.height = '305px';
			document.getElementById('titrelatorioescolhido').innerHTML = '&nbsp;&nbsp;[ agrupados por categoria : vendidos ]';
			document.getElementById('mensagemcriterio').innerHTML = '<b style="color:red">Exibicão dos produtos vendidos somente para os que possuirem uma categoria</b>';
			paginaproduto = 'produtos_vendidosperiodocategoria_exibe';
		} else if ( vendido==4 ) {
			document.getElementById('tabela_titulos').style.display = 'none';
			document.getElementById('listaprodutosvendidos').style.height = '305px';
			document.getElementById('titrelatorioescolhido').innerHTML = '&nbsp;&nbsp;[ agrupados por fornecedor : vendidos ]';
			document.getElementById('mensagemcriterio').innerHTML = '<b style="color:red">Exibição dos produtos vendidos somente para os que possuirem um fornecedor</b>';
			paginaproduto = 'produtos_vendidosperiodofornecedor_exibe';
		} else if ( vendido==5 ) {
			document.getElementById('tabela_titulos').style.display = 'none';
			document.getElementById('listaprodutosvendidos').style.height = '305px';
			document.getElementById('titrelatorioescolhido').innerHTML = '&nbsp;&nbsp;[ agrupados por coleção : vendidos ]';
			document.getElementById('mensagemcriterio').innerHTML = '<b style="color:red">Exibição dos produtos vendidos somente para os que possuirem uma coleção</b>';
			paginaproduto = 'produtos_vendidosperiodocolecao_exibe';
		}
	} else if ( produto==1 ){
		if ( vendido==1 ){
			document.getElementById('tabela_titulos').style.display = 'block';
			document.getElementById('listaprodutosvendidos').style.height = '280px';
			document.getElementById('titrelatorioescolhido').innerHTML = '&nbsp;&nbsp;[ todos os produtos : estornados ]';
			paginaproduto = 'produtos_estornadosperiodo_exibe';
			document.getElementById('mensagemcriterio').innerHTML = '<b style="color:red">Exibição de todos os produtos estornados no período selecionado</b>';
		} else if ( vendido==2 ) {
			document.getElementById('tabela_titulos').style.display = 'none';
			document.getElementById('listaprodutosvendidos').style.height = '305px';
			document.getElementById('titrelatorioescolhido').innerHTML = '&nbsp;&nbsp;[ agrupados por cliente : estornados ]';
			document.getElementById('mensagemcriterio').innerHTML = '<b style="color:red">Exibição dos produtos estornados somente para os clientes cadastrados</b>';
			paginaproduto = 'produtos_estornadosperiodocliente_exibe';
		} else if ( vendido==3 ) {
			document.getElementById('tabela_titulos').style.display = 'none';
			document.getElementById('listaprodutosvendidos').style.height = '305px';
			document.getElementById('titrelatorioescolhido').innerHTML = '&nbsp;&nbsp;[ agrupados por categoria : estornados ]';
			document.getElementById('mensagemcriterio').innerHTML = '<b style="color:red">Exibição dos produtos estornados somente para os que possuirem uma categoria</b>';
			paginaproduto = 'produtos_estornadosperiodocategoria_exibe';
		} else if ( vendido==4 ) {
			document.getElementById('tabela_titulos').style.display = 'none';
			document.getElementById('listaprodutosvendidos').style.height = '305px';
			document.getElementById('titrelatorioescolhido').innerHTML = '&nbsp;&nbsp;[ agrupados por fornecedor : estornados ]';
			document.getElementById('mensagemcriterio').innerHTML = '<b style="color:red">Exibição dos produtos estornados somente para os que possuirem um fornecedor</b>';
			paginaproduto = 'produtos_estornadosperiodofornecedor_exibe';
		} else if ( vendido==5 ) {
			document.getElementById('tabela_titulos').style.display = 'none';
			document.getElementById('listaprodutosvendidos').style.height = '305px';
			document.getElementById('titrelatorioescolhido').innerHTML = '&nbsp;&nbsp;[ agrupados por coleção : estornados ]';
			document.getElementById('mensagemcriterio').innerHTML = '<b style="color:red">Exibição dos produtos estornados somente para os que possuirem uma coleção</b>';
			paginaproduto = 'produtos_estornadosperiodocolecao_exibe';
		}
	}

	carrega_produtosvendidoslista(path+'modulos/relatorios/'+paginaproduto+'.php?dia1='+dia1+'&mes1='+mes1+'&ano1='+ano1+'&dia2='+dia2+'&mes2='+mes2+'&ano2='+ano2);
}

function carrega_produtosclienteslista(url)
{
	var element = document.getElementById('listaprodutosvendidos');
    xmlhttp.open("GET", url);
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
		}
    }
    xmlhttp.send(null);
}


function carrega_produtosvendidoslista(url)
{
	var element = document.getElementById('listaprodutosvendidos');

	//element.innerHTML = loading_dados;
    xmlhttp.open("GET", url);
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
			Behavior.apply();
		}
    }
    xmlhttp.send(null);
}


function carrega_relatorioprodutosvendidos(url, element_id) {
	var element = document.getElementById(element_id);
	var conteudo_esquerdo = document.getElementById('conteudo_esquerdo');
	conteudo_esquerdo.style.display = 'none';
	conteudo_esquerdo.innerHTML = '';
	var conteudo_direito = document.getElementById('conteudo_direito');
	conteudo_direito.style.display = 'none';
	conteudo_direito.innerHTML = '';
	var conteudo_total = document.getElementById('conteudo_total');
	conteudo_total.style.display = 'block';
	//element.innerHTML = loading_dados;
    xmlhttp.open("GET", url);
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
			carrega_produtosvendidoslista(path+'modulos/relatorios/produtos_vendidosperiodo_exibe.php');
		}
    }
    xmlhttp.send(null);
}

function carrega_relatoriofornecedores(url, element_id)
{
	var element = document.getElementById(element_id);
	var conteudo_esquerdo = document.getElementById('conteudo_esquerdo');
	conteudo_esquerdo.style.display = 'none';
	conteudo_esquerdo.innerHTML = '';
	var conteudo_direito = document.getElementById('conteudo_direito');
	conteudo_direito.style.display = 'none';
	conteudo_direito.innerHTML = '';
	var conteudo_total = document.getElementById('conteudo_total');
	conteudo_total.style.display = 'block';
	//element.innerHTML = loading_dados;
    xmlhttp.open("GET", url);
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
			carrega_produtosclienteslista(path+'modulos/relatorios/fornecedor_periodo_exibe.php');
		}
    }
    xmlhttp.send(null);
}

function carrega_relatorioclientes(url, element_id) {
	var element = document.getElementById(element_id);
	var conteudo_esquerdo = document.getElementById('conteudo_esquerdo');
	conteudo_esquerdo.style.display = 'none';
	conteudo_esquerdo.innerHTML = '';
	var conteudo_direito = document.getElementById('conteudo_direito');
	conteudo_direito.style.display = 'none';
	conteudo_direito.innerHTML = '';
	var conteudo_total = document.getElementById('conteudo_total');
	conteudo_total.style.display = 'block';
	//element.innerHTML = loading_dados;
    xmlhttp.open("GET", url);
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
			carrega_produtosclienteslista(path+'modulos/relatorios/clientes_vendidosperiodo_exibe.php');
		}
    }
    xmlhttp.send(null);
}



var carrega_colecaocomparacaografico_status = false;
function carrega_colecaocomparacaografico(){

	var total = 0;
	var url_montada;
	var parametros = '';
	var x=document.getElementById("listacolecao");
	var inputs = x.getElementsByTagName("input");
	for (loop = 0; loop < inputs.length; loop++){
	var item = inputs[loop];
		if (item.type == "checkbox" && item.checked){
			parametros += '&idcol'+total+'='+item.value;
			total++;
		}
	}
	if ( total >= 2 && total <= 10 ){
		var x=document.getElementById("parametro");
		var inputs = x.getElementsByTagName("input");
		for (loop = 0; loop < inputs.length; loop++){
		var item = inputs[loop];
			if (item.type == "radio" && item.checked){
				parametros += '&param='+item.value;
			}
		}
		url_montada = '?total='+total+parametros;
		var conteudo_esquerdo = document.getElementById('conteudo_esquerdo');
		var element = conteudo_esquerdo;
		//element.innerHTML = loading_dados;
		if ( !carrega_colecaocomparacaografico_status ){
			carrega_colecaocomparacaografico_status = true;
			xmlhttp.open("GET", path+'modulos/colecao/colecao_comparar_grafico.php'+url_montada+'');
		    xmlhttp.onreadystatechange = function() {
		    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					element.innerHTML = xmlhttp.responseText;
					carrega_colecaocomparacaografico_status = false;
					document.getElementById('irlistagem_comparar').style.display = 'none';
				}
		    }
		    xmlhttp.send(null);
		}
	} else {
		if ( total == 0 ){
			document.getElementById('mensagem').innerHTML = '<p style="color:red"><b>Por favor, selecione no mínimo duas coleções</b></p>';
		} else if ( total == 1 ) {
			document.getElementById('mensagem').innerHTML = '<p style="color:red"><b>Selecione mais uma ou mais coleções para comparar</b></p>';
		} else {
			document.getElementById('mensagem').innerHTML = '<p style="color:red"><b>Você pode selecionar somente até 10 coleções</b></p>';
		}
	}

}

var cadastro_fornecedor_comparargrafico_status = false;
function cadastro_fornecedor_comparargrafico(){

	var total = 0;
	var url_montada;
	var parametros = '';
	var x = document.getElementById("listafornecedor");
	var inputs = x.getElementsByTagName("input");
	for (loop = 0; loop < inputs.length; loop++){
	var item = inputs[loop];
		if (item.type == "checkbox" && item.checked){
			parametros += '&idfor'+total+'='+item.value;
			total++;
		}
	}
	if ( total >= 2 && total <= 10 ){
		var x=document.getElementById("parametro");
		var inputs = x.getElementsByTagName("input");
		for (loop = 0; loop < inputs.length; loop++){
		var item = inputs[loop];
			if (item.type == "radio" && item.checked){
				parametros += '&param='+item.value;
			}
		}
		url_montada = '?total='+total+parametros;
		var conteudo_esquerdo = document.getElementById('conteudo_esquerdo');
		var element = conteudo_esquerdo;
		//element.innerHTML = loading_dados;
		if ( !carrega_colecaocomparacaografico_status ){
			carrega_colecaocomparacaografico_status = true;
			xmlhttp.open("GET", path+'modulos/fornecedor/fornecedor_comparar_grafico.php'+url_montada+'');
		    xmlhttp.onreadystatechange = function() {
		    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					element.innerHTML = xmlhttp.responseText;
					carrega_colecaocomparacaografico_status = false;
					document.getElementById('irlistagem_comparar').style.display = 'none';
				}
		    }
		    xmlhttp.send(null);
		}
	} else {
		if ( total == 0 ){
			document.getElementById('mensagem').innerHTML = '<p style="color:red"><b>Por favor, selecione no mínimo dois fornecedores</b></p>';
		} else if ( total == 1 ) {
			document.getElementById('mensagem').innerHTML = '<p style="color:red"><b>Selecione mais um ou mais fornecedores para comparar</b></p>';
		} else {
			document.getElementById('mensagem').innerHTML = '<p style="color:red"><b>Você pode selecionar somente até 10 fornecedores</b></p>';
		}
	}

}


function carrega_emissaomailling(){

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
    xmlhttp.open("GET", path+'modulos/extra/mailling_seleciona.php');
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    	{
			conteudo_esquerdo.innerHTML = xmlhttp.responseText;
			geraretiqueta();
		}
    }
    xmlhttp.send(null);

}

function produto_exibe_modotexto(){

	var mg=document.getElementById('modografico'),mt=document.getElementById('modotexto'),dc=document.getElementById('dados_charts'),dt=document.getElementById('dados_texto');
	dc.style.display='none';
	mg.style.display='none';
	dt.style.display='block';
	mt.style.display='block';

}

function produto_exibe_modocharts(){

	var mg=document.getElementById('modografico'),mt=document.getElementById('modotexto'),dc=document.getElementById('dados_charts'),dt=document.getElementById('dados_texto');
	dc.style.display='block';
	mg.style.display='block';
	dt.style.display='none';
	mt.style.display='none';

}

/* Relatorio de vendas */

var pagina;

function troca_relatoriovendas( value, dia1, mes1, ano1, dia2, mes2, ano2 ){

	var divs = new Array('lucratividadevenda', 'lucratividadevendedor');

	document.getElementById('vendedor').selectedIndex = 0;

	for ( i=0; i<divs.length; i++ ){
		document.getElementById(divs[i]).style.display = 'none';
	}

	if ( value == 1 ){
		document.getElementById('lucratividadevenda').style.display = 'block';
		document.getElementById('titrelatorioescolhido').innerHTML = '&nbsp;&nbsp;[ lucratividade por venda ]';
		pagina = 'venda_lucratividade_venda_exibe.php';

		document.getElementById('dia1').value = dia1;
		document.getElementById('mes1').value = mes1;
		document.getElementById('ano1').value = ano1;
		document.getElementById('dia2').value = dia2;
		document.getElementById('mes2').value = mes2;
		document.getElementById('ano2').value = ano2;

	} else if ( value == 2 ) {
		document.getElementById('lucratividadevendedor').style.display = 'block';
		document.getElementById('titrelatorioescolhido').innerHTML = '&nbsp;&nbsp;[ lucratividade por vendedor ]';
		pagina = 'venda_lucratividade_vendedor_exibe.php';

		document.getElementById('dia1_2').value = dia1;
		document.getElementById('mes1_2').value = mes1;
		document.getElementById('ano1_2').value = ano1;
		document.getElementById('dia2_2').value = dia2;
		document.getElementById('mes2_2').value = mes2;
		document.getElementById('ano2_2').value = ano2;

	}

	carrega_relatoriovendaescolhido('');

}


function carrega_relatoriovendaescolhido(url){
	var element = document.getElementById('listavenda');
	//element.innerHTML = loading_dados;
    xmlhttp.open("GET", path+'modulos/relatorios/'+pagina+url);
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
			Behavior.apply();
		}
    }
    xmlhttp.send(null);
}


/* Lucratividade por periodo */
function carrega_relatoriolucratividade(url, element_id) {
	var element = document.getElementById(element_id);
	var conteudo_esquerdo = document.getElementById('conteudo_esquerdo');
	conteudo_esquerdo.style.display = 'none';
	conteudo_esquerdo.innerHTML = '';
	var conteudo_direito = document.getElementById('conteudo_direito');
	conteudo_direito.style.display = 'none';
	conteudo_direito.innerHTML = '';
	var conteudo_total = document.getElementById('conteudo_total');
	conteudo_total.style.display = 'block';
	//element.innerHTML = loading_dados;
    xmlhttp.open("GET", url);
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
			pagina = 'venda_lucratividade_venda_exibe.php';
			carrega_relatoriovendaescolhido('');
		}
    }
    xmlhttp.send(null);
}


function troca_relatorioestoque( value ){

	if ( value == 1 ){
		document.getElementById('tabela_titulos').style.display = 'block';
		document.getElementById('listaestoque').style.height = '290px';
		document.getElementById('titrelatorioescolhido').innerHTML = '&nbsp;&nbsp;[ todos produtos : com estoque ]';
		pagina = 'estoque_todoscom_exibe.php';
	} else if ( value == 2 ) {
		document.getElementById('tabela_titulos').style.display = 'none';
		document.getElementById('listaestoque').style.height = '315px';
		document.getElementById('titrelatorioescolhido').innerHTML = '&nbsp;&nbsp;[ agrupados por categorias : com estoque ]';
		pagina = 'estoque_categoriacom_exibe.php';
	} else if ( value == 3 ) {
		document.getElementById('tabela_titulos').style.display = 'none';
		document.getElementById('listaestoque').style.height = '315px';
		document.getElementById('titrelatorioescolhido').innerHTML = '&nbsp;&nbsp;[ agrupados por fornecedores : com estoque ]';
		pagina = 'estoque_fornecedorcom_exibe.php';
	} else if ( value == 4 ) {
		document.getElementById('tabela_titulos').style.display = 'none';
		document.getElementById('listaestoque').style.height = '315px';
		document.getElementById('titrelatorioescolhido').innerHTML = '&nbsp;&nbsp;[ agrupados por coleções : com estoque ]';
		pagina = 'estoque_colecaocom_exibe.php';
	} else if ( value == 5 ) {
		document.getElementById('tabela_titulos').style.display = 'block';
		document.getElementById('listaestoque').style.height = '290px';
		document.getElementById('titrelatorioescolhido').innerHTML = '&nbsp;&nbsp;[ todos produtos : sem estoque ]';
		pagina = 'estoque_todossem_exibe.php';
	} else if ( value == 6 ) {
		document.getElementById('tabela_titulos').style.display = 'none';
		document.getElementById('listaestoque').style.height = '315px';
		document.getElementById('titrelatorioescolhido').innerHTML = '&nbsp;&nbsp;[ agrupados por categorias : sem estoque ]';
		pagina = 'estoque_categoriasem_exibe.php';
	} else if ( value == 7 ) {
		document.getElementById('tabela_titulos').style.display = 'none';
		document.getElementById('listaestoque').style.height = '315px';
		document.getElementById('titrelatorioescolhido').innerHTML = '&nbsp;&nbsp;[ agrupados por fornecedores : com estoque ]';
		pagina = 'estoque_fornecedorsem_exibe.php';
	} else if ( value == 8 ) {
		document.getElementById('tabela_titulos').style.display = 'none';
		document.getElementById('listaestoque').style.height = '315px';
		document.getElementById('titrelatorioescolhido').innerHTML = '&nbsp;&nbsp;[ agrupados por coleções : sem estoque ]';
		pagina = 'estoque_colecaosem_exibe.php';
	}

	carrega_relatorioestoqueescolhido('');

}

function carrega_relatorioestoqueescolhido(url){
	var element = document.getElementById('listaestoque');
	//element.innerHTML = loading_dados;
    xmlhttp.open("GET", path+'modulos/relatorios/'+pagina+url);
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
			Behavior.apply();
		}
    }
    xmlhttp.send(null);
}

function carrega_relatorioestoque(url, element_id) {
	var element = document.getElementById(element_id);
	var conteudo_esquerdo = document.getElementById('conteudo_esquerdo');
	conteudo_esquerdo.style.display = 'none';
	conteudo_esquerdo.innerHTML = '';
	var conteudo_direito = document.getElementById('conteudo_direito');
	conteudo_direito.style.display = 'none';
	conteudo_direito.innerHTML = '';
	var conteudo_total = document.getElementById('conteudo_total');
	conteudo_total.style.display = 'block';
	//element.innerHTML = loading_dados;
    xmlhttp.open("GET", url);
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
			pagina = 'estoque_todoscom_exibe.php';
			carrega_relatorioestoqueescolhido('');
		}
    }
    xmlhttp.send(null);
}

/* Final Relatorios */



function carrega_conteudototal(url, element_id) {
	var element = document.getElementById(element_id);
	var conteudo_esquerdo = document.getElementById('conteudo_esquerdo');
	conteudo_esquerdo.style.display = 'none';
	conteudo_esquerdo.innerHTML = '';
	var conteudo_direito = document.getElementById('conteudo_direito');
	conteudo_direito.style.display = 'none';
	var conteudo_total = document.getElementById('conteudo_total');
	conteudo_total.style.display = 'block';
	conteudo_direito.innerHTML = '';
	//element.innerHTML = loading_dados;
    xmlhttp.open("GET", url);
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
		}
    }
    xmlhttp.send(null);
}

function carrega_CEP(url) {
	var element = document.getElementById('cepdados');
	//element.innerHTML = loading_dados;
	xmlhttp.open("GET", path+"modulos/cliente/buscacep.php?cep1="+document.getElementById('cep').value+"&cep2="+document.getElementById('cepdv').value);
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
			document.getElementById('mensagem').innerHTML = '<p style="color:red"><b>&raquo; Obs.: Complemente o campo do endereco com os dados do cliente ( Opcional )</b></p>';
		}
    }
    xmlhttp.send(null);
}

function carrega_conteudomeios(url, element_id) {
	var element = document.getElementById(element_id);
	var conteudo_esquerdo = document.getElementById('conteudo_esquerdo');
	conteudo_esquerdo.style.display = 'none';
	var conteudo_direito = document.getElementById('conteudo_direito');
	conteudo_direito.style.display = 'none';
	var conteudo_total = document.getElementById('conteudo_total');
	conteudo_total.style.display = 'block';
	conteudo_total.innerHTML = '';
	//element.innerHTML = loading_dados;
    xmlhttp.open("GET", url);

    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
		}
    }
    xmlhttp.send(null);
}

var msg_sucesso;
var msg = '';
var msg_texto = '';

var editar_dadoscliente_status = false;
function editar_dadoscliente(url, flag){

	msg = '';
	msg_texto = '';
	var status_erro = false;
	var status_obrigatorio = false;

	if (document.getElementById('idcliente')){
		idcliente = document.getElementById('idcliente').value;
	}else{
		idcliente = 0;
	}
	nome = document.getElementById('nome');
	dddtel = document.getElementById('dddtel');
	tel1 = document.getElementById('tel1');
	tel2 = document.getElementById('tel2');
	email = document.getElementById('email');
	identidade = document.getElementById('identidade');
	infoadd = document.getElementById('infoadd');
	dia = document.getElementById('dia');
	mes = document.getElementById('mes');
	dddcel = document.getElementById('dddcel');
	cel1 = document.getElementById('cel1');
	cel2 = document.getElementById('cel2');
	cpf = document.getElementById('cpf');
	cep = document.getElementById('cep');
	cepdv = document.getElementById('cepdv');
	endereco = document.getElementById('endereco');
	bairro = document.getElementById('bairro');
	cidade = document.getElementById('cidade');
	estado = document.getElementById('estado');

	if ( ( !checanumero(cep.value,5) && cep.value ) || ( !checanumero(cepdv.value,3) && cepdv.value ) ){
		msg = '<p style="color:red"><b>O CEP deve conter somente números ( Opcional )</b></p>';
		status_erro = true;
		status_obrigatorio = true;
		cep.style.border = '1px solid red';
		cepdv.style.border = '1px solid red';
	} else {
		cep.style.border = '1px solid #6aa9e9';
		cepdv.style.border = '1px solid #6aa9e9';
	}

	if ( !checanumero(identidade.value,10) && identidade.value ){
		msg = '<p style="color:red"><b>A Identidade deve conter somente números ( Opcional )</b></p>';
		status_erro = true;
		status_obrigatorio = true;
		identidade.style.border = '1px solid red';
	} else {
		identidade.style.border = '1px solid #6aa9e9';
	}

	if ( !checaCPF(cpf.value) && cpf.value ){
		msg = '<p style="color:red"><b>O CPF deve conter somente números ( Opcional )</b></p>';
		status_erro = true;
		status_obrigatorio = true;
		cpf.style.border = '1px solid red';
	} else {
		cpf.style.border = '1px solid #6aa9e9';
	}

	if ( !checaemail(email.value) && email.value ){
		msg = '<p style="color:red"><b>O e-mail do cliente está incorreto ( Opcional )</b></p>';
		status_erro = true;
		status_obrigatorio = true;
		email.style.border = '1px solid red';
	} else {
		email.style.border = '1px solid #6aa9e9';
	}

	if ( !email.value ){
		msg = '<p style="color:grey;font-size:10px;"><b>Solicite ao cliente o e-mail para constar no mailling</b></p>';
		status_erro = false;
		status_obrigatorio = false;
	}

	if ( (!( checanumero(dddcel.value,2) && checanumero(cel1.value,4) && checanumero(cel2.value,4) ) && (dddcel.value || cel1.value || cel2.value) ) ) {
		msg = '<p style="color:red"><b>O telefone 2 deve conter somente números ( Opcional )</b></p>';
		status_erro = true;
		status_obrigatorio = true;
		dddcel.style.border = '1px solid red';
		cel1.style.border = '1px solid red';
		cel2.style.border = '1px solid red';
	} else {
		dddcel.style.border = '1px solid #6aa9e9';
		cel1.style.border = '1px solid #6aa9e9';
		cel2.style.border = '1px solid #6aa9e9';
	}

	if ( !( checanumero(dddtel.value,2) && checanumero(tel1.value,4) && checanumero(tel2.value,4) ) ) {
		msg = '<p style="color:red"><b>O telefone 1 deve conter somente números ( Obrigatório )</b></p>';
		status_erro = true;
		status_obrigatorio = true;
		dddtel.style.border = '1px solid red';
		tel1.style.border = '1px solid red';
		tel2.style.border = '1px solid red';
	} else {
		dddtel.style.border = '1px solid #6aa9e9';
		tel1.style.border = '1px solid #6aa9e9';
		tel2.style.border = '1px solid #6aa9e9';
	}

	if ( !nome.value ){
		msg = '<p style="color:red"><b>Por favor, preencha o nome do cliente ( Obrigatório )</b></p>';
		status_erro = true;
		status_obrigatorio = true;
		nome.style.border = '1px solid red';
	} else {
		nome.style.border = '1px solid #6aa9e9';
	}

	if ( !status_obrigatorio && !status_erro ){

		document.getElementById('mensagem').innerHTML = '...';

		params = "idcliente="+idcliente+"&nome="+nome.value+"&dddtel="+dddtel.value+"&tel1="+tel1.value+"&tel2="+tel2.value+"&email="+email.value+"&identidade="+identidade.value+"&infoadd="+infoadd.value+"&dia="+dia.value+"&mes="+mes.value+"&dddcel="+dddcel.value+"&cel1="+cel1.value+"&cel2="+cel2.value+"&cpf="+cpf.value+"&cep="+cep.value+"&cepdv="+cepdv.value+"&endereco="+endereco.value+"&bairro="+bairro.value+"&cidade="+cidade.value+"&estado="+estado.value;
		if ( !editar_dadoscliente_status ){
			xmlhttp.open("POST", path+url, true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.setRequestHeader("Content-length", params.length);
			xmlhttp.setRequestHeader("Connection", "close");
			xmlhttp.onreadystatechange = function() {
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {

					editar_dadoscliente_status = false;
					msg_sucesso = xmlhttp.responseText;
					msg_sucesso = msg_sucesso.split('|');
					idcliente = msg_sucesso[1];
					msg_sucesso = msg_sucesso[0];
					document.getElementById('mensagem').innerHTML = '<p style="color:green"><b>'+msg_sucesso+'</b></p>' + msg;

					if ( flag == 'adicionar' ){
						document.getElementById('adicionarcliente').style.display = 'none';
						document.getElementById('adicionarnovocliente').style.display = 'block';

						nome.disabled = true;
						dddtel.disabled = true;
						tel1.disabled = true;
						tel2.disabled = true;
						email.disabled = true;
						identidade.disabled = true;
						infoadd.disabled = true;
						dia.disabled = true;
						mes.disabled = true;
						dddcel.disabled = true;
						cel1.disabled = true;
						cel2.disabled = true;
						cpf.disabled = true;
						cep.disabled = true;
						cepdv.disabled = true;
						endereco.disabled = true;
						bairro.disabled = true;
						cidade.disabled = true;
						estado.disabled = true;

					}
					document.getElementById('nomecliente_'+idcliente).innerHTML = nome.value;
				}
			}
			xmlhttp.send(params);
		}
	}else{
		document.getElementById('mensagem').innerHTML = msg;
	}
}



function utilitarios_agenda_atualiza(){



}


function adicionar_dadoscliente(url, flag, voltar_venda){

	msg = '';
	msg_texto = '';
	var status_erro = false;
	var status_obrigatorio = false;

	if (document.getElementById('idcliente')){
		idcliente = document.getElementById('idcliente').value;
	}else{
		idcliente = 0;
	}
	nome = document.getElementById('nome');
	dddtel = document.getElementById('dddtel');
	tel1 = document.getElementById('tel1');
	tel2 = document.getElementById('tel2');
	email = document.getElementById('email');
	identidade = document.getElementById('identidade');
	infoadd = document.getElementById('infoadd');
	dia = document.getElementById('dia');
	mes = document.getElementById('mes');
	dddcel = document.getElementById('dddcel');
	cel1 = document.getElementById('cel1');
	cel2 = document.getElementById('cel2');
	cpf = document.getElementById('cpf');
	cep = document.getElementById('cep');
	cepdv = document.getElementById('cepdv');
	endereco = document.getElementById('endereco');
	bairro = document.getElementById('bairro');
	cidade = document.getElementById('cidade');
	estado = document.getElementById('estado');

	if ( ( !checanumero(cep.value,5) && cep.value ) || ( !checanumero(cepdv.value,3) && cepdv.value ) ){
		msg = '<p style="color:red"><b>O CEP deve conter somente números ( Opcional )</b></p>';
		status_erro = true;
		status_obrigatorio = true;
		cep.style.border = '1px solid red';
		cepdv.style.border = '1px solid red';
	} else {
		cep.style.border = '1px solid #6aa9e9';
		cepdv.style.border = '1px solid #6aa9e9';
	}

	if ( !checanumero(identidade.value,10) && identidade.value ){
		msg = '<p style="color:red"><b>A Identidade deve conter somente números ( Opcional )</b></p>';
		status_erro = true;
		status_obrigatorio = true;
		identidade.style.border = '1px solid red';
	} else {
		identidade.style.border = '1px solid #6aa9e9';
	}

	if ( !checaCPF(cpf.value) && cpf.value ){
		msg = '<p style="color:red"><b>O CPF deve conter somente números ( Opcional )</b></p>';
		status_erro = true;
		status_obrigatorio = true;
		cpf.style.border = '1px solid red';
	} else {
		cpf.style.border = '1px solid #6aa9e9';
	}

	if ( !checaemail(email.value) && email.value ){
		msg = '<p style="color:red"><b>O e-mail do cliente está incorreto ( Opcional )</b></p>';
		status_erro = true;
		status_obrigatorio = true;
		email.style.border = '1px solid red';
	} else {
		email.style.border = '1px solid #6aa9e9';
	}

	if ( !email.value ){
		msg = '<p style="color:grey;font-size:10px;"><b>Solicite ao cliente o e-mail para constar no mailling</b></p>';
		status_erro = false;
		status_obrigatorio = false;
	}

	if ( (!( checanumero(dddcel.value,2) && checanumero(cel1.value,4) && checanumero(cel2.value,4) ) && (dddcel.value || cel1.value || cel2.value) ) ) {
		msg = '<p style="color:red"><b>O telefone 2 deve conter somente números ( Opcional )</b></p>';
		status_erro = true;
		status_obrigatorio = true;
		dddcel.style.border = '1px solid red';
		cel1.style.border = '1px solid red';
		cel2.style.border = '1px solid red';
	} else {
		dddcel.style.border = '1px solid #6aa9e9';
		cel1.style.border = '1px solid #6aa9e9';
		cel2.style.border = '1px solid #6aa9e9';
	}

	if ( !( checanumero(dddtel.value,2) && checanumero(tel1.value,4) && checanumero(tel2.value,4) ) ) {
		msg = '<p style="color:red"><b>O telefone 1 deve conter somente números ( Obrigatório )</b></p>';
		status_erro = true;
		status_obrigatorio = true;
		dddtel.style.border = '1px solid red';
		tel1.style.border = '1px solid red';
		tel2.style.border = '1px solid red';
	} else {
		dddtel.style.border = '1px solid #6aa9e9';
		tel1.style.border = '1px solid #6aa9e9';
		tel2.style.border = '1px solid #6aa9e9';
	}

	if ( !nome.value ){
		msg = '<p style="color:red"><b>Por favor, preencha o nome do cliente ( Obrigatório )</b></p>';
		status_erro = true;
		status_obrigatorio = true;
		nome.style.border = '1px solid red';
	} else {
		nome.style.border = '1px solid #6aa9e9';
	}

	if ( !status_obrigatorio && !status_erro ){

		document.getElementById('mensagem').innerHTML = '...';

		params = "idcliente="+idcliente+"&nome="+nome.value+"&dddtel="+dddtel.value+"&tel1="+tel1.value+"&tel2="+tel2.value+"&email="+email.value+"&identidade="+identidade.value+"&infoadd="+infoadd.value+"&dia="+dia.value+"&mes="+mes.value+"&dddcel="+dddcel.value+"&cel1="+cel1.value+"&cel2="+cel2.value+"&cpf="+cpf.value+"&cep="+cep.value+"&cepdv="+cepdv.value+"&endereco="+endereco.value+"&bairro="+bairro.value+"&cidade="+cidade.value+"&estado="+estado.value;

		xmlhttp.open("POST", path+url, true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.setRequestHeader("Content-length", params.length);
		xmlhttp.setRequestHeader("Connection", "close");
		xmlhttp.onreadystatechange = function() {
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{

				msg_sucesso = xmlhttp.responseText;
				msg_sucesso = msg_sucesso.split('|');
				idcliente = msg_sucesso[1];
				msg_sucesso = msg_sucesso[0];
				document.getElementById('mensagem').innerHTML = '<p style="color:green"><b>'+msg_sucesso+'</b></p>' + msg;

				if (voltar_venda){
					carregar_cliente_finalselecionadoparavenda(idcliente, document.getElementById('nome').value);
					cliente_voltar_venda();
					return;
				}

				if ( flag == 'adicionar' ){
					document.getElementById('adicionarcliente').style.display = 'none';
					document.getElementById('adicionarnovocliente').style.display = 'block';

					nome.disabled = true;
					dddtel.disabled = true;
					tel1.disabled = true;
					tel2.disabled = true;
					email.disabled = true;
					identidade.disabled = true;
					infoadd.disabled = true;
					dia.disabled = true;
					mes.disabled = true;
					dddcel.disabled = true;
					cel1.disabled = true;
					cel2.disabled = true;
					cpf.disabled = true;
					cep.disabled = true;
					cepdv.disabled = true;
					endereco.disabled = true;
					bairro.disabled = true;
					cidade.disabled = true;
					estado.disabled = true;

					var element = document.getElementById('conteudo_esquerdo');
				    xmlhttp.open("GET", path+'modulos/cliente/cliente_adicionar_obs.php');
				    xmlhttp.onreadystatechange = function() {
				    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
				    	{
			    			element.innerHTML = xmlhttp.responseText;
						}
				    }
				    xmlhttp.send(null);

				}

			}
		}
		xmlhttp.send(params);

	}else{
		document.getElementById('mensagem').innerHTML = msg;
	}

}


function carregar_editardadoscliente(idcliente){

	var element = document.getElementById('conteudo_direito');
	////element.innerHTML = loading_dados;
    xmlhttp.open("GET", path+'modulos/cliente/cliente_editar.php?id='+idcliente);
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
    		element.innerHTML = xmlhttp.responseText;
			//document.getElementById('mensagem').innerHTML = '<p style="color:green"><b>&raquo; '+msg_sucesso+'</b></p>' + msg;
		}
    }
    xmlhttp.send(null);

}


function troca_dadoscliente(){
	// depreced ----> mudar
	var element = document.getElementById('conteudo_direito');
	//element.innerHTML = loading_dados;
    xmlhttp.open("GET", path+'modulos/cliente/editar.php?refer=cadastro');
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
    		element.innerHTML = xmlhttp.responseText;
			listasimples_cliente('listagem');
			document.getElementById('mensagem').innerHTML = '<p style="color:green"><b>&raquo; '+msg_sucesso+'</b></p>' + msg;
		}
    }
    xmlhttp.send(null);
}


var obsCPF = false;

function editar_cliente_cpf(){
	if (!obsCPF){
		document.getElementById('mensagem').innerHTML = '<p style="color:red;"><b>CPF deve conter somente números ( Opcional )</b></p>';
		obsCPF = true;
	}else{
		document.getElementById('mensagem').innerHTML = '';
		obsCPF = false;
	}
}

var obsRG = false;

function editar_cliente_rg(){
	if (!obsRG){
		document.getElementById('mensagem').innerHTML = '<p style="color:red;"><b>Identidade deve conter somente números ( Opcional )</b></p>';
		obsRG = true;
	}else{
		document.getElementById('mensagem').innerHTML = '';
		obsRG = false;
	}
}


function gradeproduto(){
	var element = document.getElementById('cadastrograde');
	element.style.display = 'block';
	//element.innerHTML = loading_dados;
    xmlhttp.open("GET", path+'modulos/produto/grade_cadastro.php');
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
    		element.innerHTML = xmlhttp.responseText;
    		carrega_listagrade();
		}
    }
    xmlhttp.send(null);

}


function carrega_listagrade() {
	document.getElementById('listagrade').style.display = 'block';
	var element = document.getElementById('listagrade');
	//element.innerHTML = loading_dados;
    xmlhttp.open("GET", path+'modulos/produto/lista_grade_cadastro.php');
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
		}
    }
    xmlhttp.send(null);
}


function cadgradedados(){

	var nomegrade = document.getElementById('nomegrade');
	var qtdgrade = document.getElementById('qtdgrade');
	var qtdestoquetotal = document.getElementById('qtdestoque');
	var qtdestoque = document.getElementById('qtdestoque');
	var qtdgradeatual;

	if ( !nomegrade.value ){
		alert('Por favor, preencha o nome da grade corretamente');
	} else {
		if ( !checanumero(qtdgrade.value,0) ){
			alert('Por favor, preencha a quantidade do produto da grade corretamente');
		} else {
			if ( !qtdestoque.readOnly ){
				qtdestoque.readOnly = true;
				qtdestoque.value = 0;
			}

			qtdgradeatual = qtdgrade.value;
			var element = document.getElementById('listagrade');
			////element.innerHTML = loading_dados;
		    xmlhttp.open("GET", path+'modulos/produto/lista_grade.php?nomegrade='+nomegrade.value+'&quantidade='+qtdgrade.value);
		    xmlhttp.onreadystatechange = function() {
		    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					element.innerHTML = xmlhttp.responseText;
					if ( !qtdestoque.value ){
						qtdestoque.value += parseFloat(qtdgradeatual);
						qtdestoque.style.border = '1px solid #6aa9e9';
						qtdestoque.style.color = '#484848';
					} else {
						qtdestoque.value = parseFloat(qtdestoque.value) + parseFloat(qtdgradeatual);
						qtdestoque.style.border = '1px solid #6aa9e9';
						qtdestoque.style.color = '#484848';
					}
				}
		    }
		    xmlhttp.send(null);
			document.getElementById('listagrade').style.display = 'block';
		}
	}

}

var listasimples_historicoproduto_status = false;
function listasimples_historicoproduto(url,acao){
	var element = document.getElementById('conteudo_esquerdo');
	//element.innerHTML = loading_dados;
	if ( !listasimples_historicoproduto_status ){
		listasimples_historicoproduto_status = true;
	    xmlhttp.open("GET", path+'modulos/produto/historico_produto.php'+url+'&origem='+acao);
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    		listasimples_historicoproduto_status = false;
	    		element.innerHTML = xmlhttp.responseText;
	    		if ( acao == 'grade' ){
	    			gradeproduto();
	    		}
	    	}
	    }
	    xmlhttp.send(null);
	}
}

var listasimples_historicocliente_status = false;
function listasimples_historicocliente(url){
	var element = document.getElementById('conteudo_esquerdo');
	//element.innerHTML = loading_dados;
	if ( !listasimples_historicocliente_status ){
		listasimples_historicocliente_status = true;
	    xmlhttp.open("GET", path+'modulos/cliente/historico_cliente.php'+url);
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    		listasimples_historicocliente_status = false;
	    		element.innerHTML = xmlhttp.responseText;
	    	}
	    }
	    xmlhttp.send(null);
	}
}


function carrega_editarproduto(url){
	var conteudo_total = document.getElementById('conteudo_total');
	conteudo_total.style.display = 'none';
	conteudo_total.innerHTML = '';
	var conteudo_esquerdo = document.getElementById('conteudo_esquerdo');
	conteudo_esquerdo.style.display = 'block';
	conteudo_esquerdo.innerHTML = '';
	var conteudo_direito = document.getElementById('conteudo_direito');
	conteudo_direito.style.display = 'block';
	conteudo_direito.innerHTML = '';

	var element = conteudo_direito;
	//element.innerHTML = loading_dados;
	xmlhttp.open("GET", path+'modulos/produto/produto_editar.php'+url);
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
			lista_editargrade();
			if ( document.getElementById('qtdestoque') ){
				var qtdestoque = document.getElementById('qtdestoque');
				if ( qtdestoque.value == 0 ){
					qtdestoque.style.color = 'red';
					qtdestoque.style.border = '1px solid red';
				} else {
					qtdestoque.style.color = '#484848';
					qtdestoque.style.border = '1px solid #6aa9e9';
				}
			}
		}
    }
    xmlhttp.send(null);

}

function carrega_dadosproduto(url){

	var conteudo_total = document.getElementById('conteudo_total');
	conteudo_total.style.display = 'none';
	conteudo_total.innerHTML = '';
	var conteudo_esquerdo = document.getElementById('conteudo_esquerdo');
	conteudo_esquerdo.style.display = 'block';
	conteudo_esquerdo.innerHTML = '';
	var conteudo_direito = document.getElementById('conteudo_direito');
	conteudo_direito.style.display = 'block';
	conteudo_direito.innerHTML = '';

	var element = conteudo_direito;
	//element.innerHTML = loading_dados;
	xmlhttp.open("GET", path+'modulos/produto/produto_mostradados.php'+url);
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
			listasimples_historicoproduto(url,'');
		}
    }
    xmlhttp.send(null);

}


function ajuda_definir_preco(){
	var element = document.getElementById('conteudo_esquerdo');
	//element.innerHTML = loading_dados;
    xmlhttp.open("GET", path+'modulos/produto/ajuda_formacao_preco.php');
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
		}
    }
    xmlhttp.send(null);
}


function calcular_markupavancado(value){

	document.getElementById('markup_avancado').style.display = 'none';
	var element = document.getElementById('resposta_markup');
	if (value == '1'){
		lucro = (document.getElementById('meulucrovarejo').value).replace(',','.');
	}
	//element.innerHTML = loading_dados;

	vlcusto = (document.getElementById('vlcusto').value).replace(',','.');
	ir = (document.getElementById('ir').value).replace(',','.');
	cofins = (document.getElementById('cofins').value).replace(',','.');
	icms = (document.getElementById('icms').value).replace(',','.');
	pis = (document.getElementById('pis').value).replace(',','.');
	outro = (document.getElementById('outro').value).replace(',','.');
	cartao = (document.getElementById('cartao').value).replace(',','.');
	comissao = (document.getElementById('comissao').value).replace(',','.');
	outra = (document.getElementById('outra').value).replace(',','.');

	params = "vlcusto="+vlcusto+"&ir="+ir+"&cofins="+cofins+"&icms="+icms+"&pis="+pis+"&outro="+outro+"&cartao="+cartao+"&comissao="+comissao+"&outra="+outra+"";

	if (value == '1'){
		params += "&lucro="+lucro;
	}

	xmlhttp.open("POST", path+'modulos/produto/forma_markup_avancado.php', true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", params.length);
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.onreadystatechange = function() {
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.send(params);

}

var carrega_pesquisaproduto_status = false;
function carrega_pesquisaproduto(url){
	var element = document.getElementById('listaprodutos');
	//element.innerHTML = loading_dados;
    if ( !carrega_pesquisaproduto_status ){
    	carrega_pesquisaproduto_status = true;
		xmlhttp.open("GET", url);
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    		carrega_pesquisaproduto_status = false;
				element.innerHTML = xmlhttp.responseText;
			}
	    }
	    xmlhttp.send(null);
    }
}

var carrega_listagemprodutos_status = false;
function carrega_listagemprodutos(url, element_id) {
	var element = document.getElementById(element_id);
	var conteudo_esquerdo = document.getElementById('conteudo_esquerdo');
	conteudo_esquerdo.style.display = 'none';
	conteudo_esquerdo.innerHTML = '';
	var conteudo_direito = document.getElementById('conteudo_direito');
	conteudo_direito.style.display = 'none';
	conteudo_direito.innerHTML = '';
	var conteudo_total = document.getElementById('conteudo_total');
	conteudo_total.style.display = 'block';
	//element.innerHTML = loading_dados;
    if ( !carrega_listagemprodutos_status ){
    	carrega_listagemprodutos_status = true;
		xmlhttp.open("GET", url);
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				element.innerHTML = xmlhttp.responseText;
				carrega_listagemprodutos_status = false;
				pesquisarproduto();
			}
	    }
	    xmlhttp.send(null);
    }
}

var historicofornecedor_status = false;
function historicofornecedor(){
	var element = document.getElementById('conteudo_esquerdo');
	//element.innerHTML = loading_dados;
	if (!historicofornecedor_status){
		historicofornecedor_status = true;
	    xmlhttp.open("GET", path+'modulos/fornecedor/historico_fornecedor.php');
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    		historicofornecedor_status = false;
				element.innerHTML = xmlhttp.responseText;
				if ( document.getElementById('geracomparacaocolecao') ){
					document.getElementById('irlistagem_comparar').style.display = 'block';
				}
			}
	    }
	    xmlhttp.send(null);
	}
}

var listasimples_historicocolecao_status = false;
function listasimples_historicocolecao(value){
	var element = document.getElementById('conteudo_esquerdo');
	//element.innerHTML = loading_dados;
	if (!listasimples_historicocolecao_status){
		listasimples_historicocolecao_status = true;
	    xmlhttp.open("GET", path+'modulos/colecao/historico_colecao_dados.php?c='+value);
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    		listasimples_historicocolecao_status = false;
				element.innerHTML = xmlhttp.responseText;
			}
	    }
	    xmlhttp.send(null);
	}
}

var historicocolecao_status = false;
function historicocolecao(){
	var element = document.getElementById('conteudo_esquerdo');
	//element.innerHTML = loading_dados;
	if (!historicocolecao_status){
		historicocolecao_status = true;
	    xmlhttp.open("GET", path+'modulos/colecao/historico_colecao.php');
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    		historicocolecao_status = false;
				element.innerHTML = xmlhttp.responseText;
				if ( document.getElementById('geracomparacaocolecao') ){
					document.getElementById('irlistagem_comparar').style.display = 'block';
				}
			}
	    }
	    xmlhttp.send(null);
	}
}

var carrega_dadoscolecao_status = false;
function carrega_dadoscolecao(url){
	var element = document.getElementById('conteudo_direito');
	//element.innerHTML = loading_dados;
    if ( !carrega_dadoscolecao_status ){
    	carrega_dadoscolecao_status = true;
		xmlhttp.open("GET", path+'modulos/colecao/colecao_dados.php?id='+url);
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				element.innerHTML = xmlhttp.responseText;
				carrega_dadoscolecao_status = false;
			}
	    }
	    xmlhttp.send(null);
    }
}

var carrega_dadosfornecedor_status = false;
function carrega_dadosfornecedor(url){
	var element = document.getElementById('conteudo_direito');
	//element.innerHTML = loading_dados;
    if ( !carrega_dadosfornecedor_status ){
    	carrega_dadosfornecedor_status = true;
		xmlhttp.open("GET", path+'modulos/fornecedor/fornecedor_dados.php?id='+url);
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				element.innerHTML = xmlhttp.responseText;
				carrega_dadosfornecedor_status = false;
			}
	    }
	    xmlhttp.send(null);
    }
}

var carrega_dadoscolecaoproduto_status = false;
function carrega_dadoscolecaoproduto(url){
	var element = document.getElementById('conteudo_direito');
	//element.innerHTML = loading_dados;
    if ( !carrega_dadoscolecao_status ){
    	carrega_dadoscolecao_status = true;
		xmlhttp.open("GET", path+'modulos/colecao/colecao_dados.php?id='+url);
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				element.innerHTML = xmlhttp.responseText;
				carrega_dadoscolecao_status = false;
				historicocolecao();
			}
	    }
	    xmlhttp.send(null);
    }
}

function pesquisarfornecedor(url, flag){
	var element = document.getElementById('listafornecedor');
	//element.innerHTML = loading_dados;
    xmlhttp.open("GET", url);
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
			if ( flag == 'historico' ){
				historicofornecedor();
			}
		}
    }
    xmlhttp.send(null);
}

function pesquisarcolecao(url, flag){
	var element = document.getElementById('listacolecao');
	//element.innerHTML = loading_dados;
    xmlhttp.open("GET", url);
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
			if ( flag == 'historico' ){
				historicocolecao();
			}
		}
    }
    xmlhttp.send(null);
}

var carrega_listagemcolecoes_status = false;
function carrega_listagemcolecoes(url, element_id, flag) {
	var element = document.getElementById(element_id);
	if ( flag == 'historico' ){
		var conteudo_esquerdo = document.getElementById('conteudo_esquerdo');
		conteudo_esquerdo.style.display = 'block';
		conteudo_esquerdo.innerHTML = '';
	} else if ( flag == 'comparacao' ){
		document.getElementById('irlistagem_resultado').style.display = 'none';
		document.getElementById('irestatisticas_resultado').style.display = 'none';
	}
	var conteudo_direito = document.getElementById('conteudo_direito');
	conteudo_direito.style.display = 'block';
	conteudo_direito.innerHTML = '';
	var conteudo_total = document.getElementById('conteudo_total');
	conteudo_total.style.display = 'none';
	//element.innerHTML = loading_dados;
	if ( !carrega_listagemcolecoes_status ){
		carrega_listagemcolecoes_status = true;
	    xmlhttp.open("GET", url);
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    		carrega_listagemcolecoes_status = false;
				element.innerHTML = xmlhttp.responseText;
				pesquisarcolecao(path+'modulos/colecao/buscar_colecoes.php', flag);
			}
	    }
	    xmlhttp.send(null);
	}
}

var carrega_listagemfornecedores_status = false;
function carrega_listagemfornecedores(url, element_id, flag) {
	var element = document.getElementById(element_id);
	if ( flag == 'historico' ){
		var conteudo_esquerdo = document.getElementById('conteudo_esquerdo');
		conteudo_esquerdo.style.display = 'block';
		conteudo_esquerdo.innerHTML = '';
	} else if ( flag == 'comparacao' ){
		document.getElementById('irlistagem_resultado').style.display = 'none';
		document.getElementById('irestatisticas_resultado').style.display = 'none';
	}
	var conteudo_direito = document.getElementById('conteudo_direito');
	conteudo_direito.style.display = 'block';
	conteudo_direito.innerHTML = '';
	var conteudo_total = document.getElementById('conteudo_total');
	conteudo_total.style.display = 'none';
	//element.innerHTML = loading_dados;
	if ( !carrega_listagemcolecoes_status ){
		carrega_listagemcolecoes_status = true;
	    xmlhttp.open("GET", url);
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    		carrega_listagemcolecoes_status = false;
				element.innerHTML = xmlhttp.responseText;
				pesquisarfornecedor(path+'modulos/fornecedor/buscar_fornecedor.php', flag);
			}
	    }
	    xmlhttp.send(null);
	}
}

function listasimples_historicfornecedor(value){
	var element = document.getElementById('conteudo_esquerdo');
	//element.innerHTML = loading_dados;
	if (!listasimples_historicocolecao_status){
		listasimples_historicocolecao_status = true;
	    xmlhttp.open("GET", path+'modulos/fornecedor/historico_fornecedor_dados.php?id='+value);
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    		listasimples_historicocolecao_status = false;
				element.innerHTML = xmlhttp.responseText;
			}
	    }
	    xmlhttp.send(null);
	}
}

/**
 * Valores pre definidos aqui, estes dados provavelmente serão retornados pelo 'client side'
 */
var ordenaporque = 'ASC';
var buscarpor2 = 'txtproduto';

function pesquisarproduto()
{
	var txtpesquisa = document.getElementById("pesquisaproduto").value;
	var buscarpor, fornecedor, tipoprod;
	var quant = 0;
	if ( document.getElementById("rdopesquisaprod").checked == true){
		buscarpor = 'txtproduto';
		txtpesquisa = txtpesquisa.toUpperCase();
	} else if ( document.getElementById("rdopesquisacodigo").checked == true ) {
		buscarpor = 'idproduto';
	} else if ( document.getElementById("rdopesquisacodbarra").checked == true ){
		buscarpor = 'cod_barra';
	}
	if ( document.getElementById("produtofornec") )
		fornecedor = document.getElementById("produtofornec").value;
	if ( document.getElementById("produtotipo") )
		tipoprod = document.getElementById("produtotipo").value;
	if ( document.getElementById("produtocolecao") )
		colprod = document.getElementById("produtocolecao").value;

	if (buscarpor2 == 'idcliente')
	{
		buscarpor2 = 'idproduto';
	}

	carrega_pesquisaproduto(path+'modulos/produto/busca.php?c='+buscarpor+'&c2='+buscarpor2+'&s='+txtpesquisa+'&f='+fornecedor+'&t='+tipoprod+'&quant='+quant+'&col='+colprod+'&order='+ordenaporque);

}


var orderaction = "ASC";


function ordenaproduto(value, value2){
	var imgs = new Array('issetcodigo', 'issetproduto', 'issetcolecao', 'issetvalor', 'issetestoque');
	for ( valueimg in imgs ){
		document.getElementById(imgs[valueimg]).src = path+'imgs/asset.png';
	}
	if ( orderaction == "ASC" ){
		orderaction = "DESC";
		document.getElementById(value2).src = path+'imgs/asset2.png';
	} else {
		orderaction = "ASC";
		document.getElementById(value2).src = path+'imgs/asset.png';
	}
	ordenaporque = orderaction;
	buscarpor2 = value;
	pesquisarproduto();
}

function exibe_msgcredito_checkbox(){

	var tpcartaocredito = document.getElementById('tipo_cartaocredito');
	if ( tpcartaocredito.value == ' ' ){

	} else if ( tpcartaocredito.value == 0 ) {
		document.getElementById('real').style.display = 'none';
		document.getElementById('valor_credito').style.display = 'none';
	} else {
		document.getElementById('real').style.display = 'block';
		document.getElementById('valor_credito').style.display = 'block';
	}

}

function carrega_esvaziacheque()
{
      document.getElementById('pagamentocomplemento').innerHTML = '';
      //document.getElementById('titcliente').innerHTML = '<b>Cliente</b>';
      document.getElementById('btnselecionarcliente').style.backgroundColor = bg_btn_normal;
      document.getElementById('btnadicionarcliente').style.backgroundColor = bg_btn_normal;
      document.getElementById('cheque_qtd').value = 0;
      document.getElementById('select_cheque').selectedIndex = 0;
      document.getElementById('exibe_quantidecheques').innerHTML = '';
      document.getElementById('dados_cheques_tabela').style.display = 'none';
}






function vendapagamento_desabilita(){

	var input_checkbox = new Array();
	var x = document.getElementById('venda_normal');
	var input = x.getElementsByTagName('input');
	for (i=0;i<input.length;i++){
		if (document.getElementById(input[i].id)){
		    document.getElementById(input[i].id).disabled = true;
		}
	}
	var select = x.getElementsByTagName('select');
	for (i=0;i<select.length;i++){
		if (document.getElementById(select[i].id)){
		    document.getElementById(select[i].id).disabled = true;
		}
	}

	var p = document.getElementById('pagamento_counteudo');
	var input = p.getElementsByTagName('input');
	for (i=0;i<input.length;i++){
	      if (document.getElementById(input[i].id)){
		    document.getElementById(input[i].id).disabled = true;
	      }
	}
	var select = p.getElementsByTagName('select');
	for (i=0;i<select.length;i++){
	      if (document.getElementById(select[i].id)){
		    document.getElementById(select[i].id).disabled = true;
	      }
	}
	document.getElementById('btnvoltarvenda').disabled = true;
	document.getElementById('btnfinalizarvenda').disabled = false;


}

function carrega_abrepagamento_credito(){

	var credito = document.getElementById('tipo_cartaocredito').value;

	if ( credito > 0 ){
		document.getElementById('cartao_credito_opc').style.display = 'block';
	} else {

	}

}

function definevalor_falta(){

      var dinheiro=0, cheque=0, debito=0, credito=0;
      if ( document.getElementById('dinheiro').checked ){
            var dinheiro = document.getElementById('valor_dinheiro').value;
      }
      if ( document.getElementById('debito').checked ){
            var debito = document.getElementById('valor_debito').value;
      }
      if ( document.getElementById('cheque').checked ){
            var x = document.getElementById('exibe_quantidecheques');
            var input = x.getElementsByTagName('input');
            for (i=0;i<input.length;i++){
                  campo = (input[i].id).split('_');
                  if ( campo[0] == 'chequevalor' ){
                        cheque = parseFloat(cheque)+parseFloat(document.getElementById(input[i].id).value);
                  }
            }
      }
      if ( document.getElementById('credito').checked ){
            var x = document.getElementById('exibe_quantidecreditos');
            var input = x.getElementsByTagName('input');
            for (i=0;i<input.length;i++){
                  campo = (input[i].id).split('_');
                  if ( campo[0] == 'creditovalor' ){
                        credito = parseFloat(credito)+parseFloat(document.getElementById(input[i].id).value);
                  }
            }
      }

}


function carrega_valordebito(){

      var valorcompra = document.getElementById('valortotalvenda').value;
      var dinheiro = document.getElementById('valor_dinheiro').value;
      var valordinheirotroco = (parseFloat(dinheiro)-parseFloat(valorcompra));
      var cheque = document.getElementById('cheque');

      if ( valordinheirotroco >= 0 ){
            document.getElementById('pagamentocomplemento').innerHTML = '<b style="color:red">Atenção<br>Para adicionar o cartão de débito deve alterar as formas de pagamento</b>';
            document.getElementById('debito').checked = false;
            document.getElementById('pag_debito').style.display = 'none';
      } else {
            var valor = '';
            if ( !cheque.checked ){
	            if ( dinheiro ){
	                  valor = formatadinheiro(-1*(valordinheirotroco));
	            } else {
	                  valor = valorcompra;
	            }
            } else {
                  valor = '';
            }
            document.getElementById('valor_debito').value = valor;
      }

}

function carrega_finalizarvenda()
{

	  var params = '';
      var dinheiro, cheque, debito, credito, outro, parcelas, idcartao, cliente, usuario, totalvenda, opcvenda, terminal, valorcompra, valordinheirotroco, tipo_venda;

      dinheiro = document.getElementById('valor_dinheiro').value;

      valorcompra = document.getElementById('valortotalvenda').value;
      valordinheirotroco = (parseFloat(dinheiro)-parseFloat(valorcompra));

      cliente = document.getElementById('inputclientevendaselecionado').value;
      usuario = document.getElementById('usuario').value;
      totalvenda = document.getElementById('valortotalvenda').value;
      opcvenda = document.getElementById('opcvendatotal').value;
      opcvenda_final = document.getElementById('opcvendatotal_final').value;
      terminal = 1;
      idcartao = 0;
      parcelas = 0;
      parcelas_cartao = 0;

	 tipo_venda = document.getElementById('tipo_venda').value;

      //if ( forma_pag['dinheiro'] ){
            //dinheiro = formatadinheiro(parseFloat(dinheiro)-parseFloat(valordinheirotroco));
     //       if (dinheiro<0){
            //	dinheiro = 0;
      //      }
      //}

      //if ( forma_pag['cheque'] ){

            parcelas = document.getElementById('cheque_qtd').value;

            cheque = '&cheque='+parcelas;
            var campo;
            var x = document.getElementById('exibe_quantidecheques');
            var input = x.getElementsByTagName('input');
            var st_banco=0, st_numero=0, stvalor=0;
            for (i=0;i<input.length;i++){
                  campo = (input[i].id).split('_');
                  if ( campo[0] == 'chequebanco' ){
                        cheque += '&chequebanco_'+st_banco+'='+document.getElementById(input[i].id).value;
                        st_banco++;
                  }
                  if ( campo[0] == 'chequenumero' ){
                        cheque += '&chequenumero_'+st_numero+'='+document.getElementById(input[i].id).value;
                        st_numero++;
                  }
                  if ( campo[0] == 'chequevalor' ){
                        cheque += '&chequevalor_'+stvalor+'='+document.getElementById(input[i].id).value;
                        stvalor++;
                  }
            }
            var select = x.getElementsByTagName('select');
            var st_dia=0, st_mes=0, st_ano=0;
            for (i=0;i<select.length;i++){
                  campo = (select[i].id).split('_');
                  if ( campo[0] == 'diacheque' ){
                        cheque += '&diacheque_'+st_dia+'='+document.getElementById(select[i].id).value;
                        st_dia++;
                  }
                  if ( campo[0] == 'mescheque' ){
                        cheque += '&mescheque_'+st_mes+'='+document.getElementById(select[i].id).value;
                        st_mes++;
                  }
                  if ( campo[0] == 'anocheque' ){
                        cheque += '&anocheque_'+st_ano+'='+document.getElementById(select[i].id).value;
                        st_ano++
                  }
            }

      //} else {
      //      cheque = '&cheque=0';
     // }

      //if ( forma_pag['debito'] ){

            var valorpossivel, valor, idcartao;
            debito = document.getElementById('valor_debito').value;
            idcartao = document.getElementById('tipo_cartaodebito').value;

           // if ( forma_pag['dinheiro'] ){
                 // dinheiro = parseFloat(dinheiro)-parseFloat(debito);
           // }
           //
      //} else {
      //      debito = 0;
      //}

      //if ( forma_pag['credito'] ){

            if ( document.getElementById('credito').checked ){
            	qtdcartoes = document.getElementById('credito_cartao_qtd').value;
            } else {
            	qtdcartoes = 0;
            }
            credito = '&credito='+qtdcartoes;
            var campo;
            var x = document.getElementById('exibe_quantidecreditos');
            var input = x.getElementsByTagName('input');
            var stvalor=0;
            for (i=0;i<input.length;i++){
                  campo = (input[i].id).split('_');
                  if ( campo[0] == 'creditovalor' ){
                        credito += '&creditovalor_'+stvalor+'='+document.getElementById(input[i].id).value;
                        stvalor++;
                  }
            }
            var select = x.getElementsByTagName('select');
            var st_parcela=0, st_cartao=0;
            for (i=0;i<select.length;i++){
                  campo = (select[i].id).split('_');
                  if ( campo[0] == 'creditoparcela' ){
                        credito += '&qtdparcela_'+st_parcela+'='+document.getElementById(select[i].id).value;
                        st_parcela++;
                  }
                  if ( campo[0] == 'cartaodecredito' ){
                        credito += '&cartao_'+st_cartao+'='+document.getElementById(select[i].id).value;
                        st_cartao++;
                  }
            }

      //} else {
      //      credito = '&credito=0';
      //}

      //alert(dinheiro);
      outro = 0;

      document.getElementById('titmain').innerHTML = 'Venda Fechada';

      params = 'cliente='+cliente+'&usuario='+usuario+'&totalvenda='+totalvenda+'&opcvenda='+opcvenda+'&opcvenda_final='+opcvenda_final+'&terminal='+terminal+'&dinheiro='+dinheiro+cheque+'&debito='+debito+credito+'&outro='+outro+'&idcartao='+idcartao+'&parcelas='+parcelas;
            
      if (tipo_venda == 'vip')
      {
		xmlhttp.open("POST", path+'modulos/venda/efetuar_pagamento_vip.php', true);
      }
      else
      {
      	xmlhttp.open("POST", path+'modulos/venda/efetuar_pagamento.php', true);
      }

      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttp.setRequestHeader("Content-length", params.length);
      xmlhttp.setRequestHeader("Connection", "close");
      xmlhttp.onreadystatechange = function() {
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            	//alert(xmlhttp.responseText);
                  //document.getElementById('pagamento_counteudo').innerHTML = xmlhttp.responseText;
                  var status_venda = xmlhttp.responseText;
                  //alert(status_venda);
                  if ( status_venda == '1' ){
                        vendapagamento_desabilita();
                        document.getElementById('btnfinalizarvenda').disabled = true;
                        document.getElementById('btnselecionarcliente').style.display = 'none';
                        document.getElementById('clientevendaselecionado').style.display = 'none';
                        document.getElementById('btnvoltarvenda').style.display = 'none';
                        document.getElementById('btnfinalizarvenda').style.display = 'none';
                        
                        kernel.dge('valordotroco').style.display = 'none';
                        kernel.dge('pagamentocomplemento').style.display = 'none';
                        
                        carrega_vendafinalizada();
                  }
            }
      }
      xmlhttp.send(params);

	/*


	var input_checkbox = new Array(4);

	var x = document.getElementById('formapagamento');
	var input = x.getElementsByTagName('input');
	for (i=0;i<input.length;i++){
		if ( document.getElementById(input[i].id).checked ){
			input_checkbox[input[i].id] = true;
		}else{
			input_checkbox[input[i].id] = false;
		}
	}

	if ( input_checkbox['dinheiro'] ){
		params += '&dinheiro='+document.getElementById('valor_dinheiro').value;
	}

	if ( input_checkbox['cheque'] ){
		//for (){

		//}
		params += '&cheque='+document.getElementById('valor_dinheiro').value;
	}

	if ( input_checkbox['debito'] ){

	}

	if ( input_checkbox['credito'] ){

	}

	alert(document.getElementById('tipo_cartaodebito').value);

	alert(document.getElementById('tipo_cartaocredito').value);



	params = 'dinheiro='+dinheiro;

	xmlhttp.open("POST", path+'modulos/venda/efetuar_pagamento.php', true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", params.length);
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.onreadystatechange = function() {
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			alert(xmlhttp.responseText);
		}
	}
	xmlhttp.send(params);
	*/
}

function carrega_vendafinalizada(){
      var element = document.getElementById('pagamento_counteudo');
      xmlhttp.open("GET", path+'modulos/venda/venda_finalizada.php');
      xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                  element.innerHTML = xmlhttp.responseText;

            }
      }
      xmlhttp.send(null);
}

function carrega_usuariosadm(url, element_id){

	var element = document.getElementById(element_id);
	var conteudo_esquerdo = document.getElementById('conteudo_esquerdo');
	conteudo_esquerdo.style.display = 'block';
	conteudo_esquerdo.innerHTML = '';
	var conteudo_direito = document.getElementById('conteudo_direito');
	conteudo_direito.style.display = 'block';
	conteudo_direito.innerHTML = '';
	var conteudo_total = document.getElementById('conteudo_total');
	conteudo_total.style.display = 'none';
	//element.innerHTML = loading_dados;
    xmlhttp.open("GET", url);
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
			carrega_usuariosadm_exibedados();
		}
    }
    xmlhttp.send(null);

}

function carregar_usuarioadm_adicionar_salvar(){

	var usu_nome = document.getElementById('add_usu_nome');
	var usu_login = document.getElementById('add_usu_login');
	var usu_senha = document.getElementById('add_usu_senha');
	var msgdadosusu = document.getElementById('msgdadosusu');

	usu_nome.style.border = '1px solid #6aa9e9';
	usu_login.style.border = '1px solid #6aa9e9';
	usu_senha.style.border = '1px solid #6aa9e9';
	msgdadosusu.innerHTML = '';

	if ( !usu_senha.value ){
		usu_senha.style.border = '1px solid red';
		msgdadosusu.innerHTML = '<b style="color:red;">Preencha a senha do usuário corretamente</b>';
	} else if ( (usu_senha.value).length <= 3 ) {
		usu_senha.style.border = '1px solid red';
		msgdadosusu.innerHTML = '<b style="color:red;">A senha do usuário deve ter no mínimo 4 caracteres</b>';
	}

	if ( !usu_login.value ){
		usu_login.style.border = '1px solid red';
		msgdadosusu.innerHTML = '<b style="color:red;">Preencha o login do usuário corretamente</b>';
	}

	if ( !usu_nome.value ){
		usu_nome.style.border = '1px solid red';
		msgdadosusu.innerHTML = '<b style="color:red;">Preencha o nome do usuário corretamente</b>';
	}

	var x=document.getElementById("seleciona_permissoes");
	var input = x.getElementsByTagName("input");
	var vetor = new Array();
	var permissao = false;
	for (loop = 0; loop < input.length; loop++) {
		if ( document.getElementById(input[loop].id).checked ){
			vetor[input[loop].id] = 1;
			permissao = true;
		} else {
			vetor[input[loop].id] = 0;
		}
	}

	var label = x.getElementsByTagName("label");
	if ( permissao && msgdadosusu.innerHTML == '' ){
		for (loop = 0; loop < label.length; loop++) {
			if ( document.getElementById(label[loop].id) ){
				document.getElementById(label[loop].id).style.border = '1px solid #FFFFFF';
			}
		}
		var permissao_user = '';
		for ( i=0;i<loop;i++ ){
			permissao_user += vetor['per_'+i]
		}

		params = 'nome='+usu_nome.value+'&login='+usu_login.value+'&senha='+usu_senha.value+'&permissao='+permissao_user;

		xmlhttp.open("POST", path+'modulos/administracao/admdados_adicionar_salvar.php', true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.setRequestHeader("Content-length", params.length);
		xmlhttp.setRequestHeader("Connection", "close");
		xmlhttp.onreadystatechange = function() {
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				var resultado = xmlhttp.responseText;
				if ( resultado > 0 ){
					carregar_usuarioadm_atualizalista(resultado);
				} else if ( resultado == '-' ){
					usu_login.style.border = '1px solid red';
					msgdadosusu.innerHTML = '<b style="color:red;">Escolha outro o login para o usuário, este login já existe</b>';
				}
			}
		}
		xmlhttp.send(params);
	} else if ( !permissao && msgdadosusu.innerHTML == '' ) {
		msgdadosusu.innerHTML = '<b style="color:red;">Marque ao menos uma permissão para o usuário</b>';
		for (loop = 0; loop < label.length; loop++) {
			if ( document.getElementById(label[loop].id) ){
				document.getElementById(label[loop].id).style.border = '1px solid red';
			}
		}
	}
}

function carregar_usuarioadm_atualizalista(value){
	var element = document.getElementById('listausers');
    xmlhttp.open("GET", path+'modulos/administracao/admdados_atualiza_lista.php');
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
			carrega_usuariosadm_dados(value);
		}
    }
    xmlhttp.send(null);
}

function carregar_usuarioadm_adicionar(){

	document.getElementById('titusuadmdados').innerHTML = 'Adicionar usuário administrador';
	document.getElementById('msgdadosuser').innerHTML = '<b style="color:blue;">Preencha os campos abaixo para adicionar um usuário</b>';
	document.getElementById('btnadicionaradm').style.display = 'none';

	var element = document.getElementById('dadosuser');
	//element.innerHTML = loading_dados;
    xmlhttp.open("GET", path+'modulos/administracao/admdados_adicionar.php');
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
			carrega_usuariosadm_adicionar_permissoesacesso();
		}
    }
    xmlhttp.send(null);

}

function carrega_usuariosadm_adicionar_permissoesacesso(){

	var element = document.getElementById('exibir_dadosusersel');
	//element.innerHTML = loading_dados;
    xmlhttp.open("GET", path+'modulos/administracao/admdados_adicionar_usuario_permissoes.php');
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
		}
    }
    xmlhttp.send(null);

}


function carrega_usuariosadm_exibedados(){

	var conteudo_direito = document.getElementById('conteudo_direito');
	var element = conteudo_direito;
	//element.innerHTML = loading_dados;
    xmlhttp.open("GET", path+'modulos/administracao/exibe_admdados.php');
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
		}
    }
    xmlhttp.send(null);

}

var usuariosadm_dados_status = true;
function carrega_usuariosadm_dados(idusuario){

	if (usuariosadm_dados_status){
		document.getElementById('titusuadmdados').innerHTML = 'Dados do usuário administrador';
		document.getElementById('msgdadosuser').innerHTML = '<b style="color:blue;">Selecione um usuário administrador na listagem ao lado</b>';
		usuariosadm_dados_status = false;
		var element = document.getElementById('dadosuser');
		//element.innerHTML = loading_dados;
	    xmlhttp.open("GET", path+'modulos/administracao/exibe_admdados_usuario.php?i='+idusuario);
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				element.innerHTML = xmlhttp.responseText;
				document.getElementById('btnadicionaradm').style.display = 'block';
				carrega_usuariosadm_logacesso(idusuario)
				usuariosadm_dados_status = true;
			}
	    }
	    xmlhttp.send(null);
	}
}

function carrega_usuariosadm_logacesso(idusuario){

	var element = document.getElementById('exibir_dadosusersel');
	//element.innerHTML = loading_dados;
    xmlhttp.open("GET", path+'modulos/administracao/exibe_admdados_usuario_log.php?i='+idusuario);
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
		}
    }
    xmlhttp.send(null);

}

function carrega_usuariosadm_permissoesacesso(idusuario){

	var element = document.getElementById('exibir_dadosusersel');
	//element.innerHTML = loading_dados;
    xmlhttp.open("GET", path+'modulos/administracao/exibe_admdados_usuario_permissoes.php?i='+idusuario);
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
		}
    }
    xmlhttp.send(null);

}

function carrega_usuariosadm_editar(value){

	var usu_nome = document.getElementById('usu_nome');
	var usu_login = document.getElementById('usu_login');
	var usu_senha = document.getElementById('usu_senha');
	var msgdadosusu = document.getElementById('msgdadosusu');

	msgdadosusu.innerHTML = '';

	usu_nome.innerHTML = '<input type="text" id="edit_usu_nome" value="'+usu_nome.innerHTML+'" style="width:200px;" maxlength="20">';
	usu_login.innerHTML = '<input type="text" id="edit_usu_login" value="'+usu_login.innerHTML+'" maxlength="15">';
	usu_senha.innerHTML = '<input type="password" id="edit_usu_senha" value="" onfocus="javascript:document.getElementById(\'msgdadosusu\').innerHTML=\'<b style=color:red>Preencha a senha somente se desejar alterar</b>\';" onblur="javascript:document.getElementById(\'msgdadosusu\').innerHTML=\'\';" maxlength="20">';

	document.getElementById('btneditar').style.display = 'none';
	document.getElementById('btnsalvar').style.display = 'block';

}

function carrega_usuariosadm_salvar(value){

	var usu_lista = document.getElementById('usunome_'+value);

	var usu_nome = document.getElementById('usu_nome');
	var usu_login = document.getElementById('usu_login');
	var usu_senha = document.getElementById('usu_senha');

	var edit_usu_nome = document.getElementById('edit_usu_nome');
	var edit_usu_login = document.getElementById('edit_usu_login');
	var edit_usu_senha = document.getElementById('edit_usu_senha');
	var msgdadosusu = document.getElementById('msgdadosusu');

	edit_usu_login.style.border = '1px solid #6aa9e9';
	edit_usu_senha.style.border = '1px solid #6aa9e9';
	msgdadosusu.innerHTML = '';

	if ( !edit_usu_senha.value || ((edit_usu_senha.value).length > 3)  ){

		params = 'i='+value+'&nome='+edit_usu_nome.value+'&login='+edit_usu_login.value+'&senha='+edit_usu_senha.value;

		xmlhttp.open("POST", path+'modulos/administracao/admdados_editar_usuario.php', true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.setRequestHeader("Content-length", params.length);
		xmlhttp.setRequestHeader("Connection", "close");
		xmlhttp.onreadystatechange = function() {
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				var resultado = xmlhttp.responseText;
				if ( resultado == 1 ){
					usu_lista.innerHTML = edit_usu_nome.value;
					usu_nome.innerHTML = edit_usu_nome.value;
					usu_login.innerHTML = edit_usu_login.value;
					usu_senha.innerHTML = '**********';
					document.getElementById('btneditar').style.display = 'block';
					document.getElementById('btnsalvar').style.display = 'none';
					msgdadosusu.innerHTML = '<b style="color:green">Os dados foram salvos com sucesso</b>';
				} else if ( resultado == 2 ) {
					msgdadosusu.innerHTML = '<b style="color:red">Este "login" já existe, escolha outro "login" e clique em "salvar dados"</b>';
					edit_usu_login.style.border = '1px solid red';
				} else {
					msgdadosusu.innerHTML = '<b style="color:red">Ocorreu um erro, clique em "salvar dados" novamente</b>';
				}
			}
		}
		xmlhttp.send(params);

	} else {
		msgdadosusu.innerHTML = '<b style="color:red">A nova senha deve ter no mínimo 4 caracteres</b>';
		edit_usu_senha.style.border = '1px solid red';
	}
}

function visualiza_usuariosadm_permissoes(value){

	var divs = new Array('permisao_cadastro', 'permisao_venda', 'permisao_financeiro', 'permisao_relatorio', 'permisao_utilitario', 'permisao_configuracao');
	var tits = new Array('Cadastro', 'Venda', 'Financeiro', 'Relatório', 'Utilitário', 'Configuração');
	var btns = new Array('btncadastro', 'btnvenda', 'btnfinanceiro', 'btnrelatorio', 'btnutilitario', 'btnconfiguracao');

	for(i=0;i<divs.length;i++ ){
		if ( value == i ){
			document.getElementById(divs[i]).style.display = 'block';
			document.getElementById('titpermissao').innerHTML = '<b>'+tits[i]+'</b>';
			document.getElementById(btns[i]).style.backgroundColor = bg_btn_clicado;
		} else {
			document.getElementById(divs[i]).style.display = 'none';
			document.getElementById(btns[i]).style.backgroundColor = bg_btn_normal;
		}
	}

}

function carrega_usuariosadm_desativa(value){

	document.getElementById('usunome_'+value).style.color = 'red';
	document.getElementById('btndesativado_'+value).style.display = 'block';
	document.getElementById('btnativado_'+value).style.display = 'none';
	if ( document.getElementById('btndesativado_dados_'+value ) ){
		document.getElementById('btndesativado_dados_'+value).style.display = 'block';
		document.getElementById('btnativado_dados_'+value).style.display = 'none';
	}
	xmlhttp.open("GET", path+'modulos/administracao/admdados_editar_status.php?s=desativo&i='+value);
    xmlhttp.send(null);

}

function carrega_usuariosadm_ativa(value){

	document.getElementById('usunome_'+value).style.color = 'black';
	document.getElementById('btndesativado_'+value).style.display = 'none';
	document.getElementById('btnativado_'+value).style.display = 'block';
	if ( document.getElementById('btndesativado_dados_'+value ) ){
		document.getElementById('btndesativado_dados_'+value).style.display = 'none';
		document.getElementById('btnativado_dados_'+value).style.display = 'block';
	}
	xmlhttp.open("GET", path+'modulos/administracao/admdados_editar_status.php?s=ativo&i='+value);
    xmlhttp.send(null);

}

function carregar_permissoessalvar(value){

	var msg = document.getElementById('msgpermissoes');
	msg.innerHTML = '...';
	var param = '';
	var x=document.getElementById("seleciona_permissoes");
	var input = x.getElementsByTagName("input");
	var vetor = new Array();
	for (loop = 0; loop < input.length; loop++) {
		if ( document.getElementById(input[loop].id).checked ){
			vetor[input[loop].id] = 1;
		} else {
			vetor[input[loop].id] = 0;
		}
	}
	for ( i=0;i<loop;i++ ){
		param += vetor['per_'+i]
	}
	xmlhttp.open("GET", path+'modulos/administracao/admdados_editar_permisoes.php?p='+param+'&i='+value);
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			msg.innerHTML= '<b style="color:green">Permissões modificadas com sucesso</b>';
		}
	}
    xmlhttp.send(null);

}

var carrega_cliente_mostradados_status = false;
function carrega_cliente_mostradados(idcliente){
	var element = document.getElementById('conteudo_direito');
	//element.innerHTML = loading_dados;
    if ( !carrega_cliente_mostradados_status ){
    	carrega_cliente_mostradados_status = true;
		xmlhttp.open("GET", path+'modulos/cliente/cliente_mostradados.php?id='+idcliente);
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				carrega_cliente_mostradados_status = false;
	    		element.innerHTML = xmlhttp.responseText;
				if (document.getElementById('lista_todos_clientes')){
					marca_clienteescolhido(idcliente, 'clienteescolhido_');
				} else {
					listasimples_cliente('relatorio');
				}
			}
	    }
	    xmlhttp.send(null);
    }
}

var carrega_cliente_mostradadoshistorico_status = false;
function carrega_cliente_mostradadoshistorico(idcliente){
	var conteudo_total = document.getElementById('conteudo_total');
	conteudo_total.style.display = 'none';
	var element = document.getElementById('conteudo_direito');
	element.style.display = 'block';
	//element.innerHTML = loading_dados;
    	if ( !carrega_cliente_mostradados_status ){
    	carrega_cliente_mostradados_status = true;
		xmlhttp.open("GET", path+'modulos/cliente/cliente_mostradados.php?id='+idcliente);
	    	xmlhttp.onreadystatechange = function() {
	    		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				carrega_cliente_mostradados_status = false;
	    			element.innerHTML = xmlhttp.responseText;
				listasimples_cliente('relatorio', idcliente);
			}
	    }
	    xmlhttp.send(null);
    }
}

function carrega(url,id){

}


// Configurações gerais

function configuracao_paginainicial(){

	var element = document.getElementById('conteudo_direito');
	//element.innerHTML = loading_dados;
    xmlhttp.open("GET", path+'modulos/configuracao/paginainicial.php');
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
		}
    }
    xmlhttp.send(null);

}

function configuracao_autenticacoes(){

	var element = document.getElementById('conteudo_direito');
	//element.innerHTML = loading_dados;
    xmlhttp.open("GET", path+'modulos/configuracao/autenticacoes.php');
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
		}
    }
    xmlhttp.send(null);

}

function configuracao_cadastrodecontas(){

	var element = document.getElementById('conteudo_direito');
	//element.innerHTML = loading_dados;
    xmlhttp.open("GET", path+'modulos/configuracao/cadastro_contas.php');
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
		}
    }
    xmlhttp.send(null);

}

function configuracao_cadastrodegrupos(){

	var element = document.getElementById('conteudo_direito');
	//element.innerHTML = loading_dados;
    xmlhttp.open("GET", path+'modulos/configuracao/cadastro_grupos.php');
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
		}
    }
    xmlhttp.send(null);

}

function configuracao_centrodecustos(){

	var element = document.getElementById('conteudo_direito');
	//element.innerHTML = loading_dados;
    xmlhttp.open("GET", path+'modulos/configuracao/centro_custos.php');
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
		}
    }
    xmlhttp.send(null);

}








var status_fade = 'false';

function btnfadeover(){
	//document.getElementById('pathsistema').innerHTML = 'over';
	//if ( fade_status == 'on' ){
	//	fade(0, 100, "conteudo_total", "conteudo_esquerdo", "conteudo_direito");
	//	document.getElementById('pathsistema').innerHTML = fade_status;
	//}
}

function btnfadeout(){
	//document.getElementById('pathsistema').innerHTML = 'out';

	//if ( fade_status == 'on' ){
	//	fade(1, 20, "conteudo_total", "conteudo_esquerdo", "conteudo_direito");
	//	document.getElementById('pathsistema').innerHTML = fade_status;
	//}
}

function btnfadeoveropen(){
	btnfadeover()
}

function btnfadeoutclose(){
	btnfadeout()
}


//if ( fade_status == 'off' && opacity > 70 ){
	//fade(0, 100, "conteudo_total", "conteudo_esquerdo", "conteudo_direito");
//	fade_status = 'on';
//	document.getElementById('pathsistema').innerHTML = fade_status;
//}






function troca_textpwd(campo){

	document.getElementById(campo).value = '';
	document.getElementById(campo).type = 'password';

}

function disablecampo(campo){
	if (document.getElementById(campo).disabled){
		document.getElementById(campo).disabled = false;
	} else {
		document.getElementById(campo).disabled = true;
		document.getElementById(campo).selectedIndex = 0;
	}
}


function formatadinheiro(mnt) {
    mnt -= 0;
    mnt = (Math.round(mnt*100))/100;
    return (mnt == Math.floor(mnt))? mnt+'.00':((mnt*10==Math.floor(mnt*10))?mnt+'0':mnt);
}


function checanumero(numero, qtd)
{
	var anum=/(^\d+$)|(^\d+\.\d+$)/
	if (anum.test(numero)){
		if ( numero.length < qtd ){
			return false;
		} else {
			return true;
		}
	}else{
		return false;
	}
}

function checaemail(value_email){
	if (value_email){
		var emailfmt= /^\w+([.-_]\w+)*@\w+([.-]\w+)*\.\w{2,8}$/;
		if(!emailfmt.test(value_email)){
			return false;
		} else {
			return true;
		}
	}
}


function formata_valor(campo,tammax,teclapres) {
	var tecla = teclapres.keyCode ? teclapres.keyCode : teclapres.which ? teclapres.which : teclapres.charCode;
	vr = document.getElementById(campo).value;
	vr = vr.replace( "/", "" );
	vr = vr.replace( "/", "" );
	vr = vr.replace( ".", "" );
	vr = vr.replace( ".", "" );
	vr = vr.replace( ".", "" );
	vr = vr.replace( ".", "" );
	vr = vr.replace( ".", "" );
	tam = vr.length;
	if (tam < tammax && tecla != 8){ tam = vr.length + 1; }
	if (tecla == 8 ){ tam = tam - 1; }
	if ( tecla == 8 || tecla >= 48 && tecla <= 57 || tecla >= 96 && tecla <= 105 ){
	if ( tam <= 2 ){
		document.getElementById(campo).value = vr; }
	if ( (tam > 2) && (tam <= 5) ){
		document.getElementById(campo).value = vr.substr( 0, tam - 2 ) + '.' + vr.substr( tam - 2, tam ); }
	if ( (tam >= 6) && (tam <= 8) ){
		document.getElementById(campo).value = vr.substr( 0, tam - 5 ) + '' + vr.substr( tam - 5, 3 ) + '.' + vr.substr( tam - 2, tam ); }
	if ( (tam >= 9) && (tam <= 11) ){
		document.getElementById(campo).value = vr.substr( 0, tam - 8 ) + '' + vr.substr( tam - 8, 3 ) + '' + vr.substr( tam - 5, 3 ) + '.' + vr.substr( tam - 2, tam ); }
	if ( (tam >= 12) && (tam <= 14) ){
		document.getElementById(campo).value = vr.substr( 0, tam - 11 ) + '' + vr.substr( tam - 11, 3 ) + '' + vr.substr( tam - 8, 3 ) + '' + vr.substr( tam - 5, 3 ) + '.' + vr.substr( tam - 2, tam ); }
	if ( (tam >= 15) && (tam <= 17) ){
		document.getElementById(campo).value = vr.substr( 0, tam - 14 ) + '' + vr.substr( tam - 14, 3 ) + '' + vr.substr( tam - 11, 3 ) + '' + vr.substr( tam - 8, 3 ) + '' + vr.substr( tam - 5, 3 ) + '.' + vr.substr( tam - 2, tam );}
	}
}


function checaCPF(st) {
if (st == "")
return (false);
l = st.length;

if ((l == 9) || (l == 8))
{
for (i = l ; i < 10; i++)
{
st = '0' + st
}
}
l = st.length;
st2 = "";
for (i = 0; i < l; i++) {
caracter = st.substring(i,i+1);
if ((caracter >= '0') && (caracter <= '9'));
st2 = st2 + caracter;
}
if ((st2.length > 11) || (st2.length < 10))
return (false);
if (st2.length==10)
st2 = '0' + st2;
digito1 = st2.substring(9,10);
digito2 = st2.substring(10,11);
digito1 = parseInt(digito1,10);
digito2 = parseInt(digito2,10);
sum = 0; mul = 10;
for (i = 0; i < 9 ; i++) {
digit = st2.substring(i,i+1);
tproduct = parseInt(digit ,10) * mul;
sum += tproduct;
mul--;
}
dig1 = ( sum % 11 );
if ( dig1==0 || dig1==1 )
dig1=0;
else
dig1 = 11 - dig1;
if (dig1!=digito1)
return (false);
sum = 0;
mul = 11;
for (i = 0; i < 10 ; i++) {
digit = st2.substring(i,i+1);
tproduct = parseInt(digit ,10)*mul;
sum += tproduct;
mul--;
}
dig2 = (sum % 11);
if ( dig2==0 || dig2==1 )
dig2=0;
else
dig2 = 11 - dig2;
if (dig2 != digito2)
return (false);
return (true);
}


function localizacao_sistema(value){

	//document.getElementById('pathsistema').innerHTML = 'Real Virtual Store : ' + value;

}

var menuwidth='200px';
var menubgcolor='';
var disappeardelay=50;
var hidemenu_onclick="yes";
var idmenu_atual;
/////No further editting needed

var ie4=document.all
var ns6=document.getElementById&&!document.all

if (ie4||ns6)
document.write('<div id="dropmenudiv" style="visibility:hidden;display:none;width:'+menuwidth+';background-color:'+menubgcolor+'" onMouseover="clearhidemenu()" onMouseout="dynamichide(event)"></div>')

function getposOffset(what, offsettype){
var totaloffset=(offsettype=="left")? what.offsetLeft : what.offsetTop;
var parentEl=what.offsetParent;
while (parentEl!=null){
totaloffset=(offsettype=="left")? totaloffset+parentEl.offsetLeft : totaloffset+parentEl.offsetTop;
parentEl=parentEl.offsetParent;
}
return totaloffset;
}


function showhide(obj, e, visible, hidden, menuwidth)
{
	if (ie4||ns6) dropmenuobj.style.left=dropmenuobj.style.top="-500px";

	if (menuwidth!="")
	{
		dropmenuobj.widthobj=dropmenuobj.style
		dropmenuobj.widthobj.width=menuwidth
	}

	if ( e.type=="click" && obj.visibility==hidden || e.type=="mouseover" ||  e.type=="keydown") obj.visibility=visible
	else if (e.type=="click") obj.visibility=hidden
}

function iecompattest(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body;
}

function clearbrowseredge(obj, whichedge){
var edgeoffset=0;
if (whichedge=="rightedge"){
var windowedge=ie4 && !window.opera? iecompattest().scrollLeft+iecompattest().clientWidth-15 : window.pageXOffset+window.innerWidth-15;
	dropmenuobj.contentmeasure=dropmenuobj.offsetWidth;
if (windowedge-dropmenuobj.x < dropmenuobj.contentmeasure)
	edgeoffset=dropmenuobj.contentmeasure-obj.offsetWidth;
} else {
var topedge=ie4 && !window.opera? iecompattest().scrollTop : window.pageYOffset;
var windowedge=ie4 && !window.opera? iecompattest().scrollTop+iecompattest().clientHeight-15 : window.pageYOffset+window.innerHeight-18;
dropmenuobj.contentmeasure=dropmenuobj.offsetHeight;
if (windowedge-dropmenuobj.y < dropmenuobj.contentmeasure){
edgeoffset=dropmenuobj.contentmeasure+obj.offsetHeight;
if ((dropmenuobj.y-topedge)<dropmenuobj.contentmeasure)
edgeoffset=dropmenuobj.y+obj.offsetHeight-topedge;
}
}

return edgeoffset
}

function populatemenu(what)
{
	if (ie4||ns6) dropmenuobj.innerHTML=what.join("");
}


function dropdownmenu(obj, e, menucontents, menuwidth, idmenu)
{
	if (window.event)
	{
		event.cancelBubble=true;
	}
	else if (e.stopPropagation)
	{
		e.stopPropagation();
	}

	clearhidemenu();

	dropmenuobj=document.getElementById ? document.getElementById("dropmenudiv") : dropmenudiv;

	populatemenu(menucontents);

	if (ie4||ns6)
	{
		showhide(dropmenuobj.style, e, "visible", "hidden", menuwidth);
		dropmenuobj.x=getposOffset(obj, "left");
		dropmenuobj.y=getposOffset(obj, "top");
		dropmenuobj.style.left=dropmenuobj.x-clearbrowseredge(obj, "rightedge")+"px";
		dropmenuobj.style.top=dropmenuobj.y-clearbrowseredge(obj, "bottomedge")+obj.offsetHeight+"px";
		dropmenuobj.style.display = 'block';
		dropmenuobj.style.width = '150px';

		btnfadeoveropen();

	}

	idmenu_atual = idmenu;

	document.getElementById(idmenu).style.backgroundColor = '#FFFFFF';
	document.getElementById(idmenu).style.color = '#6aa9e9';

	return clickreturnvalue();

}



function clickreturnvalue(){
if (ie4||ns6) return false
else return true
}

function contains_ns6(a, b) {
while (b.parentNode)
if ((b = b.parentNode) == a)
return true;
return false;
}

function dynamichide(e)
{
	if (ie4&&!dropmenuobj.contains(e.toElement))
	{
		delayhidemenu()
	}
	else if (ns6&&e.currentTarget!= e.relatedTarget&& !contains_ns6(e.currentTarget, e.relatedTarget))
	{
		delayhidemenu()
	}
}

function hidemenu(e)
{
	if (typeof dropmenuobj!="undefined")
	{
		if (ie4||ns6) dropmenuobj.style.visibility="hidden";

		dropmenuobj.style.display = "none";
		document.getElementById(idmenu_atual).style.backgroundColor = '#8ebcea';
		document.getElementById(idmenu_atual).style.color = '#FFFFFF';
		btnfadeoutclose();
	}
}



function delayhidemenu()
{
	//document.getElementById(idmenu_atual).style.backgroundColor = '#8ebcea';
	//document.getElementById(idmenu_atual).style.color = '#FFFFFF';
	if (ie4||ns6)
		delayhide=setTimeout("hidemenu()",disappeardelay);
}

function clearhidemenu(){
	if (typeof delayhide!="undefined")
		clearTimeout(delayhide)
}

if (hidemenu_onclick=="yes")
	document.onclick=hidemenu




var timefade = 50;
var opacity = 100;
var idfade1, idfade2, idfade3;

function fade(value, defopacity, divfade1, divfade2, divfade3){

	opacity = defopacity;
	idfade1 = divfade1;
	idfade2 = divfade2;
	idfade3 = divfade3;

	opacidadediv(opacity);

	if ( value == 0 )
		opacidade_setinterval=self.setInterval("opacidademenos()",timefade);
	else
		opacidade_setinterval=self.setInterval("opacidademais()",timefade);

}

function opacidademais(){
	if ( opacity <= 160 && opacity > 0 ){
		opacidadediv(opacity);
		opacity = opacity + 5;
	} else {
		window.clearInterval(opacidade_setinterval);
		//opacity = 100;
		opacidadediv(opacity);
		//fade(opacity, idfade1, idfade2, idfade3)
	}
}

function opacidademenos(){
	if ( opacity <= 160 && opacity > 20 ){
		opacidadediv(opacity);
		opacity = opacity - 5;
	} else {
		window.clearInterval(opacidade_setinterval);
		//opacity = 20;
		opacidadediv(opacity);
	}
}

function opacidadediv(value){
	document.getElementById(idfade1).style.MozOpacity = value/100;
	document.getElementById(idfade1).style.opacity = value/100;
	document.getElementById(idfade1).style.filter = "alpha(opacity="+value+")";
	document.getElementById(idfade2).style.MozOpacity = value/100;
	document.getElementById(idfade2).style.opacity = value/100;
	document.getElementById(idfade2).style.filter = "alpha(opacity="+value+")";
	document.getElementById(idfade3).style.MozOpacity = value/100;
	document.getElementById(idfade3).style.opacity = value/100;
	document.getElementById(idfade3).style.filter = "alpha(opacity="+value+")";
}

function rowOver(row){
	row.style.backgroundColor = row_over;
//	row.style.color="#000000";
//	row.style.cursor = "hand";
}

function rowOut(row){
	row.style.backgroundColor = row_out;
//	row.style.color="#000000";
}

function gera_excel(){

      window.open(path+'modulos/relatorios/excel/'+pagina);

}


/************************
* Functions PHP
************************/
function mktime() {
    // http://kevin.vanzonneveld.net
    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: baris ozdil
    // +      input by: gabriel paderni
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // *     example 1: mktime( 14, 10, 2, 2, 1, 2008 );
    // *     returns 1: 1201871402

    var no, i = 0, d = new Date(), argv = arguments, argc = argv.length;

    var dateManip = {
        0: function(tt){ return d.setHours(tt); },
        1: function(tt){ return d.setMinutes(tt); },
        2: function(tt){ return d.setSeconds(tt); },
        3: function(tt){ return d.setMonth(parseInt(tt)-1); },
        4: function(tt){ return d.setDate(tt); },
        5: function(tt){ return d.setYear(tt); }
    };

    for( i = 0; i < argc; i++ ){
        no = parseInt(argv[i]);
        if(no && isNaN(no)){
            return false;
        } else if(no){
            // arg is number, let's manipulate date object
            if(!dateManip[i](no)){
                // failed
                return false;
            }
        }
    }

    return Math.floor(d.getTime()/1000);
}

function date(format,timestamp) {
    // http://kevin.vanzonneveld.net
    // +   original by: Carlos R. L. Rodrigues
    // +      parts by: Peter-Paul Koch (http://www.quirksmode.org/js/beat.html)
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: MeEtc (http://yass.meetcweb.com)
    // +   improved by: Brad Touesnard
    // *     example 1: date('H:m:s \\m \\i\\s \\m\\o\\n\\t\\h', 1062402400);
    // *     returns 1: '09:09:40 m is month'
    // *     example 2: date('F j, Y, g:i a', 1062462400);
    // *     returns 2: 'September 2, 2003, 2:26 am'

    var a, jsdate = new Date(timestamp ? timestamp * 1000 : null);
    var pad = function(n, c){
        if( (n = n + "").length < c ) {
            return new Array(++c - n.length).join("0") + n;
        } else {
            return n;
        }
    };
    var txt_weekdays = ["Sunday","Monday","Tuesday","Wednesday",
        "Thursday","Friday","Saturday"];
    var txt_ordin = {1:"st",2:"nd",3:"rd",21:"st",22:"nd",23:"rd",31:"st"};
    var txt_months =  ["", "January", "February", "March", "April",
        "May", "June", "July", "August", "September", "October", "November",
        "December"];

    var f = {
        // Day
            d: function(){
                return pad(f.j(), 2);
            },
            D: function(){
                t = f.l(); return t.substr(0,3);
            },
            j: function(){
                return jsdate.getDate();
            },
            l: function(){
                return txt_weekdays[f.w()];
            },
            N: function(){
                return f.w() + 1;
            },
            S: function(){
                return txt_ordin[f.j()] ? txt_ordin[f.j()] : 'th';
            },
            w: function(){
                return jsdate.getDay();
            },
            z: function(){
                return (jsdate - new Date(jsdate.getFullYear() + "/1/1")) / 864e5 >> 0;
            },

        // Week
            W: function(){
                var a = f.z(), b = 364 + f.L() - a;
                var nd2, nd = (new Date(jsdate.getFullYear() + "/1/1").getDay() || 7) - 1;

                if(b <= 2 && ((jsdate.getDay() || 7) - 1) <= 2 - b){
                    return 1;
                } else{

                    if(a <= 2 && nd >= 4 && a >= (6 - nd)){
                        nd2 = new Date(jsdate.getFullYear() - 1 + "/12/31");
                        return date("W", Math.round(nd2.getTime()/1000));
                    } else{
                        return (1 + (nd <= 3 ? ((a + nd) / 7) : (a - (7 - nd)) / 7) >> 0);
                    }
                }
            },

        // Month
            F: function(){
                return txt_months[f.n()];
            },
            m: function(){
                return pad(f.n(), 2);
            },
            M: function(){
                t = f.F(); return t.substr(0,3);
            },
            n: function(){
                return jsdate.getMonth() + 1;
            },
            t: function(){
                var n;
                if( (n = jsdate.getMonth() + 1) == 2 ){
                    return 28 + f.L();
                } else{
                    if( n & 1 && n < 8 || !(n & 1) && n > 7 ){
                        return 31;
                    } else{
                        return 30;
                    }
                }
            },

        // Year
            L: function(){
                var y = f.Y();
                return (!(y & 3) && (y % 1e2 || !(y % 4e2))) ? 1 : 0;
            },
            //o not supported yet
            Y: function(){
                return jsdate.getFullYear();
            },
            y: function(){
                return (jsdate.getFullYear() + "").slice(2);
            },

        // Time
            a: function(){
                return jsdate.getHours() > 11 ? "pm" : "am";
            },
            A: function(){
                return f.a().toUpperCase();
            },
            B: function(){
                // peter paul koch:
                var off = (jsdate.getTimezoneOffset() + 60)*60;
                var theSeconds = (jsdate.getHours() * 3600) +
                                 (jsdate.getMinutes() * 60) +
                                  jsdate.getSeconds() + off;
                var beat = Math.floor(theSeconds/86.4);
                if (beat > 1000) beat -= 1000;
                if (beat < 0) beat += 1000;
                if ((String(beat)).length == 1) beat = "00"+beat;
                if ((String(beat)).length == 2) beat = "0"+beat;
                return beat;
            },
            g: function(){
                return jsdate.getHours() % 12 || 12;
            },
            G: function(){
                return jsdate.getHours();
            },
            h: function(){
                return pad(f.g(), 2);
            },
            H: function(){
                return pad(jsdate.getHours(), 2);
            },
            i: function(){
                return pad(jsdate.getMinutes(), 2);
            },
            s: function(){
                return pad(jsdate.getSeconds(), 2);
            },
            //u not supported yet

        // Timezone
            //e not supported yet
            //I not supported yet
            O: function(){
               var t = pad(Math.abs(jsdate.getTimezoneOffset()/60*100), 4);
               if (jsdate.getTimezoneOffset() > 0) t = "-" + t; else t = "+" + t;
               return t;
            },
            P: function(){
                var O = f.O();
                return (O.substr(0, 3) + ":" + O.substr(3, 2));
            },
            //T not supported yet
            //Z not supported yet

        // Full Date/Time
            c: function(){
                return f.Y() + "-" + f.m() + "-" + f.d() + "T" + f.h() + ":" + f.i() + ":" + f.s() + f.P();
            },
            //r not supported yet
            U: function(){
                return Math.round(jsdate.getTime()/1000);
            }
    };

    return format.replace(/[\\]?([a-zA-Z])/g, function(t, s){
        if( t!=s ){
            // escaped
            ret = s;
        } else if( f[s] ){
            // a date function exists
            ret = f[s]();
        } else{
            // nothing special
            ret = s;
        }

        return ret;
    });
}

function strip_tags(str) {
   return str.replace(/<\/?[^>]+>/gi, "");
}

function nl2br( str ) {
    return str.replace(/([^>])\n/g, '$1<br/>');
}

function array_reverse( array, preserve_keys ) {
	var arr_len=array.length, newkey=0, tmp_ar = {}
    for(var key in array){
        newkey=arr_len-key-1;
        tmp_ar[(!!preserve_keys)?newkey:key]=array[newkey];
    }
    return tmp_ar;
}

/**
 * Setando um possivel estilo que esteja destivado
 *
 * Essa função é usada basicamente em midias (impressão)
 */
function setEtiquetaStyleSheet(title_name, desable_other)
{
	var i, a;
	for(i=0; (a = document.getElementsByTagName("link")[i]); i++)
	{
		if(a.getAttribute("rel").indexOf("style") != -1 && a.getAttribute("title"))
		{
			arr_title = a.getAttribute("title").split("_");

			if (arr_title[0] == "etiqueta")
			{
				if (desable_other)
				{
					a.disabled = true;
				}

				if(a.getAttribute("title") == title_name && desable_other)
				{
					a.disabled = false;
				}
			}
		}
	}
}

function pause(numberMillis)
{
	var now = new Date();
	var exitTime = now.getTime() + numberMillis;
	while (true)
	{
		now = new Date();
		if (now.getTime() > exitTime)
		return;
	}
}

function enablePrintBnt(disabled)
{
	bnt = document.getElementById("bntImprimirEtiquetas");

	bnt.className = "botao";
	bnt.disabled = false;

	if (disabled === false)
	{
		bnt.className = "botao_inativo";
		bnt.disabled = true;
	}
}


/**
 * gera a saida no FLASH
 */
var _elm = new Array;
function flash(msg, type, elm)
{
	switch(type)
	{
	case 'erro':
		msg  = '<b style="color:red">' + msg + '</b>';
	break;
	case 'validator':
		msg  = '<b style="color:red">' + msg + '</b>';

		for(var i=0; i<_elm.length; i++)
		{
			_elm[i].style.border = '1px solid #6aa9e9';
		}

		if (elm)
		{
			_elm.push(elm);
			elm.style.border = '1px solid red';
		}
		else
		{
			_elm = new Array;
		}
	break;
	case 'noticia':
		  msg = "<i>" + msg +"</i>";
	break;
	default:
	  	msg = msg;
	}

	flash_div = document.getElementById('flash');
	flash_div.innerHTML = '<table><tr><td align="center">' + msg + '</td></tr></table>';

	return false;
}

/**
 * Verifica se etiquetas foram geradas entes da impressão
 */
function checkGerarEtiqueta()
{
	div_etiqueta = document.getElementById("versaoimpressao");

	if (div_etiqueta.innerHTML == "")
	{
		flash('Nenhuma etiqueta gerada!<br />Clique em \'Gerar Eqtiqueta\'.', 'erro');
	}
	else
	{
		javascript:window.print();
	}
}


function comfirmaClienteSelecionado(msg)
{
	cliente_id = document.getElementById("inputclientevendaselecionado").value;
	if (cliente_id == '' || cliente_id <= 0 )
	{
		//alert(msg);
		//document.getElementById('pagamentocomplemento').innerHTML = '<b style="color:red;">'+msg+'</b>';
		return false;
	}
	return true;
}

function returnCallBack(e, result)
{
	if (e.keyCode == 13)
		result();
}


function isOpenMenu(menu)
{
	if ( document.getElementById("dropmenudiv").style.display == 'block' && idmenu_atual == menu) return true;
}