<?php
// เปิดใช้งานการแสดงข้อผิดพลาดของ PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
try {
    // รับข้อมูลจากแบบฟอร์ม (หรือจากข้อมูลที่ส่งมา)
    $UsersLiability_id  = $_POST['UsersLiability_id']; // แทนด้วยชื่อฟิลด์ที่เกี่ยวข้อง
    $DebtID = $_POST['DebtID']; // แทนด้วยชื่อฟิลด์ที่เกี่ยวข้อง

 

  
        // เขียนคำสั่ง SQL สำหรับการเพิ่มข้อมูลใหม่
        $sql = "UPDATE `UsersLiability_id` SET `DebtID`=:DebtID WHERE `UsersLiability_id` = :UsersLiability_id";
        
        // เตรียมคำสั่ง SQL
        $statement = $conn->prepare($sql);
        
        // ผูกค่าพารามิเตอร์
        $statement->bindParam(':UsersLiability_id', $UsersLiability_id );
        $statement->bindParam(':DebtID', $DebtID);



        // ประมวลผลคำสั่ง SQL
        $statement->execute();

        $response->success('Success','Edit asset successfully', 200); // ส่งข้อความสำเร็จถ้าเพิ่มข้อมูลได้สำเร็จ
    
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
    exit;
}

?>
