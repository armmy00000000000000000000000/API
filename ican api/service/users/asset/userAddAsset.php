<?php
include '../condb.php';
// header('Content-Type: application/json');

try {


    // // รับข้อมูลจาก client
    // $data = json_decode(file_get_contents('php://input'), true);

    // // ตรวจสอบข้อมูลที่ได้รับ
    // if (isset($data['asset_name']) && isset($data['asset_value']) && isset($data['asset_type']) && isset($data['user_id'])) {
        $asset_name = $_POST['asset_name'];
        $asset_value = $_POST['asset_value'];
        $asset_type = $_POST['asset_type'];
        $user_id = $_POST['user_id'];

        // เตรียม SQL statement สำหรับการ insert
        $stmt = $conn->prepare("INSERT INTO assets (asset_name, asset_value, asset_type, user_id) VALUES (:asset_name, :asset_value, :asset_type, :user_id)");

        // ผูกค่ากับ parameter
        $stmt->bindParam(':asset_name', $asset_name);
        $stmt->bindParam(':asset_value', $asset_value);
        $stmt->bindParam(':asset_type', $asset_type);
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
