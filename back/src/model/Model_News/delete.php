<?php
namespace Model_News;

function delete(\PDO $con
	, $news__id
):\Either{
    $qu = $con->prepare("DELETE FROM `news` WHERE `news__id` = :news__id");
    $st = $qu->execute(['news__id' => $news__id, ]);
    return !$st? new \Err(ID_ERROR) : new \Ok('');
}
