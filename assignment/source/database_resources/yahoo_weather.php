<?php
/**
 * This file contains methods to facilitate communication with the yahoo
 * weather api
 *
 * @author Robert Fry
 *
 */

/** This includes the base url needed to execute yql statements with */
include_once(__DIR__ . '/config.php');

/**
 * Sends a yahoo query to yahoo apis with a get request and returns the result as a json formatted string
 * The original version of this function was derived from the developer documentation example available at
 * https://developer.yahoo.com/weather/#php
 *
 * @see https://developer.yahoo.com/weather/#php
 *
 * @author Robert Fry
 *
 * @param string $yahoo_query_string
 * @return string
 * @throws Exception yahoo query curl error
 */
function execute_yahoo_query($yahoo_query_string)
{
    $BASE_URL = "http://query.yahooapis.com/v1/public/yql";
    $yql_query_url = YAHOO_API_URL . "?q=" . urlencode($yahoo_query_string) . "&format=json";
    // Make call with cURL
    $session = curl_init($yql_query_url);
    curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
    $json_text = curl_exec($session);
    // if query fails then return an empty string rather than false
    if ($json_text == false)
    {
        $error_message = 'yahoo query error: ' . curl_error($session);
        throw new Exception($error_message);
    }
    return $json_text;
}

/**
 * builds a yahoo query to retrieve the weather forecast based upon a woeid
 * @param string $woeid
 * @return string weather at position woeid
 * @throws exception executing yahoo query
 */
function get_weather_by_woeid($woeid)
{
    $yahoo_query = 'select * from weather.forecast where woeid = '. $woeid;
    $result = execute_yahoo_query($yahoo_query);
    return $result;
}