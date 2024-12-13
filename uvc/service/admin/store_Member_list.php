<?php



try {


    // ตรวจสอบการร้องขอเป็น GET
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // รับ id_store จากพารามิเตอร์ query
        $id_store = $_GET['id_store'] ?? null;

        if ($id_store) {
            // เตรียมคำสั่ง SQL
            $stmt = $conn->prepare("SELECT * FROM `login_store` WHERE `id_store` = :id_store");
            $stmt->bindParam(':id_store', $id_store);
            $stmt->execute();

            // ดึงข้อมูล
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        
            if ($results) {
                // ส่งข้อมูลในรูปแบบ JSON
                $response->success($results, 'ข้อมูลถูกดึงเรียบร้อย', 200);
            } else {
                $response->error('ไม่พบข้อมูล', 404);
            }
        } else {
        
            $response->error('กรุณาระบุ id_store', 400);
        }
    } else {
    
        $response->error('Method not allowed', 405);
    }
} catch (PDOException $e) {

    $response->error('เกิดข้อผิดพลาด: ' . $e->getMessage(), 500);
}
?>