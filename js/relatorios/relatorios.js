/*
<meta name="nome_fake" content="Relatorios">
<meta name="nome_rvs" content="relatorios.js">
<meta name="localizacao" content="/js/relatorios">
<meta name="descricao" content="Implementção.">
</head>
*/

function export_pdf(elm, relatorio_titulo, relatorio_descricao)
{
	var div_out_put;

	if (document.getElementById('tmp_out_put')) document.body.removeChild(document.getElementById('tmp_out_put'))

	div_out_put = document.createElement('div');
	div_out_put.id = "tmp_out_put";
	div_out_put.style.display = "none";

	// carregando template
	xmlhttp.open("GET", path+'modulos/relatorios/exports/_template_default.php');
    xmlhttp.onreadystatechange = function()
    {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    	{
			//t = document.createTextNode(xmlhttp.responseText)
			//div_out_put.appendChild(t);
			div_out_put.innerHTML = xmlhttp.responseText;
			document.body.appendChild(div_out_put);
			document.getElementById('tabela_titulos').innerHTML;
			document.getElementById('append_result').innerHTML = document.getElementById('tabela_titulos').innerHTML + document.getElementById(elm).innerHTML;
			document.getElementById('relatorio_titulo').innerHTML = relatorio_titulo;
			document.getElementById('relatorio_descricao').innerHTML = relatorio_descricao;
			make_form(document.getElementById('tmp_out_put').innerHTML, relatorio_titulo);
			//append_result(xmlhttp.responseText);
		}
    }
    xmlhttp.send(null);

    //alert(document.getElementById('append_result').innerHTML);

}

function make_form(result, file_name)
{
	var f = document.createElement('form');

	f.setAttribute('name','form_pdf_tmp');
	f.setAttribute('action','modulos/relatorios/exports/pdf.php');
	f.setAttribute('target','_blank');
	f.setAttribute('method','post');

	var content=document.createElement('textarea');
	content.setAttribute('type','text');
	content.setAttribute('name','content');
	content.value = result;

	var paper=document.createElement('input');
	paper.setAttribute('type','text');
	paper.setAttribute('name','paper');
	paper.setAttribute('value','a4');

	var orientation=document.createElement('input');
	orientation.setAttribute('type','text');
	orientation.setAttribute('name','orientation');
	//orientation.setAttribute('value','portrait');
	orientation.setAttribute('value','landscape');

	var field_file_name=document.createElement('input');
	field_file_name.setAttribute('type','text');
	field_file_name.setAttribute('name','file_name');
	field_file_name.setAttribute('value',file_name);

  	f.appendChild(content);
    f.appendChild(paper);
    f.appendChild(orientation);
    f.appendChild(field_file_name);

    document.getElementById('tmp_out_put').appendChild(f);

	//document.body.appendChild(f);

	f.submit();

}