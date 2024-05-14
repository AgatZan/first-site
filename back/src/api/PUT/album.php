<?php
require_once MODEL . 'Model_Album_base/update.php';
require_once MODEL . 'Model_Album_genre/insert.php';
require_once MODEL . 'Model_Album_genre/delete.php';
header('Content-Type: application/json; charset=utf-8');
require_once UTILS . 'serialize.php';
require_once DB_CONNECT;

parse_str(file_get_contents('php://input'), $_PUT);
CON->beginTransaction();
either_catch(\Model_Album_base\update(
    CON
    , $_PUT['album_id'] ?? exit(json_encode(['err'=>'not defined album'])) 
    , $_PUT['author_id'] ?? exit(json_encode(['err'=>'not defined author']))
    , $_PUT['album_name']
    , $_PUT['album_type'] 
));
$gen_r = $_POST['genre_remove'] ?? [];
$gen_i = $_POST['genre_insert'] ?? [];
foreach ($gen_i as $gen) 
    either_catch(\Model_Album_genre\insert(CON, $_PUT['album_id'], $gen));
foreach ($gen_r as $gen) 
    either_catch(\Model_Album_genre\delete(CON, $_PUT['album_id'], $gen));
CON->commit();
return json_encode(['err'=>null]);