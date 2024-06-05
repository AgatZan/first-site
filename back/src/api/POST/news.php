<?php
require_once MODEL . 'Model_News/insert.php';
require_once MODEL . 'Model_News/addon.php';
require_once UTILS . 'serialize.php';
require_once UTILS . 'deserialize.php';
require_once DB_CONNECT;
function err($err){
    http_response_code(400);
    CON->rollBack();
    exit(json_encode(['err'=>$err]));
}
function get($key){
    if(isset($_POST[$key])) return $_POST[$key];
    err("$key not found");
}
CON->beginTransaction();
either_catch(\Model_News\insert(
    CON
    , get('news__path')
    , get('news__title')
    , deserialize_file('cover')
    , get('text')
));
$page_name = $_SERVER['DOCUMENT_ROOT'] ."/static/". $_POST['news__path'];
\Model_News\addon_create_hp(
    $_POST['news__title']
    , $_POST['news__text']
    , $page_name
);
CON->commit();
return json_encode(['err'=>null]);