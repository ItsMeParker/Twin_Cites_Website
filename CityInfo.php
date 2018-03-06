<?php

include_once('Resources/pdo_interfaces.php');

$city_id = $_GET['cid'];

$conn = get_connection();
try{
$data['city'] = get_city_data($city_id, $conn);
$data['country'] = get_country_data($data['city'][0]['country'], $conn);
echo json_encode($data);
}catch (Exception $ex)
{
	echo json_encode('ERROR: Invalid CID');
}


