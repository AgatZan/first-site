<?php
namespace Model_Genre;

function check(\PDO $con, $where, $what):bool{
    $qu = $con->prepare("SELECT *  FROM `genre` WHERE $where");
    $qu->execute($what);
    $obj = $qu->fetchAll(\PDO::FETCH_ASSOC);
    return boolval($obj);
}
function check_genre_id($con, $genre_id){
	return check($con,"`genre_id`=?`", $genre_id);
}
