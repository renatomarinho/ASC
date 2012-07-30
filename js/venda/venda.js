/*
<meta name="nome_fake" content="Vendas">
<meta name="nome_rvs" content="vendas.js">
<meta name="localizacao" content="/js/vendas">
<meta name="descricao" content="Correcoes.">
</head>
*/

var Sell = {

	Directory 		: 'venda',	
		
	WithAuth : function (value){
	
		kernel.dge('confirmasenha').style.display = ((value>0)?'block':'none');
		kernel.dge('msgautentica').innerHTML='';
		kernel.dge('pwdusuario').type='text';
		kernel.dge('pwdusuario').value='digite sua senha';
		kernel.dge('pwdusuario').focus();
				
	},
	
	WithoutAuth : function (){
		
		kernel.dge('confirmasenha').innerHTML = '';
		kernel.dge('idusuario').disabled = true;
		kernel.dge('produtosselecionarcliente').style.display = 'block';
	
	},
		
	WithAuthConfirm : function (){

		var idusuario = kernel.dge('idusuario');
		var pwdusuario = kernel.dge('pwdusuario');
		var msg = kernel.dge('msgautentica');
		msg.innerHTML = '';

		if ( !idusuario.value ){
			msg.innerHTML = '<b style="color:red">Escolha o vendedor</b>';
		} else if ( !pwdusuario.value || pwdusuario.value == 'digite sua senha' ) {
			msg.innerHTML = '<b style="color:red">Preencha a senha</b>';
		} else {
			var resposta;
			xmlhttp.open("GET", 'modulos/'+Sell.Directory+'/venda_autentica_vendedor.php?i='+idusuario.value+'&p='+pwdusuario.value);
		    xmlhttp.onreadystatechange = function() {
		    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					resposta = xmlhttp.responseText;
					if ( resposta == 'ok' ){
						kernel.dge('confirmasenha').innerHTML = '';
						idusuario.disabled = true;
						kernel.dge('produtosselecionarcliente').style.display = 'block';
					} else if ( resposta == 'no' ){
						msg.innerHTML = '<b style="color:red">Senha incorreta</b>';
					} else {
						msg.innerHTML = '<b style="color:red">Ocorreu um erro</b>';
					}
				}
		    }
		    xmlhttp.send(null);
		}
	},
	
	CheckProductOptional : function (){
		
		if ( valor_total_final == 0 ){
			kernel.dge('div_btnopcional_final').style.display = 'none';
			kernel.dge('btnfechar').style.display = 'none';
		}
		
	},
	
	ConfirmPayment : function (){

		var valortroco = '-';
		
		var dinheiro = kernel.dge('valor_dinheiro').value;
		var debito = kernel.dge('valor_debito').value;
		var cheque=0, credito=0, input, totalparcela=0, marcados=0;
		var x = kernel.dge('exibe_quantidecheques');
		var y = kernel.dge('exibe_quantidecreditos');

	    if (!kernel.dge('dinheiro').checked)dinheiro=0; else marcados++;

		if (!kernel.dge('cheque').checked)
			cheque=0;
		else {
			input_x = x.getElementsByTagName('input');
		    for (i=0;i<input_x.length;i++){
		          campo = (input_x[i].id).split('_');
		          if ( campo[0] == 'chequevalor' )
		                cheque += parseFloat(kernel.dge(input_x[i].id).value);
		    }
		}
		if (!kernel.dge('debito').checked) debito=0; else  marcados++;

		if (!kernel.dge('credito').checked) {
			credito=0;
		} else {
			if (kernel.dge('credito_cartao_qtd')){
				total = kernel.dge('credito_cartao_qtd').value;
				input_y = y.getElementsByTagName('input');
				for (i=0;i<total;i++){
			          if ( input_y[i].id == 'creditovalor_'+i ){
			    			var totalpc = 0, parcelas = 0;
						    campo = (input_y[i].id).split('_');
							if ( 'creditoparcela_'+campo[1] == 'creditoparcela_'+i ){
						        marcados += parseInt(kernel.dge('creditoparcela_'+i).value);
						        credito = parseFloat(credito) + parseFloat(parseFloat(kernel.dge(input_y[i].id).value)*parseFloat(kernel.dge('creditoparcela_'+i).value));
						    	totalpc++;
							}
			          }
			    }
			}
		}
		carrega_finalvenda_escolhapagamento();
		totalpago = (parseFloat(dinheiro)+parseFloat(cheque)+parseFloat(debito)+parseFloat(credito));
		
		if (!parseFloat(totalpago))
			totalpago = 0;
		
		var msg = kernel.dge('valordotroco');
		var valortroco = Math.round(parseFloat(totalcompra)-parseFloat(totalpago));
		if ( valortroco > 0 || valortroco < 0 ){
			if ( totalcompra > totalpago ){
				msg.innerHTML = '<b style="color:red;font-size:18px;">FALTA R$ '+formatadinheiro(-1*(parseFloat(totalcompra)-parseFloat(totalpago)))+'</b><br /><br />';
			} else if ( totalcompra < totalpago ){
				msg.innerHTML = '<b style="color:green;font-size:18px;">TROCO R$ '+formatadinheiro(-1*(parseFloat(totalcompra)-parseFloat(totalpago)))+'</b><br /><br />';
				kernel.dge('btnconfirmapagamento').style.display = 'none';
				kernel.dge('btnvoltarvenda').style.display = 'none';
				kernel.dge('btnfinalizarvenda').style.display = 'block';
				vendapagamento_desabilita();
			}
		} else {
			msg.innerHTML = '<b style="color:blue;font-size:18px;">VALOR DA VENDA SEM TROCO</b>';
			kernel.dge('btnconfirmapagamento').style.display = 'none';
			kernel.dge('btnvoltarvenda').style.display = 'none';
			kernel.dge('btnfinalizarvenda').style.display = 'block';
			vendapagamento_desabilita();
		}

	},
	
	SelectCustomerCheque : function (){
		
		var valorcompra = kernel.dge('valortotalvenda').value;
		var dinheiro = kernel.dge('valor_dinheiro').value;
		var cheque_checkbox = kernel.dge('cheque');

		var pc=kernel.dge('pag_cheque');

		if ( cheque_checkbox.checked ) {
			
			confirm = comfirmaClienteSelecionado('');
		    
			if (confirm) {
				var pc=kernel.dge('pag_cheque');
				pc.style.display = 'block';
				exibe_btnconcretizar();
				kernel.dge('pagamentocomplemento').innerHTML = '<b style="color:blue;font-size:18px;"><b>SELECIONE A QUANTIDADE DE<br />CHEQUES PARA O PAGAMENTO</b></b>';
		    
				Sell.SelectBank();
			
			} else {
				pc.style.display = 'none';
				carrega_esvaziacheque();
				
				Sell.PriceUpdate();
				
				cheque_checkbox.checked = false;
				kernel.dge('pagamentocomplemento').innerHTML =  '<b style="color:red;font-size:18px;"><b>SELECIONE UM CLIENTE PARA PAGAMENTO<br />COM CHEQUE</b></b>';
			}
		    
		} else {
			
			exibe_btnconcretizar();
			pc.style.display = 'none';
			carrega_esvaziacheque();
			
			Sell.PriceUpdate();
			
		}

	},
	
	SelectChequeQtd_Msg : function (quantidade_cheques){

		kernel.dge('pagamentocomplemento').innerHTML = '<b style="color:blue;font-size:14px;">PREENCHA O NÚMERO DO'+((quantidade_cheques>1)?'S':'')+' CHEQUE'+((quantidade_cheques>1)?'S':'')+'<BR>VERIFIQUE A'+((quantidade_cheques>1)?'S':'')+' DATA'+((quantidade_cheques>1)?'S':'')+', O BANCO E O'+((quantidade_cheques>1)?'S':'')+' VALOR'+((quantidade_cheques>1)?'ES':'')+'</b>';

	},
	
	SelectBank : function (){
		
		kernel.dge('banco_nome').value= kernel.dge('select_banco').value;
		carrega_dadoschequemudabanco(kernel.dge('select_banco').value);
		
		vendas_vendanormal_valortotal()
		exibe_btnconcretizar();

		kernel.dge('cheque_qtd').value=kernel.dge('select_cheque').value;
		carrega_exibicao_cheque(kernel.dge('select_cheque').value);
		
		Sell.SelectChequeQtd_Msg(kernel.dge('select_cheque').value);

		Sell.PriceUpdate();
		
	},
	
	PriceUpdate : function (){	
		
		var dinheiro_input = kernel.dge('valor_dinheiro').value;
		var debito_input = kernel.dge('valor_debito').value;
		var cheque_input='', credito_input='', input, totalparcela=0, marcados=0;

		var x = kernel.dge('exibe_quantidecheques');
		var y = kernel.dge('exibe_quantidecreditos');

	    if (!kernel.dge('dinheiro').checked)
			dinheiro_input=0;
		else
			marcados++;

		if (!kernel.dge('cheque').checked){
			cheque_input=0;
		} else {
			input_x = x.getElementsByTagName('input');
		    for (i=0;i<input_x.length;i++){
		          campo = (input_x[i].id).split('_');
		          if ( campo[0] == 'chequevalor' ){
		                cheque_input += parseFloat(kernel.dge(input_x[i].id).value);
		          }
		    }
			marcados += parseInt(kernel.dge('cheque_qtd').value);
		}
		if (!kernel.dge('debito').checked)
			debito_input=0;
		else
			marcados++;
		if (!kernel.dge('credito').checked) {
			credito_input=0;
		} else {
			if (kernel.dge('credito_cartao_qtd')){
				input_y = y.getElementsByTagName('input');
				for (i=0;i<input_y.length;i++){
			          campo = (input_y[i].id).split('_');
			          if ( campo[0] == 'creditovalor' ){
			                credito_input = parseFloat(credito_input)+parseFloat(kernel.dge(input_y[i].id).value);
			          }
			    }

				input_y = y.getElementsByTagName('select');
				var totalpc = 0;
				for (t=0;t<input_y.length;t++){
			          var inputs = input_y[t];
			          var id = inputs.getAttribute('id');
			          if ( id == 'creditoparcela' || id == 'creditoparcela_'+totalpc ){
			          		marcados += parseInt(kernel.dge(id).value);
			          		totalpc++;
			          }
			    }
			}
		}

		totalpago = (parseFloat(dinheiro_input)+parseFloat(cheque_input)+parseFloat(debito_input)+parseFloat(credito_input));
		totalparcela = totalcompra/marcados;

		dinheiro = totalparcela;
		cheque = totalparcela;
		debito = totalparcela;
		credito = totalparcela;

		kernel.dge('valor_dinheiro').value = formatadinheiro((!kernel.dge('dinheiro').checked)?dinheiro_input:dinheiro);
		kernel.dge('valor_debito').value = formatadinheiro((!kernel.dge('debito').checked)?debito_input:debito);

		input_x = x.getElementsByTagName('input');
		var totalpc = 0;
		for (t=0;t<input_x.length;t++){
	          var inputs = input_x[t];
	          var id = inputs.getAttribute('id');
	          if ( id == 'chequevalor' || id == 'chequevalor_'+totalpc){
	        	  	kernel.dge(id).value = formatadinheiro((!kernel.dge('cheque').checked)?cheque_input:cheque);
	                totalpc++;
	          }
	    }

		input_y = y.getElementsByTagName('input');
		 var totalpc = 0;
		for (t=0;t<input_y.length;t++){
	          var inputs = input_y[t];
	          var id = inputs.getAttribute('id');
	          if ( id == 'creditovalor' || id == 'creditovalor_'+totalpc ){
	        	  kernel.dge(id).value = formatadinheiro((!kernel.dge('credito').checked)?credito_input:credito);
	                totalpc++;
	          }
	    }
		
	}
	
	
}




var valor_total_venda = '0.00';
var valor_total_venda_tmp = '0.00';
var valor_total_final = '0.00';
var valor_total_final_tmp = '0.00';
var valor_desconto_acrescimo = '0.00';
var valor_desconto_acrescimo_tmp = '0.00';

// dados para o final da venda
var valor_da_final_final = 0.00;
var da_tipo = '';
var da_forma = '';

var valordavenda_menosopcoes;

var totalitens;
var opc;

function carrega_carrinho_header()
{

	valor_total_venda = '0.00';
	valor_total_venda_tmp = '0.00';
	valor_total_final = '0.00';
	valor_total_final_tmp = '0.00';
	valor_desconto_acrescimo = '0.00';
	valor_desconto_acrescimo_tmp = '0.00';

	var elm_conteudo_header = document.getElementById('carrinho_header');
	
	var carrinho_header_tmp = SingleXmlHttp(true);
	
	carrinho_header_tmp.open("GET", path+'modulos/venda/carrinho_header.php');
    carrinho_header_tmp.onreadystatechange = function()
    {
    	if (carrinho_header_tmp.readyState == 4 && carrinho_header_tmp.status == 200) 
    	{
			elm_conteudo_header.innerHTML = carrinho_header_tmp.responseText;
		}
    }
    carrinho_header_tmp.send(null);
    

}


/**
 * Adiciona item ao carrinho
 * @see pagina php que pocessa o carrinho
 */
function produto_adicionarcarrinho(idproduto)
{
	document.getElementById('codbarra').value = '';
	document.getElementById('nomeprod').value = '';

	valor_total_final = (valor_total_final=='0.00')?0:valor_total_final;

	var parametros = ''; // quantidadetotal|valordesconto|valortotal|idproduto|idgrade.quantidade

	valor_total_final = document.getElementById('precoprodutoselecionadototal').value;
	valor_total_venda_tmp = document.getElementById('input_total_venda_tmp').value;

	valor_desconto_acrescimo_tmp = document.getElementById('input_total_desconto_acrescimo_tmp').value;
	valor_total_final_tmp		 = document.getElementById('input_total_final_tmp').value;


	if (document.getElementById("gradeproduto")) {
		var x=document.getElementById("gradeproduto");
		var option = x.getElementsByTagName("select");
	}
	var vetor = new Array();
	if (document.getElementById("gradeproduto")){
		for (loop = 0; loop < option.length; loop++) {
			vetor = (option[loop].value).split('|');
			if (vetor[2]){
				parametros += vetor[2]+'*'+vetor[0]+'*'+vetor[1]+'¤';
			}
		}
	}
	parametros = parametros.substring(0, (parametros.length-1));
	parametros = '?params='+totalitens+'|'+opc+'|'+valor_total_final+'|'+idproduto+'|'+parametros;

	// novo valor total da venda
	valor_total_final += parseFloat(valor_total_final);

	// acumulando desncoto acrescimo
	valor_desconto_acrescimo = 3;

	carrega_carrinholista(parametros);
}

/**
 * Atualizando total dos valor da venda
 */
function carrega_carrinhoatualizatotal()
{

	venda_zerarselects();

	if ( valor_total_final != '0.00' ){
		document.getElementById('btncancelar').style.display = 'block';
		document.getElementById('btnfechar').style.display = 'block';
		document.getElementById('btns_header').style.display = 'block';
		document.getElementById('btnircarrinho').style.display = 'block';
		document.getElementById('dadosgerais_venda').style.display = 'block';
		document.getElementById('div_btnopcional_final').style.display = 'block';
	} else {
		document.getElementById('btncancelar').style.display = 'none';
		document.getElementById('btnfechar').style.display = 'none';
		document.getElementById('btns_header').style.display = 'none';
		document.getElementById('btnircarrinho').style.display = 'none';
		document.getElementById('dadosgerais_venda').style.display = 'none';
		document.getElementById('div_btnopcional_final').style.display = 'none';
		valor_total_final = 0;
	}

	//valor total da venda
	document.getElementById('input_total_venda').value = valor_total_venda_tmp;
	document.getElementById('valor_total_venda').innerHTML = formatadinheiro(valor_total_venda_tmp);

	// desc / acresc.
	if (valor_desconto_acrescimo_tmp < 0)
	{
		document.getElementById('valor_desconto_acrescimo').style.color = "red";
		document.getElementById('rs_da').style.color = "red";
	}
	else
	{
		document.getElementById('valor_desconto_acrescimo').style.color = "black";
		document.getElementById('rs_da').style.color = "black";
	}

	document.getElementById('input_total_desconto_acrescimo').value = valor_desconto_acrescimo_tmp;
	document.getElementById('valor_desconto_acrescimo').innerHTML = formatadinheiro(valor_desconto_acrescimo_tmp);

	// valor final da venda
	document.getElementById('input_total_final').value = valor_total_final_tmp;
	document.getElementById('valor_total_final').innerHTML = formatadinheiro(valor_total_final_tmp);

        if (document.getElementById('input_total_desconto_acrescimo').value != 0)
          document.getElementById('div_btnopcional_final').style.display = 'none';
      else
          document.getElementById('div_btnopcional_final').style.display = 'block';

	valor_total_final = valor_total_final_tmp;
	
	Sell.CheckProductOptional();
	
}

/**
 * Retorna o valor já calculado de um acrescimo ou desconto
 * @param valor // valor original da operação
 * @param tipo // a = acescimo; d = desconto
 * @param forma // p = precentagem; v = valor fixo
 * @param valor_da // valor de desconto ou acrescimo
 *
 */
function calcula_desconto_acrescimo(valor, tipo, forma, valor_da)
{
	if ( forma == 'p' )
	{
		valor = (tipo=='d') ? -1 * ( ( (valor/100) * valor_da ) - valor ) : 1 * ( ( (valor/100) * valor_da ) + parseFloat(valor) );
	}
	else if ( forma == 'v' )
	{
		valor = (tipo=='d') ? valor - valor_da : parseFloat(valor) + parseFloat(valor_da);
	}

	valor = (isNaN(valor))?'':valor;

	return valor;
}


var carrega_carrinholista_status = false;
function carrega_carrinholista(params)
{
	var conteudo_lista = document.getElementById('carrinho_counteudo');
	var element = conteudo_lista;
	if ( !carrega_carrinholista_status ){
		carrega_carrinholista_status = true;
		xmlhttp.open("GET", path+'modulos/venda/carrinho_lista.php'+params);
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				element.innerHTML = xmlhttp.responseText;
				carrega_carrinhoatualizatotal();
				carrega_carrinholista_status = false;
				document.getElementById('btnircarrinho').style.display = 'none';
			}
	    }
	    xmlhttp.send(null);
	}
}


function atualiza_quantidadeprodutos()
{
	var valorproduto = 0;
	var totalquantidade = 0;
	var totalvalor = 0;
	var totalvalor_fixo = 0;
	var vetor = new Array();

	opc = 0;
	totalitens = 0;
	opc_tmp = 0;

	if (document.getElementById("gradeproduto"))
	{
		var x=document.getElementById("gradeproduto");
		var option = x.getElementsByTagName("select");
	}

	if (document.getElementById("gradeproduto")){
		for (loop = 0; loop < option.length; loop++) {
			vetor = (option[loop].value).split('|');
			if (vetor[2]){
				totalvalor += (parseFloat(vetor[0].replace(',',''))*parseFloat(vetor[1].replace(',','')));
				totalvalor_fixo += (parseFloat(vetor[0])*parseFloat(vetor[1]));
				totalitens += parseInt(vetor[0]);
			}
		}
	} else {
		vetor = (document.getElementById('qtdprodutounico').value).split('|');
		totalvalor = (parseFloat(vetor[0])*parseFloat(vetor[1]));
		totalvalor_fixo = (parseFloat(vetor[0])*parseFloat(vetor[1]));
		totalitens = parseInt(vetor[0]);
	}

	// valor sem opcionais

	vtv = parseFloat(valor_total_venda_tmp) + parseFloat(totalvalor);
	document.getElementById('input_total_venda_tmp').value = vtv;


	// calculando opcionais
	if ( document.getElementById('vlnumero') && document.getElementById('vlnumero').value )
	{
		var numero = (document.getElementById('vlnumero').value).replace(',','.');
		if ( numero && !checanumero(((((numero).toString()).replace(',','')).replace('.','')),0) ){
			numero = 0;
			document.getElementById('msgerroopc').innerHTML = '<b style=color:red>Preencha com somente números</b>';
		}else {
			document.getElementById('msgerroopc').innerHTML = '';
		}
		var opcao = document.getElementById('opcional_forma').value;
		if ( document.getElementById('opcional_forma_valor').value == 'porcentagem' ){
			totalvalor = (opcao=='desconto')?-1*(((totalvalor/100)*numero)-totalvalor):1*(((totalvalor/100)*numero)+totalvalor);
		} else if ( document.getElementById('opcional_forma_valor').value == 'fixo' ) {
			totalvalor = (opcao=='desconto')?totalvalor-numero:parseFloat(totalvalor)+parseFloat(numero);
		}
		opc = formatadinheiro(-1*(totalvalor_fixo-totalvalor));
		opc_tmp = (-1*(totalvalor_fixo-totalvalor));
	}

	// valor do opcional
	document.getElementById('input_total_desconto_acrescimo_tmp').value = parseFloat(valor_desconto_acrescimo_tmp) + parseFloat(opc_tmp);

	if ( totalvalor > 0 )
	{
		document.getElementById('acaoprodutoselecionado').style.display = 'block';
		if (document.getElementById("gradeproduto")){
			document.getElementById('totalitens').innerHTML = '<b style="color:black;">'+totalitens+' ite'+((totalitens>1)?'ns':'m')+' selecionado'+((totalitens>1)?'s':'')+'</b>';
		}
	}
	else
	{
		document.getElementById('acaoprodutoselecionado').style.display = 'none';
		if (document.getElementById("gradeproduto"))
		{
			document.getElementById('totalitens').innerHTML = '';
		}
	}

	totalvalor = (isNaN(totalvalor))?'0.00':totalvalor;
	// valor total com opcionais
	document.getElementById('input_total_final_tmp').value = parseFloat(valor_total_final_tmp) + parseFloat(totalvalor);

	document.getElementById('precoprodutoselecionadototal').value = formatadinheiro(totalvalor);
}

function atualiza_desconto_final() {

	var valorproduto = 0;
	var totalquantidade = 0;
	var totalvalor = 0;
	var totalvalor_fixo = parseFloat(kernel.dge('input_total_venda').value);
	opc = 0;
	totalitens = 0;
	opc_tmp = 0;
	var vetor = new Array();

	vtv = parseFloat(valor_total_venda_tmp) + parseFloat(totalvalor);
	kernel.dge('input_total_venda_tmp').value = vtv;

	if (kernel.dge('vlnumero') && kernel.dge('vlnumero').value ) {
             
		totalvalor = parseFloat(kernel.dge('input_total_venda').value);

              var numero = (kernel.dge('vlnumero').value).replace(',','.');

              if ( numero && !checanumero(((((numero).toString()).replace(',','')).replace('.','')),0) ) {
                      numero = 0;
                      kernel.dge('msgerroopc').innerHTML = '<b style=color:red>Preencha com somente números</b>';
              } else {
            	  	kernel.dge('msgerroopc').innerHTML = '';
              }

              var opcao = kernel.dge('opcional_forma').value;
              var forma = kernel.dge('opcional_forma_valor').value;

              document.getElementById('btnfechar').style.display = 'block'
              
              if ( opcao == 'desconto' ){
            	  if ( forma == 'porcentagem' )  {
            		  if (kernel.dge('vlnumero').value > 100) {
            			  kernel.dge('btnfechar').style.display = 'none'
            		  }
            		  totalvalor = -1 * ( ( (totalvalor/100) * numero)-totalvalor);
            	  } else if ( forma == 'fixo' ) {
            		  if (kernel.dge('vlnumero').value > totalvalor) {
            			  kernel.dge('btnfechar').style.display = 'none'
            		  }
            		  totalvalor = totalvalor-numero;
            	  }
			  } else if (opcao == 'acrescimo' ) {
				  if ( forma == 'porcentagem' )  {
					  totalvalor = 1 * (((totalvalor/100) * numero ) + totalvalor);
				  } else if ( forma == 'fixo' ) {
					  totalvalor =parseFloat(totalvalor) + parseFloat(numero);
				  }
			  }
              
              opc_tmp = ( -1 * ( totalvalor_fixo - totalvalor ) );

              // valor do opcional
              kernel.dge('input_total_desconto_acrescimo_tmp').value = parseFloat(valor_desconto_acrescimo_tmp) + parseFloat(opc_tmp);
              kernel.dge('valor_desconto_acrescimo').innerHTML = formatadinheiro(parseFloat(valor_desconto_acrescimo_tmp) + parseFloat(opc_tmp));

              totalvalor = (isNaN(totalvalor))?'0.00':totalvalor;

              // valor total com opcionais
              kernel.dge('input_total_final_tmp').value =  formatadinheiro( parseFloat(totalvalor_fixo) + (parseFloat(valor_desconto_acrescimo_tmp) + parseFloat(opc_tmp)) ) ;
              kernel.dge('precoprodutoselecionadototal_final').value = formatadinheiro( parseFloat(totalvalor_fixo) + (parseFloat(valor_desconto_acrescimo_tmp) + parseFloat(opc_tmp)) );
              kernel.dge('valor_total_final').innerHTML = formatadinheiro( parseFloat(totalvalor_fixo) + (parseFloat(valor_desconto_acrescimo_tmp) + parseFloat(opc_tmp)) );
	} else {
	      // valor do opcional
		kernel.dge('input_total_desconto_acrescimo_tmp').value = parseFloat(valor_desconto_acrescimo_tmp);
		kernel.dge('valor_desconto_acrescimo').innerHTML = formatadinheiro(valor_desconto_acrescimo_tmp);
	
	      // valor total com opcionais
		kernel.dge('input_total_final_tmp').value = formatadinheiro(valor_total_final);
		kernel.dge('precoprodutoselecionadototal_final').value = formatadinheiro(valor_total_final);
		kernel.dge('valor_total_final').innerHTML = formatadinheiro(valor_total_final);
	}

}


/**
 * Momento de fechamento da venda
 */
var carregar_fecharvenda_status = false;
function carregar_fecharvenda()
{
	vendas_vendanormal_init();

	if (document.getElementById("listagemprodutos_escolhidos")){
		var x=document.getElementById("listagemprodutos_escolhidos");
		var option = x.getElementsByTagName("input");
		var vetor = new Array();

		for (loop = 0; loop < option.length; loop++) {
			document.getElementById(option[loop].id).style.display = 'none';
		}
	}

	var usuario = document.getElementById('idusuario').value;
	var cliente = document.getElementById('idclienteescolhido').value;
	var conteudo_esquerdo = document.getElementById('conteudo_esquerdo');
	var element = conteudo_esquerdo;

	// get tipo de venda // o tipo de venda é necessário para ser aplicado filtro ed fechamento
	var tipo_venda = document.getElementById('tipo_venda').value;

	// valor ja com desconto
	if (document.getElementById('precoprodutoselecionadototal_final').value > 0)
	{
		novo_valortotaldavenda = document.getElementById('precoprodutoselecionadototal_final').value;
		if (document.getElementById('vlnumero'))
		{
			numero_opc = (document.getElementById('vlnumero').value).replace(',','.');
			if (numero_opc > 0)
			{
				d = novo_valortotaldavenda - valor_total_final;
                                d_final = document.getElementById('input_total_desconto_acrescimo_tmp').value - document.getElementById('input_total_desconto_acrescimo').value ;
                                valor_desconto = "d="+d+"&d_final="+d_final;
			}
		}
	}

	// obtendo dados da vendas
        d_final = document.getElementById('input_total_desconto_acrescimo_tmp').value - document.getElementById('input_total_desconto_acrescimo').value ;
	d = "d=" + document.getElementById('input_total_desconto_acrescimo_tmp').value + "&d_final="+d_final;
	v = document.getElementById('input_total_final_tmp').value;

	// obtendo dados do desconto no final da venda

	// atualizando valores para retorno
	if (document.getElementById('vlnumero'))
	{
		valor_da_final_final = document.getElementById('vlnumero').value;
		da_tipo = document.getElementById('opcional_forma').value;
		da_forma = document.getElementById('opcional_forma_valor').value;
	}

	if ( !carregar_fecharvenda_status )
	{
		carregar_fecharvenda_status = true;
		xmlhttp.open("GET", path+'modulos/venda/fechar_venda.php?u='+usuario+'&v='+v+'&c='+cliente+'&t='+tipo_venda+'&'+d);
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
	    	{
				element.innerHTML = xmlhttp.responseText;
				cliente_selecionado = document.getElementById('inputclientevendaselecionado').value;
				if (tipo_venda == "vip" && cliente_selecionado != "0" )
				{
					document.getElementById('btnfinalizarvenda').style.display = 'block';
				}

				carregar_fecharvenda_status = false;

				document.getElementById('conteudo_direito_tmp').innerHTML = document.getElementById('conteudo_direito').innerHTML;

				carrega_extraformapagamento();
			}
	    }
	    xmlhttp.send(null);
	}
}


var carrega_extraformapagamento_status = false;
function carrega_extraformapagamento()
{
	var conteudo_direito = document.getElementById('conteudo_direito');
	var element = conteudo_direito;
	if ( !carrega_extraformapagamento_status )
	{
		carrega_extraformapagamento_status = true;
		xmlhttp.open("GET", path+'modulos/venda/forma_de_pagamento.php?');
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				element.innerHTML = xmlhttp.responseText;
				carrega_extraformapagamento_status = false;
			}
	    }
	    xmlhttp.send(null);
	}

}


/**
 * Voltando a venda
 */
var carregar_voltarparavenda_status = false;
function carregar_voltarparavenda()
{
	document.getElementById('btnvoltarvenda').style.display = 'none';
	//document.getElementById('btnfechar').style.display = 'block';
	//document.getElementById('btncancelar').style.display = 'block';

	var cliente;
	var usuario = document.getElementById('usuario').value;
	var nomecliente = (((document.getElementById('nomeclientevendaselecionado').innerHTML).replace('<b style="color: blue;">','')).replace('</b>',''));

	var tipo_venda = document.getElementById('tipo_venda').value;

	if ( document.getElementById('inputclientevendaselecionado') ){
		cliente = document.getElementById('inputclientevendaselecionado').value;
	}

	var conteudo_esquerdo = document.getElementById('conteudo_esquerdo');
	var element = conteudo_esquerdo;

	if ( !carregar_voltarparavenda_status ){
		carregar_voltarparavenda_status = true;
		xmlhttp.open("GET", path+'modulos/venda/seleciona_produto.php?u='+usuario+'&c='+cliente+'&tipo_venda='+tipo_venda);
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				element.innerHTML = xmlhttp.responseText;
				carregar_voltarparavenda_status = false;
				if ( cliente != 0 )	carregar_cliente_inicioselecionadoparavenda( cliente, nomecliente );

				carrega_carrinhovenda_voltar();
				
				if (valor_da_final_final > 0)
				{
					produto_abriropcional_final();
					
					if (document.getElementById('vlnumero'))
						document.getElementById('vlnumero').value = valor_da_final_final;
			
					if (document.getElementById('opcional_forma'))
					{
						if (da_tipo == 'desconto')
					
							document.getElementById('opcional_forma').options[0].selected = true;
						else
							document.getElementById('opcional_forma').options[1].selected = true;
					}
					
					if (document.getElementById('porcentagem'))
					{
						if (da_forma == 'porcentagem')
						{
							document.getElementById('porcentagem').innerHTML=' % ';
							document.getElementById('fixo').innerHTML='';
							document.getElementById('opcional_forma_valor').options[0].selected = true;
						}
						else
						{
							document.getElementById('porcentagem').innerHTML='';
							document.getElementById('fixo').innerHTML='R$ ';
							document.getElementById('opcional_forma_valor').options[1].selected = true;
						}
					}
				
					atualiza_desconto_final();
				}
			}
	    }
	}

	xmlhttp.send(null);

	
}


function carrega_carrinhovenda(){

	var conteudo_direito = document.getElementById('conteudo_direito');
	var element = conteudo_direito;
	//element.innerHTML = loading_dados;
	var carrinho_tmp = SingleXmlHttp(true);
	
	carrinho_tmp.open("GET", path+'modulos/venda/carrinho_produtos.php');
    	carrinho_tmp.onreadystatechange = function() {
            if (carrinho_tmp.readyState == 4 && carrinho_tmp.status == 200) 
            {
                element.innerHTML = carrinho_tmp.responseText;
                //setTimeout("carrega_carrinho_header()", 1000);
                carrega_carrinho_header()
            }
    	}
    	carrinho_tmp.send(null)
}



var carrega_efetuarvenda_status = false;
function carrega_efetuarvenda(url, tipo)
{
	var conteudo_total = document.getElementById('conteudo_total');
	conteudo_total.style.display = 'none';
	conteudo_total.innerHTML = '';
	var conteudo_esquerdo = document.getElementById('conteudo_esquerdo');
	conteudo_esquerdo.style.display = 'block';
	conteudo_esquerdo.innerHTML = '';
	var conteudo_direito = document.getElementById('conteudo_direito');
	conteudo_direito.style.display = 'block';
	conteudo_direito.innerHTML = '';

	document.getElementById('conteudo_esquerdo_tmp').innerHTML = '';
	document.getElementById('conteudo_direito_tmp').innerHTML = '';
	
	param = '?tipo_venda='+tipo;

	var element = conteudo_esquerdo;
	//element.innerHTML = loading_dados;
	if ( !carrega_efetuarvenda_status ){
		carrega_efetuarvenda_status = true;
		
		var efetuarvenda_tmp = SingleXmlHttp(true);
		
		efetuarvenda_tmp.open("GET", url + param, true);
	    efetuarvenda_tmp.onreadystatechange = function() {
	    	if (efetuarvenda_tmp.readyState == 4 && efetuarvenda_tmp.status == 200) 
	    	{
				carrega_efetuarvenda_status = false;
				element.innerHTML = efetuarvenda_tmp.responseText;
				valor_total_final = '0.00';
				carrega_carrinhovenda();
			}
	    }
	    efetuarvenda_tmp.send(null);
	}
}

var carrega_carrinho_header_voltar_status = false;
function carrega_carrinho_header_voltar()
{
	var conteudo_header = document.getElementById('carrinho_header');

	//if ( !carrega_carrinho_header_voltar_status ){
		carrega_carrinho_header_voltar_status = false;
		xmlhttp.open("GET", path+'modulos/venda/carrinho_header.php');
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				conteudo_header.innerHTML = xmlhttp.responseText;
				carrega_carrinholista('?solista=true');
				carrega_carrinho_header_voltar_status = true;
			}
	    }
	    xmlhttp.send(null);
	//}
}

var carrega_carrinhovenda_voltar_status = false;
function carrega_carrinhovenda_voltar()
{
	document.getElementById('conteudo_direito').innerHTML = document.getElementById('conteudo_direito_tmp').innerHTML;
	document.getElementById('conteudo_direito_tmp').innerHTML = '';
	return;
	var conteudo_direito = document.getElementById('conteudo_direito');
	var element = conteudo_direito;
	if ( !carrega_carrinhovenda_voltar_status ){
		carrega_carrinhovenda_voltar_status = true;
		xmlhttp.open("GET", path+'modulos/venda/carrinho_produtos.php');
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				element.innerHTML = xmlhttp.responseText;
				carrega_carrinhovenda_voltar_status = false;
	    		carrega_carrinho_header_voltar();
			}
	    }
	    xmlhttp.send(null);
	}
}


function produto_abriropcional_final()
{
	var conteudo_produtoopcional = document.getElementById('produtoopcional');
	if ( ( (conteudo_produtoopcional.innerHTML).length) == 0 ){
		var element = conteudo_produtoopcional;
		xmlhttp.open("GET", path+'modulos/venda/opcional_produto_final.php');
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
	    	{
				element.innerHTML = xmlhttp.responseText;
				atualiza_desconto_final();
				document.getElementById('div_desconto_final').style.display = 'block';
			}
	    }
	    xmlhttp.send(null);
	} else {
		document.getElementById('vlnumero').value = '';
		atualiza_desconto_final();
		conteudo_produtoopcional.innerHTML = '';
		document.getElementById('div_desconto_final').style.display = 'none';
	}
}

function pesquisarproduto_venda()
{
	var conteudo_produtotoslistavenda = document.getElementById('carrinho_counteudo');
	var element = conteudo_produtotoslistavenda;

	var codbarra = document.getElementById('codbarra').value;

	element.innerHTML = '';
	document.getElementById('titmain').innerHTML = 'Venda Carrinho';

	document.getElementById('btns_header').style.display = 'none';
	document.getElementById('btnircarrinho').style.display = 'block';
	document.getElementById('carrinho_header').style.display = 'block';
	

	document.getElementById('carrinho_counteudo').style.height = '208px';

	if ( codbarra.length == 0 )
	{
		var colprod, fornecedor, tipoprod, opc;

		document.getElementById('msgerrovendageral').innerHTML = '';

		if ( document.getElementById("produtofornec") )
		{
			produto = document.getElementById("nomeprod").value;
		}

		if ( document.getElementById("produtofornec") )
			fornecedor = document.getElementById("produtofornec").value;
		if ( document.getElementById("produtotipo") )
			tipoprod = document.getElementById("produtotipo").value;
		if ( document.getElementById("produtocolecao") )
			colprod = document.getElementById("produtocolecao").value;
		if (document.getElementById("opcvenda"))
			opc = document.getElementById("opcvenda").value;

		if ( fornecedor!=0 || tipoprod!=0 || colprod!=0 || produto!='' || produto=='')
		{
			xmlhttp.open("GET", path+'modulos/venda/buscaprodutos_refinado.php?f='+fornecedor+'&t='+tipoprod+'&c='+colprod+'&o='+opc+'&p='+produto);
		    xmlhttp.onreadystatechange = function() {
		    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
		    	{
					element.innerHTML = xmlhttp.responseText;
					//element.innerHTML = 'ttt';
					//element.style.height = '220px';
					//document.getElementById('produtosselecionadoslista').style.height = '100px';
				}
		    }
		    xmlhttp.send(null);
		} else {
			element.innerHTML = '';
			//element.style.height = '0px';
			//document.getElementById('produtosselecionadoslista').style.height = '310px';
		}
	} else {
		carrega_produtovendacodbarra();
	}
	atualiza_desconto_final();
}

var carrega_estornocontrolevendadez_status = false;
function carrega_estornocontrolevendadez(tipo_venda_estorno)
{
	t ="";
	if (tipo_venda_estorno == 'vip') t = "?tipo_venda_estorno=vip";

	var element = document.getElementById('dadosvenda');
    	xmlhttp.open("GET", path+'modulos/venda/estornar_exibirdez.php'+t);
    	//element.innerHTML = loading_dados;
    	if ( !carrega_estornocontrolevendadez_status ){
    	carrega_estornocontrolevendadez_status = true;
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    		document.getElementById('apresenta_dadosvenda').style.display = 'block';
	    		document.getElementById('titdadosvenda').innerHTML = '<b>10 últimas vendas ' + tipo_venda_estorno +' realizadas</b>';
				element.innerHTML = xmlhttp.responseText;
				carrega_estornocontrolevendadez_status = false;
			}
	    }
	    xmlhttp.send(null);
    	}

}