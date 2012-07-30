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


function formata_telefone($telef) {
	$telef = str_pad ( str_replace ( '-', '', $telef ), 10, '0', STR_PAD_LEFT );
	return '(' . substr ( $telef, 0, 2 ) . ') ' . substr ( $telef, 2, 4 ) . '-' . substr ( $telef, 6, 4 );
}

function qtdCaracteres($string, $nCaracteres) {
	$totalL = strlen ( $string );
	if ($totalL > $nCaracteres) {
		$string = substr ( $string, 0, $nCaracteres );
		$string = $string . "...";
	}
	return $string;
}

function permite($user, $perm) {
	
	$db = new db ( );
	$db->connect ();
	$clas = '%%%%%%%%%%%%%%%%%%%%%%%%%';
	$clas = substr_replace ( $clas, '1', $perm, 1 );
	$clas = str_replace ( '1', '[1]', $clas );
	$clas = str_replace ( '%', '[01]', $clas );
	$sql = 'SELECT * FROM `cad_login` WHERE `login` = \'' . $user . '\' AND `autoriza` REGEXP \'' . $clas . '\'';
	$result = $db->num_rows ( $db->query ( $sql ) );
	if ($result > 0)
		return TRUE;
	else
		return FALSE;
}

function numero_extenso($numero, $diff = 0) {
	$many = array ('', ' mil ', ' milh�es ', ' bilh�es ' );
	
	$numero = strval ( $numero );
	$saida = "";
	
	if (strlen ( $numero ) % 3 != 0) {
		$saida .= cada3 ( substr ( $numero, 0, strlen ( $numero ) % 3 ) );
		$saida .= $many [floor ( strlen ( $numero ) / 3 )];
	}
	
	for($i = 0; $i < floor ( strlen ( $numero ) / 3 ); $i ++) {
		$saida .= cada3 ( substr ( $numero, strlen ( $numero ) % 3 + ($i * 3), 3 ) );
		if ($numero [strlen ( $numero ) % 3 + ($i * 3)] != 0) {
			$saida .= $many [floor ( strlen ( $numero ) / 3 ) - 1 - $i];
		}
	}
	
	if ($diff == 0) {
		$match = array ('/um mil /', '/um milh�es/', '/um bilh�es/', '/ +/', '/ $/', '/ /', '/e mil/', '/e bil/', '/dois/', '/um/' );
		$replace = array ('mil ', 'um milh�o', 'um bilh�o', ' ', '', ' e ', ' mil', ' bil', 'duas', 'uma' );
	} else {
		$match = array ('/um mil /', '/um milh�es/', '/um bilh�es/', '/ +/', '/ $/', '/ /', '/e mil/', '/e bil/' );
		$replace = array ('mil ', 'um milh�o', 'um bilh�o', ' ', '', ' e ', ' mil', ' bil' );
	}
	$saida = preg_replace ( $match, $replace, $saida );
	
	return $saida;
}

function cada3($numero) {
	$unidades = array ('um', 'dois', 'tr�s', 'quatro', 'cinco', 'seis', 'sete', 'oito', 'nove' );
	$dez = array ('onze', 'doze', 'treze', 'catorze', 'quinze', 'dezesseis', 'dezessete', 'dezoito', 'dezenove' );
	$dezenas = array ('dez', 'vinte', 'trinta', 'quarenta', 'cinq�enta', 'sessenta', 'setenta', 'oitenta', 'noventa' );
	$centenas = array ('cento ', 'duzentos ', 'trezentos ', 'quatrocentos ', 'quinhentos ', 'seiscentos ', 'setecentos ', 'oitocentos ', 'novecentos ' );
	
	$saida = "";
	$j = strlen ( $numero );
	$ok = false;
	for($i = 0; $i < strlen ( $numero ); $i ++) {
		if ($j == 2) {
			if ($numero [$i] == 1) {
				if ($numero [$i + 1] == 0)
					$saida .= $dezenas [$numero [$i] - 1];
				else {
					$saida .= $dez [$numero [$i + 1] - 1];
					$ok = true;
				}
			} else {
				if (! empty ( $dezenas [$numero [$i] - 1] ))
					$saida .= $dezenas [$numero [$i] - 1] . ' ';
			}
		} elseif (($numero [$i] != 0) and (! $ok) and ($j == 3) and ($numero [0] == 1) and ($numero [1] == 0) and ($numero [2] == 0))
			$saida .= "cem";
		elseif (($numero [$i] != 0) and (! $ok) and ($j == 3))
			$saida .= $centenas [$numero [0] - 1];
		elseif ($numero [$i] != 0 && ! $ok)
			$saida .= $unidades [$numero [$i] - 1];
		$j --;
	}
	return $saida;
}

function exibe_errohtml($mensagem) {
	
	$html = '<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">';
	$html .= '<tr>';
	$html .= '<td align=center>';
	$html .= '<img src="imgs/aviso.png">';
	$html .= '<BR>';
	$html .= '<b style=color:red>[ ' . $mensagem . ' ]</b>';
	$html .= '</td>';
	$html .= '</tr>';
	$html .= '<table>';
	
	return $html;

}

$dias = array ('Domingo', 'Segunda', 'Ter�a', 'Quarta', 'Quinta', 'Sexta', 'Sabado' );
$meses = array ('', 'Janeiro', 'Fevereiro', 'Mar�o', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro' );

/*
relat�rio compativo colecoes
*/
function titulo_selecionado($relatorio) {
	
	if ($relatorio == 1) {
		return utf8_encode ( 'Custo da Cole��o' );
	} else if ($relatorio == 2) {
		return 'Lucro Bruto ( R$ )';
	} else if ($relatorio == 3) {
		return 'Itens em Estoque';
	} else if ($relatorio == 4) {
		return 'Valor das Vendas';
	} else if ($relatorio == 5) {
		return 'Quantidade de Produtos';
	} else if ($relatorio == 6) {
		return 'Lucro Bruto ( % )';
	} else if ($relatorio == 7) {
		return 'Itens Vendidos';
	} else if ($relatorio == 8) {
		return 'Valor Custo Vendas';
	}

}

function resultadorelatorio($valor, $relatorio) {
	
	$db = new db ( );
	$db->connect ();
	
	$vlcusto_colecao_vendas = 0;
	$vlcusto_colecao_atual = 0;
	$vlvarejo_atual = 0;
	$vlatacado_atual = 0;
	$quantidade_estoque_atual = 0;
	$quantidade_estoque_vendas = 0;
	$total_vlvarejo_vendas = 0;
	
	if ($relatorio == 1) {
		
		$sql = "SELECT idproduto, vlcusto, vlvarejo, vlatacado FROM produto WHERE colecao_idcolecao=" . $valor . "";
		$query = $db->query ( $sql );
		while ( $rowprodutos = $db->fetch_assoc ( $query ) ) {
			
			$quantidade_estoque_atual_multi = 0;
			
			$sql = "SELECT nquantidade FROM estoque WHERE produto_idproduto=" . $rowprodutos ['idproduto'] . "";
			$queryestoque = $db->query ( $sql );
			
			while ( $rowestoque = $db->fetch_assoc ( $queryestoque ) ) {
				$quantidade_estoque_atual += ( int ) $rowestoque ['nquantidade'];
				$vlcusto_colecao_atual += ($rowprodutos ['vlcusto'] * $rowestoque ['nquantidade']);
				$vlvarejo_atual += ($rowprodutos ['vlvarejo'] * $rowestoque ['nquantidade']);
				$vlatacado_atual += ($rowprodutos ['vlatacado'] * $rowestoque ['nquantidade']);
			}
			
			$sql = "SELECT id, vr_custo AS valor, quant, vr_total FROM mv_vendas_movimento WHERE id_produto=" . $rowprodutos ['idproduto'] . " AND estornado=0";
			$queryvenda = $db->query ( $sql );
			
			while ( $rowvenda = $db->fetch_assoc ( $queryvenda ) ) {
				$quantidade_estoque_vendas += ( int ) $rowvenda ['quant'];
				$valor_custo_venda = $rowvenda ['valor'];
				$valor_varejo_venda = $rowvenda ['vr_total'];
				$total_vlvarejo_vendas += $valor_varejo_venda * $rowvenda ['quant'];
				$vlcusto_colecao_vendas += $valor_custo_venda * $rowvenda ['quant'];
			}
		
		}
		
		$resultado = $vlcusto_colecao_atual + $vlcusto_colecao_vendas;
	
	} else if ($relatorio == 2) {
		
		$vlcusto_colecao_vendas = 0;
		$total_vlvarejo_vendas = 0;
		
		$sql = "SELECT idproduto, vlcusto, vlvarejo, vlatacado FROM produto WHERE colecao_idcolecao=" . $valor . "";
		$query = $db->query ( $sql );
		while ( $rowprodutos = $db->fetch_assoc ( $query ) ) {
			
			$sql = "SELECT id, vr_custo AS valor, quant, vr_total FROM mv_vendas_movimento WHERE id_produto=" . $rowprodutos ['idproduto'] . " AND estornado=0";
			$queryvenda = $db->query ( $sql );
			
			while ( $rowvenda = $db->fetch_assoc ( $queryvenda ) ) {
				$valor_custo_venda = $rowvenda ['valor'];
				$valor_varejo_venda = $rowvenda ['vr_total'];
				$total_vlvarejo_vendas += $valor_varejo_venda * $rowvenda ['quant'];
				$vlcusto_colecao_vendas += $valor_custo_venda * $rowvenda ['quant'];
			}
		
		}
		
		$resultado = $total_vlvarejo_vendas - $vlcusto_colecao_vendas;
	
	} else if ($relatorio == 3) {
		
		$sql = "SELECT idproduto, vlcusto, vlvarejo, vlatacado FROM produto WHERE colecao_idcolecao=" . $valor . "";
		$query = $db->query ( $sql );
		while ( $rowprodutos = $db->fetch_assoc ( $query ) ) {
			
			$quantidade_estoque_atual_multi = 0;
			
			$sql = "SELECT nquantidade FROM estoque WHERE produto_idproduto=" . $rowprodutos ['idproduto'] . "";
			$queryestoque = $db->query ( $sql );
			
			while ( $rowestoque = $db->fetch_assoc ( $queryestoque ) ) {
				$quantidade_estoque_atual = ( int ) $rowestoque ['nquantidade'];
			}
		
		}
		
		$resultado = $quantidade_estoque_atual;
	
	} else if ($relatorio == 4) {
		
		$total_vlvarejo_vendas = 0;
		
		echo $sql = "SELECT idproduto, vlcusto, vlvarejo, vlatacado FROM produto WHERE colecao_idcolecao=" . $valor . "";
		$query = $db->query ( $sql );
		while ( $rowprodutos = $db->fetch_assoc ( $query ) ) {
			
			$sql = "SELECT id, vr_custo AS valor, quant, vr_total FROM mv_vendas_movimento WHERE id_produto=" . $rowprodutos ['idproduto'] . " AND estornado=0";
			$queryvenda = $db->query ( $sql );
			
			while ( $rowvenda = $db->fetch_assoc ( $queryvenda ) ) {
				$valor_varejo_venda = $rowvenda ['vr_total'];
				$total_vlvarejo_vendas += $valor_varejo_venda * $rowvenda ['quant'];
			}
		
		}
		
		$resultado = $total_vlvarejo_vendas;
	
	} else if ($relatorio == 5) {
		
		$sql = "SELECT idproduto FROM produto WHERE colecao_idcolecao=" . $valor . "";
		$query = $db->query ( $sql );
		
		$resultado = $db->num_rows ( $query );
	
	} else if ($relatorio == 6) {
		
		$vlcusto_colecao_vendas = 0;
		$total_vlvarejo_vendas = 0;
		
		$sql = "SELECT idproduto, vlcusto, vlvarejo, vlatacado FROM produto WHERE colecao_idcolecao=" . $valor . "";
		$query = $db->query ( $sql );
		while ( $rowprodutos = $db->fetch_assoc ( $query ) ) {
			
			$sql = "SELECT id, vr_custo AS valor, quant, vr_total FROM mv_vendas_movimento WHERE id_produto=" . $rowprodutos ['idproduto'] . " AND estornado=0";
			$queryvenda = $db->query ( $sql );
			
			while ( $rowvenda = $db->fetch_assoc ( $queryvenda ) ) {
				$valor_custo_venda = $rowvenda ['valor'];
				$valor_varejo_venda = $rowvenda ['vr_total'];
				$total_vlvarejo_vendas += $valor_varejo_venda * $rowvenda ['quant'];
				$vlcusto_colecao_vendas += $valor_custo_venda * $rowvenda ['quant'];
			}
		
		}
		
		$lucro_vendas_real = $total_vlvarejo_vendas - $vlcusto_colecao_vendas;
		if ($lucro_vendas_real > 0)
			$resultado = ($lucro_vendas_real / $vlcusto_colecao_vendas) * 100;
		else
			$resultado = 0;
	
	} else if ($relatorio == 7) {
		
		$quantidade_estoque_vendas = 0;
		
		$sql = "SELECT idproduto, vlcusto, vlvarejo, vlatacado FROM produto WHERE colecao_idcolecao=" . $valor . "";
		$query = $db->query ( $sql );
		while ( $rowprodutos = $db->fetch_assoc ( $query ) ) {
			
			$sql = "SELECT quant FROM mv_vendas_movimento WHERE id_produto=" . $rowprodutos ['idproduto'] . " AND estornado=0";
			$queryvenda = $db->query ( $sql );
			
			while ( $rowvenda = $db->fetch_assoc ( $queryvenda ) ) {
				$quantidade_estoque_vendas += ( int ) $rowvenda ['quant'];
			}
		
		}
		
		$resultado = $quantidade_estoque_vendas;
	
	} else if ($relatorio == 8) {
		
		$vlcusto_colecao_vendas = 0;
		
		$sql = "SELECT idproduto, vlcusto, vlvarejo, vlatacado FROM produto WHERE colecao_idcolecao=" . $valor . "";
		$query = $db->query ( $sql );
		while ( $rowprodutos = $db->fetch_assoc ( $query ) ) {
			
			$sql = "SELECT id, vr_custo AS valor, quant, vr_total FROM mv_vendas_movimento WHERE id_produto=" . $rowprodutos ['idproduto'] . " AND estornado=0";
			$queryvenda = $db->query ( $sql );
			
			while ( $rowvenda = $db->fetch_assoc ( $queryvenda ) ) {
				$valor_custo_venda = $rowvenda ['valor'];
				$vlcusto_colecao_vendas += $valor_custo_venda * $rowvenda ['quant'];
			}
		
		}
		
		$resultado = $vlcusto_colecao_vendas;
	
	}
	
	return $resultado;

}

function titulo_selecionado_fornecedor($relatorio) {
	
	if ($relatorio == 1) {
		return utf8_encode ( 'Custo do Fornecedor' );
	} else if ($relatorio == 2) {
		return 'Lucro Bruto ( R$ )';
	} else if ($relatorio == 3) {
		return 'Itens em Estoque';
	} else if ($relatorio == 4) {
		return 'Valor das Vendas';
	} else if ($relatorio == 5) {
		return 'Quantidade de Produtos';
	} else if ($relatorio == 6) {
		return 'Lucro Bruto ( % )';
	} else if ($relatorio == 7) {
		return 'Itens Vendidos';
	} else if ($relatorio == 8) {
		return 'Valor Custo Vendas';
	}

}

function resultadorelatorio_fornecedor($valor, $relatorio) {
	
	$db = new db ( );
	$db->connect ();
	
	$vlcusto_fornecedor_vendas = 0;
	$vlcusto_fornecedor_atual = 0;
	$vlvarejo_atual = 0;
	$vlatacado_atual = 0;
	$quantidade_estoque_atual = 0;
	$quantidade_estoque_vendas = 0;
	$total_vlvarejo_vendas = 0;
	
	if ($relatorio == 1) {
		
		$sql = "SELECT idproduto, vlcusto, vlvarejo, vlatacado FROM produto WHERE fornecedor_idfornecedor=" . $valor . "";
		$query = $db->query ( $sql );
		while ( $rowprodutos = $db->fetch_assoc ( $query ) ) {
			
			$quantidade_estoque_atual_multi = 0;
			
			$sql = "SELECT nquantidade FROM estoque WHERE produto_idproduto=" . $rowprodutos ['idproduto'] . "";
			$queryestoque = $db->query ( $sql );
			
			while ( $rowestoque = $db->fetch_assoc ( $queryestoque ) ) {
				$quantidade_estoque_atual += ( int ) $rowestoque ['nquantidade'];
				$vlcusto_fornecedor_atual += ($rowprodutos ['vlcusto'] * $rowestoque ['nquantidade']);
				$vlvarejo_atual += ($rowprodutos ['vlvarejo'] * $rowestoque ['nquantidade']);
				$vlatacado_atual += ($rowprodutos ['vlatacado'] * $rowestoque ['nquantidade']);
			}
			
			$sql = "SELECT id, vr_custo AS valor, quant, vr_total FROM mv_vendas_movimento WHERE id_produto=" . $rowprodutos ['idproduto'] . " AND estornado=0";
			$queryvenda = $db->query ( $sql );
			
			while ( $rowvenda = $db->fetch_assoc ( $queryvenda ) ) {
				$quantidade_estoque_vendas += ( int ) $rowvenda ['quant'];
				$valor_custo_venda = $rowvenda ['valor'];
				$valor_varejo_venda = $rowvenda ['vr_total'];
				$total_vlvarejo_vendas += $valor_varejo_venda * $rowvenda ['quant'];
				$vlcusto_fornecedor_vendas += $valor_custo_venda * $rowvenda ['quant'];
			}
		
		}
		
		$resultado = $vlcusto_fornecedor_atual + $vlcusto_fornecedor_vendas;
	
	} else if ($relatorio == 2) {
		
		$vlcusto_fornecedor_vendas = 0;
		$total_vlvarejo_vendas = 0;
		
		$sql = "SELECT idproduto, vlcusto, vlvarejo, vlatacado FROM produto WHERE fornecedor_idfornecedor=" . $valor . "";
		$query = $db->query ( $sql );
		while ( $rowprodutos = $db->fetch_assoc ( $query ) ) {
			
			$sql = "SELECT id, vr_custo AS valor, quant, vr_total FROM mv_vendas_movimento WHERE id_produto=" . $rowprodutos ['idproduto'] . " AND estornado=0";
			$queryvenda = $db->query ( $sql );
			
			while ( $rowvenda = $db->fetch_assoc ( $queryvenda ) ) {
				$valor_custo_venda = $rowvenda ['valor'];
				$valor_varejo_venda = $rowvenda ['vr_total'];
				$total_vlvarejo_vendas += $valor_varejo_venda * $rowvenda ['quant'];
				$vlcusto_fornecedor_vendas += $valor_custo_venda * $rowvenda ['quant'];
			}
		
		}
		
		$resultado = $total_vlvarejo_vendas - $vlcusto_fornecedor_vendas;
	
	} else if ($relatorio == 3) {
		
		$sql = "SELECT idproduto, vlcusto, vlvarejo, vlatacado FROM produto WHERE fornecedor_idfornecedor=" . $valor . "";
		$query = $db->query ( $sql );
		while ( $rowprodutos = $db->fetch_assoc ( $query ) ) {
			
			$quantidade_estoque_atual_multi = 0;
			
			$sql = "SELECT nquantidade FROM estoque WHERE produto_idproduto=" . $rowprodutos ['idproduto'] . "";
			$queryestoque = $db->query ( $sql );
			
			while ( $rowestoque = $db->fetch_assoc ( $queryestoque ) ) {
				$quantidade_estoque_atual = ( int ) $rowestoque ['nquantidade'];
			}
		
		}
		
		$resultado = $quantidade_estoque_atual;
	
	} else if ($relatorio == 4) {
		
		$total_vlvarejo_vendas = 0;
		
		$sql = "SELECT idproduto, vlcusto, vlvarejo, vlatacado FROM produto WHERE fornecedor_idfornecedor=" . $valor . "";
		$query = $db->query ( $sql );
		while ( $rowprodutos = $db->fetch_assoc ( $query ) ) {
			
			$sql = "SELECT id, vr_custo AS valor, quant, vr_total FROM mv_vendas_movimento WHERE id_produto=" . $rowprodutos ['idproduto'] . " AND estornado=0";
			$queryvenda = $db->query ( $sql );
			
			while ( $rowvenda = $db->fetch_assoc ( $queryvenda ) ) {
				$valor_varejo_venda = $rowvenda ['vr_total'];
				$total_vlvarejo_vendas += $valor_varejo_venda * $rowvenda ['quant'];
			}
		
		}
		
		$resultado = $total_vlvarejo_vendas;
	
	} else if ($relatorio == 5) {
		
		$sql = "SELECT idproduto FROM produto WHERE fornecedor_idfornecedor=" . $valor . "";
		$query = $db->query ( $sql );
		
		$resultado = $db->num_rows ( $query );
	
	} else if ($relatorio == 6) {
		
		$vlcusto_fornecedor_vendas = 0;
		$total_vlvarejo_vendas = 0;
		
		$sql = "SELECT idproduto, vlcusto, vlvarejo, vlatacado FROM produto WHERE fornecedor_idfornecedor=" . $valor . "";
		$query = $db->query ( $sql );
		while ( $rowprodutos = $db->fetch_assoc ( $query ) ) {
			
			$sql = "SELECT id, vr_custo AS valor, quant, vr_total FROM mv_vendas_movimento WHERE id_produto=" . $rowprodutos ['idproduto'] . " AND estornado=0";
			$queryvenda = $db->query ( $sql );
			
			while ( $rowvenda = $db->fetch_assoc ( $queryvenda ) ) {
				$valor_custo_venda = $rowvenda ['valor'];
				$valor_varejo_venda = $rowvenda ['vr_total'];
				$total_vlvarejo_vendas += $valor_varejo_venda * $rowvenda ['quant'];
				$vlcusto_fornecedor_vendas += $valor_custo_venda * $rowvenda ['quant'];
			}
		
		}
		
		$lucro_vendas_real = $total_vlvarejo_vendas - $vlcusto_fornecedor_vendas;
		if ($lucro_vendas_real > 0)
			$resultado = ($lucro_vendas_real / $vlcusto_fornecedor_vendas) * 100;
		else
			$resultado = 0;
	
	} else if ($relatorio == 7) {
		
		$quantidade_estoque_vendas = 0;
		
		$sql = "SELECT idproduto, vlcusto, vlvarejo, vlatacado FROM produto WHERE fornecedor_idfornecedor=" . $valor . "";
		$query = $db->query ( $sql );
		while ( $rowprodutos = $db->fetch_assoc ( $query ) ) {
			
			$sql = "SELECT quant FROM mv_vendas_movimento WHERE id_produto=" . $rowprodutos ['idproduto'] . " AND estornado=0";
			$queryvenda = $db->query ( $sql );
			
			while ( $rowvenda = $db->fetch_assoc ( $queryvenda ) ) {
				$quantidade_estoque_vendas += ( int ) $rowvenda ['quant'];
			}
		
		}
		
		$resultado = $quantidade_estoque_vendas;
	
	} else if ($relatorio == 8) {
		
		$vlcusto_fornecedor_vendas = 0;
		
		$sql = "SELECT idproduto, vlcusto, vlvarejo, vlatacado FROM produto WHERE fornecedor_idfornecedor=" . $valor . "";
		$query = $db->query ( $sql );
		while ( $rowprodutos = $db->fetch_assoc ( $query ) ) {
			
			$sql = "SELECT id, vr_custo AS valor, quant, vr_total FROM mv_vendas_movimento WHERE id_produto=" . $rowprodutos ['idproduto'] . " AND estornado=0";
			$queryvenda = $db->query ( $sql );
			
			while ( $rowvenda = $db->fetch_assoc ( $queryvenda ) ) {
				$valor_custo_venda = $rowvenda ['valor'];
				$vlcusto_fornecedor_vendas += $valor_custo_venda * $rowvenda ['quant'];
			}
		
		}
		
		$resultado = $vlcusto_fornecedor_vendas;
	
	}
	
	return $resultado;

}

function adiciona_zeronumero($valor) {
	if (strlen ( $valor ) < 2 && $valor < 10)
		$valor = '0' . $valor;
	return $valor;
}

function dateDiff($sDataInicial, $sDataFinal) {
	$sDataI = explode ( "-", $sDataInicial );
	$sDataF = explode ( "-", $sDataFinal );
	$nDataInicial = mktime ( 2, 0, 0, $sDataI [1], $sDataI [0], $sDataI [2] );
	$nDataFinal = mktime ( date ( 'h' ), 0, 0, $sDataF [1], $sDataF [0], $sDataF [2] );
	return ($nDataInicial > $nDataFinal) ? floor ( ($nDataInicial - $nDataFinal) / 86400 ) : floor ( ($nDataFinal - $nDataInicial) / 86400 );
}

function timestamp_converte($timestamp, $modelo = 0) {
	
	if ($modelo == 0) {
		return date ( "d/m/Y H:i:s", $timestamp );
	} else if ($modelo == 1) {
		return date ( "d/m/Y", $timestamp );
	}

}

function prioridade_converte($prioridade) {
	
	switch ($prioridade) {
		case 1 :
			return '<b style="color:green;">baixa</b>';
			break;
		case 2 :
			return '<b style="color:orange;">m�dia</b>';
			break;
		case 3 :
			return '<b style="color:red;">alta</b>';
			break;
	}

}

function decrypt($string, $key) {
	$result = '';
	$string = base64_decode ( $string );
	
	for($i = 0; $i < strlen ( $string ); $i ++) {
		$char = substr ( $string, $i, 1 );
		$keychar = substr ( $key, ($i % strlen ( $key )) - 1, 1 );
		$char = chr ( ord ( $char ) - ord ( $keychar ) );
		$result .= $char;
	}
	return $result;
}

/**
 * retorna as categorias
 *
 */
function get_categoria($id = null) {
	$db = new db ( );
	$db->connect ();
	
	$sql = "SELECT idproduto, vlcusto, vlvarejo, vlatacado FROM produto WHERE fornecedor_idfornecedor=" . $valor . "";
	$query = $db->query ( $sql );
	while ( $rowprodutos = $db->fetch_assoc ( $query ) ) {
	
	}
}

?>