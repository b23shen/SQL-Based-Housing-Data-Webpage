<?php

include "connect.php";
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$uid = $_POST['uid'];
$hid = $_POST['hid'];

$sql = "DELETE FROM wish_list WHERE hid = " . $hid . " AND uid = " . $uid;

$result = $conn->query($sql);

echo "Success";

?>