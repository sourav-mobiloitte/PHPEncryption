<?php

	include('Encryption.php');
	
	
	/******************** Using Mcrypt Encryption ***************/
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
	
	
?>
