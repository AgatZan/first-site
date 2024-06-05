<?php
namespace Model_Album;

function delete(\PDO $con
	, $album__id
):\Either{
    $qu = $con->prepare("DELETE FROM `album` WHERE `album__id` = :album__id");
    $st = $qu->execute(['album__id' => $album__id, ]);
    return !$st? new \Err(ID_ERROR) : new \Ok('');
}
