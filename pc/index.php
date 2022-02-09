<?php include_once '../base/includes/header.php'; ?>
<!-- navbar -->
<?php include_once '../base/includes/navbar.php'; ?>
<!-- Sidebar -->    
<?php include_once '../base/includes/sidebar.php'; ?>
<!-- /#sidebar-wrapper -->
<?php include_once '../base/includes/page_title.php'?>
<!-- page title -->

<?php
    switch($menu){
        case null:
            echo "Page not found";
            break;
        case "sw":
            include_once 'includes/sw_manage.php';
            break;
        case "card":
            echo "Card CONFIG";
            break;
        case "menu":
            echo "Module Menu";
            break;
        case "user":
            echo "Module User";
            break;
        case "sensor":
            echo "Module Sensor";
            break;
        case "doc":
            echo "Documentation";
            break;
        default:
            echo "Page not found";
            break;
    }
?>
    
<?php include_once '../base/includes/footer.php'; ?>