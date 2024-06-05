<?php
namespace Model_Album_genre;

function delete(\PDO $con
	, $album__id
	, $genre__id
):\Either{
    $qu = $con->prepare("DELETE FROM `album_genre` WHERE `album__id` = :album__id, `genre__id` = :genre__id");
    $st = $qu->execute(['album__id' => $album__id, 'genre__id' => $genre__id, ]);
    return !$st? new \Err(ID_ERROR) : new \Ok('');
}
