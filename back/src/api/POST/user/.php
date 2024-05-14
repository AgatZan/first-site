<?php
require_once MODEL . 'Model_User/insert.php';
header('Content-Type: application/json; charset=utf-8');
require_once UTILS . 'serialize.php';
require_once DB_CONNECT;
function get($key){
    if(!isset($_POST[$key])){
        http_response_code(400);
        CON->rollBack();
        exit(json_encode(['err'=>"$key not found"]));
    }
    return $_POST[$key];
}
CON->beginTransaction();
either_catch(\Model_User\insert(
    CON
    , get('user_name')
    , password_hash(get('user_password'), PASSWORD_BCRYPT)
));
CON->commit();
$_SESSION['user_name'] = $_POST['user_name'];
return json_encode(['err'=>null]);