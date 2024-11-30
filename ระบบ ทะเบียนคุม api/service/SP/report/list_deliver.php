<?php 

// รับค่า station, start_date, end_date จาก $data
$station = isset($data['station']) ? $data['station'] : '';
$startDate = isset($data['start_date']) ? $data['start_date'] : '';
$endDate = isset($data['end_date']) ? $data['end_date'] : '';



try {


    // ตรวจสอบเงื่อนไขการกรองตามวันที่
    if (!empty($startDate) && !empty($endDate)) {
        $sql = "SELECT * FROM `income` 
                WHERE `status` = 'นำส่ง' AND `station` = :station 
                AND `income_date` BETWEEN :start_date AND :end_date 
                ORDER BY `income_id` DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':station', $station, PDO::PARAM_INT);
        $stmt->bindParam(':start_date', $startDate, PDO::PARAM_STR);
        $stmt->bindParam(':end_date', $endDate, PDO::PARAM_STR);
    } else {
        $sql = "SELECT * FROM `income` 
                WHERE `status` = 'นำส่ง' AND `station` = :station 
                ORDER BY `income_id` DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':station', $station, PDO::PARAM_INT);
    }

    // รันคำสั่ง SQL
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if($result){
        $response->success($result, "ดึงข้อมูลสำเร็จ", 200);
  }else{
    $response->error( "ไม่มีข้อมูล", 200);
  }
    // ส่งผลลัพธ์กลับ


} catch (Exception $e) {
    // กรณีเกิดข้อผิดพลาด
    $response->error("เกิดข้อผิดพลาด: " . $e->getMessage(), 500);
}



// SELECT 
//     d.allocation_name,
//     CASE 
//         WHEN d.allocation_name = 'เงินกองทุนฯ' AND i.income_type_code IN (804, 805) THEN CONCAT(d.allocation_name, ' (', i.income_type_code, ')')
//         WHEN d.allocation_name = 'รายได้แผ่นดิน' THEN CONCAT( i.income_type_name)
//         ELSE d.allocation_name
//     END AS grouped_allocation_name,
//     SUM(d.amount) AS total_amount
// FROM `deliver` d
// LEFT JOIN `income_type` i ON d.income_type_id = i.income_type_id
// GROUP BY 
//     grouped_allocation_name;

?>
