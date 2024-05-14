<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
if(isset($_SESSION['user_name']))
exit(json_encode(['err'=>null]));

require_once MODEL . 'Model_User/select.php';
require_once UTILS . 'serialize.php';
require_once DB_CONNECT;
function get($key){
    if(!isset($_POST[$key])){
        http_response_code(400);
        exit(json_encode(['err'=>"$key not found"]));
    }
    return $_POST[$key];
}
either_catch(\Model_User\select_id(CON, [get('user_name')]))
->unpack(function($val){
    if(!password_verify(get('user_password'), $val['user_password']))
    $_SESSION['user_name'] = $val['user_name'];
    exit(json_encode(['err'=>null]));
});