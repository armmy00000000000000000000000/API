<?php
include '../condb.php';
// header('Content-Type: application/json');

try {


    // // รับข้อมูลจาก client
    // $data = json_decode(file_get_contents('php://input'), true);

    // // ตรวจสอบข้อมูลที่ได้รับ
    // if (isset($data['debt_name']) && isset($data['debt_amount']) && isset($data['debt_type']) && isset($data['user_id'])) {
        $debt_name = $_POST['debt_name'];
        $debt_amount = $_POST['debt_amount'];
        $debt_type = $_POST['debt_type'];
        $user_id = $_POST['user_id'];

        // เตรียม SQL statement สำหรับการ insert
        $stmt = $conn->prepare("INSERT INTO debts (debt_name, debt_amount, debt_type, user_id) VALUES (:debt_name, :debt_amount, :debt_type, :user_id)");

        // ผูกค่ากับ parameter
        $stmt->bindParam(':debt_name', $debt_name);
        $stmt->bindParam(':debt_amount', $debt_amount);
        $stmt->bindParam(':debt_type', $debt_type);
        $stmt->bindParam(':user_id', $user_id);

        // Execute statement
        if ($stmt->execute()) {
            $response = array('status' => 'success', 'message' => 'Asset inserted successfully');
        } else {
            $response = array('status' => 'error', 'message' => 'Failed to insert asset');
        }
    // } else {
    //     $response = array('status' => 'error', 'message' => 'Invalid input');
    // }
} catch (PDOException $e) {
    $response = array('status' => 'error', 'message' => $e->getMessage());
}

// ส่งผลลัพธ์กลับไปในรูปแบบ JSON
echo json_encode($response);
?>
