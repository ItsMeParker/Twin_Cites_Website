<?php
/**
 * Created by PhpStorm.
 * User: Robert Fry
 * Date: 2/9/18
 * Time: 5:30 PM
 * @author Robert Fry
 */
include_once (__DIR__ . '/config.php');

/**
 * A simple predetermined function to test whether the google api is
 * functioning correctly.
 *
 * Executes a call to the google places nearby search api using the API key
 * in the settings config file and returns the result as a json object. If it recieves no reply
 * throws an exception containing the error message. If the API key is invalid
 * the reply will contain a fail message in json
 *
 * @return string
 * @throws Exception google query curl error
 */
function test_query()
{
    //51.458237, -2.587452
    $places_url = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=51.458237,-2.587452&radius=500&type=point_of_interest&key=' . GOOGLE_API_KEY; //AIzaSyAiAn_oTuXQ4NQf9rr6LR2YL6Gvt_UKhJ8
    $session = curl_init($places_url);
    curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
    $json_text = curl_exec($session);
    if ($json_text == false)
    {
        $error_message = 'google error: ' . curl_error($session);
        throw new Exception($error_message);
    }
    return $json_text;
}

/**
 * Executes a call to the google api to find places of interest nearby a provided geocode.
 *
 * Executes a call to the google places nearby search api using the API key and the provided
 * values for latitude, longitude and radius in the settings config file and returns
 * the result as a json object. If it receives no reply throws an exception containing the
 * error message. If the API key or parameters provided are invalid then the reply
 * will contain a fail message in json.
 *
 * @param string $latitude contains a valid latitude
 * @param string $longitude contains a valid longitude
 * @param string $radius contains a number specifying the radius in metres
 * @return string containing the json from a request
 * @throws Exception google query curl error
 */
function get_poi_json($latitude, $longitude, $radius)
{
    $places_url = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='. $latitude .','. $longitude . '&radius='. $radius .'&type=point_of_interest&key=' . GOOGLE_API_KEY;
    $session = curl_init($places_url);
    curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
    $json_text = curl_exec($session);
    if ($json_text == false)
    {
        $error_message = 'google error: ' . curl_error($session);
        throw new Exception($error_message);
    }
    return $json_text;
}

/**
 * Formats a string so that a google search may be executed with its contents
 * This function should not fail however care must be taken if changing the field sizes in the databases
 *
 * @param $search string
 * @return string
 */
function create_search_address($search)
{
    $search = urlencode($search);
    $address = 'https://www.google.co.uk/search?q=' . $search;
    return $address;
}

