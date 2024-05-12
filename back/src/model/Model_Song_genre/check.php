<?php
namespace Model_Song_genre;

function check(\PDO $con, $where, $what):bool{
    $qu = $con->prepare("SELECT *  FROM `song_genre` WHERE $where");
    $qu->execute($what);
    $obj = $qu->fetchAll(\PDO::FETCH_ASSOC);
    return boolval($obj);
}

