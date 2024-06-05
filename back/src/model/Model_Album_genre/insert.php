<?php
namespace Model_Album_genre;
require_once realpath(__DIR__ . '/../Model_Album_base/check');

require_once realpath(__DIR__ . '/../Model_Genre/check');


function insert(\PDO $con
	, $album__id
	, $genre__id
):\Either{
    $obj = [
        'album__id' => $album__id
		, 'genre__id' => $genre__id
    ];
    $obj = array_filter($obj);
    return insert_dto($con, $obj);
}
function insert_dto(\PDO $con, $obj):\Either{ 
    if(! \Model_Album_base\check_album__id($con, $obj['album__id']) )
		return ['status'=>ID_ERROR];
	if(! \Model_Genre\check_genre__id($con, $obj['genre__id']) )
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
    if(! \Model_Album_base\check_album__id($con, $obj['album__id']) )
		return ['status'=>ID_ERROR];
	if(! \Model_Genre\check_genre__id($con, $obj['genre__id']) )
		return ['status'=>ID_ERROR];
	$set = '';
    $inset = str_repeat('(?,?)', $count);
	$qu = $con->prepare("INSERT INTO `message` ($set) 
        VALUES $inset
    ");
    $st = $qu->execute($obj);
    return  !$st? new \Err(ID_ERROR) : new \Ok($obj);
}
