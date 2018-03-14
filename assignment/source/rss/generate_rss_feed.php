<?php
require_once 'Resources/pdo_interfaces.php';

/*Establish a connection to the database*/


if(!isset($_GET['cid']))
{
    //perhaps change to redirect to homepage
    die("No cid passed");
}
$city_id = $_GET['cid'];


/*Establish a connection to the database*/
$conn = get_connection();
/*Retrieve all data from the following tables using their respective
  functions so that it can be displayed as an RSS feed later.
  Table:   				Function:
 'city'  				get_city_data
 'country'  			get_country_data
 'forecast'  			access_weather
 'local_attractions'	get_poi_by_id	*/

try
{
    $cityData = get_city_data($city_id, $conn)[0];
    $countryData = get_country_data($cityData['country'], $conn)[0]; /*Change 0 for city_id to dinamically generate for each city */
    $weatherData = access_weather($city_id, $conn);
    $placesOfInterest = get_poi_by_id($city_id, $conn);
}
catch (Exception $ex)
{
    header('Location: http://cems.uwe.ac.uk/~c29-parker/Twin_Cities');
    exit;
}

  /*Generate the RSS to be displayed making use of the $feedPrint variable to first append the relevant data 
  	to be echoed to it, and then proceed to echo/print said data to the browser */

$feedPrint = '<?xml version="1.0" encoding="UTF-8"?>';
$feedPrint .= '<rss version=2.0>';
$feedPrint .= '<channel>';
$feedPrint .= '<title>RSS feed for ' . $cityData['city_name'] . '</title>';

if(isset($_SERVER['SERVER_NAME']) && isset($_SERVER['REQUEST_URI']))
{
    $address = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
}
else {
    $address = "http://cems.uwe.ac.uk";
}

$feedPrint .= "<link>$address</link>"; //complete path
$feedPrint .= '<description>This is the RSS feed generated for the \'Twin cities\' website location, ' . $cityData['city_name'] . ' in ' . $countryData['country_name'] .'.' . '</description>';


$cityDescription = <<< EOT
Woeid for {$cityData['city_name']}: {$cityData['woeid']}, 
County: {$cityData['county_state']}, 
Population: {$cityData['population']}, 
Area: {$cityData['area']} km^2, 
Currency: {$cityData['currency']}, 
Primary Language: {$cityData['primary_language']}. 
EOT;

 
/* city */ 
$feedPrint .= '<item>'; 
$feedPrint .= "<title>Data for {$cityData['city_name']}</title>"; 
$feedPrint .= '<description>' . $cityDescription . '</description>'; 
$feedPrint .= '<link>' . $cityData['wiki_link'] . '</link>';
$feedPrint .= '</item>';

$countryDescription = <<<EOT

Population: {$countryData['population']},
National Language: {$countryData['national_language']},
GDP: {$countryData['gdp']},

EOT;

$feedPrint .= '<item>';
$feedPrint .= "<title>Data for {$countryData['country_name']}</title>";
$feedPrint .= '<description>' . $countryDescription . '</description>';
$feedPrint .= "<link>{$countryData['wiki_link']}</link>";
$feedPrint .= '</item>';

/* weather */
$weatherDescription = <<< EOT

Current conditions for {$cityData['city_name']} are: {$weatherData['weather']['description']}.
The temperature is: {$weatherData['weather']['current_temp']}.

Last updated: {$weatherData['weather']['published_at']}.

EOT;

foreach ($weatherData['forecast'] as $var)
{
    $weatherDescription .= <<< EOT

The forecast for day {$var['date_offset']} is {$var['description']}
with a high of {$var['temp_high']}
and a low of {$var['temp_low']}.

EOT;

}

$feedPrint .= '<item>';
$feedPrint .= '<title>Weather</title>';
$feedPrint .= '<description>' . $weatherDescription . '</description>';
$feedPrint .= "<link>https://www.yahoo.com/news/weather/country/state/city-{$cityData['woeid']}/</link>";
$feedPrint .= '</item>';

$placesOfInterestDescription = '';
foreach ($placesOfInterest as $var)
{
    $rating = ($var['rating'] != -1) ? $var['rating'] : 'unrated';
    $placesOfInterestDescription .= <<<EOT

Attraction name: {$var['attraction_name']},
latitude/longitude: {$var['geocode_latitude']},{$var['geocode_longitude']},
Rating: {$rating},
More info: {$var['website']}


EOT;

}

/* places of interest */
$feedPrint .= '<item>';
$feedPrint .= '<title>Places of interest</title>';
$feedPrint .= '<description>' . $placesOfInterestDescription . '</description>';

$feedPrint .= '</item>';

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

