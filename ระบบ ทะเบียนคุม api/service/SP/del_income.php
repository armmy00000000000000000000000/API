<?php



// ตรวจสอบคำขอ
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

   
    $income_id = isset($data['income_id']) ? $data['income_id'] : null;
echo $income_id;
    if (!$income_id) {
        $response->error("กรุณาระบุ income_id", 400);
        exit();
    }

    try {
        // เริ่มต้น Transaction
        $conn->beginTransaction();

        // ลบข้อมูลจากตาราง income_allocation_data
        $stmt1 = $conn->prepare("DELETE FROM `income_allocation_data` WHERE `income_id` = :income_id");
        $stmt1->bindParam(':income_id', $income_id, PDO::PARAM_INT);
        $stmt1->execute();

        // ลบข้อมูลจากตาราง income
        $stmt2 = $conn->prepare("DELETE FROM `income` WHERE `income_id` = :income_id");
        $stmt2->bindParam(':income_id', $income_id, PDO::PARAM_INT);
        $stmt2->execute();

        // Commit Transaction
        $conn->commit();

        $response->success([], "ลบข้อมูลสำเร็จ", 200);
    } catch (PDOException $e) {
        // ยกเลิก Transaction หากเกิดข้อผิดพลาด
        $conn->rollBack();
        $response->error("ข้อผิดพลาด: " . $e->getMessage(), 500);
    }
} else {
    $response = new Response();
    $response->error("การร้องขอไม่ถูกต้อง", 405);
}
