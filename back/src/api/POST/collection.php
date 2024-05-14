<?php
require_once MODEL . 'Model_Collection/insert.php';
require_once MODEL . 'Model_Collection_album/insert.php';
header('Content-Type: application/json; charset=utf-8');
require_once UTILS . 'serialize.php';
require_once DB_CONNECT;
function get($key){
    if(!isset($_POST[$key])){
        http_response_code(400);
        CON->rollBack();
        exit(json_encode(['err'=>"$key not found"]));
    }
    return $_POST[$key];
}
CON->beginTransaction();
either_catch(\Model_Collection\insert(
    CON
    , get('collection_title')
));
$id = CON->lastInsertId();
either_catch(\Model_Collection_albums\insert(CON, $id, get('album_id')));
CON->commit();
return json_encode(['err'=>null]);