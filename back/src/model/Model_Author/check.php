<?php
namespace Model_Author;

function check(\PDO $con, $where, $what):bool{
    $qu = $con->prepare("SELECT *  FROM `author` WHERE $where");
    $qu->execute($what);
    $obj = $qu->fetchAll(\PDO::FETCH_ASSOC);
    return boolval($obj);
}
function check_author__id($con, $author__id){
	return check($con,"`album__author__id`=?`", $album__author__id);
}
