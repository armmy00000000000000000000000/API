<?php

$data = json_decode(file_get_contents("php://input"), true);

$income_date = $data['income_date'];
$document_number = $data['document_number'];
$payment_type = $data['payment_type'];
$income_type_id = $data['income_type_id'];
$total_amount = $data['total_amount'];
$status = "รับ";
$station = $data['station'];
$note = $data['note'];
$year = $data['year'];
$status_tells_details = $data['status_tells_details'];
$status_type = 'Pending';
$allocations = $data['allocations'];

try {
    // Insert income record using a prepared statement
    $sql = "INSERT INTO income (income_date, document_number, payment_type, income_type_id, total_amount,status, station,note,year,status_type,status_tells_details) 
            VALUES (:income_date, :document_number, :payment_type, :income_type_id, :total_amount, :status, :station,:note,:year,:status_type:status_tells_details)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':income_date' => $income_date,
        ':document_number' => $document_number,
        ':payment_type' => $payment_type,
        ':income_type_id' => $income_type_id,
        ':total_amount' => $total_amount,
        ':status' => $status,
        ':station' => $station,
        ':note' => $note,
        ':year' => $year,
        ':status_tells_details' => $status_tells_details,
        ':status_type' => $status_type,
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

    $response->success([], "บันทึกข้อมูลรายได้สำเร็จ", 201);
} catch (PDOException $e) {
    $response->error("เกิดข้อผิดพลาด: " . $e->getMessage(), 500);
}
?>
