<?php
namespace Model_Author;

function update( \PDO $con
	, $author_id
	, $author_name = NULL
	, $author_page = NULL
):\Either{
    $obj =[
        'author_id' => $author_id
		, 'author_name' => $author_name
		, 'author_page' => $author_page
    ];
    $obj = array_filter($obj);
    return update_dto($con, $obj);       
}
function update_dto(\PDO $con, $obj):\Either{
    $set = '';
    foreach($obj as $key=>$val)
        $set .= "`$key`=:$key,";
    $set = substr($set, 0, -1);
    $qu = $con->prepare("UPDATE `author` SET $set WHERE `author_id` = :author_id");
    $st = $qu->execute($obj);
    return !$st? new \Err(PASS_LOG_ERROR) : new \Ok('');
}
