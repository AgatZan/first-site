<?php
require_once MODEL . 'Model_Album/select.php';
require_once DB_CONNECT;
require_once UTILS . 'serialize.php';
$id = array_pop(explode('/', $_SERVER['REQUEST_URI']));
return serialize_either(
    ['album__id', 'album__genre__id', 'album__author__id', 'album__song__id', 'album__song__genre__id']
    , []
    , \Model_Album\select_where(
        CON
        , "`author__id`=?"
        , [$id]
    )
);