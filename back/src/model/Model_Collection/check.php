<?php
namespace Model_Collection;

function check(\PDO $con, $where, $what):bool{
    $qu = $con->prepare("SELECT *  FROM `collection` WHERE $where");
    $qu->execute($what);
    $obj = $qu->fetchAll(\PDO::FETCH_ASSOC);
    return boolval($obj);
}
function check_collection__id($con, $collection__id){
	return check($con,"`collection__id`=?`", $collection__id);
}
