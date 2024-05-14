<?php
namespace Model_Collection_albums;

function delete(\PDO $con
	, $collection_id
	, $album_id
):\Either{
    $qu = $con->prepare("DELETE FROM `collection_albums` WHERE `collection_id` = :collection_id, `album_id` = :album_id");
    $st = $qu->execute(['collection_id' => $collection_id, 'album_id' => $album_id, ]);
    return !$st? new \Err(ID_ERROR) : new \Ok('');
}
