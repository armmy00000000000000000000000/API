<?php

// ตรวจสอบว่ามีการส่ง id_store มาหรือไม่
if (isset($_GET['id_store'])) {
    $id_store = $_GET['id_store'];

    try {
        $stmt = $conn->prepare("SELECT * FROM payment_store WHERE id_store = :id_store");
        $stmt->bindParam(':id_store', $id_store, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result) {
            // ส่งผลลัพธ์กลับด้วย response success
            (new Response())->success($result, "Data fetched successfully.", 200);
        } else {
            // ถ้าไม่พบข้อมูล
            (new Response())->error("No data found.", 404);
        }
    } catch (PDOException $e) {
        (new Response())->error($e->getMessage(), 500);
    }
} else {
    (new Response())->error("id_store is required.", 400);
}
?>
