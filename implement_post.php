<?php

include "connect.php";
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$addr = $_POST['addr'];
$bedroom = $_POST['bdrm'];  
$bathroom = $_POST['btrm'];
$den = $_POST['den'];  
$pet = $_POST['pet'];
$park = $_POST['park'];
$price = $_POST['price'];
$uid = $_POST['uid'];


$sql = "INSERT INTO houses (bedroom, bathroom, den, address,lat, `long`, price, Pet_friendly, Parking, owner) 
VALUES('" . $bedroom . "' , '" . $bathroom . "' , '" . $den . "',  '" . $addr . "',43.66993150,-79.37546270,'" . $price . "' , '" . $pet . "', '" . $park . "', '" . $uid . "')";

$result = $conn->query($sql);

echo "<div style=\"text-align:center\">";

echo '<h1> Successfully posted!</h1>';
echo '<input type="button" value="My Wish List" class="btn" onclick="location=\'wishlist.php?id=' . $_POST["uid"] .'\'">'; 
echo str_repeat('&nbsp;', 3);
echo '<input type="button" value="Log out" class="btn" onclick="location=\'login.php\'">';
echo str_repeat('&nbsp;', 3);
echo '<input type="button" value="Search" class="btn" onclick="location=\'search.php?id=' . $_POST["uid"] .'\'">';

?>
<style >
    body, html {
  height: 100%;
}

* {
  box-sizing: border-box;
}

.btn:hover {
  opacity: 1;
}

.btn {
  right: 0;
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.9;
  border-radius: 6px;
}

body {
  background-image: url('login.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}



</style>