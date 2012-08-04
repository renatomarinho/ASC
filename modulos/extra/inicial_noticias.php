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
$validations = new validations ( );
$db = new db ( );
$db->connect ();

$data_inicial = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) );
$data_final = mktime ( 23, 59, 59, date ( 'm' ), date ( 'd' ), date ( 'Y' ) );

$sql = "SELECT idagendaeventos FROM rvs_agendaeventos WHERE inicio>" . $data_inicial . " AND final<" . $data_final . "";
$query = $db->query ( $sql );
$total = $db->num_rows ( $query );
?>


<fieldset id="p"><legend>Notécias Recentes</legend>

<div class="linha_separador ls_conf_P" style="height: 75px">

<table width="100%">
	<tr>
		<td>
		<table>
			<tr>
				<td><img
					src="<?=$_CONF ['PATH_VIRTUAL'];?>imgs/icons/noticias_72.png"
					class="t72"></td>
				<td width="10"></td>
				<td><b>Noticias</b> <br />
				<!--								�ltima atualiza��o realizada em xx/xx �s xx:xx--></td>
			</tr>
		</table>
		</td>
	</tr>
</table>

</div>

<div>

<table>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td>
				<?
				/*
				  include 'rss.php';
				  define(RSS_FEED, 'http://rss.terra.com.br/0,,EI1119,00.xml');

				  $rss = new lastRSS;

				  $rss->cache_dir = '/include/rss';
				  $rss->cache_time = 3600; // one hour

				  if ($rs = $rss->get(RSS_FEED)) {
				  	$news = '';
				  	$i = 0;

				  	foreach ($rs as $value)
				  	{
				  		if (is_array($value))
				  		{
					  		foreach ( $value as $value2)
					  		{
					  			$titulo = str_replace('<![CDATA[', '', $value2['title']);
					  			$titulo = str_replace(']]>', '', $titulo);

					  			$data = substr($value2['pubDate'], 17);
					  			$data = substr($data, 0, -6);

					  			$news .= "<p><a href=\"" . $value2['link'] . "\" target=\"_blank\"><b>" . $data . " - " . $titulo . "</b></a></p><br>";
					  			$i++;
					  			if ( $i > 7 ){
					  				break;
					  			}
							}
				  		}
				  	}
				  	echo $news;
				  }
				  else {
				  	die ('<?=$Noticias_indisponiveis;?>');
				  }
				*/
				?>
				</td>
	</tr>

</table>

</div>

</fieldset>