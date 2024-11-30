<?php
include '../condb.php'; // แทรกการเชื่อมต่อฐานข้อมูล

try {
    // รับข้อมูลจาก client
    $birth_year = $_POST['birth_year'];
    $current_age = $_POST['current_age'];
    $retirement_age = $_POST['retirement_age'];
    $life_expectancy = $_POST['life_expectancy'];
    $monthly_salary = $_POST['monthly_salary'];
    $annual_salary_increase_percentage = $_POST['annual_salary_increase_percentage'];
    $current_monthly_expenses = $_POST['current_monthly_expenses'];
    $annual_expense_increase_percentage = $_POST['annual_expense_increase_percentage'];
    $annual_bonus = $_POST['annual_bonus'];
    $monthly_pension_income = $_POST['monthly_pension_income'];
    $investment_assets = $_POST['investment_assets'];
    $annual_return_percentage = $_POST['annual_return_percentage'];
    $post_retirement_return_percentage = $_POST['post_retirement_return_percentage'];
    $user_id = $_POST['user_id'];

    // เตรียม SQL statement สำหรับการ insert
    $stmt = $conn->prepare("INSERT INTO `retirement_plan` 
    (`birth_year`, `current_age`, `retirement_age`, `life_expectancy`, `monthly_salary`, `annual_salary_increase_percentage`, `current_monthly_expenses`, `annual_expense_increase_percentage`, `annual_bonus`, `monthly_pension_income`, `investment_assets`, `annual_return_percentage`, `post_retirement_return_percentage`, `user_id`) 
    VALUES (:birth_year, :current_age, :retirement_age, :life_expectancy, :monthly_salary, :annual_salary_increase_percentage, :current_monthly_expenses, :annual_expense_increase_percentage, :annual_bonus, :monthly_pension_income, :investment_assets, :annual_return_percentage, :post_retirement_return_percentage, :user_id)");

    // ผูกค่ากับ parameter
    $stmt->bindParam(':birth_year', $birth_year);
    $stmt->bindParam(':current_age', $current_age);
    $stmt->bindParam(':retirement_age', $retirement_age);
    $stmt->bindParam(':life_expectancy', $life_expectancy);
    $stmt->bindParam(':monthly_salary', $monthly_salary);
    $stmt->bindParam(':annual_salary_increase_percentage', $annual_salary_increase_percentage);
    $stmt->bindParam(':current_monthly_expenses', $current_monthly_expenses);
    $stmt->bindParam(':annual_expense_increase_percentage', $annual_expense_increase_percentage);
    $stmt->bindParam(':annual_bonus', $annual_bonus);
    $stmt->bindParam(':monthly_pension_income', $monthly_pension_income);
    $stmt->bindParam(':investment_assets', $investment_assets);
    $stmt->bindParam(':annual_return_percentage', $annual_return_percentage);
    $stmt->bindParam(':post_retirement_return_percentage', $post_retirement_return_percentage);
    $stmt->bindParam(':user_id', $user_id);

    // Execute statement
    if ($stmt->execute()) {
        $response = array('status' => 'success', 'message' => 'Retirement plan inserted successfully');
    } else {
        $response = array('status' => 'error', 'message' => 'Failed to insert retirement plan');
    }
} catch (PDOException $e) {
    $response = array('status' => 'error', 'message' => $e->getMessage());
}

// ส่งผลลัพธ์กลับไปในรูปแบบ JSON
echo json_encode($response);
?>
