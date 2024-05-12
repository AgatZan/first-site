<?php
define('P_MAIN','http://timosh-db.hw');

define('DB_ENV',            $_SERVER['DOCUMENT_ROOT'] . '/database/.env');
define('DB_CONNECT',        $_SERVER['DOCUMENT_ROOT'] . '/utils/gdb_connect.php');

define('IMG',              $_SERVER['DOCUMENT_ROOT'] . 'data/img/');
define('API',               $_SERVER['DOCUMENT_ROOT'] . '/src/api/');
define('VUE',               $_SERVER['DOCUMENT_ROOT'] . '/src/vue/');
define('ROUT',              $_SERVER['DOCUMENT_ROOT'] . '/data/rout/');
define('MODEL',             $_SERVER['DOCUMENT_ROOT'] . '/src/model/');
define('UTILS',             $_SERVER['DOCUMENT_ROOT'] . '/utils/');
define('A_GET',             $_SERVER['DOCUMENT_ROOT'] . '/src/api/get/');
define('A_PUT',             $_SERVER['DOCUMENT_ROOT'] . '/src/api/put/');
define('A_POST',            $_SERVER['DOCUMENT_ROOT'] . '/src/api/post/');
define('A_DELETE',          $_SERVER['DOCUMENT_ROOT'] . '/src/api/delete/');
define('COMPONENTS',        $_SERVER['DOCUMENT_ROOT'] . '/src/components/');

define('L_USER_DB',         $_SERVER['DOCUMENT_ROOT'] . '/data/const/db/user_db.php');
define('L_MAJOR_DB',        $_SERVER['DOCUMENT_ROOT'] . '/data/const/db/major_db.php');
define('L_STUDENT_DB',      $_SERVER['DOCUMENT_ROOT'] . '/data/const/db/student_db.php');
define('L_SUBSCRIBE_DB',    $_SERVER['DOCUMENT_ROOT'] . '/data/const/db/subscribe_db.php');

define('P_ERROR',           VUE . 'error.php');
define('P_ERROR_404',       VUE . '404.php');
define('P_DB_ERROR',        VUE . 'database_error.php');


define('P_HOME',            VUE . '.php');


