<?php
namespace Model_Author;

function update( \PDO $con
	, $author__id
	, $author__name = NULL
	, $author__page = NULL
):\Either{
    $obj =[
        'author__id' => $author__id
		, 'author__name' => $author__name
		, 'author__page' => $author__page
    ];
    $obj = array_filter($obj);
    return update_dto($con, $obj);       
}
function update_dto(\PDO $con, $obj):\Either{
    $set = '';
    foreach($obj as $key=>$val)
        $set .= "`$key`=:$key,";
    $set = substr($set, 0, -1);
    $qu = $con->prepare("UPDATE `author` SET $set WHERE `author__id` = :author__id");
    $st = $qu->execute($obj);
    return !$st? new \Err(PASS_LOG_ERROR) : new \Ok('');
}
