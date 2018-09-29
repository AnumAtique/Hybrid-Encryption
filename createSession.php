<?php

include("dbconnection.php");

class createSession {

	function checkData($data) {
	if(preg_match("/^\s$/", $data)) {
		echo "Enter correct data";
	}
	else{
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
}
return $data;
}

function validateData($name, $email, $password, $checkPassword) {
	$inputs = array($name, $email, $password, $checkPassword);
	
	if(preg_match('/^[a-zA-Z0-9]{2,}[\s]{0,1}[a-zA-Z0-9]{2,}\z/', $inputs[0]) && 
		!empty(filter_var($inputs[1], FILTER_VALIDATE_EMAIL)) && !empty($inputs[2]) && !empty($inputs[3])) {
	
		for($fields=0; $fields<4; $fields++) {

			$inputs[$fields] = $this->checkData($inputs[$fields]);
	
			if(strlen(trim($inputs[$fields])) == 0) {
		echo "<script> window.location.href = 'Signup.html'</script>";
		exit();
	}
		}
		return $inputs;
	}
	else {
		echo "<script> window.location.href = 'Signup.html'</script>";
		exit();
	}
	}
	
}

$connect = new dbconnect();
$session = new createSession();

if(isset($_POST['signup'])) {
$inputs = $session->validateData($_POST['name'], $_POST['email'], $_POST['password'], $_POST['cpassword']);

if($inputs[2] != $inputs[3]) {
	echo "<script> window.location.href = './Signup.html'</script>";
	exit();
}
else {
	
		$connect->addUser($inputs[0], $inputs[1], $inputs[2]);	
	}
}
	if(isset($_POST['login'])){
		//echo "login user";
		$connect->verifyUser($_POST['email'], $_POST['password']);
	}

?>