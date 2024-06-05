<?php
namespace Model_Song;

function update( \PDO $con
	, $song__id = NULL
	, $song__name = NULL
	, $song__path = NULL
	, $song__genre__id = NULL
	, $song__genre__name = NULL
	, $song__album__id = NULL
):\Either{
    $obj =[
        'song__id' => $song__id
		, 'song__name' => $song__name
		, 'song__path' => $song__path
		, 'song__genre__id' => $song__genre__id
		, 'song__genre__name' => $song__genre__name
		, 'song__album__id' => $song__album__id
    ];
    $obj = array_filter($obj);
    return update_dto($con, $obj);       
}
function update_dto(\PDO $con, $obj):\Either{
    $set = '';
    foreach($obj as $key=>$val)
        $set .= "`$key`=:$key,";
    $set = substr($set, 0, -1);
    $qu = $con->prepare("UPDATE `song` SET $set WHERE ");
    $st = $qu->execute($obj);
    return !$st? new \Err(PASS_LOG_ERROR) : new \Ok('');
}
