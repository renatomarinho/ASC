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
var calendario_data,cal_diasemana,cal_dia,cal_mes,cal_ano;

function carrega_utilitarios_agenda(d1,m1,a1)
{
	var conteudo_esquerdo = document.getElementById('conteudo_esquerdo');
	conteudo_esquerdo.style.display = 'none';
	var conteudo_direito = document.getElementById('conteudo_direito');
	conteudo_direito.style.display = 'none';
	var conteudo_total = document.getElementById('conteudo_total');
	conteudo_total.style.display = 'block';
	conteudo_total.innerHTML = '';
	//element.innerHTML = loading_dados;
    xmlhttp.open("GET", path+'modulos/extra/agenda_eventos.php');

    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			conteudo_total.innerHTML = xmlhttp.responseText;
			//utilitarios_agenda_eventosdia(d1,m1,a1);
			utilitarios_agenda_eventosmes(0);
		}
    }
    xmlhttp.send(null);
}

function utilitarios_agenda_eventosdia(d1,m1,a1)
{
	
	xmlhttp.open("GET", path+'modulos/extra/agenda_eventos_dia.php?d1='+d1+'&m1='+m1+'&a1='+a1);
    xmlhttp.onreadystatechange = function()
    {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    	{
			 document.getElementById('calendar').innerHTML = xmlhttp.responseText;
			 agenda_eventos_retorno(d1,m1,a1);
			 btnModos();
		}
	}
    xmlhttp.send(null);

}

function agenda_eventos_retorno(d1,m1,a1)
{
	var d = new Date();
	var horaatual = d.getHours();
	var y = document.getElementById('calendario_dia');
	document.getElementById('calendario_dia').scrollTop = 210;
	xmlhttp.open("GET", path+'modulos/extra/agenda_eventos_retorno.php?d1='+d1+'&m1='+m1+'&a1='+a1);
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var hora1,minuto1,hora2,minuto2,total=0,horario1=0,horario2=0,resultado='';retorno = xmlhttp.responseText;
			var horarios = new Array();
			retorno = (retorno).split('|*|');
			total = retorno[0];
			retorno = retorno[1];
			for ( x=0;x<total;x++ )
			{

				resultado = (retorno).split('+|+');
				resultado = (resultado[x]).split('|');
                                id_agenda = resultado[0];
				horario1 = (resultado[1]).split(':');
				hora1 = (horario1[0]<10)?(horario1[0]).replace('0',''):horario1[0];
				horario2 = (resultado[2]).split(':');
				hora2 = (horario2[0]<10)?(horario2[0]).replace('0',''):horario2[0];

                if ( !horarios[hora1] )
                {
                        horarios[hora1] = 'true';
                        document.getElementById('registro_'+hora1).innerHTML = '<a href="javascript:;" onclick="load_agenda_evento('+id_agenda+')"><div id="item_agenda_'+id_agenda+'"><span '+((resultado[4]==0)?'class="t_mark"':'')+'>'+hora1+':'+horario1[1]+' às '+hora2+':'+horario2[1]+' - '+resultado[3]+'</span></div></a>';
                }
                else
                {
                        document.getElementById('registro_'+hora1).innerHTML += '<BR><a href="javascript:;" onclick="load_agenda_evento('+id_agenda+')"><div id="item_agenda_'+id_agenda+'"><span '+((resultado[4]==0)?'class="t_mark"':'')+'>'+hora1+':'+horario1[1]+' às '+hora2+':'+horario2[1]+' - '+resultado[3]+'</span></div></a>';
                }
			}
		}
    }
    xmlhttp.send(null);
}

function load_agenda_eventomes(my_time)
{
	utilitarios_agenda_eventosmes(my_time)
}

function utilitarios_agenda_eventosmes(my_time)
{
	xmlhttp.open("GET", path+'modulos/extra/agenda_eventos_mes.php?a='+my_time);
    xmlhttp.onreadystatechange = function()
    {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    	{
			 document.getElementById('calendar').innerHTML = xmlhttp.responseText;
			 btnModos();
		}
	}
    xmlhttp.send(null);
}


function utilitarios_agenda_btnscal(value){

	utilitarios_agenda_dataatual();

	for ( x=0;x<24;x++ ){
		document.getElementById('registro_'+x).innerHTML = '';
	}

	var dia_proximo = cal_dia.title;
	var mes_proximo = cal_mes.title;
	var ano_proximo = cal_ano.title;

	xmlhttp.open("GET", path+'modulos/extra/agenda_mudadata.php?s='+value+'&d='+dia_proximo+'&m='+mes_proximo+'&a='+ano_proximo);
    	xmlhttp.onreadystatechange = function() {
    		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
    			var retorno = xmlhttp.responseText;
    			retorno = (retorno).split('|');

				cal_diasemana.innerHTML = dias[retorno[0]];
				cal_diasemana.title = retorno[0];

				cal_dia.innerHTML = retorno[1];
				cal_dia.title = retorno[1];

				cal_mes.innerHTML = meses[retorno[2]];
				cal_mes.title = retorno[2];

				cal_ano.innerHTML = retorno[3];
				cal_ano.title = retorno[3];

				agenda_eventos_retorno(retorno[1],retorno[2],retorno[3]);

			}
    	}
    	xmlhttp.send(null);
}

function utilitarios_agenda_calendario(){

	var modoexibicao = document.getElementById('modoexibicao');
	var calendario_dia = document.getElementById('calendario_dia');
	var calendario_semana = document.getElementById('calendario_semana');
	var diasemana_anterior = document.getElementById('diasemana_anterior');
	var diasemana_proximo = document.getElementById('diasemana_proximo');

	calendario_semana.style.display = (calendario_semana.style.display=='block')?'none':'block';
	calendario_dia.style.display = (calendario_dia.style.display=='block')?'none':'block';
	modoexibicao.value = (modoexibicao.value=='exibiçao mensal')?'exibiçao semanal':'exibiçao mensal';
	diasemana_anterior.value = (diasemana_anterior.value=='dia anterior')?'semana anterior':'dia anterior';
	diasemana_proximo.value = (diasemana_proximo.value=='próximo dia')?'próxima semana':'próximo dia';
	diasemana_anterior.title = (diasemana_anterior.title==5)?1:5;
	diasemana_proximo.title = (diasemana_proximo.title==6)?2:6;

}

function utilitarios_agenda_dataatual(){
	cal_diasemana = document.getElementById('diasemana');
	cal_dia = document.getElementById('dia');
	cal_mes = document.getElementById('mes');
	cal_ano = document.getElementById('ano');
}

function load_agenda_evento (id)
{
    utilitarios_agenda_dataatual();

    xmlhttp.open("GET", path+'modulos/extra/agenda_eventos_retorno.php?id_agenda='+id);
    xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            carrega_utilitario_agenda()

            document.getElementById('diaescolhido1').value = cal_dia.title;
            document.getElementById('mesescolhido1').value = cal_mes.title;
            document.getElementById('anoescolhido1').value = cal_ano.title;

            var hora1,minuto1,hora2,minuto2,total=0,horario1=0,horario2=0,resultado='';

            retorno = xmlhttp.responseText;
            var horarios = new Array();
            retorno = (retorno).split('|*|');
            total = retorno[0];
            retorno = retorno[1];
            for ( x=0;x<total;x++ ){
                    resultado = (retorno).split('+|+');
                    resultado = (resultado[x]).split('|');
                    id_agenda = resultado[0];
                    horario1 = (resultado[1]).split(':');
                    hora1 = (horario1[0]<10)?(horario1[0]).replace('0',''):horario1[0];
                    min1 = (horario1[1]<10)?(horario1[1]).replace('0',''):horario1[1];

                    horario2 = (resultado[2]).split(':');
                    hora2 = (horario2[0]<10)?(horario2[0]).replace('0',''):horario2[0];
                    min2 = horario2[1];

                    document.getElementById('horaescolhida1').value = hora1;
                    document.getElementById('minutoescolhido1').value = min1;

                    document.getElementById('horaescolhida2').value = hora2;
                    document.getElementById('minutoescolhido2').value = ''+min2+'';

                    document.getElementById('tarefa').value = resultado[3]

                    document.getElementById('acompanhamento').value = resultado[4];

                    document.getElementById('id_agenda').value = id_agenda

            }

            document.getElementById('bnt_adicionar_evento').value = "salvar"
        }
    }

    xmlhttp.send(null);

}


function utilitarios_agenda_adicionarevento(){
	document.getElementById('tarefa').value = '';
	document.getElementById('form_exibicao').style.display = 'block';
	document.getElementById('form_exibicao_adicionado').style.display = 'none';
}

function carrega_utilitario_agenda()
{
  document.getElementById('form_exibicao').style.display = 'block';
  document.getElementById('form_exibicao_adicionado').style.display = 'none';
  document.getElementById('bnt_add_new_agenda').style.display = 'none';
  document.getElementById('tarefa').value = "";
  document.getElementById('id_agenda').value = "";
}

function utilitarios_agenda_tarefasalvar()
{
	var tarefa, he1, me1, de1, me1, ae1, he2, me2, de2, me2, ae2, acompanhamento;

	tarefa = document.getElementById('tarefa');

	if ( tarefa.value )
	{

		
		
		tarefa.style.border = '1px solid '+bg_btn_normal;

		he1 = document.getElementById('horaescolhida1');
		mi1 =  document.getElementById('minutoescolhido1');
		de1 =  document.getElementById('diaescolhido1');
		me1 =  document.getElementById('mesescolhido1');
		ae1 =  document.getElementById('anoescolhido1');

		he2 =  document.getElementById('horaescolhida2');
		mi2 =  document.getElementById('minutoescolhido2');

                // o dia passa a ser o mesmo que inicio
		de2 =  document.getElementById('diaescolhido1');
		me2 =  document.getElementById('mesescolhido1');
		ae2 =  document.getElementById('anoescolhido1');

        date_1 = new Date()
        date_1.setHours(he1.value)
        date_1.setMinutes(mi1.value)

        date_2 = new Date()
        date_2.setHours(he2.value)
        date_2.setMinutes(mi2.value)

        if (date_2 < date_1)
        {
           he1.style.border = '1px solid red';
           mi1.style.border = '1px solid red';
           he2.style.border = '1px solid red';
           mi2.style.border = '1px solid red';
           document.getElementById('msgevento').innerHTML = '<b style="color:red">Período inválido</b>';
           return;
        }

        var status;
        divs = document.getElementsByTagName('div');
        for (i = 0; i < divs.length; i++){
            if (divs[i].id == 'registro_'+he1.value){
                status = 'true';
                break;
            }else{
            	status = 'false';
            }
        }
        
        id_agenda = document.getElementById('id_agenda').value

		acompanhamento = document.getElementById('acompanhamento');

		params = 'tarefa='+tarefa.value+'&he1='+he1.value+'&mi1='+mi1.value+'&de1='+de1.value+'&me1='+me1.value+'&ae1='+ae1.value+'&he2='+he2.value+'&mi2='+mi2.value+'&de2='+de2.value+'&me2='+me2.value+'&ae2='+ae2.value+'&acompanhamento='+acompanhamento.value+'&id_agenda='+id_agenda;

		xmlhttp.open("POST", path+'modulos/extra/agenda_tarefa_salva.php', true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.setRequestHeader("Content-length", params.length);
		xmlhttp.setRequestHeader("Connection", "close");
		xmlhttp.onreadystatechange = function() {
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				if (status=='true'){
					if(id_agenda == ""){
						if ( de1 && me1 && ae1 ){
							var atual = document.getElementById('registro_'+he1.value).innerHTML;
							if (atual.length > 10){
								document.getElementById('registro_'+he1.value).innerHTML += '<BR>';
							}
						}
	
						id_agenda = xmlhttp.responseText;
						document.getElementById('registro_'+he1.value).innerHTML += '<a href="javascript:;" onclick="load_agenda_evento('+id_agenda+')"><div id="item_agenda_'+id_agenda+'"><span '+((acompanhamento.value==0)?'class="t_mark"':'')+'>'+he1.value+':'+mi1.value+' às '+he2.value+':'+mi2.value+' - '+tarefa.value+'</span></div></a>';
	
	                } else {
	
	                    var divs = document.getElementsByTagName("div");
	                    //alert(divs.length);
	                    for (var i = 0; i < divs.length; i++){
	                    	if (divs[i].getAttribute("id") == 'item_agenda_'+id_agenda) {
	                      		divs[i].innerHTML = '';
	                      		divs[i].style.display = 'none';
	                      	}
	                    }
	
	                    document.getElementById('registro_'+he1.value).innerHTML += '<a href="javascript:;" onclick="load_agenda_evento('+id_agenda+')"><div id="item_agenda_'+id_agenda+'"><span '+((acompanhamento.value==0)?'class="t_mark"':'')+'>'+he1.value+':'+mi1.value+' às '+he2.value+':'+mi2.value+' - '+tarefa.value+'</span></div></a>';
	                }
				} else {
					utilitarios_agenda_eventosdia(de1.value,me1.value,ae1.value);
				}
                document.getElementById('form_exibicao').style.display = 'none';
				document.getElementById('form_exibicao_adicionado').style.display = 'block';
                document.getElementById('bnt_add_new_agenda').style.display = 'block';

				//xmlhttp.responseText;
			}
		}
		xmlhttp.send(params);

	} else {
		tarefa.style.border = '1px solid red';
		document.getElementById('msgevento').innerHTML = '<b style="color:red">Preencha a tarefa</b>';
	}

}

function btnModos(){
	el = new Array(kernel.dge('btnModoDiario'),kernel.dge('btnModoMensal'));
	kernel.blockNone(el);
}

