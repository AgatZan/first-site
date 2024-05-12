<?php
namespace Model_User;

function delete(\PDO $con
	, $user_id
):\Either{
    $qu = $con->prepare("DELETE FROM `user` WHERE `user_id` = :user_id");
    $st = $qu->execute(['user_id' => $user_id, ]);
    return !$st? new \Err(ID_ERROR) : new \Ok('');
}
