<?php
require_once "../Header.php";
switch ($_GET["service"]) {
	case "list_income":
		include("SP/list_income.php");
	break;
	case "get_income_type":
		include("SP/get_income_type.php");
	break;
	case "add_income":
		include("SP/add_income.php");
	break;
	case "recheck_income":
		include("SP/recheck_income.php");
	break;
	case "list_report":
		include("SP/list_report.php");
	break;
	case "diffupdate_income":
		include("SP/update_difference_income.php");
	break;
	case "submit_the_report":
		include("SP/submit_the_report.php");
	break;
	case "released":
		include("SP/released.php");
	break;


	default:
		echo "Api service Project connext";
		break;

}
?>