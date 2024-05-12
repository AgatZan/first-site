<?php
namespace Model_User;

function update( \PDO $con
	, $user_id
	, $user_name = NULL
	, $user_password = NULL
):\Either{
    $obj =[
        'user_id' => $user_id
		, 'user_name' => $user_name
		, 'user_password' => $user_password
    ];
    $obj = array_filter($obj);
    return update_dto($con, $obj);       
}
function update_dto(\PDO $con, $obj):\Either{
    $set = '';
    foreach($obj as $key=>$val)
        $set .= "`$key`=:$key,";
    $set = substr($set, 0, -1);
    $qu = $con->prepare("UPDATE `user` SET $set WHERE `user_id` = :user_id");
    $st = $qu->execute($obj);
    return !$st? new \Err(PASS_LOG_ERROR) : new \Ok('');
}
