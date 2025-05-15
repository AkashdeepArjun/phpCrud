
<?php

error_reporting(E_ALL);
ini_set('display_errors',true);
ini_set('html_errors',true);
ini_set('short_open_tag', 1); 

define('PROJECT_ROOT', realpath(__DIR__));

define('BASE_URL','/');

define('DB_HOST', 'localhost');

define('DB_NAME', 'sample');

define('DB_USER', 'root');

define('DB_PASS', 'akash@007');

function getDB()
{

$dsn ='mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4';


try {
    return new PDO($dsn,DB_USER,DB_PASS,[PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION]);
} catch (Exception $e) {
    die('DB ERROR'.$e->getMessage());
}




}

?>





