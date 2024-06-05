<?php
require_once MODEL . 'Model_Album_estimation/insert.php';
require_once MODEL . 'Model_Album_genre/insert.php';

require_once UTILS . 'serialize.php';
require_once DB_CONNECT;
function get($key){
    if(!isset($_POST[$key])){
        http_response_code(400);
        exit(json_encode(['err'=>"$key not found"]));
    }
    return $_POST[$key];
}
either_catch(
    \Model_Album_estimation\insert(
        CON
        , get('album__id')
        , get('estimation')
    )
);