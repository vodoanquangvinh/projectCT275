<?php 

session_start();

ob_start();

include ("../src/connect.php");

include("../partials/user_header.php");

if (isset($_GET['act'])) {
    switch ($_GET['act']) {

        case 'about':
            include "../user/about.php";
            break;

            case 'orders':
                include "../user/orders.php";
                break;

            case 'shop':
                include "../user/shop.php";
                break;

            case 'quick_view':
                include "../user/quick_view.php";
                break;
        
            default:
                include "../home.php";
                break;
        }
    } else {
        include "../home.php";
    }

include("../partials/footer.php");

?>