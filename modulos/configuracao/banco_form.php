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

require "_language.php";

if (! isset ( $_CONF ['PATH'] )) {
	require "../../config/default.php";
}
?>
<br />

<input type="hidden" id="idbank" value="0" />

<table>
	<tr>
		<td><b><?=$_CONF['lang']['banco_form'][0];?></b></td>
		<td><input type="text" id="numberbank" style="width:60px;" maxlength="4" /></td>
		<td width="5"></td>
		<td><b><?=$_CONF['lang']['banco_form'][1];?></b></td>
		<td><input type="text" id="namebank" style="width:180px;" maxlength="35" /></td>
		<td><input type="checkbox" id="statusbank" /></td>
		<td><b><?=$_CONF['lang']['banco_form'][2];?></b></td>
	</tr>
</table>