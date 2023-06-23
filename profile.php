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
    <link rel="stylesheet" href="style/profile.css" type="text/css">
    <title>Edit profile</title>
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

<main id = "userform">

<form action = "php/editprof.php" method="post" class="form-area">
        <h2>Edit profile</h2>
        <hr>
        <label for="user">Username:</label>
        <input type="text" readonly id = "user" name="user" value=<?php echo $user?> class = "input">
        <label for="pass">Password:</label>
        <input type="password" name="pass" id="pass" class = "input" required value=<?php
                    $query = "SELECT password FROM users WHERE username='$user'";
                    $result = mysqli_query($conn,$query);
                    if ($row = mysqli_fetch_assoc($result))
                        echo $row['password'];
                    ?>>
        <label for="image_url">Image:</label>
        <input type="url" id = "image_url" name="image_url" class = "input" value=<?php
                    $query = "SELECT image_url FROM users WHERE username='$user'";
                    $result = mysqli_query($conn,$query);
                    if ($row = mysqli_fetch_assoc($result))
                        echo $row['image_url'];?>>
        <p>Avatar:</p>
        <br>
                    <?php
                        if ($url == "")
                            {
                                ?>
                                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt=<?php echo $user ?> title=<?php echo $user ?> style="width:50%; height:50%; display: flex; align-self:center;">
                                <?php
                            }
                        else
                            {
                                ?>
                                <img src=<?php echo $url;?> alt=<?php echo $user ?> title=<?php echo $user ?> style="width:50%; height:50%; display: flex; align-self:center;">
                                <?php
                            }
                    ?>
        <br>
    <div class="conf">
        <button type = "submit" class = "btn">Save</button>
        <a href="dashboard.php"><button type = "button" class = "btn">Cancel</button></a>
    </div>
    <br>
    <hr>
    <br>
    <a href="createaccount.php"><button type = "button" class="btn">Create new admin account</button></a>
   
    
</form>

</main>
</body>