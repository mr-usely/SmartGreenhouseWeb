<?php
include_once '../../base/includes/db.php';
$temp = '';
$name = '';
if(isset($_GET['temp'])){
    $temp = $_GET['temp'];  
}
if(isset($_GET['name'])){
    $name = $_GET['name'];
}

$query = "INSERT INTO temperature (value, name, date) VALUES ({$temp}, '{$name}', now());";
$result = mysqli_query($con, $query);  
echo $query;
?>
