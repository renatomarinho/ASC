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


class db {
	
	var $link;
	
	function connect() {

	    global $_CONF;
	    
	    $this->link = mysql_connect ( $_CONF['database_host'], $_CONF['database_username'], $_CONF['database_password'], true, 0 );
		mysql_select_db ( $_CONF['database_name'], $this->link );
	}
	
	function errno() {
		return mysql_errno ( $this->link );
	}
	
	function error() {
		return mysql_error ( $this->link );
	}
	
	function escape_string($string) {
		return mysql_real_escape_string ( $string );
	}
	
	function query($query) {
		return mysql_query ( $query, $this->link );
	}
	
	function fetch_array($result, $array_type = MYSQL_BOTH) {
		return mysql_fetch_array ( $result, $array_type );
	}
	
	function fetch_row($result) {
		return mysql_fetch_row ( $result );
	}
	
	function fetch_assoc($result) {
		return mysql_fetch_assoc ( $result );
	}
	
	function fetch_object($result) {
		return mysql_fetch_object ( $result );
	}
	
	function num_rows($result) {
		return mysql_num_rows ( $result );
	}
	
	function insert_id() {
		return mysql_insert_id ( $this->link );
	}
	
	function close() {
		return mysql_close ( $this->link );
	}
	
	function data_seek($result, $line) {
		return mysql_data_seek ( $result, $line );
	}
	
/*
	$db = new db; 
	$db->connect('host', 'username', 'password'); 
	$result = $db->query("SELECT username FROM users"); 
	while($row = $db->fetch_assoc($result)) { 
		echo($row['username']); 
	} 
*/

}
?>
