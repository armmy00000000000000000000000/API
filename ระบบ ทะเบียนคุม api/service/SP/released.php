<?php

try {
    // สร้างการเชื่อมต่อกับฐานข้อมูล
    $conn = new PDO($dbname, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // รับค่าจาก GET parameter
    $allocationName = isset($_GET['allocation_name']) ? $_GET['allocation_name'] : '';
    $station = isset($_GET['station']) ? $_GET['station'] : '';
    $startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '';
    $endDate = isset($_GET['end_date']) ? $_GET['end_date'] : '';

    // เช็คว่ามีการระบุช่วงวันที่หรือไม่
    $dateCondition = "";
    if ($startDate && $endDate) {
        $dateCondition = " AND i.income_date BETWEEN :start_date AND :end_date";
    }

    // เตรียมและรันคำสั่ง SQL สำหรับข้อมูลที่มีสถานะ 'รับ'
    $queryReceive = "
        SELECT i.income_id, i.status, i.income_date, i.document_number, i.payment_type, i.income_type_id, 
               it.income_type_code, it.income_type_name, i.note,
               i.station,
               iad.allocation_id, a.allocation_name, iad.amount as allocation_amount
        FROM income i
        LEFT JOIN income_type it ON i.income_type_id = it.income_type_id
        LEFT JOIN income_allocation_data iad ON i.income_id = iad.income_id AND iad.amount != '0.00'  -- กรองข้อมูลที่มีจำนวนไม่เท่ากับ 0.00 ที่นี่
        LEFT JOIN income_allocation a ON iad.allocation_id = a.allocation_id
        LEFT JOIN sub_allocation sa ON iad.sub_allocation_id = sa.sub_allocation_id
        WHERE a.allocation_name = :allocation_name AND i.status = 'รับ'
        AND i.station = :station
        $dateCondition
        ORDER BY i.income_date ASC;
    ";

    $stmtReceive = $conn->prepare($queryReceive);
    $stmtReceive->bindParam(':allocation_name', $allocationName);
    $stmtReceive->bindParam(':station', $station);

    if ($startDate && $endDate) {
        $stmtReceive->bindParam(':start_date', $startDate);
        $stmtReceive->bindParam(':end_date', $endDate);
    }

    $stmtReceive->execute();
    $receiveData = $stmtReceive->fetchAll(PDO::FETCH_ASSOC);

    // เตรียมและรันคำสั่ง SQL สำหรับข้อมูลที่มีสถานะ 'นำส่ง'
    $querySend = "
SELECT i.income_id, i.status, i.income_date, i.document_number, i.payment_type, i.income_type_id, 
       t.income_type_name, t.income_type_code,i.note, i.station
FROM income i
LEFT JOIN income_type t ON i.income_type_id = t.income_type_id
WHERE i.status = 'นำส่ง' AND i.station = :station
        AND i.income_date BETWEEN :start_date AND :end_date
        ORDER BY i.income_date ASC;
    ";

    $stmtSend = $conn->prepare($querySend);

    if ($startDate && $endDate) {
        $stmtSend->bindParam(':start_date', $startDate);
        $stmtSend->bindParam(':end_date', $endDate);
        $stmtSend->bindParam(':station', $station);
    }

    $stmtSend->execute();
    $sendData = $stmtSend->fetchAll(PDO::FETCH_ASSOC);

    // ตรวจสอบข้อมูลในตาราง deliver สำหรับแต่ละ income_id ที่ได้จากสถานะ 'นำส่ง'
    foreach ($sendData as &$income) {
        $incomeId = $income['income_id'];

        // คำสั่ง SQL เพื่อดึงข้อมูลจาก deliver โดยใช้ income_id และ allocation_name เป็น 'รายได้แผ่นดิน'
        $deliverQuery = "
            SELECT d.*, it.income_type_code, it.income_type_name
            FROM deliver d
            LEFT JOIN income_type it ON d.income_type_id = it.income_type_id
            WHERE d.allocation_name = :allocation_name AND d.income_id = :income_id;
        ";

        $deliverStmt = $conn->prepare($deliverQuery);
        $deliverStmt->bindParam(':income_id', $incomeId);
        $deliverStmt->bindParam(':allocation_name', $allocationName);
        $deliverStmt->execute();
        $income['deliver_data'] = $deliverStmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // รวมข้อมูลทั้งสองสถานะใน response
    $data = [
        'receive' => $receiveData,
        'send' => $sendData
    ];

    // ตรวจสอบว่ามีข้อมูลหรือไม่
    if ($receiveData || $sendData) {
        $response->success($data, "ดึงข้อมูลสำเร็จ", 200);
    } else {
        $response->error("ไม่พบข้อมูล", 404);
    }

} catch (PDOException $e) {
    $response->error("เชื่อมต่อฐานข้อมูลล้มเหลว: " . $e->getMessage(), 500);
}
?>
