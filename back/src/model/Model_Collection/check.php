<?php
namespace Model_Collection;

function check(\PDO $con, $where, $what):bool{
    $qu = $con->prepare("SELECT *  FROM `collection` WHERE $where");
    $qu->execute($what);
    $obj = $qu->fetchAll(\PDO::FETCH_ASSOC);
    return boolval($obj);
}
function check_collection_id($con, $collection_id){
	return check($con,"`collection_id`=?`", $collection_id);
}
