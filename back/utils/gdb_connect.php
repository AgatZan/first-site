<?php  
require_once $_SERVER['DOCUMENT_ROOT'] .'/data/const/db.php';

function db_panic($e){
    header('location:'. P_DB_ERROR .'?err='.$e->getMessage());
    die();
};
function db_connect(
    $host=DB_HOST
    , $port=DB_PORT
    , $dbname=DB_NAME
    , $username=DB_USERNAME
    , $password=DB_PASSWORD
):\PDO{
    try{
        return new PDO("mysql:$host;port=$port;dbname=$dbname", $username, $password);
    }catch(PDOException $e){
        db_panic($e);
    }
};
    define('CON', db_connect());
    