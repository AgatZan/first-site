<?php
require_once MODEL . 'Model_Album/select.php';
require_once DB_CONNECT;
require_once UTILS . 'serialize.php';
return serialize_either(
    ['album__id', 'album__genre__id', 'album__author__id', 'album__song__id', 'album__song__genre__id']
    , []
    ,\Model_Album\select_where(
        CON
        , 'album__id IN ('
        . str_repeat('?', count($_GET['id']))
        . '? )'
        , [$_GET['id']]
    )
);