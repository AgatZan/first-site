<?php 

$env = file($_SERVER['DOCUMENT_ROOT'] . '/database/.env');
$arr = [];
foreach($env as $line){    
    $arr []=trim(explode('=', $line,2)[1]);
}
define('DB_HOST', $arr[0]);
define('DB_PORT', intval($arr[1]));
define('DB_NAME', $arr[2]);
define('DB_USERNAME', $arr[3]);
define('DB_PASSWORD', $arr[4]);

define('DB_CACHE_VAL', 1000);