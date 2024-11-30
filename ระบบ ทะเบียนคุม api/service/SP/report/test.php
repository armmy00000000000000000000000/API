<?php

try {
 
    // รับค่าจากพารามิเตอร์
    $station = isset($_GET['station']) ? intval($_GET['station']) : 3;

    // ตรวจสอบว่ามีพารามิเตอร์ที่ต้องการหรือไม่
    if (empty($station)) {
        $response->error("กรุณาระบุ station", 400);
        exit;
    }

    // SQL Query
    $sql = "
        SELECT 
            d.allocation_name,
            d.date_time,
            CASE 
                WHEN d.allocation_name = 'เงินกองทุนฯ' AND i.income_type_code IN (804, 805) 
                    THEN CONCAT(d.allocation_name, ' (', i.income_type_code, ')')
                ELSE d.allocation_name
            END AS grouped_allocation_name,
            SUM(d.amount) AS total_amount
        FROM `deliver` d
        LEFT JOIN `income_type` i ON d.income_type_id = i.income_type_id
        WHERE d.station = :station
          AND d.allocation_name != 'รายได้แผ่นดิน'
        GROUP BY d.allocation_name, d.date_time, grouped_allocation_name
        ORDER BY d.date_time ASC
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':station', $station, PDO::PARAM_INT);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // จัดกลุ่มข้อมูลตามเดือน
    $groupedData = [];
    foreach ($results as $row) {
        $month = date("F", strtotime($row['date_time'])); // แปลงวันที่เป็นชื่อเดือน
        if (!isset($groupedData[$month])) {
            $groupedData[$month] = [];
        }
        $groupedData[$month][] = [
            "allocation_name" => $row['allocation_name'],
            "date_time" => $row['date_time'],
            "grouped_allocation_name" => $row['grouped_allocation_name'],
            "total_amount" => $row['total_amount']
        ];
    }

    // ส่งผลลัพธ์กลับในรูปแบบ JSON
    $response->success($groupedData, "ดึงข้อมูลสำเร็จ", 200);
} catch (Exception $e) {
    // กรณีเกิดข้อผิดพลาด
    $response->error($e->getMessage(), 500);
}
?>
