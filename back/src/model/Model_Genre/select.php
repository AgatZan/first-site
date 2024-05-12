<?php
namespace Model_Genre;

function select_templ($con, $select, $templ, $param){
    $qu = $con->prepare("SELECT $select FROM `genre` $templ");
    $st = $con->execute($param);
    return  !$st? new \Err(ID_ERROR) : new \Ok($st->fetchAll(\PDO::FETCH_ASSOC));
}
function select_where($con, $where, $what){
    $qu = $con->prepare("SELECT * FROM `genre` WHERE $where");
    $st = $con->execute($what);
    return  !$st? new \Err(ID_ERROR) : new \Ok($st->fetchAll(\PDO::FETCH_ASSOC));
}
function select($con, $from, $count=1000){
    $qu = $con->prepare("SELECT * FROM `genre` LIMIT ?,?");
    $st = $con->execute([$from, $count]);
    return  !$st? new \Err(ID_ERROR) : new \Ok($st->fetchAll(\PDO::FETCH_ASSOC));
}
function select_id($con, $id){
    $qu = $con->prepare("SELECT * FROM `genre` WHERE `genre_id`=?");
    $st = $con->execute($id);
    return  !$st? new \Err(ID_ERROR) : new \Ok($st->fetchAll(\PDO::FETCH_ASSOC));
}
