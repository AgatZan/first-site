<?php
require_once MODEL . 'Model_News/select.php';
require_once DB_CONNECT;
require_once UTILS . 'serialize.php';
return serialize_either(
    ['news__id']
    , []
    , \Model_News\select(CON, 0, $_GET['count']??5));