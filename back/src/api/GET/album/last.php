<?php
require_once MODEL . 'Model_Album/select.php';
require_once DB_CONNECT;
require_once UTILS . 'serialize.php';
$discount = $_GET['discount']? 'WHERE album__discount IS NOT NULL ':'';
return serialize_either(
    ['album__id', 'album__genre__id', 'album__author__id', 'album__song__id', 'album__song__genre__id']
    , []
    , \Model_Album\select_templ(
        CON
        , '*'
        , $discount . 'ORDER BY album__id DESC LIMIT ?'
        , [$_GET['count'] ?? 5]
    )
);