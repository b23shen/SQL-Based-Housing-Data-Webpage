<?php

include "connect.php";
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM user WHERE email='" . $email . "'";

$result = $conn->query($sql);

if ($result->num_rows == 1){
	echo 0;
}

else{
	$sql = "INSERT INTO user(email,password) VALUES('" . $email . "', '" . $password . "')";

	$conn->query($sql);

	echo 1;
}

?>