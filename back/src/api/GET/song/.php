<?php
require_once MODEL . 'Model_Song/select.php';
require_once DB_CONNECT;
require_once UTILS . 'serialize.php';
return serialize_either(
    ['song__id', 'song__genre__id']
    ,[]
    , \Model_Song\select(CON, $_GET['from']??0, $_GET['count']??1000)
);