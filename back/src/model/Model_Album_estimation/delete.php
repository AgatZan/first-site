<?php
namespace Model_Album_estimation;

function delete(\PDO $con
	, $album_id
):\Either{
    $qu = $con->prepare("DELETE FROM `album_estimation` WHERE `album_id` = :album_id");
    $st = $qu->execute(['album_id' => $album_id, ]);
    return !$st? new \Err(ID_ERROR) : new \Ok('');
}
