<?php
namespace Model_Album;

function insert(\PDO $con
	, $album__name
	, $album__price
	, $album__discount
	, $album__type
	, $album__remains
	, $album__cover
	, $album__estimation
	, $album__genre__id
	, $album__genre__name
	, $album__author__id
	, $album__author__name
	, $album__song__id
	, $album__song__name
	, $album__song__genre__id
	, $album__song__genre__name
	, $album__release_date = NULL
):\Either{
    $obj = [
        'album__name' => $album__name
		, 'album__price' => $album__price
		, 'album__discount' => $album__discount
		, 'album__type' => $album__type
		, 'album__remains' => $album__remains
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
		, 'album__release_date' => $album__release_date
    ];
    $obj = array_filter($obj);
    return insert_dto($con, $obj);
}
function insert_dto(\PDO $con, $obj):\Either{ 
    $set = '';
    $inset = '';
    foreach($obj as $key=>$val){
        $set .= "$key,";
        $inset .= ":$key,";
    }
    $set = substr($set, 0, -1);
    $inset = substr($inset, 0, -1);
	$qu = $con->prepare("INSERT INTO `message` ($set) 
        VALUES ($inset)
    ");
    $st = $qu->execute($obj);
    return  !$st? new \Err(ID_ERROR) : new \Ok($obj);
}
function insert_many(\PDO $con, $count, $obj){
    $set = '';
    $inset = str_repeat('(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', $count);
	$qu = $con->prepare("INSERT INTO `message` ($set) 
        VALUES $inset
    ");
    $st = $qu->execute($obj);
    return  !$st? new \Err(ID_ERROR) : new \Ok($obj);
}
