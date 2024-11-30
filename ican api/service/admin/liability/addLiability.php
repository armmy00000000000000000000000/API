<?php

try {
    // รับข้อมูลจากแบบฟอร์ม (หรือจากข้อมูลที่ส่งมา)
    $DebtID = $_POST['DebtID']; // แทนด้วยชื่อฟิลด์ที่เกี่ยวข้อง
    $DebtName = $_POST['DebtName']; // แทนด้วยชื่อฟิลด์ที่เกี่ยวข้อง
    $Type = $_POST['Type']; // แทนด้วยชื่อฟิลด์ที่เกี่ยวข้อง

  

    // เช็คว่าชื่อสินทรัพย์ (DebtID) ซ้ำหรือไม่
    $check_sql = "SELECT * FROM Liability WHERE DebtID = :DebtID";
    $check_statement = $conn->prepare($check_sql);
    $check_statement->bindParam(':DebtID', $DebtID);
    $check_statement->execute();
    $existing_Liability = $check_statement->fetch(PDO::FETCH_ASSOC);

    if ($existing_Liability) {
        $response->error('Liability added successfully', 400); // ส่งข้อความสำเร็จถ้าเพิ่มข้อมูลได้สำเร็จ
    } else {
        // เขียนคำสั่ง SQL สำหรับการเพิ่มข้อมูลใหม่
        $sql = "INSERT INTO Liability (DebtID, DebtName, Type) VALUES (:DebtID, :DebtName, :Type)";
        
        // เตรียมคำสั่ง SQL
        $statement = $conn->prepare($sql);
        
        // ผูกค่าพารามิเตอร์
        $statement->bindParam(':DebtID', $DebtID);
        $statement->bindParam(':DebtName', $DebtName);
        $statement->bindParam(':Type', $Type);

        // ประมวลผลคำสั่ง SQL
        $statement->execute();

        $response->success('Success','Liability added successfully', 200); // ส่งข้อความสำเร็จถ้าเพิ่มข้อมูลได้สำเร็จ
    }
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
    exit;
}

?>
