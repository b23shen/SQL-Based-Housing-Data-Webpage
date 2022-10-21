<?php 

include "connect.php";
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];  
$password = $_POST['pass'];  
      
//to prevent from mysqli injection  
          
      
$sql = "select * from user where email = '" . $email . "' and password = '" . $password . "'";  


$result = $conn->query($sql);

$count = $result->num_rows;
          
        if($count == 1){  
            $url = "Location: http://127.0.0.1:8000/cs348project/search.php?id=" . $result->fetch_assoc()['id'];
            header($url);
            exit();

        }  
        else{  
            echo "<div style=\"text-align:center\">";
            echo "<h1> Login failed. Invalid email or password.</h1>";

            echo '<input type="button" value="Back to Login Page" class="btn btn-primary" onclick="location=\'login.php\'">';
            echo str_repeat('&nbsp;', 3);
            echo '<input type="button" value="Sign Up" class="btn btn-primary" onclick="location=\'signup.php\'">';

        }     

$conn->close();



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
