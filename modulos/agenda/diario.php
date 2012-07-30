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

$d1 = (empty ( $_GET ['d1'] )) ? date ( 'd' ) : $_GET ['d1'];
$m1 = (empty ( $_GET ['m1'] )) ? date ( 'm' ) : $_GET ['m1'];
$a1 = (empty ( $_GET ['a1'] )) ? date ( 'Y' ) : $_GET ['a1'];

?>
<table width="100%">
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td>
		<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td>
				<table width="100%">
					<tr>
						<td align="left" width="50"><input type="button" value="- m�s"
							class="botao" style="cursor: pointer; cursor: hand; width: 50px;"
							onclick="javascript:Calendar.ChangeData(4);"></td>
						<td align="left" width="50"><input type="button" value="- dia"
							id="diasemana_anterior" class="botao"
							style="cursor: pointer; cursor: hand; width: 50px;"
							onclick="javascript:Calendar.ChangeData(kernel.dge('diasemana_anterior').title);"
							title="2"></td>
						<td align="center"><b style="font-size: 14px;"><span
							id="diasemana"
							title="<?=date ( 'w', (mktime ( 0, 0, 0, $m1, $d1, $a1 )) - 1 );?>"><?=$dias [date ( 'w', mktime ( 0, 0, 0, $m1, $d1, $a1 ) )]?></span>,
						<span id="dia" title="<?=$d1;?>"><?=$d1;?></span> de <span
							id="mes" title="<?=$m1;?>"><?=$meses [$m1];?></span> de <span
							id="ano" title="<?=$a1;?>"><?=$a1?></span></b></td>
						<td align="right" width="50"><input type="button" value="dia +"
							id="diasemana_proximo" class="botao"
							style="cursor: pointer; cursor: hand; width: 50px;"
							onclick="javascript:Calendar.ChangeData(kernel.dge('diasemana_proximo').title);"
							title="1"></td>
						<td align="right" width="50"><input type="button" value="m�s +"
							class="botao" style="cursor: pointer; cursor: hand; width: 50px;"
							onclick="javascript:Calendar.ChangeData(3);"></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td style="border-bottom: 1px solid #c0c0c0;"></td>
			</tr>
			<tr>
				<td>

				<div id="calendario_dia"
					style="overflow: auto; height: 290px; display: block;">
				<table width="100%" cellspacing="0" cellpadding="0">
								<?
								for($i = 0; $i < 24; $i ++) {
									?>
								<tr>
						<td height="25">
						<div id="diahora_<?=$i;?>"
							style="float: left; margin-left: 10px; margin-right: 20px;"><b style="color:<?=$_CONF ['btn_normal'];?>"><?=($i < 10) ? '0' . $i : $i;?>:00</b></div>
						<div id="registro_<?=$i;?>" style="float: left"></div>
						</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid #c0c0c0;"></td>
					</tr>
								<?
								}
								?>
							</table>
				</div>

				<div id="calendario_semana"
					style="overflow: auto; height: 266px; display: none;">
				<table width="100%" cellspacing="0" cellpadding="0">
					<tr>
								<?
								for($i = 0; $i < 7; $i ++) {
									?>
									<td height="260" width="96"
							<?=($i < 6) ? 'style="border-right:1px solid #c0c0c0;"' : '';?>
							valign="top">
						<table width="100%">
							<tr>
								<td align="center">
								<div id="dia"><b style="color:<?=$_CONF ['btn_normal'];?>"><?=$dias [$i];?></b></div>
								</td>
							</tr>
							<tr>
								<td style="border-bottom: 1px solid #c0c0c0;"></td>
							</tr>
							<tr>
								<td align="right">
								<div id="diahora_<?=$i;?>"><?=date ( 'd' );?></div>
								</td>
							</tr>
							<tr>
								<td>
								<div id="registro_<?=$i;?>"
									style="float: left; margin-left: 10px; margin-right: 20px;"><b style="color:<?=$_CONF ['btn_normal'];?>"><?=($i < 10) ? '0' . $i : $i;?>:00</b></div>
								</td>
							</tr>
						</table>
						</td>
								<?
								}
								?>
								
					
					
					<tr>
						<td colspan="7" style="border-bottom: 1px solid #c0c0c0;"></td>
					</tr>
				</table>
				</div>

				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>