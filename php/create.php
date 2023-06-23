<?php
	include("database.php");

	if($_SESSION['user'] != ""){
        $user = $_SESSION['user'];
        if($_SERVER['REQUEST_METHOD'] = "POST") {
            $user = htmlentities(mysqli_real_escape_string($conn, $_POST['user']));
            $pass = htmlentities(mysqli_real_escape_string($conn, $_POST['pass']));
            $avatar = htmlentities(mysqli_real_escape_string($conn, $_POST['image_url']));
            $query = "Select * from users";
            $exist = true;
            $result = mysqli_query($conn,$query);
            while($row = mysqli_fetch_array($result))
            { 
                if($user == $row['user'])
                {
                    $exist = false;
                    ?>
                    <script> alert("Username has been taken!"); </script>    
                    <script> window.location.assign("../createaccount.php"); </script>
                    <?php
                }
            }
            if ($exist == true)
            {
                $query = "INSERT INTO users (username,password,image_url) VALUES ('$user','$pass','$avatar')";
                mysqli_query($conn,$query);
                header("location:../dashboard.php");
            }
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