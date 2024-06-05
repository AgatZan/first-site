<?php
namespace Model_Song;
require_once realpath(__DIR__ . '/../Model_Song_base/check');


function insert(\PDO $con
	, $song__id
	, $song__name
	, $song__path
	, $song__genre__id
	, $song__genre__name
	, $song__album__id
):\Either{
    $obj = [
        'song__id' => $song__id
		, 'song__name' => $song__name
		, 'song__path' => $song__path
		, 'song__genre__id' => $song__genre__id
		, 'song__genre__name' => $song__genre__name
		, 'song__album__id' => $song__album__id
    ];
    $obj = array_filter($obj);
    return insert_dto($con, $obj);
}
function insert_dto(\PDO $con, $obj):\Either{ 
    if(! \Model_Song_base\check_song__id($con, $obj['song__id']) )
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
    if(! \Model_Song_base\check_song__id($con, $obj['song__id']) )
		return ['status'=>ID_ERROR];
	$set = '';
    $inset = str_repeat('(?,?,?,?,?,?)', $count);
	$qu = $con->prepare("INSERT INTO `message` ($set) 
        VALUES $inset
    ");
    $st = $qu->execute($obj);
    return  !$st? new \Err(ID_ERROR) : new \Ok($obj);
}
