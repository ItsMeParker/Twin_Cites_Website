<?php
include_once(__DIR__ . '/dbconfig.php');

function get_connection()
{
    $dsn = 'mysql:host=' . DATABASE_HOST . ';dbname=' . DATABASE_NAME . ';charset=utf8';
    $conn = new PDO($dsn,DATABASE_USER,DATABASE_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}

function insert_to(&$conn, $query, $param)
{
    /** @var PDO $conn must hold a valid connection object*/
    $prep_stmt = $conn->prepare($query);
    $prep_stmt->execute($param);
    $new_id = $conn->lastInsertId();
    $prep_stmt = null;
    return $new_id;
}

?>
