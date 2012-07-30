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

$retirados = $validations->validNumeric ( $_GET ['retirados'] );

$id = $validations->validStringForm ( $_GET ['id'] );
$idgrade = $validations->validStringForm ( $_GET ['idgrade'] );
$total = $validations->validStringForm ( $_GET ['total'] );

?>
<table>
	<tr>
		<td><b style="color: blue">Para retirar "<?=$retirados;?> ite<?=($retirados > 1) ? 'ns' : 'm'?>" do estoque, confirme os dados :</b></td>
	</tr>
	<tr>
		<td height="20">
		<table>
			<tr>
				<td><select id="idusuario" style="width: 140px;">
					<option value="">Selecione o usu�rio</option>
							<?
							$sql = "SELECT id, nome FROM cad_login WHERE ativo='ativo'";
							$query = $db->query ( $sql );
							while ( $row = $db->fetch_assoc ( $query ) ) {
								?>
							<option value="<?=$row ['id'];?>"><?=ucwords ( strtolower ( $row ['nome'] ) );?></option>
							<?
							}
							?>
						</select></td>
				<td width="5"></td>
				<td><input type="text" id="pwdusuario" value="digite sua senha" onfocus="javascript:troca_textpwd('pwdusuario');" style="color: #c0c0c0; width: 100px;" /></td>
				<td width="5"></td>
				<td><input type="button" class="botao green" value="ok" style="width: 25px;" onclick="javascript:Product.SubtractGradeItemWithAuthConfirm('<?=$id;?>', '<?=$idgrade;?>', '<?=$total;?>', '<?=$retirados;?>');" /></td>
				<td><input type="button" class="botao red" value="cancelar" style="width: 60px;" onclick="javascript:Product.ReturnGradeList('<?=$id;?>', '<?=$idgrade;?>', '<?=$total;?>');" /></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td><span id="msgautentica_gradeerro"></span></td>
	</tr>
</table>