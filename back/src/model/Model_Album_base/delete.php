<?php
namespace Model_Album_base;

function delete(\PDO $con
	, $album_creator
):\Either{
    $qu = $con->prepare("DELETE FROM `album_base` WHERE `album_creator` = :album_creator");
    $st = $qu->execute(['album_creator' => $album_creator, ]);
    return !$st? new \Err(ID_ERROR) : new \Ok('');
}
