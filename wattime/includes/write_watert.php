<?php
include_once '../../base/includes/db.php';
$watertime = '';
$name = '';
if(isset($_GET['watervalue'])){
    $watertime = $_GET['watervalue'];  
}

$query = "INSERT INTO watertime (value, date, time) VALUES ('{$watertime}', now(), now());";
$result = mysqli_query($con, $query);  
echo $query;
?>
