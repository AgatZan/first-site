<?php
namespace Model_Album;

function check(\PDO $con, $where, $what):bool{
    $qu = $con->prepare("SELECT *  FROM `album` WHERE $where");
    $qu->execute($what);
    $obj = $qu->fetchAll(\PDO::FETCH_ASSOC);
    return boolval($obj);
}
function check_album_id($con, $album_id){
	return check($con,"`album_id`=?`", $album_id);
}
