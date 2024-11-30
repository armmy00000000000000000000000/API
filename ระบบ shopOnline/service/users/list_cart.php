<?php


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // ดึงข้อมูลจาก query parameters
    $id_user = $_GET['id_user'];

    // ตรวจสอบว่ามี id_user หรือไม่
    if (empty($id_user)) {
        (new Response())->error("Missing required parameter: id_user", 400);
        exit;
    }

    // SQL สำหรับดึงข้อมูลจาก shopping_cart และ product_store
    $sql = "SELECT 
                product_store.id_product,
                product_store.id_store,
                product_store.name_product,
                product_store.preview_product,
                shopping_cart.id_cart,
                shopping_cart.id_user,
                shopping_cart.quantity_product,
                shopping_cart.unit_price,
                shopping_cart.total_price,
                shopping_cart.size 
            FROM 
                shopping_cart 
            JOIN 
                product_store ON shopping_cart.id_product = product_store.id_product 
            WHERE 
                shopping_cart.id_user = :id_user";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id_user' => $id_user]);
        $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // ถ้ามีข้อมูลในตะกร้า
        if ($cart_items) {
            $result = [];

            // วนลูปเพื่อนำขนาดสินค้าแยกเป็น key
            foreach ($cart_items as $item) {
                // ดึงข้อมูลขนาดสินค้าจาก product_size
                $size_sql = "SELECT * FROM `product_size` WHERE `id` = :size_id";
                $size_stmt = $conn->prepare($size_sql);
                $size_stmt->execute([':size_id' => $item['size']]);
                $size_info = $size_stmt->fetch(PDO::FETCH_ASSOC);

                // เพิ่มข้อมูลขนาดในแต่ละรายการ
                $item['size_info'] = $size_info; // ข้อมูลขนาดสินค้า
                $result[] = $item;
            }

            (new Response())->success($result, 'Cart items retrieved successfully.', 200);
        } else {
            (new Response())->success([], 'No items found in the shopping cart.', 200);
        }
    } catch (PDOException $e) {
        (new Response())->error("Failed to retrieve cart items: " . $e->getMessage(), 500);
    }
} else {
    (new Response())->error("Invalid request method", 405);
}
?>
