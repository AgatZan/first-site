<?php
require_once MODEL . 'Model_Album_base/insert.php';
require_once MODEL . 'Model_Album_genre/insert.php';
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
either_catch(\Model_Album_base\insert(
    CON
    , get('album_name')
    , get('album_type')
    , get('author_id')
    , $_POST['album_release_date'] ?? null
));
$id = CON->lastInsertId();
$genres = $_POST['genre_id'] ?? [];
foreach ($genres as $genr) 
    either_catch(\Model_Album_genre\insert(CON, $id, $genr));
CON->commit();
return json_encode(['err'=>null]);