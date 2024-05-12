<?php
header('Content-type:application/json');
require_once MODEL . 'Model_Message/insert.php';
require_once UTILS . 'serialize.php';
require_once DB_CONNECT;

$id = array_pop(explode('/', $_SERVER['REQUEST_URI']));
exit(json_encode(['id'=>$id, 'POST'=>$_POST]));
// return serialize_either(
//     \Model_Message\insert(CON, $id, $_SESSION['userName'], $_POST['messageText'])
// );
