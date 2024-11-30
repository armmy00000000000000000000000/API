
<?php
require_once "../response.php";
require_once "../condb.php";
// if ( json_last_error() === JSON_ERROR_NONE ) {
// 	$_POST = json_decode( file_get_contents( 'php://input' ), true );
// }
$response = new Response();
switch ($_GET["service"]) {
	case "userAddAsset":
		include("users/asset/userAddAsset.php" );
		break;
	case "listAsset":
		include("users/asset/listAsset.php" );
		break;
	case "userEditAsset":
		include("users/asset/userEditAsset.php" );
		break;
	case "userEditdata":
		include("users/asset/userEditdata.php" );
		break;
	case "userAddliability":
		include("users/liability/userAddliability.php" );
		break;
	case "userEditliability":
		include("users/liability/userEditliability.php" );
		break;
	default:
		echo "Api service Project connext";
		break;

}
?>
