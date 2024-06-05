<?php
namespace Model_Album_estimation;

function update( \PDO $con
	, $estimation__id
	, $album__id
	, $estimation = NULL
):\Either{
    $obj =[
        'estimation__id' => $estimation__id
		, 'album__id' => $album__id
		, 'estimation' => $estimation
    ];
    $obj = array_filter($obj);
    return update_dto($con, $obj);       
}
function update_dto(\PDO $con, $obj):\Either{
    $set = '';
    foreach($obj as $key=>$val)
        $set .= "`$key`=:$key,";
    $set = substr($set, 0, -1);
    $qu = $con->prepare("UPDATE `album_estimation` SET $set WHERE `estimation__id` = :estimation__id, `album__id` = :album__id");
    $st = $qu->execute($obj);
    return !$st? new \Err(PASS_LOG_ERROR) : new \Ok('');
}
