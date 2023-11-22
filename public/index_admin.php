<?php 

session_start();

ob_start();

include ("../src/connect.php");

include("../partials/admin_header.php");

if (isset($_GET['act'])) {
    switch ($_GET['act']) {

        case 'products':
            include "../admin/products.php";
            break;

            case 'placed_orders':
                include "../admin/placed_orders.php";
                break;

            case 'admin_accounts':
                include "../admin/admin_accounts.php";
                break;
        
            case 'users_accounts':
                include "../admin/users_accounts.php";
                break;
                
            default:
                include "../admin/admin_login.php";
                break;
        }
    } else {
        include "../admin/admin_login.php";
    }

?>