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
function aa2flat($id, $unique, $arrs){
    $res = [];
    $cache = [];
    foreach(reset($arrs) as $key => $value) $cache[$key] =explode('__', $key);
    foreach($arrs as $arr){
        $ids = array_intersect_key($arr, array_flip($id));
        $dos = $cache[$id[0]];
        $res[reset($dos)][$ids[0]] = $res[reset($dos)][$ids[$id[0]]] ?? []; 
        foreach ($arr as $key => $value) {
            $dos =  $cache[$key];
            $cur = &$res[$dos[0]][$ids[$id[0]]];
            for($j=1; $j<sizeof($dos)-1;++$j){
                $cur[$dos[$j]] = $cur[$dos[$j]] ?? [[]];
                $prev = &$cur[$dos[$j]];
                $cur = &$cur[$dos[$j]][$ids[$id[$j]]];
            }
            $multy = false;
            foreach($unique as $name){
                if($name != $key) continue;
                $multy = true;
                break;
            }
            if($multy && isset($cur[$dos[$j]])) $cur[$dos[$j]] []= $value;
            elseif($multy) $cur[$dos[$j]]=[$value];
            elseif(!isset($cur[$dos[$j]])) $cur[$dos[$j]] = $value;
            elseif($cur[$dos[$j]] != $value) $prev []= [$dos[$j]=>$value]; 
        }
    }
    return $res;
}
var_dump(
    json_encode(
        aa2flat(['album__id', 'album__song__id'], ["album__song__name"]
            ,[
                ["album__id"=>1, "album__song__id"=>1, "album__song__name"=>'sd'],
                ["album__id"=>1, "album__song__id"=>2, "album__song__name"=>'ssdd'],
                ["album__id"=>1, "album__song__id"=>3, "album__song__name"=>'sd'],
                ["album__id"=>2, "album__song__id"=>1, "album__song__name"=>'sd'],
                ["album__id"=>2, "album__song__id"=>2, "album__song__name"=>'sda'],
                ["album__id"=>2, "album__song__id"=>3, "album__song__name"=>'sd'],
            ]
        )
        , JSON_PRETTY_PRINT
    )
);
// function aa2flat($arr){
//     return array_reduce($arr, fn($acc, $n)=>array_merge($acc,[a2flat($n)]), []);
// }

function serialize_either($id,$unique, $either){
    return $either
    ->unpack(fn($dto)=>exit(json_encode(is_array($dto[0])
        ? a2flat($dto)
        : aa2flat($id, $unique, $dto))))
    ->catch(function($dto){
        header('HTTP/1.1 400 Bad Request');
        exit(json_encode(['err'=>$dto]));
    });
}
function either_catch($either):\Either{
    return $either
    ->catch(function($obj){
        header('HTTP/1.1 406 Not Acceptable');
        exit(json_encode(['err'=>$obj]));
    });
}