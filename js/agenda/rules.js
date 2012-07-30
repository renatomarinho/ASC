/*
<meta name="nome_fake" content="Financeiro">
<meta name="nome_rvs" content="rules.js">
<meta name="localizacao" content="/js/financeiro">
<meta name="descricao" content="Correcoes.">
</head>
*/

// <![CDATA[
var msg;
var rules = {

	'.null' : { },
    '.hoverable' : {
        onmouseover : function() { this.style.color = 'red'; },
        onmouseout : function() { this.style.color = 'black'; }
    },

};
// ]]>
Behavior.register(rules);