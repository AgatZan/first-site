<?php
namespace Model_Collection_albums;

function delete(\PDO $con
	, $collection__id
	, $album__id
):\Either{
    $qu = $con->prepare("DELETE FROM `collection_albums` WHERE `collection__id` = :collection__id, `album__id` = :album__id");
    $st = $qu->execute(['collection__id' => $collection__id, 'album__id' => $album__id, ]);
    return !$st? new \Err(ID_ERROR) : new \Ok('');
}
