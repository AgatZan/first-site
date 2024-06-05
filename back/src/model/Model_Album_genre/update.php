<?php
namespace Model_Album_genre;

function update( \PDO $con
	, $album__id
	, $genre__id
):\Either{
    $obj =[
        'album__id' => $album__id
		, 'genre__id' => $genre__id
		,
    ];
    $obj = array_filter($obj);
    return update_dto($con, $obj);       
}
function update_dto(\PDO $con, $obj):\Either{
    $set = '';
    foreach($obj as $key=>$val)
        $set .= "`$key`=:$key,";
    $set = substr($set, 0, -1);
    $qu = $con->prepare("UPDATE `album_genre` SET $set WHERE `album__id` = :album__id, `genre__id` = :genre__id");
    $st = $qu->execute($obj);
    return !$st? new \Err(PASS_LOG_ERROR) : new \Ok('');
}
