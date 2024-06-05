<?php
require_once MODEL . 'Model_Song_genre/select.php';
require_once DB_CONNECT;
require_once UTILS . 'serialize.php';
return serialize_either(
    ['album__genre__id']
    , []
    ,\Model_Song_genre\select_templ(
        CON
        , '`song_genre`.`genre__id` as `song__genre__id`, `genre`.`genre__name` as `song__genre__name`'
        , 'LEFT JOIN(genre) ON `song_genre`.`genre__id`=`genre`.`genre__id`'
        , []
    )
);