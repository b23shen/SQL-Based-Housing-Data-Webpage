 <!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
</head>
<body style="background-image: url(login.jpg)">

<div id = "frm" align="center">  
         
        <form name="f1"  method = "POST" class="container"> 
            <h1>Sign Up</h1>  
            <p>  
                <label for="email"> Email </label>  
                <input type = "text" id ="email" placeholder="Enter email" name  = "email" required />  
            </p>  
            <p>  
                <label for="pass"> Password </label>  
                <input type = "password" id ="pass" placeholder="Enter password" name  = "pass" required />  
            </p>  
            <p>     
                <input class="btn" type =  "button" id = "btn" value = "Sign Up" onclick="validation()" />  

            </p>  
        </form>  
</div> 

</body>
</html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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
            var btn = document.getElementById('btn');
            btn.addEventListener("click", function(){
            	var email = document.getElementById('email').value;
            	var password = document.getElementById('pass').value;
            	var conf = {};
            	conf['email'] = email;
            	conf['password'] = password;
            	if ((email == "") || (password == "")){
                    return false;
                }

            	$.ajax({
            		type: "POST",
            		url: 'signing.php',
            		data: conf,
            		success: function(response){
            			if (response == 1){
            				alert("sign up successfully");
            				window.location = "login.php";
            			}
            			else{
            				alert("email already exists!");
            			}
            			
            		},
            		error: function(data){
            			alert("Something goes wrong");
            		}
            	});
            });
            
            
</script>  

<style>
body, html {
  height: 100%;
}

* {
  box-sizing: border-box;
}



/* Add styles to the form container */
.container {

  margin: 20px;
  max-width: 300px;
  padding: 16px;
  background-color: white;
  opacity: 0.95;
  border-radius: 6px;
}

/* Full-width input fields */
  input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
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
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
  border-radius: 6px;
}

.btn:hover {
  opacity: 1;
}


</style>  