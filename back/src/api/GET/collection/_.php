<?php
header('Content-Type: application/json; charset=utf-8');
require_once MODEL . 'Model_News/select.php';
require_once DB_CONNECT;
require_once UTILS . 'serialize.php';
$id = array_pop(explode('/', $_SERVER['REQUEST_URI']));
return serialize_either(\Model_Collection\select_templ(
    CON
    , 'collection.id, collection.title, album.*'
    , 'LEFT JOIN(collection_album, album) 
        ON collection.collection_id=collection_album.collection_id 
        AND collection_album.album_id=album.album_id 
        WHERE collection.collection_id=?
    ', [$id]
    )
);