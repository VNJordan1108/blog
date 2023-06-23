<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style/style.css">
    <link rel="icon" href="assets/imgs/icon.webp" type="image/x-icon">
    <title>Login</title>
</head>
<body>
    
    <div class="container">
        <div class="box form-box">

        <?php
            include("php/database.php");
            if (isset($_POST['submit']))
            {
                $username = mysqli_real_escape_string($conn, $_POST['username']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);
                $query = mysqli_query($conn, "Select * from users WHERE username='$username'");                                                                          // users table
                $exists = mysqli_num_rows($query);
                $table_users = "";
                $table_password = "";
                while($row = mysqli_fetch_assoc($query))
                {
                    $table_users = $row['username'];     
                    $table_password = $row['password'];
                    
                }
                if(($username == $table_users) && ($password == $table_password))
                {
                    if (!isset($_SESSION['user']))
                        $_SESSION['user'] = $username;

                    header("location: dashboard.php");

                
                }
                else
                {
                    echo "<div class = 'message'><p>Wrong Username or Password</p></div><br>";
                    echo "<a href='admin.php'><button class = 'btn'>Go Back</button></a>";
                }
            }
            else {
            
        
        ?>

            <header>Admin Login</header>

            <form action="" method="POST">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id ="username" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id ="password" required>
                </div>
    
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
            </form>
            <a href="index.html" class = 'backwards'><button class = "btn">Go back to blog</button></a>
        </div>
        <?php } ?>
    </div>

</body>
</html>