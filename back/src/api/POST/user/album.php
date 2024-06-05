<?php
require_once MODEL . 'Model_User_album/insert.php';
require_once UTILS . 'serialize.php';
require_once DB_CONNECT;
function get($cont,$key){
    if(!isset($cont[$key])){
        http_response_code(400);
        CON->rollBack();
        exit(json_encode(['err'=>"$key not found"]));
    }
    return $_POST[$key];
}
CON->beginTransaction();
either_catch(\Model_User_album\insert(
    CON
    , get($_SESSION,'user__name')
    , get($_POST, 'album__id')
));
CON->commit();
return json_encode(['err'=>null]);