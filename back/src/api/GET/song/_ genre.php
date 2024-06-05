<?php
require_once MODEL . 'Model_Song_genre/select.php';
require_once MODEL . 'Model_Genre/select.php';
require_once DB_CONNECT;
require_once UTILS . 'serialize.php';
$id = explode('/', $_SERVER['REQUEST_URI'])[3];
return serialize_either(
    ['song__id']
    ,[]
    ,\Model_Song_genre\select_templ(CON
        , 'song_genre.*, genre__name'
        , 'LEFT JOIN(`genre`) ON `song_genre`.`genre__id`=`genre`.`genre__id` WHERE `song__id`=?'
        , null
    )
);