<?php

include "connect.php";
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$uid = $_POST['uid'];
$hid = $_POST['hid'];
$comment = $_POST['comment'];
$rate = $_POST['rate'];


$sql = "INSERT INTO rating(uid,hid,comment,rate) VALUES('" . $uid . "', '" . $hid . "', '" . $comment . "', '".$rate."')";

$result = $conn->query($sql);

echo $sql;

?>