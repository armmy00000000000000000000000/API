<?php


// ตรวจสอบการเรียกใช้งาน API
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // ดึงข้อมูลจาก POST request
    $id_product = $_GET['id_product'] ?? null;


    // ตรวจสอบว่ามีข้อมูลที่จำเป็นหรือไม่
    if (empty($id_product)) {
       
        $response->error('Email and password are required', 400);
        exit;
    }

    // SQL สำหรับดึงข้อมูลผู้ใช้
    $sql = "SELECT * FROM `list_preview_product` WHERE `id_product` = :id_product";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id_product' => $id_product]);

        // ตรวจสอบว่ามีผู้ใช้หรือไม่
        if ($stmt->rowCount() === 0) {
           
            $response->error('Invalid ', 401);
            exit;
        }

        // ดึงข้อมูลผู้ใช้
        $size = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // ตรวจสอบรหัสผ่าน
        if ($size) {
            // หากเข้าสู่ระบบสำเร็จ

           
            $response->success(  $size, 'product_ successful', 200);
        } else {
            // รหัสผ่านไม่ถูกต้อง
           
            $response->error('Invalid email or password', 401);
        }
    } catch (PDOException $e) {
        // จัดการข้อผิดพลาดจากฐานข้อมูล
       
        $response->error('Database error: ' . $e->getMessage(), 500);
    }
} else {
    // หากไม่ใช่ GET request
   
    $response->error('Invalid request method', 405);
}
?>
