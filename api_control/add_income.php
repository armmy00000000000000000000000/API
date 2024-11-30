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

$data = json_decode(file_get_contents("php://input"), true);

$income_date = $data['income_date'];
$document_number = $data['document_number'];
$payment_type = $data['payment_type'];
$income_type_id = $data['income_type_id'];
$total_amount = $data['total_amount'];
$id_sp = $data['id_sp'];
$allocations = $data['allocations'];

try {
    // Insert income record using a prepared statement
    $sql = "INSERT INTO income (income_date, document_number, payment_type, income_type_id, total_amount,id_sp) 
            VALUES (:income_date, :document_number, :payment_type, :income_type_id, :total_amount,:id_sp)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':income_date' => $income_date,
        ':document_number' => $document_number,
        ':payment_type' => $payment_type,
        ':income_type_id' => $income_type_id,
        ':total_amount' => $total_amount,
        ':id_sp' => $id_sp,
    ]);
    $income_id = $conn->lastInsertId();

    // Insert allocation and sub-allocation data
    foreach ($allocations as $allocation) {
        $allocation_id = $allocation['allocation_id'];
        $allocation_amount = $allocation['amount'];

        // Insert main allocation data
        $allocation_sql = "INSERT INTO income_allocation_data (income_id, allocation_id, amount) 
                           VALUES (:income_id, :allocation_id, :amount)";
        $allocation_stmt = $conn->prepare($allocation_sql);
        $allocation_stmt->execute([
            ':income_id' => $income_id,
            ':allocation_id' => $allocation_id,
            ':amount' => $allocation_amount,
        ]);
        $allocation_data_id = $conn->lastInsertId();

        // Check for sub-allocations
        if (isset($allocation['sub_allocations'])) {
            foreach ($allocation['sub_allocations'] as $subAllocation) {
                $sub_allocation_id = $subAllocation['sub_allocation_id'];
                $sub_allocation_amount = $subAllocation['amount'];

                // Insert sub-allocation data
                $sub_allocation_sql = "INSERT INTO income_allocation_data (income_id, allocation_id, sub_allocation_id, amount) 
                                       VALUES (:income_id, :allocation_id, :sub_allocation_id, :amount)";
                $sub_allocation_stmt = $conn->prepare($sub_allocation_sql);
                $sub_allocation_stmt->execute([
                    ':income_id' => $income_id,
                    ':allocation_id' => $allocation_id,
                    ':sub_allocation_id' => $sub_allocation_id,
                    ':amount' => $sub_allocation_amount,
                ]);
            }
        }
    }

    $response = ["status" => "success", "message" => "บันทึกข้อมูลรายได้สำเร็จ"];
} catch (PDOException $e) {
    $response = ["status" => "error", "message" => "เกิดข้อผิดพลาด: " . $e->getMessage()];
}

echo json_encode($response);