

<?php
    $host = "118.27.130.236";
    $username = "zkyqpszw_icandefine";
    $password = "DEVican#";
    $database = "zkyqpszw_icandefine";

    // Create DB Connection
    $conn = mysqli_connect($host, $username, $password, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
   
?>