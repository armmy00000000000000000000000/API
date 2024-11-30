<?php

try {
    // รับข้อมูลจากแบบฟอร์ม (หรือจากข้อมูลที่ส่งมา)
    $ID = $_POST['ID']; // แทนด้วยชื่อฟิลด์ที่เกี่ยวข้อง
    $DebtID = $_POST['DebtID']; // แทนด้วยชื่อฟิลด์ที่เกี่ยวข้อง
    $DebtName = $_POST['DebtName']; // แทนด้วยชื่อฟิลด์ที่เกี่ยวข้อง
    $Type = $_POST['Type']; // แทนด้วยชื่อฟิลด์ที่เกี่ยวข้อง

  
        // เขียนคำสั่ง SQL สำหรับการเพิ่มข้อมูลใหม่
        $sql = "UPDATE `Liability` SET `DebtID`=:DebtID,`DebtName`=:DebtName,`Type`=:Type WHERE `id` = :ID ";
        
        // เตรียมคำสั่ง SQL
        $statement = $conn->prepare($sql);
        
        // ผูกค่าพารามิเตอร์
        $statement->bindParam(':ID', $ID);
        $statement->bindParam(':DebtID', $DebtID);
        $statement->bindParam(':DebtName', $DebtName);
        $statement->bindParam(':Type', $Type);

        // ประมวลผลคำสั่ง SQL
        $statement->execute();

        $response->success('Success','Edit Liability successfully', 200); // ส่งข้อความสำเร็จถ้าเพิ่มข้อมูลได้สำเร็จ
    
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
    exit;
}

?>
