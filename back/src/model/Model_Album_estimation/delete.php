<?php
namespace Model_Album_estimation;

function delete(\PDO $con
	, $estimation__id
	, $album__id
):\Either{
    $qu = $con->prepare("DELETE FROM `album_estimation` WHERE `estimation__id` = :estimation__id, `album__id` = :album__id");
    $st = $qu->execute(['estimation__id' => $estimation__id, 'album__id' => $album__id, ]);
    return !$st? new \Err(ID_ERROR) : new \Ok('');
}
