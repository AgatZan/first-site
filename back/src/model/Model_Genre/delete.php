<?php
namespace Model_Genre;

function delete(\PDO $con
	, $genre_id
):\Either{
    $qu = $con->prepare("DELETE FROM `genre` WHERE `genre_id` = :genre_id");
    $st = $qu->execute(['genre_id' => $genre_id, ]);
    return !$st? new \Err(ID_ERROR) : new \Ok('');
}
