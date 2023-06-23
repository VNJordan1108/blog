<?php
   include("database.php");
   if($_SESSION['user']){
   }
   else {
      header("location:login.php");
   }

   if($_SERVER['REQUEST_METHOD'] == "GET")
      {
         $id = $_GET['id'];
         mysqli_query($conn, "DELETE FROM posts WHERE id='$id'");
         header("location:../dashboard.php");
      }

?>