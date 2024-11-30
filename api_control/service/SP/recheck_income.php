<?php

// if (!isset($_GET['station']) || empty($_GET['station'])) {
//     $response->error("Parameter 'station' is required", 400);
//     exit;
// }

// $station = $_GET['station'];
// // Query to get data with nested allocations and sub_allocations
// try {
//     $incomeQuery = " 
//      SELECT i.income_id, i.status, i.income_date, i.document_number, i.payment_type, i.income_type_id, it.income_type_code, it.income_type_name, 
//        i.total_amount, i.station, i.note, i.year,
//        iad.allocation_id, a.allocation_name, iad.amount as allocation_amount,
//        iad.sub_allocation_id, sa.sub_allocation_name, iad.amount as sub_allocation_amount
//     FROM income i
//     LEFT JOIN income_type it ON i.income_type_id = it.income_type_id
//     LEFT JOIN income_allocation_data iad ON i.income_id = iad.income_id AND iad.amount != '0.00'  -- กรองข้อมูลที่มีจำนวนไม่เท่ากับ 0.00 ที่นี่
//     LEFT JOIN income_allocation a ON iad.allocation_id = a.allocation_id
//     LEFT JOIN sub_allocation sa ON iad.sub_allocation_id = sa.sub_allocation_id
//     WHERE i.station = :station
//     ORDER BY i.income_date DESC
//     ";

//     $stmt = $conn->prepare($incomeQuery);
//     $stmt->execute([ ':station' => $station ]);
//     $incomeData = [];

//     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//         $income_id = $row['income_id'];
//         $allocation_id = $row['allocation_id'];
//         $sub_allocation_id = $row['sub_allocation_id'];
//         $sub_allocation_amount = $row['sub_allocation_amount'];
//         $allocation_amount = $row['allocation_amount'];

//         // Group data by income_id, income_type_code, and income_type_name
//         if (!isset($incomeData[$income_id])) {
//             $incomeData[$income_id] = [
//                 "income_id" => $income_id,
//                 "income_date" => $row['income_date'],
//                 "document_number" => $row['document_number'],
//                 "payment_type" => $row['payment_type'],
//                 "income_type_id" => $row['income_type_id'],
//                 "income_type_code" => $row['income_type_code'],
//                 "income_type_name" => $row['income_type_name'],
//                 "total_amount" => $row['total_amount'],
//                 "year" => $row['year'],
//                 "note" => $row['note'],
//                 "station" => $row['station'],
//                 "status" => $row['status'],
//                 "allocations" => [],
//                 "total_allocation_amount" => 0,  // Initial sum for allocations (ไม่รวม sub_allocations)
//                 "total_sub_allocation_amount" => 0  // Initial sum for sub_allocations
//             ];
//         }

//         // Group allocations by allocation_id
//         if ($allocation_id) {
//             if (!isset($incomeData[$income_id]["allocations"][$allocation_id])) {
//                 $incomeData[$income_id]["allocations"][$allocation_id] = [
//                     "allocation_id" => $allocation_id,
//                     "allocation_name" => $row['allocation_name'],
//                     "amount" => $allocation_amount,
//                     "sub_allocations" => [],
//                 ];
//                 $incomeData[$income_id]["total_allocation_amount"] += (float)$allocation_amount;
//             }

//             // Group sub_allocations by sub_allocation_id if available and sub_allocation_amount is not 0.00
//             if ($sub_allocation_id && $sub_allocation_amount != "0.00") {
//                 $incomeData[$income_id]["allocations"][$allocation_id]["sub_allocations"][] = [
//                     "sub_allocation_id" => $sub_allocation_id,
//                     "sub_allocation_name" => $row['sub_allocation_name'],
//                     "amount" => $sub_allocation_amount
//                 ];

//                 // เพิ่มค่า sub_allocation_amount เข้าไปใน total_sub_allocation_amount
//                 $incomeData[$income_id]["total_sub_allocation_amount"] += (float)$sub_allocation_amount;
//             }
//         }
//     }

//     // Reformat allocations to be array-based instead of associative
//     foreach ($incomeData as &$income) {
//         $income["allocations"] = array_values($income["allocations"]);

//         // ตรวจสอบว่า total_allocation_amount ไม่เท่ากับ 0 และไม่เท่ากับ total_amount ก่อนแสดง allocations
//         if ($income["total_allocation_amount"] == 0 || $income["total_allocation_amount"] == (float)$income['total_amount']) {
//             // unset($income["allocations"]);
//             unset($income["allocations"]);
//         }
//         $income['result'] = $income['total_amount'] - $income['total_allocation_amount'];
//         // คำนวณผลต่าง result หาก total_allocation_amount ไม่เท่ากับ total_amount
//         // if ($income['total_allocation_amount'] != (float)$income['total_amount']) {
//         //     $income['result'] = $income['total_amount'] - $income['total_allocation_amount'];  // คำนวณผลต่าง
//         // } else {
//         //     // unset($income['result']);  // ไม่ต้องแสดง result ถ้า total_allocation_amount == total_amount
//         //     $income['result'] = $income['total_amount'] - $income['total_allocation_amount'];
//         // }
//     }

//     $response->success(array_values($incomeData), "Data retrieved successfully", 200);
// } catch (PDOException $e) {
//     $response->error("An error occurred: " . $e->getMessage(), 500);
// }
?>



<?php

if (!isset($_GET['station']) || empty($_GET['station'])) {
    $response->error("Parameter 'station' is required", 400);
    exit;
}

$station = $_GET['station'];
// Query to get data with nested allocations and sub_allocations
try {
    $incomeQuery = " 
     SELECT i.income_id, i.status, i.income_date, i.document_number, i.payment_type, i.income_type_id, it.income_type_code, it.income_type_name, 
       i.total_amount, i.station, i.note, i.year,
       iad.allocation_id, a.allocation_name, iad.amount as allocation_amount,
       iad.sub_allocation_id, sa.sub_allocation_name, iad.amount as sub_allocation_amount
    FROM income i
    LEFT JOIN income_type it ON i.income_type_id = it.income_type_id
    LEFT JOIN income_allocation_data iad ON i.income_id = iad.income_id AND iad.amount != '0.00'  -- กรองข้อมูลที่มีจำนวนไม่เท่ากับ 0.00 ที่นี่
    LEFT JOIN income_allocation a ON iad.allocation_id = a.allocation_id
    LEFT JOIN sub_allocation sa ON iad.sub_allocation_id = sa.sub_allocation_id
    WHERE i.station = :station
    ORDER BY i.income_date DESC
    ";

    $stmt = $conn->prepare($incomeQuery);
    $stmt->execute([ ':station' => $station ]);
    $incomeData = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $income_id = $row['income_id'];
        $allocation_id = $row['allocation_id'];
        $sub_allocation_id = $row['sub_allocation_id'];
        $sub_allocation_amount = $row['sub_allocation_amount'];
        $allocation_amount = $row['allocation_amount'];

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
                "year" => $row['year'],
                "note" => $row['note'],
                "station" => $row['station'],
                "status" => $row['status'],
                "allocations" => [],
                "total_allocation_amount" => 0,  // Initial sum for allocations (ไม่รวม sub_allocations)
                "total_sub_allocation_amount" => 0  // Initial sum for sub_allocations
            ];
        }

        // Group allocations by allocation_id
        if ($allocation_id) {
            if (!isset($incomeData[$income_id]["allocations"][$allocation_id])) {
                $incomeData[$income_id]["allocations"][$allocation_id] = [
                    "allocation_id" => $allocation_id,
                    "allocation_name" => $row['allocation_name'],
                    "amount" => $allocation_amount,
                    "sub_allocations" => [],
                ];
                $incomeData[$income_id]["total_allocation_amount"] += (float)$allocation_amount;
            }

            // Group sub_allocations by sub_allocation_id if available and sub_allocation_amount is not 0.00
            if ($sub_allocation_id && $sub_allocation_amount != "0.00") {
                $incomeData[$income_id]["allocations"][$allocation_id]["sub_allocations"][] = [
                    "sub_allocation_id" => $sub_allocation_id,
                    "sub_allocation_name" => $row['sub_allocation_name'],
                    "amount" => $sub_allocation_amount
                ];

                // เพิ่มค่า sub_allocation_amount เข้าไปใน total_sub_allocation_amount
                $incomeData[$income_id]["total_sub_allocation_amount"] += (float)$sub_allocation_amount;
            }
        }
    }

    // Reformat allocations to be array-based instead of associative
    foreach ($incomeData as &$income) {
        $income["allocations"] = array_values($income["allocations"]);
        $income['result'] = $income['total_amount'] - $income['total_allocation_amount'];
        // ตรวจสอบว่า total_allocation_amount ไม่เท่ากับ 0 และไม่เท่ากับ total_amount ก่อนแสดง allocations
        if ($income["total_allocation_amount"] == 0 || $income["total_allocation_amount"] == (float)$income['total_amount']) {
            // ไม่แสดงข้อมูลทั้งหมดเมื่อ total_allocation_amount == 0 หรือ total_allocation_amount == total_amount
            $income = [];  // Clear the data completely
        }
    }

    // Filter out empty incomes
    $filteredIncomeData = array_filter($incomeData, function ($income) {
        return !empty($income);
    });

    // ส่งข้อมูลที่กรองแล้วกลับไป
    $response->success(array_values($filteredIncomeData), "Data retrieved successfully", 200);
} catch (PDOException $e) {
    $response->error("An error occurred: " . $e->getMessage(), 500);
}
?>
