<?php
error_reporting(E_ALL);
ini_set('short_open_tag', 1); 
ini_set('display_errors',0);
ini_set('log_errors',1);
define('PROJECT_ROOT', realpath(__DIR__));

define('BASE_URL','/');

define('DB_HOST', 'sql207.infinityfree.com');

define('DB_NAME', 'if0_39164712_sample');

define('DB_USER', 'if0_39164712');

define('DB_PASS', 'UcgFrNyNHXcU');

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
