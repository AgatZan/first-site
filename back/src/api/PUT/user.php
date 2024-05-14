<?php
require_once MODEL . 'Model_User/update.php';
header('Content-Type: application/json; charset=utf-8');
require_once UTILS . 'serialize.php';
require_once DB_CONNECT;

parse_str(file_get_contents('php://input'), $_PUT);
CON->beginTransaction();
either_catch(\Model_User\update(
    CON
    , $_PUT['user_name']
    , password_hash($_POST['user_password'], PASSWORD_BCRYPT)
));
CON->commit();
return json_encode(['err'=>null]);