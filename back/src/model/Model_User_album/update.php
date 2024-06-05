<?php
namespace Model_User_album;

function update( \PDO $con
	, $user__name
	, $album__id
):\Either{
    $obj =[
        'user__name' => $user__name
		, 'album__id' => $album__id
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
    $qu = $con->prepare("UPDATE `user_album` SET $set WHERE `user__name` = :user__name, `album__id` = :album__id");
    $st = $qu->execute($obj);
    return !$st? new \Err(PASS_LOG_ERROR) : new \Ok('');
}
