<?php
header('Content-Type: application/json; charset=utf-8');
require_once MODEL . 'Model_Song_genre/select.php';
require_once MODEL . 'Model_Genre/select.php';
require_once DB_CONNECT;
require_once UTILS . 'serialize.php';
$id = explode('/', $_SERVER['REQUEST_URI'])[3];
return serialize_either(
\Model_Song_genre\select_templ(CON
, 'song_genre.*, genre_name'
, 'LEFT JOIN(`genre`) ON `song_genre`.`genre_id`=`genre`.`genre_id` WHERE `song_id`=?'
, null)
);