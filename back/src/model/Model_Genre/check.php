<?php
namespace Model_Genre;

function check(\PDO $con, $where, $what):bool{
    $qu = $con->prepare("SELECT *  FROM `genre` WHERE $where");
    $qu->execute($what);
    $obj = $qu->fetchAll(\PDO::FETCH_ASSOC);
    return boolval($obj);
}
function check_genre__id($con, $genre__id){
	return check($con,"`genre__id`=?`", $genre__id);
}
