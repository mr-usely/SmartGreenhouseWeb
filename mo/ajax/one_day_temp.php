<?php
include_once '../../base/includes/db.php';

$start = date("Y-m-d 00:00:00");
$end = date("Y-m-d 23:59:59");

$query = "SELECT * FROM temperature WHERE date BETWEEN '{$start}' AND '{$end}' ORDER BY id DESC LIMIT 10";
$result = mysqli_query($con, $query);  

$number = 1;
while($row = mysqli_fetch_assoc($result)):
    echo "<tr>";
    echo "<td>{$number}</td>";
    echo "<td>{$row['name']}</td>";
    echo "<td>{$row['value']}&deg c</td>";
    echo "<td>{$row['date']}</td>";
    echo "</tr>";
    $number+=1;
endwhile;

?>