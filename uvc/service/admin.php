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
	case "admin_login":
		include("admin/admin_login.php");
	break;
	case "store_data":
		include("admin/store_data.php");
	break;
	case "addusers_store":
		include("admin/addusers_store.php");
	break;
	case "list_store":
		include("admin/list_store.php");
	break;
	case "option_store":
		include("admin/option_store.php");
	break;
	case "store_Member_list":
		include("admin/store_Member_list.php");
	break;
	case "option_store_mwmber":
		include("admin/option_store_mwmber.php");
	break;
	case "add_product_category":
		include("admin/add_product_category.php");
	break;
	case "list_order":
		include("admin/list_order.php");
	break;
	case "product_category":
		include("admin/product_category.php");
	break;
	default:
		echo "Api service Project connext";
		break;

}
?>