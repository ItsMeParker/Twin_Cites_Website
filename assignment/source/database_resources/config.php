<?php
/**
 * This file contains a series of defines that are necessary to access apis and databases
 * in this project.
 *
 * These have been implemented here to allow for any changes necessary to be made here without editing the rest
 * of the project.
 *
 * @author Robert Fry
 * @package Twin_Cities
 */
// The sql user name and database name are the same but separation is important as it is not always guaranteed

$xml = simplexml_load_file(__DIR__."/../../models/schema/twinCities.xml");

if($xml === false)
{
    throw new Exception("Failed to load config");
}

$database_name = (string)$xml->uwe_environment->my_sql->database;
$database_user = (string)$xml->uwe_environment->my_sql->username;
$database_password = (string)$xml->uwe_environment->my_sql->pword;
$database_host = (string)$xml->uwe_environment->my_sql->database_host;
$yahoo_URL = (string)$xml->api->yahoo;
$google_api_key = (string)$xml->api->google;

define('DATABASE_NAME',$database_name);
define('DATABASE_USER', $database_user);
define('DATABASE_PASSWORD', $database_password);
define('DATABASE_HOST', $database_host);
define('YAHOO_API_URL', $yahoo_URL);
define('GOOGLE_API_KEY',$google_api_key);