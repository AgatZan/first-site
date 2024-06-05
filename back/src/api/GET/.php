<?php
    require_once DB_CONNECT;
    require_once UTILS . 'serialize.php';
    require_once UTILS . 'deserialize.php';
    if($_GET['format']=='song'){
        require_once MODEL . 'Model_Song/select.php';
        $select_where = '\\Model_Song\\select_where';
        $id = ['song__id', 'song__genre__id', 'album__id'];
        $unique = [];
        $tag_id = 'song__genre__id';
        $estimation = 'song__estimation';
    } else{
        require_once MODEL . 'Model_Album/select.php';
        $select_where = '\\Model_Album\\select_where';
        $id = ['album__id','album__genre__id','album__author__id','album__song__id','album__song__genre__id'];
        $unique = [];
        $tag_id = 'album__genre__id';
        $where = '`album__type`=?';
        $param = [$_GET['format']];
        $estimation = 'album__estimation';
    }
if(isset($_GET['tags'])){
    $where .= $tag_id . ' IN (' . str_repeat(',?',strlen($binarBig)-1) . ')';
    array_merge(
        $param
        , explode(
            delzo(
                $_GET['tags']
            )
            ,','
        )
    );
}
if($_GET['sort']=='random') $where .= 'ORDER BY RAND()';
elseif($_GET['sort']=='popular') $where .= 'ORDER BY ' . $estimation;
return serialize_either(
    $id
    , $unique
    , $select_where(
        CON
        , $where
        , $param
    )
);