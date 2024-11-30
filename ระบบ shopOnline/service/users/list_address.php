<?php


try {


    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // รับ id_user จาก Request
        $id_user = $_GET['id_user'] ?? null;

        if ($id_user) {
            // สร้างคำสั่ง SQL เพื่อดึงข้อมูล
            $sql = "SELECT * FROM user_address WHERE id_user = :id_user";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_user', $id_user);
            $stmt->execute();

            // ดึงข้อมูลทั้งหมด
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($result) {
    
                $response->success($result, 'Address retrieved successfully.', 200);
            } else {
    
                $response->error('No addresses found for this user.', 404);
            }
        } else {

            $response->error('Missing required parameters.', 400);
        }
    } else {
        $response->error('Invalid request method.', 405);
    }
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

?>
