<?php
namespace Model_Album_estimation;

function delete(\PDO $con
	, $estimation_id
	, $album_id
):\Either{
    $qu = $con->prepare("DELETE FROM `album_estimation` WHERE `estimation_id` = :estimation_id, `album_id` = :album_id");
    $st = $qu->execute(['estimation_id' => $estimation_id, 'album_id' => $album_id, ]);
    return !$st? new \Err(ID_ERROR) : new \Ok('');
}
