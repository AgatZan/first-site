<?php
namespace Model_Album_base;

function update( \PDO $con
	, $album__id
	, $album__name = NULL
	, $album__type = NULL
	, $album__author__id = NULL
	, $album__release_date = NULL
	, $album__cover = NULL
	, $album__price = NULL
	, $album__discount = NULL
	, $album__remains = NULL
):\Either{
    $obj =[
        'album__id' => $album__id
		, 'album__name' => $album__name
		, 'album__type' => $album__type
		, 'album__author__id' => $album__author__id
		, 'album__release_date' => $album__release_date
		, 'album__cover' => $album__cover
		, 'album__price' => $album__price
		, 'album__discount' => $album__discount
		, 'album__remains' => $album__remains
    ];
    $obj = array_filter($obj);
    return update_dto($con, $obj);       
}
function update_dto(\PDO $con, $obj):\Either{
    $set = '';
    foreach($obj as $key=>$val)
        $set .= "`$key`=:$key,";
    $set = substr($set, 0, -1);
    $qu = $con->prepare("UPDATE `album_base` SET $set WHERE `album__id` = :album__id");
    $st = $qu->execute($obj);
    return !$st? new \Err(PASS_LOG_ERROR) : new \Ok('');
}
