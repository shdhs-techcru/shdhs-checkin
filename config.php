<?php

    define('DB_SERVER', 'test'); //server address
    define('DB_USERNAME', ''); //  MySQL Server User
    define('DB_PASSWORD', ''); // MySQL User password
    define('DB_DATABASE', ''); // MySQL Database
    
    $conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

if (mysqli_connect_errno()) {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
?>

