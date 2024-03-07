<?php
	
	/**
		* Encode data to Base64URL
		* @param string $data
		* @return boolean|string
	*/
	if (! function_exists('base64url_encode')) {
		function base64url_encode($data)
		{
			// First of all you should encode $data to Base64 string
			$b64 = base64_encode($data);
			
			// Make sure you get a valid result, otherwise, return FALSE, as the base64_encode() function do
			if ($b64 === false) {
				return false;
			}
			
			// Convert Base64 to Base64URL by replacing “+” with “-” and “/” with “_”
			$url = strtr($b64, '+/', '-_');
			
			// Remove padding character from the end of line and return the Base64URL result
			return rtrim($url, '=');
		}
	}
	
	/**
		* Decode data from Base64URL
		* @param string $data
		* @param boolean $strict
		* @return boolean|string
	*/
	if (! function_exists('base64url_decode')) {
		function base64url_decode($data, $strict = false)
		{
			// Convert Base64URL to Base64 by replacing “-” with “+” and “_” with “/”
			$b64 = strtr($data, '-_', '+/');
			
			// Decode Base64 string and return the original data
			return base64_decode($b64, $strict);
		}
	}
	
	if (! function_exists('TampilBulan')) {
		function TampilBulan($x) {
			if ($x == 1 ) {
			$bulan = "Januari"; }
			if ($x == 2 ) {
			$bulan = "Februari"; }
			if ($x == 3 ) {
			$bulan = "Maret"; }
			if ($x == 4 ) {
			$bulan = "April"; }
			if ($x == 5 ) {
			$bulan = "Mei"; }
			if ($x == 6 ) {
			$bulan = "Juni"; }
			if ($x == 7 ) {
			$bulan = "Juli"; }
			if ($x == 8 ) {
			$bulan = "Agustus"; }
			if ($x == 9 ) {
			$bulan = "September"; }
			if ($x == 10) {
			$bulan = "Oktober"; }
			if ($x == 11) {
			$bulan = "November"; }
			if ($x == 12) {
			$bulan = "Desember"; }
			return $bulan;
		}
	}
	
	if (! function_exists('PeriodeKeBulan')) {
		function PeriodeKeBulan($x) {
			if (substr($x,-2) == '01' ) {
			$bulan = "Jan ".substr($x, 0, 4); }
			if (substr($x,-2) == '02' ) {
			$bulan = "Feb ".substr($x, 0, 4); }
			if (substr($x,-2) == '03' ) {
			$bulan = "Mar ".substr($x, 0, 4); }
			if (substr($x,-2) == '04' ) {
			$bulan = "Apr ".substr($x, 0, 4); }
			if (substr($x,-2) == '05' ) {
			$bulan = "Mei ".substr($x, 0, 4); }
			if (substr($x,-2) == '06' ) {
			$bulan = "Jun ".substr($x, 0, 4); }
			if (substr($x,-2) == '07' ) {
			$bulan = "Jul ".substr($x, 0, 4); }
			if (substr($x,-2) == '08' ) {
			$bulan = "Agt ".substr($x, 0, 4); }
			if (substr($x,-2) == '09' ) {
			$bulan = "Sep ".substr($x, 0, 4); }
			if (substr($x,-2) == '10') {
			$bulan = "Okt ".substr($x, 0, 4); }
			if (substr($x,-2) == '11') {
			$bulan = "Nov ".substr($x, 0, 4); }
			if (substr($x,-2) == '12') {
			$bulan = "Des ".substr($x, 0, 4); }
			return $bulan;
		}
	}
	
	if (! function_exists('kekata')) {
		function kekata($x) {
			$x = abs($x);
			$angka = array("", "satu", "dua", "tiga", "empat", "lima",
			"enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
			$temp = "";
			if ($x <12) {
				$temp = " ". $angka[$x];
				} else if ($x <20) {
				$temp = kekata($x - 10). " belas";
				} else if ($x <100) {
				$temp = kekata($x/10)." puluh". kekata($x % 10);
				} else if ($x <200) {
				$temp = " seratus" . kekata($x - 100);
				} else if ($x <1000) {
				$temp = kekata($x/100) . " ratus" . kekata($x % 100);
				} else if ($x <2000) {
				$temp = " seribu" . kekata($x - 1000);
				} else if ($x <1000000) {
				$temp = kekata($x/1000) . " ribu" . kekata($x % 1000);
				} else if ($x <1000000000) {
				$temp = kekata($x/1000000) . " juta" . kekata($x % 1000000);
				} else if ($x <1000000000000) {
				$temp = kekata($x/1000000000) . " milyar" . kekata(fmod($x,1000000000));
				} else if ($x <1000000000000000) {
				$temp = kekata($x/1000000000000) . " trilyun" . kekata(fmod($x,1000000000000));
			}     
			return $temp;
		}
	}
	if (! function_exists('Terbilang')) {
		function Terbilang($x, $style=3, $mata_uang) {
			//replace non numeric
			//$x =  preg_replace("/[^0-9,.]/", "", $x);
			
			if($x<0) {
				$hasil = "minus ". trim(kekata($x));
				} else {
				$hasil = trim(kekata($x));
			}    
			
			switch ($mata_uang) {
				case "rp":
				$hasil = $hasil." Rupiah";
				break;
				case "usd":
				$hasil = $hasil." Dollar";
				break;
			}   
			
			switch ($style) {
				case 1:
				$hasil = strtoupper($hasil);
				break;
				case 2:
				$hasil = strtolower($hasil);
				break;
				case 3:
				$hasil = ucwords($hasil);
				break;
				default:
				$hasil = ucfirst($hasil);
				break;
			}
			
			return $hasil;
		}
	}	
	if (! function_exists('EscapeString')) {
		function EscapeString($Element) {
			if(is_array($Element))
			{
				$result=array_map('trim',$Element);
			}else
			{
				$result = trim($Element);
			}
			
			return $result;
		}
	}	
	
	
	if (! function_exists('object2Array')) {
		function object2Array($d)
		{
			if (is_object($d))
			{
				$d = get_object_vars($d);
			}
			if (is_array($d))
			{
				return array_map(__FUNCTION__, $d);
			}
			else
			{
				return $d;
			}
		}
	}		
	if (! function_exists('array2Object')) {
		function array2Object($d)
		{
			if (is_array($d))
			{
				return (object) array_map(__FUNCTION__, $d);
			}
			else
			{
				return $d;
			}
		}
	}		
	
	if (! function_exists('EncriptPassword')) {
		function EncriptPassword($Value) {
			$CI =& get_instance();
            return sha1(md5($CI->config->item('encryption_key') . ':' . $Value));
		}
	}	
	
	if (! function_exists('GetExtention')) {
		function GetExtention($FileName) {
			$ext = pathinfo($FileName, PATHINFO_EXTENSION);
			$ext = strtolower($ext);
			return $ext;
			
			/*
				$FileName = strtolower(trim($FileName));
				if (empty($FileName)) {
				return '';
				}
				
				$ArrayString = explode('.', $FileName);
				return $ArrayString[count($ArrayString) - 1];
			/*	*/
		}
	}
	
	if (! function_exists('MoneyFormat')) {
		function MoneyFormatNoDec($Value) {
			$intVal = (int)$Value;
            return number_format($intVal, 0, ',', '.');
		}
	}
	
	if (! function_exists('MoneyFormat')) {
		function MoneyFormat($Value) {
			$intVal = (int)$Value;
            return number_format($intVal, 2, ',', '.');
		}
	}
	
	if (! function_exists('show_price')) {
		function show_price($Value) {
            return 'Rp. '.number_format($Value, 2, ',', '.');
		}
	}
	
	if (! function_exists('pdamTimestamp')) {
		function pdamTimestamp() {
            return date("Y-m-d H:i:s");
		}
	}
	
	if (! function_exists('isNullOrEmpty')) {
		function IsNullOrEmptyReturnNol($param) {
			if($param==="")
			{
				return 0;
			}else if($param==NULL)
			{
				return 0;
				}else{
				return $param;
			}
		}
	}	

	if (! function_exists('pdamDieSQL')) {
		function pdamDieSQL() {
           $CI =& get_instance();
		   echo "<pre>";
		   die($CI->db->get_compiled_select());
		}
	}	
	
	
	