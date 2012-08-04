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

ob_start();

require "config/default.php";

$db = new db();
$db->connect();

$validations = new validations();

?>

<?
if (isset($_SESSION['nomeuser'])) {
	header("Location: index.php");
} else if (isset($_POST) && isset($_POST['usuario_1']) && isset($_POST['senha_1'])) {

    
	$user = $validations->validStringForm(strtoupper($_POST['usuario_1']));
	$senha = md5($_POST['senha_1']);
	$sql = 'SELECT id, autoriza FROM cad_login WHERE ativo = \'ativo\' AND login = \''.$user.'\' AND senha = \''.$senha.'\' LIMIT 1';
	$query = $db->query($sql);
	$row = $db->fetch_assoc($query);
	if ($row['id'] >= 1) {
		$_SESSION['nomeuser'] = $user;
		$_SESSION['idlogin'] = $row['id'];
		$_SESSION['autoriza'] = $row['autoriza'];
		
		$sql = "SELECT turno FROM mv_caixa WHERE fechamento<0 ORDER BY abertura DESC";
		$queryturno = $db->query($sql);
		if ( $db->num_rows($queryturno) ){
			$rowturno = $db->fetch_assoc($queryturno); 
			$_SESSION['turno'] = $rowturno['turno'];
		}		
		$sql = "INSERT INTO log_login (cad_login_id, datalog) VALUES (".$row['id'].", ".strtotime('now').")";
		$db->query($sql);
		Header('Location: index.php');
	} else {
		echo '<SCRIPT>alert(\'Por favor, preencha os dados de acesso coretamente\');document.location=\'index.php\'</SCRIPT>';
	}
	
} 

?>
