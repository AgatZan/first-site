<?php
    require_once MODEL . 'Model_Genre/insert.php';
    require_once DB_CONNECT;
    require_once UTILS . 'serialize.php';
    function err($err){
        http_response_code(400);
        exit(json_encode(['err'=>$err]));
    }
    function get($key){
        if(isset($_POST[$key])) return $_POST[$key];
        err("$key not found");
    }
    either_catch(
        \Model_Genre\insert(CON, get('genre__name'))
    );
    return json_encode(['err'=>null]);
