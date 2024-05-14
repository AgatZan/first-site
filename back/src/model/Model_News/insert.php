<?php
namespace Model_News;

function insert(\PDO $con
	, $news_path
	, $news_cover_path
	, $news_text
):\Either{
    $obj = [
        'news_path' => $news_path
		, 'news_cover_path' => $news_cover_path
		, 'news_text' => $news_text
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
