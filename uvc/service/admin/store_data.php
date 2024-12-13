<?php
// ตรวจสอบการร้องขอเป็น POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับข้อมูลจาก POST
    $store_name = $_POST['store_name'] ?? '';
    $store_detail = $_POST['store_detail'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $status_store = $_POST['status_store'] ?? '';

    // ตรวจสอบการอัพโหลดรูปภาพ img_profile_store
    if (isset($_FILES['img_profile_store']) && $_FILES['img_profile_store']['error'] === UPLOAD_ERR_OK) {
        // กำหนดโฟลเดอร์ปลายทางสำหรับอัพโหลดรูปภาพ
        $targetDir = "store_profile/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // สร้างชื่อไฟล์ใหม่ที่ไม่ซ้ำกัน โดยใช้ชื่อร้าน + uniqid() + นามสกุลไฟล์
        $extension = pathinfo($_FILES['img_profile_store']['name'], PATHINFO_EXTENSION);
        $safeStoreName = uniqid('product_', true) . '.'; // แปลงชื่อร้านให้ปลอดภัย
        $fileName = $safeStoreName . "_" . uniqid() . "." . $extension;
        $targetFilePath = $targetDir . $fileName;

        // ตรวจสอบและเคลื่อนย้ายไฟล์
        if (move_uploaded_file($_FILES['img_profile_store']['tmp_name'], $targetFilePath)) {
            // เช็คชื่อร้านซ้ำ
            $stmt = $conn->prepare("SELECT COUNT(*) FROM store_data WHERE store_name = :store_name");
            $stmt->bindParam(':store_name', $store_name);
            $stmt->execute();
            $count = $stmt->fetchColumn();

            if ($count > 0) {
                // ชื่อร้านซ้ำ
                $response->error('ชื่อร้านซ้ำ', 400);
            } else {
                // ถ้าชื่อร้านไม่ซ้ำ ให้ทำการเพิ่มข้อมูล
                $stmt = $conn->prepare("INSERT INTO store_data (store_name, store_detail, img_profile_store, status, phone, status_store) VALUES (:store_name, :store_detail, :img_profile_store, :status, :phone, :status_store)");
                $stmt->bindParam(':store_name', $store_name);
                $stmt->bindParam(':store_detail', $store_detail);
                $stmt->bindParam(':img_profile_store', $targetFilePath); // เก็บ path ของไฟล์ในฐานข้อมูล
                $stmt->bindValue(':status', 'partner'); // ค่าคงที่
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':status_store', $status_store);

                if ($stmt->execute()) {
                    $response->success([], 'เพิ่มข้อมูลร้านค้าเรียบร้อย', 201);
                } else {
                    $response->error('ไม่สามารถเพิ่มข้อมูลได้', 500);
                }
            }
        } else {
            // การอัพโหลดไฟล์ล้มเหลว
            $response->error('การอัพโหลดไฟล์ล้มเหลว', 500);
        }
    } else {
        $response->error('กรุณาอัพโหลดรูปภาพ', 400);
    }
} else {
    // ถ้าไม่ใช่ POST
    $response->error('Method not allowed', 405);
}
?>
