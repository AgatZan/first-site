<?php
    function delzo($str, $alphabet= ['0', '1','2','3','4','5','6','7','8','9',',']){
        $alphabet[]= $str[0] . $str[1];
        $last = $str[0];
        $res = $alphabet[$str[0]];
        for($i=1;$i<strlen($str);++$i){ 
            $bin = $alphabet[$alphabet[$i]];
            $alphabet []= $last . $bin;
            $last = $bin;
            $res .= $bin;
        }
        return $res;
    }
    function joinbin2num($bin_str){
        $binarBig = '';
        while ($bin_str!="0"){
            $binarBig.=bcmod($bin_str,"2");
            $bin_str=bcdiv($bin_str,"2",0);
        }
	    return strrev($binarBig);
    }
    function deserialize_file($file){
        match(true){
            !isset($_FILES) => err("no file")
            , $_FILES[$file]["error"] != UPLOAD_ERR_OK => err(FILE_ERROR_TEXT[$_FILES[$file]["error"]])
            , !in_array((new finfo(FILEINFO_MIME_TYPE))->file($_FILES[$file]["tmp_name"])
                ,["image/jpeg","image/jpg","image/png"]
            ) => err("Not supported file extension")
            , $_FILES[$file]["size"] > 2 * 1024 * 1024 => err('big file')
        };
            $splited = explode('.', $_FILES[$file]['name']);
            $ext = '.' . array_pop($splited);
            $file_name = join(
                '/'
                , str_split(
                    md5_file($_FILES[$file]['tmp_name'])
                    , 6)
            ) . $ext;
            if(!is_file($file_name)){
                $dir = $_SERVER['DOCUMENT_ROOT'] . '/media/images/' . join('/', array_slice(explode('/', $file_name), 0, -1));
                if(!is_dir($dir) && !mkdir($dir, 0777, true)) err('Cant create dir');
                if(!move_uploaded_file(
                    $_FILES[$file]['tmp_name']
                    , $_SERVER['DOCUMENT_ROOT'] . '/media/images/' . $file_name)
                ) err('File dont uploaded');
            }
            return '/media/images/' . join('/', array_slice(explode('/', $file_name), 0, -1));
    }
    function deserialize_audio($file){
        match(true){
            !isset($_FILES) => err("no file")
            , $_FILES[$file]["error"] != UPLOAD_ERR_OK => err(FILE_ERROR_TEXT[$_FILES[$file]["error"]])
            , !in_array((new finfo(FILEINFO_MIME_TYPE))->file($_FILES[$file]["tmp_name"])
                ,["audio/mpeg","audio/ogg"]
            ) => err("Not supported file extension")
            , $_FILES[$file]["size"] > 200 * 1024 * 1024 => err('big file')
        };
            $splited = explode('.', $_FILES[$file]['name']);
            $ext = '.' . array_pop($splited);
            $file_name = join(
                '/'
                , str_split(
                    md5_file($_FILES[$file]['tmp_name'])
                    , 6)
            ) . $ext;
            if(!is_file($file_name)){
                $dir = $_SERVER['DOCUMENT_ROOT'] . '/media/images/' . join('/', array_slice(explode('/', $file_name), 0, -1));
                if(!is_dir($dir) && !mkdir($dir, 0777, true)) err('Cant create dir');
                if(!move_uploaded_file(
                    $_FILES[$file]['tmp_name']
                    , $_SERVER['DOCUMENT_ROOT'] . '/media/audio/' . $file_name)
                ) err('File dont uploaded');
            }
            return '/media/images/' . join('/', array_slice(explode('/', $file_name), 0, -1));
    }
