<?php
	include("database.php");

	if($_SESSION['user'] != ""){
        $user = $_SESSION['user'];
        if($_SERVER['REQUEST_METHOD'] = "POST") {
            $tags = "#".htmlentities(mysqli_real_escape_string($conn, $_POST['tags']));
            $slug = htmlentities(mysqli_real_escape_string($conn, $_POST['slug']));
            $query = "SELECT * FROM categories";
            $exist = true;
            $result = mysqli_query($conn,$query);
            while($row = mysqli_fetch_array($result))
            { 
                if($tags == $row['name'])
                {
                    $exist = false;
                    ?>
                    <script> alert("Tag's name has been taken!"); </script>    
                    <script> window.location.assign("../createtags.php"); </script>
                    <?php
                }
            }
            if ($exist == true)
            {
                $query = "INSERT INTO categories (name, slug) VALUES ('$tags','$slug')";
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