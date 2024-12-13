<?php


try {
 
    // ตรวจสอบว่ามีการส่งค่า id_user มาหรือไม่
    if (!isset($_GET['id_user'])) {

        $response->error("ID user not provided", 400);
        exit;
    }

    $id_user = $_GET['id_user'];

    // ฟังก์ชันนับจำนวนแถว
    function getCount($conn, $table, $column, $id_user) {
        $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM `$table` WHERE `$column` = :id_user");
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    // นับจำนวนข้อมูลในแต่ละตาราง
    $user_address_count = getCount($conn, 'user_address', 'id_user', $id_user);
    $orders_count = getCount($conn, 'orders', 'buyer_id', $id_user);
    $shopping_cart_count = getCount($conn, 'shopping_cart', 'id_user', $id_user);

    // จัดเก็บผลลัพธ์ใน array
    $result = array(
        'user_address_count' => $user_address_count,
        'orders_count' => $orders_count,
        'shopping_cart_count' => $shopping_cart_count
    );

    // ส่งผลลัพธ์กลับไป
    $response->success($result, "Count retrieved successfully", 200);

} catch (PDOException $e) {
 
    $response->error($e->getMessage(), 500);
}
?>
