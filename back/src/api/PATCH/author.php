<?php
require_once MODEL . 'Model_Author/update.php';
require_once MODEL . 'Model_Author/select.php';
require_once MODEL . 'Model_Author/addon.php';
 require_once UTILS . 'serialize.php';
require_once DB_CONNECT;

parse_str(file_get_contents('php://input'), $_PATCH);
CON->beginTransaction();
either_catch(\Model_Author\update(
    CON
    , $_PATCH['author__id'] ?? exit(json_encode(['err'=>'not defined album']))
    , $_PATCH['author__name']
    , $_PATCH['author__page']
));
CON->commit();

if(isset($_PATCH['author__page']))
    \Model_Author\addon_create_hp(
        $_PATCH['author__name'] ?? \Model_Author\select_id(CON, $_PATCH['author__id'])->val['author__name']
        , $_PATCH['author__page']
    );
elseif(isset($_PATCH['author__name']))
\Model_Author\addon_create_hp(
    $_PATCH['author__name'] 
    , $_PATCH['author__page'] ?? \Model_Author\select_id(CON, $_PATCH['author__id'])->val['author__page']
    , true
);
return json_encode(['err'=>null]);