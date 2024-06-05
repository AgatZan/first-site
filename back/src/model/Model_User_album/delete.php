<?php
namespace Model_User_album;

function delete(\PDO $con
	, $user__name
	, $album__id
):\Either{
    $qu = $con->prepare("DELETE FROM `user_album` WHERE `user__name` = :user__name, `album__id` = :album__id");
    $st = $qu->execute(['user__name' => $user__name, 'album__id' => $album__id, ]);
    return !$st? new \Err(ID_ERROR) : new \Ok('');
}
