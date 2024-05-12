<?php
namespace Model_News;

function update( \PDO $con
	, $news_id
	, $news_path = NULL
	, $news_cover_path = NULL
	, $news_text = NULL
):\Either{
    $obj =[
        'news_id' => $news_id
		, 'news_path' => $news_path
		, 'news_cover_path' => $news_cover_path
		, 'news_text' => $news_text
    ];
    $obj = array_filter($obj);
    return update_dto($con, $obj);       
}
function update_dto(\PDO $con, $obj):\Either{
    $set = '';
    foreach($obj as $key=>$val)
        $set .= "`$key`=:$key,";
    $set = substr($set, 0, -1);
    $qu = $con->prepare("UPDATE `news` SET $set WHERE `news_id` = :news_id");
    $st = $qu->execute($obj);
    return !$st? new \Err(PASS_LOG_ERROR) : new \Ok('');
}
