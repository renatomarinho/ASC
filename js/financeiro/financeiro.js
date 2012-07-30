/*
<meta name="nome_fake" content="Financeiro">
<meta name="nome_rvs" content="financeiro.js">
<meta name="localizacao" content="/js/financeiro">
<meta name="descricao" content="Correcoes.">
</head>
*/
/*
 *
 */
function add_receita_despesa(validate){

	fluxo = document.getElementById('fluxo');

	controle = document.getElementById('controle');
	mv_financeiro_id = document.getElementById('mv_financeiro_id');
	numero_documento	= document.getElementById('numero_documento');
	fornecedorsaida		= document.getElementById('fornecedorsaida');
	fornecedorentrada		= document.getElementById('fornecedorentrada');

	planosaida		= document.getElementById('planosaida');
	planoentrada	= document.getElementById('planoentrada');

	fluxo_valor		= document.getElementById('fluxo_valor');

	vencimento		= document.getElementById('fluxo_vencimento_dia').value + "-" + document.getElementById('fluxo_vencimento_mes').value + "-" + document.getElementById('fluxo_vencimento_ano').value;

	periodicidade	= document.getElementById('periodicidade');
	efetuado		= document.getElementById('efetuado');

	descricao		= document.getElementById('descricao');

	if(fluxo.value == "receita")
	{
		favorecido		= fornecedorentrada
		tipo_lancamento = 'E';
		plano = planoentrada;
	}
	else
	{
		favorecido		= fornecedorsaida
		tipo_lancamento = 'S';
		plano = planosaida;
	}

	if (validate !== false)
	{
		if( numero_documento.value == "" )
		{
			return flash('Preencha o número do documento', 'validator', numero_documento);
		}

		if( favorecido.value == "" )
		{
			return flash('Selecione um fornecedor', 'validator', favorecido);
		}

		if( plano.value == "" )
		{
			return flash('Selecione um plano', 'validator', plano);
		}

		if(fluxo_valor.value == "")
		{
			return flash('Informe o valor', 'validator', fluxo_valor);
		}
	}

	flash('', 'validator');

		params = "mv_financeiro_id="+mv_financeiro_id.value+"&fluxo="+fluxo.value+"&tipo_lancamento="+tipo_lancamento+"&numero_documento="+numero_documento.value+"&favorecido="+favorecido.value+"&plano="+plano.value+"&vencimento="+vencimento+"&periodicidade="+periodicidade.value+"&fluxo_valor="+fluxo_valor.value+"&efetuado="+efetuado.value+"&descricao="+descricao.value;

		xmlhttp.open("POST", path+'modulos/financeiro/fluxo_add_receita_despesa.php', true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.setRequestHeader("Content-length", params.length);
		xmlhttp.setRequestHeader("Connection", "close");
		xmlhttp.onreadystatechange = function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				show_calendario = false;

				if(fluxo.value == 'receita')
					financeiro_fluxo_exibe_receita(true);

				if(fluxo.value == 'despesa')
					financeiro_fluxo_exibe_despesa(true);

					load_calendario();
				flash(xmlhttp.responseText, 'validator');
			}
		}
		xmlhttp.send(params);
}

/**
 * Carrega receita despesa para edição
 */
function load_receita_despesa(controle)
{
	if (!controle) return;

	mes		= document.getElementById('calendario_mes').value;
	params	= "controle="+controle+"&mes="+mes;

	xmlhttp.open("GET", path+'modulos/financeiro/fluxo_load_receita_despesa.php?' + params, true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", params.length);
	xmlhttp.overrideMimeType('text/xml');
	xmlhttp.onreadystatechange = function()
	{
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
		{
			//flash(xmlhttp.responseText, 'validator');
			//flash(xmlhttp.responseXML, 'validator');
			//alert(xmlhttp.responseText);
			response = xmlhttp.responseXML;

			id = response.getElementsByTagName("id")[0].childNodes[0].nodeValue;

			if (id <= 0 ) return;

			tipo = response.getElementsByTagName("tipo")[0].childNodes[0].nodeValue;

			if (tipo == "E")
			{
				financeiro_fluxo_exibe_receita();
				document.getElementById('btn_add_receita_despesa').value = 'atualizar receita';
				document.getElementById('btn_add_receita_despesa').onclick = function() {add_receita_despesa(false)};
				document.getElementById('novo_receita_despesa').value = 'nova receita';
				document.getElementById('novo_receita_despesa').onclick = function() { financeiro_fluxo_exibe_receita(true) }
			}
			if (tipo == "S")
			{
				financeiro_fluxo_exibe_despesa();
				document.getElementById('btn_add_receita_despesa').value = 'atualizar despesa';
				document.getElementById('btn_add_receita_despesa').onclick = function() {add_receita_despesa(false)};
				document.getElementById('novo_receita_despesa').value = 'nova despesa';
				document.getElementById('novo_receita_despesa').onclick = function() { financeiro_fluxo_exibe_despesa(true) }
			}

			document.getElementById('novo_receita_despesa').style.display = 'block';

			mv_financeiro_id = response.getElementsByTagName("mv_financeiro_id")[0].childNodes[0].nodeValue;
			numero_documento = response.getElementsByTagName("numero_documento")[0].childNodes[0].nodeValue;
			fornecedor_id = response.getElementsByTagName("fornecedor_id")[0].childNodes[0].nodeValue;
			plano_id = response.getElementsByTagName("plano_id")[0].childNodes[0].nodeValue;

			data_vencimento_dia = response.getElementsByTagName("data_vencimento")[0].getAttribute("dia");
			data_vencimento_mes = response.getElementsByTagName("data_vencimento")[0].getAttribute("mes");
			data_vencimento_ano = response.getElementsByTagName("data_vencimento")[0].getAttribute("ano");

			periodicidade = response.getElementsByTagName("periodicidade")[0].childNodes[0].nodeValue;
			valor = response.getElementsByTagName("valor")[0].childNodes[0].nodeValue;
			pagamento_efetuado = response.getElementsByTagName("pagamento_efetuado")[0].childNodes[0].nodeValue;
			descricao = response.getElementsByTagName("descricao")[0].childNodes[0].nodeValue;

			// alimentando form
			document.getElementById('numero_documento').value = numero_documento.trim();

			document.getElementById('mv_financeiro_id').value = mv_financeiro_id;

			// favorecido
			document.getElementById('fornecedorentrada').options[0].selected = true;
			document.getElementById('fornecedorsaida').options[0].selected = true;
			for(var i=0; i<document.getElementById('fornecedorentrada').options.length; i++)
			{
				if (document.getElementById('fornecedorentrada').options[i].value == fornecedor_id)
					document.getElementById('fornecedorentrada').options[i].selected = true;
			}

			for(var i=0; i<document.getElementById('fornecedorsaida').options.length; i++)
			{
				if (document.getElementById('fornecedorsaida').options[i].value == fornecedor_id)
					document.getElementById('fornecedorsaida').options[i].selected = true;
			}

			//plano
			document.getElementById('planoentrada').options[0].selected = true;
			document.getElementById('planosaida').options[0].selected = true;
			for(var i=0; i<document.getElementById('planoentrada').options.length; i++)
			{
				if (document.getElementById('planoentrada').options[i].value == plano_id)
					document.getElementById('planoentrada').options[i].selected = true;
			}

			for(var i=0; i<document.getElementById('planosaida').options.length; i++)
			{
				if (document.getElementById('planosaida').options[i].value == plano_id)
					document.getElementById('planosaida').options[i].selected = true;
			}

			// vencimento
			for(var i=0; i<document.getElementById('fluxo_vencimento_dia').options.length; i++)
			{
				if (document.getElementById('fluxo_vencimento_dia').options[i].value == data_vencimento_dia)
					document.getElementById('fluxo_vencimento_dia').options[i].selected = true;
			}

			for(var i=0; i<document.getElementById('fluxo_vencimento_mes').options.length; i++)
			{
				if (document.getElementById('fluxo_vencimento_mes').options[i].value == data_vencimento_mes)
					document.getElementById('fluxo_vencimento_mes').options[i].selected = true;
			}

			for(var i=0; i<document.getElementById('fluxo_vencimento_ano').options.length; i++)
			{
				if (document.getElementById('fluxo_vencimento_ano').options[i].value == data_vencimento_ano)
					document.getElementById('fluxo_vencimento_ano').options[i].selected = true;
			}

			// periodicidade
			for(var i=0; i<document.getElementById('periodicidade').options.length; i++)
			{
				if (document.getElementById('periodicidade').options[i].value == periodicidade)
					document.getElementById('periodicidade').options[i].selected = true;
			}

			// valor
			document.getElementById('fluxo_valor').value = valor;

			// efetuado
			for(var i=0; i<document.getElementById('efetuado').options.length; i++)
			{
				if (document.getElementById('efetuado').options[i].value == pagamento_efetuado)
					document.getElementById('efetuado').options[i].selected = true;
			}

			// descricao
			document.getElementById('descricao').value = descricao.trim();

			//desativando campos não pertinentes
			if (document.getElementById('numero_documento').value == "")
			{
				document.getElementById('numero_documento').disabled = true;
				document.getElementById('label_numero_documento').style.color = '#ccc';

				document.getElementById('fornecedorentrada').disabled = true;
				document.getElementById('fornecedorsaida').disabled = true;
				document.getElementById('label_favorecido').style.color = '#ccc';

				document.getElementById('planoentrada').disabled = true;
				document.getElementById('planosaida').disabled = true;
				document.getElementById('label_plano').style.color = '#ccc';

				document.getElementById('periodicidade').disabled = true;
				document.getElementById('label_periodicidade').style.color = '#ccc';

				document.getElementById('div_icons_favorecido').style.display = 'none';
				document.getElementById('div_icons_plano').style.display = 'none';
			}
		}
	}
	xmlhttp.send(null);
}


/*
 * Adicionando novo plano
 */
function add_plano(){

	novo_plano = document.getElementById('novo_plano');
	fluxo = document.getElementById('fluxo');

	if(fluxo.value == "receita")
	{
		plano	= document.getElementById('planoentrada');
	}
	else
	{
		plano	= document.getElementById('planosaida');
	}

	if( novo_plano.value == "" )
	{
		return flash('Informe o nome do plano', 'validator', novo_plano);
	}

	flash('', 'validator');

	params = "novo_plano="+novo_plano.value+"&fluxo="+fluxo.value;

	xmlhttp.open("POST", path+'modulos/financeiro/fluxo_add_plano.php', true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", params.length);
	xmlhttp.overrideMimeType('text/xml');
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.onreadystatechange = function()
	{
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
		{
			response = xmlhttp.responseXML;

			id = response.getElementsByTagName("id")[0].childNodes[0].nodeValue;
			nome = response.getElementsByTagName("nome")[0].childNodes[0].nodeValue;

			opt_plano = new Option(String("\xa0\xa0"+nome),id);

			plano.options[plano.options.length] = opt_plano;
			plano.options[plano.options.length-1].selected = true;

			document.getElementById('divplano').style.display = 'none';

			flash('Plano Adicionado!', 'noticia');

		}
	}
	xmlhttp.send(params);
}

/*
 * Remove plano
 */
function remove_plano(id)
{
	if(fluxo.value == "receita")
	{
		plano	= document.getElementById('planoentrada');
	}
	else
	{
		plano	= document.getElementById('planosaida');
	}

	params = "id="+id+"&plano="+plano.options[plano.selectedIndex].text.trim();

	xmlhttp.open("POST", path+'modulos/financeiro/fluxo_remove_plano.php', true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", params.length);
	xmlhttp.overrideMimeType('text/xml');
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.onreadystatechange = function()
	{
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
		{
			response = xmlhttp.responseXML;

			id = response.getElementsByTagName("affected")[0].childNodes[0].nodeValue;
			nome = response.getElementsByTagName("nome")[0].childNodes[0].nodeValue;

			if (id > 0 )
			{
				plano.remove(plano.selectedIndex);
				plano.options[0].selected = true;

				document.getElementById('divfavorecido').style.display = 'none';
				flash('Plano \'' + nome + '\' removido com sucesso!', 'noticia');
			}
			else
			{
				flash('Não foi possível remover o plano \'' + nome + '\'.', 'validator');
			}
		}
	}
	xmlhttp.send(params);
}


/*
 * Adicionando novo favorecido/fornecedor
 */
function add_favorecido()
{

	novo_favorecido = document.getElementById('novo_favorecido');
	fluxo = document.getElementById('fluxo');

	if(fluxo.value == "receita")
	{
		favorecido	= document.getElementById('fornecedorentrada');
	}
	else
	{
		favorecido	= document.getElementById('fornecedorsaida');
	}

	if( novo_favorecido.value == "" )
	{
		return flash('Informe o nome do Favorecido', 'validator', novo_favorecido);
	}

	flash('', 'validator');

	params = "novo_favorecido="+novo_favorecido.value+"&fluxo="+fluxo.value;

	xmlhttp.open("POST", path+'modulos/financeiro/fluxo_add_favorecido.php', true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", params.length);
	xmlhttp.overrideMimeType('text/xml');
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.onreadystatechange = function()
	{
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
		{
			response = xmlhttp.responseXML;

			id = response.getElementsByTagName("id")[0].childNodes[0].nodeValue;
			nome = response.getElementsByTagName("nome")[0].childNodes[0].nodeValue;

			opt_favorecido = new Option("\xa0\xa0"+nome,id);

			favorecido.options[favorecido.options.length] = opt_favorecido;
			favorecido.options[favorecido.options.length-1].selected = true;

			document.getElementById('divfavorecido').style.display = 'none';

			flash('Favorecido Adicionado!', 'noticia');
		}
	}
	xmlhttp.send(params);
}


/*
 * Remove favorecido/fornecedor
 */
function remove_favorecido(id)
{

	if(fluxo.value == "receita")
	{
		favorecido	= document.getElementById('fornecedorentrada');
	}
	else
	{
		favorecido	= document.getElementById('fornecedorsaida');
	}

	params = "id="+id+"&favorecido="+favorecido.options[favorecido.selectedIndex].text.trim();

	xmlhttp.open("POST", path+'modulos/financeiro/fluxo_remove_favorecido.php', true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", params.length);
	xmlhttp.overrideMimeType('text/xml');
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.onreadystatechange = function()
	{
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
		{
			response = xmlhttp.responseXML;

			id = response.getElementsByTagName("affected")[0].childNodes[0].nodeValue;
			nome = response.getElementsByTagName("nome")[0].childNodes[0].nodeValue;

			if (id > 0 )
			{
				favorecido.remove(favorecido.selectedIndex);
				favorecido.options[0].selected = true;

				document.getElementById('divfavorecido').style.display = 'none';
				flash('Favorecido \'' + nome + '\' removido com sucesso!', 'noticia');
			}
			else
			{
				flash('Não foi possível remover o favorecido \'' + nome + '\'.', 'validator');
			}
		}
	}
	xmlhttp.send(params);
}

/*
 *
 */
var show_calendario = false;
var request_mes;
function load_calendario()
{

	calendario_mes      = document.getElementById('calendario_mes');
	div_calendario_mes  = document.getElementById('div_calendario_mes');
	calendario          = document.getElementById('calendario');

	today = new Date();

	dia_inicio = document.getElementById('dia1').value;
	mes_inicio = document.getElementById('mes1').value;
	ano_inicio = document.getElementById('ano1').value;

	dia_fim = document.getElementById('dia2').value;
	mes_fim = document.getElementById('mes2').value;
	ano_fim = document.getElementById('ano2').value;

  if ( !show_calendario )
  {
          show_calendario = true;
          //request_mes = mes_inicio;

          try
          {
                  calendario.innerHTML = loading_dados;
          }
          catch(err)
          {
                  alert(err);
          }

          params = "dia_inicio="+dia_inicio+"&mes_inicio="+mes_inicio+'&ano_inicio='+ano_inicio+"&dia_fim="+dia_fim+"&mes_fim="+mes_fim+'&ano_fim='+ano_fim;

          my_calendar = SingleXmlHttp(true);

          my_calendar.open("POST", path+'modulos/financeiro/fluxo_calendario.php', true);
          my_calendar.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          my_calendar.setRequestHeader("Content-length", params.length);
          my_calendar.setRequestHeader("Connection", "close");
          my_calendar.onreadystatechange = function()
          {
                  if(my_calendar.readyState == 4 && my_calendar.status == 200)
                  {
                          calendario.innerHTML = my_calendar.responseText;
                          show_calendario = false;
                          //if (mes_inicio != request_mes)
                          //{
								//load_calendario();
                         // }
                          Behavior.apply();

                  }
          }
          my_calendar.send(params);
          return true;
  }
}

var make_date_status = false;
function fluxo_make_date_calendar(value, dia_inicio, mes_inicio, ano_inicio, dia_fim, mes_fim, ano_fim)
{
	today = new Date();

	if (typeof value == 'undefined')
	{
		dia_inicio = 1;
		mes_inicio = today.getMonth()+1;
		ano_inicio = today.getFullYear();

		dia_fim = dia_inicio;
		mes_fim = mes_inicio;
		ano_fim = ano_inicio;

		value_inicio = 0;
		value_fim = 0;
	}
	else
	{

		if (!dia_inicio)	dia_inicio = 1;
		if (!dia_fim)	dia_fim = dia_inicio;

		if (!mes_inicio)	mes_inicio = today.getMonth()+1;
		if (!mes_fim)	mes_fim = mes_inicio + 1;

		if (!ano_inicio)	ano_inicio = today.getFullYear();
		if (!ano_fim)	ano_fim = ano_inicio;

		value_inicio = value;
		value_fim = value;

	}

	if (!make_date_status)
	{
		make_date_status = true;
		my_inicio = SingleXmlHttp(true);
		// inicio
		my_inicio.open("GET", path+'modulos/extra/agenda_mudadata.php?s='+value_inicio+'&d='+dia_inicio+'&m='+mes_inicio+'&a='+ano_inicio);
	  	my_inicio.onreadystatechange = function() {
			if (my_inicio.readyState == 4 && my_inicio.status == 200) {
				make_date_status = false;
				var retorno1 = my_inicio.responseText;
					retorno1 = (retorno1).split('|');

					dia_inicio = retorno1[1];
					mes_inicio = retorno1[2];
					ano_inicio = retorno1[3];

//					document.getElementById('dia1').value = dia_inicio;
//					document.getElementById('mes1').value = mes_inicio;
//					document.getElementById('ano1').value = ano_inicio;

			}
		}
		my_inicio.send(null);

		my_fim = SingleXmlHttp(true);
		// fim
		my_fim.open("GET", path+'modulos/extra/agenda_mudadata.php?s='+value_fim+'&d='+dia_fim+'&m='+mes_fim+'&a='+ano_fim);
	  	my_fim.onreadystatechange = function() {
			if (my_fim.readyState == 4 && my_fim.status == 200) {
				make_date_status = false;
				var retorno2 = my_fim.responseText;
					retorno2 = (retorno2).split('|');

					dia_fim = retorno2[1];
					mes_fim = retorno2[2];
					ano_fim = retorno2[3];

					document.getElementById('dia1').value = dia_inicio;
					document.getElementById('mes1').value = mes_inicio;
					document.getElementById('ano1').value = ano_inicio;

					document.getElementById('dia2').value = dia_fim;
					document.getElementById('mes2').value = mes_fim;
					document.getElementById('ano2').value = ano_fim;

					load_calendario();

			}
		}
		my_fim.send(null);
	}
}


function fluxo_reload_date(value)
{

	if ( !show_calendario )
	{
		dia_inicio = document.getElementById('dia1').value;
		mes_inicio = document.getElementById('mes1').value;
		ano_inicio = document.getElementById('ano1').value;

		dia_fim = document.getElementById('dia2').value;
		mes_fim = document.getElementById('mes2').value;
		ano_fim = document.getElementById('ano2').value;

		fluxo_make_date_calendar(value, dia_inicio, mes_inicio, ano_inicio, dia_fim, mes_fim, ano_fim);

	}
}
