<?php

// ฟังก์ชันเพื่อให้คะแนนสินค้า
function rateProduct($conn, $id_product, $rating, $user_id) {
    // ตรวจสอบว่าผู้ใช้ได้ให้คะแนนสินค้านี้ไปแล้วหรือไม่
    $stmt = $conn->prepare("SELECT * FROM product_ratings WHERE id_product = ? AND user_id = ?");
    $stmt->execute([$id_product, $user_id]);

    if ($stmt->rowCount() > 0) {
        // ถ้ามีคะแนนอยู่แล้ว ให้ทำการอัพเดท
        $stmt = $conn->prepare("UPDATE product_ratings SET rating = ? WHERE id_product = ? AND user_id = ?");
        $stmt->execute([$rating, $id_product, $user_id]);
    } else {
        // ถ้ายังไม่มีคะแนน ให้ทำการเพิ่ม
        $stmt = $conn->prepare("INSERT INTO product_ratings (id_product, rating, user_id) VALUES (?, ?, ?)");
        $stmt->execute([$id_product, $rating, $user_id]);
    }
}

// ดึงข้อมูลสินค้าพร้อมคะแนน
function getProductsWithRatings($conn) {
    $stmt = $conn->query("SELECT p.*, 
                                 s.store_name, 
                                 s.img_profile_store,
                                 COALESCE(AVG(r.rating), 0) AS average_rating 
                          FROM product_store AS p 
                          LEFT JOIN product_ratings AS r ON p.id_product = r.id_product 
                          LEFT JOIN store_data AS s ON p.id_store = s.id_store where p.publish_status = 'public'
                          GROUP BY p.id_product 
                          ORDER BY average_rating DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// ประมวลผลคำขอ


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_product = $_POST['id_product'];
    $rating = $_POST['rating'];
    $user_id = $_POST['user_id']; // รับ user_id จาก POST

    if (!empty($id_product) && !empty($rating) && !empty($user_id)) {
        rateProduct($conn, $id_product, $rating, $user_id);
        $response->success([], 'Rating submitted successfully.', 200);
    } else {
        $response->error('Invalid input.', 400);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $products = getProductsWithRatings($conn);
    foreach ($products as &$product) {
        $product['stars'] = str_repeat("⭐", round($product['average_rating'])); // แสดงคะแนนในรูปแบบดาว
        $product['average_rating'] = round($product['average_rating'], 1); // ทำให้คะแนนเฉลี่ยแสดงเป็นทศนิยม 1 ตำแหน่ง
    }
    $response->success($products, 'Products retrieved successfully.', 200);
} else {
    $response->error('Method not allowed.', 405);
}
?>
