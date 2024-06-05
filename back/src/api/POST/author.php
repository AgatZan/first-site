<?php
require_once MODEL . 'Model_Author/insert.php';
require_once MODEL . 'Model_Author/addons.php';
require_once MODEL . 'Model_Album/select.php';
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
    , get('author__name')
    , get('author__page')
));
$page_name = $_SERVER['DOCUMENT_ROOT'] ."/static/". $_POST['author_page'];
\Model_Author\addon_create_hp(
    $_POST['author__name']
    , $_POST['author__page']
);
CON->commit();
return json_encode(['err'=>null]);