<?php

try {
    // รับข้อมูลจากแบบฟอร์ม (หรือจากข้อมูลที่ส่งมา)
    $usersname = $_POST['usersname']; // แทนด้วยชื่อฟิลด์ที่เกี่ยวข้อง
    $password = $_POST['password']; // แทนด้วยชื่อฟิลด์ที่เกี่ยวข้อง
    $name_user = $_POST['name_user']; // แทนด้วยชื่อฟิลด์ที่เกี่ยวข้อง
    $last_user = $_POST['last_user']; // แทนด้วยชื่อฟิลด์ที่เกี่ยวข้อง

    // เช็คความแข็งแกร่งของรหัสผ่าน
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&+=])[A-Za-z\d@#$%^&+=]{8,}$/", $password)) {
        $response->error('รหัสผ่านต้องมีความยาว 6-8 ตัวอักษรและประกอบด้วยอักษรตัวพิมพ์เล็ก ตัวพิมพ์ใหญ่  ตัวเลข และอักขระพิเศษ', 400);
        exit;
    }

    // เข้ารหัสรหัสผ่าน
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // เช็คว่าชื่อผู้ใช้ (usersname) ซ้ำหรือไม่
    $check_sql = "SELECT * FROM Users_login WHERE usersname = :usersname";
    $check_statement = $conn->prepare($check_sql);
    $check_statement->bindParam(':usersname', $usersname);
    $check_statement->execute();
    $existing_user = $check_statement->fetch(PDO::FETCH_ASSOC);

    if ($existing_user) {
        $response->error('Username already exists', 400); // ส่งข้อความข้อผิดพลาดถ้าชื่อผู้ใช้ซ้ำ
    } else {
        // เขียนคำสั่ง SQL สำหรับการเพิ่มข้อมูลใหม่
        $sql = "INSERT INTO Users_login(usersname, password, name_user, last_user, status) VALUES (:usersname, :password, :name_user, :last_user, :status)";
        
        // เตรียมคำสั่ง SQL
        $statement = $conn->prepare($sql);
        
        // ผูกค่าพารามิเตอร์
        $statement->bindParam(':usersname', $usersname);
        $statement->bindParam(':password', $hashed_password); // ใช้รหัสผ่านที่เข้ารหัสแล้ว
        $statement->bindParam(':name_user', $name_user);
        $statement->bindParam(':last_user', $last_user);
        $statement->bindValue(':status', 'users'); // กำหนดค่า status เป็น 'users' โดยตรง
        
        // ประมวลผลคำสั่ง SQL
        $statement->execute();

        $response->success('register','success', 200); // ส่งข้อความสำเร็จถ้าเพิ่มข้อมูลได้สำเร็จ
    }
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
    exit;
}
?>
