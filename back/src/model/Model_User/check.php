<?php
namespace Model_User;

function check(\PDO $con, $where, $what):bool{
    $qu = $con->prepare("SELECT *  FROM `user` WHERE $where");
    $qu->execute($what);
    $obj = $qu->fetchAll(\PDO::FETCH_ASSOC);
    return boolval($obj);
}

