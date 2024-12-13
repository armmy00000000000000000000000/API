<?php


// เพิ่มขนาดสินค้า
function addSize($conn, $size, $id_product) {
    $stmt = $conn->prepare("SELECT COUNT(*) FROM product_size WHERE id_product = :id_product AND size = :size");
    $stmt->execute(['id_product' => $id_product, 'size' => $size]);
    $exists = $stmt->fetchColumn();

    if ($exists > 0) {
        return ["status" => false, "message" => "Size already exists for this product."];
    }

    $stmt = $conn->prepare("INSERT INTO product_size (size, id_product) VALUES (:size, :id_product)");
    $stmt->execute(['size' => $size, 'id_product' => $id_product]);
    return ["status" => true, "message" => "Size added successfully."];
}

// แก้ไขขนาดสินค้า
function updateSize($conn, $id, $size) {
    $stmt = $conn->prepare("UPDATE product_size SET size = :size WHERE id = :id");
    $stmt->execute(['size' => $size, 'id' => $id]);
    return ["status" => true, "message" => "Size updated successfully."];
}

// ลบขนาดสินค้า
function deleteSize($conn, $id) {
    $stmt = $conn->prepare("DELETE FROM product_size WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return ["status" => true, "message" => "Size deleted successfully."];
}

// ตัวอย่างการเรียกใช้งาน API
$action = $_POST['action']; // เช่น 'add', 'update', 'delete'
if ($action === 'add') {
    $size = $_POST['size'];
    $id_product = $_POST['id_product'];
    $result = addSize($conn, $size, $id_product);
    $response->success([], $result['message'], 200);
} elseif ($action === 'update') {
    $id = $_POST['id'];
    $size = $_POST['size'];
    $result = updateSize($conn, $id, $size);
    $response->success([], $result['message'], 200);
} elseif ($action === 'delete') {
    $id = $_POST['id'];
    $result = deleteSize($conn, $id);
    $response->success([], $result['message'], 200);
} else {
    $response->error("Invalid action.", 400);
}
?>
