<?php
namespace Model_News;

function update( \PDO $con
	, $news__id
	, $news__path = NULL
	, $news__name = NULL
	, $news__cover_path = NULL
	, $news__text = NULL
):\Either{
    $obj =[
        'news__id' => $news__id
		, 'news__path' => $news__path
		, 'news__name' => $news__name
		, 'news__cover_path' => $news__cover_path
		, 'news__text' => $news__text
    ];
    $obj = array_filter($obj);
    return update_dto($con, $obj);       
}
function update_dto(\PDO $con, $obj):\Either{
    $set = '';
    foreach($obj as $key=>$val)
        $set .= "`$key`=:$key,";
    $set = substr($set, 0, -1);
    $qu = $con->prepare("UPDATE `news` SET $set WHERE `news__id` = :news__id");
    $st = $qu->execute($obj);
    return !$st? new \Err(PASS_LOG_ERROR) : new \Ok('');
}
