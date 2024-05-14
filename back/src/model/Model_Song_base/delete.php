<?php
namespace Model_Song_base;

function delete(\PDO $con
	, $song_id
	, $album_id
):\Either{
    $qu = $con->prepare("DELETE FROM `song_base` WHERE `song_id` = :song_id, `album_id` = :album_id");
    $st = $qu->execute(['song_id' => $song_id, 'album_id' => $album_id, ]);
    return !$st? new \Err(ID_ERROR) : new \Ok('');
}
