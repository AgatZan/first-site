<?php
namespace Model_Collection;

function update( \PDO $con
	, $collection__id
	, $collection__name = NULL
):\Either{
    $obj =[
        'collection__id' => $collection__id
		, 'collection__name' => $collection__name
    ];
    $obj = array_filter($obj);
    return update_dto($con, $obj);       
}
function update_dto(\PDO $con, $obj):\Either{
    $set = '';
    foreach($obj as $key=>$val)
        $set .= "`$key`=:$key,";
    $set = substr($set, 0, -1);
    $qu = $con->prepare("UPDATE `collection` SET $set WHERE `collection__id` = :collection__id");
    $st = $qu->execute($obj);
    return !$st? new \Err(PASS_LOG_ERROR) : new \Ok('');
}
