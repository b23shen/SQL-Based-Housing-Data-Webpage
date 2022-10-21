<html>  
<head>  
    <title>LOGIN</title>  
      
    <link rel = "stylesheet" type = "text/css" href = "style.css">   
</head>  
<body style="background-image: url(login.jpg)"> 
    
    <h1 style="font-family: cursive;font-size: 60px;color:#42cef5;position: absolute;left: 5%;top: 5%">Welcome to Easy Rent</h1>    
    <div id = "bg-img">  
         
        <form name="f1" action = "implement.php" onsubmit = "return validation()" method = "POST" class="container"> 
        <h1>Login</h1>  
            <p>  
                <label for="email"><b> Email </b></label>  
                <input type = "text" placeholder="Enter email" id ="email" name  = "email" />  
            </p>  
            <p>  
                <label for="pass"> <b>Password</b> </label>  
                <input type = "password" placeholder="Enter password" id ="pass" name  = "pass" />  
            </p>  
            <p>     
                <input class="btn" type =  "submit" id = "btn" value = "Login" /> 
            </p>  
            <p>
                <input class="btn" type = "button" id = "signup" value = "Sign Up" onclick = "location= 'signup.php'" />  
            </p>

        </form>  
    </div>  
      
    <script>  
            function validation()  
            {  
                var id=document.f1.email.value;  
                var ps=document.f1.pass.value;  
                if(id.length=="" && ps.length=="") {  
                    alert("Email address and Password fields are empty");  
                    return false;  
                }  
                else  
                {  
                    if(id.length=="") {  
                        alert("Email is empty");  
                        return false;  
                    }   
                    if (ps.length=="") {  
                    alert("Password field is empty");  
                    return false;  
                    }  
                }                             
            }  
     </script> 

     <style>
         

     </style> 







</body>  
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
  right: 10;
  margin: 30px;
  max-width: 300px;
  padding: 16px;
  background-color: white;
  border-radius: 6px;
  opacity: 0.95;
}


/* Full-width input fields */
  input[type=text], input[type=password] {
  width: 100%;
  padding: 15px 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit button */
.btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.btn:hover {
  opacity: 1;
}


</style>   
</html> 


