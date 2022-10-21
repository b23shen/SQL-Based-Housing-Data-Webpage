<!DOCTYPE html>
<html>
<head>
    <title>Wish List</title>
</head>
<body style="background-image: url(login.jpg);">
<?php

include('connect.php'); 
echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">';

$uid = $_GET['id'];
echo '<input type="button" value="Return to search page" class="btn1" onclick="location=\'search.php?id=' . $_GET["id"] .'\'">'; 
echo "<input id='uid' value='" . $uid . "' hidden>";
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM wish_list WHERE uid=" . $uid;

$result = $conn->query($sql);

$count = $result->num_rows;

if ($count > 0){
    
    echo '<div class="row">';
    while ($currwish = $result->fetch_assoc()){
        $sqlhouse = "SELECT * FROM houses WHERE id=" . $currwish['hid'];
        $house = $conn->query($sqlhouse)->fetch_assoc();
        echo '<div class="col-sm-6">';
        echo '<div class="card">';
        
        echo '<div class="card-body">';
        echo '<h5 class="card-title"> '.$house["address"].'</h5>';
        echo '<h5 class="card-text">Price: $'.$house["price"].'</p>';
        $sql = "select * from wish_list where hid=" . $house["id"] . " and uid!=". $uid;
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
        $sql = "select * from rating where hid=" . $house["id"];
        $rating = $conn->query($sql);
        if ($rating->num_rows > 0){
            $sql = "select AVG(rate) AS avg from rating r WHERE hid=" . $house["id"];
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

        // Comment
        $sql = "select message from wish_list where uid = " . $uid . " and hid=" . $house["id"];
        $comment = $conn->query($sql);
        if ($comment->num_rows > 0){
            $currcomment = $conn->query($sql)->fetch_assoc()["message"];
            echo "<h5>My comment: ". $currcomment ."</h5>";
        }


        // owner
        $sql = "select u.email from houses AS h, user AS u where h.owner = u.id and h.id=" . $house["id"];
        $owner = $conn->query($sql);
        if ($owner->num_rows > 0){
            $curremail = $conn->query($sql)->fetch_assoc()["email"];
            echo "<h5>The owner of this house is: ". $curremail ."</h5>";
        }
        echo "<input class='btn btn-primary' type='button' id='" . $house["id"] . "' value='Remove from wish list' name='remove_wish'>";


        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
}
?>
</body>
</html>
<style >
    .card{
        margin: 20px;
    }
    .btn1:hover {
        opacity: 1;
    }

    .btn1 {
        right: 0;
        background-color: #04AA6D;
        color: white;
        padding: 8px 10px;
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
            var uid = document.getElementById('uid').value;
            var wishbuttons = document.getElementsByName('remove_wish');
            wishbuttons.forEach((currbtn)=>{
                currbtn.addEventListener("click", function(){
                var hid = currbtn.id;
                var conf = {};
                conf['uid'] = uid;
                conf['hid'] = hid;
                
                console.log(conf);

                $.ajax({
                    type: "POST",
                    url: 'removefromwish.php',
                    data: conf,
                    success: function(response){
                        alert("Successfully removed from wish list");
                        location.reload();
                        
                    },
                    error: function(data){
                        alert("Something goes wrong");
                    }
                });
            });
            });
</script>
