
<?php
$dbname = 'mysql:dbname=zkyqpszw_officedb;host=118.27.130.236';
$username = 'zkyqpszw_officedb';
$password = 'Chaiya094';

try {
    $conn = new PDO($dbname, $username, $password);
        if ($conn) {
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
        }

?>



