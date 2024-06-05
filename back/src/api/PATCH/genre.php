<?php
    require_once MODEL . 'Model_Genre/update.php';
    require_once DB_CONNECT;
    require_once UTILS . 'serialize.php';
   
    parse_str(file_get_contents('php://input'), $_PATCH);
    either_catch(
        \Model_Genre\update(
            CON
            , $_PATCH['genre__id'] ?? exit(json_encode(['err'=>'not defined collection']))
            , $_PATCH['genre__name']
        )
    );
    return json_encode(['err'=>null]);
