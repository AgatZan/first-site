<?php
namespace Model_Collection;

function delete(\PDO $con
	, $collection_id
):\Either{
    $qu = $con->prepare("DELETE FROM `collection` WHERE `collection_id` = :collection_id");
    $st = $qu->execute(['collection_id' => $collection_id, ]);
    return !$st? new \Err(ID_ERROR) : new \Ok('');
}
