<?php
    include("php/database.php");

    if ($_SESSION['user'] == "")
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
        <link rel="stylesheet" href="style/style.css" type="text/css">

        <script src="assets/js/joeblog.js"></script>
        <title>Dashboard</title>
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
        <main>
                    <a href="add.php" class = "add"><button class='btn'>Add a new post</button></a>
                
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Author</th>
                            <th>Title</th>
                            <th>Post Time</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>

                        
                        <?php
                                $query = mysqli_query($conn,"Select * from posts"); // SQL Query
                                while($row = mysqli_fetch_array($query))
                                { ?>
                        <tr>
                                        <td align="center"><?php print $row['id'] ?></td>
                                        <td align="center"><?php print $row['author']?></td>
                                        <td align="center"><a href = "post.php?id=<?php echo $row['id'];?>" style = "color:white;"><?php print $row['title'] ?></a></td>
                                        <td align="center"><?php print $row['date_posted']?></td>
                                        <td align="center"><a href="edit.php?id=<?php echo $row['id'] ?>" style = "color: white;"><button class="btn">Edit</button></a></td>
                                        <td align="center"><a href="#" onclick="myFunction(<?php echo $row['id'];?>)"><button class = "btn">Delete</button></a></td>
                        </tr>
                                <?php } ?>
                    </table>

                    <script>
                        function myFunction(id)
                        {
                        var r = confirm("Are you sure you want to delete this record?");
                        if(r == true)
                        {
                            window.location.assign("php/delete.php?id=" + id);
                        }
                        }
                    </script>
        </main>
    </body>
</html>