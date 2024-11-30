<?php


$maxFileSize = 8 * 1024 * 1024; // ขนาดสูงสุดของไฟล์ (8MB)
$uploadDir = 'qr_payment/'; // โฟลเดอร์สำหรับเก็บไฟล์ QR

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ดึงข้อมูลจาก POST request
    $payment_name = $_POST['payment_name'];
    $account_owner = $_POST['account_owner'];
    $number_payment = $_POST['number_payment'];
    $id_store = $_POST['id_store'];
    $action = $_POST['action']; // รับค่า action

    // ตรวจสอบ action
    if ($action === 'update') {
        // ตรวจสอบข้อมูลซ้ำจาก id_store
        $checkSql = "SELECT COUNT(*), qr_payment FROM payment_store WHERE id_store = :id_store GROUP BY qr_payment
";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->execute([':id_store' => $id_store]);
        $result = $checkStmt->fetch(PDO::FETCH_ASSOC);
        $count = $result['COUNT(*)'];
        $existingQrPayment = $result['qr_payment']; // เก็บ QR ที่มีอยู่

        if ($count > 0) {
            // หากมีข้อมูลให้ทำการอัปเดต
            $uploadFile = $existingQrPayment; // ใช้ไฟล์ QR ที่มีอยู่

            // ตรวจสอบว่ามีการอัปโหลดไฟล์ใหม่หรือไม่
            if (isset($_FILES['qr_payment']) && $_FILES['qr_payment']['error'] == 0) {
                // ตรวจสอบขนาดของไฟล์
                if ($_FILES['qr_payment']['size'] > $maxFileSize) {
                    $maxSizeInMB = $maxFileSize / 1024 / 1024;
                 
                    $response->error("ขนาดไฟล์ใหญ่เกินไป ต้องไม่เกิน {$maxSizeInMB} MB", 400);
                    exit;
                }

                // สร้างชื่อไฟล์ใหม่
                $fileExtension = pathinfo($_FILES['qr_payment']['name'], PATHINFO_EXTENSION);
                $newFileName = uniqid('qr_', true) . '.' . $fileExtension;
                $uploadFile = $uploadDir . $newFileName;

                // ตรวจสอบและสร้างโฟลเดอร์ถ้ายังไม่มี
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                // ย้ายไฟล์ไปยังโฟลเดอร์ที่กำหนด
                if (!move_uploaded_file($_FILES['qr_payment']['tmp_name'], $uploadFile)) {
                 
                    $response->error("Failed to upload QR code image.", 500);
                    exit;
                }
            }

            // SQL สำหรับการอัปเดตข้อมูล
            $sql = "UPDATE payment_store 
                    SET payment_name = :payment_name, 
                        account_owner = :account_owner, 
                        qr_payment = :qr_payment, 
                        number_payment = :number_payment 
                    WHERE id_store = :id_store";

            try {
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':payment_name' => $payment_name,
                    ':account_owner' => $account_owner,
                    ':qr_payment' => $uploadFile, // เก็บพาธของไฟล์ที่อัปโหลด
                    ':number_payment' => $number_payment,
                    ':id_store' => $id_store
                ]);

             
                $response->success([], 'Payment method updated successfully', 200);
            } catch (PDOException $e) {
             
                $response->error("Failed to update payment method: " . $e->getMessage(), 500);
            }
        } else {
         
            $response->error("ไม่มีข้อมูลสำหรับ id_store นี้", 404);
        }
    } elseif ($action === 'add') {
        // SQL สำหรับการเพิ่มข้อมูล
        $checkSql = "SELECT COUNT(*) FROM payment_store WHERE id_store = :id_store";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->execute([':id_store' => $id_store]);
        $count = $checkStmt->fetchColumn();

        if ($count > 0) {
         
            $response->error("มีข้อมูลชำระเงินสำหรับ id_store นี้อยู่แล้ว", 409);
            exit;
        }

        $uploadFile = null; // ไม่ได้อัปโหลดไฟล์ใหม่ ให้ใช้ค่า null

        if (isset($_FILES['qr_payment']) && $_FILES['qr_payment']['error'] == 0) {
            // ตรวจสอบขนาดของไฟล์
            if ($_FILES['qr_payment']['size'] > $maxFileSize) {
                $maxSizeInMB = $maxFileSize / 1024 / 1024;
             
                $response->error("ขนาดไฟล์ใหญ่เกินไป ต้องไม่เกิน {$maxSizeInMB} MB", 400);
                exit;
            }

            // สร้างชื่อไฟล์ใหม่
            $fileExtension = pathinfo($_FILES['qr_payment']['name'], PATHINFO_EXTENSION);
            $newFileName = uniqid('qr_', true) . '.' . $fileExtension;
            $uploadFile = $uploadDir . $newFileName;

            // ตรวจสอบและสร้างโฟลเดอร์ถ้ายังไม่มี
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // ย้ายไฟล์ไปยังโฟลเดอร์ที่กำหนด
            if (move_uploaded_file($_FILES['qr_payment']['tmp_name'], $uploadFile)) {
                // ใช้พาธของไฟล์ที่อัปโหลด
            } else {
             
                $response->error("Failed to upload QR code image.", 500);
                exit;
            }
        }

        // SQL สำหรับการเพิ่มข้อมูล
        $sql = "INSERT INTO payment_store (payment_name, account_owner, qr_payment, number_payment, id_store) 
                VALUES (:payment_name, :account_owner, :qr_payment, :number_payment, :id_store)";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':payment_name' => $payment_name,
                ':account_owner' => $account_owner,
                ':qr_payment' => $uploadFile, // เก็บพาธของไฟล์ที่อัปโหลด
                ':number_payment' => $number_payment,
                ':id_store' => $id_store
            ]);

         
            $response->success([], 'Payment method added successfully', 201);
        } catch (PDOException $e) {
         
            $response->error("Failed to add payment method: " . $e->getMessage(), 500);
        }
    } else {
     
        $response->error("Invalid action specified", 400);
    }
} else {
 
    $response->error("Invalid request method", 405);
}
?>
