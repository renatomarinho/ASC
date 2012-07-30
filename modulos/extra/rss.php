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

class lastRSS {
	var $default_cp = 'UTF-8';
	var $CDATA = 'nochange';
	var $cp = '';
	var $items_limit = 0;
	var $stripHTML = False;
	var $date_format = '';
	
	var $channeltags = array ('' );
	var $itemtags = array ('title', 'link', 'pubDate' );
	var $imagetags = array ('' );
	var $textinputtags = array ('title', 'description', 'name', 'link', 'guid' );
	
	function Get($rss_url) {
		if ($this->cache_dir != '') {
			$cache_file = $this->cache_dir . '/rsscache_' . md5 ( $rss_url );
			$timedif = @(time () - filemtime ( $cache_file ));
			if ($timedif < $this->cache_time) {
				$result = unserialize ( join ( '', file ( $cache_file ) ) );
				if ($result)
					$result ['cached'] = 1;
			} else {
				$result = $this->Parse ( $rss_url );
				$serialized = serialize ( $result );
				if ($f = @fopen ( $cache_file, 'w' )) {
					fwrite ( $f, $serialized, strlen ( $serialized ) );
					fclose ( $f );
				}
				if ($result)
					$result ['cached'] = 0;
			}
		} else {
			$result = $this->Parse ( $rss_url );
			if ($result)
				$result ['cached'] = 0;
		}
		// return result
		return $result;
	}
	
	function my_preg_match($pattern, $subject) {
		preg_match ( $pattern, $subject, $out );
		
		if (isset ( $out [1] )) {
			if ($this->CDATA == 'content') {
				$out [1] = strtr ( $out [1], array ('<![CDATA[' => '', ']]>' => '' ) );
			} elseif ($this->CDATA == 'strip') {
				$out [1] = strtr ( $out [1], array ('<![CDATA[' => '', ']]>' => '' ) );
			}
			
			if ($this->cp != '')
				$out [1] = iconv ( $this->rsscp, $this->cp . '//TRANSLIT', $out [1] );
			return trim ( $out [1] );
		} else {
			return '';
		}
	}
	
	function unhtmlentities($string) {
		$trans_tbl = get_html_translation_table ( HTML_ENTITIES, ENT_QUOTES );
		$trans_tbl = array_flip ( $trans_tbl );
		$trans_tbl += array ('&apos;' => "'" );
		return strtr ( $string, $trans_tbl );
	}
	
	function Parse($rss_url) {
		if ($f = @fopen ( $rss_url, 'r' )) {
			$rss_content = '';
			while ( ! feof ( $f ) ) {
				$rss_content .= fgets ( $f, 4096 );
			}
			fclose ( $f );
			
			$result ['encoding'] = $this->my_preg_match ( "'encoding=[\'\"](.*?)[\'\"]'si", $rss_content );
			if ($result ['encoding'] != '') {
				$this->rsscp = $result ['encoding'];
			} else {
				$this->rsscp = $this->default_cp;
			}
			
			preg_match ( "'<channel.*?>(.*?)</channel>'si", $rss_content, $out_channel );
			foreach ( $this->channeltags as $channeltag ) {
				$temp = $this->my_preg_match ( "'<$channeltag.*?>(.*?)</$channeltag>'si", $out_channel [1] );
				if ($temp != '')
					$result [$channeltag] = $temp;
			}
			
			if ($this->date_format != '' && ($timestamp = strtotime ( $result ['lastBuildDate'] )) !== - 1) {
				
				$result ['lastBuildDate'] = date ( $this->date_format, $timestamp );
			}
			
			preg_match ( "'<textinput(|[^>]*[^/])>(.*?)</textinput>'si", $rss_content, $out_textinfo );
			if (isset ( $out_textinfo [2] )) {
				foreach ( $this->textinputtags as $textinputtag ) {
					$temp = $this->my_preg_match ( "'<$textinputtag.*?>(.*?)</$textinputtag>'si", $out_textinfo [2] );
					if ($temp != '')
						$result ['textinput_' . $textinputtag] = $temp;
				}
			}
			preg_match ( "'<image.*?>(.*?)</image>'si", $rss_content, $out_imageinfo );
			if (isset ( $out_imageinfo [1] )) {
				foreach ( $this->imagetags as $imagetag ) {
					$temp = $this->my_preg_match ( "'<$imagetag.*?>(.*?)</$imagetag>'si", $out_imageinfo [1] );
					if ($temp != '')
						$result ['image_' . $imagetag] = $temp;
				}
			}
			preg_match_all ( "'<item(| .*?)>(.*?)</item>'si", $rss_content, $items );
			$rss_items = $items [2];
			$i = 0;
			$result ['items'] = array ();
			
			foreach ( $rss_items as $rss_item ) {
				if ($i < $this->items_limit || $this->items_limit == 0) {
					foreach ( $this->itemtags as $itemtag ) {
						$temp = $this->my_preg_match ( "'<$itemtag.*?>(.*?)</$itemtag>'si", $rss_item );
						if ($temp != '')
							$result ['items'] [$i] [$itemtag] = $temp;
					}
					
					if ($this->stripHTML && $result ['items'] [$i] ['description'])
						$result ['items'] [$i] ['description'] = strip_tags ( $this->unhtmlentities ( strip_tags ( $result ['items'] [$i] ['description'] ) ) );
					
					if ($this->stripHTML && $result ['items'] [$i] ['guid'])
						$result ['items'] [$i] ['guid'] = strip_tags ( $this->unhtmlentities ( strip_tags ( $result ['items'] [$i] ['guid'] ) ) );
					
					if ($this->stripHTML && $result ['items'] [$i] ['title'])
						$result ['items'] [$i] ['title'] = strip_tags ( $this->unhtmlentities ( strip_tags ( $result ['items'] [$i] ['title'] ) ) );
					
					if ($this->date_format != '' && ($timestamp = strtotime ( $result ['items'] [$i] ['pubDate'] )) !== - 1) {
						$result ['items'] [$i] ['pubDate'] = date ( $this->date_format, $timestamp );
					}
					$i ++;
				}
			}
			
			$result ['items_count'] = $i;
			return $result;
		} else {
			return False;
		}
	}
}

?>