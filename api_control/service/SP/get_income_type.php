<?php


// try {
//     $income_types = [];
//     $incomeTypeQuery = "
//         SELECT it.income_type_id, it.income_type_code, it.income_type_name,
//                ia.allocation_id, ia.allocation_name,
//                sa.sub_allocation_id, sa.sub_allocation_name, sa.station
//         FROM income_type it
//         LEFT JOIN income_allocation ia ON it.income_type_id = ia.income_type_id
//         LEFT JOIN sub_allocation sa ON ia.allocation_id = sa.allocation_id";

//     $result = $conn->query($incomeTypeQuery);

//     while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
//         $income_type_id = $row['income_type_id'];

//         if (!isset($income_types[$income_type_id])) {
//             $income_types[$income_type_id] = [
//                 "income_type_id" => $income_type_id,
//                 "income_type_code" => $row['income_type_code'],
//                 "income_type_name" => $row['income_type_name'],
//                 "allocations" => []
//             ];
//         }

//         $allocation_id = $row['allocation_id'];

//         if (!isset($income_types[$income_type_id]["allocations"][$allocation_id])) {
//             $income_types[$income_type_id]["allocations"][$allocation_id] = [
//                 "allocation_id" => $allocation_id,
//                 "allocation_name" => $row['allocation_name'],
//                 "sub_allocations" => []
//             ];
//         }

//         if ($row['sub_allocation_id']) {
//             $income_types[$income_type_id]["allocations"][$allocation_id]["sub_allocations"][] = [
//                 "station" => $row['station'],
//                 "sub_allocation_id" => $row['sub_allocation_id'],
//                 "sub_allocation_name" => $row['sub_allocation_name']
//             ];
//         }
//     }

//     $response->success(array_values($income_types), "Data retrieved successfully", 200);
// } catch (PDOException $e) {
//     $response->error("An error occurred: " . $e->getMessage(), 500);
// }
?>
<?php

try {
    // รับค่า station จาก request (GET หรือ POST)
    $station = $_GET['station'] ?? null;

    $income_types = [];
    $incomeTypeQuery = "
        SELECT it.income_type_id, it.income_type_code, it.income_type_name,
               ia.allocation_id, ia.allocation_name,
               sa.sub_allocation_id, sa.sub_allocation_name, sa.station
        FROM income_type it
        LEFT JOIN income_allocation ia ON it.income_type_id = ia.income_type_id
        LEFT JOIN sub_allocation sa ON ia.allocation_id = sa.allocation_id";

    $stmt = $conn->prepare($incomeTypeQuery);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $income_type_id = $row['income_type_id'];

        // ตรวจสอบว่า income_type มีอยู่หรือยัง ถ้าไม่มีให้เพิ่ม
        if (!isset($income_types[$income_type_id])) {
            $income_types[$income_type_id] = [
                "income_type_id" => $income_type_id,
                "income_type_code" => $row['income_type_code'],
                "income_type_name" => $row['income_type_name'],
                "allocations" => [] // เปลี่ยนเป็น array ธรรมดา
            ];
        }

        $allocation_id = $row['allocation_id'];

        // ค้นหา allocation ในรูปแบบ array
        $existingAllocationKey = null;
        foreach ($income_types[$income_type_id]["allocations"] as $key => $allocation) {
            if ($allocation["allocation_id"] == $allocation_id) {
                $existingAllocationKey = $key;
                break;
            }
        }

        // ถ้า allocation ยังไม่ถูกเพิ่ม ให้สร้างข้อมูลใหม่
        if ($existingAllocationKey === null) {
            $income_types[$income_type_id]["allocations"][] = [
                "allocation_id" => $allocation_id,
                "allocation_name" => $row['allocation_name'],
                "sub_allocations" => []
            ];
            $existingAllocationKey = array_key_last($income_types[$income_type_id]["allocations"]);
        }

        // กรอง sub_allocations ตาม station ที่ระบุ
        if ($station === null || $row['station'] == $station) {
            $income_types[$income_type_id]["allocations"][$existingAllocationKey]["sub_allocations"][] = [
                "station" => $row['station'],
                "sub_allocation_id" => $row['sub_allocation_id'],
                "sub_allocation_name" => $row['sub_allocation_name']
            ];
        }
    }

    $response->success(array_values($income_types), "Data retrieved successfully", 200);
} catch (PDOException $e) {
    $response->error("An error occurred: " . $e->getMessage(), 500);
}
?>

