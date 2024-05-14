<?php
require_once MODEL . 'Model_Collection/update.php';
require_once MODEL . 'Model_Collection_album/insert.php';
require_once MODEL . 'Model_Collection_album/delete.php';
header('Content-Type: application/json; charset=utf-8');
require_once UTILS . 'serialize.php';
require_once DB_CONNECT;

parse_str(file_get_contents('php://input'), $_PUT);
CON->beginTransaction();
either_catch(\Model_Collection\update(
    CON
    , $_PUT['collection_id'] ?? exit(json_encode(['err'=>'not defined collection']))
    , $_PUT['collection_title']
));
$gen_r = $_POST['album_remove'] ?? [];
$gen_i = $_POST['album_insert'] ?? [];
foreach ($gen_i as $gen) 
    either_catch(\Model_Collection_albums\insert(CON, $_PUT['collection_id'], $gen));
foreach ($gen_r as $gen) 
    either_catch(\Model_Album_genre\delete(CON, $_PUT['collection_id'], $gen));
CON->commit();
return json_encode(['err'=>null]);