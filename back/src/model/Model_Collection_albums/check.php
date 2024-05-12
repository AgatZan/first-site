<?php
namespace Model_Collection_albums;

function check(\PDO $con, $where, $what):bool{
    $qu = $con->prepare("SELECT *  FROM `collection_albums` WHERE $where");
    $qu->execute($what);
    $obj = $qu->fetchAll(\PDO::FETCH_ASSOC);
    return boolval($obj);
}

