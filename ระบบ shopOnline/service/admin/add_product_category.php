<?php

// ฟังก์ชันสำหรับเพิ่มหมวดหมู่สินค้า
function insertCategory(  $response,$conn) {

    // ตรวจสอบว่า request method เป็น POST หรือไม่
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // ดึงข้อมูลจาก POST request
        $category_name = $_POST['category_name'];

        // SQL สำหรับการเพิ่มข้อมูล
        $sql = "INSERT INTO product_category (category_name) VALUES (:category_name)";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':category_name' => $category_name
            ]);

            // ส่งผลลัพธ์กลับในกรณีที่สำเร็จ
            $response->success([], 'Category added successfully', 201);

        } catch (PDOException $e) {
            // ส่งผลลัพธ์กลับในกรณีที่เกิดข้อผิดพลาด
            $response->error("Failed to add category: " . $e->getMessage(), 500);
        }
    } else {
        $response->error("Invalid request method", 405);
    }
}

// เรียกใช้งานฟังก์ชัน insertCategory
insertCategory(  $response, $conn);
?>
