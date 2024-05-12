<?php
namespace Model_News;

function delete(\PDO $con
	, $news_id
):\Either{
    $qu = $con->prepare("DELETE FROM `news` WHERE `news_id` = :news_id");
    $st = $qu->execute(['news_id' => $news_id, ]);
    return !$st? new \Err(ID_ERROR) : new \Ok('');
}
