<?php
namespace Model_Collection_albums;

function delete(\PDO $con
	, $album_id
):\Either{
    $qu = $con->prepare("DELETE FROM `collection_albums` WHERE `album_id` = :album_id");
    $st = $qu->execute(['album_id' => $album_id, ]);
    return !$st? new \Err(ID_ERROR) : new \Ok('');
}
