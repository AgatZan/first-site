<?php
namespace Model_Album_song;

function delete(\PDO $con
	, $album__id
	, $song__id
):\Either{
    $qu = $con->prepare("DELETE FROM `album_song` WHERE `album__id` = :album__id, `song__id` = :song__id");
    $st = $qu->execute(['album__id' => $album__id, 'song__id' => $song__id, ]);
    return !$st? new \Err(ID_ERROR) : new \Ok('');
}
