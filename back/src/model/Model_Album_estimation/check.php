<?php
namespace Model_Album_estimation;

function check(\PDO $con, $where, $what):bool{
    $qu = $con->prepare("SELECT *  FROM `album_estimation` WHERE $where");
    $qu->execute($what);
    $obj = $qu->fetchAll(\PDO::FETCH_ASSOC);
    return boolval($obj);
}

