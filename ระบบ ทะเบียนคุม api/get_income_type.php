<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // Allow all domains to access
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

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

$income_types = [];
$incomeTypeQuery = "
    SELECT it.income_type_id, it.income_type_code, it.income_type_name,
           ia.allocation_id, ia.allocation_name,
           sa.sub_allocation_id, sa.sub_allocation_name
    FROM income_type it
    LEFT JOIN income_allocation ia ON it.income_type_id = ia.income_type_id
    LEFT JOIN sub_allocation sa ON ia.allocation_id = sa.allocation_id";

$result = $conn->query($incomeTypeQuery);

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $income_type_id = $row['income_type_id'];

    if (!isset($income_types[$income_type_id])) {
        $income_types[$income_type_id] = [
            "income_type_id" => $income_type_id,
            "income_type_code" => $row['income_type_code'],
            "income_type_name" => $row['income_type_name'],
            "allocations" => []
        ];
    }

    $allocation_id = $row['allocation_id'];

    if (!isset($income_types[$income_type_id]["allocations"][$allocation_id])) {
        $income_types[$income_type_id]["allocations"][$allocation_id] = [
            "allocation_id" => $allocation_id,
            "allocation_name" => $row['allocation_name'],
            "sub_allocations" => []
        ];
    }

    if ($row['sub_allocation_id']) {
        $income_types[$income_type_id]["allocations"][$allocation_id]["sub_allocations"][] = [
            "sub_allocation_id" => $row['sub_allocation_id'],
            "sub_allocation_name" => $row['sub_allocation_name']
        ];
    }
}

echo json_encode(array_values($income_types));
?>
