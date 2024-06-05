<?php
namespace Model_Song;

function delete(\PDO $con
):\Either{
    $qu = $con->prepare("DELETE FROM `song` WHERE ");
    $st = $qu->execute([]);
    return !$st? new \Err(ID_ERROR) : new \Ok('');
}
