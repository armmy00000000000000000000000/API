<?php
// สร้างคลาส Response เพื่อจัดการการตอบกลับ (อาจจะต้องสร้างคลาส Response ก่อนใช้งาน)

// try {
//     // สร้างการเชื่อมต่อกับฐานข้อมูล
//     $conn = new PDO($dbname, $username, $password);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     // รับค่าจาก GET parameter
//     $allocationName = isset($_GET['allocation_name']) ? $_GET['allocation_name'] : '';
//     $station = isset($_GET['station']) ? $_GET['station'] : '';

//     // เตรียมและรันคำสั่ง SQL ที่กำหนด
//     $query = "
//         SELECT i.income_id, i.status, i.income_date, i.document_number, i.payment_type, i.income_type_id, 
//                it.income_type_code, it.income_type_name, 
//               i.station,
//                iad.allocation_id, a.allocation_name, iad.amount as allocation_amount
//         FROM income i
//         LEFT JOIN income_type it ON i.income_type_id = it.income_type_id
//         LEFT JOIN income_allocation_data iad ON i.income_id = iad.income_id
//         LEFT JOIN income_allocation a ON iad.allocation_id = a.allocation_id
//         LEFT JOIN sub_allocation sa ON iad.sub_allocation_id = sa.sub_allocation_id
//         WHERE a.allocation_name = :allocation_name AND i.station = :station
//         ORDER BY i.income_date DESC;
//     ";

//     $stmt = $conn->prepare($query);
//     $stmt->bindParam(':allocation_name', $allocationName);
//     $stmt->bindParam(':station', $station);
//     $stmt->execute();
//     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

//     // ตรวจสอบว่ามีข้อมูลหรือไม่
//     if ($result) {
//         $response->success($result, "Data retrieved successfully", 200); // คำสั่งนี้ต้องการการกำหนด response object
//     } else {
//         $response->error("No data found", 404);
//     }

// } catch (PDOException $e) {
//     $response->error("Database connection failed: " . $e->getMessage(), 500);
// }
?>


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
        // ถ้ามีการระบุช่วงวันที่
        $dateCondition = " AND i.income_date BETWEEN :start_date AND :end_date";
    }

    // เตรียมและรันคำสั่ง SQL ที่กำหนด
    $query = "
       SELECT i.income_id,i.income_type_id, it.income_type_code, it.income_type_name, i.station, a.allocation_id,i.status,i.income_date,
               a.allocation_name, SUM(iad.amount) as total_allocation_amount
        FROM income i
        LEFT JOIN income_type it ON i.income_type_id = it.income_type_id
        LEFT JOIN income_allocation_data iad ON i.income_id = iad.income_id
        LEFT JOIN income_allocation a ON iad.allocation_id = a.allocation_id
        LEFT JOIN sub_allocation sa ON iad.sub_allocation_id = sa.sub_allocation_id
        WHERE a.allocation_name = :allocation_name 
        AND i.station = :station AND i.status_type = 'Pending'
        $dateCondition
        GROUP BY i.income_type_id, a.allocation_name
        ORDER BY i.income_date DESC;

        // SELECT i.income_id, i.status, i.income_date, i.document_number, i.payment_type, i.income_type_id, 
        //        it.income_type_code, it.income_type_name, 
        //        i.station,
        //        iad.allocation_id, a.allocation_name, iad.amount as allocation_amount
        // FROM income i
        // LEFT JOIN income_type it ON i.income_type_id = it.income_type_id
        // LEFT JOIN income_allocation_data iad ON i.income_id = iad.income_id
        // LEFT JOIN income_allocation a ON iad.allocation_id = a.allocation_id
        // LEFT JOIN sub_allocation sa ON iad.sub_allocation_id = sa.sub_allocation_id
        // WHERE a.allocation_name = :allocation_name 
        // AND i.station = :station
        // $dateCondition
        // ORDER BY i.income_date DESC;
    ";

    // เตรียมคำสั่ง SQL
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':allocation_name', $allocationName);
    $stmt->bindParam(':station', $station);

    // ถ้ามีการระบุช่วงวันที่ให้ bind ค่าของ start_date และ end_date
    if ($startDate && $endDate) {
        $stmt->bindParam(':start_date', $startDate);
        $stmt->bindParam(':end_date', $endDate);
    }

    // รันคำสั่ง SQL
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // ตรวจสอบว่ามีข้อมูลหรือไม่
    if ($result) {
        $response->success($result, "Data retrieved successfully", 200); // คำสั่งนี้ต้องการการกำหนด response object
    } else {
        $response->error("No data found", 404);
    }

} catch (PDOException $e) {
    $response->error("Database connection failed: " . $e->getMessage(), 500);
}
?>
