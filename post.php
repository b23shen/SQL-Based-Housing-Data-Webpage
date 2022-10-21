<!DOCTYPE html>
<html>
<head>
    <title>Post Your House</title>
</head>
<body style="background-image: url(login.jpg);">
<?php

include('connect.php'); 


$uid = $_GET['id'];

$sql = "select email from user where id=" . $uid;

$result = $conn->query($sql);

$count = $result->num_rows;

if ($count == 1){
  $email = $result->fetch_assoc()["email"];
}

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

echo '<div>';
echo '<input type="button" value="My Wish List" class="btn" onclick="location=\'wishlist.php?id=' . $_GET["id"] .'\'">'; 
echo str_repeat('&nbsp;', 3);
echo '<input type="button" value="Log out" class="btn" onclick="location=\'login.php\'">';
echo str_repeat('&nbsp;', 3);
?>

<div id = "frm">  
         
        <form name="f1" action = "implement_post.php" onsubmit = "return validation()" method = "POST" class="container"> 
            <h1>Post Your House Information!</h1>  
            
            <p>
                <label for="bdrm"> Address: </label>  
                <input type = "text" id ="addr" name  = "addr" /> 
            </p> 
            <p>
                <label for="bdrm"> Number of Bedrooms: </label>  
                <input type = "text" id ="bdrm" name  = "bdrm" /> 
            </p> 
            
            <p>  
                <label for="btrm"> Number of Bathrooms: </label>  
                <input type = "text" id ="btrm" name  = "btrm" />  
            </p> 
            <p>  
                <label for="den"> Den </label>  
                <select id ="den" name  = "den" />
                    <option value="1"> Has Den</option>  
                    <option value="0"> Has No Den</option>
                </select>
            </p> 
            <p>  
                <label for="pet"> Pet_Friendly </label>  
                <select id ="pet" name  = "pet" />  
                    <option value="1"> Yes</option>  
                    <option value="0"> No</option>
                </select>
            </p> 
            <p>  
                <label for="park"> Parking </label>  
                <select id ="park" name  = "park" />  
                    <option value="1"> Yes</option>  
                    <option value="0"> No</option>
                </select>
            </p> 

            <p>  
                <label for="btrm"> Price: </label>  
                <input type = "text" id ="price" name  = "price" />  
            </p>
            <p>     
                <input type =  "submit" id = "btn1" value = "Post!" class="btn1" />  
            </p> 
            <input type="text" id="uid" value="<?php echo $_GET["id"]?>" name="uid" hidden> 
            
        </form>  
    </div>  

</body>
</html>
<style>

  
body, html {
  height: 100%;
}

* {
  box-sizing: border-box;
}



/* Add styles to the form container */
.container {
  position: absolute;
  right: 30%;
  margin: 20px;
  max-width: 800px;
  padding: 16px;
  background-color: white;
  opacity: 0.95;
  border-radius: 6px;
}

/* Full-width input fields */
  input[type=text], select {
  width: 100%;
  padding: 5px;
  margin: 5px 0 5px 0;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, select:focus{
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit button */
.btn1 {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
  border-radius: 6px;
}


.btn1:hover, .btn:hover {
  opacity: 1;
}

.btn {
  right: 0;
  background-color: #04AA6D;
  color: white;
  padding: 10px 12px;
  border: none;
  cursor: pointer;
  opacity: 0.9;
  border-radius: 6px;
}



</style> 