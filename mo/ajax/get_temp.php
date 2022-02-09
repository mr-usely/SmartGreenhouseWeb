<?php
include_once '../../base/includes/db.php';
if(isset($_GET['last'])){
    //$query = "SELECT value FROM temperature ORDER BY ID DESC LIMIT 1;";
    $start = date("Y-m-d 00:00:00");
    $end = date("Y-m-d 23:59:59");
    
    // GET MIN VALUE, DATE
    $query = "SELECT value FROM temperature WHERE date BETWEEN '{$start}' AND '{$end}' ORDER BY ID DESC LIMIT 1";
    $result = mysqli_query($con, $query);  
    $result = mysqli_fetch_assoc($result);
    $result = $result['value'];
    echo $result;
}


?>