<?php
// เปิดใช้งานการแสดงข้อผิดพลาดของ PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
try {
    // รับข้อมูลจากแบบฟอร์ม (หรือจากข้อมูลที่ส่งมา)
    $Userasset_id  = $_POST['Userasset_id']; // แทนด้วยชื่อฟิลด์ที่เกี่ยวข้อง
    $AssetID = $_POST['AssetID']; // แทนด้วยชื่อฟิลด์ที่เกี่ยวข้อง

 

  
        // เขียนคำสั่ง SQL สำหรับการเพิ่มข้อมูลใหม่
        $sql = "UPDATE `Userasset_id` SET `AssetID`=:AssetID WHERE `Userasset_id` = :Userasset_id";
        
        // เตรียมคำสั่ง SQL
        $statement = $conn->prepare($sql);
        
        // ผูกค่าพารามิเตอร์
        $statement->bindParam(':Userasset_id', $Userasset_id );
        $statement->bindParam(':AssetID', $AssetID);


        // ประมวลผลคำสั่ง SQL
        $statement->execute();

        $response->success('Success','Edit asset successfully', 200); // ส่งข้อความสำเร็จถ้าเพิ่มข้อมูลได้สำเร็จ
    
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
    exit;
}

?>
