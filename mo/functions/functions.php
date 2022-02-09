<?php

include_once '../../base/includes/db.php';

$start = date("Y-m-d 00:00:00");
$end = date("Y-m-d 23:59:59");
$today = date('Y-m-d');

function get_max_temp(){
    $start = date("Y-m-d 00:00:00");
    $end = date("Y-m-d 23:59:59");
    $today = date('Y-m-d');
    $query = "SELECT MAX(value) AS max FROM temperature WHERE date BETWEEN '{$start}' AND '{$end}'";
    $result = mysqli_query($con, $query);
    $max = mysqli_fetch_assoc($result);
    $max = $max['max'];
    return $max;
}


?>