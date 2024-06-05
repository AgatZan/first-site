<?php
require_once MODEL . 'Model_Collection/select.php';
require_once DB_CONNECT;
require_once UTILS . 'serialize.php';
return serialize_either(
    ['collection__id', 'album__id', 'album__genre__id', 'album__author__id', 'album__song__id', 'album__song__genre__id']
    , []
    , \Model_Collection\select_templ(
        CON
        , 'collection.collection__id, collection.collection__title, album.*'
        , 'LEFT JOIN(collection_album, album) ON collection.collection__id=collection_album.collection__id AND collection_album.album__id=album.album__id'
        , null
    )
);