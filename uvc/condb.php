
<?php
$dbname = 'mysql:dbname=uvc;host=addpaycrypto.com';
$username = 'root';
$password = 'it_addpay2022';

try {
    $conn = new PDO($dbname, $username, $password);
        if ($conn) {
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
        }


?>



