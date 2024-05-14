<?php
namespace Model_Album_estimation;
require_once realpath(__DIR__ . '/../Model_Album/check');


function insert(\PDO $con
	, $album_id
	, $estimation
):\Either{
    $obj = [
        'album_id' => $album_id
		, 'estimation' => $estimation
    ];
    $obj = array_filter($obj);
    return insert_dto($con, $obj);
}
function insert_dto(\PDO $con, $obj):\Either{ 
    if(! \Model_Album\check_album_id($con, $obj['album_id']) )
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
