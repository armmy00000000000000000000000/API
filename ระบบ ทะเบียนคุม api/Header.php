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

// หาก Token ยังไม่หมดอายุ

// echo json_encode([
//     "status" => "success",
//     "message" => "Token is valid.",
//     "expiration_date" => $apiKeyData['expiration_date']
// ]);
