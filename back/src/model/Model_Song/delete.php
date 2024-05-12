<?php
namespace Model_Song;

function delete(\PDO $con
	, $album_id
):\Either{
    $qu = $con->prepare("DELETE FROM `song` WHERE `album_id` = :album_id");
    $st = $qu->execute(['album_id' => $album_id, ]);
    return !$st? new \Err(ID_ERROR) : new \Ok('');
}
