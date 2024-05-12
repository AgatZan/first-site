<?php
namespace Model_Album_base;

require_rel(__DIR__,'../Model_Author/check');


function insert(\PDO $con
	, $album_name
	, $album_type $album_creator
	,
	, $album_release_date = NULL
):\Either{
    $obj = [
        'album_name' => $album_name
		, 'album_type' => $album_type
		, 'album_creator' => $album_creator
		, 'album_release_date' => $album_release_date
    ];
    $obj = array_filter($obj);
    return insert_dto($con, $obj);
}
function insert_dto(\PDO $con, $obj):\Either{ 
    if(! \Model_Author\check_album_creator($con, $obj['album_creator']) )
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
