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

$s = $_REQUEST ['s'];
$d = $_REQUEST ['d'];
$m = $_REQUEST ['m'];
$a = $_REQUEST ['a'];

if ($s == 1) {
	$data = mktime ( 0, 0, 0, $m, $d + 1, $a );
} else if ($s == 2) {
	$data = mktime ( 0, 0, 0, $m, $d - 1, $a );
} else if ($s == 3) {
	$data = mktime ( 0, 0, 0, $m + 1, $d, $a );
} else if ($s == 4) {
	$data = mktime ( 0, 0, 0, $m - 1, $d, $a );
} else if ($s == 5) {
	$data = mktime ( 0, 0, 0, $m, $d - 7, $a );
} else if ($s == 6) {
	$data = mktime ( 0, 0, 0, $m, $d + 7, $a );
} else if ($s == 7) {
	$data = mktime ( 0, 0, 0, $m, $d, $a + 1 );
} else if ($s == 8) {
	$data = mktime ( 0, 0, 0, $m, $d + 7, $a - 1 );
} else if ($s == 9) {
	$data = mktime ( 0, 0, 0, $m + 1, $d, $a );
	$data = mktime ( 0, 0, 0, date ( 'n', $data ), date ( 'd', $data ) - 1, date ( 'Y', $data ) );
} else {
	$data = mktime ( 0, 0, 0, $m, $d, $a );
}

$ds = date ( 'w', $data );
$data = date ( 'j|n|Y', $data );

echo $ds . '|' . $data;
//echo '3|2|7|2008';
?>