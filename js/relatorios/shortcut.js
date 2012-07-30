// shortcut Relatorios

// Menu

shortcut.add("F6", function(e) {
		delayhidemenu();
		return dropdownmenu(document.getElementById("menu_relatorios"), e, menu_relatorios, '130px', document.getElementById("menu_relatorios").id);
	}
);

// produtos
shortcut.add("1", function(e) {
		if ( isOpenMenu('menu_relatorios'))
		{
			carrega_relatorioprodutosvendidos(path+'modulos/relatorios/produtos.php','conteudo_total')
			delayhidemenu();
		}
	},
	{'disable_in_input':true}
);
    
 // vendas
shortcut.add("2", function(e) {
		if ( isOpenMenu('menu_relatorios'))
		{
			carrega_relatoriolucratividade(path+'modulos/relatorios/venda_lucratividade_periodo.php','conteudo_total');
			delayhidemenu();
		}
	},
	{'disable_in_input':true}
);
      
    
// vendas vip
shortcut.add("3", function(e) {
		if ( isOpenMenu('menu_relatorios'))
		{
			carrega_relatorio_venda_vip(path+'modulos/relatorios/venda_lucratividade_periodo.php','conteudo_total');
			delayhidemenu();
		}
	},
	{'disable_in_input':true}
);
    
// estoque
shortcut.add("4", function(e) {
		if ( isOpenMenu('menu_relatorios'))
		{
			carrega_relatorioestoque(path+'modulos/relatorios/estoque.php','conteudo_total');
			delayhidemenu();
		}
	},
	{'disable_in_input':true}
);    
    
    
    
// fornecedores
shortcut.add("5", function(e) {
		if ( isOpenMenu('menu_relatorios'))
		{
			carrega_relatoriofornecedores(path+'modulos/relatorios/fornecedores.php','conteudo_total');
			delayhidemenu();
		}
	},
	{'disable_in_input':true}
);

// clientes
shortcut.add("6", function(e) {
		if ( isOpenMenu('menu_relatorios'))
		{
			carrega_relatorioclientes(path+'modulos/relatorios/clientes.php','conteudo_total');
			delayhidemenu();
		}
	},
	{'disable_in_input':true}
);




shortcut.add("ESC", function(e) {
		delayhidemenu();
	}
);


////////////////////
// ATALHO GLOBAL  //
////////////////////


//shortcut.add("F3",function() { alert("juca"); }, {
//						'type':'keydown',
//						'propagate':false,
//						'disable_in_input':true
//						'target':document,
//						'keycode':65
//});