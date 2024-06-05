<?php
require_once MODEL . 'Model_Collection/insert.php';
require_once MODEL . 'Model_Collection_album/insert.php';
require_once UTILS . 'serialize.php';
require_once UTILS . 'deserialize.php';
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
    , get('collection__title')
));
$id = CON->lastInsertId();
$albums = explode(delzo(get('album__id')),',');
$what = str_repeat("($id, ?)", count($albums));
either_catch(\Model_Collection_albums\insert(CON, $id, get('album__id')));
CON->commit();
return json_encode(['err'=>null]);