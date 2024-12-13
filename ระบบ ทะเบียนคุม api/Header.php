<?php 

// require_once "response.php";
// require_once "condb.php";

// // เพิ่ม Header CORS
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Headers: Content-Type, Authorization");
// header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

// $data = json_decode(file_get_contents("php://input"), true);
// // จัดการกับ preflight request
// if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
//     http_response_code(200);
//     exit();
// }

// $headers = getallheaders();
// if (!isset($headers['Authorization'])) {
//     http_response_code(401);
//     echo json_encode(["status" => "error", "message" => "Authorization header is missing."]);
//     exit();
// }


// $authHeader = $headers['Authorization'];
// if (strpos($authHeader, 'Bearer ') !== 0) {
//     http_response_code(401);
//     echo json_encode(["status" => "error", "message" => "Invalid Authorization format."]);
//     exit();
// }

// $api_key = substr($authHeader, 7); 
// $query = $conn->prepare("SELECT * FROM api_keys WHERE `key` = :key AND status = 'active'");
// $query->bindParam(':key', $api_key);
// $query->execute();

// if ($query->rowCount() === 0) {
//     http_response_code(401);
//     echo json_encode(["status" => "error", "message" => "Invalid or inactive API key."]);
//     exit();
// }

// $response = new Response();


?>


<?php 

require_once "response.php";
require_once "condb.php";

// เพิ่ม Header CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
date_default_timezone_set('Asia/Bangkok');
$data = json_decode(file_get_contents("php://input"), true);
$response = new Response();
// จัดการกับ preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// ดึง Header Authorization
$headers = getallheaders();
if (!isset($headers['Authorization'])) {
    http_response_code(401);
    echo json_encode(["status" => "error", "message" => "Authorization header is missing."]);
    exit();
}

$authHeader = $headers['Authorization'];
if (strpos($authHeader, 'Bearer ') !== 0) {
    http_response_code(401);
    echo json_encode(["status" => "error", "message" => "Invalid Authorization format."]);
    exit();
}

// ดึง API key จาก Authorization Header
$api_key = substr($authHeader, 7);

// ค้นหา API key ในฐานข้อมูล
$query = $conn->prepare("
    SELECT * 
    FROM api_keys 
    WHERE `key` = :key AND `status` = 'active'
");
$query->bindParam(':key', $api_key);
$query->execute();

$apiKeyData = $query->fetch(PDO::FETCH_ASSOC);

if (!$apiKeyData) {
    http_response_code(401);
    echo json_encode(["status" => "expired", "message" => "Token has expired."]);
    exit();
} 

// ตรวจสอบว่า Token หมดอายุหรือยัง
$currentDate = date('Y-m-d H:i:s');
if ($currentDate > $apiKeyData['expiration_date']) {
    // อัปเดตสถานะของ Token เป็น expired
    $updateStatus = $conn->prepare("
        UPDATE api_keys 
        SET `status` = 'expired' 
        WHERE `key` = :key
    ");
    $updateStatus->bindParam(':key', $api_key);
    $updateStatus->execute();

    http_response_code(401);
    echo json_encode(["status" => "expired", "message" => "Token has expired."]);
    exit();
}








// require_once "response.php";
// require_once "condb.php";

// // เพิ่ม Header CORS
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Headers: Content-Type, Authorization");
// header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
// date_default_timezone_set('Asia/Bangkok');
// $data = json_decode(file_get_contents("php://input"), true);
// $response = new Response();

// // จัดการกับ preflight request
// if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
//     http_response_code(200);
//     exit();
// }

// // ดึง Header Authorization
// $headers = getallheaders();
// if (!isset($headers['Authorization'])) {
//     http_response_code(401);
//     echo json_encode(["status" => "error", "message" => "Authorization header is missing."]);
//     exit();
// }

// $authHeader = $headers['Authorization'];
// if (strpos($authHeader, 'Bearer ') !== 0) {
//     http_response_code(401);
//     echo json_encode(["status" => "error", "message" => "Invalid Authorization format."]);
//     exit();
// }

// // ดึง API key จาก Authorization Header
// $api_key = substr($authHeader, 7);

// // ค้นหา API key ในฐานข้อมูล
// $query = $conn->prepare("
//     SELECT * 
//     FROM api_keys 
//     WHERE `key` = :key AND `status` = 'active'
// ");
// $query->bindParam(':key', $api_key);
// $query->execute();

// $apiKeyData = $query->fetch(PDO::FETCH_ASSOC);

// if (!$apiKeyData) {
//     http_response_code(401);
//     echo json_encode(["status" => "expired", "message" => "Token has expired."]);
//     exit();
// }

// // ตรวจสอบว่า Token หมดอายุหรือยัง
// $currentDate = date('Y-m-d H:i:s');
// if ($currentDate > $apiKeyData['expiration_date']) {
//     // อัปเดตสถานะของ Token เป็น expired
//     $updateStatus = $conn->prepare("
//         UPDATE api_keys 
//         SET `status` = 'expired' 
//         WHERE `key` = :key
//     ");
//     $updateStatus->bindParam(':key', $api_key);
//     $updateStatus->execute();

//     http_response_code(401);
//     echo json_encode(["status" => "expired", "message" => "Token has expired."]);
//     exit();
// }

// // ตรวจสอบสิทธิ์การเข้าถึง API เส้นทางที่ร้องขอ
// $service = $_GET['service'] ?? null;
// if (!$service) {
//     http_response_code(400);
//     echo json_encode(["status" => "error", "message" => "Service parameter is missing."]);
//     exit();
// }

// $role = $apiKeyData['role']; // admin หรือ users
// $permissions = json_decode($apiKeyData['permissions'], true); // สิทธิ์เฉพาะของ API Key นี้

// if ($role === 'admin') {
//     // admin เข้าถึงได้ทุก API
// } elseif ($role === 'users' && !in_array($service, $permissions)) {
//     http_response_code(403);
//     echo json_encode(["status" => "error", "message" => "Access denied for the requested service."]);
//     exit();
// }

// // หาก Token และสิทธิ์ถูกต้อง
// includeService($service);

// function includeService($service) {
//     switch ($service) {
//         case "list_income":
//             include("SP/list_income.php");
//             break;
//         case "get_income_type":
//             include("SP/get_income_type.php");
//             break;
//         case "add_income":
//             include("SP/add_income.php");
//             break;
//         case "recheck_income":
//             include("SP/recheck_income.php");
//             break;
//         case "list_report":
//             include("SP/list_report.php");
//             break;
//         case "diffupdate_income":
//             include("SP/update_difference_income.php");
//             break;
//         case "submit_the_report":
//             include("SP/submit_the_report.php");
//             break;
//         case "released":
//             include("SP/released.php");
//             break;
//         case "list_deliver":
//             include("SP/report/list_deliver.php");
//             break;
//         case "export_deliver":
//             include("SP/report/export_deliver.php");
//             break;
//         case "test":
//             include("SP/report/test.php");
//             break;
//         case "del_income":
//             include("SP/del_income.php");
//             break;
//         default:
//             echo "Api service Project connext";
//             break;
//     }
// }

////// database 
// CREATE TABLE api_keys (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     `key` VARCHAR(255) NOT NULL,
//     role ENUM('admin', 'users') NOT NULL,
//     permissions JSON NOT NULL,
//     expiration_date DATETIME NOT NULL,
//     status ENUM('active', 'expired') NOT NULL DEFAULT 'active'
// );

// INSERT INTO api_keys (`key`, role, permissions, expiration_date, status)
// VALUES
// ('admin_key_123', 'admin', '[]', '2025-12-31 23:59:59', 'active'),
// ('user_key_456', 'users', '["list_income", "get_income_type", "add_income"]', '2025-12-31 23:59:59', 'active');
