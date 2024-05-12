<?php
namespace Model_Song_genre;

function delete(\PDO $con
	, $genre_id
):\Either{
    $qu = $con->prepare("DELETE FROM `song_genre` WHERE `genre_id` = :genre_id");
    $st = $qu->execute(['genre_id' => $genre_id, ]);
    return !$st? new \Err(ID_ERROR) : new \Ok('');
}
