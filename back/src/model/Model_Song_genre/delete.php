<?php
namespace Model_Song_genre;

function delete(\PDO $con
	, $song_id
	, $genre_id
):\Either{
    $qu = $con->prepare("DELETE FROM `song_genre` WHERE `song_id` = :song_id, `genre_id` = :genre_id");
    $st = $qu->execute(['song_id' => $song_id, 'genre_id' => $genre_id, ]);
    return !$st? new \Err(ID_ERROR) : new \Ok('');
}
