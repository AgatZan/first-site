<?php
namespace Model_User_base;

function update( \PDO $con
	, $user__name
	, $user__password = NULL
):\Either{
    $obj =[
        'user__name' => $user__name
		, 'user__password' => $user__password
    ];
    $obj = array_filter($obj);
    return update_dto($con, $obj);       
}
function update_dto(\PDO $con, $obj):\Either{
    $set = '';
    foreach($obj as $key=>$val)
        $set .= "`$key`=:$key,";
    $set = substr($set, 0, -1);
    $qu = $con->prepare("UPDATE `user_base` SET $set WHERE `user__name` = :user__name");
    $st = $qu->execute($obj);
    return !$st? new \Err(PASS_LOG_ERROR) : new \Ok('');
}
