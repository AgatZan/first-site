<?php
function a2flat($arr){
    $res = [];
    foreach($arr as $k=>$v ){
        $domain = explode('__', $k);
        $cur = &$res;
        for($i=0; $i<sizeof($domain)-1;++$i){
            $cur[$domain[$i]] = $cur[$domain[$i]] ?? [];
            $cur = &$cur[$domain[$i]];
        }
        $cur[$domain[$i]] = $v;
    }
    return $res;
}
function aa2flat($arr){
    return array_reduce($arr, fn($acc, $n)=>array_merge($acc,[a2flat($n)]), []);
}

function serialize_either($either){
    return $either
    ->unpack(fn($dto)=>exit(json_encode(is_array($dto[0])
        ? a2flat($dto)
        : aa2flat($dto))))
    ->catch(function($dto){
        header('HTTP/1.1 400 Bad Request');
        exit(json_encode($dto));
    });
}
function either_catch($either):\Either{
    return $either
    ->catch(function($obj){
        header('HTTP/1.1 406 Not Acceptable');
        exit(json_encode(['err'=>$obj]));
    });
}