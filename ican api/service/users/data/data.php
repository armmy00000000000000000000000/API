<?php
include '../condb.php'; // แทรกการเชื่อมต่อฐานข้อมูล

try {
    $user_id = 1; // ไอดีของผู้ใช้
    $year = 2024; // ปีที่ต้องการดูข้อมูล

    // Query for assets
    $stmt_assets = $conn->prepare("SELECT * FROM `assets` WHERE `user_id` = :user_id AND YEAR(`created_at`) = :year");
    $stmt_assets->bindParam(':user_id', $user_id);
    $stmt_assets->bindParam(':year', $year);
    $stmt_assets->execute();
    $assets = $stmt_assets->fetchAll(PDO::FETCH_ASSOC);

    // Query for debts
    $stmt_debts = $conn->prepare("SELECT * FROM `debts` WHERE `user_id` = :user_id AND YEAR(`created_at`) = :year");
    $stmt_debts->bindParam(':user_id', $user_id);
    $stmt_debts->bindParam(':year', $year);
    $stmt_debts->execute();
    $debts = $stmt_debts->fetchAll(PDO::FETCH_ASSOC);

    // Query for incomes
    $stmt_incomes = $conn->prepare("SELECT * FROM `incomes` WHERE `user_id` = :user_id AND YEAR(`created_at`) = :year");
    $stmt_incomes->bindParam(':user_id', $user_id);
    $stmt_incomes->bindParam(':year', $year);
    $stmt_incomes->execute();
    $incomes = $stmt_incomes->fetchAll(PDO::FETCH_ASSOC);

    // Query for expenses
    $stmt_expenses = $conn->prepare("SELECT * FROM `expenses` WHERE `user_id` = :user_id AND YEAR(`created_at`) = :year");
    $stmt_expenses->bindParam(':user_id', $user_id);
    $stmt_expenses->bindParam(':year', $year);
    $stmt_expenses->execute();
    $expenses = $stmt_expenses->fetchAll(PDO::FETCH_ASSOC);

    // สร้าง response รวม
    $response = array(
        'status' => 'success',
        'data' => array(
            'assets' => $assets,
            'debts' => $debts,
            'incomes' => $incomes,
            'expenses' => $expenses
        )
    );
} catch (PDOException $e) {
    $response = array('status' => 'error', 'message' => $e->getMessage());
}

// ส่งผลลัพธ์กลับไปในรูปแบบ JSON
echo json_encode($response);
?>
