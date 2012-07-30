// shortcut Vendas

// Menu

shortcut.add("F3", function(e) {
		return dropdownmenu(document.getElementById("menu_vendas"), e, menu_vendas, '130px', document.getElementById("menu_vendas").id);
	}
);

// venda Normal
shortcut.add("1", function(e) {
		if ( isOpenMenu('menu_vendas'))
		{
			carrega_efetuarvenda(path+'modulos/venda/seleciona_produto.php','normal');
			delayhidemenu();
		}
	},
	{'disable_in_input':true}
);

// venda Vip
shortcut.add("2", function(e) {
		if ( isOpenMenu('menu_vendas'))
		{
			carrega_efetuarvenda(path+'modulos/venda/seleciona_produto.php','vip');
			delayhidemenu();
		}
	},
	{ 'disable_in_input':true }
);

// estornar produto vIp
shortcut.add("4", function(e) {
		if ( isOpenMenu('menu_vendas'))
		{
			carrega_estornarvenda(path+'modulos/venda/estornar_venda.php?tipo_venda=vip','conteudo_esquerdo');
			delayhidemenu();
		}
	},
	{'disable_in_input':true}
);

// estornar produto vIp
shortcut.add("3", function(e) {
		if ( isOpenMenu('menu_vendas'))
		{
			carrega_estornarvenda(path+'modulos/venda/estornar_venda.php?tipo_venda=normal','conteudo_esquerdo');
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