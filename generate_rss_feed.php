
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

$feedPrint = '<?xml version="1.0" encoding="UTF-8"?>';
$feedPrint .= '<rss version=2.0>';
$feedPrint .= '<channel>';
$feedPrint .= '<title>RSS feed </title>';
$feedPrint .= '<link>www.cems.uwe.ac.uk/~c29-parker/... </link>'; //complete path
$feedPrint .= '<description>This is the RSS feed generated for the \'Twin cities\' website.</description>';
 $data = []
	foreach ($data['city'] as $cityItem) 
	{
		$feedPrint .= '<item>';
		$feedPrint .= '<title>' . cityItem[] . '</title>';
		$feedPrint .= '<description>' . . '</description>';
		$feedPrint .= '<link>' .  . '</link>';
		$feedPrint .= '</item>';
	}

		foreach ($data['country'] as $countryItem) 
	{
		$feedPrint .= '<item>';
		$feedPrint .= '<title>' . countryItem[] . '</title>';
		$feedPrint .= '<description>' . . '</description>';
		$feedPrint .= '<link>' .  . '</link>';
		$feedPrint .= '</item>';
	}

		foreach ($data['forecast'] as $weatherItem) 
	{
		$feedPrint .= '<item>';
		$feedPrint .= '<title>' . weatherItem[] . '</title>';
		$feedPrint .= '<description>' . . '</description>';
		$feedPrint .= '<link>' .  . '</link>';
		$feedPrint .= '</item>';
	}

		foreach ($data['local_attractions'] as $poiItem) 
	{
		$feedPrint .= '<item>';
		$feedPrint .= '<title>' . poiItem[] . '</title>';
		$feedPrint .= '<description>' . . '</description>';
		$feedPrint .= '<link>' .  . '</link>';
		$feedPrint .= '</item>';
	}

echo ($feedPrint);


/*
-
-
-

-> table:city
	->city_id #not sure/maybe not needed 
	->city_name
	->geocode_latitude
	->geocode_longitude
	->country
	->woeid
	->county_state
	->population
	->area
	->currency
	->primary_language
	->wiki_link
-> table:country
	->country_id #not sure/maybe not needed
	->country_name
	->population
	->national_language
	->wiki_link
	->gdp
-> table:forecast
	->date_offset
	->temp_high
	->temp_low
	->city_id #format it to display city_name instead (if)
	
-> table:local_attractions
	->city
	->attraction_name
	->geocode_latitude
	->geocode_longitude
	->website #link
	->rating #of attraction
-> table:weather
	->city_id #format to display city_name
	->current_temp
	->weather_code #format to display actual text (?)

-> ignored tables: venue_category, weather_codes

-
-
-
*/

?>