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

<input type="hidden" id="idcard" value="0" />

<table width="100%">
	<tr>
		<td colspan="3">
			<table>
				<tr>
					<td><b><?=$_CONF['lang']['cartao_form'][0];?></b></td>
					<td width="5"></td>
					<td><input type="text" id="namecard" style="width:210px;" /></td>
					<td width="5"></td>
					<td><input type="checkbox" id="statuscard" /></td>
					<td><b><?=$_CONF['lang']['cartao_form'][1];?></b></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="30" width="20"><input type="checkbox" id="credit" onclick="javascript:kernel.blockNone(kernel.dge('div_credit'));" /></td>
		<td><b><?=$_CONF['lang']['cartao_form'][2];?></b></td>
		<td align="right">
			<div id="div_credit" style="display:none;">
				<table>
					<td width="30"></td>
					<td><?=$_CONF['lang']['cartao_form'][3];?></td>
					<td width="30"></td>
					<td><?=$_CONF['lang']['cartao_form'][4];?></td>
					<td><input type="text" id="tx_credit1" style="width:60px;text-align:right;" /> %</td>
					<td width="10"></td>
					<td><?=$_CONF['lang']['cartao_form'][5];?></td>
					<td><input type="text" id="tx_credit2" style="width:60px;text-align:right;" /> %</td>
				</table>
			</div>
		</td>
	</tr>
	<tr>
		<td height="30" width="20"><input type="checkbox" id="debit" onclick="javascript:kernel.blockNone(kernel.dge('div_debit'));" /></td>
		<td><b><?=$_CONF['lang']['cartao_form'][6];?></b></td>
		<td align="right">
			<div id="div_debit" style="display:none;">
				<table>
					<td width="30"></td>
					<td><?=$_CONF['lang']['cartao_form'][7];?></td>
					<td width="30"></td>
					<td><?=$_CONF['lang']['cartao_form'][8];?></td>
					<td><input type="text" id="tx_debit1" style="width:60px;text-align:right;" /> %</td>
				</table>
			</div>
		</td>
	</tr>
	
</table>