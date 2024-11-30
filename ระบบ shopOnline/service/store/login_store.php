<?php


// ตรวจสอบการเรียกใช้งาน API
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ดึงข้อมูลจาก POST request
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    // ตรวจสอบว่ามีข้อมูลที่จำเป็นหรือไม่
    if (empty($email) || empty($password)) {
       
        $response->error('Email and password are required', 400);
        exit;
    }

    // SQL สำหรับดึงข้อมูลผู้ใช้
    $sql = "SELECT login_store.*, store_data.* 
            FROM login_store 
            JOIN store_data ON login_store.id_store = store_data.id_store 
            WHERE email = :email";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([':email' => $email]);

        // ตรวจสอบว่ามีผู้ใช้หรือไม่
        if ($stmt->rowCount() === 0) {
           
            $response->error('Invalid email or password', 401);
            exit;
        }

        // ดึงข้อมูลผู้ใช้
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // ตรวจสอบรหัสผ่าน
        if (password_verify($password, $user['password'])) {
            // หากเข้าสู่ระบบสำเร็จ
            unset($user['password']); // ลบรหัสผ่านออกจากข้อมูลที่ส่งกลับ
           
            $response->success($user, 'Login successful', 200);
        } else {
            // รหัสผ่านไม่ถูกต้อง
           
            $response->error('Invalid email or password', 401);
        }
    } catch (PDOException $e) {
        // จัดการข้อผิดพลาดจากฐานข้อมูล
       
        $response->error('Database error: ' . $e->getMessage(), 500);
    }
} else {
    // หากไม่ใช่ POST request
   
    $response->error('Invalid request method', 405);
}
?>
