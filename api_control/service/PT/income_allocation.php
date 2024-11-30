<?php
// สร้างคลาส Response เพื่อจัดการการตอบกลับ

try {
    // สร้างการเชื่อมต่อกับฐานข้อมูล
    $conn = new PDO($dbname, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // รับข้อมูล JSON จากการส่งผ่าน POST
    $data = json_decode(file_get_contents("php://input"), true);

    // ตรวจสอบว่าข้อมูลที่รับมาเป็น array หรือไม่
    if (is_array($data)) {
        $insertedRecords = 0;
        
        // เตรียมคำสั่ง SQL สำหรับการเพิ่มข้อมูล
        $stmt = $conn->prepare("INSERT INTO `income_allocation` (`income_type_id`, `allocation_name`) VALUES (:income_type_id, :allocation_name)");
        
        // วนลูปข้อมูลและทำการเพิ่มข้อมูลทีละรายการ
        foreach ($data as $record) {
            if (isset($record['income_type_id']) && isset($record['allocation_name'])) {
                $stmt->bindParam(':income_type_id', $record['income_type_id']);
                $stmt->bindParam(':allocation_name', $record['allocation_name']);
                $stmt->execute();
                $insertedRecords++;
            }
        }

        if ($insertedRecords > 0) {
            $response->success(["inserted_records" => $insertedRecords], "Data inserted successfully", 201);
        } else {
            $response->error("No records inserted", 400);
        }
    } else {
        $response->error("Invalid data format", 400);
    }

} catch (PDOException $e) {
    $response->error("Database connection failed: " . $e->getMessage(), 500);
}
?>
