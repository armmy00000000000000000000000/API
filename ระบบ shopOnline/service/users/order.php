<?php
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // ดึงข้อมูลจาก POST request
//     $product_id = $_POST['product_id'];
//     $store_id = $_POST['store_id'];
//     $quantity = $_POST['quantity'];
//     $size = $_POST['size'];
//     $total_price = $_POST['total_price'];
//     $buyer_id = $_POST['buyer_id'];
//     $shipping_address = $_POST['shipping_address'];
//     $payment_method = $_POST['payment_method'];
//     $line_token = $_POST['line_token'];

//     // สร้างเลขที่คำสั่งซื้อ
//     $order_date = date('Ymd'); // วันที่ในรูปแบบ yyyymmdd
//     $order_prefix = $store_id . $product_id . $order_date;

//     // นับลำดับคำสั่งซื้อ
//     $stmt = $conn->prepare("SELECT COUNT(*) FROM orders WHERE store_id = :store_id AND product_id = :product_id AND DATE(order_date) = CURDATE()");
//     $stmt->execute([':store_id' => $store_id, ':product_id' => $product_id]);
//     $order_count = $stmt->fetchColumn();

//     // เลขที่คำสั่งซื้อ = รหัสร้าน + รหัสสินค้า + วันที่ + ลำดับคำสั่งซื้อ
//     $order_number = '0' . $order_prefix . str_pad($order_count + 1, 3, '0', STR_PAD_LEFT);

//     // ตรวจสอบและจัดการการอัปโหลดไฟล์ slip
//     $slip_path = null; // ค่าเริ่มต้นหากไม่มีสลิป
//     if (isset($_FILES['slip']) && $_FILES['slip']['error'] === 0) {
//         $upload_dir = 'slips/'; // โฟลเดอร์สำหรับเก็บสลิป

//         // ตรวจสอบว่ามีโฟลเดอร์หรือไม่ ถ้าไม่มีก็สร้างขึ้นมา
//         if (!is_dir($upload_dir)) {
//             mkdir($upload_dir, 0777, true);
//         }

//         $slip_name = $order_number . '_' . basename($_FILES['slip']['name']);
//         $slip_path = $upload_dir . $slip_name;

//         // ตรวจสอบขนาดไฟล์ (ตั้งค่าตัวอย่างไว้ที่ 2MB)
//         if ($_FILES['slip']['size'] > 2 * 1024 * 1024) {
//             (new Response())->error("File size exceeds the limit", 400);
//             exit;
//         }

//         // ย้ายไฟล์ที่อัพโหลดไปยังโฟลเดอร์ที่กำหนด
//         if (!move_uploaded_file($_FILES['slip']['tmp_name'], $slip_path)) {
//             (new Response())->error("Failed to upload slip. Error code: " . $_FILES['slip']['error'], 500);
//             exit;
//         }
//     } else if (isset($_FILES['slip']['error']) && $_FILES['slip']['error'] !== UPLOAD_ERR_NO_FILE) {
//         (new Response())->error("File upload error: " . $_FILES['slip']['error'], 500);
//         exit;
//     }

    

//     // SQL สำหรับการเพิ่มข้อมูลคำสั่งซื้อ พร้อมกับ order_number และ slip
//     $sql = "INSERT INTO orders (order_number, order_date, product_id, store_id, quantity, size, total_price, buyer_id, shipping_address, payment_status, payment_method, slip, line_token)
//             VALUES (:order_number, NOW(), :product_id, :store_id, :quantity, :size, :total_price, :buyer_id, :shipping_address, 'pending', :payment_method, :slip, :line_token)";

//     try {
//         $stmt = $conn->prepare($sql);
//         $stmt->execute([
//             ':order_number' => $order_number,
//             ':product_id' => $product_id,
//             ':store_id' => $store_id,
//             ':quantity' => $quantity,
//             ':size' => $size,
//             ':total_price' => $total_price,
//             ':buyer_id' => $buyer_id,
//             ':shipping_address' => $shipping_address,
//             ':payment_method' => $payment_method,
//             ':slip' => $slip_path,
//             ':line_token' => $line_token
//         ]);

//         // ส่งข้อมูลการตอบกลับ
//         (new Response())->success(['order_number' => $order_number], 'Order created successfully', 201);
//     } catch (PDOException $e) {
//         (new Response())->error("Failed to create order: " . $e->getMessage(), 500);
//     }
// } else {
//     (new Response())->error("Invalid request method", 405);
// }


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ดึงข้อมูลจาก POST request
    $product_id = $_POST['product_id'];
    $store_id = $_POST['store_id'];
    $quantity = $_POST['quantity']; // ค่าที่ส่งมาจะเป็นจำนวนที่ต้องการซื้อ
    $size = $_POST['size'];
    $total_price = $_POST['total_price'];
    $buyer_id = $_POST['buyer_id'];
    $shipping_address = $_POST['shipping_address'];
    $payment_method = $_POST['payment_method'];
    $line_token = $_POST['line_token'];
  
    // สร้างเลขที่คำสั่งซื้อ
    $order_date = date('Ymd'); // วันที่ในรูปแบบ yyyymmdd
    $order_prefix = $store_id . $product_id . $buyer_id. $order_date;

    // นับลำดับคำสั่งซื้อ
    $stmt = $conn->prepare("SELECT COUNT(*) FROM orders WHERE store_id = :store_id AND DATE(order_date) = CURDATE()");
    $stmt->execute([':store_id' => $store_id]);
    $order_count = $stmt->fetchColumn();

    // เลขที่คำสั่งซื้อ = รหัสร้าน + รหัสสินค้า + วันที่ + ลำดับคำสั่งซื้อ
    $order_number = '0' . $order_prefix . str_pad($order_count + 1, 5, '0', STR_PAD_LEFT);

    // ตรวจสอบและจัดการการอัปโหลดไฟล์ slip
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
            (new Response())->error("File size exceeds the limit", 400);
            exit;
        }

        // ย้ายไฟล์ที่อัพโหลดไปยังโฟลเดอร์ที่กำหนด
        if (!move_uploaded_file($_FILES['slip']['tmp_name'], $slip_path)) {
            (new Response())->error("Failed to upload slip. Error code: " . $_FILES['slip']['error'], 500);
            exit;
        }
    } else if (isset($_FILES['slip']['error']) && $_FILES['slip']['error'] !== UPLOAD_ERR_NO_FILE) {
        (new Response())->error("File upload error: " . $_FILES['slip']['error'], 500);
        exit;
    }

    // ตรวจสอบสินค้าใน product_store
    $stmt = $conn->prepare("SELECT `id_product`, `quantity_product`, `quantity_sold` FROM `product_store` WHERE `id_product` = :product_id");
    $stmt->execute([':product_id' => $product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        $current_quantity = $product['quantity_product'] -  $quantity;
        $current_sold = $product['quantity_sold'] +  $quantity;

        // ตรวจสอบว่ามีสินค้าพอให้ขาย
        if ($current_quantity <= 0) {
            (new Response())->error("สินค้านี้หมดแล้ว.", 400);
            exit;
        }

       

        // อัปเดตข้อมูลใน product_store
        $update_stmt = $conn->prepare("UPDATE `product_store` SET `quantity_product` = :new_quantity, `quantity_sold` = :new_sold WHERE `id_product` = :product_id");
        $update_stmt->execute([
            ':new_quantity' => $current_quantity,
            ':new_sold' => $current_sold,
            ':product_id' => $product_id
        ]);

        // SQL สำหรับการเพิ่มข้อมูลคำสั่งซื้อ
        $sql = "INSERT INTO orders (order_number, order_date, product_id, store_id, quantity, size, total_price, buyer_id, shipping_address, payment_status, payment_method, slip, line_token)
                VALUES (:order_number, NOW(), :product_id, :store_id, :quantity, :size, :total_price, :buyer_id, :shipping_address, 'pending', :payment_method, :slip, :line_token)";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':order_number' => $order_number,
                ':product_id' => $product_id,
                ':store_id' => $store_id,
                ':quantity' => $quantity,
                ':size' => $size,
                ':total_price' => $total_price,
                ':buyer_id' => $buyer_id,
                ':shipping_address' => $shipping_address,
                ':payment_method' => $payment_method,
                ':slip' => $slip_path,
                ':line_token' => $line_token
            ]);

            // ส่งข้อมูลการตอบกลับ
            (new Response())->success(['order_number' => $order_number], 'Order created successfully', 201);
        } catch (PDOException $e) {
            (new Response())->error("Failed to create order: " . $e->getMessage(), 500);
        }
    } else {
        (new Response())->error("Product not found.", 404);
    }
} else {
    (new Response())->error("Invalid request method", 405);
}
?>


