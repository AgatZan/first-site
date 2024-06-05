<?php
require_once MODEL . 'Model_Album_base/insert.php';
require_once MODEL . 'Model_Album_genre/insert.php';

require_once UTILS . 'serialize.php';
require_once UTILS . 'deserialize.php';
require_once DB_CONNECT;
function err($err){
    http_response_code(400);
    CON->rollBack();
    exit(json_encode(['err'=>$err]));
}
function get($key){
    if(isset($_POST[$key])) return $_POST[$key];
    err("$key not found");
}
CON->beginTransaction();
either_catch(\Model_Album_base\insert(
    CON
    , get('album__name')
    , get('album__type')
    , get('album__author__id')
    , deserialize_file('cover')
    , get('album__price')
    , $_POST['album__remains'] ?? 0
    , $_POST['album__release_date'] ?? null
    , $_POST['album__discount'] ?? 0
));
$id = CON->lastInsertId();
$genres = array_reduce(explode(delzo($_POST['album__genre__id']), ','), function($acc,$n) use($id){
    $acc[]=$id; 
    $acc[]=$n;
}, []) ?? [];
if(!empty($genres)) either_catch(\Model_Album_genre\insert_many(CON, count($genres), $genres));

$songs = array_reduce(explode(delzo($_POST['album__song__id']), ','), function($acc,$n) use($id){
    $acc[]=$id; 
    $acc[]=$n;
}, []) ?? [];
if(!empty($songs)) either_catch(\Model_Album_genre\insert_many(CON, count($genres), $genres));
CON->commit();
return json_encode(['err'=>null]);