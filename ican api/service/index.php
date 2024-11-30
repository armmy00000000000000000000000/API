
<?php
require_once "../response.php";
require_once "../condb.php";
$response = new Response();
switch ($_GET["service"]) {
	case "register":
	include ("register.php");
		break;
	case "login":
		include("login.php" );
		break;
	case "addAsset":
		include("admin/asset/addAsset.php" );
		break;
	case "deleteAsset":
		include("admin/asset/deleteAsset.php" );
		break;
	case "ShowAsset":
		include("admin/asset/ShowAsset.php" );
		break;
	case "editAsset":
		include("admin/asset/editAsset.php" );
		break;
	case "addLiability":
		include("admin/liability/addLiability.php" );
		break;
	case "deleteLiability":
		include("admin/liability/deleteLiability.php" );
		break;
	case "ShowLiability":
		include("admin/liability/ShowLiability.php" );
		break;
	case "editLiability":
		include("admin/liability/editLiability.php" );
		break;
	case "roleMenu":
		include("roleMenu.php" );
		break;
	default:
		echo "Api service Project connext";
		break;

}
?>
