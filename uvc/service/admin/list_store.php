<?php

// ตรวจสอบการร้องขอเป็น GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $stmt = $conn->prepare("SELECT * FROM store_data");
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result) {
    
            $response->success($result, 'ดึงข้อมูลร้านค้าเรียบร้อย', 200);
        } else {
    
            $response->error('ไม่พบข้อมูลร้านค้า', 404);
        }
    } catch (PDOException $e) {

        $response->error('ไม่สามารถดึงข้อมูลได้: ' . $e->getMessage(), 500);
    }
} else {
    // ถ้าไม่ใช่ GET
    $response->error('Method not allowed', 405);
}
?>
