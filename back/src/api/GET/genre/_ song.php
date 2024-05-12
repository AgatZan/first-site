<?php
header('Content-Type: application/json; charset=utf-8');
require_once MODEL . 'Model_Song/select.php';
require_once DB_CONNECT;
require_once UTILS . 'serialize.php';
$id = explode('/', $_SERVER['REQUEST_URI'])[3];
return serialize_either(
    \Model_Song\select_where(CON,'`genre_id=?`', [$id])
);