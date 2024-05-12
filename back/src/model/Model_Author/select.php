<?php
namespace Model_Author;

function select_templ($con, $select, $templ, $param){
    $qu = $con->prepare("SELECT $select FROM `author` $templ");
    $st = $con->execute($param);
    return  !$st? new \Err(ID_ERROR) : new \Ok($st->fetchAll(\PDO::FETCH_ASSOC));
}
function select_where($con, $where, $what){
    $qu = $con->prepare("SELECT * FROM `author` WHERE $where");
    $st = $con->execute($what);
    return  !$st? new \Err(ID_ERROR) : new \Ok($st->fetchAll(\PDO::FETCH_ASSOC));
}
function select($con, $from, $count=1000){
    $qu = $con->prepare("SELECT * FROM `author` LIMIT ?,?");
    $st = $con->execute([$from, $count]);
    return  !$st? new \Err(ID_ERROR) : new \Ok($st->fetchAll(\PDO::FETCH_ASSOC));
}
function select_id($con, $id){
    $qu = $con->prepare("SELECT * FROM `author` WHERE `author_id`=?");
    $st = $con->execute($id);
    return  !$st? new \Err(ID_ERROR) : new \Ok($st->fetchAll(\PDO::FETCH_ASSOC));
}
