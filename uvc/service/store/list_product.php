<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id_store']) && !empty($_POST['id_store'])) {
        $id_store = intval($_POST['id_store']); 

        try {
            $sql = "SELECT * FROM `product_store`
                    INNER JOIN product_category ON product_category.id_category = product_store.id_category
                    WHERE product_store.id_store = :id_store";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_store', $id_store, PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($result) {
                // นับจำนวนแถวที่ได้จากฐานข้อมูล
                $count = count($result);

                // เพิ่มคีย์ count ใน response
                $response_data = [
                    'data' => $result,
                    'count_product' => $count
                ];
                
                $response->success($response_data, 'Data fetched successfully', 200);
            } else {
                $response->error('No data found', 404);
            }
            
        } catch (PDOException $e) {
            $response->error('Database connection failed: ' . $e->getMessage(), 500);
        }
    } else {
        $response->error('id_store parameter is required', 400);
    }
} else {
    $response->error('Invalid request method. Only POST requests are allowed', 405);
}
?>
