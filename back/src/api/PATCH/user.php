<?php
require_once MODEL . 'Model_User/update.php';
 require_once UTILS . 'serialize.php';
require_once DB_CONNECT;

parse_str(file_get_contents('php://input'), $_PATCH);
CON->beginTransaction();
either_catch(\Model_User\update(
    CON
    , $_PATCH['user_name'] ?? exit(json_encode(['err'=>'not defined album']))
    , isset($_PATCH['user__password'])?password_hash($_POST['user_password'], PASSWORD_BCRYPT):null
));
CON->commit();
return json_encode(['err'=>null]);