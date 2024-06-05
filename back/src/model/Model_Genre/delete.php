<?php
namespace Model_Genre;

function delete(\PDO $con
	, $genre__id
):\Either{
    $qu = $con->prepare("DELETE FROM `genre` WHERE `genre__id` = :genre__id");
    $st = $qu->execute(['genre__id' => $genre__id, ]);
    return !$st? new \Err(ID_ERROR) : new \Ok('');
}
