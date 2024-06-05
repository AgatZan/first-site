<?php
require_once MODEL . 'Model_Album_base/update.php';
require_once UTILS . 'serialize.php';
require_once UTILS . 'deserialize.php';
require_once DB_CONNECT;

parse_str(file_get_contents('php://input'), $_PATCH);
CON->beginTransaction();
either_catch(\Model_Album_base\update(
    CON
    , $_PATCH['album__id'] ?? exit(json_encode(['err'=>'not defined album']))
    , $_PATCH['album__name']
    , in_array($_PATCH['album__type'], ['album', 'ep', 'playlist','cd','mixtape','singles'])? $_PATCH['album__type'] : null
    , $_PATCH['author__id']
    , $_PATCH['album__release_date']
    , isset($_PATCH['cover'])? deserialize_file($_PATCH['cover']):null
    , $_PATCH['album__price']
    , $_PATCH['album__discount']
    , $_PATCH['album__remains']
));
return json_encode(['err'=>null]);