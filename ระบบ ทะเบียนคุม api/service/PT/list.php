<?php
// สร้างคลาส Response เพื่อจัดการการตอบกลับ


try {
    // สร้างการเชื่อมต่อกับฐานข้อมูล
    $conn = new PDO($dbname, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ดึงข้อมูลจากตาราง police_station
    $stmtPolice = $conn->prepare("SELECT * FROM `police_station`");
    $stmtPolice->execute();
    $policeData = $stmtPolice->fetchAll(PDO::FETCH_ASSOC);

    // ดึงข้อมูลจากตาราง allocation_name
    $stmtAllocation = $conn->prepare("SELECT * FROM `allocation_name`");
    $stmtAllocation->execute();
    $allocationData = $stmtAllocation->fetchAll(PDO::FETCH_ASSOC);

    // ดึงข้อมูลจากตาราง allocation_name
    $stmtincome_allocation = $conn->prepare("SELECT * FROM `income_allocation`");
    $stmtincome_allocation->execute();
    $income_allocationData = $stmtincome_allocation->fetchAll(PDO::FETCH_ASSOC);

    // ดึงข้อมูลจากตาราง income_type
    $stmtIncome = $conn->prepare("SELECT * FROM `income_type`");
    $stmtIncome->execute();
    $incomeData = $stmtIncome->fetchAll(PDO::FETCH_ASSOC);

    // รวมผลลัพธ์ในโครงสร้างแยกตามคีย์
    $result = array(
        'police_station' => $policeData,
        'income_allocation' => $income_allocationData,
        'income_type' => $incomeData,
        'allocation_name' => $allocationData
    );

    // ส่งผลลัพธ์กลับในรูปแบบ JSON
    $response->success($result, "Data retrieved successfully", 200);

} catch (PDOException $e) {
    $response->error("Database connection failed: " . $e->getMessage(), 500);
}
?>
