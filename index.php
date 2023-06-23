<?php
    include("php/database.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Jordan's Blog</title>
        <link rel="icon" type="image/x-icon" href="assets/imgs/icon2.webp" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php">Jordan's Blog</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id = "navbarResponsive">
                    <ul class="navbar-nav ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="aboutme.php">About</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="allposts.php">All Posts</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('assets/imgs/IMG_1143.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading">
                            <h1>Jordan's Blog</h1>
                            <span class="subheading">A place where I express my feelings</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content-->
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="tags">
                        <p>Sort by tags:</p>
                        <?php 
                            $query = "SELECT name, slug FROM categories";
                            $result = mysqli_query($conn, $query);
                        
                            while ($row = mysqli_fetch_assoc($result))
                                {
                                    $slug = $row['slug'];
                                    $name = $row['name'];
                        ?>
                                <a href="category.php?tags=<?php echo $slug;?>"><button type = "button"><?php echo $name;?></button></a>
                        <?php
                                }
                        ?>
                    </div>

                    <hr>
                    <?php
                    $query =  "SELECT id, title, subtitle, author, date_posted from posts ORDER BY id DESC LIMIT 4";
                    $result = mysqli_query($conn,$query);

                    if ($result)
                    {
                        while ($row = mysqli_fetch_assoc($result)) {
                            
                            $id = $row['id'];
                        ?>
                            <div class="post-preview">
                                <a href="post.php?id=<?php echo $id;?>">
                                    <h2 class="post-title"><?php echo $row['title'];?></h2>
                                    <h3 class="post-subtitle"><?php echo $row['subtitle'];?></h3>
                                </a>
                                <p class="post-meta">
                                    Posted by
                                    <a href="aboutme.php"><?php echo $row['author'];?></a>
                                    on <?php echo $row['date_posted'];?>
                                </p>
                            </div>
                            <hr class="my-4">
                            <?php 
                        }
                    }
                    ?>
                    <!-- Pager-->
                    <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="allposts.php">Older Posts →</a></div>
                </div>
            </div>
        </div>
        <!-- Footer-->
        <footer class="border-top">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <ul class="list-inline text-center">
                            <li class="list-inline-item">
                                <a href="https://www.youtube.com/channel/UCHUMvO94gNJdN6fSwYXQeOw" target="_blank" rel="noopener noreferrer">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-youtube fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://www.fb.me/j0rd4nisbeingsad/" target="_blank" rel="noopener noreferrer">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://www.instagr.am/j._dnnnn/" target="_blank" rel="noopener noreferrer">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-instagram fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="small text-center text-muted fst-italic">Copyright &copy; Jordan <?php echo date("Y");?></div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
