<?php

try {
    // รับค่าจากพารามิเตอร์
    $incomeId = isset($_GET['income_id']) ? intval($_GET['income_id']) : 0;
    $station = isset($_GET['station']) ? intval($_GET['station']) : 0;
//   if(!empty($incomeId) && !empty($station)){
//     $response->error("method มีค่าว่างหรืออาจไม่ได้ส่งค้ามาใน income_id station", 400);
//     exit;
//   }
    if ($incomeId > 0) {
        $sql = "
            SELECT 
                d.allocation_name,
                CASE 
                    WHEN d.allocation_name = 'เงินกองทุนฯ' AND i.income_type_code IN (804, 805) THEN CONCAT(d.allocation_name, ' (', i.income_type_code, ')')
                    WHEN d.allocation_name = 'รายได้แผ่นดิน'  THEN CONCAT(i.income_type_name, ' (', i.income_type_code, ')')
                    ELSE d.allocation_name
                END AS grouped_allocation_name,
                SUM(d.amount) AS total_amount
            FROM `deliver` d
            LEFT JOIN `income_type` i ON d.income_type_id = i.income_type_id
            WHERE d.income_id = :incomeId
            GROUP BY grouped_allocation_name
        ";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':incomeId', $incomeId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sql_data = "
           SELECT i.document_number,i.income_date,i.date_time,p.name,d.at_number,d.tel,d.rank,d.executive_name FROM 
`income` i 
LEFT JOIN police_station p ON i.station = p.id
LEFT JOIN data_police_station d ON i.station = d.station
WHERE `status` = 'นำส่ง' AND i.station = :station
        ";

        $stmt_data = $conn->prepare($sql_data);
        $stmt_data->bindParam(':station', $station, PDO::PARAM_INT);
        $stmt_data->execute();
        $result_data = $stmt_data->fetch(PDO::FETCH_ASSOC);

        // จัดกลุ่มข้อมูล
        $groupedData = [
            "data_h"=> $result_data,
            "รายได้แผ่นดิน" => [],
            "เงินนอกงบประมาณ" => [],
            "ดอกเบี้ยเงินกองทุนฯ" => [],
            "อื่นๆ" => []
        ];
        foreach ($result as $row) {
            if ($row['allocation_name'] === 'รายได้แผ่นดิน') {
                $groupedData["รายได้แผ่นดิน"][] = [
                    "type" => $row['grouped_allocation_name'],
                    "total_amount" => $row['total_amount']
                ];
            } elseif ($row['allocation_name'] === 'ดอกเบี้ยเงินกองทุนฯ') {
                $groupedData["ดอกเบี้ยเงินกองทุนฯ"][] = [
                    "type" => $row['grouped_allocation_name'],
                    "total_amount" => $row['total_amount']
                ];
            } elseif ($row['allocation_name'] === 'อื่นๆ') {
                $groupedData["อื่นๆ"][] = [
                    "type" => $row['grouped_allocation_name'],
                    "total_amount" => $row['total_amount']
                ];
            } else {
                $groupedData["เงินนอกงบประมาณ"][] = [
                    "type" => $row['grouped_allocation_name'],
                    "total_amount" => $row['total_amount']
                ];
            }
        }

        // ส่งผลลัพธ์กลับ
        $response->success($groupedData, "ดึงข้อมูลสำเร็จ", 200);

    } else {
        $response->error("Invalid or missing income_id", 400);
    }

} catch (Exception $e) {
    $response->error($e->getMessage(), 500);
}

?>
