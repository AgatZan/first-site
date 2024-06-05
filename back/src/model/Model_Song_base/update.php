<?php
namespace Model_Song_base;

function update( \PDO $con
	, $song__id
	, $song__name = NULL
	, $song__path = NULL
	, $album__id = NULL
):\Either{
    $obj =[
        'song__id' => $song__id
		, 'song__name' => $song__name
		, 'song__path' => $song__path
		, 'album__id' => $album__id
    ];
    $obj = array_filter($obj);
    return update_dto($con, $obj);       
}
function update_dto(\PDO $con, $obj):\Either{
    $set = '';
    foreach($obj as $key=>$val)
        $set .= "`$key`=:$key,";
    $set = substr($set, 0, -1);
    $qu = $con->prepare("UPDATE `song_base` SET $set WHERE `song__id` = :song__id");
    $st = $qu->execute($obj);
    return !$st? new \Err(PASS_LOG_ERROR) : new \Ok('');
}
