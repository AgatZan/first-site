<?php
namespace Model_Album_base;
require_once realpath(__DIR__ . '/../Model_Author/check');


function insert(\PDO $con
	, $album__name
	, $album__type
	, $album__author__id
	, $album__cover
	, $album__price
	, $album__remains
	, $album__release_date = NULL
	, $album__discount = NULL
):\Either{
    $obj = [
        'album__name' => $album__name
		, 'album__type' => $album__type
		, 'album__author__id' => $album__author__id
		, 'album__cover' => $album__cover
		, 'album__price' => $album__price
		, 'album__remains' => $album__remains
		, 'album__release_date' => $album__release_date
		, 'album__discount' => $album__discount
    ];
    $obj = array_filter($obj);
    return insert_dto($con, $obj);
}
function insert_dto(\PDO $con, $obj):\Either{ 
    if(! \Model_Author\check_album__author__id($con, $obj['album__author__id']) )
		return ['status'=>ID_ERROR];
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
    if(! \Model_Author\check_album__author__id($con, $obj['album__author__id']) )
		return ['status'=>ID_ERROR];
	$set = '';
    $inset = str_repeat('(?,?,?,?,?,?,?,?)', $count);
	$qu = $con->prepare("INSERT INTO `message` ($set) 
        VALUES $inset
    ");
    $st = $qu->execute($obj);
    return  !$st? new \Err(ID_ERROR) : new \Ok($obj);
}
