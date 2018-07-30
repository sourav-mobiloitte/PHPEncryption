PHPEncryption is an encryption library written in PHP. It aims to implement encryption and descryption using both mycrypt and open_ssl. it is Object-Oriented PHP class for encrypting, obfuscating and hashing strings with the ability to specify an arbitrary base for output.

Description :

Simple to use class for encrypting/decrypting using the PHP Openssl library and Mcrypt library.

Dependencies :
It requires PHP 5.6 or newer 
OpenSSL 1.0.1 or newer
Mcrypt 	2.5.8 or newer.

Encryption :

Configure a set of options to reuse throughout your application:
Example using default options:


/******************** Using Mcrypt Encryption ***************/
<?php
	include('Encryption.php');
	try{
		$input = 'sourav';

		// have the create the Encryption object
		$testObject = new Encryption();
		$encrypt_value =  $testObject->_mcrypt_encrypt_data($input);

		echo 'Encrypted data : '.$encrypt_value.'<br>';

		$decrypt_value = $testObject->_mcrypt_decrypt_data($encrypt_value);

		echo 'Decrypted original data: '.$decrypt_value;

	} catch (Exception $e) {
		die ('Something went wrong !!' . $e->getMessage().' in line no: '.$e->getLine());
	}





