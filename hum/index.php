 <?php include_once '../base/includes/header.php'; ?>
<!-- navbar -->
<?php include_once '../base/includes/navbar.php'; ?>
<!-- Sidebar -->    
<?php include_once '../base/includes/sidebar.php'; ?>
<!-- sidebar-wrapper -->
<?php include_once '../base/includes/page_title.php'?>
<!-- page title -->

<?php
    switch($menu){
        case "in_hum":
            include_once 'includes/in_hum.php';
            break;
        case "out_hum":
            include_once 'includes/out_hum.php';
            break;
		case "dashboard":
			include_once '../hum/includes/view_dash.php';
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