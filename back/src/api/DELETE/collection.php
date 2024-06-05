<?php
require_once MODEL . 'Model_Collection/delete.php';
require_once UTILS . 'serialize.php';
require_once DB_CONNECT;

parse_str(file_get_contents('php://input'), $_DELETE);


either_catch(
    \Model_Collection\delete(CON, $_DELETE['collection__id'])
);
return json_encode(['err'=>null]);
