<?php
namespace Model_Song_base;

function update( \PDO $con
	, $song_id
	, $album_id
	, $song_name = NULL
):\Either{
    $obj =[
        'song_id' => $song_id
		, 'album_id' => $album_id
		, 'song_name' => $song_name
    ];
    $obj = array_filter($obj);
    return update_dto($con, $obj);       
}
function update_dto(\PDO $con, $obj):\Either{
    $set = '';
    foreach($obj as $key=>$val)
        $set .= "`$key`=:$key,";
    $set = substr($set, 0, -1);
    $qu = $con->prepare("UPDATE `song_base` SET $set WHERE `song_id` = :song_id, `album_id` = :album_id");
    $st = $qu->execute($obj);
    return !$st? new \Err(PASS_LOG_ERROR) : new \Ok('');
}
