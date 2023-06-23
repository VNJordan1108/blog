<?php
    include("database.php");
	if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
        if($_SERVER['REQUEST_METHOD'] = "POST") {
            $title = htmlentities(mysqli_real_escape_string($conn,$_POST['title']));
            $subtitle = htmlentities(mysqli_real_escape_string($conn,$_POST['subtitle']));
            $banner = mysqli_real_escape_string($conn,$_POST['banner']);
            $content = mysqli_real_escape_string($conn, $_POST['content']);
            //above code tends to delete all tags beside the <p> tags
            $tags = serialize($_POST['tags']);

            $date = date("jS F Y");
            
            mysqli_query($conn,"INSERT INTO posts (author, title, subtitle, date_posted, content, banner, cats_id) VALUES ('$user','$title', '$subtitle','$date','$content','$banner', '$tags')");
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