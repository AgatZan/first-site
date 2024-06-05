<?php
require_once MODEL . 'Model_User_album/select.php';
require_once DB_CONNECT;
require_once UTILS . 'serialize.php';
return serialize_either(
    ['user__name', 'album__id', 'album__genre__id', 'album__author__id', 'album__song__id', 'album__song__genre__id']
    , []
    , \Model_User\select_templ(
        CON
        , 'user.user__name, `album`.*'
        , 'LEFT JOIN(`user_album`, `album`) ON `user`.`user__name` = user_album.user__name AND `user_album`.`album__id`=`album`.`album__id WHERE `user_album`.`user__name`=?'
        , [$_GET['user']]
    )
);