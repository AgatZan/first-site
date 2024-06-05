<?php
require_once MODEL . 'Model_User_base/delete.php';
require_once UTILS . 'serialize.php';
require_once DB_CONNECT;

parse_str(file_get_contents('php://input'), $_DELETE);


either_catch(
    \Model_User_base\delete(CON, $_DELETE['user__name'])
);
return json_encode(['err'=>null]);
