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

if (isset ( $_POST ['idcliente'] )) {
	
	$idcliente = $validations->validNumeric ( $_POST ['idcliente'] );
	
	$nome = strtoupper ( $validations->validStringForm ( $_POST ['nome'] ) );
	$endereco = strtoupper ( $validations->validStringForm ( $_POST ['endereco'] ) );
	$bairro = strtoupper ( $validations->validStringForm ( $_POST ['bairro'] ) );
	$cidade = strtoupper ( $validations->validStringForm ( $_POST ['cidade'] ) );
	$estado = strtoupper ( $validations->validStringForm ( $_POST ['estado'] ) );
	$dddtel = $validations->validNumeric ( $_POST ['dddtel'] );
	$tel1 = $validations->validNumeric ( $_POST ['tel1'] );
	$tel2 = $validations->validNumeric ( $_POST ['tel2'] );
	$dddcel = $validations->validNumeric ( $_POST ['dddcel'] );
	$cel1 = $validations->validNumeric ( $_POST ['cel1'] );
	$cel2 = $validations->validNumeric ( $_POST ['cel2'] );
	$cep = $validations->validNumeric ( $_POST ['cep'] . $_POST ['cepdv'] );
	$email = strtolower ( $validations->validStringForm ( $_POST ['email'] ) );
	$cpf = $validations->validStringForm ( $_POST ['cpf'] );
	
	$cpf = str_replace ( '.', '', str_replace ( '-', '', $cpf ) );
	
	$identidade = $validations->validStringForm ( $_POST ['identidade'] );
	$infoadd = nl2br ( strtoupper ( $validations->validStringForm ( $_POST ['infoadd'] ) ) );
	
	if ($_POST ['mes'] > 0) {
		$dataniver = date ( 'Y' ) . '-' . $_POST ['mes'] . '-' . $_POST ['dia'];
		$dataniver = " dtaniversario='" . $dataniver . "', ";
	} else {
		$dataniver = "";
	}
	
	$telefone = str_pad ( str_replace ( '-', '', $dddtel . $tel1 . $tel2 ), 10, '0', STR_PAD_LEFT );
	$celular = str_pad ( str_replace ( '-', '', $dddcel . $cel1 . $cel2 ), 10, '0', STR_PAD_LEFT );
	
	$sql = "UPDATE cliente SET txtcep='" . $cep . "', txtnome='" . $nome . "', txtendereco='" . $endereco . "', txtbairro='" . $bairro . "', txtcidade='" . $cidade . "', txtuf='" . $estado . "', txttelefone='" . $dddtel . $tel1 . $tel2 . "', txtcelular='" . $dddcel . $cel1 . $cel2 . "', txtemail='" . $email . "', txtcpf='" . $cpf . "', " . $dataniver . " txtrg='" . $identidade . "', txtinf_adicional='" . $infoadd . "' WHERE idcliente=" . $idcliente . " ";
	
	if ($db->query ( $sql )) {
		echo "CLIENTE EDITADO COM SUCESSO|" . $idcliente;
	} else {
		echo "Ocorreu um erro, por favor tente novamente|" . $idcliente;
	}
}

?>