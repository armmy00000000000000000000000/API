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
	case "add_product":
		include("store/add_product.php");
	break;
	case "add_sizeproduct":
		include("store/add_sizeproduct.php");
	break;
	case "list_product":
		include("store/list_product.php");
	break;
	case "update_store":
		include("store/update_store.php");
	break;
	case "payment_store":
		include("store/payment_store.php");
	break;
	case "login_store":
		include("store/login_store.php");
	break;
	case "list_order":
		include("store/list_order.php");
	break;
	case "details_order":
		include("store/details_order.php");
	break;
	case "img_preview_product":
		include("store/img_preview_product.php");
	break;
	case "list_payment":
		include("store/list_payment.php");
	break;
	case "list_size":
		include("store/list_size.php");
	break;
	case "product_preview":
		include("store/list_img_preview.php");
	break;

	default:
		echo "Api service Project connext";
		break;

}
?>