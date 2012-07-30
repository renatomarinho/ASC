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

$idfornecedor = $validations->validNumeric ( $_POST ['id'] );

if (isset ( $_POST ['nomefornec'] ))
	$txtnome = strtoupper ( $validations->validStringForm ( $_POST ['nomefornec'] ) );
if (isset ( $_POST ['cpf'] ))
	$cnpj = $validations->validNumeric ( $_POST ['cpf'] );
if (isset ( $_POST ['estado'] ))
	$txtuf = $validations->validStringForm ( $_POST ['estado'] );
if (isset ( $_POST ['cidade'] ))
	$txtcidade = strtoupper ( $validations->validStringForm ( $_POST ['cidade'] ) );
if (isset ( $_POST ['endereco'] ))
	$txtendereco = strtoupper ( $validations->validStringForm ( $_POST ['endereco'] ) );
if (isset ( $_POST ['contato'] ))
	$txtcontato = strtoupper ( $validations->validStringForm ( $_POST ['contato'] ) );
if (isset ( $_POST ['email'] ))
	$txtemail = strtolower ( $validations->validStringForm ( $_POST ['email'] ) );
if (isset ( $_POST ['telefone'] ))
	$txttelefone = $validations->validNumeric ( $_POST ['telefone'] );
if (isset ( $_POST ['fax'] ))
	$txtfax = $validations->validNumeric ( $_POST ['fax'] );
if (isset ( $_POST ['idenest'] ))
	$ie = $validations->validNumeric ( $_POST ['idenest'] );
if (isset ( $_POST ['cep'] ))
	$txtcep = $validations->validNumeric ( $_POST ['cep'] );
if (isset ( $_POST ['bairro'] ))
	$txtbairro = strtoupper ( $validations->validStringForm ( $_POST ['bairro'] ) );
if (isset ( $_POST ['pais'] ))
	$pais = $validations->validNumeric ( $_POST ['pais'] );

$sql = "UPDATE fornecedor SET nome='" . strtoupper ( $txtnome ) . "', cnpj='" . $cnpj . "', uf='" . $txtuf . "', cidade='" . $txtcidade . "', endereco='" . $txtendereco . "', contato='" . $txtcontato . "', email='" . $txtemail . "', telefone='" . $txttelefone . "', fax='" . $txtfax . "', ie='" . $ie . "', cep='" . $txtcep . "', bairro='" . $txtbairro . "', idpais=" . $pais . " WHERE idfornecedor=" . $idfornecedor . "";
$db->query ( $sql );

?>