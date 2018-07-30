<?php

	include('CryptoFactory.php');
	
		/******************** Using OpenSSL Encryption ***************/
	
	try {
		// have the factory create the Encryption object
		$encrypt = Encryption::encrypt('Bugatti');

		$encrypted_value = $encrypt->getMakeOpenSSLEncryptData();

		echo 'Encrypted data : '.$encrypted_value; // outputs "Encrypted String"


		// have the factory get the Decryption object 

		$decrypt = Decryption::decrypt($encrypted_value);
		
		$decrypted_value = $decrypt->getReturnOpenSSLDecryptData();
		
		echo '<br>';

		echo 'Decrypted original data: '.$decrypted_value; // outputs "decrypted original string"
		
	} catch (Exception $e) {
		die ('Something went wrong !!' . $e->getMessage().' in line no: '.$e->getLine());
	}

?>
