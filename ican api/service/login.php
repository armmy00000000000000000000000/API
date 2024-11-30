<?php
session_start();


try {
    // รับข้อมูลจากแบบฟอร์ม (หรือจากข้อมูลที่ส่งมา)
    $username = $_POST['username']; // แทนด้วยชื่อฟิลด์ของชื่อผู้ใช้ในฟอร์ม
    $password = $_POST['password']; // แทนด้วยชื่อฟิลด์ของรหัสผ่านในฟอร์ม

    // เข้ารหัสรหัสผ่าน
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // เขียนคำสั่ง SQL สำหรับการเลือกข้อมูลผู้ใช้
    $sql = "SELECT * FROM Users_login WHERE usersname = :username";

    // เตรียมคำสั่ง SQL
    $statement = $conn->prepare($sql);
    // ผูกค่าพารามิเตอร์
    $statement->bindParam(':username', $username);

    // ประมวลผลคำสั่ง SQL
    $statement->execute();

    // ดึงข้อมูลผู้ใช้ที่ตรงกับเงื่อนไข
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    // ตรวจสอบว่ามีผู้ใช้ในฐานข้อมูลหรือไม่
    if ($result) {
        // ทำการเปรียบเทียบรหัสผ่านที่ผู้ใช้ป้อนกับรหัสผ่านที่เก็บในฐานข้อมูล
        if (password_verify($password, $result['password'])) {
            // รหัสผ่านถูกต้อง
            // ตรวจสอบสถานะของผู้ใช้และทำการตอบสนองตามสถานะ
            $status = $result['status'];
            $_SESSION['id_user'] = $result['id_user'];
            $_SESSION['status'] = $result['status'];
            $_SESSION['name_user'] = $result['name_user'];
            $_SESSION['last_user'] = $result['last_user'];

            switch ($status) {
                case 'users':
                    $response->success($result,'Success', 200);
                    break;
                case 'admin':
                    $response->success($result,'Success' , 200);
                    break;
                case 'caretaker':
                    $response->success($result,'Success', 200);
                    break;
                default:
                    $response->error('Invalid status', 404);
                    break;
            }
        } else {
            // รหัสผ่านไม่ถูกต้อง
            $response->error('Invalid username or password', 404);
        }
    } else {
        // ไม่พบข้อมูลผู้ใช้ในฐานข้อมูล
        $response->error('Invalid username or password', 404);
    }
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
    exit;
}

?>
