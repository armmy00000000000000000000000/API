<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $buyer_id = $_GET['id_user']; // เปลี่ยนตามที่คุณต้องการ

    try {
        // Query สำหรับดึงข้อมูลคำสั่งซื้อ
        $sql = "SELECT store_data.store_name, 
                       product_store.name_product, 
                       product_store.preview_product, 
                       product_store.price_product, 
                       orders.* 
                FROM orders 
                JOIN store_data ON store_data.id_store = orders.store_id 
                JOIN product_store ON product_store.id_product = orders.product_id 
                WHERE orders.buyer_id = :buyer_id ORDER BY orders.order_id  DESC";

        $stmt = $conn->prepare($sql);
        $stmt->execute([':buyer_id' => $buyer_id]);

        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // สร้างผลลัพธ์
        $result = [];

        // Loop ผ่านคำสั่งซื้อและตรวจสอบขนาดสินค้า
        foreach ($orders as $order) {
            $order_id = $order['order_id']; // รับค่า order_id
            $size_id = $order['size']; // รับค่าขนาด

            // Query เพื่อตรวจสอบขนาดสินค้า
            $size_sql = "SELECT * FROM product_size WHERE id = :size_id";
            $size_stmt = $conn->prepare($size_sql);
            $size_stmt->execute([':size_id' => $size_id]);
            $size_data = $size_stmt->fetch(PDO::FETCH_ASSOC);

            // เพิ่มข้อมูลในผลลัพธ์
            $result[] = [
                'order' => $order,
                'size' => $size_data // จะเป็น null หากไม่มีขนาด
            ];
        }

        // ส่งข้อมูลกลับ
        (new Response())->success($result, 'Data retrieved successfully', 200);
    } catch (PDOException $e) {
        (new Response())->error("Failed to retrieve data: " . $e->getMessage(), 500);
    }
} else {
    (new Response())->error("Invalid request method", 405);
}
?>
