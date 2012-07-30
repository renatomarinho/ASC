/**
 * http://www.openjs.com/scripts/events/keyboard_shortcuts/
 * Version : 2.01.B
 * By Binny V A
 * License : BSD
 */
shortcut = {
	'all_shortcuts':{},//All the shortcuts are stored in this array
	'add': function(shortcut_combination,callback,opt) {
		//Provide a set of default options
		var default_options = {
			'type':'keydown',
			'propagate':false,
			'disable_in_input':false,
			'target':document,
			'keycode':false
		}
		if(!opt) opt = default_options;
		else {
			for(var dfo in default_options) {
				if(typeof opt[dfo] == 'undefined') opt[dfo] = default_options[dfo];
			}
		}

		var ele = opt.target
		if(typeof opt.target == 'string') ele = document.getElementById(opt.target);
		var ths = this;
		//shortcut_combination = shortcut_combination.toLowerCase();
		shortcut_combination = shortcut_combination.toUpperCase();


		//The function to be called at keypress
		var func = function(e) {
			e = e || window.event;

			if(opt['disable_in_input']) { //Don't enable shortcut keys in Input, Textarea fields
				var element;
				if(e.target) element=e.target;
				else if(e.srcElement) element=e.srcElement;
				if(element.nodeType==3) element=element.parentNode;

				if(element.tagName == 'INPUT' || element.tagName == 'TEXTAREA') return;
			}

			//Find Which key is pressed
			if (e.keyCode) code = e.keyCode;
			else if (e.which) code = e.which;
			var character = String.fromCharCode(code);
			if(code == 188) character=","; //If the user presses , when the type is onkeydown
			if(code == 190) character="."; //If the user presses , when the type is onkeydown

			var keys = shortcut_combination.split("+");
			//Key Pressed - counts the number of valid keypresses - if it is same as the number of keys, the shortcut function is invoked
			var kp = 0;

			//Work around for stupid Shift key bug created by using lowercase - as a result the shift+num combination was broken
			var shift_nums = {
				"`":"~",
				"1":"!",
				"2":"@",
				"3":"#",
				"4":"$",
				"5":"%",
				"6":"^",
				"7":"&",
				"8":"*",
				"9":"(",
				"0":")",
				"-":"_",
				"=":"+",
				";":":",
				"'":"\"",
				",":"<",
				".":">",
				"/":"?",
				"\\":"|"
			}
			//Special Keys - and their codes
			var special_keys = {
				'esc':27,
				'escape':27,
				'tab':9,
				'space':32,
				'return':13,
				'enter':13,
				'backspace':8,

				'scrolllock':145,
				'scroll_lock':145,
				'scroll':145,
				'capslock':20,
				'caps_lock':20,
				'caps':20,
				'numlock':144,
				'num_lock':144,
				'num':144,

				'pause':19,
				'break':19,

				'insert':45,
				'home':36,
				'delete':46,
				'end':35,

				'pageup':33,
				'page_up':33,
				'pu':33,

				'pagedown':34,
				'page_down':34,
				'pd':34,

				'left':37,
				'up':38,
				'right':39,
				'down':40,

				'f1':112,
				'f2':113,
				'f3':114,
				'f4':115,
				'f5':116,
				'f6':117,
				'f7':118,
				'f8':119,
				'f9':120,
				'f10':121,
				'f11':122,
				'f12':123
			}

			var modifiers = {
				shift: { wanted:false, pressed:false},
				ctrl : { wanted:false, pressed:false},
				alt  : { wanted:false, pressed:false},
				meta : { wanted:false, pressed:false}	//Meta is Mac specific
			};

			if(e.ctrlKey)	modifiers.ctrl.pressed = true;
			if(e.shiftKey)	modifiers.shift.pressed = true;
			if(e.altKey)	modifiers.alt.pressed = true;
			if(e.metaKey)   modifiers.meta.pressed = true;

			for(var i=0; k=keys[i],i<keys.length; i++) {
				//Modifiers
				if(k.toLowerCase() == 'ctrl' || k.toLowerCase() == 'control') {
					kp++;
					modifiers.ctrl.wanted = true;
				} else if(k.toLowerCase() == 'shift') {
					kp++;
					modifiers.shift.wanted = true;
				} else if(k.toLowerCase() == 'alt') {
					kp++;
					modifiers.alt.wanted = true;
				} else if(k.toLowerCase() == 'meta') {
					kp++;
					modifiers.meta.wanted = true;
				} else if(k.length > 1) { //If it is a special key
					if(special_keys[k.toLowerCase()] == code) kp++;

				} else if(opt['keycode']) {
					if(opt['keycode'] == code) kp++;

				} else { //The special keys did not match
					if(character == k) kp++;
					else {
						if(shift_nums[character] && e.shiftKey) { //Stupid Shift key bug created by using lowercase
							character = shift_nums[character];
							if(character == k) kp++;
						}
					}
				}
			}

			if(kp == keys.length &&
						modifiers.ctrl.pressed == modifiers.ctrl.wanted &&
						modifiers.shift.pressed == modifiers.shift.wanted &&
						modifiers.alt.pressed == modifiers.alt.wanted &&
						modifiers.meta.pressed == modifiers.meta.wanted) {
				callback(e);




				if(!opt['propagate']) { //Stop the event
					//e.cancelBubble is supported by IE - this will kill the bubbling process.
					e.cancelBubble = true;
					e.returnValue = false;

					//e.stopPropagation works in Firefox.
					if (e.stopPropagation) {
						e.stopPropagation();
						e.preventDefault();
					}
					return false;
				}
			}
		}

		this.all_shortcuts[shortcut_combination] = {
			'callback':func,
			'target':ele,
			'event': opt['type']
		};

		//Attach the function with the event
		if(ele.addEventListener) ele.addEventListener(opt['type'], func, false);
		else if(ele.attachEvent) ele.attachEvent('on'+opt['type'], func);
		else ele['on'+opt['type']] = func;

	},

	//Remove the shortcut - just specify the shortcut and I will remove the binding
	'remove':function(shortcut_combination) {
		shortcut_combination = shortcut_combination.toLowerCase();
		var binding = this.all_shortcuts[shortcut_combination];
		delete(this.all_shortcuts[shortcut_combination])
		if(!binding) return;
		var type = binding['event'];
		var ele = binding['target'];
		var callback = binding['callback'];

		if(ele.detachEvent) ele.detachEvent('on'+type, callback);
		else if(ele.removeEventListener) ele.removeEventListener(type, callback, false);
		else ele['on'+type] = false;
	}
}

/**
 * Para essa versão não é possivel criar pastas para separar os JSs
 * portanto shortcuts ainda não definidos seram criados aqui.
 *  
 * Na outra versão, esse codigo deve ser transferido para sua pasta do modulo correspondente.
 * 
 */

////////////// 
// Cadastro //
//////////////

shortcut.add("F2", function(e) {
		return dropdownmenu(document.getElementById("menu_cadastro"), e, menu_cadastro, '130px', document.getElementById("menu_cadastro").id);
	}
);

// clientes
shortcut.add("1", function(e) {
		if ( isOpenMenu('menu_cadastro'))
		{
			carrega_listagemcliente();
			delayhidemenu();
		}
	},
	{'disable_in_input':true}
);



// coleções
shortcut.add("3", function(e) {
		if ( isOpenMenu('menu_cadastro'))
		{
			carrega_listagemcolecoes(path+'modulos/colecao/colecao_lista.php','conteudo_direito', 'historico');
			delayhidemenu();
		}
	},
	{'disable_in_input':true}
);

// fornecedores
shortcut.add("4", function(e) {
		if ( isOpenMenu('menu_cadastro'))
		{
			carrega_listagemfornecedores(path+'modulos/fornecedor/fornecedor_lista.php','conteudo_direito', 'historico');
			delayhidemenu();
		}
	},
	{'disable_in_input':true}
);

shortcut.add("ESC", function(e) {
		delayhidemenu();
	}
);


////////////////
// Financeiro //
////////////////

// Apasta já existe mas para evitar criar novos arquivos o shortcut esta sendo definido aqui
shortcut.add("F4", function(e) {
		return dropdownmenu(document.getElementById("menu_financeiro"), e, menu_financeiro, '130px', document.getElementById("menu_financeiro").id);
	}
);

// fluxo de caixa
shortcut.add("1", function(e) {
		if ( isOpenMenu('menu_financeiro'))
		{
                  var date_now = new Date()  
                  carrega_financeiro_fluxo_lista(date_now.getDate(), date_now.getMonth(), date_now.getFullYear());
                  delayhidemenu();
		}
	},
	{'disable_in_input':true}
);


////////////////
// Utilitário //
////////////////
shortcut.add("F7", function(e) {
		return dropdownmenu(document.getElementById("menu_util"), e, menu_util, '130px', document.getElementById("menu_util").id);
	}
);

// clientes
shortcut.add("1", function(e) {
		if ( isOpenMenu('menu_util'))
		{
                  var date_now = new Date()  
                  carrega_utilitarios_agenda(date_now.getDate(), date_now.getMonth(), date_now.getFullYear());
                  delayhidemenu();
		}
	},
	{'disable_in_input':true}
);

// produtos
shortcut.add("2", function(e) {
		if ( isOpenMenu('menu_util'))
		{
			carrega_emissaoetiqueta();
			delayhidemenu();
		}
	},
	{ 'disable_in_input':true }
);

// coleções
shortcut.add("3", function(e) {
		if ( isOpenMenu('menu_util'))
		{
			carrega_emissaomailling();
			delayhidemenu();
		}
	},
	{'disable_in_input':true}
);

// fornecedores
shortcut.add("4", function(e) {
		if ( isOpenMenu('menu_util'))
		{
			autentica_software();
			delayhidemenu();
		}
	},
	{'disable_in_input':true}
);



///////////////////  
// Configurações //
///////////////////
shortcut.add("F8", function(e) {
		return dropdownmenu(document.getElementById("menu_config"), e, menu_config, '130px', document.getElementById("menu_config").id);
	}
);

// clientes
shortcut.add("1", function(e) {
		if ( isOpenMenu('menu_config'))
		{
                  delayhidemenu();
		}
	},
	{'disable_in_input':true}
);

// produtos
shortcut.add("2", function(e) {
		if ( isOpenMenu('menu_config'))
		{
			carrega_usuariosadm(path+'modulos/administracao/lista_adm.php','conteudo_esquerdo');
			delayhidemenu();
		}
	},
	{ 'disable_in_input':true }
);

// coleções
shortcut.add("3", function(e) {
		if ( isOpenMenu('menu_config'))
		{
			carrega_configuracoes(path+'modulos/configuracao/lista_opcoes.php');
			delayhidemenu();
		}
	},
	{'disable_in_input':true}
);



////////////  
// Ajuda //
///////////

shortcut.add("F1", function(e) {
		return dropdownmenu(document.getElementById("menu_ajuda"), e, menu_ajuda, '130px', document.getElementById("menu_ajuda").id);
	}
);

// clientes
shortcut.add("1", function(e) {
		if ( isOpenMenu('menu_ajuda'))
		{
                  delayhidemenu();
		}
	},
	{'disable_in_input':true}
);

// produtos
shortcut.add("2", function(e) {
		if ( isOpenMenu('menu_ajuda'))
		{
			delayhidemenu();
		}
	},
	{ 'disable_in_input':true }
);


