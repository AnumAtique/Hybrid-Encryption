<?php

include ('hybrid_triple_des.php');

class filing {
	function encryption(hybrid_triple_des $encrypter, $getMethod, $key, $getFile) {
		
		if($getMethod == '3des') {
			$encrypter->keys($key);
			$encrypter->encrypt_3des($getFile);
		}
		else if($getMethod == 'aes') {
			$encrypter->keys($key);
			$encrypter->encrypt_aes($getFile);
			//$encrypter->encrypt_rsa("$getFile");
		}
		else if($getMethod == 'blowfish') {
			$encrypter->keys($key);
			$encrypter->encrypt_blowfish($getFile);
		}
		else if($getMethod == 'aes and 3des') {
			$encrypter->keys($key);
			$getFile = $encrypter->encrypt_aes($getFile);
			$encrypter->encrypt_3des($getFile);
		}
		else if($getMethod == 'aes and blowfish') {
			$encrypter->keys($key);
			$getFile = $encrypter->encrypt_idea($getFile);
			$encrypter->encrypt_3des($getFile);
		}
		else if($getMethod == 'idea') {
		$encrypter->keys($key);
		$encrypter->encrypt_idea($getFile);	
		}
	}

	function decryption(hybrid_triple_des $encrypter, $getMethod, $key, $getFile) {

		if($getMethod == '3des') {
			$encrypter->keys($key);
			$encrypter->decrypt_3des($getFile);
		}
		else if($getMethod == 'aes') {
			$encrypter->keys($key);
			$encrypter->decrypt_aes($getFile);
		}
		else if($getMethod == 'blowfish') {
			$encrypter->keys($key);
			$encrypter->decrypt_blowfish($getFile);
		}
		else if($getMethod == 'aes and 3des') {
			$encrypter->keys($key);
			$getFile = $encrypter->decrypt_aes($getFile);
			$encrypter->decrypt_3des($getFile);
		}
		else if($getMethod == 'aes and blowfish') {
			$encrypter->keys($key);
			$getFile = $encrypter->decrypt_aes($getFile);
			$encrypter->decrypt_blowfish($getFile);
		}
		else if($getMethod == 'idea') {
		$encrypter->keys($key);
		$encrypter->decrypt_idea($getFile);			
	}
		}
}

	//move_uploaded_file($_FILES['uploadFile'], "./".$_FILES['uploadFile']['name']);
		if(!empty($_POST['encryptiontype']) && !empty($_POST['key']) && !empty($_FILES['uploadFile']['tmp_name'])) {
echo "<script> alert('working')</script>";
	$getMethod = $_POST['encryptiontype'];
	$key = $_POST['key'];
	$getFile = $_FILES['uploadFile']['tmp_name'];

	$htd = new hybrid_triple_des;
$filing = new filing();

if(isset($_POST['submit'])) {
$filing->encryption($htd, $getMethod, $key, $getFile);
}
else if(isset($_POST['decrypt'])) {
	$filing->decryption($htd, $getMethod, $key, $getFile);
}
//echo $_POST['encryption_type'];
}
else {
	echo "<script> window.location.href = 'file_encrypter.php'</script>";
	exit();
}

?>