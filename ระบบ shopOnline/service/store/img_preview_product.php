<?php
$maxFileSize = 8 * 1024 * 1024;
// ตรวจสอบว่าเป็น POST request หรือไม่
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action']; // รับ action จาก POST

    switch ($action) {
        case 'add':
            $preview_product_path = null;
            if (isset($_FILES['preview_product']) && $_FILES['preview_product']['error'] == 0) {
                global $maxFileSize;
                if ($_FILES['preview_product']['size'] > $maxFileSize) {
                    $maxSizeInMB = $maxFileSize / 1024 / 1024;
                    $response->error("ขนาดไฟล์ใหญ่เกินไป ต้องไม่เกิน {$maxSizeInMB} MB", 400);
                    return;
                }
        
                $uploadDir = 'preview_product/';
                $fileExtension = pathinfo($_FILES['preview_product']['name'], PATHINFO_EXTENSION);
                $newFileName = uniqid('product_', true) . '.' . $fileExtension;
                $uploadFile = $uploadDir . $newFileName;
        
                // ตรวจสอบว่าโฟลเดอร์สำหรับเก็บภาพมีอยู่หรือไม่ ถ้าไม่ให้สร้างขึ้นมา
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
        
                // อัปโหลดไฟล์ภาพ
                if (move_uploaded_file($_FILES['preview_product']['tmp_name'], $uploadFile)) {
                    $preview_product_path = $uploadFile;
                } else {
                    $response->error("ไม่สามารถอัปโหลดภาพได้", 500);
                    return;
                }
            }
        
            // ตรวจสอบว่ารูปภาพอัปโหลดสำเร็จ
            if ($preview_product_path) {
                $id_product = $_POST['id_product']; // รับ id_product จาก POST
        
                // บันทึกข้อมูลลงในฐานข้อมูล
                $stmt = $conn->prepare("INSERT INTO list_preview_product (img_preview, id_product) VALUES (:img_preview, :id_product)");
                $stmt->bindParam(':img_preview', $preview_product_path); // ใช้ $preview_product_path
                $stmt->bindParam(':id_product', $id_product);
                
                if ($stmt->execute()) {
                    $response->success([], 'อัปโหลดรูปภาพสำเร็จ', 200);
                } else {
                    $response->error('ไม่สามารถบันทึกข้อมูลในฐานข้อมูลได้', 500);
                }
            } else {
                $response->error('ไม่พบรูปภาพ', 400);
            }
            break;
        

        case 'update':
            $id = $_POST['id']; // รับ id ของรายการที่ต้องการอัปเดต
            $imageName = $_FILES['preview_product']['name'];
            $imageTmpName = $_FILES['preview_product']['tmp_name'];
            $imageError = $_FILES['preview_product']['error'];

            // ตรวจสอบว่าไม่มีข้อผิดพลาดในการอัปโหลด
            if ($imageError === 0) {
                // กำหนดที่เก็บภาพ
                $targetDir = "preview_product/";
                $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION); // รับนามสกุลไฟล์
                $newFileName = uniqid('preview_', true) . '.' . $imageExtension; // สร้างชื่อไฟล์ใหม่
                $targetFile = $targetDir . $newFileName; // ชื่อไฟล์ใหม่พร้อมที่เก็บ

                // อัปโหลดภาพ
                if (move_uploaded_file($imageTmpName, $targetFile)) {
                    // อัปเดตข้อมูลในฐานข้อมูล
                    $stmt = $conn->prepare("UPDATE list_preview_product SET img_preview = :img_preview WHERE id = :id");
                    $stmt->bindParam(':img_preview', $targetFile);
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();

         
                    $response->success([], 'อัปเดตรูปภาพสำเร็จ', 200);
                } else {
         
                    $response->error('ไม่สามารถอัปโหลดภาพ', 500);
                }
            } else {
     
                $response->error('ข้อผิดพลาดในการอัปโหลดภาพ', 500);
            }
            break;

        case 'delete':
            $id = $_POST['id']; // รับ id ของรายการที่ต้องการลบ

            // ลบข้อมูลในฐานข้อมูล
            $stmt = $conn->prepare("DELETE FROM list_preview_product WHERE id = :id");
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
     
                $response->success([], 'ลบรูปภาพสำเร็จ', 200);
            } else {
     
                $response->error('ไม่สามารถลบรูปภาพได้', 500);
            }
            break;

        default:
 
            $response->error('Action ไม่ถูกต้อง', 400);
            break;
    }
} else {
    $response = new Response();
    $response->error('ต้องเป็น POST request', 405);
}
?>
