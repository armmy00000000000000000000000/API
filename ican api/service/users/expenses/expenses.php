<?php
include '../condb.php'; // แทรกการเชื่อมต่อฐานข้อมูล

try {
    // รับข้อมูลจาก client
    // $data = json_decode(file_get_contents('php://input'), true);

    // // ตรวจสอบข้อมูลที่ได้รับ
    // if (isset($data['expense_name']) && isset($data['expense_amount']) && isset($data['expenses_permonth']) && isset($data['expenses_peryear']) && isset($data['user_id'])) {
        $expense_name = $_POST['expense_name'];
        $expense_amount = $_POST['expense_amount'];
        $expenses_permonth = $_POST['expenses_permonth'];
        $expenses_peryear = $_POST['expenses_peryear'];
        $expenses_type = $_POST['expenses_type'];
        $user_id = $_POST['user_id'];

        // เตรียม SQL statement สำหรับการ insert
        $stmt = $conn->prepare("INSERT INTO `expenses` (`expense_name`, `expense_amount`, `expenses_permonth`, `expenses_peryear`, `expenses_type`, `user_id`) VALUES (:expense_name, :expense_amount, :expenses_permonth, :expenses_peryear, :expenses_type, :user_id)");

        // ผูกค่ากับ parameter
        $stmt->bindParam(':expense_name', $expense_name);
        $stmt->bindParam(':expense_amount', $expense_amount);
        $stmt->bindParam(':expenses_permonth', $expenses_permonth);
        $stmt->bindParam(':expenses_peryear', $expenses_peryear);
        $stmt->bindParam(':expenses_type', $expenses_type);
        $stmt->bindParam(':user_id', $user_id);

        // Execute statement
        if ($stmt->execute()) {
            $response = array('status' => 'success', 'message' => 'Expense inserted successfully');
        } else {
            $response = array('status' => 'error', 'message' => 'Failed to insert expense');
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
