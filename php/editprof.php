<?php
	include("database.php");

	if($_SESSION['user'] != ""){
        $user = $_SESSION['user'];
        if($_SERVER['REQUEST_METHOD'] = "POST") {
            $pass = htmlentities(mysqli_real_escape_string($conn, $_POST['pass']));
            $avatar = htmlentities(mysqli_real_escape_string($conn, $_POST['image_url']));
            $query = "UPDATE users SET password = '$pass', image_url = '$avatar' WHERE username = '$user'";
            mysqli_query($conn,$query);
            header("location:../dashboard.php");
        }
        else
        {
            header("location:../dashboard.php");
        }
	}
	else{
		header("location:../admin.php");
	}

	
?>