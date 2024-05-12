<?php
function serialize_either($either){
    return $either
    ->unpack(fn($dto)=>exit(json_encode($dto)))
    ->catch(function($dto){
        header('HTTP/1.1 400 Bad Request');
        exit(json_encode($dto));
    });
}
function either_catch($either){
    return $either
    ->catch(function($obj){
        header('HTTP/1.1 406 Not Acceptable');
        exit(json_encode(['err'=>$obj]));
    });
}