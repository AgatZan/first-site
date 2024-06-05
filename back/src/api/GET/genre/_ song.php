<?php
require_once MODEL . 'Model_Song/select.php';
require_once DB_CONNECT;
require_once UTILS . 'serialize.php';
$id = explode('/', $_SERVER['REQUEST_URI'])[3];
return serialize_either(
    ['song__id', 'genre__id']
    , []
    , \Model_Song\select_where(CON,'`genre__id=?`', [$id])
);