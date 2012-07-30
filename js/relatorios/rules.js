/*
<meta name="nome_fake" content="Vendas">
<meta name="nome_rvs" content="rules.js">
<meta name="localizacao" content="/js/vendas">
<meta name="descricao" content="Correcoes.">
</head>
*/

// criando regras de Vendas
// <![CDATA[
var msg;
var rules = {
	'.show_venda_itens' : {
		onclick : function() {

			if (elm = document.getElementById('itens_' + this.id))
			{
				var trs = document.getElementsByTagName("tr");
                //alert(trs.length);
                for (var i = 0; i < trs.length; i++)
                {
                	if (trs[i].getAttribute("id") == elm.id)
                	{
	                	if (trs[i].style.display == 'none' || trs[i].style.display == "")
	                		trs[i].style.display = 'table-row';
						else
							trs[i].style.display = 'none';
                	}
                }
			}
		},
		onmouseover : function() { rowOver(this); this.style.cursor = 'pointer';this.style.cursor = 'hand'; },
        onmouseout : function() { rowOut(this); this.style.cursor = 'pointer';this.style.cursor = 'hand'; }
    },

    '.show_estoque_itens' : {
		onclick : function() {

			if (elm = document.getElementById('produto_' + this.id))
			{
				var trs = document.getElementsByTagName("tr");
                //alert(trs.length);
                for (var i = 0; i < trs.length; i++)
                {
                	if (trs[i].getAttribute("id") == elm.id)
                	{
	                	if (trs[i].style.display == 'none' || trs[i].style.display == "")
	                		trs[i].style.display = 'table-row';
						else
							trs[i].style.display = 'none';
                	}
                }
			}
		},
		onmouseover : function() { rowOver(this); this.style.cursor = 'pointer';this.style.cursor = 'hand'; },
        onmouseout : function() { rowOut(this); this.style.cursor = 'pointer';this.style.cursor = 'hand'; }
    },


    '.show_cliente_itens' : {
		onclick : function() {

			if (elm = document.getElementById('cliente_' + this.id))
			{
				var trs = document.getElementsByTagName("tr");
                //alert(trs.length);
                for (var i = 0; i < trs.length; i++)
                {
                	if (trs[i].getAttribute("id") == elm.id)
                	{
	                	if (trs[i].style.display == 'none' || trs[i].style.display == "")
	                		trs[i].style.display = 'table-row';
						else
							trs[i].style.display = 'none';
                	}
                }
			}
		},
		onmouseover : function() { rowOver(this); this.style.cursor = 'pointer';this.style.cursor = 'hand'; },
        onmouseout : function() { rowOut(this); this.style.cursor = 'pointer';this.style.cursor = 'hand'; }
    },


    '.hover_venda' : {
		onmouseover : function() { rowOver(this);  },
        onmouseout : function() { rowOut(this);  }
    },
};

// ]]>
Behavior.register(rules);