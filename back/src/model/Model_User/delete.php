<?php
namespace Model_User;

function delete(\PDO $con
	, $user_name
):\Either{
    $qu = $con->prepare("DELETE FROM `user` WHERE `user_name` = :user_name");
    $st = $qu->execute(['user_name' => $user_name, ]);
    return !$st? new \Err(ID_ERROR) : new \Ok('');
}
