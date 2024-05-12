<?php
header('Content-Type: application/json; charset=utf-8');
require_once MODEL . 'Model_Author/select.php';
require_once DB_CONNECT;
require_once UTILS . 'serialize.php';
return serialize_either(\Model_Author\select(CON, 0));