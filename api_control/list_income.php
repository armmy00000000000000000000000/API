<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$dbname = 'mysql:dbname=zkyqpszw_icandefine;host=118.27.130.236';
$username = 'zkyqpszw_icandefine';
$password = 'Chaiya094';

try {
    $conn = new PDO($dbname, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
    exit;
}

// Query to get data with nested allocations and sub_allocations
try {
    $incomeQuery = "
        SELECT i.income_id, i.income_date, i.document_number, i.payment_type, i.income_type_id, it.income_type_code, it.income_type_name, 
               i.total_amount, i.id_sp,
               iad.allocation_id, a.allocation_name, iad.amount as allocation_amount,
               iad.sub_allocation_id, sa.sub_allocation_name, iad.amount as sub_allocation_amount
        FROM income i
        LEFT JOIN income_type it ON i.income_type_id = it.income_type_id
        LEFT JOIN income_allocation_data iad ON i.income_id = iad.income_id
        LEFT JOIN income_allocation a ON iad.allocation_id = a.allocation_id
        LEFT JOIN sub_allocation sa ON iad.sub_allocation_id = sa.sub_allocation_id
        ORDER BY i.income_date DESC
    ";
    
    $stmt = $conn->prepare($incomeQuery);
    $stmt->execute();
    $incomeData = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $income_id = $row['income_id'];
        $allocation_id = $row['allocation_id'];
        $sub_allocation_id = $row['sub_allocation_id'];

        // Group data by income_id, income_type_code, and income_type_name
        if (!isset($incomeData[$income_id])) {
            $incomeData[$income_id] = [
                "income_id" => $income_id,
                "income_date" => $row['income_date'],
                "document_number" => $row['document_number'],
                "payment_type" => $row['payment_type'],
                "income_type_id" => $row['income_type_id'],
                "income_type_code" => $row['income_type_code'],
                "income_type_name" => $row['income_type_name'],
                "total_amount" => $row['total_amount'],
                "id_sp" => $row['id_sp'],
                "allocations" => []
            ];
        }

        // Group allocations by allocation_id
        if ($allocation_id) {
            if (!isset($incomeData[$income_id]["allocations"][$allocation_id])) {
                $incomeData[$income_id]["allocations"][$allocation_id] = [
                    "allocation_id" => $allocation_id,
                    "allocation_name" => $row['allocation_name'],
                    "amount" => $row['allocation_amount'],
                    "sub_allocations" => []
                ];
            }
            
            // Group sub_allocations by sub_allocation_id if available
            if ($sub_allocation_id) {
                $incomeData[$income_id]["allocations"][$allocation_id]["sub_allocations"][] = [
                    "sub_allocation_id" => $sub_allocation_id,
                    "sub_allocation_name" => $row['sub_allocation_name'],
                    "amount" => $row['sub_allocation_amount']
                ];
            }
        }
    }

    // Reformat allocations to be array-based instead of associative
    foreach ($incomeData as &$income) {
        $income["allocations"] = array_values($income["allocations"]);
    }

    echo json_encode(array_values($incomeData));
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "เกิดข้อผิดพลาด: " . $e->getMessage()]);
}
?>
