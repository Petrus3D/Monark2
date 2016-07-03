<?php

namespace app\classes;

/**
* Class permettant de crypter une chaine de caractère
*/

class Crypt
{
	private $cryptKey;
	private $cryptString;

	function __construct($string)
	{
		$this->cryptString = $string;
		$this->cryptKey = "*M@N#ar[~rk°&²}";
		
	}	

	/* fonctions de simple Cryptage et decryptage */
	function s_crypt()
	{
	    return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($this->cryptKey), $this->cryptString, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
	}
	 
	function s_decrypt()
	{
	    return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($this->cryptKey), base64_decode($this->cryptString), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
	}

	function b64_crypt()
	{
	    return base64_encode($this->cryptString);
	}

	function b64_decrypt()
	{
	    return base64_decode($this->cryptString);
	}

	/* fonctions de Cryptage et decryptage plus complexe */
	public function crypt(){
		$serial = serialize($this->cryptString);
	    $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);
	    $key = pack('H*', md5($this->cryptKey));
	    $mac = hash_hmac('sha256', $serial, substr(bin2hex($key), -32));
	    $passcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $serial.$mac, MCRYPT_MODE_CBC, $iv);
	    $crypted = base64_encode($passcrypt).'|'.base64_encode($iv);
	    return $crypted;
	}

	public function decrypt(){
		$string = explode('|', $this->cryptString);
	    $decoded = base64_decode($string[0]);
	    if(isset($string[1])){$iv = base64_decode($string[1]);}else{return false;}
	    if(strlen($iv)!==mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)){ return false; }
	    $key = pack('H*', md5($this->cryptKey));
	    $decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_CBC, $iv));
	    $mac = substr($decrypted, -64);
	    $decrypted = substr($decrypted, 0, -64);
	    $calcmac = hash_hmac('sha256', $decrypted, substr(bin2hex($key), -32));
	    if($calcmac!==$mac){ return false; }
	    $decrypted = unserialize($decrypted);
		return $decrypted;
	}
}


?>