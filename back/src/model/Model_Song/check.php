<?php
namespace Model_Song;

function check(\PDO $con, $where, $what):bool{
    $qu = $con->prepare("SELECT *  FROM `song` WHERE $where");
    $qu->execute($what);
    $obj = $qu->fetchAll(\PDO::FETCH_ASSOC);
    return boolval($obj);
}
function check_song_id($con, $song_id){
	return check($con,"`song_id`=?`", $song_id);
}
