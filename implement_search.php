<!DOCTYPE html>
<html>
<head>
    <title>Houses Information</title>
</head>
<body style="background-image: url(login.jpg);">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


<?php
include('connect.php');  


$bedroom = (int)$_POST['bdrm'];  
$bathroom = (int)$_POST['btrm'];
$den = (int)$_POST['den'];  
$pet = (int)$_POST['pet'];
$park = (int)$_POST['park'];
$min = (int)$_POST['min'];
$max = (int)$_POST['max'];
$uid = (int)$_POST['uid'];
echo '<div>';
echo '<input type="button" value="My Wish List" class="btn btn-primary" onclick="location=\'wishlist.php?id=' . $uid .'\'">';
echo str_repeat('&nbsp;', 3);
echo '<input type="button" value="Log out" class="btn btn-primary" onclick="location=\'login.php\'">';
echo '</div>';
echo "<input id='uid' value='" . $uid . "' hidden>";
      
//to prevent from mysqli injection  
          
      
$sql = "select * from houses where bedroom = '$bedroom' and bathroom = '$bathroom'
and Den = '$den' and pet_friendly = '$pet' and parking = '$park' and price >= '$min' and price <= '$max' ORDER BY pop DESC";  

$result = $conn->query($sql);

$count = $result->num_rows;

echo '<div>';          
if ($count > 0) {
    // output data of each row
    echo '<div class="row">';
    while($row = $result->fetch_assoc()) {
        
        echo '<div class="col-sm-6">';
        echo '<div class="card">';
        
        echo '<div class="card-body">';
        echo '<h5 class="card-title"> '.$row["address"].'</h5>';
        echo '<h5 class="card-text">Price: $'.$row["price"].'</p>';

        // get wishlist
        $sql = "select * from wish_list where hid=" . $row["id"] . " and uid!=". $uid;
        $wish_list = $conn->query($sql);
        if ($wish_list->num_rows > 0){
         echo "<h5>This house is liked by:</h5>";
         echo "<ul>";
        }
        while ($curr = $wish_list->fetch_assoc()){
         if ($curr["uid"] != $uid){
             $sql = "select * from user where id=" . $curr["uid"];
             $curremail = $conn->query($sql)->fetch_assoc()["email"];
             echo "<li>" . $curremail . ": ". $curr["message"] ."</li>";
         }
        }
        echo "</ul>";

        // get rating
        $sql = "select * from rating where hid=" . $row["id"];
        $rating = $conn->query($sql);
        if ($rating->num_rows > 0){
            $sql = "select AVG(rate) AS avg from rating r WHERE hid=" . $row["id"];
            $avg = $conn->query($sql)->fetch_assoc()["avg"];
            echo "<h5>The Overall Rating for this house is: ". $avg ."</h5>";
            echo "<h5>Comments from raters</h5>";
            echo "<ul>";
            while ($curr = $rating->fetch_assoc()){
                $sql = "select * from user where id=" . $curr["uid"];
                $curremail = $conn->query($sql)->fetch_assoc()["email"];
                echo "<li>" . $curremail . "(Rates this house as ". $curr["rate"] . "): ". $curr["comment"] ."</li>";
            }
        }
        else{
             echo "<h5>There is no rating for this house currently</h5>";
        }


        echo "<hr>";
        echo "<input type='text' id='message" . $row["id"] . "' placeholder='Leave a message here if you want' style='width:70%;margin: 5px'>";
        echo "<input class='btn btn-primary' type='button' id='" . $row["id"] . "' value='Add to wish list' name='add_wish'>";
        echo "<br>";
        echo "<hr>";
        echo "<label> Rating (1-5) </label>";
        echo "<select id='rate" . $row["id"] . "' style='width:70%;margin: 5px'>";
        echo "<option value='1'> 1 </option>";
        echo "<option value='2'> 2 </option>";
        echo "<option value='3'> 3 </option>";
        echo "<option value='4'> 4 </option>";
        echo "<option value='5'> 5 </option>";
        echo "</select>";
        echo "<input type='text' id='comment" . $row["id"] . "' placeholder='Leave a comment for your rating' style='width:70%;margin: 5px'>";
        echo "<input class='btn btn-primary' type='button' id='" . $row["id"] . "' value='Rate this house' name='rate_this_house'>";

        
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
    }
    echo '</div>';
} else {
    echo '0 result';;
}
echo '</div>';
   


$conn->close();
?>

</body>
</html>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>  

			var uid = document.getElementById('uid').value;
            var wishbuttons = document.getElementsByName('add_wish');
            wishbuttons.forEach((currbtn)=>{
            	currbtn.addEventListener("click", function(){
            	var hid = currbtn.id;
            	var messageid = "message" + hid;
            	var message = document.getElementById(messageid)
            	var conf = {};
            	conf['uid'] = uid;
            	conf['hid'] = hid;
            	conf['message'] = message.value;
            	console.log(conf);

            	$.ajax({
            		type: "POST",
            		url: 'addtowishlist.php',
            		data: conf,
            		success: function(response){
            			alert("Successfully added to wish list");
            			
            		},
            		error: function(data){
            			alert("Something goes wrong");
            		}
            	});
            });
            });

            var ratebuttons = document.getElementsByName('rate_this_house');
            ratebuttons.forEach((currbtn)=>{
                currbtn.addEventListener("click", function(){
                var hid = currbtn.id;
                var rateid = "rate" + hid;
                var rate = document.getElementById(rateid);
                var commentid = "comment" + hid;
                var comment = document.getElementById(commentid)
                var conf = {};
                conf['uid'] = uid;
                conf['hid'] = hid;
                conf['comment'] = comment.value;
                conf['rate'] = rate.value;
                console.log(conf);

                $.ajax({
                    type: "POST",
                    url: 'rating.php',
                    data: conf,
                    success: function(response){
                        alert("Successfully rated this house");
                        
                    },
                    error: function(data){
                        alert("Something goes wrong");
                    }
                });
            });
            });
            
            
            
</script>  
<style >
    .card{
        margin: 20px;
    }


</style>

