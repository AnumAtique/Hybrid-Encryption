<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="./file_encrypter.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
        </script>
</head>
<body>
	<?php
	session_start();
	echo $_SESSION["name"]; ?>
	<div class="login-box">
	<form  method="post" action="./encrypt_file.php" enctype="multipart/form-data" onsubmit = "return validateData()">
		<input type="file" name="uploadFile" id="uploadFile" class="fields"/><br>
		<input type="text" name="key" id="key" class="fields"/><br>
		<select name="encryptiontype" class="fields">
			<option value="aes and 3des">Hybrid Encryption using AES and 3DES</option>
			<option value="idea and 3des">Hybrid Encryption using IDEA and 3DES</option>
			<option value="aes">AES Encryption</option>
			<option value="3des">3DES Encryption</option>
			<option value="blowfish">Blowfish</option>
			<option value="idea">IDEA-OFB</option>
		</select>
		<input type="submit" name="submit" value="Encrypt" id="submit" class="fields"/>
		<input type="submit" name="decrypt" value="Decrypt" id="submit" class="fields"/>
	</form>
</div>
<script type="text/javascript">
	function validateData() {
		var file = document.getElementById('uploadFile').value;
		var key = document.getElementById('key').value;
		
		if(file.trim() != "" && key.trim() != "") {
			return true;
		}

		else {
			if(file.trim() == "") {
			$(document).ready(function() {
				$('#uploadFile').css({'border': '1px solid red'});
			});
		}
		else if(empty($_POST['key'])) {
			$(document).ready(function(){
				$('#key').css({'border': '1px solid red'});
			});
		}
	}
	}
</script>
</body>
</html>
