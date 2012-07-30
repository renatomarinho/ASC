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

$_SESSION ['produto']['nome'] = strtoupper($validations->validStringForm($_POST['nome']));
$_SESSION ['produto']['codigo'] = strtoupper($validations->validStringForm($_POST['codigo']));
$_SESSION ['produto']['vlcusto'] = $validations->validStringForm($_POST['vlcusto']);
$_SESSION ['produto']['vlpentrega'] = $validations->validStringForm($_POST['vlpentrega']);
$_SESSION ['produto']['vlatacado'] = $validations->validStringForm($_POST['vlatacado']);
$_SESSION ['produto']['vlvarejo'] = $validations->validStringForm($_POST['vlvarejo']);
$_SESSION ['produto']['qtdestoque'] = $validations->validStringForm($_POST['qtdestoque']);
$_SESSION ['produto']['categoria'] = $validations->validNumeric($_POST['categoria']);
$_SESSION ['produto']['fornecedor'] = $validations->validNumeric($_POST['fornecedor']);
$_SESSION ['produto']['colecao'] = $validations->validNumeric($_POST['colecao']);
$_SESSION ['produto']['codbarra'] = $validations->validNumeric($_POST['codbarra']);

?>