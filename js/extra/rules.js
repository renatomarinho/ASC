/*
<meta name="nome_fake" content="Financeiro">
<meta name="nome_rvs" content="rules.js">
<meta name="localizacao" content="/js/financeiro">
<meta name="descricao" content="Correcoes.">
</head>
*/

// criando regras de extra
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



};

// ]]>
Behavior.register(rules);