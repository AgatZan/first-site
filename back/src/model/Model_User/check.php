<?php
namespace Model_User;

function check(\PDO $con, $where, $what):bool{
    $qu = $con->prepare("SELECT *  FROM `user` WHERE $where");
    $qu->execute($what);
    $obj = $qu->fetchAll(\PDO::FETCH_ASSOC);
    return boolval($obj);
}
function check_user_name($con, $user_name){
	return check($con,"`user_name`=?`", $user_name);
}
