<?php
require_once MODEL . 'Model_Author/insert.php';
require_once MODEL . 'Model_Author/addons.php';
require_once MODEL . 'Model_Album/select.php';
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
either_catch(\Model_Author\insert(
    CON
    , get('author_name')
    , get('author_page')
));
$page_name = "../../../../static/". $_POST['author_page'];
\Model_Author\addon_create_hp(
    $_POST['author_name']
    , $page_name
);
CON->commit();
return json_encode(['err'=>null]);