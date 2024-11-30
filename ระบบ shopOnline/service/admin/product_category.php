<?php


$data = json_decode(file_get_contents("php://input"), true);
$action = $data['action'] ?? '';

switch ($action) {
    case 'select':
        try {
            $stmt = $conn->prepare("SELECT * FROM product_category");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $response->success($result, "Data retrieved successfully", 200);
        } catch (PDOException $e) {
            $response->error("Error retrieving data: " . $e->getMessage(), 401);
        }
        break;

    case 'delete':
        $id_category = $data['id_category'] ?? null;
        if ($id_category) {
            try {
                $stmt = $conn->prepare("DELETE FROM product_category WHERE id_category = :id_category");
                $stmt->bindParam(':id_category', $id_category);
                $stmt->execute();
                $response->success([], "Category deleted successfully", 200);
            } catch (PDOException $e) {
                $response->error("Error deleting category: " . $e->getMessage(), 401);
            }
        } else {
            $response->error("Category ID is required for deletion", 400);
        }
        break;

    case 'update':
        $id_category = $data['id_category'] ?? null;
        $category_name = $data['category_name'] ?? null;

        
        if ($id_category && $category_name ) {
            try {
                $stmt = $conn->prepare("UPDATE product_category SET category_name = :category_name WHERE id_category = :id_category");
                $stmt->bindParam(':category_name', $category_name);
                $stmt->bindParam(':id_category', $id_category);
                $stmt->execute();
                $response->success([], "Category updated successfully", 200);
            } catch (PDOException $e) {
                $response->error("Error updating category: " . $e->getMessage(), 401);
            }
        } else {
            $response->error("Category ID, name, and date_time are required for update", 400);
        }
        break;

    default:
        $response->error("Invalid action specified", 401);
}
?>
