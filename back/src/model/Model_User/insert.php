<?php
namespace Model_User;
require_once realpath(__DIR__ . '/../Model_Album/check');


function insert(\PDO $con
	, $user__password
	, $album__id
):\Either{
    $obj = [
        'user__password' => $user__password
		, 'album__id' => $album__id
    ];
    $obj = array_filter($obj);
    return insert_dto($con, $obj);
}
function insert_dto(\PDO $con, $obj):\Either{ 
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
