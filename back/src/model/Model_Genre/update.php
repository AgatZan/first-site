<?php
namespace Model_Genre;

function update( \PDO $con
	, $genre_id
	, $genre_name = NULL
):\Either{
    $obj =[
        'genre_id' => $genre_id
		, 'genre_name' => $genre_name
    ];
    $obj = array_filter($obj);
    return update_dto($con, $obj);       
}
function update_dto(\PDO $con, $obj):\Either{
    $set = '';
    foreach($obj as $key=>$val)
        $set .= "`$key`=:$key,";
    $set = substr($set, 0, -1);
    $qu = $con->prepare("UPDATE `genre` SET $set WHERE `genre_id` = :genre_id");
    $st = $qu->execute($obj);
    return !$st? new \Err(PASS_LOG_ERROR) : new \Ok('');
}
