<?php
// ตรวจสอบการร้องขอเป็น POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    try {
     

        // รับข้อมูลจาก POST
        $id_store = $_POST['id_store'] ?? '';
        $store_name = $_POST['store_name'] ?? '';
        $store_detail = $_POST['store_detail'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $img_profile_store = null;

        // ตรวจสอบการอัพโหลดรูปภาพใหม่ (img_profile_store)
        if (isset($_FILES['img_profile_store']) && $_FILES['img_profile_store']['error'] === UPLOAD_ERR_OK) {
            // ตั้งค่าโฟลเดอร์สำหรับเก็บไฟล์รูปภาพ
            $targetDir = "store_profile/";
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            // สร้างชื่อไฟล์ใหม่ให้ไม่ซ้ำกัน
            $extension = pathinfo($_FILES['img_profile_store']['name'], PATHINFO_EXTENSION);
            $safeStoreName =uniqid('product_', true) . '.' ;
            $fileName = $safeStoreName . "_" . uniqid() . "." . $extension;
            $targetFilePath = $targetDir . $fileName;

            // เคลื่อนย้ายไฟล์
            if (move_uploaded_file($_FILES['img_profile_store']['tmp_name'], $targetFilePath)) {
                $img_profile_store = $targetFilePath;
            } else {
                $response->error('การอัพโหลดไฟล์ล้มเหลว', 500);
                exit;
            }
        }

        // อัปเดตข้อมูลในฐานข้อมูล
        $sql = "UPDATE store_data SET 
                    store_name = :store_name,
                    store_detail = :store_detail,
                    phone = :phone" . 
                    ($img_profile_store ? ", img_profile_store = :img_profile_store" : "") . "
                WHERE id_store = :id_store";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':store_name', $store_name);
        $stmt->bindParam(':store_detail', $store_detail);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':id_store', $id_store, PDO::PARAM_INT);
        if ($img_profile_store) {
            $stmt->bindParam(':img_profile_store', $img_profile_store);
        }

        // ตรวจสอบและดำเนินการอัปเดต
        if ($stmt->execute()) {

            $response->success([], 'อัปเดตรายละเอียดร้านค้าเรียบร้อย', 200);
        } else {
            $response->error('ไม่สามารถอัปเดตข้อมูลได้', 500);
        }

    } catch (PDOException $e) {

        $response->error('เกิดข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล: ' . $e->getMessage(), 500);
    }
} else {
    $response->error('Method not allowed', 405);
}
?>
