<?php

$data = json_decode(file_get_contents("php://input"), true);

$income_date = $data['income_date'];
$document_number = $data['document_number'];
$payment_type = $data['payment_type'];
$income_type_id = $data['income_type_id'];
$total_amount = $data['total_amount'];
$status = "นำส่ง";
$station = $data['station'];
$note = $data['note'];
$year = $data['year'];
$delivers = $data['delivers'];

try {
    // Insert income record using a prepared statement
    $sql = "INSERT INTO income (income_date, document_number, payment_type, income_type_id, total_amount,status, station,note,year) 
            VALUES (:income_date, :document_number, :payment_type, :income_type_id, :total_amount, :status, :station,:note,:year)";
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
    ]);
    $income_id = $conn->lastInsertId();

    // Insert allocation and sub-allocation data
    foreach ($delivers as $deliver) {
        $income_type_id = $deliver['income_type_id'];
        $allocation_name = $deliver['allocation_name'];
        $amount = $deliver['amount'];
        $station = $deliver['station'];

        // Insert main allocation data
        $deliver_sql = "INSERT INTO `deliver`( `income_id`, `income_type_id`, `allocation_name`, `amount`, `station`) 
                           VALUES (:income_id, :income_type_id, :allocation_name, :amount, :station)";
        $deliver_stmt = $conn->prepare($deliver_sql);
        $deliver_stmt->execute([
            ':income_id' => $income_id,
            ':income_type_id' => $income_type_id,
            ':allocation_name' => $allocation_name,
            ':amount' => $amount,
            ':station' => $station,
        ]);
   
    }

    $response->success([], "บันทึกข้อมูลรายได้สำเร็จ", 201);
} catch (PDOException $e) {
    $response->error("เกิดข้อผิดพลาด: " . $e->getMessage(), 500);
}
?>