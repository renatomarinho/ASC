<?php
require_once ("../../../include/class/dompdf/dompdf_config.inc.php");
if (isset ( $_REQUEST ["content"] )) {
	
	if (get_magic_quotes_gpc ())
		$_REQUEST ["content"] = stripslashes ( $_REQUEST ["content"] );
	
	$old_limit = ini_set ( "memory_limit", "26M" );
	
	$dompdf = new DOMPDF ( );
	$dompdf->load_html ( $_REQUEST ["content"] );
	$dompdf->set_paper ( $_REQUEST ["paper"], $_REQUEST ["orientation"] );
	$dompdf->render ();
	
	$dompdf->stream ( (isset ( $_REQUEST ["file_name"] ) ? $_REQUEST ["file_name"] : "relatorio") . ".pdf" );
	
	exit ( 0 );
}

?>