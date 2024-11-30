<?php
include '../condb.php'; // แทรกการเชื่อมต่อฐานข้อมูล

try {
    // รับข้อมูลจาก client
    // $data = json_decode(file_get_contents('php://input'), true);

    // // ตรวจสอบข้อมูลที่ได้รับ
    // if (isset($data['income_name']) && isset($data['income_amount']) && isset($data['incomes_permonth']) && isset($data['incomes_peryear']) && isset($data['user_id'])) {
        $income_name = $_POST['income_name'];
        $income_amount = $_POST['income_amount'];
        $incomes_permonth = $_POST['incomes_permonth'];
        $incomes_peryear = $_POST['incomes_peryear'];
        $incomes_type = $_POST['incomes_type'];
        $user_id = $_POST['user_id'];

        // เตรียม SQL statement สำหรับการ insert
        $stmt = $conn->prepare("INSERT INTO `incomes`( `income_name`, `income_amount`, `incomes_permonth`, `incomes_peryear`, `incomes_type`, `user_id`) VALUES (:income_name, :income_amount, :incomes_permonth, :incomes_peryear, :incomes_type, :user_id)");

        // ผูกค่ากับ parameter
        $stmt->bindParam(':income_name', $income_name);
        $stmt->bindParam(':income_amount', $income_amount);
        $stmt->bindParam(':incomes_permonth', $incomes_permonth);
        $stmt->bindParam(':incomes_peryear', $incomes_peryear);
        $stmt->bindParam(':incomes_type', $incomes_type);
        $stmt->bindParam(':user_id', $user_id);

        // Execute statement
        if ($stmt->execute()) {
            $response = array('status' => 'success', 'message' => 'incomes inserted successfully');
        } else {
            $response = array('status' => 'error', 'message' => 'Failed to insert incomes');
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
