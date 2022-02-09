<?php
include_once '../../base/includes/db.php';

if (isset($_GET['create_users_tbl'])){
    echo $_GET['create_users_tbl'];
    if($_GET['create_users_tbl'] == "true"){
        $create_tbl = "CREATE TABLE IF NOT EXISTS users (";
        $create_tbl .= "`id` INT (10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
        $create_tbl .= "`name` VARCHAR(30) NOT NULL,";
        $create_tbl .= "`password` VARCHAR(30) NOT NULL,";
        $create_tbl .= "`group` INT (10) NOT NULL,";
        $create_tbl .= "`active` INT (10));";
        $result = mysqli_query($con, $create_tbl);
    }
    if($_GET['create_users_tbl'] == "false"){
        $create_tbl = "DROP TABLE IF EXISTS users;";   
        $result = mysqli_query($con, $create_tbl);  
        }
}
    
if (isset($_GET['create_modules_tbl'])){
    if($_GET['create_modules_tbl'] == "true"){
        $create_tbl = "CREATE TABLE IF NOT EXISTS modules (";
        $create_tbl .= "`id` INT (10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
        $create_tbl .= "`name` VARCHAR(30) NOT NULL,";
        $create_tbl .= "`link` VARCHAR(30) NOT NULL,";
        $create_tbl .= "`description` VARCHAR(30),";
        $create_tbl .= "`seq` INT (30),";
        $create_tbl .= "`group` INT (10));";
        echo $create_tbl;
        $result = mysqli_query($con, $create_tbl);
    }
    
    if($_GET['create_modules_tbl'] == "false"){
        $create_tbl = "DROP TABLE IF EXISTS modules;";   
        $result = mysqli_query($con, $create_tbl);  
    }
}

if (isset($_GET['create_menus_tbl'])){
    if($_GET['create_menus_tbl'] == "true"){
        $create_tbl = "CREATE TABLE IF NOT EXISTS menus (";
        $create_tbl .= "`id` INT (10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
        $create_tbl .= "`parent_id` INT (10) NOT NULL,";
        $create_tbl .= "`name` VARCHAR(30) NOT NULL,";
        $create_tbl .= "`link` VARCHAR(30) NOT NULL,";
        $create_tbl .= "`seq` INT (10),";
        $create_tbl .= "`page_title` VARCHAR(30),";
        $create_tbl .= "`page_title_sm` VARCHAR(30),";
        $create_tbl .= "`icon` VARCHAR(30),";
        $create_tbl .= "`group` INT (10));";
        echo $create_tbl;
        $result = mysqli_query($con, $create_tbl);
    }
    
    if($_GET['create_menus_tbl'] == "false"){
        $create_tbl = "DROP TABLE IF EXISTS menus;";   
        $result = mysqli_query($con, $create_tbl);  
    }
}


if (isset($_GET['create_temp_tbl'])){
    if($_GET['create_temp_tbl'] == "true"){
        $create_tbl = "CREATE TABLE IF NOT EXISTS temperature (";
        $create_tbl .= "`id` INT (10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
        $create_tbl .= "`name` VARCHAR(30) NOT NULL,";
        $create_tbl .= "`value` INT (10),";
        $create_tbl .= "`date` datetime);";
        echo $create_tbl;
        $result = mysqli_query($con, $create_tbl);
    }
    
    if($_GET['create_temp_tbl'] == "false"){
        $create_tbl = "DROP TABLE IF EXISTS temperature;";   
        $result = mysqli_query($con, $create_tbl);  
    }
}

if (isset($_GET['create_hum_tbl'])){
    if($_GET['create_hum_tbl'] == "true"){
        $create_tbl = "CREATE TABLE IF NOT EXISTS humidity (";
        $create_tbl .= "`id` INT (10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
        $create_tbl .= "`name` VARCHAR(30) NOT NULL,";
        $create_tbl .= "`value` INT (10),";
        $create_tbl .= "`date` datetime);";
        echo $create_tbl;
        $result = mysqli_query($con, $create_tbl);
    }
    
    if($_GET['create_hum_tbl'] == "false"){
        $create_tbl = "DROP TABLE IF EXISTS humidity;";   
        $result = mysqli_query($con, $create_tbl);  
    }
}

if (isset($_GET['create_soil_tbl'])){
    if($_GET['create_soil_tbl'] == "true"){
        $create_tbl = "CREATE TABLE IF NOT EXISTS soilmoist (";
        $create_tbl .= "`id` INT (10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
        $create_tbl .= "`name` VARCHAR(30) NOT NULL,";
        $create_tbl .= "`value` INT (10),";
        $create_tbl .= "`date` datetime);";
        echo $create_tbl;
        $result = mysqli_query($con, $create_tbl);
    }
    
    if($_GET['create_soil_tbl'] == "false"){
        $create_tbl = "DROP TABLE IF EXISTS soilmoist;";   
        $result = mysqli_query($con, $create_tbl);  
    }
}

if (isset($_GET['create_waterl_tbl'])){
    if($_GET['create_waterl_tbl'] == "true"){
        $create_tbl = "CREATE TABLE IF NOT EXISTS waterlevel (";
        $create_tbl .= "`id` INT (10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
        $create_tbl .= "`name` VARCHAR(30) NOT NULL,";
        $create_tbl .= "`value` INT (10),";
        $create_tbl .= "`date` datetime);";
        echo $create_tbl;
        $result = mysqli_query($con, $create_tbl);
    }
    
    if($_GET['create_waterl_tbl'] == "false"){
        $create_tbl = "DROP TABLE IF EXISTS waterlevel;";   
        $result = mysqli_query($con, $create_tbl);  
    }
}

if (isset($_GET['create_pin_tbl'])){
    if($_GET['create_pin_tbl'] == "true"){
        $create_tbl = "CREATE TABLE IF NOT EXISTS pin_status (";
        $create_tbl .= "`id` INT (10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
        $create_tbl .= "`pin` INT(10) NOT NULL,";
        $create_tbl .= "`status` INT (10),";
        $create_tbl .= "`description` VARCHAR(20));";
        echo $create_tbl;
        $result = mysqli_query($con, $create_tbl);
    }
    
    if($_GET['create_pin_tbl'] == "false"){
        $create_tbl = "DROP TABLE IF EXISTS pin_status;";   
        $result = mysqli_query($con, $create_tbl);  
    }
}

if (isset($_GET['create_ard_tbl'])){
    if($_GET['create_ard_tbl'] == "true"){
        $create_tbl = "CREATE TABLE IF NOT EXISTS arduino (";
        $create_tbl .= "`id` INT (10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
        $create_tbl .= "`ip` BIGINT(20) NOT NULL,";
        $create_tbl .= "`port` INT (10),";
        $create_tbl .= "`description` VARCHAR(20));";
        echo $create_tbl;
        $result = mysqli_query($con, $create_tbl);
    }
    
    if($_GET['create_ard_tbl'] == "false"){
        $create_tbl = "DROP TABLE IF EXISTS arduino;";   
        $result = mysqli_query($con, $create_tbl);  
    }
}

if (isset($_GET['create_log_tbl'])){
    if($_GET['create_log_tbl'] == "true"){
        $create_tbl = "CREATE TABLE IF NOT EXISTS logs (";
        $create_tbl .= "`id` INT (10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
        $create_tbl .= "`log` VARCHAR(50) NOT NULL,";
        $create_tbl .= "`date` DATETIME,";
        $create_tbl .= "`type` VARCHAR(20));";
        echo $create_tbl;
        $result = mysqli_query($con, $create_tbl);
    }
    
    if($_GET['create_log_tbl'] == "false"){
        $create_tbl = "DROP TABLE IF EXISTS logs;";   
        $result = mysqli_query($con, $create_tbl);  
    }
}

if (isset($_GET['create_group_tbl'])){
    if($_GET['create_group_tbl'] == "true"){
        $create_tbl = "CREATE TABLE IF NOT EXISTS groups (";
        $create_tbl .= "`id` INT (10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
        $create_tbl .= "`name` VARCHAR(50) NOT NULL,";
        $create_tbl .= "`module` INT (10),";
        $create_tbl .= "`description` VARCHAR(50));";
        echo $create_tbl;
        $result = mysqli_query($con, $create_tbl);
    }
    
    if($_GET['create_group_tbl'] == "false"){
        $create_tbl = "DROP TABLE IF EXISTS groups;";   
        $result = mysqli_query($con, $create_tbl);  
    }
}


header("Location: ../index.php?mod=base&menu=tbl");
?>