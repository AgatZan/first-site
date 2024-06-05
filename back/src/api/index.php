<?php
    session_start();
    header('Content-Type: application/json; charset=utf-8');  
    require_once $_SERVER['DOCUMENT_ROOT'] . '/back/data/const/links.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/back/data/const/error.php';
    require_once UTILS . 'rout.php';
    require_once UTILS . 'Either.php';

    $method = $_SERVER['REQUEST_METHOD'];
    $request = explode('?', explode('/api',$_SERVER['REQUEST_URI'])[1])[0];
    echo rout_recieve_auto_mult(realpath('.'), $method, $request, P_ERROR_404);