<?php
namespace Model_Song_genre;

function delete(\PDO $con
	, $song__id
	, $genre__id
):\Either{
    $qu = $con->prepare("DELETE FROM `song_genre` WHERE `song__id` = :song__id, `genre__id` = :genre__id");
    $st = $qu->execute(['song__id' => $song__id, 'genre__id' => $genre__id, ]);
    return !$st? new \Err(ID_ERROR) : new \Ok('');
}
