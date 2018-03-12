
<?php 
include_once(__DIR__ . '/config.php');
include_once(__DIR__ . '/pdo_interfaces.php')

/*Establish a connection to the database*/
$conn = get_connection();
$city_id = $_GET['cid'];

/*Retrieve all data from the following tables using their respective
  functions so that it can be displayed as an RSS feed later.
  Table:   				Function:
 'city'  				get_city_data
 'country'  			get_country_data
 'forecast'  			access_weather
 'local_attractions'	get_poi_by_id	*/

try	{
		$data['cityData'] = get_city_data($city_id, $conn);
		$data['countryData'] = get_country_data($data['city'][0]['country'], $conn); /*Change 0 for city_id to dinamically generate for each city */
		$data['weatherData'] = access_weather($city_id, $conn);
		$data['poiByID'] = get_poi_by_id($cid, $conn);
		
		json_encode($data);
	}

catch (Exception $ex)
	{
		echo json_encode('ERROR: Invalid CID');
	}

  /*Generate the RSS to be displayed making use of the $feedPrint variable to first append the relevant data 
  	to be echoed to it, and then proceed to echo/print said data to the browser */

 $feedPrint
?>