<?php
namespace Model_Collection;

function update( \PDO $con
	, $collection_id
	, $collection_title = NULL
):\Either{
    $obj =[
        'collection_id' => $collection_id
		, 'collection_title' => $collection_title
    ];
    $obj = array_filter($obj);
    return update_dto($con, $obj);       
}
function update_dto(\PDO $con, $obj):\Either{
    $set = '';
    foreach($obj as $key=>$val)
        $set .= "`$key`=:$key,";
    $set = substr($set, 0, -1);
    $qu = $con->prepare("UPDATE `collection` SET $set WHERE `collection_id` = :collection_id");
    $st = $qu->execute($obj);
    return !$st? new \Err(PASS_LOG_ERROR) : new \Ok('');
}
