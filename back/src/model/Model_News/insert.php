<?php
namespace Model_News;

function insert(\PDO $con
	, $news__path
	, $news__name
	, $news__cover_path
	, $news__text
):\Either{
    $obj = [
        'news__path' => $news__path
		, 'news__name' => $news__name
		, 'news__cover_path' => $news__cover_path
		, 'news__text' => $news__text
    ];
    $obj = array_filter($obj);
    return insert_dto($con, $obj);
}
function insert_dto(\PDO $con, $obj):\Either{ 
    $set = '';
    $inset = '';
    foreach($obj as $key=>$val){
        $set .= "$key,";
        $inset .= ":$key,";
    }
    $set = substr($set, 0, -1);
    $inset = substr($inset, 0, -1);
	$qu = $con->prepare("INSERT INTO `message` ($set) 
        VALUES ($inset)
    ");
    $st = $qu->execute($obj);
    return  !$st? new \Err(ID_ERROR) : new \Ok($obj);
}
function insert_many(\PDO $con, $count, $obj){
    $set = '';
    $inset = str_repeat('(?,?,?,?)', $count);
	$qu = $con->prepare("INSERT INTO `message` ($set) 
        VALUES $inset
    ");
    $st = $qu->execute($obj);
    return  !$st? new \Err(ID_ERROR) : new \Ok($obj);
}
