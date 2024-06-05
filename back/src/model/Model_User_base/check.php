<?php
namespace Model_User_base;

function check(\PDO $con, $where, $what):bool{
    $qu = $con->prepare("SELECT *  FROM `user_base` WHERE $where");
    $qu->execute($what);
    $obj = $qu->fetchAll(\PDO::FETCH_ASSOC);
    return boolval($obj);
}
function check_user__name($con, $user__name){
	return check($con,"`user__name`=?`", $user__name);
}
