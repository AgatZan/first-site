<?php
header('Content-Type: application/json; charset=utf-8');
require_once MODEL . 'Model_Album/select.php';
require_once DB_CONNECT;
require_once UTILS . 'serialize.php';
$id = explode('/', $_SERVER['REQUEST_URI'])[3];
return serialize_either(
    \Model_Album\select_where(CON,'`album_genre_id=?`', [$id])
);