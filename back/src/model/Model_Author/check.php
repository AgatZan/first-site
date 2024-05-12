<?php
namespace Model_Author;

function check(\PDO $con, $where, $what):bool{
    $qu = $con->prepare("SELECT *  FROM `author` WHERE $where");
    $qu->execute($what);
    $obj = $qu->fetchAll(\PDO::FETCH_ASSOC);
    return boolval($obj);
}

