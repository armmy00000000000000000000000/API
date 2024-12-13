<?php
try {
    // Database connection code here...

    // Get the request method
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method == 'PUT') {
        // Update logic
        $data = json_decode(file_get_contents("php://input"), true); // Decode JSON input
        
        // Check if required keys exist
        if (isset($data['id_store'], $data['store_name'], $data['store_detail'], $data['status'], $data['phone'],$data['status_store'])) {
            $id_store = $data['id_store'];
            $store_name = $data['store_name'];
            $store_detail = $data['store_detail'];
            $status = $data['status'];
            $phone = $data['phone'];
            $status_store = $data['status_store'];

            $stmt = $conn->prepare("UPDATE store_data SET store_name = ?, store_detail = ?, status = ?, phone = ?, status_store = ? WHERE id_store = ?");
            if ($stmt->execute([$store_name, $store_detail,  $status, $phone,$status_store, $id_store])) {
                $response->success([], "Record updated successfully", 200);
            } else {
                $response->error("Failed to update record", 500);
            }
        } else {
            $response->error("Missing required fields", 400);
        }
    } elseif ($method == 'DELETE') {
        // Delete logic
        $data = json_decode(file_get_contents("php://input"), true); // Decode JSON input

        // Check if required key exists
        if (isset($data['id_store'])) {
            $id_store = $data['id_store'];

            $stmt = $conn->prepare("DELETE FROM store_data WHERE id_store = ?");
            if ($stmt->execute([$id_store])) {
                $response->success([], "Record deleted successfully", 200);
            } else {
                $response->error("Failed to delete record", 500);
            }
        } else {
            $response->error("Missing 'id_store' field", 400);
        }
    } else {
        $response->error("Method not allowed", 405);
    }
} catch (PDOException $e) {
    $response->error($e->getMessage(), 500);
}
?>
