<?php
namespace Model_User_album;

function delete(\PDO $con
	, $user_name
	, $album_id
):\Either{
    $qu = $con->prepare("DELETE FROM `user_album` WHERE `user_name` = :user_name, `album_id` = :album_id");
    $st = $qu->execute(['user_name' => $user_name, 'album_id' => $album_id, ]);
    return !$st? new \Err(ID_ERROR) : new \Ok('');
}
