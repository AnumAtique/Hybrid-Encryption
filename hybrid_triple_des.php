<?php

class hybrid_triple_des {
private $key_3des, $key_aes, $key_rsa, $iv, $iv_blowfish, $iv_idea;

function keys($key) {
	$this->key_3des = md5($key);
	$this->key_3des .= substr($this->key_3des, 0, 8);
	$this->key_aes = sha1($key);
	$this->key_rsa = hash('sha512', $key);
	$this->iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length("aes-256-cbc"));
	$this->iv_blowfish = openssl_random_pseudo_bytes(openssl_cipher_iv_length("blowfish"));
	$this->iv_idea = openssl_random_pseudo_bytes(openssl_cipher_iv_length("idea-ofb"));
	echo "<br>".strlen($this->iv_idea)."<br>";
}
function encrypt_3des($data) {
	$data = fopen("$data", "r");
	$encrypt = fopen("encrypt_des.txt", "w");
	while(!feof($data)) {
		$getData = fread($data, 8);
		$getData = openssl_encrypt($getData, 'DES-EDE3', $this->key_3des, OPENSSL_RAW_DATA);
		$getData = base64_encode($getData);
		echo $getData."<br>";
		fwrite($encrypt, $getData);
	}
	fclose($data);
	fclose($encrypt);
	return $data;
}
function decrypt_3des($data) {
	$data = fopen("$data", "r");
	$decrypt = fopen("decrypt.txt", "w");
	while(!feof($data)) {
		$getData = fread($data, 24);
		echo $getData."<br>";
		$getData = base64_decode($getData, true);
		$getData = openssl_decrypt($getData, 'DES-EDE3', $this->key_3des, OPENSSL_RAW_DATA);
		fwrite($decrypt, $getData);
		echo $getData."<br>";
	}
	fclose($data);
	return $data;
}
function encrypt_aes($data) {
	$data = fopen("$data", "r");
	$encrypt = fopen("encrypt.txt", "w");
	fwrite($encrypt, $this->iv);
	while(!feof($data)) {
		$getData = fread($data, 8);
		$getData = openssl_encrypt($getData, "aes-256-cbc", $this->key_aes, OPENSSL_RAW_DATA, $this->iv);
		$getData = base64_encode($getData);
	echo $getData."<br>";
		fwrite($encrypt, $getData);
	}
	fclose($data);
	fclose($encrypt);
	return basename("./encrypt.txt");
}
function decrypt_aes($data) {
	$data = fopen("$data", "r");
	$decrypt = fopen("decrypt.txt", "w");
	$this->iv = fread($data, 16);
	while(!feof($data)) {
		$getData = fread($data, 24);
		$getData = base64_decode($getData);
		$getData = openssl_decrypt($getData, "aes-256-cbc", $this->key_aes, OPENSSL_RAW_DATA, $this->iv);
		echo $getData."<br>";
		fwrite($decrypt, $getData);
	}
	fclose($data);
	fclose($decrypt);
	return basename("./decrypt.txt");
}
function encrypt_idea($data) {
	$data = fopen("$data", "r");
	$encrypt = fopen("encrypt.txt", "w");
	fwrite($encrypt, $this->iv_idea);
		while(!feof($data)) {
		$getData = fread($data, 8);
		$getData = openssl_encrypt($getData, "IDEA-OFB", $this->key_aes, OPENSSL_RAW_DATA, $this->iv_idea);
		$getData = base64_encode($getData);
	echo $getData."<br>";
		fwrite($encrypt, $getData);
	}
	fclose($data);
	fclose($encrypt);
	return basename("./encrypt.txt");
}
function decrypt_idea($data) {
	$data = fopen("$data", "r");
	$decrypt = fopen("decrypt.txt", "w");
	$this->iv_idea = fread($data, 8);
	while(!feof($data)) {
		$getData = fread($data, 12);
		$getData = base64_decode($getData);
		$getData = openssl_decrypt($getData, "IDEA-OFB", $this->key_aes, OPENSSL_RAW_DATA, $this->iv_idea);
		fwrite($decrypt, $getData);
	}
	fclose($data);
	fclose($decrypt);
}
function encrypt_blowfish($data) {
	$data = fopen("$data", "r");
	$encrypt = fopen("encrypt.txt", "w");
	fwrite($encrypt, $this->iv_blowfish);
	while(!feof($data)) {
		$getData = fread($data, 8);
		$getData = openssl_encrypt($getData, "blowfish", $this->key_aes, OPENSSL_RAW_DATA, $this->iv_blowfish);
		$getData = base64_encode($getData);
	echo $getData."<br>";
		fwrite($encrypt, $getData);
	}
	fclose($data);
	fclose($encrypt);
	return basename("./encrypt.txt");
}

function decrypt_blowfish($data) {
	$data = fopen("$data", "r");
	$decrypt = fopen("decrypt.txt", "w");
	$this->iv_blowfish = fread($data, 8);
	while(!feof($data)) {
		$getData = fread($data, 24);
		$getData = base64_decode($getData);
		$getData = openssl_decrypt($getData, "blowfish", $this->key_aes, OPENSSL_RAW_DATA, $this->iv_blowfish);
		fwrite($decrypt, $getData);
	}
	fclose($data);
	fclose($decrypt);
}
}

//$encrypter = new hybrid_triple_des;
//$encrypter->encrypt_3des("./abc.txt"); 
?>
