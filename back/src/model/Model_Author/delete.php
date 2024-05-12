<?php
namespace Model_Author;

function delete(\PDO $con
	, $author_id
):\Either{
    $qu = $con->prepare("DELETE FROM `author` WHERE `author_id` = :author_id");
    $st = $qu->execute(['author_id' => $author_id, ]);
    return !$st? new \Err(ID_ERROR) : new \Ok('');
}
