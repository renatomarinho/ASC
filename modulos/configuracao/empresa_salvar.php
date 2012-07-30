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

$validations = new validations ( );
$db = new db ( );
$db->connect ();

$cnpj = $validations->validStringForm ( $_POST ['cnpj'] );
$ie = $validations->validStringForm ( $_POST ['ie'] );
$endereco = $validations->validStringForm ( $_POST ['endereco'] );
$bairro = $validations->validStringForm ( $_POST ['bairro'] );
$cidade = $validations->validStringForm ( $_POST ['cidade'] );
$estado = $validations->validStringForm ( $_POST ['estado'] );
$cep = $validations->validStringForm ( $_POST ['cep'] );
$tel = $validations->validStringForm ( $_POST ['tel'] );
$fax = $validations->validStringForm ( $_POST ['fax'] );
$email = $validations->validStringForm ( $_POST ['email'] );
$site = $validations->validStringForm ( $_POST ['site'] );
$filiais = ($validations->validNumeric ( $_POST ['filiais'] ) < 1) ? 1 : $validations->validNumeric ( $_POST ['filiais'] );
$qtdturnos = ($validations->validNumeric ( $_POST ['qtdturnos'] ) < 1) ? 1 : $validations->validNumeric ( $_POST ['qtdturnos'] );
$qtdterminais = ($validations->validNumeric ( $_POST ['qtdterminais'] ) < 1) ? 1 : $validations->validNumeric ( $_POST ['qtdterminais'] );

$sql = "UPDATE cad_empresa SET cnpj = '$cnpj', ie = '$ie', endereco = '$endereco', bairro = '$bairro', cidade = '$cidade', uf = '$estado', cep  = '$cep', telefone = '$tel', fax = '$fax', email = '$email', site = '$site', qtd_turnos = '$qtdturnos', qtd_terminal = '$qtdterminais', filiais=" . $filiais . " WHERE id = 1 LIMIT 1 ;";
$db->query ( $sql );

echo $_CONF['lang']['empresa_salvar'][0];

?>