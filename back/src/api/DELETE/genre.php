<?php
require_once MODEL . 'Model_Genre/delete.php';
require_once UTILS . 'serialize.php';
require_once DB_CONNECT;

parse_str(file_get_contents('php://input'), $_DELETE);


either_catch(
    \Model_Genre\delete(CON, $_DELETE['genre__id'])
);
return json_encode(['err'=>null]);
