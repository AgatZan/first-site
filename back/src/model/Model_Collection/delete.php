<?php
namespace Model_Collection;

function delete(\PDO $con
	, $collection__id
):\Either{
    $qu = $con->prepare("DELETE FROM `collection` WHERE `collection__id` = :collection__id");
    $st = $qu->execute(['collection__id' => $collection__id, ]);
    return !$st? new \Err(ID_ERROR) : new \Ok('');
}
