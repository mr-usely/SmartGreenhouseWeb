<?php
include_once '../../base/includes/db.php';
$start = date("Y-m-d 00:00:00");
$end = date("Y-m-d 23:59:59");

// GET MIN VALUE, DATE
$query = "SELECT value, date FROM temperature WHERE date BETWEEN '{$start}' AND '{$end}'";
$result = mysqli_query($con, $query);

$min = 100;
$min_date = '';

while($get = mysqli_fetch_assoc($result)):
    if($get['value'] < $min){
        $min = $get['value'];
        $min_date = $get['date'];
    }
endwhile;

$min_date = date("H:i:s",strtotime($min_date));

// GET MAX VALUE, DATE
$query = "SELECT value, date FROM temperature WHERE date BETWEEN '{$start}' AND '{$end}'";
//echo $query;
$result = mysqli_query($con, $query);
$max = -100;
$max_date = '';

while($get = mysqli_fetch_assoc($result)):
    if($get['value'] > $max){
        $max = $get['value'];
        $max_date = $get['date'];
    }
endwhile;

$max_date = date("H:i:s", strtotime($max_date));

// GET AVERAGE
$query = "SELECT AVG(value) AS ave FROM temperature WHERE date BETWEEN '{$start}' AND '{$end}'";
$result = mysqli_query($con, $query);
$get = mysqli_fetch_assoc($result);
$ave = $get['ave'];
$ave = number_format($ave,2);

if($min == 100){
    $min = '';
}
if($max == -100){
    $max = '';
}

echo $min.','.$min_date.','.$max.','.$max_date.','.$ave;
 

?>