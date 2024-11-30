<?php
require_once "../condb.php";

// ฟังก์ชันสร้าง API key แบบสุ่ม
function generateApiKey($length = 32) {
    return bin2hex(random_bytes($length / 2));
}

// สร้าง API key ใหม่
$newApiKey = generateApiKey();

// เชื่อมต่อฐานข้อมูลด้วย PDO
try {
    $conn = new PDO("mysql:dbname=zkyqpszw_icandefine;host=118.27.130.236", "zkyqpszw_icandefine", "Chaiya094");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // เพิ่ม API key ลงในฐานข้อมูล
    $query = $conn->prepare("INSERT INTO api_keys (`key`, `status`) VALUES (:key, 'active')");
    $query->bindParam(':key', $newApiKey);
    $query->execute();

    echo "API Key created successfully: " . $newApiKey;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
