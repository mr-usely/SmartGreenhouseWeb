<?php
include_once '../../base/includes/db.php';
$pin    = '';
$status = '';
$ip = '';
$port = '';

$query = "SELECT * FROM arduino WHERE id=1";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
$ip = long2ip($row['ip']);
$port = $row['port'];


$query = "SELECT * FROM pin_status;";
$result = mysqli_query($con, $query);

while($row = mysqli_fetch_assoc($result)):
    if(isset($_GET['pin_'.$row['pin']])){
        $status = $_GET['pin_'.$row['pin']];
        $pin=$row['pin'];
    }
endwhile;

echo $pin . " " . $status;

if($status != ''){
	try{
		$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => 'http://' . $ip. ':'. $port .'?pin_'. $pin .'=' . $status,
			CURLOPT_USERAGENT => 'Codular Sample cURL Request'
		));
		// Send the request & save response to $resp
		$resp = curl_exec($curl);
		echo $resp;
		// Close request to clear up some resources
		curl_close($curl);
		header("Location: ../index.php?mod=pc&menu=sw");
		die();
	}catch (Exception $e){
		echo "Error";
	}
}
?>