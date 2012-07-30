// produtos
shortcut.add("2", function(e) {
		if ( isOpenMenu('menu_cadastro'))
		{
			carrega_listagemprodutos(path+'modulos/produto/lista.php','conteudo_total');
			delayhidemenu();
		}
	},
	{ 'disable_in_input':true }
);