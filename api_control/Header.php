<?php 

require_once "response.php";
require_once "condb.php";

// เพิ่ม Header CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

// จัดการกับ preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$headers = getallheaders();
if (!isset($headers['Authorization'])) {
    http_response_code(401);
    echo json_encode(["status" => "error", "message" => "Authorization header is missing."]);
    exit();
}

// แยกค่า API key จาก Header 'Authorization: Bearer <API_KEY>'
$authHeader = $headers['Authorization'];
if (strpos($authHeader, 'Bearer ') !== 0) {
    http_response_code(401);
    echo json_encode(["status" => "error", "message" => "Invalid Authorization format."]);
    exit();
}

$api_key = substr($authHeader, 7); 
$query = $conn->prepare("SELECT * FROM api_keys WHERE `key` = :key AND status = 'active'");
$query->bindParam(':key', $api_key);
$query->execute();

if ($query->rowCount() === 0) {
    http_response_code(401);
    echo json_encode(["status" => "error", "message" => "Invalid or inactive API key."]);
    exit();
}

$response = new Response();


?>