<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 1/20/18
 * Time: 5:19 PM
 * @author Robert Fry
 */

/** Database credentials are held in config.php */
include_once(__DIR__ . '/config.php');


/**
 * function to establish a connection to a predetermined remote database
 *
 * @throws Exception when unable to connect to a database containing error details
 * @return mysqli
 */
function get_connection()
{
        //$db_conn = mysqli_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_NAME);
        $db_conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_NAME);
        if($db_conn->connect_errno > 0)
        {
            throw new Exception($db_conn->connect_error);
        }
    return $db_conn;
}

/**
 * @param string $country
 * @throws Exception when unable to connect to a database containing error details or
 *         upon encountering an error preventing insertion
 * @return int row inserted
 */
function insert_country($country)
{
    $db_conn = get_connection();
    $sql_statement = 'INSERT INTO Country (country_name) VALUES (?)';
    if($stmt_h = $db_conn->prepare($sql_statement))
    {
        if(!$stmt_h->bind_param('s',$country))
        {
            $err_msg = 'Error(' . $stmt_h->errno . '): ' . $stmt_h->error;
            throw new Exception($err_msg);
        }

        //parameter binding successful
        if (!$stmt_h->execute())
        {
            $err_msg = 'Error(' . $stmt_h->errno . '): ' . $stmt_h->error;
            throw new Exception($err_msg);
        }
        $country_id = $stmt_h->insert_id;
        $stmt_h->close();
        $db_conn->close();
        return $country_id;
    }
    else {
        throw new Exception("Error(-1): prepare country insert statement failed");
    }
}

/**
 * @param string $city_name
 * @param string $city_latitude
 * @param string $city_longitude
 * @param int $country_id
 * @param int $woeid
 * @return int city_id
 * @throws Exception on failing to establish database connection or failing insertion
 */
function insert_city($city_name, $city_latitude, $city_longitude, $country_id, $woeid)
{
    $db_conn = get_connection();
    $sql_statement = 'INSERT INTO `City`(`city_name`, `geocode_latitude`, `geocode_longitude`, `country`, `woeid`) VALUES (?,?,?,?,?)';
    if($stmt_h = $db_conn->prepare($sql_statement))
    {
        if(!$stmt_h->bind_param('sssii',$city_name, $city_latitude, $city_longitude, $country_id, $woeid))
        {
            $err_msg = 'Error(' . $stmt_h->errno . '): ' . $stmt_h->error;
            throw new Exception($err_msg);
        }

        //parameter binding successful
        if (!$stmt_h->execute())
        {
            $err_msg = 'Error(' . $stmt_h->errno . '): ' . $stmt_h->error;
            throw new Exception($err_msg);
        }
        $insert_id = $stmt_h->insert_id;
        $stmt_h->close();
        $db_conn->close();
        return $insert_id;
    }
    else {
        throw new Exception("Error(-1): prepare city insert statement failed");
    }
}

/**
 * @param $city_id
 * @param $published_at
 * @param $current_temp
 * @param $current_conditions
 * @param $forecast
 */
function insert_weather($city_id, $published_at, $current_temp, $current_conditions, $forecast)
{
    /* insert into table (col, count)
    values (val1, val2)
    on duplicate update count = count + values(count);

    INSERT INTO `Weather`(`city`, `last_checked`, `published_at`, `current_temp`, `current_conditions`, `forecast0_low`, `forecast0_high`, `forecast0_conditions`, `forecast1_low`, `forecast1_high`, `forecast1_conditions`, `forecast2_low`, `forecast2_high`, `forecast2_conditions`, `forecast3_low`, `forecast3_high`, `forecast3_conditions`, `forecast4_low`, `forecast4_high`, `forecast4_conditions`, `forecast5_low`, `forecast5_high`, `forecast5_conditions`, `forecast6_low`, `forecast6_high`, `forecast6_conditions`, `forecast7_low`, `forecast7_high`, `forecast7_conditions`, `forecast8_low`, `forecast8_high`, `forecast8_conditions`, `forecast9_low`, `forecast9_high`, `forecast9_conditions`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
    ON DUPLICATE KEY UPDATE 'city' =  VALUES('city'), 'last_checked' =  VALUES('last_checked'), 'published_at' =  VALUES('published_at'), 'current_temp' =  VALUES('current_temp'), 'current_conditions' =  VALUES('current_conditions'), 'forecast0_low' =  VALUES('forecast0_low'), 'forecast0_high' =  VALUES('forecast0_high'), 'forecast0_conditions' =  VALUES('forecast0_conditions'), 'forecast1_low' =  VALUES('forecast1_low'), 'forecast1_high' =  VALUES('forecast1_high'), 'forecast1_conditions' =  VALUES('forecast1_conditions'), 'forecast2_low' =  VALUES('forecast2_low'), 'forecast2_high' =  VALUES('forecast2_high'), 'forecast2_conditions' =  VALUES('forecast2_conditions'), 'forecast3_low' =  VALUES('forecast3_low'), 'forecast3_high' =  VALUES('forecast3_high'), 'forecast3_conditions' =  VALUES('forecast3_conditions'), 'forecast4_low' =  VALUES('forecast4_low'), 'forecast4_high' =  VALUES('forecast4_high'), 'forecast4_conditions' =  VALUES('forecast4_conditions'), 'forecast5_low' =  VALUES('forecast5_low'), 'forecast5_high' =  VALUES('forecast5_high'), 'forecast5_conditions' =  VALUES('forecast5_conditions'), 'forecast6_low' =  VALUES('forecast6_low'), 'forecast6_high' =  VALUES('forecast6_high'), 'forecast6_conditions' =  VALUES('forecast6_conditions'), 'forecast7_low' =  VALUES('forecast7_low'), 'forecast7_high' =  VALUES('forecast7_high'), 'forecast7_conditions' =  VALUES('forecast7_conditions'), 'forecast8_low' =  VALUES('forecast8_low'), 'forecast8_high' =  VALUES('forecast8_high'), 'forecast8_conditions' =  VALUES('forecast8_conditions'), 'forecast9_low' =  VALUES('forecast9_low'), 'forecast9_high' =  VALUES('forecast9_high'), 'forecast9_conditions' =  VALUES('forecast9_conditions')

    */
}

