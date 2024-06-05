<?php
    require_once MODEL . 'Model_News/update.php';
    require_once MODEL . 'Model_News/select.php';
    require_once MODEL . 'Model_News/addon.php';
    require_once DB_CONNECT;
    require_once UTILS . 'serialize.php';
    require_once UTILS . 'deserialize.php';
   
    parse_str(file_get_contents('php://input'), $_PATCH);
    either_catch(
        \Model_News\update(
            CON
            , $_PATCH['news__id'] ?? exit(json_encode(['err'=>'not defined collection']))
            , $_PATCH['news__path']
            , $_PATCH['news__name']
            , isset($_PATCH['news__cover_path'])? deserialize_file($_PATCH['news__cover__path']) : null
            , $_PATCH['news__text']
        )
    );
    if(isset($_PATCH['news__path'])){
        \Model_News\addon_create_hp(
            $_PATCH['news__name'] ?? ($old = \Model_News\select_id(CON,$_PATCH['news__id'])->val)['news__name']
            , $_PATCH['news__text'] ?? $old['news__text'] ?? ($old = \Model_News\select_id(CON,$_PATCH['news__id'])->val)['news__text']
            , $_PATCH['news__path']
        );
    }else{
        \Model_News\addon_create_hp(
            $_PATCH['news__name'] ?? ($old = \Model_News\select_id(CON,$_PATCH['news__id'])->val)['news__name']
            , $_PATCH['news__text'] ?? $old['news__text'] ?? ($old = \Model_News\select_id(CON,$_PATCH['news__id'])->val)['news__text']
            , $_PATCH['news__path']
            , true
        );
    }
    return json_encode(['err'=>null]);
