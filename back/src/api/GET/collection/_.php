<?php
require_once MODEL . 'Model_News/select.php';
require_once DB_CONNECT;
require_once UTILS . 'serialize.php';
$id = array_pop(explode('/', $_SERVER['REQUEST_URI']));
return serialize_either(
    ['collection__id']
    , []
    , \Model_Collection\select_templ(
        CON
        , 'collection.collection__id, collection.collection__title, album.*'
        , 'LEFT JOIN(collection_album, album) 
        ON collection.collection__id=collection_album.collection__id 
        AND collection_album.album__id=album.album__id 
        WHERE collection.collection__id=?
    '   , [$id]
    )
);