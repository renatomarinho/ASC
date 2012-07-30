

var Configuration = {
		
	Directory 		: 'configuracao',
	Mode			: '',
	
	Starting : function (){
			
		var conteudo_total = kernel.dge('conteudo_total') , conteudo_esquerdo = kernel.dge('conteudo_esquerdo'), conteudo_direito = kernel.dge('conteudo_direito');
		
		conteudo_total.style.display = 'none';
		conteudo_esquerdo.style.display = 'block';
		conteudo_direito.style.display = 'block';
		
		conteudo_total.innerHTML = '';
		conteudo_esquerdo.innerHTML = '';
		conteudo_direito.innerHTML = '';

		xmlhttp.open("GET", "modulos/"+Configuration.Directory+"/index.php");
    	xmlhttp.onreadystatechange = function() {
    		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
    			conteudo_esquerdo.innerHTML = xmlhttp.responseText;
    			Configuration.StartPage();
    		}
    	}
	    	
	    xmlhttp.send(null);

	},
	
	StartPage : function (){
		
		xmlhttp.open("GET", 'modulos/'+Configuration.Directory+'/start_page.php');
		xmlhttp.onreadystatechange = function() {
			
		   	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		   		kernel.dge('conteudo_direito').innerHTML = xmlhttp.responseText;
			}
		   	
		}
		
		xmlhttp.send(null);
		
	},
	
	LoadPage : function (page){
		
		xmlhttp.open("GET", "modulos/"+Configuration.Directory+"/"+page+".php");
	    xmlhttp.onreadystatechange = function() {
	    
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    		kernel.dge('conteudo_direito').innerHTML = xmlhttp.responseText;
	    		Configuration.LoadList(page);
			}
	    	
	    }
	    
	    xmlhttp.send(null);
		
	},
	
	LoadList : function (page){
		
		xmlhttp.open("GET", "modulos/"+Configuration.Directory+"/"+page+"_lista.php");
	    xmlhttp.onreadystatechange = function() {
	    
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    		kernel.dge(page+'_lista').innerHTML = xmlhttp.responseText;
			}
	    	
	    }
	    
	    xmlhttp.send(null);
		
	},

	NewCard : function (){
		
		xmlhttp.open("GET", "modulos/"+Configuration.Directory+"/cartao_form.php");
	    xmlhttp.onreadystatechange = function() {
	    	
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    		
	    		kernel.dge('features').innerHTML = xmlhttp.responseText;
	    		kernel.dge('message_card').innerHTML = "";
	    		kernel.dge('btnoption').value = "salvar cartão";
				kernel.dge('btnoption').onclick = function (){ Configuration.SaveCard(); }
				
			}
	    	
	    }
	    
	    xmlhttp.send(null);
	},
	
	ShowCard : function (value){
		
		xmlhttp.open("GET", "modulos/"+Configuration.Directory+"/cartao_show.php?id="+value);
	    xmlhttp.onreadystatechange = function() {
	    	
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    		
	    		response = xmlhttp.responseText;
	    		response = response.split('+|+');
	    		
	    		xmlhttp.open("GET", "modulos/"+Configuration.Directory+"/cartao_form.php");
	    	    xmlhttp.onreadystatechange = function() {
	    	    	
	    	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    	    		
	    	    		kernel.dge('features').innerHTML = xmlhttp.responseText;
	    	    		kernel.dge('message_card').innerHTML = "";
	    				kernel.dge('btnoption').value = "editar cartão";
	    				kernel.dge('btnoption').onclick = function (){ Configuration.EditCard(); }
	    		
	    				kernel.dge('idcard').value = value;
	    				kernel.dge('namecard').value = response[0];
	    				kernel.dge('credit').checked = (response[1]==1)?true:false;
	    				kernel.dge('div_credit').style.display = (response[1]==1)?'block':'false';
	    				kernel.dge('debit').checked = (response[2]==1)?true:false;
	    				kernel.dge('div_debit').style.display = (response[2]==1)?'block':'false';
	    				kernel.dge('tx_credit1').value = response[3];
	    				kernel.dge('tx_credit2').value = response[4];
	    				kernel.dge('tx_debit1').value = response[5];
	    				kernel.dge('statuscard').checked = (response[6]==1)?true:false;
	    				
	    			}
	    	    	
	    	    }
	    	    
	    	    xmlhttp.send(null);
	    	    
			}
	    	
	    }
	    
	    xmlhttp.send(null);
	    
		
	},
	
	SaveCard : function (){
		
		Configuration.Mode = 'insert';
		Configuration.ModifyCard();
		
	},
	
	EditCard : function (){
		
		Configuration.Mode = 'update';
		Configuration.ModifyCard();
		
	},
	
	ModifyCard : function(){
		
		if ( Configuration.CheckCardOptions() ){

			xmlhttp.open("GET", "modulos/"+Configuration.Directory+"/cartao_salva.php?mode="+Configuration.Mode+"&id="+kernel.dge('idcard').value+"&namecard="+kernel.dge('namecard').value+"&credit="+kernel.dge('credit').checked+"&debit="+kernel.dge('debit').checked+"&tx_credit1="+kernel.dge('tx_credit1').value+"&tx_credit2="+kernel.dge('tx_credit2').value+"&tx_debit1="+kernel.dge('tx_debit1').value+"&status="+kernel.dge('statuscard').checked);
		    xmlhttp.onreadystatechange = function() {
		    	
		    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		    		
		    		kernel.dge('btnoption').value = "adicionar cartão";
					kernel.dge('btnoption').onclick = function (){ Configuration.NewCard(); }
					
					kernel.dge('features').innerHTML = '';
		    		kernel.dge('message_card').innerHTML = "<b style=\"color:green;\">Cartão salvo com sucesso</b>";
					
					Configuration.LoadList('cartao');
					
				}
		    	
		    }
		    
		    xmlhttp.send(null);
		}
		
	},
	
	CheckCardOptions : function (){
		
		if ( !kernel.dge('namecard').value ){
			kernel.dge('message_card').innerHTML = "<b style=\"color:red;\">Preencha o nome do cartão</b>";
			return false;
		}
		
		if ( !(kernel.dge('credit').checked || kernel.dge('debit').checked) ){
			kernel.dge('message_card').innerHTML = "<b style=\"color:red;\">Habilite a opção Crédito ou Débito</b>";
			return false;
		}
		
		kernel.dge('message_card').innerHTML = "";
		return true;
		
	},	
	
	ShowBank : function (value){
		
		xmlhttp.open("GET", "modulos/"+Configuration.Directory+"/banco_show.php?id="+value);
	    xmlhttp.onreadystatechange = function() {
	    	
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    		
	    		response = xmlhttp.responseText;
	    		response = response.split('+|+');
	    		
	    		xmlhttp.open("GET", "modulos/"+Configuration.Directory+"/banco_form.php");
	    	    xmlhttp.onreadystatechange = function() {
	    	    	
	    	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    	    		
	    	    		kernel.dge('features').innerHTML = xmlhttp.responseText;
	    	    		kernel.dge('message_bank').innerHTML = "";
	    				kernel.dge('btnoption').value = "editar banco";
	    				kernel.dge('btnoption').onclick = function (){ Configuration.EditBank(); }
	    				
	    				kernel.dge('idbank').value = value;
	    				kernel.dge('namebank').value = response[0];
	    				kernel.dge('numberbank').value = response[1];
	    				kernel.dge('statusbank').checked = (response[2]==1)?true:false;

	    			}
	    	    	
	    	    }
	    	    
	    	    xmlhttp.send(null);
	    	    
			}
	    	
	    }
	    
	    xmlhttp.send(null);
		
	},
	
	SaveBank : function (){
		
		Configuration.Mode = 'insert';
		Configuration.ModifyBank();
		
	},
	
	EditBank : function (){
		
		Configuration.Mode = 'update';
		Configuration.ModifyBank();
		
	},
	
	ModifyBank : function(){
		
		if ( Configuration.CheckBank() ){

			xmlhttp.open("GET", "modulos/"+Configuration.Directory+"/banco_salva.php?mode="+Configuration.Mode+"&id="+kernel.dge('idbank').value+"&namebank="+kernel.dge('namebank').value+"&numberbank="+kernel.dge('numberbank').value+"&statusbank="+kernel.dge('statusbank').checked+"");
		    xmlhttp.onreadystatechange = function() {
		    	
		    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		    		
		    		kernel.dge('btnoption').value = "adicionar banco";
					kernel.dge('btnoption').onclick = function (){ Configuration.NewBank(); }
					
					kernel.dge('features').innerHTML = '';
		    		kernel.dge('message_bank').innerHTML = "<b style=\"color:green;\">Banco salvo com sucesso</b>";
					
					Configuration.LoadList('banco');
					
				}
		    	
		    }
		    
		    xmlhttp.send(null);
		}
		
	},
	
	NewBank : function (){
		
		xmlhttp.open("GET", "modulos/"+Configuration.Directory+"/banco_form.php");
	    xmlhttp.onreadystatechange = function() {
	    	
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    		
	    		kernel.dge('features').innerHTML = xmlhttp.responseText;
	    		kernel.dge('message_bank').innerHTML = "";
	    		kernel.dge('btnoption').value = "salvar banco";
				kernel.dge('btnoption').onclick = function (){ Configuration.SaveBank(); }
				
			}
	    	
	    }
	    
	    xmlhttp.send(null);
	},
	
	CheckBank : function (){
		
		if ( !kernel.dge('namebank').value ){
			kernel.dge('message_bank').innerHTML = "<b style=\"color:red;\">Preencha o nome do banco</b>";
			return false;
		}
		
		kernel.dge('message_bank').innerHTML = "";
		return true;
		
	},
	
	AuthSave : function (){
		
		var vendanormal 	= (kernel.dge('vendanormal_sim').checked)?1:0;
		var vendavip		= (kernel.dge('vendavip_sim').checked)?1:0;
		var reducaoestoque 	= (kernel.dge('reducaoestoque_sim').checked)?1:0;
		var estornoprodutos	= (kernel.dge('estornoprodutos_sim').checked)?1:0;
		var etiquetas		= (kernel.dge('etiquetas_sim').checked)?1:0;
		var mailling		= (kernel.dge('mailling_sim').checked)?1:0;
		var administradores	= (kernel.dge('administradores_sim').checked)?1:0;
		var configuracoes	= (kernel.dge('configuracoes_sim').checked)?1:0;
		
		var params =  '?opc1='+vendanormal;
			params += '&opc2='+vendavip;
			params += '&opc3='+reducaoestoque;
			params += '&opc4='+estornoprodutos;
			params += '&opc5='+etiquetas;
			params += '&opc6='+mailling;
			params += '&opc7='+administradores;
			params += '&opc8='+configuracoes;
		
		xmlhttp.open("GET", "modulos/"+Configuration.Directory+"/autenticacao_salva.php"+params);
	    xmlhttp.onreadystatechange = function() {
	    	
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    		
	    		kernel.dge('message').innerHTML = '<b style="color:green">Autenticações alteradas com sucesso</b>';
				
			}
	    	
	    }
	    
	    xmlhttp.send(null);
	    
	},
	
	CompanySave : function (){
		
		var cnpj = kernel.dge('cnpj');
		var ie = kernel.dge('ie');
		var endereco = kernel.dge('endereco');
		var bairro = kernel.dge('bairro');
		var cidade = kernel.dge('cidade');
		var estado = kernel.dge('estado');
		var cep1 = kernel.dge('cep1');
		var cep2 = kernel.dge('cep2');
		var tel1 = kernel.dge('tel1');
		var tel2 = kernel.dge('tel2');
		var tel3 = kernel.dge('tel3');
		var fax1 = kernel.dge('fax1');
		var fax2 = kernel.dge('fax2');
		var fax3 = kernel.dge('fax3');
		var email = kernel.dge('email');
		var site = kernel.dge('site');
		var filiais = kernel.dge('qtdfiliais');
		var qtdturnos = kernel.dge('qtdturnos');
		var qtdterminais = kernel.dge('qtdterminais');

		params = 'cnpj='+cnpj.value+'&ie='+ie.value+'&endereco='+endereco.value+'&bairro='+bairro.value+'&cidade='+cidade.value+'&estado='+estado.value+'&cep='+cep1.value+'-'+cep2.value+'&tel='+tel1.value+'-'+tel2.value+'-'+tel3.value+'&fax='+fax1.value+'-'+fax2.value+'-'+fax3.value+'&email='+email.value+'&site='+site.value+'&qtdturnos='+qtdturnos.value+'&qtdterminais='+qtdterminais.value+'&filiais='+filiais.value;

		xmlhttp.open("POST", 'modulos/'+Configuration.Directory+'/empresa_salvar.php', true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.setRequestHeader("Content-length", params.length);
		xmlhttp.setRequestHeader("Connection", "close");
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    		kernel.dge('response').innerHTML = '<b style="color:green">'+xmlhttp.responseText+'</b>';
			}
	    }
	    xmlhttp.send(params);
		
	},
	
	ModifyAlert : function (){
		
		var receber 	= (kernel.dge('receber_s').checked)?1:0;
		var receber_dias= (kernel.dge('receber_dias').value)?kernel.dge('receber_dias').value:0;
		var pagar 		= (kernel.dge('pagar_s').checked)?1:0;
		var pagar_dias	= (kernel.dge('pagar_dias').value)?kernel.dge('pagar_dias').value:0;
		var estoque 	= (kernel.dge('estoque_s').checked)?1:0;
		var pedidos 	= (kernel.dge('pedidos_s').checked)?1:0;
		var cobrancas 	= (kernel.dge('cobrancas_s').checked)?1:0;
		var compras 	= (kernel.dge('compras_s').checked)?1:0;
		
		
		var params = "?receber="+receber+"&receber_dias="+receber_dias+"&pagar="+pagar+"&pagar_dias="+pagar_dias+"&estoque="+estoque+"&pedidos="+pedidos+"&cobrancas="+cobrancas+"&compras="+compras;
		
		xmlhttp.open("GET", "modulos/"+Configuration.Directory+"/alerta_salva.php"+params);
	    xmlhttp.onreadystatechange = function() {
	    	
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    		
	    		kernel.dge('message').innerHTML = '<b style="color:green">Alertas / Avisos alterados com sucesso</b>';
				
			}
	    	
	    }
	    
	    xmlhttp.send(null);
		
	},
	
	ModifyFinance : function (){
		
		var r_avista_baixar = (kernel.dge('r_avista_baixar').checked)?1:0;
		var r_avista_lancar = (kernel.dge('r_avista_lancar').checked)?1:0;
		var r_manual_lancar = (kernel.dge('r_manual_lancar').checked)?1:0;
		var p_manual_lancar = (kernel.dge('p_manual_lancar').checked)?1:0;
		var t_atraso 		= (kernel.dge('t_atraso').value)?kernel.dge('t_atraso').value:1;
		var b_credito 		= (kernel.dge('b_credito').value)?kernel.dge('b_credito').value:1;
		var min_cartao 		= (kernel.dge('min_cartao').value)?kernel.dge('min_cartao').value:0;
		var min_debito 		= (kernel.dge('min_debito').value)?kernel.dge('min_debito').value:0;
		var min_cheque 		= (kernel.dge('min_cheque').value)?kernel.dge('min_cheque').value:0;
		
		var params = "?r_avista_baixar="+r_avista_baixar+"&r_avista_lancar="+r_avista_lancar+"&r_manual_lancar="+r_manual_lancar+"&p_manual_lancar="+p_manual_lancar+"&t_atraso="+t_atraso+"&b_credito="+b_credito+"&min_cartao="+min_cartao+"&min_debito="+min_debito+"&min_cheque="+min_cheque;
		
		xmlhttp.open("GET", "modulos/"+Configuration.Directory+"/financeiro_salva.php"+params);
	    xmlhttp.onreadystatechange = function() {
	    	
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    		
	    		kernel.dge('message').innerHTML = '<b style="color:green">Financeiro / Clientes alterados com sucesso</b>';
				
			}
	    	
	    }
	    
	    xmlhttp.send(null);
		
	}
	
}



//////
// Cartões
/////




function desativar_form_tx(desativar)
{
	var color = "#000000";
	var input_disabled = false;

	if (desativar === true)
	{
		color = "#ccc";
		input_disabled = true;
	}

	tbl = document.getElementById('tbl_tx');

	for (i=0; i < tbl.rows.length; i++)
	{
		for (j=0; j < tbl.rows[i].cells.length; j++)
		{
			tbl.rows[i].cells[j].style.color = color;
			tbl.rows[i].cells[j].childNodes[0].disabled = input_disabled;
			if (input_disabled) tbl.rows[i].cells[j].childNodes[0].value = '';
			if (input_disabled) tbl.rows[i].cells[j].childNodes[0].checked = false;
		}
	}
}

var load_form_tx_status = false;
function load_form_tx(cartao_id)
{
	flash('');

	document.getElementById('id_vista_debito').value = '';
	document.getElementById('id_vista_parcela').value = '';
	document.getElementById('id_parcelada').value = '';

	if (cartao_id <= 0)
	{
		document.getElementById('habilitar_cartao').disabled = true;
		document.getElementById('habilitar_cartao').checked = false;
		desativar_form_tx(true);
		return;
	}
	//if (!load_form_tx_status)
	{
		params	= "cartao_id="+cartao_id+"&";

		xmlhttp.open("GET", path+'modulos/configuracao/cartoes_load_tx.php?' + params, true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.setRequestHeader("Content-length", params.length);
		xmlhttp.overrideMimeType('text/xml');
		xmlhttp.onreadystatechange = function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
				load_form_tx_status = true;
				response = xmlhttp.responseXML;
				alert(response.getElementsByTagName("tx_vista")[0].getAttribute("habilitado"))
				cartao_habilitado = response.getElementsByTagName("cartao_habilitado")[0].childNodes[0].nodeValue;

				document.getElementById('habilitar_cartao').disabled = false;
				document.getElementById('habilitar_cartao').checked = false;
				desativar_form_tx(true);

				if (cartao_habilitado > 0){
				
					// vista parcelado
					if (response.getElementsByTagName("tx_vista").item(0).firstChild != null){
						alert(response.getElementsByTagName("tx_vista").item(0).firstChild.data);
						tx_debito = response.getElementsByTagName("tx_vista").item(0).firstChild.data;
						tx_debito_habilitado = response.getElementsByTagName("tx_vista")[0].getAttribute("habilitado");
						id_debito_habilitado = response.getElementsByTagName("tx_vista")[0].getAttribute("id");

						document.getElementById('id_vista_parcela').value = id_debito_habilitado;
						document.getElementById('tx_vista_parcela').value = tx_debito;
						document.getElementById('habiliar_vista_parcela').checked = tx_debito_habilitado > 0 ? true : false;
					}

					// vista debito
					if (response.getElementsByTagName("tx_debito").item(0).firstChild != null){
						tx_debito = response.getElementsByTagName("tx_debito").item(0).firstChild.data;
						tx_debito_habilitado = response.getElementsByTagName("tx_debito")[0].getAttribute("habilitado");
						id_debito_habilitado = response.getElementsByTagName("tx_debito")[0].getAttribute("id");

						document.getElementById('id_vista_debito').value = id_debito_habilitado;
						document.getElementById('tx_vista_debito').value = tx_debito;
						document.getElementById('habiliar_vista_debito').checked = tx_debito_habilitado > 0 ? true : false;
					}

					// parcelado
					if (response.getElementsByTagName("tx_parcelada").item(0).firstChild != null)
					{
						tx_debito = response.getElementsByTagName("tx_parcelada").item(0).firstChild.data;
						tx_debito_habilitado = response.getElementsByTagName("tx_parcelada")[0].getAttribute("habilitado");
						id_debito_habilitado = response.getElementsByTagName("tx_parcelada")[0].getAttribute("id");

						document.getElementById('id_parcelada').value = id_debito_habilitado;
						document.getElementById('tx_parcelada').value = tx_debito;
						document.getElementById('habiliar_parcelada').checked = tx_debito_habilitado > 0 ? true : false;
					}

					document.getElementById('habilitar_cartao').checked = true;
					desativar_form_tx(false);

				}
			}
		}
		xmlhttp.send(null);
	}
}

var save_form_tx_status = false;
function save_form_tx()
{
	cartao_id = document.getElementById('cartao_id');

	if (cartao_id.value == "") return flash('Selecione o cartão.', 'validator', cartao_id);

	habilitar_cartao = document.getElementById('habilitar_cartao');

	id_vista_debito = document.getElementById('id_vista_debito');
	id_vista_parcela = document.getElementById('id_vista_parcela');
	id_parcelada = document.getElementById('id_parcelada');

	tx_vista_debito = document.getElementById('tx_vista_debito');
	habiliar_vista_debito = document.getElementById('habiliar_vista_debito');

	tx_vista_parcela = document.getElementById('tx_vista_parcela');
	habiliar_vista_parcela = document.getElementById('habiliar_vista_parcela');

	tx_parcelada = document.getElementById('tx_parcelada');
	habiliar_parcelada = document.getElementById('habiliar_parcelada');


	if ( !save_form_tx_status )
	{
		save_form_tx_status = true;
		params = 'cartao_id='+cartao_id.value+'&habilitar_cartao='+habilitar_cartao.checked+'&id_vista_debito='+id_vista_debito.value+'&id_vista_parcela='+id_vista_parcela.value+'&id_parcelada='+id_parcelada.value+'&tx_vista_debito='+tx_vista_debito.value+'&habiliar_vista_debito='+habiliar_vista_debito.checked+'&tx_vista_parcela='+tx_vista_parcela.value+'&habiliar_vista_parcela='+habiliar_vista_parcela.checked+'&tx_parcelada='+tx_parcelada.value+'&habiliar_parcelada='+habiliar_parcelada.checked+'&';

		xmlhttp.open("POST", path+'modulos/configuracao/cartoes_salvar_tx.php', true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.setRequestHeader("Content-length", params.length);
		xmlhttp.setRequestHeader("Connection", "close");
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById('form_cartoes').innerHTML = xmlhttp.responseText;
				save_form_tx_status = false;
			}
	    }
	    xmlhttp.send(params);
	}

}