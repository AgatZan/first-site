<?php
namespace Model_Album_base;

function delete(\PDO $con
	, $album_id
	, $author_id
):\Either{
    $qu = $con->prepare("DELETE FROM `album_base` WHERE `album_id` = :album_id, `author_id` = :author_id");
    $st = $qu->execute(['album_id' => $album_id, 'author_id' => $author_id, ]);
    return !$st? new \Err(ID_ERROR) : new \Ok('');
}
