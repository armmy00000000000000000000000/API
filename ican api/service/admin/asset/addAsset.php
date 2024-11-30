<?php

try {
    // รับข้อมูลจากแบบฟอร์ม (หรือจากข้อมูลที่ส่งมา)
    $AssetID = $_POST['AssetID']; // แทนด้วยชื่อฟิลด์ที่เกี่ยวข้อง
    $AssetName = $_POST['AssetName']; // แทนด้วยชื่อฟิลด์ที่เกี่ยวข้อง
    $Type = $_POST['Type']; // แทนด้วยชื่อฟิลด์ที่เกี่ยวข้อง

    // เข้ารหัสรหัสผ่าน
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // เช็คว่าชื่อสินทรัพย์ (AssetID) ซ้ำหรือไม่
    $check_sql = "SELECT * FROM Asset WHERE AssetID = :AssetID";
    $check_statement = $conn->prepare($check_sql);
    $check_statement->bindParam(':AssetID', $AssetID);
    $check_statement->execute();
    $existing_asset = $check_statement->fetch(PDO::FETCH_ASSOC);

    if ($existing_asset) {
        $response->error('AssetID already exists', 400); // ส่งข้อความข้อผิดพลาดถ้าชื่อสินทรัพย์ซ้ำ
    } else {
        // เขียนคำสั่ง SQL สำหรับการเพิ่มข้อมูลใหม่
        $sql = "INSERT INTO Asset (AssetID, AssetName, Type) VALUES (:AssetID, :AssetName, :Type)";
        
        // เตรียมคำสั่ง SQL
        $statement = $conn->prepare($sql);
        
        // ผูกค่าพารามิเตอร์
        $statement->bindParam(':AssetID', $AssetID);
        $statement->bindParam(':AssetName', $AssetName);
        $statement->bindParam(':Type', $Type);

        // ประมวลผลคำสั่ง SQL
        $statement->execute();

        $response->success('Success','Asset added successfully', 200); // ส่งข้อความสำเร็จถ้าเพิ่มข้อมูลได้สำเร็จ
    }
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
    exit;
}

?>
