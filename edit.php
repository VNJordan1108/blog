<?php
    include("php/database.php");

    if ($_SESSION['user']=="")
    {
        header("location:admin.php");
    }

    $user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/imgs/icon.webp" type="image/x-icon">
    <link rel="stylesheet" href="style/addstyle.css" type="text/css">
    <script src="tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: 'textarea',
            resize: false,
            height: 700,
            plugins: [
            'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
            'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'code', 'fullscreen', 'insertdatetime',
            'media', 'table', 'emoticons', 'template', 'help'
            ],
            toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
            'forecolor backcolor emoticons | help',
            menu: {
            favs: { title: 'My Favorites', items: 'code visualaid | searchreplace | emoticons' }
            },
            menubar: 'favs file edit view insert format tools table help',
            content_css: 'css/content.css'
        });
    </script>
    <title>Edit post</title>
</head>
<body>
    <div class="nav">
        <a href="dashboard.php"><img src="assets/imgs/icon.webp" alt="Logo" class = "logo"></a>
        <div class="right-links">
        <a href="profile.php">
            <?php
                $query = "SELECT image_url FROM users WHERE username='$user'";
                $result = mysqli_query($conn,$query);
                if ($row = mysqli_fetch_assoc($result))
                    $url = $row["image_url"];
                if ($url == "")
                    { ?>
                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt=<?php echo $user ?> title=<?php echo $user ?> style="width: 30px;height: 30px;display: inline;border: 0;border-radius: 15px;">
                    <?php }
                else { ?>
                <img src=<?php echo $url;?> alt=<?php echo $user ?> title=<?php echo $user ?> style = "width: 30px;height: 30px;display: inline;border: 0;border-radius: 15px;">
                <?php }
            ?>
        </a>
            <a href="php/logout.php" class="logout"><button class='btn'>Log out</button></a>

        </div>
    </div>


<?php
    $blogId = $_GET['id'];
    $query = "SELECT content, title, banner, subtitle, cats_id FROM posts WHERE id = $blogId";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $content = $row['content'];
        $title = $row['title'];
        $subtitle = $row['subtitle'];
        $banner = $row['banner'];
        $tags = unserialize($row['cats_id']);
    }
?>

<main id = "userform">

<form action="php/update.php?id=<?php echo $blogId;?>" method="post" class="form-area" id>
    <h2>Update a blog post</h2>
    <hr>
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" required class = "input" placeholder="Enter the title here!" value='<?php print $title;?>'>
    <label for="subtitle">Subtitle:</label>
    <input type="text" id="subtitle" name="subtitle" required class = "input" placeholder="Enter the subtitle here!" value='<?php echo $subtitle; ?>'>
    <label for="banner">Banner's URL:</label>
    <input type="url" id="banner" name="banner" class = "input" placeholder="Enter the banner's URL here!" value = '<?php echo $banner; ?>'>
    <p>Tags:</p>
    <?php

    $query = "SELECT * FROM categories";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result))
    {
        $cats_id = $row['cats_id'];
        $slug = $row['slug'];
        $name = $row['name'];
    ?>
        <div class="cbox">
            <label for="anime"><?php echo $name;?></label>
            <input type="checkbox" name="tags[]" id="tags" 
            value = <?php
                echo $cats_id;?>

            <?php
                if (in_array($cats_id, $tags))
                    {
                        echo "checked";
                    }
            ?>
            >
        </div>
    <?php
    }
    ?>

    <a href="createtags.php" class="conf">
        <button class="btn" type="button">
            Create a new tag!
        </button>
    </a>
    <label for="content">Content:</label>
    <textarea id="content" name="content" rows="4" cols="100" class="input" style="width:100%;">
    <?php echo $content; ?>
    </textarea>
    <br>
    <hr>
    <br>
    <div class="conf">
        <button type = "submit" class = "btn">Update</button>
        <a href="#" onclick="myFunction(<?php echo $_GET['id'];?>)"><button type = "button" class = "btn">Delete</button></a>
        <a href="dashboard.php"><button type = "button" class = "btn">Cancel</button></a>
    </div>
</form>


    <script>
        function myFunction(id)
        {
        var r = confirm("Are you sure you want to delete this posts?");
        if(r == true)
        {
            window.location.assign("php/delete.php?id=" + id);
        }
        }
    </script>
</main>

</body>