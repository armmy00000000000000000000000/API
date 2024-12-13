<?php


// ตรวจสอบว่าได้ข้อมูลจากฟอร์มแล้วหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_number = $_POST['order_number'];
    $payment_method = $_POST['payment_method'];
    $shipping_address = $_POST['shipping_address'];
    
    $slip_path = null; // ค่าเริ่มต้นหากไม่มีสลิป
    if (isset($_FILES['slip']) && $_FILES['slip']['error'] === 0) {
        $upload_dir = 'slips/'; // โฟลเดอร์สำหรับเก็บสลิป

        // ตรวจสอบว่ามีโฟลเดอร์หรือไม่ ถ้าไม่มีก็สร้างขึ้นมา
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $slip_name = $order_number . '_' . basename($_FILES['slip']['name']);
        $slip_path = $upload_dir . $slip_name;

        // ตรวจสอบขนาดไฟล์ (ตั้งค่าตัวอย่างไว้ที่ 2MB)
        if ($_FILES['slip']['size'] > 2 * 1024 * 1024) {
            $response->error("ขนาดไฟล์เกินขอบเขตที่กำหนด", 400);
            exit;
        }

        // ย้ายไฟล์ที่อัพโหลดไปยังโฟลเดอร์ที่กำหนด
        if (!move_uploaded_file($_FILES['slip']['tmp_name'], $slip_path)) {
            $response->error("การอัปโหลดสลิปล้มเหลว. รหัสข้อผิดพลาด: " . $_FILES['slip']['error'], 500);
            exit;
        }
    } else if (isset($_FILES['slip']['error']) && $_FILES['slip']['error'] !== UPLOAD_ERR_NO_FILE) {
        $response->error("ข้อผิดพลาดในการอัปโหลดไฟล์: " . $_FILES['slip']['error'], 500);
        exit;
    }

    // ตรวจสอบว่ามี order_number อยู่กี่รายการ
    try {
        $stmt = $conn->prepare("SELECT COUNT(*) FROM orders WHERE order_number = :order_number");
        $stmt->execute(['order_number' => $order_number]);
        $count = $stmt->fetchColumn();

        if ($count > 1) {
            // มีมากกว่า 1 รายการ
            $response->error("ข้อผิดพลาด: พบหลายรายการของ order_number นี้ กรุณาติดต่อเจ้าหน้าที่", 400);
        } elseif ($count == 1) {
            // มีเพียง 1 รายการ สามารถอัปเดตได้
            $updateStmt = $conn->prepare("UPDATE orders SET shipping_address = :shipping_address, payment_method = :payment_method, slip = :slip WHERE order_number = :order_number");
            $updateStmt->execute([
                'payment_method' => $payment_method,
                'shipping_address' => $shipping_address,
                'slip' => $slip_path, // บันทึกเส้นทางไฟล์ในฐานข้อมูล
                'order_number' => $order_number
            ]);
            
            $response->success([], "สั่งซื้อสินค้าสำเร็จ รอทางร้านตรวจสอบและอัปเดตสถานะการชำระเงิน", 200);
        } else {
            // ไม่พบรายการใด ๆ ที่ตรงกับ order_number
            $response->error("ไม่พบรายการของ order_number นี้", 404);
        }
    } catch (PDOException $e) {
        $response->error("ข้อผิดพลาด: " . $e->getMessage(), 500);
    }
}
?>
