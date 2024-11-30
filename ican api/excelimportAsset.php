<?php

require_once("vendor/autoload.php");

$c = mysqli_connect("118.27.130.236", "zkyqpszw_icandefine", "DEVican#", "zkyqpszw_icandefine");
mysqli_query($c, "SET NAMES UTF8");

if (isset($_POST['import'])) {
    $xlsx = $_FILES['excel']['tmp_name'];
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($xlsx);
    $v = $spreadsheet->getSheet(0)->toArray();
    foreach ($v as $key => $data) {
        if ($key > 0) {
            $assetID = mysqli_real_escape_string($c, $data[0]); // ใช้ mysqli_real_escape_string เพื่อป้องกัน SQL Injection
            @$assetName = mysqli_real_escape_string($c, $data[1]); // ใช้ mysqli_real_escape_string เพื่อป้องกัน SQL Injection
            $type = mysqli_real_escape_string($c, $data[2]); // ใช้ mysqli_real_escape_string เพื่อป้องกัน SQL Injection

            $checkSql = "SELECT * FROM Asset WHERE AssetID = '$assetID'";
            $checkResult = mysqli_query($c, $checkSql);
            $rowCount = mysqli_num_rows($checkResult);

            if ($rowCount == 0) {
                $sql = "INSERT INTO Asset (AssetID, AssetName, Type) VALUES ('$assetID', '$assetName', '$type')";
                $q = mysqli_query($c, $sql);
            }
        }
    }
    
    if (@$q) {
        echo json_encode(array("status" => "success", "Message" => "success"));
    } else {
        echo json_encode(array("status" => "fail", "Message" => "error"));
    }
}

mysqli_close($c);

?>