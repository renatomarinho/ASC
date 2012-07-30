<?
////////////////////////////////////////////////////////////////////////////////////////
//                                                                                    //
// NOTICE OF COPYRIGHT                                                                //
//                                                                                    //
// ASC - Ajax Sales Cloud - http://www.greyland.com.br                                                  //
//                                                                                    //
// Copyright (C) 2008 onwards Renato Marinho ( renato.marinho@greyland.com.br )         //
//                                                                                    //
// This program is free software; you can redistribute it and/or modify it under      //
// the terms of the GNU General Public License as published by the Free Software      //
// Foundation; either version 3 of the License, or (at your option) any later         //
// version.                                                                           //
//                                                                                    //
// This program is distributed in the hope that it will be useful, but WITHOUT ANY    // 
// WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A    //
// PARTICULAR PURPOSE.  See the GNU General Public License for more details:          //
//                                                                                    //
//  http://www.gnu.org/copyleft/gpl.html                                              //
//                                                                                    //
////////////////////////////////////////////////////////////////////////////////////////


if (! isset ( $_CONF ['PATH'] )) {
	require "../../config/default.php";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link rel="stylesheet" type="text/css"
	href="<?=$_CONF ['PATH_VIRTUAL'];?>css/impressao.css" />


<script>
var path = '<?=$_CONF ['PATH_VIRTUAL'];?>';

function etiquetaparaimpressao(prod,cod){

	alfabet = new Array('AAAAAACCCCCC','AABABBCCCCCC','AABBABCCCCCC','AABBBACCCCCC','ABAABBCCCCCC','ABBAABCCCCCC','ABBBAACCCCCC','ABABABCCCCCC','ABABBACCCCCC','ABBABACCCCCC');
  	acode = new Array('0001101','0011001','0010011','0111101','0100011','0110001','0101111','0111011','0110111','0001011');
  	bcode = new Array('0100111','0110011','0011011','0100001','0011101','0111001','0000101','0010001','0001001','0010111');
  	ccode = new Array('1110010','1100110','1101100','1000010','1011100','1001110','1010000','1000100','1001000','1110100');
  	value = new Array('0','1','2','3','4','5','6','7','8','9');

  	ean = cod;
  	eanok = (ean != null);
  	if (eanok) eanok = (ean != "");
	if (eanok) {
		chksum = 0;
		code = ean;
		for (i = 0; i < ean.length; i++) {
			v = -1;
			for (j = 0; j < value.length; j++) {
  				if (value[j] == ean.charAt(i)) {
    					if (i % 2 == 0) {
      					v=j;
    					} else {
      					v=3*j;
    					}
  				}
			}
			chksum += v;
		}

		chksum = chksum % 10;
		chksum = (10 - chksum) % 10;
		ean = ean + value[chksum];

		for (i=0; i<value.length; i++) {
			if (value[i] == ean.charAt(0)) {
  				alfstr = alfabet[i];
			}
 		}

		wstr = "101";

		for (i = 0; i < 6; i++) {
			if (alfstr.charAt(i) == "A") {
  				wstr += acode[ean.charAt(i+1)];
			}
			if (alfstr.charAt(i) == "B") {
  				wstr += bcode[ean.charAt(i+1)];
			}
		}

		wstr += "01010";

		for (i = 6; i < 12; i++) {
  			wstr += ccode[ean.charAt(i+1)];
		}

		wstr += "101";

		astr ='<div align="center" style="font-family:Verdana,sans serif;font-size:8px">'+prod+'<BR style="margin-bottom: 1px"><div>';

		for (i = 0; i < wstr.length; i++) {
			astr +=  '<img id="tamanhocodbarra" src="'+path+'imgs/Pbc-' +
        		wstr.charAt(i) + '.png" alt="' +
        		wstr.charAt(i) + '" style="margin-top:2px;">';
		}
		astr +='</div>';
		astr +='<B style="font-family:Verdana,sans serif;font-size: 110%">' + ean + '</B></div>';

		return astr;

  	}
}


function etiquetaclienteimpressao(d1,d2,d3,d4,d5,d6){

	var astr;

	astr = '<center><table><tr><td><b style="font-family:Verdana,sans serif;font-size:12px">'+d1+'</b></td><tr>';

	astr += '<tr><td style="font-family:Verdana,sans serif;font-size:10px">'+d2+' - '+d3+'</td></tr>';
	astr += '<tr><td style="font-family:Verdana,sans serif;font-size:10px">'+d4+' - '+d5+' - CEP:'+d6+'</td></tr></table></center>';

	return astr;

}


var html='', total=0; etiquetas=28;

for ( u=0;u<etiquetas;u++ ){

	if (total == 0 ){
		html += '<div id="separabloco">';
	}

	html += '<span id="daespaco"><div id="separacao">';

	html +=  etiquetaclienteimpressao(u+'Nome do fulano de tal','rua do fulano de tal, 10232 - sala 318','Barra da Tijuca','Rio de Janeiro','RJ','22460-000');
		//html += etiquetaparaimpressao('Blusa Branca','4922020803262');

	html += '</div></span>';

	total ++;

	if ( total == 2 ) {
		html += '</div>';
		total = 0;
	}
}

</script>


<body>

<div id="espacamento">
<div id="impressao"></div>
<div><script>document.getElementById('impressao').innerHTML = html;</script>

</body>