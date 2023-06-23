<?php

session_start();

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "blog";


$conn = mysqli_connect($hostname,$username,$password,$dbname);

if (mysqli_connect_errno())
{
    echo "Failed to connect to database!";
    mysqli_connect_error();
    exit();
}


?>