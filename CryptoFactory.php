<?php

	class CryptoFactory
	{
		private $input;

		
		/**
		 * Class constructor
		 *
		 * @return	void
		 */
			
		public function __construct($input)
		{
			$this->input = $input;
			
			/******** OpenSSl Key ******/
		
			$this->openssl_encrypt_iv = 'fedcba9876543210'; 
			$this->openssl_encrypt_key = '0123456789abcdef'; 
		
		}
		
		/**
		* create OpenSSL Encrypt method
		* @param {String} $input
		* @param 
		* @return decrypted original string 
		* 
		*/

		public function getMakeOpenSSLEncryptData()
		{
			try {
				
				$data = $this->input;
				
				if ($this->input == '' && empty($this->input))
				{
					die('Encryption: Unable to find an encryption input.');
				}
				
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
			
			} catch (Exception $e) {
				die ('Something went wrong !!' . $e->getMessage().' in line no: '.$e->getLine());
			}
				 
		}
		
		/**
		* Return OpenSSL decrypt method
		* @param {String} $input
		* @param 
		* @return decrypted original string 
		* 
		*/
		
		public function getReturnOpenSSLDecryptData()
		{
			
			try {
				$data = $this->input;
				
				if ($this->input == '' && empty($this->input))
				{
					die('Deryption: Unable to find an decryption input.');
				}
				
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
				
			} catch (Exception $e) {
				
				die ('Something went wrong !!' . $e->getMessage().' in line no: '.$e->getLine());
			}
				 
		}
	}


	/**
	* Encryption class
	* @param {String} $input
	* @param 
	* @return CryptoFactory object 
	* 
	*/

	class Encryption
	{
		public static function encrypt($input)
		{
			return new CryptoFactory($input);
		}
	}
	
	/**
	* Decryption class
	* @param {String} $input
	* @param 
	* @return CryptoFactory object 
	* 
	*/

	class Decryption
	{
		public static function decrypt($input)
		{
			return new CryptoFactory($input);
		}
	}

	
