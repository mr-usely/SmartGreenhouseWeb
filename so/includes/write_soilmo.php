<?php
include_once '../../base/includes/db.php';
$soilmoist = '';
$name = '';
if(isset($_GET['soilmoist'])){
    $soilmoist = $_GET['soilmoist'];  
}
if(isset($_GET['name'])){
    $name = $_GET['name'];
}

$query = "INSERT INTO soilmoist (name, value, date) VALUES ('{$name}', '{$soilmoist}', now());";
$result = mysqli_query($con, $query);  
echo $query;
?>
