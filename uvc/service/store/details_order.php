<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับ action (เช่น 'select' หรือ 'update') และ `order_id`
    $action = $_POST['action'];
    $order_id = $_POST['order_id'];

    if ($action === 'select') {
        try {
            // ดึงข้อมูลคำสั่งซื้อจากตาราง orders และ product_store
            $sql = "SELECT product_store.name_product, orders.* 
                    FROM orders 
                    INNER JOIN product_store ON orders.product_id = product_store.id_product 
                    WHERE orders.order_id = :order_id";
            $stmt = $conn->prepare($sql);
            $stmt->execute([':order_id' => $order_id]);

            $order = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($order) {
                // ดึงข้อมูลขนาดสินค้าจากตาราง product_size โดยใช้ `size` จากข้อมูลคำสั่งซื้อ
                $size_sql = "SELECT * FROM product_size WHERE id  = :size_id";
                $size_stmt = $conn->prepare($size_sql);
                $size_stmt->execute([':size_id' => $order['size']]);
                $size_info = $size_stmt->fetch(PDO::FETCH_ASSOC);

                $addresssql = "SELECT * FROM user_address WHERE id_address = :addressid";
                $addressstmt = $conn->prepare($addresssql);
                $addressstmt->execute([':addressid' => $order['shipping_address']]);
                $addressinfo = $addressstmt->fetch(PDO::FETCH_ASSOC);

                // จัดโครงสร้างข้อมูลใหม่เพื่อแยกคีย์
                $order_data = [
                    'order' => $order,
                    'product_size' => $size_info,
                    'address_info' => $addressinfo
                ];

                (new Response())->success($order_data, 'Order data retrieved successfully', 200);
            } else {
                (new Response())->error("Order not found", 404);
            }
        } catch (PDOException $e) {
            (new Response())->error("Failed to retrieve order data: " . $e->getMessage(), 500);
        }
    } elseif ($action === 'update') {
   // ส่วนการอัปเดตข้อมูลคำสั่งซื้อ
   $payment_status = $_POST['payment_status'] ?? null;
   $preparation_status = $_POST['preparation_status'] ?? null;
//    $shipping_status = $_POST['shipping_status'] ?? null;
   $shipping_provider = $_POST['shipping_provider'] ?? null;
   $tracking_number = $_POST['tracking_number'] ?? null;

   try {
       // SQL สำหรับการอัปเดตข้อมูลคำสั่งซื้อ
       $sql = "UPDATE orders 
               SET payment_status = :payment_status, 
                   preparation_status = :preparation_status, 
                --    shipping_status = :shipping_status, 
                   shipping_provider = :shipping_provider, 
                   tracking_number = :tracking_number 
               WHERE order_id = :order_id";

       $stmt = $conn->prepare($sql);
       $stmt->execute([
           ':payment_status' => $payment_status,
           ':preparation_status' => $preparation_status,
        //    ':shipping_status' => $shipping_status,
           ':shipping_provider' => $shipping_provider,
           ':tracking_number' => $tracking_number,
           ':order_id' => $order_id
       ]);

       if ($stmt->rowCount() > 0) {
           (new Response())->success(null, 'Order updated successfully', 200);
       } else {
           (new Response())->error("Order not found or no changes made", 404);
       }
   } catch (PDOException $e) {
       (new Response())->error("Failed to update order: " . $e->getMessage(), 500);
   }
    } else {
        (new Response())->error("Invalid action specified", 400);
    }
} else {
    (new Response())->error("Invalid request method", 405);
}
?>