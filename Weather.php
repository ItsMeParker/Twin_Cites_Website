<?php

include_once('Resources/pdo_interfaces.php');

$city_id = $_GET['cid'];

$conn = get_connection();
try{
echo json_encode(access_weather($city_id, $conn));
}catch (Exception $ex)
{
	echo json_encode('ERROR: Invalid CID');
}


