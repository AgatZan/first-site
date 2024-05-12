<?php
    header('Content-Type: application/json; charset=utf-8');
    function err($err){
        header('HTTP/1.1 406 Not Acceptable');
        return json_encode(['err'=>$err]);
    }
    $file_name = null;
    if(!$_FILES['cover']['error'] == UPLOAD_ERR_NO_FILE){
        if(in_array($_FILES['cover']['error'], FILE_ERROR))
            return err(FILE_ERROR_TEXT[$_FILES['cover']['error']]);
        if($_FILES['cover']['size'] > 5 * 1024 * 1024)
            return err('Must be less then 5 mb');
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        if($finfo->file($_FILES['cover']['tmp_name']) !== 'image/jpeg')
            return err('Not supported file extension');
        $splited = explode('.', $_FILES['cover']['name']);
        $ext = '.' . array_pop($splited);
        $file_name = join(
            '/'
            , str_split(
                md5_file(
                    $_FILES['cover']['tmp_name'])
                    , 6)
        ) . $ext;
        if(!is_file($file_name)){
            $dir = $_SERVER['DOCUMENT_ROOT'] . '/data/img/' . join('/', array_slice(explode('/', $file_name), 0, -1));
            if(!is_dir($dir) && !mkdir($dir, 0777, true)) return err('Cant create dir');
            if(!move_uploaded_file(
                $_FILES['cover']['tmp_name']
                , $_SERVER['DOCUMENT_ROOT'] . '/data/img/' . $file_name)
            )
                return err('File dont uploaded');
        }
    }
    require_once MODEL . 'Model_Dialog/insert.php';
    require_once DB_CONNECT;
    require_once UTILS . 'serialize.php';
    return serialize_either(\Model_Dialog\insert(CON, $_SESSION['userName'], $_POST['dialogName'], $file_name));










/*
    return (new Ok($_FILES['cover']))
    ->unpack(fn($val)=>match(true){
        !isset($val['error']) || is_array($val['error']) => new Err("Invalid parameter"),
        in_array($val['error'], FILE_ERROR) => new Err(FILE_ERROR_TEXT[$val['error']]),
        $val['size'] > 5 * 1024 * 1024 => new Err("Must be less then 5 mb"),
        true => new Ok($val)
    })
    ->unpack(fn($val)=>new Ok([$val, join('/', str_split(md5_file($val['tmp_name'], 6))).'.jpeg']))
    ->unpack(fn($val)=>is_file($val[1])
        ? new Ok($val)
        : (new Ok($val))
        ->pack(fn($v)=>
            [$v[0], $v[1], $_SERVER['DOCUMENT_ROOT'] . '/data/img/' . join('/', array_slice(explode('/', $v[1]), 0, -1))]
        )
        ->unpack(fn($v)=> is_dir($v[2]) || mkdir($v[2], 0777, true)
            ? new Ok($v)
            : new Err('Cant create dir')
        )
        ->unpack(fn($v)=> move_uploaded_file($v[0]['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/data/img/' . $v[1])
            ? new Ok($v)
            : new Err('Failed to move uploaded file.')
        )   
    )
    ->unpack(function($v){
        require_once MODEL . 'Model_Dialog/insert.php';
        require_once DB_CONNECT;
        require_once UTILS . 'serialize.php';    
        return serialize_either(\Model_Dialog\insert(CON, $_SESSION['userName'], $_POST['dialogName'], $v[2]));
    })
    ->catch(function($e){
        header('HTTP/1.1 406 Not Acceptable');
        return json_encode(['err'=>$e]);
    });
*/