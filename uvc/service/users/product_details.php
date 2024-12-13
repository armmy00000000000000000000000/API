<?php

// รับค่า id_product จากคำร้องขอ GET
$id_product = isset($_GET['id_product']) ? intval($_GET['id_product']) : 0;

if ($id_product > 0) {
    try {
        // ดึงข้อมูลจาก product_store
        $stmt = $conn->prepare("SELECT product_store.*,store_data.store_name FROM product_store JOIN store_data ON store_data.id_store = product_store.id_store WHERE product_store.id_product = :id_product");
        $stmt->bindParam(':id_product', $id_product, PDO::PARAM_INT);
        $stmt->execute();
        $productData = $stmt->fetch(PDO::FETCH_ASSOC);

        // ดึงข้อมูลจาก list_preview_product
        $stmt = $conn->prepare("SELECT * FROM list_preview_product WHERE id_product = :id_product");
        $stmt->bindParam(':id_product', $id_product, PDO::PARAM_INT);
        $stmt->execute();
        $previewImages = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // ดึงข้อมูลจาก product_size
        $stmt = $conn->prepare("SELECT * FROM product_size WHERE id_product = :id_product");
        $stmt->bindParam(':id_product', $id_product, PDO::PARAM_INT);
        $stmt->execute();
        $productSizes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // จัดเก็บข้อมูลในรูปแบบที่ต้องการ
        $responseData = [
            'product' => $productData,          // ข้อมูลจาก product_store
            'preview_images' => $previewImages, // ข้อมูลจาก list_preview_product
            'sizes' => $productSizes             // ข้อมูลจาก product_size
        ];

        // ส่งข้อมูลกลับในรูปแบบ JSON
        $response->success($responseData, 'ข้อมูลผลิตภัณฑ์และรูปภาพพรีวิวถูกต้อง', 200);
    } catch (Exception $e) {
        $response->error("เกิดข้อผิดพลาดในการดึงข้อมูล: " . $e->getMessage(), 500);
    }
} else {
    $response->error("Invalid product ID.", 400);
}

// ปิดการเชื่อมต่อ
$conn = null;
?>
