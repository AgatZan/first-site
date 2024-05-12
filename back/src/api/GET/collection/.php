<?php
header('Content-Type: application/json; charset=utf-8');
require_once MODEL . 'Model_Collection/select.php';
require_once DB_CONNECT;
require_once UTILS . 'serialize.php';
return serialize_either(\Model_Collection\select_templ(
    CON
    , 'collection.id, collection.title, album.*'
    , 'LEFT JOIN(collection_album, album) ON collection.id=collection_album.collection.id AND collection_album.album_id=album.album_id'
    , null
    )
);