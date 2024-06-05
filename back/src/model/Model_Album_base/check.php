<?php
namespace Model_Album_base;

function check(\PDO $con, $where, $what):bool{
    $qu = $con->prepare("SELECT *  FROM `album_base` WHERE $where");
    $qu->execute($what);
    $obj = $qu->fetchAll(\PDO::FETCH_ASSOC);
    return boolval($obj);
}
function check_album__id($con, $album__id){
	return check($con,"`album__id`=?`", $album__id);
}
