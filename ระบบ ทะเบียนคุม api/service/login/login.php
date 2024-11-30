<?php
date_default_timezone_set('Asia/Bangkok');
// ฟังก์ชันสร้าง API key แบบสุ่ม
function generateApiKey($length = 32) {
    $prefix = 'PJV||';
    $key = bin2hex(random_bytes(($length - strlen($prefix)) / 2));
    return $prefix . $key;
}

// รับข้อมูล email และ password จาก request
$data = json_decode(file_get_contents("php://input"), true);
$email = $data['email'] ?? '';
$password = $data['password'] ?? '';

// ตรวจสอบว่า email และ password ถูกส่งมาหรือไม่
if (empty($email) || empty($password)) {
    $response->error("Email and password are required", 400);
    exit;
}

try {
    // ตรวจสอบข้อมูลผู้ใช้
    $stmt = $conn->prepare("
        SELECT Login.*, police_station.name AS station_name
        FROM Login
        JOIN police_station ON Login.station = police_station.id
        WHERE Login.email = :email AND Login.password = :password
    ");
    $stmt->execute([
        ':email' => $email,
        ':password' => $password
    ]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // ลบ password ออกจากผลลัพธ์เพื่อความปลอดภัย
        unset($user['password']);
        
        // สร้าง API key ใหม่และบันทึกลงในฐานข้อมูล
        $apiKey = generateApiKey();
        // $expirationDate = date('Y-m-d H:i:s', strtotime('+1 hour')); // เพิ่มเวลา 1 ชั่วโมง
        $expirationDate = date('Y-m-d H:i:s', strtotime('+2 hours 30 minutes')); // เพิ่มเวลา 2 ชั่วโมง 30 นาที

        $query = $conn->prepare("
            INSERT INTO api_keys (`key`, `status`, `expiration_date`) 
            VALUES (:key, 'active', :expiration_date)
        ");
        $query->bindParam(':key', $apiKey);
        $query->bindParam(':expiration_date', $expirationDate);
        $query->execute();

        // เพิ่ม API key ลงในข้อมูลผู้ใช้
        $user['token'] = $apiKey;
        // เพิ่ม API key ลงในข้อมูลผู้ใช้
        $user['time_api'] = $expirationDate;

        // ส่งข้อมูลผู้ใช้พร้อม API key กลับไป
        $response->success($user, "Login successful", 200);
    } else {
        $response->error("Invalid email or password", 401);
    }
} catch (PDOException $e) {
    $response->error("An error occurred: " . $e->getMessage(), 500);
}

?>
