<?php
// include '../condb.php'; // แทรกการเชื่อมต่อฐานข้อมูล

// try {
//     $user_id = 1; // ไอดีของผู้ใช้
//     $year = 2024; // ปีที่ต้องการดูข้อมูล

//     // Query for assets
//     $stmt_assets = $conn->prepare("SELECT * FROM `assets` WHERE `user_id` = :user_id AND YEAR(`created_at`) = :year");
//     $stmt_assets->bindParam(':user_id', $user_id);
//     $stmt_assets->bindParam(':year', $year);
//     $stmt_assets->execute();
//     $assets = $stmt_assets->fetchAll(PDO::FETCH_ASSOC);

//     // Query for debts
//     $stmt_debts = $conn->prepare("SELECT * FROM `debts` WHERE `user_id` = :user_id AND YEAR(`created_at`) = :year");
//     $stmt_debts->bindParam(':user_id', $user_id);
//     $stmt_debts->bindParam(':year', $year);
//     $stmt_debts->execute();
//     $debts = $stmt_debts->fetchAll(PDO::FETCH_ASSOC);

//     // Query for incomes
//     $stmt_incomes = $conn->prepare("SELECT * FROM `incomes` WHERE `user_id` = :user_id AND YEAR(`created_at`) = :year");
//     $stmt_incomes->bindParam(':user_id', $user_id);
//     $stmt_incomes->bindParam(':year', $year);
//     $stmt_incomes->execute();
//     $incomes = $stmt_incomes->fetchAll(PDO::FETCH_ASSOC);

//     // Query for expenses
//     $stmt_expenses = $conn->prepare("SELECT * FROM `expenses` WHERE `user_id` = :user_id AND YEAR(`created_at`) = :year");
//     $stmt_expenses->bindParam(':user_id', $user_id);
//     $stmt_expenses->bindParam(':year', $year);
//     $stmt_expenses->execute();
//     $expenses = $stmt_expenses->fetchAll(PDO::FETCH_ASSOC);

//     // คำนวณข้อมูลทางการเงิน
//     $total_assets = array_sum(array_column($assets, 'asset_value'));
//     $total_debts = array_sum(array_column($debts, 'debt_amount'));
//     $total_incomes = array_sum(array_column($incomes, 'incomes_peryear'));
//     $total_expenses = array_sum(array_column($expenses, 'expenses_peryear'));

//     $net_worth = $total_assets - $total_debts;
//     $net_cash_flow = $total_incomes - $total_expenses;

//     // คำนวณอัตราส่วนทางการเงิน
//     // $asset_ratio = $total_assets / ($total_assets + $total_debts);
//     // $debt_ratio = $total_debts / ($total_assets + $total_debts);
//     // $income_ratio = $total_incomes / ($total_incomes + $total_expenses);
//     // $expense_ratio = $total_expenses / ($total_incomes + $total_expenses);
//     // $liquidity_ratio = $total_incomes / $total_expenses;
//     // $debt_to_asset_ratio = $total_debts / $total_assets;
//     // $debt_to_income_ratio = $total_debts / $total_incomes;
//     // $savings_ratio = ($total_incomes - $total_expenses) / $total_incomes;
//     // $investment_ratio = ($total_assets - $total_debts) / $total_assets;

// $asset_ratio = ($total_assets / ($total_assets + $total_debts)) * 100;
// $debt_ratio = ($total_debts / ($total_assets + $total_debts)) * 100;
// $income_ratio = ($total_incomes / ($total_incomes + $total_expenses)) * 100;
// $expense_ratio = ($total_expenses / ($total_incomes + $total_expenses)) * 100;
// $liquidity_ratio = ($total_incomes / $total_expenses) * 100;
// $debt_to_asset_ratio = ($total_debts / $total_assets) * 100;
// $debt_to_income_ratio = ($total_debts / $total_incomes) * 100;
// $savings_ratio = (($total_incomes - $total_expenses) / $total_incomes) * 100;
// $investment_ratio = (($total_assets - $total_debts) / $total_assets) * 100;

//     // สร้าง response รวม
//     $response = array(
//         'status' => 'success',
//         'data' => array(
//             'net_worth' => $net_worth,
//             'net_cash_flow' => $net_cash_flow,
//             'total_incomes' => $total_incomes ,
//             'total_expenses' => $total_expenses,
//             'total_assets ' => $total_assets ,
//             'total_debts' => $total_debts,
//             'ratios' => array(
//                 'asset_ratio' => $asset_ratio,
//                 'debt_ratio' => $debt_ratio,
//                 'income_ratio' => $income_ratio,
//                 'expense_ratio' => $expense_ratio,
//                 'liquidity_ratio' => $liquidity_ratio,
//                 'debt_to_asset_ratio' => $debt_to_asset_ratio,
//                 'debt_to_income_ratio' => $debt_to_income_ratio,
//                 'savings_ratio' => $savings_ratio,
//                 'investment_ratio' => $investment_ratio
//             ),
//             'assets' => $assets,
//             'debts' => $debts,
//             'incomes' => $incomes,
//             'expenses' => $expenses
//         )
//     );
// } catch (PDOException $e) {
//     $response = array('status' => 'error', 'message' => $e->getMessage());
// }

// // ส่งผลลัพธ์กลับไปในรูปแบบ JSON
// echo json_encode($response);
?>
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

    // คำนวณข้อมูลทางการเงิน
    $total_assets = array_sum(array_column($assets, 'asset_value'));
    $total_debts = array_sum(array_column($debts, 'debt_amount'));
    $total_incomes = array_sum(array_column($incomes, 'incomes_peryear'));
    $total_expenses = array_sum(array_column($expenses, 'expenses_peryear'));

    $net_worth = $total_assets - $total_debts;
    $net_cash_flow = $total_incomes - $total_expenses;

    // คำนวณอัตราส่วนทางการเงิน
    $asset_ratio = ($total_assets / ($total_assets + $total_debts)) * 100;
    $debt_ratio = ($total_debts / ($total_assets + $total_debts)) * 100;
    $income_ratio = ($total_incomes / ($total_incomes + $total_expenses)) * 100;
    $expense_ratio = ($total_expenses / ($total_incomes + $total_expenses)) * 100;
    $liquidity_ratio = ($total_incomes / $total_expenses) * 100;
    $debt_to_asset_ratio = ($total_debts / $total_assets) * 100;
    $debt_to_income_ratio = ($total_debts / $total_incomes) * 100;
    $savings_ratio = (($total_incomes - $total_expenses) / $total_incomes) * 100;
    $investment_ratio = (($total_assets - $total_debts) / $total_assets) * 100;

    // จัดกลุ่มข้อมูลสินทรัพย์ตามประเภท
    $grouped_assets = [];
    foreach ($assets as $asset) {
        switch ($asset['asset_type']) {
            case 1:
                $grouped_assets['สินทรัพย์สภาพคล่อง'][] = $asset;
                break;
            case 2:
                $grouped_assets['สินทรัพย์เพื่อการลงทุน'][] = $asset;
                break;
            case 3:
                $grouped_assets['สินทรัพย์ใช้ส่วนตัว'][] = $asset;
                break;
            case 4:
                $grouped_assets['สินทรัพย์ที่ไม่มีตัวตน'][] = $asset;
                break;
        }
    }

    // จัดกลุ่มข้อมูลหนี้สินตามประเภท
    $grouped_debts = [];
    foreach ($debts as $debt) {
        switch ($debt['debt_type']) {
            case 1:
                $grouped_debts['หนี้สินระยะสั้น'][] = $debt;
                break;
            case 2:
                $grouped_debts['หนี้สินระยะยาว'][] = $debt;
                break;
        }
    }

    // จัดกลุ่มข้อมูลรายรับตามประเภท
    $grouped_incomes = [];
    foreach ($incomes as $income) {
        if ($income['incomes_type'] == 1) {
            $grouped_incomes['รายรับ'][] = $income;
        }
    }

    // จัดกลุ่มข้อมูลค่าใช้จ่ายตามประเภท
    $grouped_expenses = [];
    foreach ($expenses as $expense) {
        switch ($expense['expenses_type']) {
            case 1:
                $grouped_expenses['ค่าใช้จ่ายคงที่'][] = $expense;
                break;
            case 2:
                $grouped_expenses['ค่าใช้จ่ายผันแปร'][] = $expense;
                break;
            case 3:
                $grouped_expenses['ค่าใช้จ่ายออม/ลงทุน'][] = $expense;
                break;
        }
    }

    // สร้าง response รวม
    $response = array(
        'status' => 'success',
        'data' => array(
            'net_worth' => $net_worth,
            'net_cash_flow' => $net_cash_flow,
            'total_incomes' => $total_incomes,
            'total_expenses' => $total_expenses,
            'total_assets' => $total_assets,
            'total_debts' => $total_debts,
            'ratios' => array(
                'asset_ratio' => $asset_ratio,
                'debt_ratio' => $debt_ratio,
                'income_ratio' => $income_ratio,
                'expense_ratio' => $expense_ratio,
                'liquidity_ratio' => $liquidity_ratio,
                'debt_to_asset_ratio' => $debt_to_asset_ratio,
                'debt_to_income_ratio' => $debt_to_income_ratio,
                'savings_ratio' => $savings_ratio,
                'investment_ratio' => $investment_ratio
            ),
            'assets' => $assets,
            'debts' => $debts,
            'incomes' => $incomes,
            'expenses' => $expenses,
            'grouped_assets' => $grouped_assets,
            'grouped_debts' => $grouped_debts,
            'grouped_incomes' => $grouped_incomes,
            'grouped_expenses' => $grouped_expenses
        )
    );
} catch (PDOException $e) {
    $response = array('status' => 'error', 'message' => $e->getMessage());
}

// ส่งผลลัพธ์กลับไปในรูปแบบ JSON
echo json_encode($response);
?>
