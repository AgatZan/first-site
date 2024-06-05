<?php
namespace Model_Song_genre;

function update( \PDO $con
	, $song__id
	, $genre__id
):\Either{
    $obj =[
        'song__id' => $song__id
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
    $qu = $con->prepare("UPDATE `song_genre` SET $set WHERE `song__id` = :song__id, `genre__id` = :genre__id");
    $st = $qu->execute($obj);
    return !$st? new \Err(PASS_LOG_ERROR) : new \Ok('');
}
