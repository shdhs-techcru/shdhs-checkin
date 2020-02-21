<?php

    define('DB_SERVER', 'localhost'); //server address
    define('DB_USERNAME', 'sdlc'); //  MySQL Server User
    define('DB_PASSWORD', 'techcru2019'); // MySQL User password
    define('DB_DATABASE', 'sdlc'); // MySQL Database
    
    $conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

if (mysqli_connect_errno()) {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
?>

