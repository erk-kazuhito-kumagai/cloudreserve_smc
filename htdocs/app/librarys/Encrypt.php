<?php
/**
 * Encrypt
 * - Provide a way to encrypt and decrypt data
 * - I just modify from function-oriented design to OOP-design
 * @author Do Truong Giang
 */
class Encrypt {
	public function Encrypt(){
	}
	/**
	 * enc
	 * - Enc data
	 * @param String $str The n-byte string data
	 * @param String $isEmail Confirm flag that $str is an email address or not
	 */
	public static function enc($str, $isEmail = false) {
		if (!isset($str)) {
			return('');
		}
		$base = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		$slt = str_repeat('a', strlen($str));
		$reg_pat = array('/\+/', '/\//', '/=+$/');
		$rep_pat = array('_', '.', '');

	    $sum = 0;
	    for ($i = 0; $i < strlen($str); $i++) {
			$sum += ord($str{$i}) - 40;
	    }
	    $parity = $base{$sum % 62};

	    $len1 = $base{(int)(strlen($str) / 62)};
	    $len2 = $base{strlen($str) % 62};

	    $enc = $str ^ $slt;
	    $enc = trim(base64_encode($enc));

	    $enc = preg_replace($reg_pat, $rep_pat, $enc);
	    // echo("ENC=$enc\n");
	    $result = $enc . $len1 . $len2 . $parity;
	    if ($isEmail === true) {
		    $arrayBit = array();
		    for ($i = 0; $i < strlen($result); $i++) {
		    	if (ord($result[$i]) < 91 && ord($result[$i]) > 64) {
		    		$arrayBit[$i] = 1;
		    	}
		    	else {
		    		$arrayBit[$i] = 0;
		    	}
		    }
			$arrayBit = implode("", $arrayBit);
		    $arrayBit = base_convert($arrayBit, 2, 32);
		    $stringZero = strstr($arrayBit, "0");
		    $arrayBit = substr($arrayBit, 0, (strlen($arrayBit) - strlen($stringZero)));
		    if ($stringZero !== false) {
		    	$arrayBit = $arrayBit . "0" . strlen($stringZero);
		    }
		    return (strtolower($enc . $len1 . $len2 . $parity) . $arrayBit . "0" . strlen($arrayBit));
		}
		else {
			return $result;
		}
	}
	/**
	 * dec
	 * - Decrypt data
	 */
	public static function dec ($target, $loop = false) {
		// default return
		$return = true;
		if (!isset($target)) {
			return('');
		}

		preg_match('/^(.+)(.)(.)(.)$/', $target, $matches);
		list( , $str, $len1, $len2, $parity) = $matches;

		$base = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		$reg_pat = array('/_/', '/\./');
		$rep_pat = array('+', '/');

		$len1_index = strpos($base, $len1);
		$len2_index = strpos($base, $len2);
		$len = ($len1_index * 62) + $len2_index;
		$slt = str_repeat('a', $len);

		$parity_index = strpos($base, $parity);
		if ($parity_index === FALSE) {
			$return = false;
		}

		$str = preg_replace($reg_pat, $rep_pat, $str);
		$dec = base64_decode($str) ^ $slt;

		if (strlen($dec) != $len) {
			$return = false;
		}

	    $sum = 0;
	    for ($i = 0; $i < strlen($dec); $i++) {
			$sum += ord($dec{$i}) - 40;
	    }
	    if (($sum % 62) != $parity_index) {
			$return = false;
		}
		if ($return === false && $loop === false) {
			$posZero = strrpos($target,"0");
			$strBitLength = substr($target, -(strlen($target) - $posZero - 1));
			$target = substr($target, 0, $posZero);
			$strEnc = substr($target,0 , (strlen($target) -  $strBitLength));
			$strArrayBit = substr($target, -$strBitLength);

			$posZero = strrpos($strArrayBit, "0");
			if ($posZero !== false) {
				$strBitLength = substr($strArrayBit, -(strlen($strArrayBit) - $posZero - 1));
				$strArrayBit = substr($strArrayBit, 0, $posZero);

				$strArrayBit = $strArrayBit.str_repeat("0", $strBitLength);
			}
			$target = self::restoreCharacter($strEnc, $strArrayBit);
			return self::dec($target, true);
		}
		else if ($return === false && $loop === true) {
			return '';
		}
		return $dec;
	}
	/**
	 * restoreCharacter
	 */
	public static function restoreCharacter($string, $arrayBit) {
		$arrayBit = base_convert($arrayBit, 32, 2);
		$return = "";
		for ($i = 0; $i < strlen($string); $i++) {
			if ($arrayBit[$i] == 1) {
				$return .= strtoupper($string[$i]);
			}else {
				$return .= $string[$i];
			}
		}
		return $return;
	}
}
?>