<?php
// สร้างคลาส Response เพื่อจัดการการตอบกลับ


try {
    // สร้างการเชื่อมต่อกับฐานข้อมูล
    $conn = new PDO($dbname, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // รับข้อมูล JSON ที่ส่งเข้ามาและแปลงเป็น array
    $data = json_decode(file_get_contents("php://input"), true);

    // ตรวจสอบว่ามีข้อมูลที่ส่งเข้ามาหรือไม่
    if (isset($data) && is_array($data)) {
        // เริ่ม transaction เพื่อเพิ่มความปลอดภัยในการเพิ่มข้อมูล
        $conn->beginTransaction();

        // เตรียมคำสั่ง SQL สำหรับการเพิ่มข้อมูล
        $stmt = $conn->prepare("INSERT INTO `sub_allocation` (`allocation_id`, `sub_allocation_name`, `station`) VALUES (:allocation_id, :sub_allocation_name, :station)");

        // เก็บผลลัพธ์การเพิ่มข้อมูลแต่ละรายการ
        $insertedRows = 0;
        foreach ($data as $item) {
            // ตรวจสอบว่าข้อมูลแต่ละรายการมี key ที่ต้องการหรือไม่
            if (isset($item['allocation_id']) && isset($item['sub_allocation_name']) && isset($item['station'])) {
                // ทำการเพิ่มข้อมูล
                $stmt->bindParam(':allocation_id', $item['allocation_id']);
                $stmt->bindParam(':sub_allocation_name', $item['sub_allocation_name']);
                $stmt->bindParam(':station', $item['station']);
                $stmt->execute();
                $insertedRows++;
            }
        }

        // ตรวจสอบว่ามีรายการที่เพิ่มสำเร็จหรือไม่
        if ($insertedRows > 0) {
            $conn->commit(); // ยืนยันการบันทึกข้อมูลทั้งหมด
            $response->success(null, "$insertedRows rows inserted successfully", 201);
        } else {
            $conn->rollBack(); // ยกเลิกการทำงานถ้าไม่มีข้อมูลที่ถูกเพิ่ม
            $response->error("No valid data to insert", 400);
        }
    } else {
        $response->error("Invalid input format", 400);
    }

} catch (PDOException $e) {
    $conn->rollBack(); // ยกเลิกการทำงานถ้าเกิดข้อผิดพลาด
    $response->error("Database error: " . $e->getMessage(), 500);
}
?>
