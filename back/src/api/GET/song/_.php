<?php
require_once MODEL . 'Model_Song/select.php';
require_once DB_CONNECT;
require_once UTILS . 'serialize.php';
$id = array_pop(explode('/', $_SERVER['REQUEST_URI']));
return serialize_either(
    ['song__id', 'song__genre__id']
    , []
    ,\Model_Song\select_id(CON, $id));