<?php
require_once MODEL . 'Model_Album_genre/select.php';
require_once DB_CONNECT;
require_once UTILS . 'serialize.php';
return serialize_either(
    ['album__genre__id']
    , []
    ,\Model_Album_genre\select_templ(
        CON
        , '`album_genre`.`genre__id` as `album__genre__id`, `genre`.`genre__name` as `album__genre__name`'
        , 'LEFT JOIN(genre) ON `album_genre`.`genre__id`=`genre`.`genre__id`'
        , []
    )
);