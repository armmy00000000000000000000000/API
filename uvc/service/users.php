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

	case "order":
		include("users/order.php");
	break;
	case "list_product":
		include("users/list_product.php");
	break;
	case "add_address":
		include("users/add_address.php");
	break;
	case "list_address":
		include("users/list_address.php");
	break;
	case "shopping_cart":
		include("users/shopping_cart.php");
	break;
	case "list_cart":
		include("users/list_cart.php");
	break;
	case "product_details":
		include("users/product_details.php");
	break;
	case "list_order":
		include("users/list_order.php");
	break;
	case "payment":
		include("users/payment.php");
	break;
	case "count":
		include("users/count.php");
	break;
	case "user_login":
		include("users/user_login.php");
	break;

	default:
		echo "Api service Project connext";
		break;

}
?>