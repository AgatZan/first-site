<?php
require_once MODEL . 'Model_News/select.php';
require_once DB_CONNECT;
require_once UTILS . 'serialize.php';
$id = array_pop(explode('/', $_SERVER['REQUEST_URI']));
return serialize_either(
    ['news__id']
    ,[]
    , \Model_News\select_id(CON, $id));