<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class security extends Model
{
    //тут находятся данные по безопасности
	
	public static function insert_no_security_text($param, $key_pass)
	{
		$text = $param;
		$shift=12;
		for($i=0; $i<strlen($text); $i++)  {
			$symbol=ord($text[$i])+$shift;
			if($symbol>255)  {
				$symbol=$symbol-255;
			}
			$text = $text.chr($symbol);
			//$codeText = security::encrypt($text, $key_pass);
		}
		return $codeText;
	}
	
	public static function select_security_text($param, $key_pass)
	{
		$codeText = $param;
		$shift=12;
		for($i=0; $i<strlen($codeText); $i++)  {
			$symbol=ord($codeText[$i])-$shift;
			if($symbol<$shift)  {
				$symbol=255-$shift;
			}
			$text = $text.chr($symbol);
			//$codeText = security::decrypt($codeText, $key_pass);
		}
		return $text;
	}
	
	
	// Encrypt
	public static function encrypt($decrypted, $key) {
		$start = $decrypted;		
		$plaintext = "Тестируем обратимое шифрование на php 7";
		$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
		$iv = openssl_random_pseudo_bytes($ivlen);
		$ciphertext_raw = openssl_encrypt($plaintext, $cipher, ENCRYPTION_KEY, $options=OPENSSL_RAW_DATA, $iv);
		$hmac = hash_hmac('sha256', $ciphertext_raw, ENCRYPTION_KEY, $as_binary=true);
		$ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
		echo $ciphertext.'<br>';
		 
	}
	 
	// Decrypt
	public static function decrypt($encrypted, $key) {
		$c = base64_decode($ciphertext);
		$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
		$iv = substr($c, 0, $ivlen);
		$hmac = substr($c, $ivlen, $sha2len=32);
		$ciphertext_raw = substr($c, $ivlen+$sha2len);
		$plaintext = openssl_decrypt($ciphertext_raw, $cipher, ENCRYPTION_KEY, $options=OPENSSL_RAW_DATA, $iv);
		$calcmac = hash_hmac('sha256', $ciphertext_raw, ENCRYPTION_KEY, $as_binary=true);
		if (hash_equals($hmac, $calcmac))
		{
			echo $plaintext;
		}
		return $decrypted;
	}
}
