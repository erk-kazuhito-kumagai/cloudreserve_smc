<?php
/**
 * BaseMail
 * - Send mail and in future, receive mail
 * @author Do Truong Giang
 * $Id: BaseMail.class.php,v 1.1.2.3 2011/05/10 09:42:46 giangzang Exp $
 */
class BaseMail {
	/**
	 * Constructor
	 */
	public function BaseMail() {
	}
	/**
	 * sendMail
	 * - Send a mail to a specified address
	 * - Mail has to be converted to JIS to send Japanese
	 * - This static function convert UTF-8 to SJIS since the server's code is UTF-8
	 * @param String $fromEmail The mail address of sender (eg. giangzang@yahoo.com)
	 * @param String $toEmail The mail address of receiver (eg. giangzang@runsystem.net)
	 * @param String $subject The mail's subject
	 * @param String $body The mail's body
	 * @param String $fromName The real name of sender (eg. Suzuki)
	 * @return Void Send email to receiver.
	 */
	public static function sendMail($fromEmail, $toEmail, $subject, $content, $fromName = null, $type = 'text', $envelopeFrom = null) {
        mb_language("ja");
        $internalEncoding = "UTF-8";
        mb_internal_encoding($internalEncoding);

		$headers = "MIME-Version: 1.0\n";
		if ($type != '' && strcasecmp($type, 'html') === 0)
            $headers .= "Content-Type: text/html; charset=iso-2022-jp\n";
        else
            $headers .= "Content-Type: text/plain; charset=iso-2022-jp\n";

		if ($envelopeFrom != null) {
			$headers .= 'envelope-from: '. $envelopeFrom . "\n";
		}
        if( $fromEmail != '')
        {
            if ( !empty ($fromName))
            {
                $fromName = mb_convert_encoding($fromName, 'ISO-2022-JP-MS', $internalEncoding);
                $fromName = mb_encode_mimeheader($fromName);
            }

            $headers .= 'From: '.$fromName.' <' . $fromEmail . ">\n";
            $headers .= 'Reply-To: ' . $fromEmail . ">\r\n";
        }
        //$headers .= "X-Mailer: PHP" . phpversion();

        // convert to JIS
        $subject = mb_convert_encoding($subject, 'ISO-2022-JP-MS', $internalEncoding);
        $subject = BaseMail::EncodeHeader(BaseMail::SecureHeader($subject));
        //$subject = mb_encode_mimeheader($subject);

        $content = str_replace("\r", "\n", str_replace("\r\n", "\n", $content));
        
        $content = mb_convert_encoding($content, 'ISO-2022-JP-MS', $internalEncoding);
        
        //if( mail($toEmail, $subject, $content, $headers) ) {
        $handle = fopen("mail.txt", "w");
        fwrite($handle, $content);
        fclose($handle);
            return true;
        //}
        //return false;
	}
	/**
	 * sendMailTemplate
	 * - Send a mail by the template
	 * @param String $filename The absolute path of template file
	 * @param Array $param The array contains key=>value parameters
	 * @return Void Send the mail
	 */
	public static function sendMailTemplate($filename, $param) {
		$envelopeFrom = isset($param["envelopeFrom"]) ? $param["envelopeFrom"] : null;
		//$handle = fopen($filename, "r");
		//$template = fread($handle, filesize($filename));
		list($subject,$template)=BaseMail::read_mail_template($filename);
		foreach ($param as $key => $value) {
			$template = str_replace("%" . $key . "%", $value, $template);
            $template = str_replace("{{" . $key . "}}", $value, $template);
			$subject = str_replace("%" . $key . "%", $value, $subject);
		}
		$param["subject"]=$subject;

		//fclose($handle);
		if (isset($param["fromName"])) {
			return BaseMail::sendMail($param["fromEmail"], $param["toEmail"], $param["subject"], $template, $param["fromName"], 'text', $envelopeFrom);
		}
		else {
			return BaseMail::sendMail($param["fromEmail"], $param["toEmail"], $param["subject"], $template, null, 'text', $envelopeFrom);
		}
	}

    public static function EncodeHeader($str, $position = 'text') {
        $x = 0;

        switch (strtolower($position)) {
          case 'phrase':
            if (!preg_match('/[\200-\377]/', $str)) {
              // Can't use addslashes as we don't know what value has magic_quotes_sybase
              $encoded = addcslashes($str, "\0..\37\177\\\"");
              if (($str == $encoded) && !preg_match('/[^A-Za-z0-9!#$%&\'*+\/=?^_`{|}~ -]/', $str)) {
                return ($encoded);
              } else {
                return ("\"$encoded\"");
              }
            }
            $x = preg_match_all('/[^\040\041\043-\133\135-\176]/', $str, $matches);
            break;
          case 'comment':
            $x = preg_match_all('/[()"]/', $str, $matches);
            // Fall-through
          case 'text':
          default:
            $x += preg_match_all('/[\000-\010\013\014\016-\037\177-\377]/', $str, $matches);
            break;
        }

        if ($x == 0) {
          return ($str);
        }

        $maxlen = 75 - 7 - strlen("iso-2022-jp");
        // Try to select the encoding which should produce the shortest output
        if (strlen($str)/3 < $x) {
          $encoding = 'B';
          if (function_exists('mb_strlen') && BaseMail::HasMultiBytes($str)) {
            // Use a custom static function which correctly encodes and wraps long
            // multibyte strings without breaking lines within a character
            $encoded = BaseMail::Base64EncodeWrapMB($str);
          } else {
            $encoded = base64_encode($str);
            $maxlen -= $maxlen % 4;
            $encoded = trim(chunk_split($encoded, $maxlen, "\n"));
          }
        } else {
          $encoding = 'Q';
          $encoded = BaseMail::EncodeQ($str, $position);
          $encoded = BaseMail::WrapText($encoded, $maxlen, true);
          $encoded = str_replace('='."\n", "\n", trim($encoded));
        }

        $encoded = preg_replace('/^(.*)$/m', " =?"."iso-2022-jp"."?$encoding?\\1?=", $encoded);
        $encoded = trim(str_replace("\n", "\n", $encoded));

        return $encoded;
    }

    public static function Base64EncodeWrapMB($str) {
        $start = "=?"."iso-2022-jp"."?B?";
        $end = "?=";
        $encoded = "";

        $mb_length = mb_strlen($str, "iso-2022-jp");
        // Each line must have length <= 75, including $start and $end
        $length = 75 - strlen($start) - strlen($end);
        // Average multi-byte ratio
        $ratio = $mb_length / strlen($str);
        // Base64 has a 4:3 ratio
        $offset = $avgLength = floor($length * $ratio * .75);

        for ($i = 0; $i < $mb_length; $i += $offset) {
          $lookBack = 0;

          do {
            $offset = $avgLength - $lookBack;
            $chunk = mb_substr($str, $i, $offset, "iso-2022-jp");
            $chunk = base64_encode($chunk);
            $lookBack++;
          }
          while (strlen($chunk) > $length);

          $encoded .= $chunk . "\n";
        }

        // Chomp the last linefeed
        $encoded = substr($encoded, 0, -strlen("\n"));
        return $encoded;
        }

    public static function EncodeQ ($str, $position = 'text') {
        // There should not be any EOL in the string
        $encoded = preg_replace('/[\r\n]*/', '', $str);

        switch (strtolower($position)) {
          case 'phrase':
            $encoded = preg_replace("/([^A-Za-z0-9!*+\/ -])/e", "'='.sprintf('%02X', ord('\\1'))", $encoded);
            break;
          case 'comment':
            $encoded = preg_replace("/([\(\)\"])/e", "'='.sprintf('%02X', ord('\\1'))", $encoded);
          case 'text':
          default:
            // Replace every high ascii, control =, ? and _ characters
            //TODO using /e (equivalent to eval()) is probably not a good idea
//            $encoded = preg_replace('/([\000-\011\013\014\016-\037\075\077\137\177-\377])/e',
            //$encoded = preg_replace('/([\000-\011\013\014\016-\037\075\077\137\177-\377])/e',
            //      "'='.sprintf('%02X', ord('\\1'))", $encoded);
            preg_replace_callback('/([\000-\011\013\014\016-\037\075\077\137\177-\377])/',
			function($m) {
				return "'='.sprintf('%02X', ord($m[0]))";
			},
			$encoded);
            break;
        }

        // Replace every spaces to _ (more readable than =20)
        $encoded = str_replace(' ', '_', $encoded);

        return $encoded;
    }

    public static function WrapText($message, $length, $qp_mode = false) {
        $soft_break = ($qp_mode) ? sprintf(" =%s", "\n") : "\n";
        // If utf-8 encoding is used, we will need to make sure we don't
        // split multibyte characters when we wrap
        $is_utf8 = (strtolower("iso-2022-jp") == "utf-8");

        $message = BaseMail::FixEOL($message);
        if (substr($message, -1) == "\n") {
          $message = substr($message, 0, -1);
        }

        $line = explode("\n", $message);
        $message = '';
        for ($i=0 ;$i < count($line); $i++) {
          $line_part = explode(' ', $line[$i]);
          $buf = '';
          for ($e = 0; $e<count($line_part); $e++) {
            $word = $line_part[$e];
            if ($qp_mode and (strlen($word) > $length)) {
              $space_left = $length - strlen($buf) - 1;
              if ($e != 0) {
                if ($space_left > 20) {
                  $len = $space_left;
                  if ($is_utf8) {
                    $len = BaseMail::UTF8CharBoundary($word, $len);
                  } elseif (substr($word, $len - 1, 1) == "=") {
                    $len--;
                  } elseif (substr($word, $len - 2, 1) == "=") {
                    $len -= 2;
                  }
                  $part = substr($word, 0, $len);
                  $word = substr($word, $len);
                  $buf .= ' ' . $part;
                  $message .= $buf . sprintf("=%s", "\n");
                } else {
                  $message .= $buf . $soft_break;
                }
                $buf = '';
              }
              while (strlen($word) > 0) {
                $len = $length;
                if ($is_utf8) {
                  $len = BaseMail::UTF8CharBoundary($word, $len);
                } elseif (substr($word, $len - 1, 1) == "=") {
                  $len--;
                } elseif (substr($word, $len - 2, 1) == "=") {
                  $len -= 2;
                }
                $part = substr($word, 0, $len);
                $word = substr($word, $len);

                if (strlen($word) > 0) {
                  $message .= $part . sprintf("=%s", "\n");
                } else {
                  $buf = $part;
                }
              }
            } else {
              $buf_o = $buf;
              $buf .= ($e == 0) ? $word : (' ' . $word);

              if (strlen($buf) > $length and $buf_o != '') {
                $message .= $buf_o . $soft_break;
                $buf = $word;
              }
            }
          }
          $message .= $buf . "\n";
        }

        return $message;
    }

    protected static function UTF8CharBoundary($encodedText, $maxLength) {
        $foundSplitPos = false;
        $lookBack = 3;
        while (!$foundSplitPos) {
          $lastChunk = substr($encodedText, $maxLength - $lookBack, $lookBack);
          $encodedCharPos = strpos($lastChunk, "=");
          if ($encodedCharPos !== false) {
            // Found start of encoded character byte within $lookBack block.
            // Check the encoded byte value (the 2 chars after the '=')
            $hex = substr($encodedText, $maxLength - $lookBack + $encodedCharPos + 1, 2);
            $dec = hexdec($hex);
            if ($dec < 128) { // Single byte character.
              // If the encoded char was found at pos 0, it will fit
              // otherwise reduce maxLength to start of the encoded char
              $maxLength = ($encodedCharPos == 0) ? $maxLength :
              $maxLength - ($lookBack - $encodedCharPos);
              $foundSplitPos = true;
            } elseif ($dec >= 192) { // First byte of a multi byte character
              // Reduce maxLength to split at start of character
              $maxLength = $maxLength - ($lookBack - $encodedCharPos);
              $foundSplitPos = true;
            } elseif ($dec < 192) { // Middle byte of a multi byte character, look further back
              $lookBack += 3;
            }
          } else {
            // No encoded character found
            $foundSplitPos = true;
          }
        }
        return $maxLength;
    }

    protected static function HasMultiBytes($str)
    {
        if (function_exists('mb_strlen')) {
            return (strlen($str) > mb_strlen($str, "iso-2022-jp"));
        } else { // Assume no multibytes (we can't handle without mbstring functions anyway)
            return false;
        }
    }

    protected static function SecureHeader($str) {
        $str = str_replace("\r", '', $str);
        $str = str_replace("\n", '', $str);
        return trim($str);
    }

    protected static function FixEOL($str) {
        $str = str_replace("\r\n", "\n", $str);
        $str = str_replace("\r", "\n", $str);
        $str = str_replace("\n", "\n", $str);
        return $str;
    }

	protected static function read_mail_template($mailtemplate){
		$str="";
		$fin=fopen($mailtemplate,"r");
		if (!$fin) return false;
		$i=0;
		while (!feof($fin))
		{$line=fgets($fin);
		 $i++;
		 if ($i==1) $subject=$line; else
		 if ($i>2) $str.=$line;
		}

		fclose($fin);
		list($tmp,$mailsubject)=explode("Subject:",$subject);
		$mailsubject=trim($mailsubject);

		return array($mailsubject,$str);
	}

}
?>
