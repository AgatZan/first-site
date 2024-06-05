<?php
namespace Model_Album;

function update( \PDO $con
	, $album__id
	, $album__name = NULL
	, $album__price = NULL
	, $album__discount = NULL
	, $album__type = NULL
	, $album__remains = NULL
	, $album__release_date = NULL
	, $album__cover = NULL
	, $album__estimation = NULL
	, $album__genre__id = NULL
	, $album__genre__name = NULL
	, $album__author__id = NULL
	, $album__author__name = NULL
	, $album__song__id = NULL
	, $album__song__name = NULL
	, $album__song__genre__id = NULL
	, $album__song__genre__name = NULL
):\Either{
    $obj =[
        'album__id' => $album__id
		, 'album__name' => $album__name
		, 'album__price' => $album__price
		, 'album__discount' => $album__discount
		, 'album__type' => $album__type
		, 'album__remains' => $album__remains
		, 'album__release_date' => $album__release_date
		, 'album__cover' => $album__cover
		, 'album__estimation' => $album__estimation
		, 'album__genre__id' => $album__genre__id
		, 'album__genre__name' => $album__genre__name
		, 'album__author__id' => $album__author__id
		, 'album__author__name' => $album__author__name
		, 'album__song__id' => $album__song__id
		, 'album__song__name' => $album__song__name
		, 'album__song__genre__id' => $album__song__genre__id
		, 'album__song__genre__name' => $album__song__genre__name
    ];
    $obj = array_filter($obj);
    return update_dto($con, $obj);       
}
function update_dto(\PDO $con, $obj):\Either{
    $set = '';
    foreach($obj as $key=>$val)
        $set .= "`$key`=:$key,";
    $set = substr($set, 0, -1);
    $qu = $con->prepare("UPDATE `album` SET $set WHERE `album__id` = :album__id");
    $st = $qu->execute($obj);
    return !$st? new \Err(PASS_LOG_ERROR) : new \Ok('');
}
