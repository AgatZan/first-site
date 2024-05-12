<?php
    define('NAME_ERROR', 'Введено некорректное имя');
    define('PASS_LOG_ERROR', 'Введен некорректный логин или пароль');
    define('ID_ERROR', 'Обращение к несуществующему пользователю');
    define('REQUEST_ERROR', 'Ошибка отправки запроса');
    define('NO_USER_ERROR', 'Не существующий пользователь');
    define('NO_UPDATE_ERROR', 'Не введены данные для изменения');
    define('INSERT_ERROR', 'В результате запроса затронуто избыточное количество данных');
    define('MAJOR_EXIST_ERROR', 'Попытка добавить существующего');
    define('GENDER_ERROR', 'Неизвестный гендер');
    define('FILE_ERROR', [
        UPLOAD_ERR_NO_FILE
        , UPLOAD_ERR_PARTIAL
        , UPLOAD_ERR_INI_SIZE
        , UPLOAD_ERR_EXTENSION
        , UPLOAD_ERR_FORM_SIZE
        , UPLOAD_ERR_CANT_WRITE
        , UPLOAD_ERR_NO_TMP_DIR
    ]);
    define('FILE_ERROR_TEXT', [
        UPLOAD_ERR_INI_SIZE => 'Exceeded filesize limit.'
        , UPLOAD_ERR_FORM_SIZE => 'Exceeded filesize limit.'
        , UPLOAD_ERR_PARTIAL => 'File not completle send'
        , UPLOAD_ERR_NO_FILE => 'No file sent.'
        , UPLOAD_ERR_NO_TMP_DIR => 'not allow to send'
        , UPLOAD_ERR_CANT_WRITE => 'not enough white space in disk'
        , UPLOAD_ERR_EXTENSION => 'PHP INFO err'
    ]);