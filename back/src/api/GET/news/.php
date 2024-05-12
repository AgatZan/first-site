<?php
header('Content-Type: application/json; charset=utf-8');
require_once MODEL . 'Model_News/select.php';
require_once DB_CONNECT;
require_once UTILS . 'serialize.php';
return serialize_either(\Model_News\select(CON, 0, $_GET['count']??5));