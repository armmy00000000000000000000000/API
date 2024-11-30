<?php

try {
    // รับข้อมูลจากแบบฟอร์ม (หรือจากข้อมูลที่ส่งมา)
    $AssetID = $_POST['AssetID']; // แทนด้วยชื่อฟิลด์ที่เกี่ยวข้อง
  
        // เขียนคำสั่ง SQL สำหรับการเพิ่มข้อมูลใหม่
        $sql = "DELETE FROM `Asset` WHERE `AssetID` = :AssetID";
        
        // เตรียมคำสั่ง SQL
        $statement = $conn->prepare($sql);
        
        // ผูกค่าพารามิเตอร์
        $statement->bindParam(':AssetID', $AssetID);

        // ประมวลผลคำสั่ง SQL
        $statement->execute();

        $response->success('Success','Delete asset successfully', 200); // ส่งข้อความสำเร็จถ้าเพิ่มข้อมูลได้สำเร็จ
    
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
    exit;
}

?>
