<?php




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
        
        $response->success($user, "Login successful", 200);
    } else {
        $response->error("Invalid email or password", 401);
    }
} catch (PDOException $e) {
    $response->error("An error occurred: " . $e->getMessage(), 500);
}
?>
