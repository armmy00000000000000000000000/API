<?php
require_once "../response.php";
require_once "../condb.php";
// เพิ่ม Header CORS
ini_set('upload_max_filesize', '16M'); // เพิ่มขนาดไฟล์ที่อนุญาต
ini_set('post_max_size', '16M'); // เพิ่มขนาดโพสต์
header("Access-Control-Allow-Origin: *"); // อนุญาตให้ทุกโดเมนเข้าถึง
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow_METHODS: POST, GET, OPTIONS");
$response = new Response();
switch ($_GET["service"]) {
	case "login":
		include("login/login.php");
	break;

	default:
		echo "Api service Project connext";
		break;

}
?>