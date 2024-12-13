<?php
error_reporting(0); 
// กำหนดขนาดไฟล์สูงสุด (8 MB)
$maxFileSize = 8 * 1024 * 1024;

// ฟังก์ชันสำหรับเพิ่มข้อมูล
function insertProduct($response, $conn) {

    // ตรวจสอบว่า request method เป็น POST หรือไม่
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // ดึงข้อมูลจาก POST request
        $name_product = $_POST['name_product'];
        $id_category = $_POST['id_category'];
        $option_product = $_POST['option_product'];
        $quantity_product = $_POST['quantity_product'];
        $price_product = $_POST['price_product'];
        $product_detall = $_POST['product_detall'];
        $id_store = $_POST['id_store'];
        $publish_status = $_POST['publish_status'];

        // ตรวจสอบและอัปโหลดรูปภาพ
        $preview_product_path = '';
        if (isset($_FILES['preview_product']) && $_FILES['preview_product']['error'] == 0) {
            global $maxFileSize;
            // ตรวจสอบขนาดของไฟล์
            if ($_FILES['preview_product']['size'] > $maxFileSize) {
                $maxSizeInMB = $maxFileSize / 1024 / 1024;
                $response->error("ขนาดไฟล์ใหญ่เกินไป ต้องไม่เกิน {$maxSizeInMB} MB", 400);
                return;
            }

            $uploadDir = 'preview_product/'; // กำหนดโฟลเดอร์สำหรับเก็บรูปภาพ
            $fileExtension = pathinfo($_FILES['preview_product']['name'], PATHINFO_EXTENSION);
            $newFileName = uniqid('product_', true) . '.' . $fileExtension;
            $uploadFile = $uploadDir . $newFileName;

            // ตรวจสอบและสร้างโฟลเดอร์ถ้ายังไม่มี
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // ย้ายไฟล์ไปยังโฟลเดอร์ที่กำหนด
            if (move_uploaded_file($_FILES['preview_product']['tmp_name'], $uploadFile)) {
                $preview_product_path = $uploadFile; // เก็บพาธของไฟล์รูปภาพ
            } else {
                $response->error("Failed to upload image.", 500);
                return;
            }
        }

        // SQL สำหรับการเพิ่มข้อมูล
        $sql = "INSERT INTO product_store (name_product, id_category, option_product, quantity_product, price_product, preview_product, product_detall,id_store, publish_status)
                VALUES (:name_product, :id_category, :option_product, :quantity_product, :price_product, :preview_product, :product_detall,:id_store, :publish_status)";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':name_product' => $name_product,
                ':id_category' => $id_category,
                ':option_product' => $option_product,
                ':quantity_product' => $quantity_product,
                ':price_product' => $price_product,
                ':preview_product' => $preview_product_path,
                ':product_detall' => $product_detall,
                ':id_store' => $id_store,
                ':publish_status' => $publish_status
            ]);

            // ส่งผลลัพธ์กลับในกรณีที่สำเร็จ
            $response->success([], 'Product added successfully', 201);

        } catch (PDOException $e) {
            // ส่งผลลัพธ์กลับในกรณีที่เกิดข้อผิดพลาด
            $response->error("Failed to add product: " . $e->getMessage(), 500);
        }
    } else {
        $response->error("Invalid request method", 405);
    }
}

// ฟังก์ชันสำหรับแก้ไขข้อมูล
function updateProduct($response, $conn) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_product'])) {
        $id_product = $_POST['id_product'];
        $name_product = $_POST['name_product'];
        $id_category = $_POST['id_category'];
        $option_product = $_POST['option_product'];
        $quantity_product = $_POST['quantity_product'];
        $price_product = $_POST['price_product'];
        $product_detall = $_POST['product_detall'];
        $publish_status = $_POST['publish_status'];

        $preview_product_path = null;
        if (isset($_FILES['preview_product']) && $_FILES['preview_product']['error'] == 0) {
            global $maxFileSize;
            if ($_FILES['preview_product']['size'] > $maxFileSize) {
                $maxSizeInMB = $maxFileSize / 1024 / 1024;
                $response->error("ขนาดไฟล์ใหญ่เกินไป ต้องไม่เกิน {$maxSizeInMB} MB", 400);
                return;
            }

            $uploadDir = 'preview_product/';
            $fileExtension = pathinfo($_FILES['preview_product']['name'], PATHINFO_EXTENSION);
            $newFileName = uniqid('product_', true) . '.' . $fileExtension;
            $uploadFile = $uploadDir . $newFileName;

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if (move_uploaded_file($_FILES['preview_product']['tmp_name'], $uploadFile)) {
                $preview_product_path = $uploadFile;
            } else {
                $response->error("Failed to upload image.", 500);
                return;
            }
        }

        $sql = "UPDATE product_store SET 
                    name_product = :name_product, 
                    id_category = :id_category, 
                    option_product = :option_product, 
                    quantity_product = :quantity_product, 
                    price_product = :price_product, 
                    product_detall = :product_detall, 
                    publish_status = :publish_status" .
                ($preview_product_path ? ", preview_product = :preview_product" : "") . 
                " WHERE id_product = :id_product";

        try {
            $stmt = $conn->prepare($sql);
            $params = [
                ':name_product' => $name_product,
                ':id_category' => $id_category,
                ':option_product' => $option_product,
                ':quantity_product' => $quantity_product,
                ':price_product' => $price_product,
                ':product_detall' => $product_detall,
                ':publish_status' => $publish_status,
                ':id_product' => $id_product
            ];

            if ($preview_product_path) {
                $params[':preview_product'] = $preview_product_path;
            }

            $stmt->execute($params);
            $response->success([], 'Product updated successfully', 200);
        } catch (PDOException $e) {
            $response->error("Failed to update product: " . $e->getMessage(), 500);
        }
    } else {
        $response->error("Invalid request method or missing product ID", 405);
    }
}

// ฟังก์ชันสำหรับลบข้อมูล
function deleteProduct($response, $conn) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_product'])) {
        $id_product = $_POST['id_product'];

        // SQL สำหรับการลบข้อมูล
        $sql = "DELETE FROM product_store WHERE id_product = :id_product";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([':id_product' => $id_product]);
            $response->success([], 'Product deleted successfully', 200);
        } catch (PDOException $e) {
            $response->error("Failed to delete product: " . $e->getMessage(), 500);
        }
    } else {
        $response->error("Invalid request method or missing product ID", 405);
    }
}


// ฟังก์ชันสำหรับค้นหาข้อมูล
function selectProduct($response, $conn) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_product'])) {
        $id_product = $_POST['id_product'];

        try {
            $stmt = $conn->prepare("SELECT product_store.*,product_category.category_name FROM product_store join product_category on product_store.id_category = product_category.id_category WHERE product_store.id_product = :id_product");
            $stmt->execute([':id_product' => $id_product]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $response->success($result, 'Product retrieved successfully', 200);
            } else {
                $response->error("Product not found", 404);
            }
        } catch (PDOException $e) {
            $response->error("Error retrieving product: " . $e->getMessage(), 500);
        }
    } else {
        $response->error("Invalid request method or missing product ID", 400);
    }
}
// เรียกใช้งานฟังก์ชัน
if (isset($_POST['action'])) {
    if ($_POST['action'] == 'add') {
        insertProduct($response, $conn);
    } elseif ($_POST['action'] == 'update') {
        updateProduct($response, $conn);  
    } elseif ($_POST['action'] == 'delete') {
        deleteProduct($response, $conn);
    } elseif ($_POST['action'] == 'select') {
        selectProduct($response, $conn);
    } else {
        $response->error("No valid action specified", 405);
    }
} else {
    $response->error("No action specified", 400);
}
?>
