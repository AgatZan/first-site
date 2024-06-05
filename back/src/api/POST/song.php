<?php
// require_once MODEL . 'Model_Album_base/insert.php';
// require_once MODEL . 'Model_Album_genre/insert.php';
require_once MODEL . 'Model_Song_base/insert.php';
require_once MODEL . 'Model_Song_genre/insert.php';
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
$song_path = deserialize_audio(get('song__path'));
either_catch(\Model_Song_base\insert(
    CON
    , get('song__name')
    , $song_path
    , get('album__id')
));
$id = CON->lastInsertId();
$genres = array_reduce(explode(delzo($_POST['song__genre__id']), ','), function($acc,$n) use($id){
    $acc[]=$id; 
    $acc[]=$n;
}, []) ?? [];
if(!empty($genres)) either_catch(\Model_Song_genre\insert_many(CON, count($genres), $genres));
CON->commit();
return json_encode(['err'=>null]);