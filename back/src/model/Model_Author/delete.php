<?php
namespace Model_Author;

function delete(\PDO $con
	, $author__id
):\Either{
    $qu = $con->prepare("DELETE FROM `author` WHERE `author__id` = :author__id");
    $st = $qu->execute(['author__id' => $author__id, ]);
    return !$st? new \Err(ID_ERROR) : new \Ok('');
}
