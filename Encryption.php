<?php 

/**
 * Encryption class
 * 
 * @author Sourav Garg <sourav.garg@mobiloitte.in>
 */
 
class Encryption {
	
	/**
	 * Encryption key one 
	 *
	 * @var	string
	 */
	protected $encrypt_key;

	/**
	 * Encryption key two
	 *
	 * @var	string
	 */
	protected $encrypt_key_1;

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		
		/******** MCrypt Key ******/
		
		$this->encrypt_key = 'Srijan'; 
		$this->encrypt_key_1 = 'hqlYxkFjKtUdLVCBuUJZRpgukq7Nwi';  
		
		/******** OpenSSl Key ******/
		
		$this->openssl_encrypt_iv = 'fedcba9876543210'; 
		$this->openssl_encrypt_key = '0123456789abcdef';  
	}
	
	// --------------------------------------------------------------------

	
	/**
	 * Encrypt via MCrypt
	 *
	 * @param {String} $input Input data
	 * @return $encrypted as a string (encrypted data)
	 */
	
	public function _mcrypt_encrypt_data($input) {
		
		try {	
			
			if ($this->encrypt_key == '' && empty($this->encrypt_key))
			{
				die('Encryption: Unable to find an encryption key one.');
			}else if($this->encrypt_key_1 && empty($this->encrypt_key_1)){
				die('Encryption: Unable to find an encryption key two.');
			}
			
				
			$key = $this->encrypt_key . $this->encrypt_key_1;
			$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $input, MCRYPT_MODE_CBC, md5(md5($key))));
			return $encrypted;
			
		} catch (Exception $e) {
			die ('Something went wrong !!' . $e->getMessage().' in line no: '.$e->getLine());
		}
	}

   
	
   /**
	* Decrypt via MCrypt
	* @param {String} $input Encrypted data
	* @return string an decrypted 
	*/
	public function _mcrypt_decrypt_data($input) {
		/* Return De-mcrypted data */
		try {
			
			$key = $this->encrypt_key . $this->encrypt_key_1;
			$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($input), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
			return $decrypted;
			
		} catch (Exception $e) {
			die ('Something went wrong !!' . $e->getMessage().' in line no: '.$e->getLine());
		}
	}
	
	
	/*===================================================================================*/
	
	/**
	 * Encrypt via OpenSSL
	 *
	 * @param	{String}	$data	Input data
	 * @return	$encryptedPayload as a string
	 */
	public function _openssl_encrypt($data) {
       $iv = $this->openssl_encrypt_iv; 
       $key = $this->openssl_encrypt_key;
       if (strlen($key) < 16) {
           $key = str_pad("$key", 16, "0"); //0 pad to len 16
       } else if (strlen($key) > 16) {
           $key = substr($str, 0, 16); //truncate to 16 bytes
       }
       
       $encodedEncryptedData = base64_encode(openssl_encrypt($data, "aes-128-cbc" , $key, OPENSSL_RAW_DATA, $iv));
       $encodedIV = base64_encode($iv);
       $encryptedPayload = $encodedEncryptedData.":".$encodedIV;
       
	   return $encryptedPayload;
	}

  
    /**
	 * Decrypt via OpenSSL
	 * @param	{String}	$data	Encrypted data
	 * @return	$decryptedData as decrypted original string
	 */   
	  
    public function _openssl_decrypt($data) {
		$iv = $this->openssl_encrypt_iv; 
		$key = $this->openssl_encrypt_key;
        if (strlen($key) < 16) {
           $key = str_pad("$key", 16, "0"); //0 pad to len 16
		} else if (strlen($key) > 16) {
           $key = substr($str, 0, 16); //truncate to 16 bytes
		}
       
       $parts = explode(':', $data); //Separate Encrypted data from iv.
       $decryptedData = openssl_decrypt(base64_decode($parts[0]), "aes-128-cbc" , $key, OPENSSL_RAW_DATA, base64_decode($parts[1]));
       
       return $decryptedData;
    }
	
	
	
}


?>
