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
$status_type = 'Delivered';
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
        $id_income = $deliver['income_id'];

        // Insert main allocation data
        $deliver_sql = "INSERT INTO `deliver`( `income_id`, `income_type_id`, `allocation_name`, `amount`, `station`, `status`) 
                           VALUES (:income_id, :income_type_id, :allocation_name, :amount, :station, :status)";
        $deliver_stmt = $conn->prepare($deliver_sql);
        $deliver_stmt->execute([
            ':income_id' => $income_id,
            ':income_type_id' => $income_type_id,
            ':allocation_name' => $allocation_name,
            ':amount' => $amount,
            ':station' => $station,
            ':status' => $status,
        ]);

        $deliver_up= "UPDATE `income` SET `status_type`=:status_type WHERE `income_id` = :id_income";
        $deliver_stmt_up = $conn->prepare($deliver_up);
        $deliver_stmt_up->execute([
            ':id_income' => $id_income,
            ':status_type' => $status_type,
        ]);
   
    }

$result = [];
foreach ($delivers as $item) {
    $type_id = $item['allocation_name'];
    if (!isset($result[$type_id])) {
        $result[$type_id] = [
            "allocation_name" => $item['allocation_name'],
            "total_amount" => 0,
        ];
    }
    $result[$type_id]['total_amount'] += $item['amount'];
}

$current_date = date("Y-m-d");

foreach ($result as $row) {
    $amount = $row['total_amount'];
    $allocation_name = $row['allocation_name'];
 

    $sql_withdraw = "INSERT INTO `withdraw` (`amount`, `allocation_name`, `station`, `income_id`, `year`, `date`) 
            VALUES (:amount, :allocation_name, :station, :income_id, :year, :date)";

    $withdraw = $conn->prepare($sql_withdraw);
    $withdraw->execute([
        ':amount' => $amount,
        ':allocation_name' => $allocation_name,
        ':station' => $station,
        ':income_id' => $income_id,
        ':year' => $year,
        ':date' => $income_date,
    ]);
}

    

    $response->success($result , "บันทึกข้อมูลรายได้สำเร็จ", 201);
} catch (PDOException $e) {
    $response->error("เกิดข้อผิดพลาด: " . $e->getMessage(), 500);
}
?>



<?php
// ฟังก์ชันสำหรับเชื่อมต่อฐานข้อมูล

// ข้อมูล JSON
// $delivers = [
//     [
//         "income_id" => 111,
//         "income_type_id" => 21,
//         "allocation_name" => "เงินรางวัลจราจร",
//         "amount" => 670,
//         "station" => 3
//     ],
//     [
//         "income_id" => 111,
//         "income_type_id" => 21,
//         "allocation_name" => "เงินรางวัลจราจร",
//         "amount" => 670,
//         "station" => 3
//     ],
//     [
//         "income_id" => 110,
//         "income_type_id" => 32,
//         "allocation_name" => "รายได้แผ่นดิน",
//         "amount" => 800,
//         "station" => 3
//     ],
//     [
//         "income_id" => 110,
//         "income_type_id" => 32,
//         "allocation_name" => "รายได้แผ่นดิน",
//         "amount" => 800,
//         "station" => 3
//     ]
// ];

// // รวมค่าที่มี income_type_id เดียวกัน
// $result = [];
// foreach ($delivers as $item) {
//     $type_id = $item['income_type_id'];
//     if (!isset($result[$type_id])) {
//         $result[$type_id] = [
//             "income_type_id" => $type_id,
//             "allocation_name" => $item['allocation_name'],
//             "total_amount" => 0,
//             "station" => $item['station'],
//             "income_id" => $item['income_id']
//         ];
//     }
//     $result[$type_id]['total_amount'] += $item['amount'];
// }
// $result = array_values($result);


// if ($conn) {
//     $current_date = date("Y-m-d");

//     foreach ($result as $row) {
//         $amount = $row['total_amount'];
//         $allocation_name = $conn->quote($row['allocation_name']);
//         $station = $row['station'];
//         $income_id = $row['income_id'];

//         $sql = "INSERT INTO `withdraw` (`amount`, `allocation_name`, `station`, `income_id`, `date`) 
//                 VALUES ('$amount', $allocation_name, '$station', '$income_id', '$current_date')";
//     }
// }
?>



<?php
// $delivers = [
//     [
//         "income_id" => 111,
//         "income_type_id" => 21,
//         "allocation_name" => "เงินรางวัลจราจร",
//         "amount" => 670,
//         "station" => 3
//     ],
//     [
//         "income_id" => 111,
//         "income_type_id" => 21,
//         "allocation_name" => "เงินรางวัลจราจร",
//         "amount" => 670,
//         "station" => 3
//     ],
//     [
//         "income_id" => 110,
//         "income_type_id" => 32,
//         "allocation_name" => "รายได้แผ่นดิน",
//         "amount" => 800,
//         "station" => 3
//     ],
//     [
//         "income_id" => 110,
//         "income_type_id" => 32,
//         "allocation_name" => "รายได้แผ่นดิน",
//         "amount" => 800,
//         "station" => 3
//     ]
// ];

// $result = [];

// // รวมค่าที่มี income_type_id เดียวกัน
// foreach ($delivers as $item) {
//     $type_id = $item['income_type_id'];
//     if (!isset($result[$type_id])) {
//         $result[$type_id] = [
//             "income_type_id" => $type_id,
//             "allocation_name" => $item['allocation_name'],
//             "total_amount" => 0
//         ];
//     }
//     $result[$type_id]['total_amount'] += $item['amount'];
// }

// // เปลี่ยน array แบบ associative ให้เป็น index-based array
// $result = array_values($result);

// // แสดงผล
// echo "<pre>";
// print_r($result);
// echo "</pre>";


// Array
// (
//     [0] => Array
//         (
//             [income_type_id] => 21
//             [allocation_name] => เงินรางวัลจราจร
//             [total_amount] => 1340
//         )
//     [1] => Array
//         (
//             [income_type_id] => 32
//             [allocation_name] => รายได้แผ่นดิน
//             [total_amount] => 1600
//         )
// )
