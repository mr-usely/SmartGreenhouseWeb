<?php
include_once '../../base/includes/db.php';
$waterlevel = '';
$name = '';
if(isset($_GET['waterlevel'])){
    $waterlevel = $_GET['waterlevel'];  
}
if(isset($_GET['name'])){
    $name = $_GET['name'];
}

$query = "INSERT INTO waterlevel (name, value, date) VALUES ('{$name}', '{$waterlevel}', now());";
$result = mysqli_query($con, $query);  
echo $query;
?>
