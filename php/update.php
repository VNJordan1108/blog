<?php
	include("database.php");

	if($_SESSION['user'] != ""){
        $user = $_SESSION['user'];
            
            if(!empty($_GET['id']))
            {
                $id = $_GET['id'];
                if($_SERVER['REQUEST_METHOD'] = "POST") {
                    $title = htmlentities(mysqli_real_escape_string($conn,$_POST['title']));
                    $subtitle = htmlentities(mysqli_real_escape_string($conn, $_POST['subtitle']));
                    $content = mysqli_real_escape_string($conn, $_POST['content']);
                    $banner = htmlentities(mysqli_real_escape_string($conn, $_POST['banner']));
                    $tags = serialize($_POST['tags']);
                    $query = "UPDATE posts SET title = '$title', content = '$content', banner = '$banner', subtitle = '$subtitle', cats_id = '$tags' WHERE id = $id";
                    mysqli_query($conn,$query);
                    header("location:../dashboard.php");
                }
                else
                {
                    header("location:../dashboard.php");
                }
            }
	}
	else{
		header("location:../admin.php");
	}

	
?>