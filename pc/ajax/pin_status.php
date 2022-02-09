<?php
include_once '../../base/includes/db.php';

$query = "SELECT * FROM pin_status;";
$result = mysqli_query($con, $query);


while($row = mysqli_fetch_assoc($result)):
    if(isset($_GET['pin_'.$row['pin']])){
        $status = $_GET['pin_'.$row['pin']];
        $q = "UPDATE pin_status SET `status`={$status} WHERE pin={$row['pin']};";
        echo $q;
        $r = mysqli_query($con, $q);
    }
endwhile;


 

?>