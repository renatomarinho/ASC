/*
<meta name="nome_fake" content="Vendas">
<meta name="nome_rvs" content="rules.js">
<meta name="localizacao" content="/js/vendas">
<meta name="descricao" content="Correcoes.">
</head>
*/

// criando regras de Vendas
// <![CDATA[
var rules = {
	'.habilitar_cartao' : {
		onclick : function() {
			desativar_form_tx(false);
			if (!this.checked) desativar_form_tx(true);
		}
    },

    '.set_cartao' : {
		onchange : function() { load_form_tx(this.value);  },
    },

    '.salvar_cartao' : {
    	onclick : function() { alert('teste'); },
    },
};

// ]]>
Behavior.register(rules);