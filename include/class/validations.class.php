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


class validations {
	
	protected $string;
	protected $number;
	protected $keyhash = "mod43rfsw_0ds";
	
	/**
	 * Transform form post in array
	 * @param 	post array	 	$valuepost
	 * @return 	array 			$arr
	 */
	public function transfArray($valuepost) {
		$total = 0;
		foreach ( $valuepost as $value ) {
			$arr [$total] = $this->validStringForm ( $value );
			$total ++;
		}
		return $arr;
	}
	
	function validStringForm($string) {
		$this->string = utf8_decode ( $string );
		$this->string = strip_tags ( $this->string );
		//$this->string = stripcslashes($this->string);
		$this->validNoScript ();
		return $this->string;
	}
	
	function validNoScript() {
		$this->string = str_replace ( "<script>", "", $this->string );
		$this->string = str_replace ( "</script>", "", $this->string );
	}
	
	function validNumericSQL($value) {
		if (! is_numeric ( $value )) {
			return "'" . $value . "'";
		} else {
			return $value;
		}
	}
	
	function validNumeric($number) {
		if (is_numeric ( $number )) {
			$this->number = $number;
			return $this->number;
		} else {
			return false;
		}
	}
	
	function qtdCaracters($string, $nCaracteres) {
		$totalL = strlen ( $string );
		if ($totalL > $nCaracteres) {
			$string = substr ( $string, 0, $nCaracteres );
			$string = $string . "...";
		}
		return $string;
	}
	
	public function addDayIntoDate($date, $month) {
		$thisyear = substr ( $date, 0, 4 );
		$thismonth = substr ( $date, 4, 2 );
		$thisday = substr ( $date, 6, 2 );
		$nextdate = mktime ( 0, 0, 0, $thismonth + $month, $thisday, $thisyear );
		return strftime ( "%Y-%m-%d", $nextdate );
	}
	
	public function createHash($value) {
		$hash = md5 ( sha1 ( $this->keyhash ) . $value );
		return $hash;
	}
	
	public function verifyHash($hash, $value) {
		if ($hash == $this->createHash ( $value )) {
			return true;
		} else {
			return false;
		}
	}
	
	public function convertDateTimePT($data) {
		
		$dataex = explode ( "-", $data );
		
		$ano = $dataex [0];
		$mes = $dataex [1];
		$dia = $dataex [2];
		
		$datafinal = $dia [0] . $dia [1] . "/" . $mes . "/" . $ano;
		
		$horario = explode ( ":", $dataex [2] );
		$hora = $horario [0];
		$minuto = $horario [1];
		$segundos = $horario [2];
		
		$horariofinal = $hora [3] . $hora [4] . ":" . $minuto;
		
		return $datafinal . " �s " . $horariofinal;
	
	}

}

?>