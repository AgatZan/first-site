<?php
header('Content-Type: application/json; charset=utf-8');
require_once MODEL . 'Model_Genre/select.php';
require_once DB_CONNECT;
require_once UTILS . 'serialize.php';
$id = array_pop(explode('/', $_SERVER['REQUEST_URI']));
return serialize_either(\Model_Genre\select_id(CON, $id));