/*
<meta name="nome_fake" content="Relatorios">
<meta name="nome_rvs" content="vendas.js">
<meta name="localizacao" content="/js/relatorios">
<meta name="descricao" content="Implementação.">
</head>
*/


function carrega_relatorio_venda_vip(url, element_id)
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
    xmlhttp.open("GET", url + '?tipo_venda=vip');
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			element.innerHTML = xmlhttp.responseText;
			pagina = 'relatorio_venda_vip_exibe.php';
			carrega_relatoriovendaescolhido('');
		}
    }
    xmlhttp.send(null);
}

