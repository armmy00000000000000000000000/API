<?php

// ฟังก์ชันสำหรับการเข้าสู่ระบบ
function login($conn, $email, $password) {
    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        unset($user['password']); // ลบรหัสผ่านออกจากผลลัพธ์
        return ["status" => true, "user" => $user];
    } else {
        return ["status" => false, "message" => "Invalid email or password."];
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $result = login($conn, $email, $password);

    if ($result['status']) {
        $response->success($result['user'], "Login successful.", 200);
    } else {
        $response->error($result['message'], 401);
    }
} else {
    $response->error("Invalid request method.", 405);
}
?>
