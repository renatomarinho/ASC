/*
<meta name="nome_fake" content="Financeiro">
<meta name="nome_rvs" content="rules.js">
<meta name="localizacao" content="/js/financeiro">
<meta name="descricao" content="Correcoes.">
</head>
*/

// criando regras de financeiro
// <![CDATA[
var msg;
var rules = {
    //'.exibe_receita_despesa' : {
    //    onclick : function() { financeiro_fluxo_exibe_receita_despesa(this) }
    //},
	'.null' : { },
    '.hoverable' : {
        onmouseover : function() { this.style.color = 'red'; },
        onmouseout : function() { this.style.color = 'black'; }
    },

    '.item_movimento_hover' : {
    	onmouseover : function() {
    		this.style.cursor = 'pointer';
			this.style.cursor = 'hand';
			this.style.height = '18px';
			eval("this.style.paddingTop = '6px';");
			rowOver(this);
    	},
        onmouseout : function() {
        	this.style.background= '';
        	rowOut(this);
        },
    },

    '.item_movimento_no_hand' : {
    	onmouseover : function() {
    		this.style.cursor = 'pointer';
			this.style.cursor = 'hand';
			this.style.height = '18px';
			eval("this.style.paddingTop = '6px';");
			rowOver(this);
    		this.style.cursor = 'default';
    	},
    	onclick : function() {	return false; }
    },

    '.item_movimento_hand' : {
    	onclick : function() {
        	load_receita_despesa(this.id);
        }
    },



    '.add_fornecedor': {
    	onmouseover : function(){ this.title = 'Adicionar novo Fornecedor';	},
    	onclick : function() {
    							if (this.tagName == 'DIV')
    							{
    								document.getElementById('divplano').style.display = 'none';
    								document.getElementById('divfavorecido').style.display = 'block';
    								flash('', 'validator');
    						  	}
    						  	else
    						  	{
    						  		add_favorecido();
    						  	}
    	}
    },

    '.remove_fornecedor': {
    	onmouseover : function(){
			fluxo = document.getElementById('fluxo');
    		if(fluxo.value == "receita")
			{
				fornecedor	= document.getElementById('fornecedorentrada');
			}
			else
			{
				fornecedor	= document.getElementById('fornecedorsaida');
			}
			msg = 'Remover o Fornecedor ' + (fornecedor.value != "" ? '\'' + fornecedor.options[fornecedor.selectedIndex].text.trim() + '\'' : "");
    		this.title = msg;
    	},
    	onclick : function() {
    		if (fornecedor.value == "")
    		{
    			alert('Nenhum fornecedor selecionado.');
    			return;
    		}
    		remove = confirm(msg);
    		if (remove) remove_favorecido(fornecedor.value);
    	}
    },

    '.add_plano': {
    	onmouseover : function(){ this.title = 'Adicionar novo Plano'; },
    	onclick : function() {
    							if (this.tagName == 'DIV')
    							{
    								document.getElementById('divfavorecido').style.display = 'none';
	    							document.getElementById('divplano').style.display = 'block';
	    							flash('', 'validator');
    							}
    							else
    							{
									add_plano();
    							}
    	}
    },

    '.remove_plano': {
    	onmouseover : function(){
			fluxo = document.getElementById('fluxo');
    		if(fluxo.value == "receita")
			{
				plano	= document.getElementById('planoentrada');
			}
			else
			{
				plano	= document.getElementById('planosaida');
			}
			msg = 'Remover Plano ' + (plano.value != "" ? '\'' + plano.options[plano.selectedIndex].text.trim() + '\'' : "");
    		this.title = msg;
    	},
    	onclick : function() {
    		if (plano.value == "")
    		{
    			alert('Nenhum plano selecionado.');
    			return;
    		}
    		remove = confirm(msg);
    		if (remove) remove_plano(plano.value);
    	}
    },

};

// ]]>
Behavior.register(rules);