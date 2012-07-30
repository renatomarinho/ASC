/*
<meta name="nome_fake" content="Financeiro">
<meta name="nome_rvs" content="financeiro.js">
<meta name="localizacao" content="/js/financeiro">
<meta name="descricao" content="Correcoes.">
</head>
*/

/*
 * Projeto : Real Virtual Store - v1.0
 * Data : Sep 26, 2008
 * Arquivo : agenda.js
 *
 * Empresa : Real Solutions
 * Desenvolvedor : Renato Marinho < renato.marinho@reals.com.br >
 * 
 */

var calendario_data,cal_diasemana,cal_dia,cal_mes,cal_ano;

var directory = 'agenda';

var Calendar = {
	
	Directory 		: 'agenda',
	Day 			: 0,
	Month 			: 0,
	Year 			: 0,
	DayOfWeek		: 0,
	
	Starting : function (d,m,y){
	
		var conteudo_esquerdo = kernel.dge('conteudo_esquerdo');
		var conteudo_direito = kernel.dge('conteudo_direito');
		var conteudo_total = kernel.dge('conteudo_total');
		conteudo_esquerdo.style.display = 'none';
		conteudo_direito.style.display = 'none';
		conteudo_total.style.display = 'block';
		conteudo_total.innerHTML = '';
	    xmlhttp.open("GET", 'modulos/'+Calendar.Directory+'/index.php');
	
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				conteudo_total.innerHTML = xmlhttp.responseText;
				Calendar.Monthly(0);
	    	}
	    }
	    xmlhttp.send(null);
	    
	},
	
	LoadingTask : function (id) {
		
	    Calendar.ReturnCurrentDate();

	    xmlhttp.open("GET", 'modulos/'+Calendar.Directory+'/eventos.php?id_agenda='+id);
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	            
	    		Calendar.Screen();
	
	            kernel.dge('diaescolhido1').value = Calendar.Day.title;
	            kernel.dge('mesescolhido1').value = Calendar.Month.title;
	            kernel.dge('anoescolhido1').value = Calendar.Year.title;
	
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
	
	                    kernel.dge('horaescolhida1').value = hora1;
	                    kernel.dge('minutoescolhido1').value = min1;
	
	                    kernel.dge('horaescolhida2').value = hora2;
	                    kernel.dge('minutoescolhido2').value = ''+min2+'';
	
	                    kernel.dge('tarefa').value = resultado[3]
	
	                    kernel.dge('acompanhamento').value = resultado[4];
	
	                    kernel.dge('id_agenda').value = id_agenda
	            }
	            kernel.dge('bnt_adicionar_evento').value = "salvar"
	        }
	    }

	    xmlhttp.send(null);

	},
	
	Daily : function (d,m,y){
		xmlhttp.open("GET", 'modulos/'+Calendar.Directory+'/diario.php?d1='+d+'&m1='+m+'&a1='+y);
	    xmlhttp.onreadystatechange = function(){
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
	    		kernel.dge('calendar').innerHTML = xmlhttp.responseText;
				Calendar.ReturnTasks(d,m,y);
			}
		}
	    xmlhttp.send(null);
	},
	
	Monthly : function (value){
		xmlhttp.open("GET", 'modulos/'+Calendar.Directory+'/mensal.php?a='+value);
	    xmlhttp.onreadystatechange = function(){
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
				 kernel.dge('calendar').innerHTML = xmlhttp.responseText;
			}
		}
	    xmlhttp.send(null);
	},

	Screen : function (){
		kernel.dge('form_exibicao').style.display = 'block';
		kernel.dge('form_exibicao_adicionado').style.display = 'none';
		kernel.dge('bnt_add_new_agenda').style.display = 'none';
		kernel.dge('tarefa').value = "";
		kernel.dge('id_agenda').value = "";
	},
	
	ScreenMode : function (){
		el = new Array(kernel.dge('btnModoDiario'),kernel.dge('btnModoMensal'));
		kernel.blockNone(el);
	},
	
	ChangeData : function (value){

		Calendar.ReturnCurrentDate();

		for ( x=0;x<24;x++ ){
			kernel.dge('registro_'+x).innerHTML = '';
		}

		var dia_proximo = Calendar.Day.title;
		var mes_proximo = Calendar.Month.title;
		var ano_proximo = Calendar.Year.title;
		
		xmlhttp.open("GET", 'modulos/'+Calendar.Directory+'/altera_data.php?s='+value+'&d='+dia_proximo+'&m='+mes_proximo+'&a='+ano_proximo);
    	xmlhttp.onreadystatechange = function() {
    		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
    			var retorno = xmlhttp.responseText;
    			retorno = (retorno).split('|');

    			Calendar.DayOfWeek.innerHTML = dias[retorno[0]];
    			Calendar.DayOfWeek.title = retorno[0];

				Calendar.Day.innerHTML = retorno[1];
				Calendar.Day.title = retorno[1];

				Calendar.Month.innerHTML = meses[retorno[2]];
				Calendar.Month.title = retorno[2];

				Calendar.Year.innerHTML = retorno[3];
				Calendar.Year.title = retorno[3];

				Calendar.ReturnTasks(retorno[1],retorno[2],retorno[3]);

			}
    	}
    	xmlhttp.send(null);
	},
	
	SaveTask : function (){
		var tarefa, he1, me1, de1, me1, ae1, he2, me2, de2, me2, ae2, acompanhamento;

		tarefa = kernel.dge('tarefa');

		if ( tarefa.value ){

			tarefa.style.border = '1px solid '+bg_btn_normal;

			he1 = kernel.dge('horaescolhida1');
			mi1 = kernel.dge('minutoescolhido1');
			de1 = kernel.dge('diaescolhido1');
			me1 = kernel.dge('mesescolhido1');
			ae1 = kernel.dge('anoescolhido1');

			he2 = kernel.dge('horaescolhida2');
			mi2 = kernel.dge('minutoescolhido2');

			de2 = kernel.dge('diaescolhido1');
			me2 = kernel.dge('mesescolhido1');
			ae2 = kernel.dge('anoescolhido1');

	        date_1 = new Date()
	        date_1.setHours(he1.value)
	        date_1.setMinutes(mi1.value)

	        date_2 = new Date()
	        date_2.setHours(he2.value)
	        date_2.setMinutes(mi2.value)

	        if (date_2 < date_1){
	           he1.style.border = '1px solid red';
	           mi1.style.border = '1px solid red';
	           he2.style.border = '1px solid red';
	           mi2.style.border = '1px solid red';
	           kernel.dge('msgevento').innerHTML = '<b style="color:red">Horário inválido</b>';
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
	        
	        id_agenda = kernel.dge('id_agenda').value

			acompanhamento = kernel.dge('acompanhamento');

			params = 'tarefa='+tarefa.value+'&he1='+he1.value+'&mi1='+mi1.value+'&de1='+de1.value+'&me1='+me1.value+'&ae1='+ae1.value+'&he2='+he2.value+'&mi2='+mi2.value+'&de2='+de2.value+'&me2='+me2.value+'&ae2='+ae2.value+'&acompanhamento='+acompanhamento.value+'&id_agenda='+id_agenda;

			xmlhttp.open("POST", 'modulos/'+Calendar.Directory+'/salva.php', true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.setRequestHeader("Content-length", params.length);
			xmlhttp.setRequestHeader("Connection", "close");
			xmlhttp.onreadystatechange = function() {
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					if (status=='true'){
						if(id_agenda == ""){
							if ( de1 && me1 && ae1 ){
								var atual = kernel.dge('registro_'+he1.value).innerHTML;
								if (atual.length > 10){
									kernel.dge('registro_'+he1.value).innerHTML += '<BR>';
								}
							}
		
							id_agenda = xmlhttp.responseText;
							kernel.dge('registro_'+he1.value).innerHTML += '<a href="javascript:;" onclick="javascript:Calendar.LoadingTask('+id_agenda+');"><div id="item_agenda_'+id_agenda+'"><span '+((acompanhamento.value==0)?'class="t_mark"':'')+'>'+he1.value+':'+mi1.value+' às '+he2.value+':'+mi2.value+' - '+tarefa.value+'</span></div></a>';
		
		                } else {
		
		                    var divs = document.getElementsByTagName("div");
		                    for (var i = 0; i < divs.length; i++){
		                    	if (divs[i].getAttribute("id") == 'item_agenda_'+id_agenda) {
		                      		divs[i].innerHTML = '';
		                      		divs[i].style.display = 'none';
		                      	}
		                    }
		
		                    kernel.dge('registro_'+he1.value).innerHTML += '<a href="javascript:;" onclick="javascript:Calendar.LoadingTask('+id_agenda+');"><div id="item_agenda_'+id_agenda+'"><span '+((acompanhamento.value==0)?'class="t_mark"':'')+'>'+he1.value+':'+mi1.value+' às '+he2.value+':'+mi2.value+' - '+tarefa.value+'</span></div></a>';
		                }
					} else {
						Calendar.Daily(de1.value, me1.value, ae1.value);
					}
					kernel.dge('form_exibicao').style.display = 'none';
					kernel.dge('form_exibicao_adicionado').style.display = 'block';
					kernel.dge('bnt_add_new_agenda').style.display = 'block';
				}
			}
			xmlhttp.send(params);

		} else {
			tarefa.style.border = '1px solid red';
			kernel.dge('msgevento').innerHTML = '<b style="color:red">Preencha a tarefa</b>';
		}

	},
	
	ReturnCurrentDate : function (){
		Calendar.DayOfWeek 	= kernel.dge('diasemana');
		Calendar.Day 		= kernel.dge('dia');
		Calendar.Month 		= kernel.dge('mes');
		Calendar.Year 		= kernel.dge('ano');
	},
	
	ReturnTasks : function (d1,m1,y1){
		var d = new Date();
		var horaatual = d.getHours();
		var y = kernel.dge('calendario_dia');
		kernel.dge('calendario_dia').scrollTop = 210;
		xmlhttp.open("GET", 'modulos/'+Calendar.Directory+'/eventos.php?d1='+d1+'&m1='+m1+'&a1='+y1);
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    		var hora1,minuto1,hora2,minuto2,total=0,horario1=0,horario2=0,resultado='';retorno = xmlhttp.responseText;
				var horarios = new Array();
				retorno = (retorno).split('|*|');
				total = retorno[0];
				retorno = retorno[1];
				for ( x=0;x<total;x++ ) {
					resultado = (retorno).split('+|+');
					resultado = (resultado[x]).split('|');
	                id_agenda = resultado[0];
					horario1 = (resultado[1]).split(':');
					hora1 = (horario1[0]<10)?(horario1[0]).replace('0',''):horario1[0];
					horario2 = (resultado[2]).split(':');
					hora2 = (horario2[0]<10)?(horario2[0]).replace('0',''):horario2[0];
	                if ( !horarios[hora1] ) {
	                	horarios[hora1] = 'true';
	                    kernel.dge('registro_'+hora1).innerHTML = '<a href="javascript:;" onclick="Calendar.LoadingTask('+id_agenda+')"><div id="item_agenda_'+id_agenda+'"><span '+((resultado[4]==0)?'class="t_mark"':'')+'>'+hora1+':'+horario1[1]+' às '+hora2+':'+horario2[1]+' - '+resultado[3]+'</span></div></a>';
	                } else {
	                	kernel.dge('registro_'+hora1).innerHTML += '<BR><a href="javascript:;" onclick="Calendar.LoadingTask('+id_agenda+')"><div id="item_agenda_'+id_agenda+'"><span '+((resultado[4]==0)?'class="t_mark"':'')+'>'+hora1+':'+horario1[1]+' às '+hora2+':'+horario2[1]+' - '+resultado[3]+'</span></div></a>';
	                }
				}
			}
	    }
	    xmlhttp.send(null);
	}
		
};

