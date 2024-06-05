<?php
namespace Model_Collection_albums;
require_once realpath(__DIR__ . '/../Model_Collection/check');

require_once realpath(__DIR__ . '/../Model_Album/check');


function insert(\PDO $con
	, $collection__id
	, $album__id
):\Either{
    $obj = [
        'collection__id' => $collection__id
		, 'album__id' => $album__id
    ];
    $obj = array_filter($obj);
    return insert_dto($con, $obj);
}
function insert_dto(\PDO $con, $obj):\Either{ 
    if(! \Model_Collection\check_collection__id($con, $obj['collection__id']) )
		return ['status'=>ID_ERROR];
	if(! \Model_Album\check_album__id($con, $obj['album__id']) )
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
    if(! \Model_Collection\check_collection__id($con, $obj['collection__id']) )
		return ['status'=>ID_ERROR];
	if(! \Model_Album\check_album__id($con, $obj['album__id']) )
		return ['status'=>ID_ERROR];
	$set = '';
    $inset = str_repeat('(?,?)', $count);
	$qu = $con->prepare("INSERT INTO `message` ($set) 
        VALUES $inset
    ");
    $st = $qu->execute($obj);
    return  !$st? new \Err(ID_ERROR) : new \Ok($obj);
}
