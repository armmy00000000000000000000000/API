<?php

// ตรวจสอบการร้องขอเป็น POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับข้อมูลจาก POST
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $id_store = $_POST['id_store'] ?? '';
    $status = $_POST['status'] ?? '';

    // ตรวจสอบว่าอีเมลถูกใช้หรือไม่
    $stmt = $conn->prepare("SELECT COUNT(*) FROM login_store WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        // อีเมลถูกใช้แล้ว
   
        $response->error('อีเมลถูกใช้แล้ว', 400);
    } else {
        // ถ้าอีเมลไม่ซ้ำ ให้ทำการเข้ารหัสรหัสผ่านและเพิ่มข้อมูล
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // แก้ไขคำสั่ง SQL ที่ขาดเครื่องหมายคอมมา
        $stmt = $conn->prepare("INSERT INTO login_store (email, password, id_store, status) VALUES (:email, :password, :id_store, :status)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':id_store', $id_store);
        $stmt->bindParam(':status', $status);

        if ($stmt->execute()) {
        
            $response->success([], 'เพิ่มข้อมูลล็อกอินเรียบร้อย', 201);
        } else {
       
            $response->error('ไม่สามารถเพิ่มข้อมูลได้', 500);
        }
    }
} else {
    // ถ้าไม่ใช่ POST

    $response->error('Method not allowed', 405);
}
?>
