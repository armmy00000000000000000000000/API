<?php

try {
    // ตรวจสอบค่าของตัวแปร $Check
    $Check = isset($_POST['Show']) ? $_POST['Show'] : ''; // ตรวจสอบว่ามีค่า $_POST['Show'] หรือไม่ ถ้าไม่มีกำหนดให้เป็นค่าว่าง

    // เขียนคำสั่ง SQL สำหรับการเลือกข้อมูล
    $sql = "SELECT * FROM Liability";

    if ($Check == 'ONE') {
        $ID = isset($_POST['ID']) ? $_POST['ID'] : ''; // ตรวจสอบว่ามีค่า $_POST['ID'] หรือไม่ ถ้าไม่มีกำหนดให้เป็นค่าว่าง
        $sql = "SELECT * FROM Liability WHERE id = :ID";
    }

    // เตรียมคำสั่ง SQL
    $statement = $conn->prepare($sql);

    // ผูกค่าพารามิเตอร์ถ้ามี
    if ($Check == 'ONE') {
        $statement->bindParam(':ID', $ID);
    }

    // ประมวลผลคำสั่ง SQL
    $statement->execute();

    // ดึงข้อมูลทั้งหมดออกมา
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    if ($result) {
        $response->success($result, 'Success', 200);
    } else {
        $response->error('No data found', 404);
    }
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
    exit;
}
?>
