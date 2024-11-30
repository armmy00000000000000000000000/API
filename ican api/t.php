<?php
// เปิดใช้งานการแสดงข้อผิดพลาดของ PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include autoload.php ของ PHPExcel
require_once("vendor/autoload.php");

$c = mysqli_connect("118.27.130.236", "zkyqpszw_icandefine", "DEVican#", "zkyqpszw_icandefine");
if (!$c) {
    die("การเชื่อมต่อกับฐานข้อมูลล้มเหลว: " . mysqli_connect_error());
}
mysqli_query($c, "SET NAMES UTF8");

$xlsx = "Liabilityimport.xlsx";
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($xlsx);
if (!$spreadsheet) {
    die("ไม่สามารถโหลดไฟล์ Excel: $xlsx");
}

$worksheet = $spreadsheet->getActiveSheet();
$worksheet_arr = $worksheet->toArray();
if (!$worksheet_arr) {
    die("ไม่สามารถแปลงข้อมูลในไฟล์ Excel เป็นรายการของ PHP: $xlsx");
}

foreach ($worksheet_arr as $key => $data) {
    if ($key > 0) {
        $sql = "INSERT INTO fruit (id, title) VALUES (NULL, '{$data[1]}')";
        $q = mysqli_query($c, $sql);
        if ($q) {
            echo "<div>เพิ่มข้อมูล {$data[1]} ลงในตาราง fruit เรียบร้อย</div>";
        } else {
            echo "<div>เกิดข้อผิดพลาดในการเพิ่มข้อมูล: " . mysqli_error($c) . "</div>";
        }
    }
}

mysqli_close($c);
?>
