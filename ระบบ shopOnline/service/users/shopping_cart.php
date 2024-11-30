<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ดึงข้อมูลจาก POST request
    $id_user = $_POST['id_user'];
    $id_product = $_POST['id_product'];
    $name_product = $_POST['name_product'];
    $quantity_product = $_POST['quantity_product'];
    $unit_price = $_POST['unit_price'];
    $total_price = $_POST['total_price'];
    $size = $_POST['size'];
    $id_store = $_POST['id_store'];

    // ตรวจสอบให้แน่ใจว่าทุกค่ามีการส่ง
    if (empty($id_user) || empty($id_product) || empty($name_product) || empty($quantity_product) || empty($unit_price) || empty($total_price) || empty($size) || empty($id_store)) {
        (new Response())->error("Missing required parameters.", 400);
        exit;
    }

    // SQL สำหรับการเพิ่มข้อมูลไปยังตะกร้าสินค้า
    $sql = "INSERT INTO `shopping_cart` (`id_user`, `id_product`, `name_product`, `quantity_product`, `unit_price`, `total_price`, `size`, `id_store`) 
            VALUES (:id_user, :id_product, :name_product, :quantity_product, :unit_price, :total_price, :size, :id_store)";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':id_user' => $id_user,
            ':id_product' => $id_product,
            ':name_product' => $name_product,
            ':quantity_product' => $quantity_product,
            ':unit_price' => $unit_price,
            ':total_price' => $total_price,
            ':size' => $size,
            ':id_store' => $id_store
        ]);

        (new Response())->success([], 'Product added to shopping cart successfully.', 201);
    } catch (PDOException $e) {
        (new Response())->error("Failed to add product to shopping cart: " . $e->getMessage(), 500);
    }
} else {
    (new Response())->error("Invalid request method", 405);
}
?>
