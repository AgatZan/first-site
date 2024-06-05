<?php
namespace Model_Song_base;

function delete(\PDO $con
	, $song__id
):\Either{
    $qu = $con->prepare("DELETE FROM `song_base` WHERE `song__id` = :song__id");
    $st = $qu->execute(['song__id' => $song__id, ]);
    return !$st? new \Err(ID_ERROR) : new \Ok('');
}
