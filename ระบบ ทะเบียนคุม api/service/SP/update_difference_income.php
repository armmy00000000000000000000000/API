<?php

// รับค่า input จาก POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // ตรวจสอบว่าได้รับข้อมูลหรือไม่
    if (isset($_POST['income_id']) && isset($_POST['total_amount'])) {
        $income_id = $_POST['income_id'];
        $total_amount = $_POST['total_amount'];

        // ตรวจสอบว่าค่าที่ส่งมาถูกต้องหรือไม่
        if (empty($income_id) || empty($total_amount)) {
    
            $response->error('Missing required parameters', 400);
            exit;
        }

        try {
            // คำสั่ง UPDATE
            $updateQuery = "UPDATE income SET total_amount = :total_amount WHERE income_id = :income_id";
            $stmt = $conn->prepare($updateQuery);

            // Binding ค่า
            $stmt->bindParam(':total_amount', $total_amount);
            $stmt->bindParam(':income_id', $income_id);

            // ทำการอัปเดต
            $stmt->execute();

            // ตรวจสอบว่ามีการอัปเดตหรือไม่
            if ($stmt->rowCount() > 0) {
        
                $response->success([], 'Total amount updated successfully', 200);
            } else {
        
                $response->error('Income ID not found or no changes made', 404);
            }
        } catch (PDOException $e) {
    
            $response->error('Error: ' . $e->getMessage(), 500);
        }
    } else {

        $response->error('Invalid input parameters', 400);
    }
}
?>
