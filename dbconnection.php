<?php
class dbconnect {

private $connect;
	function __construct() {
		$this->connect = new mysqli("localhost", "root", "", "hybrid_encryption");

      if($this->connect->connect_error) {
	      die("Connection failed".$connect->connect_error);
	      echo "connection die<br>";
}

}


function addUser($name, $email, $password) {

if($this->connect->query("INSERT INTO users(name, email, password)
		VALUES('$name', '$email', '$password')") == TRUE) {
	session_start();
    $SESSION['name'] = $name;

	echo "<script> window.location.href = 'file_encrypter.php'</script>";
	exit();
	}
	else {
		echo "<script> window.location.href = 'Signup.html'</script>";
		exit();
	}
	$this->connect->close();
}

function verifyUser($email, $password) {
	$result = $this->connect->query("Select name from users where email='$email' and password='$password'");
	if($result->num_rows == 1) {
		$name = $result->fetch_assoc();
		session_start();
    $_SESSION["name"] = $name["name"];
    echo "<script> window.location.href = './file_encrypter.php'</script>";
    exit();
    }
	else {
		echo "<script> window.location.href = './login.html'</script>";
		exit();
	}
	$this->connect->close();
}



}

//$connect = new dbconnect();
//$connect->connection();
?>