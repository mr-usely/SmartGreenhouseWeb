<?php include_once '../base/includes/header.php'; ?>
<!-- navbar -->
<?php include_once '../base/includes/navbar.php'; ?>
<!-- Sidebar -->    
<?php include_once '../base/includes/sidebar.php'; ?>
<!-- /#sidebar-wrapper -->


<?php
    if(isset($_GET['add_user'])){
        $add_user = $_GET['add_user']; 
    }
    
    if(isset($_GET['add_mod'])){
        $add_mod = $_GET['add_mod']; 
    }
    
    if(isset($_GET['add_menu'])){
        $add_menu = $_GET['add_menu']; 
    }
    if(isset($_GET['add_switch'])){
        $add_switch = $_GET['add_switch']; 
    }
    if(isset($_GET['add_ip'])){
        $add_ip = $_GET['add_ip']; 
    }
    
    if(isset($_GET['add_gr'])){
        $add_gr = $_GET['add_gr']; 
    }
    
    //DELETE USER
    if(isset($_GET['delete_user'])){
        $id = $_GET['delete_user'];
        $query = "DELETE FROM users WHERE id = {$id};";

        $result = mysqli_query($con, $query);
        if($result){
            header('Location: index.php?mod=base&menu=usr');
            exit();
        }
    }
     //DELETE USER
    if(isset($_GET['delete_mod'])){
        $id = $_GET['delete_mod'];
        $query = "DELETE FROM modules WHERE id = {$id};";

        $result = mysqli_query($con, $query);
        if($result){
            header('Location: index.php?mod=base&menu=mo');
            exit();
        }
    }
    //DELETE MENU
    if(isset($_GET['delete_menu'])){
        $id = $_GET['delete_menu'];
        $query = "DELETE FROM menus WHERE id = {$id};";

        $result = mysqli_query($con, $query);
        if($result){
            header('Location: index.php?mod=base&menu=me');
            exit();
        }
    }
    //DELETE PIN
    if(isset($_GET['delete_pin'])){
        $id = $_GET['delete_pin'];
        $query = "DELETE FROM pin_status WHERE id = {$id};";

        $result = mysqli_query($con, $query);
        if($result){
            header('Location: index.php?mod=base&menu=sw');
            exit();
        }
    }
    
    //DELETE ARDUINO IP
    if(isset($_GET['delete_ip'])){
        $query = "DELETE FROM pin_status WHERE id=1;";
        $result = mysqli_query($con, $query);
        echo $query;
        if($result){
            header('Location: index.php?mod=base&menu=ar');
            exit();
        }
    }
    
    //DELETE ARDUINO IP
    if(isset($_GET['delete_gr'])){
        $gid = $_GET['delete_gr'];
        $query = "DELETE FROM groups WHERE id={$gid};";
        $result = mysqli_query($con, $query);
        echo $query;
        if($result){
            header('Location: index.php?mod=base&menu=gr');
            exit();
        }
    }
       
    switch(true){
        case ($menu =="dash" ):
        case null:
            include_once 'includes/view_dash.php';
            break;
		case ($menu =="db"):
            include_once 'includes/view_db.php';
            break;
        case ($menu =="tbl"):
            include_once 'includes/view_tbl.php';
            break;
        case ($add_user=='true' || isset($_GET['edit_user'])):
            include_once 'includes/form_usr.php';
            break;
        case ($add_mod=='true' || isset($_GET['edit_mod'])):
            include_once 'includes/form_mod.php';
            break;
        case ($add_menu=='true' || isset($_GET['edit_menu'])):
            include_once 'includes/form_menu.php';
            break;
        case ($add_switch =="true" || isset($_GET['edit_pin'])):
            include_once 'includes/form_switches.php';
            break;
        case ($add_ip =="true" || isset($_GET['edit_ip'])):
            include_once 'includes/form_arduino.php';
            break;
        case ($add_gr =="true" || isset($_GET['edit_gr'])):
            include_once 'includes/form_group.php';
            break;
        case ($menu =="ar"):
            include_once 'includes/view_arduino.php';
            break;
        case ($menu =="sw"):
            include_once 'includes/view_switches.php';
            break;
        case ($menu =="usr"):
            include_once 'includes/view_usr.php';
            break;
        case ($menu =="gr"):
            include_once 'includes/view_group.php';
            break;
        case ($menu =="mo"):
            include_once 'includes/view_mod.php';
            break;
        case ($menu =="me"):
            include_once 'includes/view_menu.php';
            break;
        case ($menu =="log"):
            include_once 'includes/view_log.php';
            break;
        case ($menu =="doc"):
            include_once 'includes/view_doc.php';
            break;
        default:
            echo "Page not found";
            break;
    }
?>
    
<?php include_once '../base/includes/footer.php'; ?>
