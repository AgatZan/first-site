<?php
if(isset($_SESSION['user__name']))
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
    if(!password_verify(get('user__password'), $val['user__password']))
    $_SESSION['user__name'] = $val['user__name'];
    exit(json_encode(['err'=>null]));
});