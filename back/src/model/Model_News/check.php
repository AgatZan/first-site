<?php
namespace Model_News;

function check(\PDO $con, $where, $what):bool{
    $qu = $con->prepare("SELECT *  FROM `news` WHERE $where");
    $qu->execute($what);
    $obj = $qu->fetchAll(\PDO::FETCH_ASSOC);
    return boolval($obj);
}

