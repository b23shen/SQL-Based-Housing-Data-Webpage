<?php

include "connect.php";
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$uid = $_POST['uid'];
$hid = $_POST['hid'];
$message = $_POST['message'];

$sql = "INSERT INTO wish_list(uid,hid,message) VALUES('" . $uid . "', '" . $hid . "', '" . $message . "')";

$result = $conn->query($sql);

echo "Success";

?>