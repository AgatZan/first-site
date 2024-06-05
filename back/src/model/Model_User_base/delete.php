<?php
namespace Model_User_base;

function delete(\PDO $con
	, $user__name
):\Either{
    $qu = $con->prepare("DELETE FROM `user_base` WHERE `user__name` = :user__name");
    $st = $qu->execute(['user__name' => $user__name, ]);
    return !$st? new \Err(ID_ERROR) : new \Ok('');
}
