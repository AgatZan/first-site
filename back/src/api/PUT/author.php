<?php
require_once MODEL . 'Model_Author/update.php';
header('Content-Type: application/json; charset=utf-8');
require_once UTILS . 'serialize.php';
require_once DB_CONNECT;

parse_str(file_get_contents('php://input'), $_PUT);
CON->beginTransaction();
either_catch(\Model_Author\update(
    CON
    , $_PUT['author_id']
    , $_PUT['author_name']
    , $_PUT['author_page']
));
CON->commit();
return json_encode(['err'=>null]);