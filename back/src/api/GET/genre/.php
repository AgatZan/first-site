<?php
require_once MODEL . 'Model_Genre/select.php';
require_once DB_CONNECT;
require_once UTILS . 'serialize.php';
return serialize_either(
    ['genre__id']
    , []
    ,\Model_Genre\select(CON, 0));