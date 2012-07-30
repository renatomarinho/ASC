/*
<meta name="nome_fake" content="Vendas">
<meta name="nome_rvs" content="vendas.js">
<meta name="localizacao" content="/js/vendas">
<meta name="descricao" content="Correcoes.">
</head>
*/

var Product = {

	Directory 		: 'produto',
	Authentication 	: true,
		
	AddItem : function (id, idgrade, total){

		var descricaoatual 		= kernel.dge('descricao_input_'+id).value;
		var quantidadeatual 	= kernel.dge('quantidade_input_'+id).value;
		var vlprodgradeatual 	= kernel.dge('vlprodgrade_input_'+id).value;
	
		kernel.dge('msggrade').innerHTML = '';
		
		kernel.dge('descricao_'+id).innerHTML 	= '<input type="text" id="descricao_itemmais_'+id+'" value="'+descricaoatual+'" style="width:110px;" maxlength="30">';
		kernel.dge('vlprodgrade_'+id).innerHTML = '<input type="text" id="vlprodgrade_itemmais_'+id+'" value="'+formatadinheiro(vlprodgradeatual)+'" style="width:50px;text-align:right;" onkeydown="javascript:formata_valor(\'vlprodgrade_itemmais_'+id+'\', 13, event)" onfocus="javascript:document.getElementById(\'vlprodgrade_itemmais_'+id+'\').value=\'\';" maxlength="6">';
		kernel.dge('quantidade_'+id).innerHTML 	= '<input type="text" id="quantidade_itemmais_'+id+'" value="'+quantidadeatual+'" style="width:50px;text-align:right;" onfocus="javascript:document.getElementById(\'qtdestoque\').value=parseFloat(document.getElementById(\'qtdestoque\').value)-parseFloat(document.getElementById(\'quantidade_input_'+id+'\').value);document.getElementById(\'quantidade_itemmais_'+id+'\').value=\'\';" maxlength="4">';
		kernel.dge('maisitem_'+id).value 		= 'salvar';
		kernel.dge('maisitem_'+id).onclick 		= function(){ Product.SaveGradeAddItem(id, idgrade, total);};
	
	},
	
	SaveGradeAddItem : function (id, idgrade, total, auth){

		var qtdestoque 			= kernel.dge('qtdestoque');
		var descricaonova 		= kernel.dge('descricao_itemmais_'+id);
		var quantidadenova 		= kernel.dge('quantidade_itemmais_'+id);
		var vlprodgradenova 	= kernel.dge('vlprodgrade_itemmais_'+id);
		var quantidade_input 	= kernel.dge('quantidade_input_'+id);
		var vlprodgrade_input 	= kernel.dge('vlprodgrade_input_'+id);
	
		if ( checanumero(quantidadenova.value,0) ){
	
			var total_itensretirados = quantidade_input.value-quantidadenova.value;
			if ( total_itensretirados > 0 ){
				
				kernel.dge('linha_separador_gradeedicao').style.display 	= 'block';
				kernel.dge('linha_separador_gradeedicao2').style.display 	= 'none';
				quantidadenova.style.border 								= '1px solid red';
				kernel.dge('listagrade').style.height 						= '187px';
				kernel.dge('linha_separador_gradeedicao').style.height 		= '60px';
				
				xmlhttp.open("GET", 'modulos/'+Product.Directory+'/produto_estoque_retirada.php');
			    xmlhttp.onreadystatechange = function() {
			    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						
			    		kernel.dge('linha_separador_gradeedicao').innerHTML = xmlhttp.responseText;
						
			    		kernel.dge('qtdItens').innerHTML = total_itensretirados+' ite'+((total_itensretirados>1)?'ns':'m');
			    		kernel.dge('btnRetiradaNao').onclick = function(){ Product.ReturnGradeList(id, idgrade, total); };
			    		
			    		if ( Product.Authentication ){
			    			kernel.dge('btnRetiradaSim').onclick = function(){ Product.SubtractGradeItemWithAuth(id, idgrade, total, total_itensretirados); };
			    		} else {
			    			kernel.dge('btnRetiradaSim').onclick = function(){ Product.SubtractGradeItemWithoutAuth(id, idgrade, total, total_itensretirados); };
			    		}
			    		
						desabilitatudo_altestoque();
					
			    	}
			    }
			    xmlhttp.send(null);
			
			} else {
				if ( (descricaonova.value).length > 0 ){
					Product.ChangeItensStock(id, idgrade, total, '0');
				} else {
					kernel.dge('msggrade').innerHTML = '<b style="color:red;">Preencha o nome da grade corretamente</b>';
				}
			}
	
		} else {
			kernel.dge('msggrade').innerHTML = '<b style="color:red;">Preencha a quantidade com números</b>';
		}
	
	},
	
	SubtractGradeItemWithAuth : function (id, idgrade, total, total_itensretirados){
		
		xmlhttp.open("GET", 'modulos/'+Product.Directory+'/grade_diminuiestoque_confirma.php?retirados='+total_itensretirados+'&id='+id+'&idgrade='+idgrade+'&total='+total);
	    xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    		
	    		kernel.dge('linha_separador_gradeedicao').innerHTML = xmlhttp.responseText;
			
	    	}
	    }
	    xmlhttp.send(null);
		
	},
	
	SubtractGradeItemWithoutAuth : function (id, idgrade, total, total_itensretirados){
		
		totalCurrent = parseInt(total_itensretirados)-parseInt(total);
		
		Product.ChangeItensStock(id, idgrade, total, total_itensretirados);
		
		Product.ReturnGradeList(id, idgrade, (total-total_itensretirados));
		
		kernel.dge('msggrade').innerHTML = '<b style="color:red;"><u>O estoque do produto foi modificado</u><BR>As alterações do item da grade foram salvas com sucesso</b>';
		
		
	},
	
	ChangeItensStock : function (id, idgrade, total, reduz){
		
		var qtdestoque 			= kernel.dge('qtdestoque');
		var quantidadenova 		= kernel.dge('quantidade_itemmais_'+id);
		var vlprodgradenova 	= kernel.dge('vlprodgrade_itemmais_'+id);
		var descricaonova 		= kernel.dge('descricao_itemmais_'+id);
		var quantidade_input 	= kernel.dge('quantidade_input_'+id);
		var vlprodgrade_input 	= kernel.dge('vlprodgrade_input_'+id);
		var quantidadeestoque 	= 0;
		
		quantidade_input.value = parseFloat(quantidadenova.value);
		vlprodgrade_input.value = parseFloat(vlprodgradenova.value);

		var x= kernel.dge("listagrade");
		var input = x.getElementsByTagName("input");
		var i = 0;
		for (loop = 0; loop < input.length; loop++) {
			if (kernel.dge(input[loop].id).id == 'quantidade_input_'+i){
				quantidadeestoque += parseFloat(input[loop].value);
				i++;
			}
		}

		qtdestoque.value = quantidadeestoque;
		qtdestoque.style.border = '1px solid #6aa9e9';
		qtdestoque.style.color = '#484848';

		params = 'idgrade='+kernel.dge('idgrade_input_'+id).value+'&descricao='+descricaonova.value+'&quantidade='+quantidade_input.value+'&vlprodgrade='+vlprodgrade_input.value+'&totalestoque='+quantidadeestoque;

		total = parseFloat(quantidadenova.value);

		xmlhttp.open("POST", 'modulos/'+Product.Directory+'/grade_salvar.php', true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.setRequestHeader("Content-length", params.length);
		xmlhttp.setRequestHeader("Connection", "close");
		xmlhttp.onreadystatechange = function() {
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				kernel.dge('descricao_input_'+id).value 	= descricaonova.value;
				kernel.dge('descricao_'+id).innerHTML 		= descricaonova.value;
				kernel.dge('vlprodgrade_'+id).innerHTML 	= formatadinheiro(vlprodgrade_input.value);
				kernel.dge('quantidade_'+id).innerHTML 		= quantidade_input.value;
				kernel.dge('maisitem_'+id).value 			= 'editar';
				kernel.dge('maisitem_'+id).onclick 			= function(){ Product.AddItem(id, idgrade, total); };
				kernel.dge('msggrade').innerHTML 			= '<b style="color:red;"><u>Alteração efetuada</u></b>';
			}
		}
		xmlhttp.send(params);
		
	},
	
	SubtractGradeItemWithAuthConfirm : function ( id, idgrade, total, total_itensretirados ){

		var idusuario = kernel.dge('idusuario');
		var pwdusuario = kernel.dge('pwdusuario');
		var msg = kernel.dge('msgautentica_gradeerro');
		msg.innerHTML = '';

		if ( !idusuario.value ){
			msg.innerHTML = '<b style="color:red">Selecione o usuário corretamente</b>';
		} else if ( !pwdusuario.value || pwdusuario.value == 'digite sua senha' ) {
			msg.innerHTML = '<b style="color:red">Digite a sua senha corretamente</b>';
		} else {
			var resposta;
			xmlhttp.open("GET", path+'modulos/produto/grade_diminuiestoque_autentica.php?i='+idusuario.value+'&p='+pwdusuario.value);
		    xmlhttp.onreadystatechange = function() {
		    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					resposta = xmlhttp.responseText;
					if ( resposta == 'ok' ){
						Product.ChangeItensStock(id, idgrade, total, total_itensretirados);
						Product.ReturnGradeList(id, idgrade, total);
						//habilitatudopagina_altestoque(id, idgrade, total);
						kernel.dge('msggrade').innerHTML = '<b style="color:red;"><u>O estoque do produto foi modificado</u><BR>As alterações do item da grade foram salvas com sucesso</b>';
					} else if ( resposta == 'no' ){
						Product.ReturnGradeList(id, idgrade, total);
						kernel.dge('msggrade').innerHTML = '<b style="color:red;">Usuário não possui permissão para efetuar o procedimento<BR><u style="color:blue;">Não houve alteração no estoque</u></b>';
					} else if( resposta == 'erro' ){
						kernel.dge('msgautentica_gradeerro').innerHTML = '<b style="color:red;">ERRO - Preencha os dados corretamente ou clique em cancelar</b>'
					}
				}
		    }
		    xmlhttp.send(null);
		}
	},
	
	ReturnGradeList : function (id, idgrade, total){

		var qtdestoque 			= kernel.dge('qtdestoque');
		var quantidadenova 		= kernel.dge('quantidade_itemmais_'+id);
		var vlprodgradenova 	= kernel.dge('vlprodgrade_itemmais_'+id);
		var quantidade_input 	= kernel.dge('quantidade_input_'+id);
		var vlprodgrade_input 	= kernel.dge('vlprodgrade_input_'+id);
		var quantidadeestoque 	= 0;

		quantidadenova.style.border = '1px solid #6aa9e9';

		var x=kernel.dge("listagrade");
		var input = x.getElementsByTagName("input");
		var i = 0;
		
		for (loop = 0; loop < input.length; loop++) {
			if (kernel.dge(input[loop].id).id == 'quantidade_input_'+i){
				quantidadeestoque += parseFloat(input[loop].value);
				i++;
			}
		}

		qtdestoque.value = quantidadeestoque;

		kernel.dge('listagrade').style.height = '215px';
		kernel.dge('linha_separador_gradeedicao').style.display = 'none';
		kernel.dge('linha_separador_gradeedicao2').style.display = 'block';

		var x=kernel.dge("conteudo_direito");
		var input = x.getElementsByTagName("input");
		for (loop = 0; loop < input.length; loop++) {
			if (kernel.dge(input[loop].id)){
				kernel.dge(input[loop].id).disabled = false;
			}
		}
		var select = x.getElementsByTagName("select");
		for (loop = 0; loop < select.length; loop++) {
			if (kernel.dge(select[loop].id)){
				kernel.dge(select[loop].id).disabled = false;
			}
		}

		aumenta_opacidade('diveditarproduto');

		var x=kernel.dge("conteudo_esquerdo");
		var input = x.getElementsByTagName("input");
		for (loop = 0; loop < input.length; loop++) {
			if (kernel.dge(input[loop].id)){
				kernel.dge(input[loop].id).disabled = false;
			}
		}

		aumenta_opacidade('divadicionaritem');
		aumenta_opacidade('linha_separadoreditarproduto');

		kernel.dge("menu_realvirtualstore").style.display = 'block';
		kernel.dge("sair_realvirtualstore").style.display = 'block';

		total = parseFloat(quantidade_input.value);

		kernel.dge('descricao_'+id).innerHTML = kernel.dge('descricao_itemmais_'+id).value
		kernel.dge('vlprodgrade_'+id).innerHTML = formatadinheiro(vlprodgrade_input.value);
		kernel.dge('quantidade_'+id).innerHTML = quantidade_input.value;
		kernel.dge('maisitem_'+id).value = 'editar';
		kernel.dge('maisitem_'+id).onclick = function(){ Product.AddItem(id, idgrade, total); };

		//kernel.dge('msggrade').innerHTML = '<b style="color:blue;"><u>Não houve alteração</u></b>';

	}
	
	
}
