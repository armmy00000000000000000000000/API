<?php
// เชื่อมต่อกับฐานข้อมูล
$dbname = 'mysql:dbname=shoponline_partner;host=addpaycrypto.com';
$username = 'root';
$password = 'it_addpay2022';

try {
    $conn = new PDO($dbname, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // รับการร้องขอ
    $method = $_SERVER['REQUEST_METHOD'];


    if ($method === 'PUT') {
        // อัปเดตข้อมูล
        $data = json_decode(file_get_contents("php://input"), true); // Decode JSON input
        $id = $data['id'] ?? null;
        $email = $data['email'] ?? null;
        $password = $data['password'] ?? null;
        $status = $data['status'] ?? null;

        if ($id && $email && $password && $status) {
            // เข้ารหัสรหัสผ่าน
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            $stmt = $conn->prepare("UPDATE `login_store` SET `email` = :email, `password` = :password, `status` = :status WHERE `id` = :id");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword); // ใช้รหัสผ่านที่เข้ารหัส
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':id', $id);

            if ($stmt->execute()) {
                $response->success([], 'อัปเดตข้อมูลเรียบร้อย', 200);
            } else {
                $response->error('ไม่สามารถอัปเดตข้อมูลได้', 500);
            }
        } else {
            $response->error('กรุณาระบุข้อมูลให้ครบถ้วน', 400);
        }
    } elseif ($method === 'DELETE') {
        $data = json_decode(file_get_contents("php://input"), true); // Decode JSON input
        
        $id = $data['id'] ?? null;

        if ($id) {
            $stmt = $conn->prepare("DELETE FROM `login_store` WHERE `id` = :id");
            $stmt->bindParam(':id', $id);

            if ($stmt->execute()) {
                $response->success([], 'ลบข้อมูลเรียบร้อย', 200);
            } else {
                $response->error('ไม่สามารถลบข้อมูลได้', 500);
            }
        } else {
            $response->error('กรุณาระบุ id ให้ถูกต้อง', 400);
        }
    } else {
        $response->error('Method not allowed', 405);
    }
} catch (PDOException $e) {
    $response->error('เกิดข้อผิดพลาด: ' . $e->getMessage(), 500);
}
?>
