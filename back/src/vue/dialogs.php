<?php
    require COMPONENTS . 'dialog/.php';
    require COMPONENTS . 'dialog/s.php'; 
    require_once MODEL . 'Model_Dialog/select.php';
    require_once MODEL . 'Model_Message/select.php';
    require_once DB_CONNECT;
    return \Model_Dialog\select(CON, 10)
            ->catch(function($v){
                header('HTTP/1.1 406 Not Acceptable');
                exit($v);
            })
            ->unpack( fn($arr)=>
                dialog_panel(
                    array_reduce(
                        $arr
                        , fn($acc, $next)=>$acc . dialog_el($next)
                    )
                    , dialog(
                        ''
                        , ''
                        , dialog_input('')
                        , 'dialog_open'
                    )
                )    
    );