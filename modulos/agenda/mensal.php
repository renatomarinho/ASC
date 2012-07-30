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

$db = new db ( );
$db->connect ();

ob_start ();

if (isset ( $_REQUEST ['a'] ) && $_REQUEST ['a'])
	$a = $_REQUEST ['a'];
else
	$a = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) );
if (isset ( $_REQUEST ['i'] ) && $_REQUEST ['i'])
	$i = $_REQUEST ['i'];
else
	$i = 0;
if (isset ( $_REQUEST ['t'] ) && $_REQUEST ['t'])
	$t = $_REQUEST ['t'];
else
	$t = 0;
?>
<table width="100%">
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td colspan="2" class="lbx">
		<table width="100%">
			<tr>
				<td align="left" width="50"><input type="button" value="- ano"
					class="botao" style="cursor: pointer; cursor: hand; width: 50px;"
					onclick="javascript:Calendar.Monthly(<?=mktime ( 0, 0, 0, gmdate ( 'm', $a ), gmdate ( 'd', $a ), gmdate ( 'Y', $a ) - 1 );?>);"></td>
				<td align="left" width="50"><input type="button" value="- m�s"
					id="diasemana_anterior" class="botao"
					style="cursor: pointer; cursor: hand; width: 50px;"
					onclick="javascript:Calendar.Monthly(<?=mktime ( 0, 0, 0, gmdate ( 'm', $a ) - 1, gmdate ( 'd', $a ), gmdate ( 'Y', $a ) );?>);"></td>
				<td align="center"><b style="font-size: 14px;"><?=$meses [date ( 'n', $a )];?>, <?=date ( 'Y', $a )?></b></td>
				<td align="right" width="50"><input type="button" value="m�s +"
					id="diasemana_proximo" class="botao"
					style="cursor: pointer; cursor: hand; width: 50px;"
					onclick="javascript:Calendar.Monthly(<?=mktime ( 0, 0, 0, gmdate ( 'm', $a ) + 1, gmdate ( 'd', $a ), gmdate ( 'Y', $a ) );?>);"></td>
				<td align="right" width="50"><input type="button" value="ano +"
					class="botao" style="cursor: pointer; cursor: hand; width: 50px;"
					onclick="javascript:Calendar.Monthly(<?=mktime ( 0, 0, 0, gmdate ( 'm', $a ), gmdate ( 'd', $a ), gmdate ( 'Y', $a ) + 1 );?>);"></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">

			<?
			$theDate = getdate ();
			$mon = gmdate ( 'm', $a );
			$month = gmdate ( 'M', $a );
			$year = gmdate ( 'Y', $a );
			
			if ($action = "findDate") {
				$theDate = getdate ( mktime ( 0, 0, 0, $mon, 1, $year ) );
				$month = $theDate ["month"];
			}
			
			$tempDate = getdate ( mktime ( 0, 0, 0, $mon, 1, $year ) );
			$firstwday = $tempDate ["wday"];
			
			$cont = true;
			$tday = 27;
			while ( ($tday <= 32) && ($cont) ) {
				$tdate = getdate ( mktime ( 0, 0, 0, $mon, $tday, $year ) );
				if ($tdate ["mon"] != $mon) {
					$lastday = $tday - 1;
					$cont = false;
				}
				$tday ++;
			}
			?>
			<table width="100%">
			<tr>
				<td width="14%" bgcolor="#f0f0f0" align="center"
					style="height: 25px;">
				<p class="tall">Domingo</p>
				</td>
				<td width="14%" align="center">
				<p class="tall">Segunda</p>
				</td>
				<td width="14%" bgcolor="#f0f0f0" align="center">
				<p class="tall">Ter�a</p>
				</td>
				<td width="14%" align="center">
				<p class="tall">Quarta</p>
				</td>
				<td width="14%" bgcolor="#f0f0f0" align="center">
				<p class="tall">Quinta</p>
				</td>
				<td width="14%" align="center">
				<p class="tall">Sexta</p>
				</td>
				<td width="14%" bgcolor="#f0f0f0" align="center">
				<p class="tall">S�bado</p>
				</td>
			</tr>
			<?
			$d = 1;
			$thisDay = gmdate ( 'd', $a );
			$thisMon = gmdate ( 'm', $a );
			$thisMonth = gmdate ( 'F', $a );
			$thisYear = gmdate ( 'Y', $a );
			$wday = $firstwday;
			$firstweek = true;
			
			while ( $d <= $lastday ) {
				
				if ($firstweek) {
					echo "<tr>";
					for($i = 1; $i <= $firstwday; $i ++) {
						echo "<td>  </td>";
					}
					$firstweek = false;
				}
				
				if ($wday == 0) {
					echo "<tr>";
				}
				
				$height_day = "50";
				if ((($firstwday == 5 || $firstwday == 6) && $lastday == 31) || ($firstwday == 6 && $lastday == 30)) {
					$height_day = "40";
				}
				
				$diainicio = mktime ( 0, 0, 0, $thisMon, $d, $thisYear );
				$diafinal = mktime ( 24, 0, 0, $thisMon, $d, $thisYear );
				
				$sql = "SELECT idagendaeventos, inicio, final, tarefa, status FROM rvs_agendaeventos WHERE inicio>" . $diainicio . " AND final<" . $diafinal . "";
				$query = $db->query ( $sql );
				
				$total = 0;
				if ($db->num_rows ( $query ) > 0) {
					$total = $db->num_rows ( $query );
				}
				
				echo "<td onmouseover=\"this.bgColor='#eeeeee'\" onmouseout=\"this.bgColor='" . ((($d == $thisDay) && ($mon == $thisMon)) ? (($total == 0) ? '#f0f0f0' : '#e6edf4') : '#ffffff') . "'\" style=\"cursor:hand;cursor:pointer;border:1px solid #c0c0c0;height:{$height_day}px;\"";
				if (($d == $thisDay) && (gmdate ( 'n' ) == $thisMon) && (gmdate ( 'Y' ) == $thisYear)) {
					echo " bgcolor=\"" . (($total == 0) ? '#f0f0f0' : '#e6edf4') . "\"";
				}
				echo " valign=\"top\" onclick=\"javascript:Calendar.Daily(" . $d . "," . $thisMon . "," . $thisYear . ");Calendar.ScreenMode();\"><p class=\"b\">" . $d . "</p><p id=\"prof\" style='text-align:center;'>";
				if ($total > 0) {
					echo '<a href="javascript:;" class="lnk">' . $total . ' evento' . (($total > 1) ? 's' : '') . '</a>';
				}
				echo "</p></td>";
				
				if ($wday == 6) {
					echo "</tr>\n";
        		}


		        $wday++;
		        $wday = $wday % 7;
		        $d++;
    		}
    		?>
    		</table>
		</td>
	</tr>
</table>