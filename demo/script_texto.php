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



function get_between($text, $s1, $s2) {
	$mid_url = "";
	$pos_s = strpos ( $text, $s1 );
	$pos_e = strpos ( $text, $s2 );
	for($i = $pos_s + strlen ( $s1 ); (($i < ($pos_e)) && $i < strlen ( $text )); $i ++) {
		$mid_url .= $text [$i];
	}
	return $mid_url;
}

$modeloHTML = 'modelo.html';

$fp = fopen ( $modeloHTML, 'r' );
$HTML = fread ( $fp, filesize ( $modeloHTML ) );
fclose ( $fp );

$total = substr_count ( $HTML, 'class="menu_fix">' );
$atual = 0;

$novoHTML = '';

for($i = 0; $i < $total; $i ++) {
	$pos = strpos ( $HTML, 'class="menu_fix">' );
	$HTML = substr_replace ( $HTML, 'class="menu_fix_' . $i . '">', $pos, 17 );
	$pos = strpos ( $HTML, '</a></td>', $pos );
	$HTML = substr_replace ( $HTML, '</a' . $i . '></td>', $pos, 9 );
}

for($i = 0; $i < $total; $i ++) {
	$s1 = 'class="menu_fix_' . $i . '">';
	$s2 = '</a' . $i . '></td>';
	$dados = get_between ( $HTML, $s1, $s2 );
	
	if (strpos ( $dados, ',' ) > 0) {
		$dados = explode ( ',', $dados );
		$nome = $dados [0];
		$dados = explode ( '&lt;', $dados [1] );
		$sobrenome = $dados [0];
		$email = str_replace ( '&gt;', '', $dados [1] );
	} else if (strpos ( $dados, ',' ) == 0 && strpos ( $dados, '&lt;' ) > 0) {
		
		$sobrenome = '';
		$dados = explode ( '&lt;', $dados );
		$nome = $dados [0];
		$email = str_replace ( '&gt;', '', $dados [1] );
	
	} else {
		
		$nome = '';
		$sobrenome = '';
		$email = $dados;
	
	}
	
	echo $monta = ',' . $nome . ',' . $sobrenome . ',' . $email . "\r";

}

?>