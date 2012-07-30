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

<fieldset id="m"><legend><?=$_CONF['lang']['empresa'][0];?></legend>

<div class="linha_separador ls_conf_M">
	<table>
		<tr>
			<td><img src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/dadosempresa.png" class="t32" /></td>
			<td width="10"></td>
			<td><b><?=$_CONF['lang']['empresa'][1];?></b><br /><?=$_CONF['lang']['empresa'][2];?> <i><?=$_CONF['lang']['empresa'][3];?></i></td>
		</tr>
	</table>
</div>

<div><div id="empresa_lista"></div></div>

</fieldset>
