<?php
include '../condb.php'; // แทรกการเชื่อมต่อฐานข้อมูล

try {
    // เตรียม SQL statement สำหรับการ select
    $stmt = $conn->prepare("SELECT * FROM `retirement_plan` WHERE `user_id` = :user_id");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    $user_id = $_POST['user_id']; // สมมุติ user_id เป็น 1
    $stmt->execute();

    // แสดงข้อมูลที่ดึงมา
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // สร้าง array สำหรับผลลัพธ์ที่กำหนด key ตามที่ต้องการ
    $response = array();
    foreach ($result as $row) {
        $response[] = array(
            'birth_year' => $row['birth_year'], // ปีเกิด
            'current_age' => $row['current_age'], // อายุปัจจุบัน
            'retirement_age' => $row['retirement_age'], // อายุเกษียณ
            'life_expectancy' => $row['life_expectancy'], // อายุขัย
            'current_salary' => $row['monthly_salary'], // เงินเดือน (ต่อเดือน) (ในพันบาท)
            'salary_increase' => $row['annual_salary_increase_percentage'], // เงินเดือนเพิ่มขึ้นต่อปี (%)
            'current_expenses' => $row['current_monthly_expenses'], // รายจ่ายปัจจุบัน (ต่อเดือน) (ในพันบาท)
            'expense_increase' => $row['annual_expense_increase_percentage'], // รายจ่ายเพิ่มขึ้นต่อปี (%)
            'annual_bonus' => $row['annual_bonus'], // โบนัสและรายได้อื่นๆต่อปี (ในพันบาท)
            'monthly_pension' => $row['monthly_pension_income'], // รายได้จากบำนาญ (ต่อเดือน) (ในบาท)
            'investment_assets' => $row['investment_assets'], // สินทรัพย์มีไว้ลงทุน (ในพันบาท)
            'annual_return' => $row['annual_return_percentage'], // ผลตอบแทนที่ทำได้ต่อปี (%)
            'retirement_return' => $row['post_retirement_return_percentage'] // ผลตอบแทนหลังเกษียณต่อปี (%)
        );
    }

    // ส่งผลลัพธ์กลับในรูปแบบ JSON
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} catch (PDOException $e) {
    echo json_encode(array('status' => 'error', 'message' => $e->getMessage()), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

$conn = null;
?>
