<?php
header('Content-Type: application/json; charset=utf-8');
require_once MODEL . 'Model_User_album/select.php';
require_once DB_CONNECT;
require_once UTILS . 'serialize.php';
return serialize_either(\Model_User_album\select_templ(
    CON
    , '`album`.*', 'LEFT JOIN(`album`) ON `user_album`.`album_id`=`album`.`album_id WHERE `user_album`.`user_name`=?'
    , [$_GET['user']]
    )
);