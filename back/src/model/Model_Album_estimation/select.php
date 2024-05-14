<?php
namespace Model_Album_estimation;

function select_templ($con, $select, $templ, $param){
    $qu = $con->prepare("SELECT $select FROM `album_estimation` $templ");
    $st = $con->execute($param);
    return  !$st? new \Err(ID_ERROR) : new \Ok($st->fetchAll(\PDO::FETCH_ASSOC));
}
function select_where($con, $where, $what){
    $qu = $con->prepare("SELECT * FROM `album_estimation` WHERE $where");
    $st = $con->execute($what);
    return  !$st? new \Err(ID_ERROR) : new \Ok($st->fetchAll(\PDO::FETCH_ASSOC));
}
function select($con, $from, $count=1000){
    $qu = $con->prepare("SELECT * FROM `album_estimation` LIMIT ?,?");
    $st = $con->execute([$from, $count]);
    return  !$st? new \Err(ID_ERROR) : new \Ok($st->fetchAll(\PDO::FETCH_ASSOC));
}
function select_id($con, $id){
    $qu = $con->prepare("SELECT * FROM `album_estimation` WHERE `estimation_id`=?`estimation_id`=? AND `album_id`=?");
    $st = $con->execute($id);
    return  !$st? new \Err(ID_ERROR) : new \Ok($st->fetchAll(\PDO::FETCH_ASSOC));
}
