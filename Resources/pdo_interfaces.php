<?php
/**
 * This file allows the website to interact with the database
 * Date: 2/11/18
 * Time: 6:21 PM
 * @author Robert Fry
 */
include_once(__DIR__ . '/config.php');
include_once(__DIR__ . '/yahoo_weather.php');
include_once(__DIR__ . '/google_places.php');

/**
 * creates a connection object to a sql5 database and returns the connection object
 *
 * Uses a the variables
 * @throws PDOException on failure to connect
 * @return PDO
 */
function get_connection()
{
    $dsn = 'mysql:host=' . DATABASE_HOST . ';dbname=' . DATABASE_NAME . ';charset=utf8';
    $conn = new PDO($dsn,DATABASE_USER,DATABASE_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}

/**
 * simple function to test the database is set up correctly,
 * If the function executes without throwing an exception the the database
 * is being accessed by the program
 *
 * @return string
 */
function pdo_test()
{
    $conn = get_connection();
    //$resultset = $conn->exec("SELECT * FROM `category` WHERE 1");
    $returnval = 'Results: ';
    foreach ($conn->query("SELECT * FROM `category` WHERE 1") as $row)
    {
        foreach ($row as $col)
        {
            $returnval .= $col . ' ';
        }
        $returnval .= '<br/>\n';
    }
    //close connection
    $conn=null;
    return $returnval;
}

/**
 * prepares a statement object to execute and returns the id of the new addition
 *
 * @param $conn PDO
 * @param $query string
 * @param $param array
 * @throws PDOException when a query does not execute properly
 * @return int last_inserted_id
 */
function insert_to(&$conn, $query, $param)
{
    /** @var PDO $conn must hold a valid connection object*/
    $prep_stmt = $conn->prepare($query);
    $prep_stmt->execute($param);
    $new_id = $conn->lastInsertId();
    $prep_stmt = null;
    return $new_id;
}

/**
 * prepares a statement object to execute and returns the result set of the query.
 *
 * If the query fails to execute due to an error it throws a PDOException
 * @param $conn PDO
 * @param $query string
 * @param $param array
 * @throws PDOException when a query does not execute properly
 * @return array
 */
function retrieve_data(&$conn, $query, $param)
{
    $prep_stmt = $conn->prepare($query);
    $prep_stmt->execute($param);
    $result = $prep_stmt->fetchAll();
    $prep_stmt = null;
    return $result;
}

/**
 * creates a new instance of a city in the database using the entered data
 * on successful completion will return the id of the inserted row and if the insert fails will return
 * an integer value of -1
 *
 * @param $woeid string
 * @param $county string
 * @param $wikilink string
 * @param $population string
 * @param $currency string
 * @param $area string
 * @param $language string
 * @param $country_id string
 * @param $conn PDO
 * @return int city_id the id of the created city or -1 if auto complete fails
 * yahoo api fail
 */
function create_city($woeid, $county, $wikilink, $population, $currency, $area, $language, $country_id, &$conn)
{

    try
    {
        $weatherdata = get_weather_by_woeid($woeid);
    }catch(Exception $e)
    {
        return -1;
    }
    $weatherdata = json_decode($weatherdata);
    $location = $weatherdata->query->results->channel;
    $query = 'INSERT INTO `city`(`city_name`, `geocode_latitude`, `geocode_longitude`, `country`, `woeid`, `county_state`, `population`, `area`, `currency`, `primary_language`, `wiki_link`) VALUES (:city, :lat, :lon, :country_id, :woeid, :county, :population, :area, :currency, :lan, :wiki)';
    $params = array(
        'city'=>$location->location->city,
        'lat'=>$location->item->lat,
        'lon'=>$location->item->long,
        'country_id'=>$country_id,
        'woeid'=>$woeid,
        'county'=>$county,
        'population'=>$population,
        'area'=>$area,
        'currency'=>$currency,
        'lan'=>$language,
        'wiki'=>$wikilink
    );

    // insert data to database
    try
    {
        $city_id = insert_to($conn, $query, $params);
        add_places_of_interest($city_id, $location->item->lat, $location->item->long,$conn);
        update_weather($city_id, $conn);
        return $city_id;
    }catch(Exception $ex)
    {
        return -1;
    }
}

/**
 * creates a new instance of a country in the database using the entered data
 * on successful completion will return the id of the inserted row and if the insert fails will return
 * an integer value of -1
 *
 * @param $country string The name of the country to create
 * @param $population string The population of the country, stored as string to prevent integer overflows
 * @param $language string The official language of a country
 * @param $gdp string The name of currency that a country uses
 * @param $wiki string A link to the country's Wikipedia page
 * @param $conn PDO
 * @return int The key of the country inserted, -1 if an error occured
 */
function create_country($country, $population, $language, $gdp, $wiki, &$conn)
{
    try {
        $query = 'INSERT INTO `country`(`country_name`, `population`, `national_language`, `gdp`, `wiki_link`) VALUES (:country, :pop, :lan, :gdp, :wiki)';
        $params = array(
            'country' => $country,
            'pop' => $population,
            'lan' => $language,
            'gdp' => $gdp,
            'wiki' => $wiki,
        );
        $key_id = insert_to($conn, $query, $params);
    }catch (Exception $ex)
    {
        $key_id = -1;
    }
    return $key_id;
}

/**
 * Returns a countrys id by searching for the record with a matching name
 *
 * On failing to find a country or if the database is improperly configured e.g. missing the country table
 * this function will return an empty array.
 * @param $name string
 * @param $conn PDO
 * @return array
 */
function get_country_id($name, &$conn)
{
    try
    {
        $query = 'SELECT country_id FROM country WHERE country_name = :country';
        $param = array(
            'country' => $name
        );
        $result = retrieve_data($conn, $query, $param);
    }catch (Exception $ex)
    {
        $result = [];
    }
    return $result;
}

/**
 * Runs an update on the weather tables for a chosen city
 *
 * @param $city_id string
 * @param $conn PDO
 * @return bool
 */
function update_weather($city_id, &$conn)
{

    $city_woeid = get_city_woeid($city_id, $conn);
    if($city_woeid === -1)
    {
        //city does not exist
        return false;
    }

    try
    {
        $php_obj = json_decode(get_weather_by_woeid($city_woeid))->query->results;
        //$php_obj = $php_obj->query->results;
    }catch (Exception $ex)
    {
        return false;
    }

    $query = 'INSERT INTO weather (city_id, last_checked, published_at, current_temp, weather_code)
              VALUES (:cid , current_timestamp, from_unixtime(:published), :temp, :weather)
              ON DUPLICATE KEY UPDATE
                city_id = VALUES(city_id),
                last_checked = VALUES(last_checked),
                published_at = VALUES(published_at),
                current_temp = VALUES(current_temp),
                weather_code = VALUES(weather_code)';

    $param = array(
        'cid' => $city_id,
        'published' => strtotime($php_obj->channel->item->pubDate),
        'temp' => $php_obj->channel->item->condition->temp,
        'weather' => $php_obj->channel->item->condition->code,
    );

    try {
        insert_to($conn, $query, $param);
        update_forecast($city_id, $php_obj->channel->item->forecast,$conn);
    }catch (Exception $ex)
    {
        return false;
    }
    // update successful
    return true;

}

/**
 * A function that retrieves a cities woeid based on its internal id.
 * If the query returns no number then returns -1 instead.
 *
 * @param $cityid string holds the cities id number
 * @param $conn PDO a connected PDO object
 * @return int
 */
function get_city_woeid($cityid, &$conn)
{
    $query = 'SELECT woeid FROM city WHERE city_id = :cid';
    $param = array(
        'cid' => $cityid,
    );
    try{
        $result = retrieve_data($conn, $query, $param);
        if(sizeof($result) === 0)
        {
            return -1;
        } else {
            return (int)$result[0][0];
        }

    }catch (Exception $ex)
    {
        return -1;
    }
}

/**
 * performs an update on the contents of the sql database by retriveing a new set of data.
 *
 * The cities data to be updated is selected by the city id which is looked up in the database to retrieve a
 * woid. This can then be used to interface with the yahoo api and pull a new set of weather data.
 * Returns nothing if the update is executed successfully, otherwise throws exception
 * @param $city_id
 * @param $yahoo_weather_data array takes the forecast array from the returned object. is an array of objects
 * @param $conn PDO
 * @throws PDOException if the db connection fails
 */
function update_forecast($city_id, $yahoo_weather_data, &$conn)
{
    $query = 'INSERT INTO forecast (city_id, date_offset, weather_code, temp_high, temp_low) VALUES';
    $param['cid'] = $city_id;

    for ($i = 0; $i < count($yahoo_weather_data); $i++)
    {
        $query .= ' (:cid, ' . $i .', :code' . $i . ', :high' . $i . ', :low' . $i .'),';
        $param['code' . $i] = $yahoo_weather_data[$i]->code;
        $param['high' . $i] = $yahoo_weather_data[$i]->high;
        $param['low' . $i] = $yahoo_weather_data[$i]->low;
    }
    $query = rtrim($query, ',');
    $query .= ' ON DUPLICATE KEY UPDATE
                city_id = VALUES(city_id),
                date_offset = VALUES(date_offset),
                weather_code = VALUES(weather_code),
                temp_high = VALUES(temp_high),
                temp_low = VALUES(temp_low)';
    insert_to($conn, $query, $param);

}

/**
 * Retrieves the weather data from the database
 * If no data exists for the given city id then returns an empty array
 * @param $cityid string
 * @param $conn PDO
 * @throws PDOException
 * @return array
 */
function get_weather_data($cityid, &$conn)
{
    $query = 'SELECT last_checked, published_at, current_temp, description
              FROM weather
              INNER JOIN weather_codes code2 ON weather.weather_code = code2.weather_code_id
              WHERE city_id = :cid';

    $param = array(
        'cid' => $cityid
    );
    $data = retrieve_data($conn, $query, $param);
    if(count($data) === 0){
        return array();
    }else{
        return $data[0];
    }

}

/**
 * Retrieves forecast data from the database
 * @param $city_id string contains the id of the city in the database
 * @param $conn PDO a connected pdo object
 * @throws PDOException
 * @return array contains results for the city, returns empty array if no results
 */
function get_forecast($city_id, &$conn)
{
    $query = 'SELECT date_offset, temp_high, temp_low, description
              FROM forecast
              INNER JOIN weather_codes code2 ON forecast.weather_code = code2.weather_code_id
              WHERE city_id = :cid';
    $param = array(
        'cid' => $city_id
    );
    $data = retrieve_data($conn, $query, $param);
    return $data;
}

/**
 * Retrieves all weather data from the database,
 * in case data is more than 30 minutes old will attempt to update the database
 * @param $city_id string
 * @param $conn PDO
 * @throws Exception when entering a invalid city id
 * @return array
 */
function access_weather($city_id, &$conn)
{
    // get the data from the database
    $data = get_weather_data($city_id, $conn);
    if(count($data) == 0)
    {
        throw new Exception("invalid city id");
    }

    $past = new DateTime($data['last_checked']);
    $present = new DateTime();

    /** @var int $interval contains minutes since last checked*/
    $interval = (int)$past->diff($present)->format('%i');
    if($interval >= 30)
    {
        //do update
        try
        {
            update_weather($city_id, $conn);
            //then retrieve new data (note the data is in the first row)
            $data = get_weather_data($city_id, $conn);
        }catch(Exception $ex)
        {
            //if we get here update might have failed so only attempt to grab forecast
        }

    }

    // weather will be updated already if necessary, pull forecast and return
    $result['weather'] = $data;
    $result['forecast'] = get_forecast($city_id, $conn);
    return $result;
}

/**
 * retrieves the cityid, country name and city name for all stored cities in the database
 * In the case of no cities being present returns an empty array.
 * @param $conn PDO
 * @throws PDOException on faliure to execute query
 * @return array
 */
function get_cities(&$conn)
{
    $query = 'SELECT city_id, country_name, city_name FROM city INNER JOIN country c ON city.country = c.country_id';
    $result = retrieve_data($conn, $query, array());
    return $result;
}

/**
 * @param $city_id string
 * @param $conn PDO
 * @throws PDOException when query fails to execute due to improperly set up database
 * @return array
 */
function get_city_data($city_id, &$conn)
{
    $query = 'SELECT
  city_name,
  geocode_latitude,
  geocode_longitude,
  woeid,
  county_state,
  population,
  area,
  currency,
  primary_language,
  wiki_link
FROM city
WHERE city_id = :cid';
    $param = array(
        'cid' => $city_id
    );
    return retrieve_data($conn, $query, $param);
}

/**
 * @param $name string
 * @param $conn PDO
 * @throws PDOException on failing to execute query
 * @return int
 */
function insert_category($name, &$conn)
{

    $query = 'INSERT INTO `venue_category`(`category_name`) VALUES (:name)';
    $param = array(
        'name' => $name
    );
    return insert_to($conn, $query, $param);
}

/**
 * @param $cid string
 * @param $name string
 * @param $latitude string
 * @param $longitude string
 * @param $website string
 * @param $rating string
 * @param $conn PDO
 * @throws PDOException on failing to execute query
 * @return int
 */
function insert_poi($cid, $name, $latitude, $longitude, $website, $rating, &$conn)
{
    $query = 'INSERT INTO `local_attractions`(`city`, `attraction_name`, `geocode_latitude`, `geocode_longitude`, `website`, `rating`) VALUES (:cid, :a_name, :lat, :lon, :site, :rating)';
    $param = array(
        'cid' => $cid,
        'a_name' => $name,
        'lat' => $latitude,
        'lon' => $longitude,
        'site' => $website,
        'rating' => $rating
    );
    return insert_to($conn, $query, $param);
}

/**
 * @param $location_id string
 * @param $tag_ids array should contain integers of tag ids as strings
 * @param $conn PDO
 * @throws PDOException on failing to execute query
 * @return int
 */
function insert_poi_tags($location_id, $tag_ids, &$conn)
{
    //$query = 'INSERT INTO `attraction_categories`(`venue_category`, `local_attraction`) VALUES (:vc, :la)';
    $query = 'INSERT INTO `attraction_categories`(`venue_category`, `local_attraction`) VALUES';
    $param = array();

    for ($i = 0; $i < count($tag_ids); $i++)
    {
        $query .= sprintf(' (:vc%d, %s),', $i, $location_id);
        $param['vc' . $i] = $tag_ids[$i];
    }
    $query = rtrim($query, ',');
    return insert_to($conn, $query, $param);
}

/**
 * @param $conn PDO
 * @return array
 */
function retrieve_poi_tags(&$conn)
{
    $query = 'SELECT `venue_category_id`, `category_name` FROM `venue_category` WHERE 1';
    $param = array();
    return retrieve_data($conn, $query, $param);
}

/**
 * @param $cid string
 * @param $location stdClass
 * @param $conn PDO
 * @return int
 */
function add_place_of_interest($cid, $location, &$conn)
{
    $tags_unparsed = retrieve_poi_tags($conn);
    $tags_parsed = array();

    $poi_id = insert_poi($cid, $location->name, $location->geometry->location->lat, $location->geometry->location->lng, create_search_address($location->name), (isset($location->rating)? $location->rating: '-1' ),$conn);

    foreach ($tags_unparsed as $tag)
    {
        $tags_parsed[$tag['category_name']] = $tag['venue_category_id'];
    }

    // create list of tag ids to append for this location
    $tags = array();
    foreach ($location->types as $location_tag)
    {
        if(isset($tags_parsed[$location_tag]))
        {
            // tag exists append id
            array_push($tags, $tags_parsed[$location_tag]);
        }
        else
        {
            //new tag so needs adding
            $new_tag_id = insert_category($location_tag, $conn);
            $tags_parsed[$location_tag] = $new_tag_id;
            array_push($tags, $tags_parsed[$location_tag]);
        }
    }
    insert_poi_tags($poi_id, $tags, $conn);

    return $poi_id;
}

/**
 * @param $cid string
 * @param $lat string
 * @param $lon string
 * @param $conn PDO
 * @throws Exception on failing to connect to google api to retrieve poi
 * @throws PDOException on database query failing to execute due to incorrect data
 */
function add_places_of_interest($cid, $lat, $lon, &$conn)
{
    $data = json_decode(get_poi_json($lat, $lon, '500'))->results;
    foreach ($data as $location)
    {
        add_place_of_interest($cid, $location, $conn);
    }
}

/**
 * @param $cid string
 * @param $conn PDO
 * @return array
 */
function get_poi_by_id($cid, &$conn)
{
    $query = 'SELECT
  local_attractions.attraction_name,
  local_attractions.geocode_latitude,
  local_attractions.geocode_longitude,
  local_attractions.website,
  local_attractions.rating
FROM local_attractions
WHERE local_attractions.city = :cid;';
    $param = array(
        'cid' => $cid
    );
    return retrieve_data($conn, $query, $param);
}