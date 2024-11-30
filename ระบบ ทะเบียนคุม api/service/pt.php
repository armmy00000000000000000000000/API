


<?php
require_once "../Header.php";

switch ($_GET["service"]) {
    case "login":
        include("PT/login.php");
        break;
    case "list":
        include("PT/list.php");
        break;
    case "income_allocation":
        include("PT/income_allocation.php");
        break;
    case "sub_allocation":
        include("PT/sub_allocation.php");
        break;
    default:
        echo "Api service Project connext";
        break;
}
?>
