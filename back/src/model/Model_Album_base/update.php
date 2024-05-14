<?php
namespace Model_Album_base;

function update( \PDO $con
	, $album_id
	, $author_id
	, $album_name = NULL
	, $album_type = NULL
):\Either{
    $obj =[
        'album_id' => $album_id
		, 'author_id' => $author_id
		, 'album_name' => $album_name
		, 'album_type' => $album_type
    ];
    $obj = array_filter($obj);
    return update_dto($con, $obj);       
}
function update_dto(\PDO $con, $obj):\Either{
    $set = '';
    foreach($obj as $key=>$val)
        $set .= "`$key`=:$key,";
    $set = substr($set, 0, -1);
    $qu = $con->prepare("UPDATE `album_base` SET $set WHERE `album_id` = :album_id, `author_id` = :author_id");
    $st = $qu->execute($obj);
    return !$st? new \Err(PASS_LOG_ERROR) : new \Ok('');
}
