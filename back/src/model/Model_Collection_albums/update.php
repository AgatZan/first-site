<?php
namespace Model_Collection_albums;

function update( \PDO $con
	, $collection_id
	, $album_id
):\Either{
    $obj =[
        'collection_id' => $collection_id
		, 'album_id' => $album_id
		,
    ];
    $obj = array_filter($obj);
    return update_dto($con, $obj);       
}
function update_dto(\PDO $con, $obj):\Either{
    $set = '';
    foreach($obj as $key=>$val)
        $set .= "`$key`=:$key,";
    $set = substr($set, 0, -1);
    $qu = $con->prepare("UPDATE `collection_albums` SET $set WHERE `collection_id` = :collection_id, `album_id` = :album_id");
    $st = $qu->execute($obj);
    return !$st? new \Err(PASS_LOG_ERROR) : new \Ok('');
}
