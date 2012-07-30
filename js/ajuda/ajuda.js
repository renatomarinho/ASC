
var Help = {
		
	Directory 	: 'ajuda',	
		
	Starting : function (){

		var conteudo_total = kernel.dge('conteudo_total') , conteudo_esquerdo = kernel.dge('conteudo_esquerdo'), conteudo_direito = kernel.dge('conteudo_direito');
		
		conteudo_total.style.display = 'none';
		conteudo_esquerdo.style.display = 'block';
		conteudo_direito.style.display = 'block';
		
		conteudo_total.innerHTML = '';
		conteudo_esquerdo.innerHTML = '';
		conteudo_direito.innerHTML = '';
	
		xmlhttp.open("GET", "modulos/"+Help.Directory+"/index.php");
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				conteudo_esquerdo.innerHTML = xmlhttp.responseText;
			}
		}
	    	
	    xmlhttp.send(null);
	
	}
		
		
}